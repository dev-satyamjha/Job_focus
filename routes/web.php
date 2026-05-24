<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProfileController;

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

use Illuminate\Support\Facades\Artisan;

Route::get("/live-setup", function () {
    Artisan::call("migrate:fresh", ["--force" => true, "--seed" => true]);
    Artisan::call("storage:link");

    return "Live setup completed successfully! You can now delete this route.";
});
