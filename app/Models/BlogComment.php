<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlogComment extends Model
{
    protected $guarded = [];

    function blog() : BelongsTo {
        return $this->belongsTo(Blog::class,'blog_id', 'id');
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function parent() : HasOne {
        return $this->hasOne(BlogComment::class,'id', 'parent_id');
    }

    public function children() : HasMany {
        return $this->hasMany(BlogComment::class,'parent_id', 'id');
    }

    public function commentLikes() : HasMany {
        return $this->hasMany(UserLikeComment::class,'comment_id','id');
    }
}
