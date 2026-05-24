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
    ];

    protected $casts = [
        "published_date" => "date",
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
