<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserBlogController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view("user.blogs.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255",
            "category_id" => "required|exists:categories,id",
            "short_description" => "required",
            "content" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg,webp|max:2048",
        ]);

        $data = $request->except("image");

        $data["slug"] = Str::slug($request->title) . "-" . time();

        $data["is_approved"] = false;
        $data["published_date"] = now();

        if ($request->hasFile("image")) {
            $imageName =
                time() .
                "-" .
                uniqid() .
                "." .
                $request->file("image")->extension();
            $request
                ->file("image")
                ->move(public_path("uploads/blogs"), $imageName);

            $data["image"] = "uploads/blogs/" . $imageName;
        }

        Blog::create($data);

        return redirect()
            ->route("dashboard")
            ->with(
                "success",
                "Your post was submitted successfully! It is currently pending admin approval.",
            );
    }
}
