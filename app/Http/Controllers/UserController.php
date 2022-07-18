<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    public function doLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $userdata = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (Auth::attempt($userdata)) {
                $request->session()->flash('success', "User Login Successfully !");
                return redirect()->route('dashboard');
            } else {
                return Redirect::to('login')->withErrors('Invalid Username Or Password');
            }
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile'])
            ->with(["access_type" => "offline"])
            ->redirect();
    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $checkUser = User::where('email', $user->email)->first();
            $update_data = [
                'name'   => $user->name,
                'email'  => $user->email,
                'email_verified_at' => date('Y-m-d'),
                'status' => 'active',
            ];
            if ($checkUser && $checkUser['profile_photo_path'] == '') {
                $update_data['profile_photo_path'] = $user->avatar;
            }
            $existingUser = User::updateOrCreate(
                [
                    'email'   => $user->email
                ],
                $update_data
            );
            if ($user->refreshToken) {
                $existingUser->update(['google_id' => $user->refreshToken]);
            }
            $existingUser->assignRole('user');
            auth()->login($existingUser, true);
            return redirect()->to('dashboard');
        } catch (Exception $e) {
            Log::debug($e);
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('login');
    }

    public function forgetPassword()
    {
        return view('forget_password');
    }

    public function sendLinkMAil(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        $objUser = User::where('email', $request->email)->first();
        $objUser->remember_token = $token;
        $objUser->save();
        Mail::send('emails.forget_password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function resetPassword($token)
    {
        return view('reset_password', ['token' => $token]);
    }

    public function saveResetPassword(Request $request)
    {
        $request->validate([
            'remember_token' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password'
        ]);
        // dd($request->remember_token);
        $objUser = User::where([
            'remember_token' => $request->remember_token
        ])->first();

        if (!$objUser) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        // dd($objUser);
        $objUser->password = Hash::make($request->password);
        $objUser->save();
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password'
        ]);
        // dd($request->all());
        $objUser = User::firstOrNew(['email' => $request->email]);
        $objUser->email = $request->email;
        $objUser->first_name = $request->user_name;
        $objUser->password = Hash::make($request->password);
        $objUser->save();

        if ($objUser) {
            $objUser->assignRole('user');
            return redirect()->route('login')->with('success', 'User registered Successfully !');
        } else {
            return back()->withInput()->with('error', 'Something went wrong !');
        }
    }

    public function index()
    {
        return view('dashboard.index');
    }
}