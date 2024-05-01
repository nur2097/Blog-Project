<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogComment extends Model
{
    use HasFactory;

    function blog() : BelongsTo {
        return $this->belongsTo(Blog::class,'blog_id', 'id');
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function commentLikes() : HasMany{
        return $this->hasMany(UserLikeComment::class, 'comment_id','id');
    }
}
