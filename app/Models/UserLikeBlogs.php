<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLikeBlogs extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    function blog() : BelongsTo {
        return $this->belongsTo(Blog::class,'blog_id', 'id');
    }

    function category() : BelongsTo {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
}
