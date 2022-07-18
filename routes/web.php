<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
    // return view('admin_layouts.main');
});

Route::get('login', 'UserController@login')->name('login');
Route::get('forget-password', 'UserController@forgetPassword')->name('forget-password');
Route::post('send-link-email', 'UserController@sendLinkMAil')->name('send-link-email');
Route::get('reset-password/{token}', 'UserController@resetPassword')->name('reset-password');
Route::post('save-reset-password', 'UserController@saveResetPassword')->name('save-reset-password');
Route::post('do-login', 'UserController@doLogin')->name('do-login');
Route::post('save-user', 'UserController@saveUser')->name('save-user');
Route::get('logout', 'UserController@logout')->name('logout');

Route::get('auth/google', 'UserController@redirectToGoogle')->name('auth-google');
Route::get('auth/google/callback', 'UserController@googleCallback')->name('auth-google-callback');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('create-company', 'CompanyController@create')->name('create-company');
    Route::post('save-company', 'CompanyController@store')->name('save-company');
    Route::post('save-aboutus', 'CompanyController@storeAboutUs')->name('save-aboutus');
    Route::post('save-contactdetails', 'CompanyController@storeContactDetails')->name('save-contactdetails');
    Route::post('save-companytime', 'CompanyController@storeCompanyTime')->name('save-companytime');
    Route::post('save-reservation_link', 'CompanyController@storeReservationLink')->name('save-reservation_link');

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('save-profile', 'ProfileController@saveProfile')->name('save-profile');
});