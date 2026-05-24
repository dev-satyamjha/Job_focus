<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            "name" => "Admin User",
            "email" => "admin@jobyaari.com",
            "password" => bcrypt("password123"),
        ]);

        $cat1 = Category::create([
            "name" => "Admit Card",
            "slug" => "admit-card",
        ]);
        $cat2 = Category::create(["name" => "Result", "slug" => "result"]);

        Blog::create([
            "category_id" => $cat1->id,
            "title" => "SSC CGL Admit Card Out",
            "slug" => "ssc-cgl-admit-card-out-" . time(),
            "short_description" =>
                "Download parameters for the upcoming SSC CGL Tier 1 assessment.",
            "content" =>
                "The complete direct links and step-by-step instructions to get your allocation pass documents.",
            "published_date" => now(),
        ]);

        Blog::create([
            "category_id" => $cat2->id,
            "title" => "UPSC Mains Merit Results Announced",
            "slug" => "upsc-mains-merit-results-announced-" . time(),
            "short_description" =>
                "Check your rollout execution positions inside the certified ledger documents.",
            "content" =>
                "The board commission released direct scorecard authentication panels online across distribution nodes.",
            "published_date" => now(),
        ]);
    }
}
