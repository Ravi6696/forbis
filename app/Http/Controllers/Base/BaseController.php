<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BlockedUser;
use App\Models\BlogComment;
use App\Models\Blog;
use App\Models\CardDetail;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyAdvertisement;
use App\Models\CompanyCategory;
use App\Models\CompanyComment;
use App\Models\CompanyGallery;
use App\Models\CompanyTime;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Faq;
use App\Models\FavouriteCompany;
use App\Models\JobApplication;
use App\Models\JobOffer;
use App\Models\Plans;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use App\Models\FaqAnswer;
use App\Models\FaqCategory;
use App\Models\FaqFavourite;
use App\Models\CompanyFollowers;

class BaseController extends Controller
{
    public $Conversation;
    public function __construct()
    {

        $this->Conversation = new Conversation();
        $this->Address = new Address();
        $this->Role = new Role();
        $this->Plans = new Plans();
        $this->BlockedUser = new BlockedUser();
        $this->BlogComment = new BlogComment();
        $this->Blog = new Blog();
        $this->CardDetail = new CardDetail();
        $this->Category = new Category();
        $this->Company = new Company();
        $this->CompanyAdvertisement = new CompanyAdvertisement();
        $this->CompanyComment = new CompanyComment();
        $this->CompanyGallery = new CompanyGallery();
        $this->CompanyTime = new CompanyTime();
        $this->Conversation = new Conversation();
        $this->ConversationMessage = new ConversationMessage();
        $this->Faq = new Faq();
        $this->FavouriteCompany = new FavouriteCompany();
        $this->JobApplication = new JobApplication();
        $this->JobOffer = new JobOffer();
        $this->Subscription = new Subscription();
        $this->User = new User();
        $this->CompanyCategory = new CompanyCategory();
        $this->FaqAnswer = new FaqAnswer();
        $this->FaqCategory = new FaqCategory();
        $this->FaqFavourite = new FaqFavourite();
        $this->CompanyFollowers = new CompanyFollowers();
    }

    function getResponse($code, $message, $data = null)
    {
        return  response()->json([
            'key' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }
}