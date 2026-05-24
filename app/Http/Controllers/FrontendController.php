<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $blogs = Blog::with("category")
            ->where("is_approved", true)
            ->latest("published_date")
            ->paginate(9);

        return view("welcome", compact("blogs", "categories"));
    }

    public function filter(Request $request)
    {
        $categories = Category::all();

        $query = Blog::with("category")->where("is_approved", true);

        if ($request->filled("search")) {
            $query->where(function ($q) use ($request) {
                $q->where(
                    "title",
                    "like",
                    "%" . $request->search . "%",
                )->orWhere("content", "like", "%" . $request->search . "%");
            });
        }

        if ($request->filled("category")) {
            $query->where("category_id", $request->category);
        }

        $blogs = $query->latest("published_date")->paginate(9);

        return view("welcome", compact("blogs", "categories"));
    }

    public function show($slug)
    {
        $blog = Blog::with("category")
            ->where("slug", $slug)
            ->where("is_approved", true)
            ->firstOrFail();

        return view("frontend.show", compact("blog"));
    }
}
