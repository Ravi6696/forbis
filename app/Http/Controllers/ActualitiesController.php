<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActualitiesController extends BaseController
{

    public function actualitiesView()
    {
        $categories = $this->Category->active()->get();
        return view('admin.actualities', compact('categories'));
    }

    public function actualitiesDetail($id)
    {
        $categories = $this->Category->active()->get();
        $blog = $this->Blog->where('id', $id)->first();
        return view('admin.blog-details', compact('blog', 'categories'));
    }

    public function listActualitiesRecent(Request $request)
    {
        try {
            $search_filter = $request->search_filter;
            $category_id = $request->category_id;
            $blogs = $this->Blog->active()
                ->when($search_filter != null, function ($q) use ($search_filter) {
                    $q->where(function ($q) use ($search_filter) {
                        $q->where('title', 'like', '%' . $search_filter . '%');
                        $q->orwhere('sub_title', 'like', '%' . $search_filter . '%');
                    });
                })
                ->when($category_id != null, function ($q) use ($category_id) {
                    $q->where('category_id',  $category_id);
                })
                ->latest()->paginate(3);
            $html =  view('admin.recent-blog-list', compact('blogs'))->render();
            $data['html'] = $html;
            $data['data'] = $blogs;
            return getResponse(1, __('message.details', ['attribute' => 'Blogs']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function listActualitiesComment(Request $request, $blog_id)
    {
        try {
            $blogComments = $this->BlogComment->where('blog_id', $blog_id)->get();
            $html =  view('admin.actualities-comment', compact('blogComments'))->render();
            $data['html'] = $html;
            $data['data'] = $blogComments;
            return getResponse(1, __('message.details', ['attribute' => 'Blogs']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function listActualities(Request $request)
    {
        try {
            $search_filter = $request->search_filter;
            $category_id = $request->category_id;
            $blogs = $this->Blog->active()
                ->when($search_filter != null, function ($q) use ($search_filter) {
                    $q->where(function ($q) use ($search_filter) {
                        $q->where('title', 'like', '%' . $search_filter . '%');
                        $q->orwhere('sub_title', 'like', '%' . $search_filter . '%');
                    });
                })->when($category_id != null, function ($q) use ($category_id) {
                    $q->where('category_id',  $category_id);
                })->get();
            $html =  view('admin.blog-list', compact('blogs'))->render();
            $data['html'] = $html;
            $data['data'] = $blogs;
            return getResponse(1, __('message.details', ['attribute' => 'Blogs']), $data);
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }

    public function actualitiesCreate()
    {
        $categories = $this->Category->active()->get();
        return view('admin.create-actualities', compact('categories'));
    }

    public function storeActualities(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'category' => 'required',
        ]);
        try {
            $id = $request->id;
            $objBlog = $this->Blog->firstOrNew(['id' => $id]);
            $objBlog->user_id = auth()->user()->id;
            $objBlog->title = $request->title;
            $objBlog->sub_title = $request->sub_title;
            $objBlog->category_id = $request->category ?? 1;
            if ($request->attachment) {
                $file_name = Storage::disk('uploads')->put("blogs", $request->attachment);
                $objBlog->attachment = $file_name;
            }
            if ($objBlog->save()) {
                return getResponse(1, __('message.saved', ['attribute' => 'Blog']), $objBlog);
            } else {
                return back()->withInput()->with('error', 'Something went wrong !');
            }
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
    public function saveActualitiesComment(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'blog_id' => 'required'
        ]);
        try {
            $this->BlogComment->updateOrCreate([
                'blog_id' => $request->blog_id,
                'user_id' => auth()->user()->id,
                'comment' => $request->message,
            ]);
            return getResponse(1, __('message.added', ['attribute' => 'Blog Comment']));
        } catch (Exception $e) {
            return getResponse(0, $e->getMessage());
        }
    }
}