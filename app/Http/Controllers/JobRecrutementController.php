<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;

class JobRecrutementController extends BaseController
{
    public function recrutement()
    {
        $offers = $this->JobOffer->get();
        return view('user.recrutement', compact('offers'));
    }

    public function createJobOffer(Request $request)
    {
        try {
            $companyData = $this->Company->where('user_id', auth()->user()->id)
                ->first();
            $jobOffer = [];
            if ($request->id != null) {
                $id = $request->id;
                $jobOffer = $this->JobOffer->find($id);
            }
            $address = $companyData ? $companyData->address : [];
            $html = view('pro-user.create-job-offer', compact('address', 'jobOffer'))->render();
            return getResponse(1, null, $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function jobApply(Request $request)
    {
        try {
            $id = $request->id;
            $jobOffer = $this->JobOffer->find($id);
            $action = $request->action;
            if ($action == 'job-apply') {
                $html = view('user.apply-job', compact('jobOffer'))->render();
            } else {
                $html = view('pro-user.job-detail', compact('jobOffer'))->render();
            }
            return getResponse(1, null, $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function deleteJob(Request $request)
    {
        try {
            $id = $request->id;
            $delJobOffer = $this->JobOffer->where('id', $id)->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Job Offer']), $delJobOffer);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function saveJobApplication(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address_line_1' => 'required',
            'address_line_2' => "required",
            'city' => "required",
            'contact_no' => 'required|numeric|digits:10',
            'postalcode' => "required|numeric|digits:5",
            'cv' => "required",
            'cover_letter' => "required"
        ]);
        try {
            $objJobApp = $this->JobApplication->firstOrNew(['id' => $request->id]);
            $objJobApp->job_offer_id  = $request->job_offer_id;
            $objJobApp->user_id = auth()->user()->id;
            $objJobApp->first_name = $request->first_name;
            $objJobApp->last_name = $request->last_name;
            $objJobApp->email = $request->email;
            $objJobApp->contact_no = $request->contact_no;
            if ($request->cv) {
                $file_name = Storage::disk('uploads')->put("companies", $request->cv);
                $objJobApp->cv_file = $file_name;
            }
            if ($request->cover_letter) {
                $file_name = Storage::disk('uploads')->put("companies", $request->cover_letter);
                $objJobApp->cover_letter = $file_name;
            }
            if ($request->other) {
                $file_name = Storage::disk('uploads')->put("companies", $request->other);
                $objJobApp->other_docs = $file_name;
            }
            if ($objJobApp->save()) {
                $objJobApp->address()->updateOrCreate([
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'city' => $request->city,
                    'postalcode' => $request->postalcode,
                ]);
                return getResponse(1, __('message.added', ['attribute' => 'Job Application']), $objJobApp);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function saveJobOffer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => "required",
            'city' => "required",
            'postalcode' => "required",
            'contract_type' => "required",
            'pace' => "required",
            'publication_date' => "required",
            'description' => "required",
            'presentation' => "required",
            'profile_sought' => "required"
        ]);
        try {
            $objJobOffer = $this->JobOffer->firstOrNew(['id' => $request->jobOffer_id]);
            $objJobOffer->company_id = auth()->user()->company->id;
            $objJobOffer->user_id = auth()->user()->id;
            $objJobOffer->name = $request->name;
            $objJobOffer->contract_type = $request->contract_type;
            $objJobOffer->pace = $request->pace;
            $objJobOffer->publication_date = Carbon::parse($request->publication_date)->format('Y-m-d');
            $objJobOffer->description = $request->description;
            $objJobOffer->presentation = $request->presentation;
            $objJobOffer->profile_sought = $request->profile_sought;

            if ($objJobOffer->save()) {
                $objJobOffer->company->address()->updateOrCreate([
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'city' => $request->city,
                    'postalcode' => $request->postalcode,
                ]);
                return getResponse(1, __('message.added', ['attribute' => 'Job Offer']), $objJobOffer);
            } else {
                return getResponse(0, 'Something went wrong !');
            }
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function filterOffers(Request $request)
    {
        $type = $request->type;
        $jobName = $request->jobName;
        $jobLocation = $request->jobLocation;
        $jobDate = $request->jobDate;
        $contract_type = $request->contract_type;
        $pace = $request->pace;
        // dd($type);
        $offers = $this->JobOffer->when($type == 'recruitment', function ($q) {
            $q->auth();
        })
            ->when($jobName, function ($q) use ($jobName) {
                $q->where('name', 'LIKE', '%' . $jobName . '%');
            })
            ->when($jobLocation, function ($q) use ($jobLocation) {
                $q->whereHas('address', function ($q) use ($jobLocation) {
                    $q->where(function ($q) use ($jobLocation) {
                        $q->orWhere('address_line_1', 'LIKE', '%' . $jobLocation . '%');
                        $q->orWhere('address_line_2', 'LIKE', '%' . $jobLocation . '%');
                        $q->orWhere('city', 'LIKE', '%' . $jobLocation . '%');
                        $q->orWhere('postalcode', 'LIKE', '%' . $jobLocation . '%');
                    });
                });
            })
            ->when($jobDate, function ($q) use ($jobDate) {
                $q->where('publication_date', Carbon::parse($jobDate)->format('Y-m-d'));
            })
            ->when($contract_type, function ($q) use ($contract_type) {
                $q->whereIn('contract_type', $contract_type);
            })
            ->when($pace, function ($q) use ($pace) {
                $q->whereIn('pace', $pace);
            })
            ->get();
        $html = view('user.offers-list', compact('offers', 'type'))->render();
        return getResponse(1, null, $html);
    }

    // public function candidat()
    // {
    //     $offers = $this->JobOffer->get();
    //     $html = view('user.candidat', compact('offers'))->render();
    //     return getResponse(1, null, $html);
    // }

    // public function filterApplications()
    // {
    //     $offers = $this->JobOffer->get();
    //     $html = view('user.application-list', compact('applications'))->render();
    //     return getResponse(1, null, $html);
    // }
}