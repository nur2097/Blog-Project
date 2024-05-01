<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = ['created_at' => 'datetime'];

    public function getCreatedAttribute($value) : string {

        return date('Y-m-d H:i', strtotime($value));
    }

    function blogs() : HasMany {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }

}
