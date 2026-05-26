<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

// Public Frontend Routes
Route::get("/", [FrontendController::class, "index"])->name("frontend.index");
Route::get("/blogs/filter", [FrontendController::class, "filter"])->name(
    "blogs.filter",
);
Route::get("/blog/{slug}", [FrontendController::class, "show"])->name(
    "frontend.show",
);

Route::get("/dashboard", function () {
    return redirect()->route("admin.blogs.index");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware(["auth", "verified"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::resource("blogs", BlogController::class);
    });

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
});

require __DIR__ . "/auth.php";

Route::get("/live-setup", function () {
    Artisan::call("migrate:fresh", ["--force" => true, "--seed" => true]);
    Artisan::call("storage:link");

    return "Live setup completed successfully! You can now delete this route.";
});

Route::get("/fix-db", function () {
    if (!Schema::hasColumn("blogs", "is_approved")) {
        Schema::table("blogs", function (Blueprint $table) {
            $table->boolean("is_approved")->default(0)->after("slug");
        });
        return "SUCCESS: The 'is_approved' column was added to your database! You can now go create a blog post.";
    }
    return "The column already exists!";
});

Route::get("/fix-db-filters", function () {
    if (!Schema::hasColumn("blogs", "work_model")) {
        Schema::table("blogs", function (Blueprint $table) {
            $table
                ->string("experience_level")
                ->nullable()
                ->after("is_approved");
            $table->string("work_model")->nullable()->after("experience_level");
            $table->string("job_type")->nullable()->after("work_model");
            $table->string("sector")->nullable()->after("job_type");
            $table->string("tech_stack")->nullable()->after("sector");
            $table
                ->date("application_deadline")
                ->nullable()
                ->after("tech_stack");
        });
        return "SUCCESS: 6 new filter columns added to your database!";
    }
    return "The columns already exist!";
});
