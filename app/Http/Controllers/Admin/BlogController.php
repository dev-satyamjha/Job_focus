<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with("category")->latest()->paginate(10);
        return view("admin.blogs.index", compact("blogs"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.blogs.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255",
            "category_id" => "required|exists:categories,id",
            "short_description" => "required",
            "content" => "required",
            "published_date" => "required|date",
            "image" => "nullable|image|mimes:jpeg,png,jpg,webp|max:2048",
        ]);

        $data = $request->except("image");
        $data["slug"] = Str::slug($request->title) . "-" . time();
        $data["is_approved"] = true;

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
            ->route("admin.blogs.index")
            ->with("success", "Blog created successfully.");
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view("admin.blogs.edit", compact("blog", "categories"));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            "title" => "required|max:255",
            "category_id" => "required|exists:categories,id",
            "short_description" => "required",
            "content" => "required",
            "published_date" => "required|date",
            "image" => "nullable|image|mimes:jpeg,png,jpg,webp|max:2048",
        ]);

        $data = $request->except("image");

        if ($request->title !== $blog->title) {
            $data["slug"] = Str::slug($request->title) . "-" . time();
        }

        $data["is_approved"] = $request->has("is_approved");

        if ($request->hasFile("image")) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

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
        $blog->update($data);

        return redirect()
            ->route("admin.blogs.index")
            ->with("success", "Blog updated successfully.");
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();

        return redirect()
            ->route("admin.blogs.index")
            ->with("success", "Blog deleted successfully.");
    }
}
