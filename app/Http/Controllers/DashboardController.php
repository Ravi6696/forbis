<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->with('company')->first();
        if ($user->company) {
            return view('dashboard.index');
        } else {
            return redirect()->route('create-company');
        }
    }
}