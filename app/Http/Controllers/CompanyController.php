<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\CompanyGallery;
use App\CompanyTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function create()
    {
        try {
            $objCompanyTime = [];
            $categories = Category::where('status', 'active')->get();
            $companyData = Company::where('user_id', auth()->user()->id)->with('companyTime')->first();
            // dd($companyData->images_path);
            $objCompanyTime['monday'] = CompanyTime::where(['day' => 'monday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['tuesday'] = CompanyTime::where(['day' => 'tuesday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['wednesday'] = CompanyTime::where(['day' => 'wednesday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['thursday'] = CompanyTime::where(['day' => 'thursday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['friday'] = CompanyTime::where(['day' => 'friday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['saturday'] = CompanyTime::where(['day' => 'saturday', 'company_id' => $companyData->id])->get();
            $objCompanyTime['sunday'] = CompanyTime::where(['day' => 'sunday', 'company_id' => $companyData->id])->get();
            // dd($objCompanyTime['tuesday']);
            return view('company.create', compact('categories', 'companyData', 'objCompanyTime'));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_name' => 'required',
                    'category' => 'required',
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, $validator->errors());
            } else {
                $objCompany = Company::firstOrNew(['user_id' => auth()->user()->id]);
                $objCompany->company_id = generateUniqueId(Company::class, 'company_id');
                $objCompany->user_id = auth()->user()->id;
                $objCompany->category_id = $request->category;
                $objCompany->name = $request->company_name;
                $objCompany->collect_link = $request->collect_link;
                $objCompany->delivery_link = $request->delivery_link;
                $company_images = [];
                if ($objCompany->save()) {
                    if ($request->company_images) {
                        foreach ($request->company_images as $key => $image) {
                            $file_name = Storage::disk('uploads')->put("companies", $image);
                            // $company_images[] = $file_name;
                            CompanyGallery::updateOrCreate(['company_id' => $objCompany->id, 'image' => $file_name]);
                        }
                        // $objCompany->company_images = implode(',', $company_images);
                    }
                    return getResponse(1, __('message.added', ['attribute' => 'Company Profile']), $objCompany);
                } else {
                    return getResponse(0, 'Something went wrong !');
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function storeAboutUs(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_id' => 'required',
                    'about_us' => 'required',
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, $validator->errors());
            } else {
                $objCompany = Company::find($request->company_id);
                $objCompany->about_us = $request->about_us;
                if ($objCompany->save()) {
                    return getResponse(1, __('message.added', ['attribute' => 'Company Description']), $objCompany);
                } else {
                    return getResponse(0, 'Something went wrong !');
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeReservationLink(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_id' => 'required',
                    'reservation_link' => 'required',
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, $validator->errors());
            } else {
                $objCompany = Company::find($request->company_id);
                $objCompany->reservation_link = $request->reservation_link;
                if ($objCompany->save()) {
                    return getResponse(1, __('message.added', ['attribute' => 'Company Reservation Link']), $objCompany);
                } else {
                    return getResponse(0, 'Something went wrong !');
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeContactDetails(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_id' => 'required',
                    'telephone' => 'numeric',
                    'mobile_no' => 'numeric',
                    'email' => 'email'
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, $validator->errors());
            } else {
                $objCompany = Company::find($request->company_id);
                $objCompany->telephone = $request->telephone;
                $objCompany->mobile_no = $request->mobile_no;
                $objCompany->email = $request->email;
                $objCompany->address = $request->address;
                $objCompany->city = $request->city;
                $objCompany->postal_code = $request->postal_code;
                if ($objCompany->save()) {
                    return getResponse(1, __('message.added', ['attribute' => 'Company Contact Details']), $objCompany);
                } else {
                    return getResponse(0, 'Something went wrong !');
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function storeCompanyTime(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make(
                $request->all(),
                [
                    'company_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return getResponse(0, $validator->errors());
            } else {
                foreach ($request->mon_start_time as $key => $value) {
                    if ($value || $request->mon_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'monday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'monday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->mon_end_time[$key] ? date('H:i:s', strtotime($request->mon_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->tues_start_time as $key => $value) {
                    if ($value || $request->tues_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'tuesday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'tuesday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->tues_end_time[$key] ? date('H:i:s', strtotime($request->tues_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->wednes_start_time as $key => $value) {
                    if ($value || $request->wednes_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'wednesday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'wednesday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->wednes_end_time[$key] ? date('H:i:s', strtotime($request->wednes_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->thurs_start_time as $key => $value) {
                    if ($value || $request->thurs_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'thursday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'thursday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->thurs_end_time[$key] ? date('H:i:s', strtotime($request->thurs_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->fri_start_time as $key => $value) {
                    if ($value || $request->fri_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'friday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'friday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->fri_end_time[$key] ? date('H:i:s', strtotime($request->fri_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->satur_start_time as $key => $value) {
                    if ($value || $request->satur_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'saturday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'saturday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->satur_end_time[$key] ? date('H:i:s', strtotime($request->satur_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                foreach ($request->sun_start_time as $key => $value) {
                    if ($value || $request->sun_end_time[$key]) {
                        $objCompanyTime = CompanyTime::firstOrNew([
                            'id' => $key,
                            'company_id' => $request->company_id,
                            'day' => 'sunday'
                        ]);
                        $objCompanyTime->company_id = $request->company_id;
                        $objCompanyTime->day = 'sunday';
                        $objCompanyTime->opening =  $value ? date('H:i:s', strtotime($value)) : null;
                        $objCompanyTime->closing =  $request->sun_end_time[$key] ? date('H:i:s', strtotime($request->sun_end_time[$key])) : null;
                        $objCompanyTime->save();
                    }
                }
                if ($objCompanyTime) {
                    return getResponse(1, __('message.added', ['attribute' => 'Company Contact Details']), $objCompanyTime);
                } else {
                    return getResponse(0, 'Something went wrong !');
                }
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
}