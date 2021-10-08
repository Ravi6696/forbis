<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\Category;
use App\Models\CompanyAdvertisement;
use App\Models\JobApplication;
use App\Models\JobOffer;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
            return redirect()->route('login')->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $userdata = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (Auth::attempt($userdata)) {
                $request->session()->flash('success', "User Login Successfully !");
                if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
                    return redirect()->route('apropos');
                }
                return redirect()->route('pro.dashboard');
            } else {
                return redirect()->route('login')->withErrors('Invalid Username Or Password');
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

    public function announces()
    {
        $categories = Category::active()->pluck('title', 'id');
        $companyAdvertisement = CompanyAdvertisement::latest()->first();
        if ($companyAdvertisement) {
            $companyAdvertisement->is_view = true;
        }
        return view('user.announces', compact('categories', 'companyAdvertisement'));
    }

    public function filterAnnounces(Request $request)
    {
        try {
            $category_id  = $request->categories;
            $search_filter  = $request->search_filter;
            $announces = CompanyAdvertisement::active()
                ->when($category_id != '', function ($q) use ($category_id) {
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
            return getResponse(1, __('message.details', ['attribute' => 'Faqs']), $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function favAnnounces(Request $request)
    {
        try {
            $category_id  = $request->categories;
            $search_filter  = $request->search_filter;
            $announces = CompanyAdvertisement::active()
                ->whereHas('favourites', function ($q) {
                    $q->where('user_id', auth()->user()->id);
                })
                ->get();
            $html = view('user.announce-list', compact('announces'))->render();
            return getResponse(1, __('message.details', ['attribute' => 'Faqs']), $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function becomeProUser()
    {
        return view('pro-user.become-pro-user');
    }
}