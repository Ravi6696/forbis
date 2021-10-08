<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        // dd(request()->user()->subscribed('default'));
        if (Auth::user()->hasRole('pro-user')) {
            return redirect('pro-user/dashboard');
        } else  if (Auth::user()->hasRole('admin')) {
            return redirect('admin/dashboard');
        } else if (Auth::user()->hasRole('user')) {
            return redirect('announces');
        }
    }

    public function proDashboard()
    {
        $companyData = $this->Company->where('user_id', auth()->user()->id)
            ->with('companyTime', 'user', 'companyComments.childComment', 'companyAdvertisement', 'companyCategory.category')
            ->first();
        $categories = $this->Category->active()->get();
        return view('pro-user.dashboard', compact('companyData', 'categories'));
    }

    public function removeInvoice(Request $request)
    {
        try {
            $this->CompanyAdvertisement->where('id', $request->id)->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Company Advertisement']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function removeApplication(Request $request)
    {
        try {
            $this->JobApplication->where('id', $request->id)->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Job Application']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function removeCategory(Request $request)
    {
        try {
            $id = $request->id;
            $this->CompanyCategory->where('id', $id)->delete();
            return getResponse(1, __('message.deleted', ['attribute' => 'Company Category']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
}