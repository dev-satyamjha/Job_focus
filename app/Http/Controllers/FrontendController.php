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
                $q->where("title", "like", "%" . $request->search . "%")
                    ->orWhere("content", "like", "%" . $request->search . "%")
                    ->orWhere(
                        "tech_stack",
                        "like",
                        "%" . $request->search . "%",
                    );
            });
        }

        if ($request->filled("category")) {
            $query->where("category_id", $request->category);
        }
        if ($request->filled("experience_level")) {
            $query->where("experience_level", $request->experience_level);
        }
        if ($request->filled("work_model")) {
            $query->where("work_model", $request->work_model);
        }
        if ($request->filled("job_type")) {
            $query->where("job_type", $request->job_type);
        }
        if ($request->filled("sector")) {
            $query->where("sector", $request->sector);
        }

        if (
            $request->filled("urgency") &&
            $request->urgency == "closing_soon"
        ) {
            $query
                ->whereNotNull("application_deadline")
                ->whereBetween("application_deadline", [
                    now(),
                    now()->addDays(7),
                ]);
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

    public function createPost()
    {
        $categories = \App\Models\Category::all();
        return view("frontend.submit", compact("categories"));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|max:255",
            "category_id" => "required|exists:categories,id",
            "short_description" => "required",
            "content" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
        ]);

        $blog = new \App\Models\Blog($validated);
        $blog->slug =
            \Illuminate\Support\Str::slug($request->title) . "-" . time();
        $blog->is_approved = false; // FORCES ADMIN APPROVAL
        $blog->published_date = now();

        if ($request->hasFile("image")) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path("uploads"), $imageName);
            $blog->image = "uploads/" . $imageName;
        }

        $blog->save();

        return redirect()
            ->route("frontend.index")
            ->with(
                "success",
                "Your post has been submitted and is waiting for admin approval!",
            );
    }
}
