<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $fillable = [
        "category_id",
        "title",
        "slug",
        "image",
        "short_description",
        "content",
        "published_date",
        "is_approved",
        "experience_level",
        "work_model",
        "job_type",
        "sector",
        "tech_stack",
        "application_deadline",
    ];

    protected $casts = [
        "published_date" => "date",
        "application_deadline" => "date",
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
