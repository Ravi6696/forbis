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

Route::get('/login', function () {
    return redirect('login');
});

Route::get('/', 'UserController@login')->name('login');
Route::get('forget-password', 'UserController@forgetPassword')->name('forget-password');
Route::post('send-link-email', 'UserController@sendLinkMAil')->name('send-link-email');
Route::get('reset-password/{token}', 'UserController@resetPassword')->name('reset-password');
Route::post('save-reset-password', 'UserController@saveResetPassword')->name('save-reset-password');
Route::post('do-login', 'UserController@doLogin')->name('do-login');
Route::post('save-user', 'UserController@saveUser')->name('save-user');
Route::get('logout', 'UserController@logout')->name('logout');

// Social Login routes
Route::get('auth/google', 'UserController@redirectToGoogle')->name('auth-google');
Route::get('auth/google/callback', 'UserController@googleCallback')->name('auth-google-callback');

// Pro-user Route
Route::group(['middleware' => 'pro-user', 'prefix' => 'pro-user'], function () {
    // Dashboard routes
    Route::get('dashboard', 'DashboardController@proDashboard')->name('pro.dashboard');
    Route::post('remove-invoice', 'DashboardController@removeInvoice')->name('remove-invoice');
    Route::post('remove-application', 'DashboardController@removeApplication')->name('remove-application');
    Route::post('remove-category', 'DashboardController@removeCategory')->name('remove-category');

    //  Company routes
    Route::get('get-company-details', 'CompanyController@getCompanyDetails')->name('get-company-details');
    Route::get('company-details/{id?}', 'CompanyController@getCompanyDetails')->name('company-details');
    Route::get('view-create-company/{type?}', 'CompanyController@createView')->name('view-create-company');
    Route::post('update-toggle-status', 'CompanyController@updateToggleStatus')->name('update-toggle-status');
    Route::post('save-company', 'CompanyController@store')->name('save-company');
    Route::post('save-aboutus', 'CompanyController@storeAboutUs')->name('save-aboutus');
    Route::post('save-contactdetails', 'CompanyController@storeContactDetails')->name('save-contactdetails');
    Route::post('save-companytime', 'CompanyController@storeCompanyTime')->name('save-companytime');
    Route::post('save-reservation_link', 'CompanyController@storeReservationLink')->name('save-reservation_link');
    Route::post('save-comment', 'CompanyController@saveComment')->name('save-comment');
    Route::post('remove-gallery', 'CompanyController@removeGallery')->name('remove-gallery');

    // Announces Routes
    // Route::get('get-ad', 'AnnouncesController@getAd')->name('get-ad');
    Route::get('annonces', 'AnnouncesController@annoncesView')->name('pro-annonces');
    Route::post('remove-ad', 'AnnouncesController@removeAnnounce')->name('remove-ad');
    Route::post('filter-announces', 'AnnouncesController@filterAnnounces')->name('pro.filter-announces');
    Route::post('save-ad', 'AnnouncesController@saveAd')->name('save-ad');
    Route::post('pay-adamount', 'AnnouncesController@payAdAmount')->name('pay-adamount');
    Route::post('filter-by-category', 'AnnouncesController@filterByCategory')->name('filter-by-category');

    // Forum Routes
    Route::get('forum', 'FaqController@forum')->name('forum');
    Route::get('create-forum', 'FaqController@createForum')->name('create-forum');
    Route::post('get-faqs-list', 'FaqController@getFaqList')->name('get-faqs-list');
    // Route::post('save-faq-question', 'FaqController@saveFaqQuestion')->name('save-faq-question');
    Route::post('save-faq-answer', 'FaqController@saveFaqAnswer')->name('save-faq-answer');
    Route::post('add-faq-favourite', 'FaqController@addFaqFavourite')->name('add-faq-favourite');
    Route::post('filter-forums', 'FaqController@filterForums')->name('filter-forums');

    // Messages Routes
    Route::get('pro-messages', 'ChatController@messageView')->name('pro-messages');
    Route::get('chats', 'ChatController@chatList')->name('pro-chat');
});

