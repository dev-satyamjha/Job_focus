<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $blogs = Blog::with("category")->latest()->get();
        $categories = Category::all();
        return view("frontend.index", compact("blogs", "categories"));
    }

    public function filter(Request $request)
    {
        $query = Blog::with("category");

        if ($request->filled("category")) {
            $query->where("category_id", $request->category);
        }

        if ($request->filled("date")) {
            $query->whereDate("published_date", $request->date);
        }

        if ($request->filled("search")) {
            $query->where("title", "like", "%" . $request->search . "%");
        }

        $blogs = $query->latest()->get();

        return view("frontend.partials.blog-list", compact("blogs"))->render();
    }

    public function show($slug)
    {
        $blog = Blog::with("category")->where("slug", $slug)->firstOrFail();
        return view("frontend.show", compact("blog"));
    }
}
