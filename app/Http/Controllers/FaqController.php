<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Auth;

class FaqController extends BaseController
{
    public function saveFaqQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'category' => 'required',
            'description' => 'required',
            // 'attachment' => 'required',
        ]);
        try {
            $objFaq = $this->Faq->firstOrNew(['id' => $request->faq_id]);
            $objFaq->user_id = auth()->user()->id;
            $objFaq->question = $request->question;
            $objFaq->description = $request->description;
            $objFaq->is_admin = Auth::user()->hasRole('admin') ? '1' : '0';
            // dd($objFaq);
            if ($request->attachment) {
                $file_name = Storage::disk('uploads')->put("companies", $request->attachment);
                $objFaq->attachment = $file_name;
            }
            $objFaq->save();
            foreach ($request->category as $key => $value) {
                $this->FaqCategory->updateOrCreate(['id' => $request->faq_cat_id], [
                    'category_id' => $value,
                    'faq_id' => $objFaq->id
                ]);
            }
            return getResponse(1, __('message.saved', ['attribute' => 'Faq']));
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function saveFaqAnswer(Request $request)
    {
        $request->validate([
            'answer' => 'required'
        ]);
        try {
            $faqAns = $this->FaqAnswer->updateOrCreate(['id' => $request->ans_id], [
                'user_id' => auth()->user()->id,
                'faq_id' => $request->faq_id,
                'answer' => $request->answer
            ]);
            return getResponse(1, __('message.saved', ['attribute' => 'Faq']), $faqAns);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function addFaqFavourite(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $exists = $this->FaqFavourite->where(['user_id' => auth()->user()->id, 'faq_id' => $request->id])->delete();
            if ($exists) {
                return getResponse(1, __('message.deleted', ['attribute' => 'Faq Favourite']));
            } else {
                $this->FaqFavourite->create([
                    'user_id' => auth()->user()->id,
                    'faq_id' => $request->id
                ]);
                return getResponse(1, __('message.saved', ['attribute' => 'Faq Favourite']));
            }
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function getFaqList(Request $request)
    {
        try {
            $category_id  = $request->categories;
            $search_filter  = $request->search_filter;
            $faqs = $this->Faq->when($category_id != '' && $category_id != null, function ($q) use ($category_id) {
                $q->whereHas('category', function ($q) use ($category_id) {
                    $q->where('category_id', $category_id);
                });
            })->when($search_filter != '', function ($q) use ($search_filter) {
                $q->where(function ($q) use ($search_filter) {
                    $q->Where('question', 'like', '%' . $search_filter . '%')
                        ->orWhere('description', 'like', '%' . $search_filter . '%');
                });
            })->paginate(2);
            $html = view('pro-user.forum-list', compact('faqs'))->render();
            $data['faqs'] = $faqs;
            $data['html'] = $html;
            return getResponse(1, __('message.details', ['attribute' => 'Faqs']), $data);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function forum()
    {
        try {
            $faqs = $this->Faq->paginate(2);
            $categories = $this->Category->active()->pluck('title', 'id');
            return view('pro-user.forum', compact('categories', 'faqs'));
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function filterForums(Request $request)
    {
        try {
            $category_id  = $request->categories;
            $search_filter  = $request->search_filter;
            $categories = $this->Category->active()->pluck('title', 'id');
            $myFavourites = $this->FaqFavourite::auth()
                ->when($category_id != '', function ($q) use ($category_id) {
                    $q->whereHas('faq.category', function ($q) use ($category_id) {
                        $q->where('category_id', $category_id);
                    });
                })
                ->when($search_filter != '', function ($q) use ($search_filter) {
                    $q->whereHas('faq', function ($q) use ($search_filter) {
                        $q->where(function ($q) use ($search_filter) {
                            $q->Where('question', 'like', '%' . $search_filter . '%')
                                ->orWhere('description', 'like', '%' . $search_filter . '%');
                        });
                    });
                })
                ->get();
            $html = view('components.pro-user.filter-faq', compact('categories', 'myFavourites', 'category_id', 'search_filter'))->render();
            return getResponse(1, __('message.details', ['attribute' => 'Faqs']), $html);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

    public function createForum()
    {
        try {
            $categories = $this->Category->active()->pluck('title', 'id');
            return view('pro-user.create-forum', compact('categories'));
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }
}