<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends BaseController
{
    public function index()
    {
        return redirect('apropos');
    }

    public function aProposView()
    {
        try {
            $categories = $this->Category->active()->get();
            return view('admin.apropos', compact('categories'));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function faqList(Request $request)
    {
        try {
            $search_filter = $request->search_filter;
            $callback = function ($q) use ($search_filter) {
                $q->where('question', 'like', '%' . $search_filter . '%');
            };
            $categories = $this->Category->active()
                ->whereHas('faqCategory.faqs', $callback)
                ->with(['faqCategory.faqs' => $callback])
                ->get();

            $html =  view('admin.faq-list', compact('categories'))->render();
            $data['html'] = $html;
            $data['data'] = $categories;
            return getResponse(1, __('message.details', ['attribute' => 'Categories']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function clientsView()
    {
        return view('admin.clients');
    }

    public function messagesView()
    {
        return view('admin.messages');
    }

    public function categoryView()
    {
        try {
            $categories = $this->Category->active()->orderBy('id', 'DESC')->pluck('title', 'id');
            return view('admin.category', compact('categories'));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function categoryList(Request $request)
    {
        try {
            $categories = $this->Category->active()->whereParentCategoryId(null)->latest()->get();
            $html =  view('admin.category_box', compact('categories'))->render();
            $data['html'] = $html;
            $data['data'] = $categories;
            return getResponse(1, __('message.details', ['attribute' => 'Categories']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        try {
            $id = $request->id;
            $title = $request->title;
            $title = $id ? explode('-', $title) : [$request->title];
            foreach ($title as $key => $cat) {
                $objCategory = $this->Category->firstOrNew(['title' => $cat]);
                $objCategory->title = $cat;
                $objCategory->parent_category_id = $id;
                $objCategory->save();
            }
            if ($objCategory) {
                return getResponse(1, __('message.saved', ['attribute' => 'Category']), $objCategory);
            } else {
                return back()->withInput()->with('error', 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function statisticesView()
    {
        return view('admin.statistices');
    }
}