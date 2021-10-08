<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResearchController extends BaseController
{
    public function index()
    {
        $companies = $this->Company->get();
        return view('research.index', compact('companies'));
    }

    public function getMapArea(Request $request)
    {
        try {
            $companyDetail = $this->Company->where('id',$request->company_id)->first();
            $latitude =  $companyDetail->latitude ?? 0;
            $longitude = $companyDetail->longitude ?? 0;
            $html = view('research.info-window', compact('companyDetail'))->render();
            $result['data'] = ['latitude' => $latitude, 'longitude' => $longitude,'contentString' => $html];
        } catch (Exception $e) {
            $result['key'] = 0;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result);
    }
}