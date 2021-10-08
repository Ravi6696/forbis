<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\CompanyAdvertisement;
use Illuminate\Support\Facades\Http;

class AnnouncesController extends BaseController
{
    public function annoncesView()
    {
        $companyData = $this->Company->where('user_id', auth()->user()->id)
            ->first();
        // $paymentDetail = $this->CardDetail->where('user_id', auth()->user()->id)->latest()->first();
        $companyAdvertisement = $companyData->companyAdvertisement ?? [];
        $categories = $this->Category->where('status', 'active')->pluck('title', 'id');
        $cardDetails = auth()->user()->cardDetails ?? [];;
        return view('pro-user.annonces', compact('companyData', 'categories', 'companyAdvertisement', 'cardDetails'));
    }

    public function shareToLinkedin()
    {
        try {
            $response = Http::get('https://api.linkedin.com/v2/shares?q=owners&owners={77ooir7l0yzibc}&sortBy=LAST_MODIFIED&sharesPerOwner=100');
            dd($response->json());
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function removeAnnounce(Request $request)
    {
        $request->validate(
            [
                'company_id' => 'required',
                'reason' => 'required'
            ]
        );
        try {
            $announceid = $request->announceid;
            $user = Auth::user();
            $user->subscription('default')->decrementQuantity();
            $announce = $this->CompanyAdvertisement->where('id', $announceid)->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Company Advertisement']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function filterByCategory(Request $request)
    {
        try {
            $search_filter = $request->search_filter;
            $categories = $request->categories;
            $companyData = $this->Company->where('user_id', auth()->user()->id)
                ->first();
            // $company_id = $request->company_id;
            $company_id = $companyData->id;
            $companyAdvertisement  = $this->CompanyAdvertisement->when($categories, function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            })
                ->when($search_filter, function ($q) use ($search_filter) {
                    $q->where('name', 'LIKE', '%' . $search_filter . '%');
                })
                ->where('company_id', $company_id)
                ->get();
            $paymentDetail = $this->CardDetail::where('user_id', auth()->user()->id)->latest()->first();
            return view("components.pro-user.announce-list", compact('companyAdvertisement', 'paymentDetail'))
                ->render();
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function payAdAmount(Request $request)
    {
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'company_id' => 'required'
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, implode(',', $validator->errors()->all()));
            } else {
                $data = request()->all();

                $payment = $this->payByCard($data);
                $payment_status = $payment->status == "succeeded" ? true : false;
                if ($payment_status) {
                    $user = Auth::user();
                    \Log::debug(request()->user()->subscribed('default'));
                    $user->subscription('default')->incrementQuantity();
                    $objCompanyAd = $this->CompanyAdvertisement->firstOrNew(['id' => $request->add_id]);
                    $objCompanyAd->company_id = $request->company_id;
                    $objCompanyAd->invoice_number = CompanyAdvertisement::generateInvoiceNumber();
                    $objCompanyAd->start_date = Carbon::now()->format('Y-m-d');
                    $objCompanyAd->end_date = Carbon::now()->addMonth()->format('Y-m-d');
                    if ($objCompanyAd->save()) {
                        $companyAdvertisement = $objCompanyAd;
                        $announces = $this->CompanyAdvertisement->whereHas('company', function ($query) {
                            $query->where('user_id', Auth::user()->id);
                        })->active()->get();
                        $categories = $this->Category->where('status', 'active')->pluck('title', 'id');
                        $html = view('user.announce-list', compact('announces'))->render();
                        return getResponse(1, __('message.added', ['attribute' => 'Company Advertisement']), $html);
                    } else {
                        return getResponse(0, 'Something went wrong !');
                    }
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function saveAd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'redirection_link' => $request->is_send_dashboard ? 'required|active_url' : '',
            'description' => 'required',
        ]);
        try {

            $objCompanyAd = $this->CompanyAdvertisement->firstOrNew(['id' => $request->ad_id]);
            $objCompanyAd->company_id = $request->company_id;
            $objCompanyAd->category_id = $request->category_id;
            $objCompanyAd->name = $request->name;
            $objCompanyAd->description = $request->description;
            $objCompanyAd->redirection_link = $request->redirection_link;
            $objCompanyAd->start_date = $objCompanyAd->start_date ??  Carbon::now()->format('Y-m-d');
            $objCompanyAd->end_date = $objCompanyAd->end_date ??  Carbon::now()->addMonth()->format('Y-m-d');
            $objCompanyAd->is_send_dashboard = $request->is_send_dashboard ?? '0';
            $objCompanyAd->is_renewable = 1;
            if ($request->attachment) {
                $file_name = Storage::disk('uploads')->put("companies", $request->attachment);
                $objCompanyAd->attachment = $file_name;
            }
            if ($objCompanyAd->save()) {
                return getResponse(1, __('message.added', ['attribute' => 'Company Advertisement']), $objCompanyAd);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function filterAnnounces(Request $request)
    {
        try {
            $category_id  = $request->categories;
            $search_filter  = $request->search_filter;
            $announces = CompanyAdvertisement::active()->when($category_id != '', function ($q) use ($category_id) {
                $q->whereIn('category_id', $category_id);
            })
                ->when($search_filter != '', function ($q) use ($search_filter) {
                    $q->where(function ($q) use ($search_filter) {
                        $q->Where('name', 'like', '%' . $search_filter . '%')
                            ->orWhere('description', 'like', '%' . $search_filter . '%');
                    });
                })
                ->get();
            $html = view('user.announce-list', compact('announces'))->render();
            // $data['html'] = $html;
            return getResponse(1, __('message.details', ['attribute' => 'Faqs']), $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function getAd(Request $request)
    {
        try {
            $id = $request->id;
            $is_view = $request->is_view;
            $companyAdvertisement = $this->CompanyAdvertisement->where('id', $id)->with('company', 'category')->first();
            $companyAdvertisement->is_view = $is_view;
            $categories = $this->Category->active()->pluck('title', 'id');
            $updateData = 1;
            $html =  view('components.pro-user.create-announce', compact('companyAdvertisement', 'categories', 'updateData'))->render();
            $data['html'] = $html;
            $data['data'] = $companyAdvertisement;
            return getResponse(1, __('message.details', ['attribute' => 'Company Advertisement']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function addSubscription($data)
    {
        $stripe_conf = \Config::get('stripe');
        $company =  $this->Company->where('user_id', Auth::user()->id)->first();
        $stripe = new \Stripe\StripeClient(
            $stripe_conf['stripe_secret'],
        );

        $payment_method = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $data['card_number'],
                'exp_month' => $data['card_expiry_month'],
                'exp_year' => $data['card_expiry_year'],
                'cvc' => $data['card_cvc'],
            ],
            'billing_details' => [
                'name' => Auth::user()->full_name,
                'address' => [
                    'line1' => $company->address->address_line_1,
                    'line2' =>  $company->address->address_line_2,
                    'postal_code' => $company->address->postalcode,
                    'city' => $company->address->city,
                    'state' => 'test',
                    'country' => 'US',
                ],
            ]
        ]);

        $plan = $this->Plans::where('identifier', 'monthly')
            ->first();
        $user = Auth::user();
        $user->newSubscription('default', $plan->stripe_id)
            ->create($payment_method, [
                'email' => Auth::user()->email,
            ]);
        $user->trial_ends_at = Carbon::now()->addMonth()->format('Y-m-d');
        $user->save();
        return true;
    }
    public function payByCard($data)
    {
        $stripe_conf = \Config::get('stripe');
        $company =  $this->Company->where('user_id', Auth::user()->id)->first();
        $amount = ($company->companyAdvertisement->sum('ad_amount') ?? 0) + $company->ad_amount;
        $stripe = new \Stripe\StripeClient(
            $stripe_conf['stripe_secret'],
        );
        $payment_method = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $data['card_number'],
                'exp_month' => $data['card_expiry_month'],
                'exp_year' => $data['card_expiry_year'],
                'cvc' => $data['card_cvc'],
            ],
            'billing_details' => [
                'name' => Auth::user()->full_name,
                'address' => [
                    'line1' => $company->address->address_line_1,
                    'line2' =>  $company->address->address_line_2,
                    'postal_code' => $company->address->postalcode,
                    'city' => $company->address->city,
                    'state' => 'test',
                    'country' => 'US',
                ],
            ]
        ]);
        $paymentIntents = $stripe->paymentIntents->create([
            'shipping' => [
                'name' => Auth::user()->name,
                'address' => [
                    'line1' => $company->address->address_line_1,
                    'line2' =>  $company->address->address_line_2,
                    'postal_code' => $company->address->postalcode,
                    'city' => $company->address->city,
                    'state' => 'test',
                    'country' => 'US',
                ],
            ],
            "amount" => $amount * 100,
            "currency" => 'inr',
            'payment_method_types' => ['card'],
            'payment_method' => $payment_method->id,
            'setup_future_usage' => 'off_session',
        ]);
        $paymentconfirm = $stripe->paymentIntents->confirm(
            $paymentIntents->id,
            ['payment_method' => $payment_method->id]
        );
        return $paymentconfirm;
    }


    public function storeCard(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
            'card_cvc' => 'required',
        ]);
        try {
            $data = request()->all();
            $payment = $this->addSubscription($data);
            if ($payment) {
                $userData = $this->User->where('id', auth()->user()->id)->first();
                $this->CardDetail->updateOrCreate([
                    'user_id' => auth()->user()->id,
                    'card_number' => $request->card_number,
                    'expires_on' => $request->card_expiry_month . '/' . $request->card_expiry_year,
                    'cvv' => $request->card_cvc,
                ]);
                $this->CompanyAdvertisement->updateOrCreate([
                    'company_id' => $userData->company->id,
                    'invoice_number' => CompanyAdvertisement::generateInvoiceNumber(),
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                ]);
                $objUser = $this->User->find(Auth::user()->id);
                if ($objUser) {
                    $userRole = $this->Role->where('name', 'pro-user')->first();
                    $objUser->roles()->sync($userRole['id']);
                    return getResponse(1, __('message.added', ['attribute' => 'Pro-User']), $objUser);
                } else {
                    return back()->withInput()->with('error', 'Something went wrong !');
                }
            } else {
                return $this->getResponse(0, __('Payment Failed.', ['attribute' => 'Pro-User']), []);
            }
        } catch (Exception $e) {
            return $this->getResponse(0, __($e->getMessage(), ['attribute' => 'Pro-User']), []);
        }
    }
}