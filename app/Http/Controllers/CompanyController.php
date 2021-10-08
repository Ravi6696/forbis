<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\CompanyAdvertisement;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends BaseController
{
    public function createView($type = null)
    {
        $categories = $this->Category->where('status', 'active')->get();
        $objCompanyTime = [];
        $companyData = $this->Company->where('user_id', auth()->user()->id)
            ->first();

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $timestamp = strtotime('next Sunday');
        for ($i = 0; $i < 7; $i++) {
            $companyTime[$days[$i]] = $companyData->companyTime()->where('day', $days[$i])->get();
        }
        $companyData->setAttribute('time', $companyTime);
        if ($type == 'create') {
            $html = view('components.create-company', compact('categories', 'companyData'))->render();
        } else if ($type == 'details') {
            $html = view('components.company-preview', compact('categories', 'companyData'))->render();
        } else {
            $html = view('pro-user.dashboard', compact('categories', 'companyData'))->render();
        }
        return getResponse(1, __('message.details', ['attribute' => 'Company Details']), $html);
    }

    public function updateToggleStatus(Request $request)
    {
        try {
            $action = $request->action == 'true' ? true : false ;
            $toggle = $request->toggle;
            $this->Company->where('user_id',auth()->user()->id)->update([$toggle => $action]);
            return getResponse(1, __('message.updated', ['attribute' => 'Company Updated']), []);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function getCompanyDetails($id = null)
    {
        $categories = $this->Category->where('status', 'active')->get();
        $companyData = $this->Company->when($id != null, function ($q) use ($id) {
            $q->where('id', $id);
        })->when($id == null, function ($q) use ($id) {
            $q->where('user_id', auth()->user()->id);
        })->first();
        if (request()->ajax()) {
            $html = view('company.company-details', compact('companyData', 'categories'))->render();
            return getResponse(1, __('message.details', ['attribute' => 'Company Details']), $html);
        } else {
            return view('company.company-profile', compact('categories', 'companyData'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            // 'category' => 'required',
            'specialization' => 'required|max:30',
            'category_id' => 'required',
            'collect_link' => $request->is_collect ? 'required|active_url' : "",
            'delivery_link' => $request->is_delivery ? 'required|active_url' : "",
        ]);
        try {
            $objCompany = $this->Company->firstOrNew(['user_id' => auth()->user()->id]);
            $objCompany->company_id = generateUniqueId($this->Company, 'company_id');
            $objCompany->user_id = auth()->user()->id;
            $objCompany->name = $request->company_name;
            $objCompany->is_collect = $request->is_collect;
            $objCompany->specialization = $request->specialization;
            $objCompany->is_delivery = $request->is_delivery;
            $objCompany->category_id = $request->category_id;
            $objCompany->collect_link = $request->collect_link;
            $objCompany->delivery_link = $request->delivery_link;
            if ($request->company_logo) {
                $file_name = Storage::disk('uploads')->put("companies", $request->company_logo);
                $objCompany->company_logo = $file_name;
            }
            if ($objCompany->save()) {
                // $this->CompanyCategory->where(['company_id' => $objCompany->id])->whereNotIn('id', array_keys($request->category))->delete();
                // foreach ($request->category as $key => $value) {
                //     $this->CompanyCategory->updateOrCreate(['company_id' => $objCompany->id, 'category_id' => $value]);
                // }
                if ($request->company_images) {
                    foreach ($request->company_images as $key => $image) {
                        $file_name = Storage::disk('uploads')->put("companies", $image);
                        if ($key == 0) {
                            $this->CompanyGallery->updateOrCreate(['company_id' => $objCompany->id, 'image' => $file_name, 'is_featured' => 1]);
                        } else {
                            $this->CompanyGallery->updateOrCreate(['company_id' => $objCompany->id, 'image' => $file_name]);
                        }
                    }
                }
                return getResponse(1, __('message.added', ['attribute' => 'Company Profile']), $objCompany);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function storeAboutUs(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'about_us' => 'required',
        ]);
        try {
            $objCompany = $this->Company->find($request->company_id);
            $objCompany->about_us = $request->about_us;
            if ($objCompany->save()) {
                return getResponse(1, __('message.added', ['attribute' => 'Company Description']), $objCompany);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeReservationLink(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'reservation_link' => 'required|active_url',
        ]);
        try {
            $objCompany = $this->Company->find($request->company_id);
            $objCompany->reservation_link = $request->reservation_link;
            if ($objCompany->save()) {
                return getResponse(1, __('message.added', ['attribute' => 'Company Reservation Link']), $objCompany);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeContactDetails(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'telephone' => 'required|numeric|digits:10',
            'mobile_no' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'postal_code' => 'required|digits:5'
        ]);
        try {
            $objCompany = $this->Company->find($request->company_id);
            $objCompany->telephone = $request->telephone;
            $objCompany->mobile_no = $request->mobile_no;
            $objCompany->email = $request->email;
            $objCompany->latitude = $request->latitude;
            $objCompany->longitude = $request->longitude;

            $objCompany->address()->updateOrCreate(['id' => $request->address_id], [
                'city' => $request->city,
                'address_line_1' => $request->address,
                // 'address_line_2' => $request->address_line_2,
                'postalcode' => $request->postal_code,
            ]);
            if ($objCompany->save()) {
                return getResponse(1, __('message.added', ['attribute' => 'Company Contact Details']), $objCompany);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeCompanyTime(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
        ]);
        try {
            foreach ($request->start_time as $day => $value) {
                $this->CompanyTime->where(['company_id' => $request->company_id, 'day' => $day])->whereNotIn('id', array_keys($value))->delete();
                foreach ($value as $key => $time) {
                    if ($time || $request->end_time[$day][$key]) {
                        $objCompanyTime = $this->CompanyTime->firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => $day
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = $day;
                        $objCompanyTime->opening =  $time ? date('H:i:s', strtotime($time)) : null;
                        $objCompanyTime->closing =  $request->end_time[$day][$key] ? date('H:i:s', strtotime($request->end_time[$day][$key])) : null;
                        $objCompanyTime->save();
                    }
                }
            }
            return getResponse(1, __('message.added', ['attribute' => 'Company Contact Details']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function saveComment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'message' => 'required',
            'company_id' => 'required'
        ]);
        try {
            $this->CompanyComment::updateOrCreate([
                'company_id' => $request->company_id,
                'user_id' => Auth::user()->id,
                'comment' => $request->message,
                'parent_comment_id' => $request->id,
                'is_respond' => 1
            ]);
            return getResponse(1, __('message.added', ['attribute' => 'Comment Reply']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function storeCompany(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'company_name' => 'required',
                'email' => 'required|email',
                'address_line_1' => 'required',
                'address_line_2' => 'required',
                'city' => 'required',
                'postal_code' => 'required|digits:5'
            ],
            [
                'address_line_1.required' => 'this field is required!',
                'address_line_2.required' => 'this field is required!'
            ]
        );
        try {

            $objCompany = $this->Company->firstOrNew(['user_id' => auth()->user()->id]);
            $objCompany->company_id = generateUniqueId($this->Company, 'company_id');
            $objCompany->user_id = auth()->user()->id;
            $objCompany->name = $request->company_name;
            $objCompany->email = $request->email;
            if ($objCompany->save()) {
                $objCompany->address()->updateOrCreate([
                    'city' => $request->city,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'postalcode' => $request->postal_code,
                ]);
                $objUser = $this->User->find(Auth::user()->id);
                $objUser->first_name = $request->first_name;
                $objUser->last_name = $request->last_name;
                $objUser->save();

                return getResponse(1, __('message.added', ['attribute' => 'Company Profile']), $objCompany);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function removeGallery(Request $request)
    {
        $delCardData = $this->CompanyGallery->where('id', $request->id)->delete();
        return getResponse(1, __('message.deleted', ['attribute' => 'Company Gallery']), $delCardData);
    }

    public function addCmpFavourite(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $exists = $this->FavouriteCompany->where(['user_id' => auth()->user()->id, 'company_id' => $request->id])->delete();
            if ($exists) {
                return getResponse(1, __('message.deleted', ['attribute' => 'Company Favourite']));
            } else {
                $this->FavouriteCompany->create([
                    'user_id' => auth()->user()->id,
                    'company_id' => $request->id
                ]);
                return getResponse(1, __('message.saved', ['attribute' => 'Company Favourite']));
            }
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function addCmpFollow(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $exists = $this->CompanyFollowers->where(['user_id' => auth()->user()->id, 'company_id' => $request->id])->delete();
            if ($exists) {
                return getResponse(1, __('message.deleted', ['attribute' => 'Company Follow']));
            } else {
                $this->CompanyFollowers->create([
                    'user_id' => auth()->user()->id,
                    'company_id' => $request->id
                ]);
                return getResponse(1, __('message.saved', ['attribute' => 'Company Follow']));
            }
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }
}