// Admin Route
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    //create actualities
    Route::get('create-actualities', 'ActualitiesController@actualitiesCreate')->name('admin.create-actualities');
    Route::post('save-actualities', 'ActualitiesController@storeActualities')->name('admin.save-actualities');

    //Category
    Route::get('category', 'AdminController@categoryView')->name('admin.category');
    Route::get('category-list', 'AdminController@categoryList')->name('admin.category-list');
    Route::post('save-category', 'AdminController@saveCategory')->name('admin.save-category');

    Route::get('clients', 'AdminController@clientsView')->name('admin.clients');
    Route::get('messages', 'AdminController@messagesView')->name('admin.messages');
    Route::get('statistices', 'AdminController@statisticesView')->name('admin.statistices');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('share-to-linkedin', 'AnnouncesController@shareToLinkedin')->name('share-to-linkedin');
    Route::get('announces', 'UserController@announces')->name('announces');
    Route::post('filter-announces', 'UserController@filterAnnounces')->name('filter-announces');
    Route::post('fav-announces', 'UserController@favAnnounces')->name('fav-announces');

    // Company Details Route
    Route::get('company-details/{id?}', 'CompanyController@getCompanyDetails')->name('company-preview');

    // User Profile route
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('save-profile', 'ProfileController@saveProfile')->name('save-profile');
    Route::group(['prefix' => 'pro-user'], function () {
        Route::post('store-company', 'CompanyController@storeCompany')->name('store-company');
        Route::post('store-card', 'AnnouncesController@storeCard')->name('store-card');
    });

    Route::post('send', 'ProfileController@send')->name('send-message');
    Route::get('get-conversation', 'ProfileController@getConversation')->name('get-conversation');
    Route::post('delete-conversation', 'ProfileController@deleteConversation')->name('delete-conversation');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('become-pro-user', 'UserController@becomeProUser')->name('become-pro-user');

    // Recrutement routes
    Route::get('recrutement', 'JobRecrutementController@recrutement')->name('recrutement');
    Route::get('create-job-offer', 'JobRecrutementController@createJobOffer')->name('create-job-offer');
    Route::post('job-apply', 'JobRecrutementController@jobApply')->name('job-apply');
    Route::post('job-delete', 'JobRecrutementController@deleteJob')->name('job-delete');
    Route::post('save-job-application', 'JobRecrutementController@saveJobApplication')->name('save-job-application');
    Route::post('save-job-offer', 'JobRecrutementController@saveJobOffer')->name('save-job-offer');
    Route::post('filter-offers', 'JobRecrutementController@filterOffers')->name('filter-offers');
    Route::post('candidat', 'JobRecrutementController@candidat')->name('candidat');
    Route::post('filter-applications', 'JobRecrutementController@filterApplications')->name('filter-applications');

    // Card routes
    Route::post('save-card', 'CardController@saveCard')->name('save-card');
    Route::post('edit-card', 'CardController@editCard')->name('edit-card');
    Route::post('delete-card', 'CardController@deleteCard')->name('delete-card');
    Route::post('announces-card', 'CardController@getAnnouncesCardList')->name('announces-card');
    Route::post('payment-card', 'CardController@getDasboardCardList')->name('payment-card');

    Route::post('save-company-details', 'CompanyController@storeCompany')->name('save-company-details');
    Route::post('add-cmp-favourite', 'CompanyController@addCmpFavourite')->name('add-cmp-favourite');
    Route::post('add-cmp-follow', 'CompanyController@addCmpFollow')->name('add-cmp-follow');

    // Save Faq Question
    Route::post('save-faq-question', 'FaqController@saveFaqQuestion')->name('save-faq-question');

    Route::get('apropos', 'AdminController@aProposView')->name('apropos');
    Route::post('faq-list', 'AdminController@faqList')->name('faq-list');
    //get announce detail
    Route::get('get-ad', 'AnnouncesController@getAd')->name('get-ad');
    Route::get('announces', 'UserController@announces')->name('announces');

    //Blogs
    Route::get('actualities', 'ActualitiesController@actualitiesView')->name('actualities');
    Route::get('actuality-detail/{id}', 'ActualitiesController@actualitiesDetail')->name('actuality-detail');
    Route::post('list-actualities', 'ActualitiesController@listActualities')->name('list-actualities');
    Route::post('list-actualities-recent', 'ActualitiesController@listActualitiesRecent')->name('list-actualities-recent');
    Route::get('list-actualities-comment/{blog_id}', 'ActualitiesController@listActualitiesComment')->name('list-actualities-comment');
    Route::post('save-actualities-comment', 'ActualitiesController@saveActualitiesComment')->name('save-actualities-comment');

    // recherche
    Route::get('recherche', 'ResearchController@index')->name('recherche');
    Route::post('get-map-area', 'ResearchController@getMapArea')->name('get-map-area');
});

Broadcast::routes();