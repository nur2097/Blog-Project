<?php
namespace App\Traits;

use App\Models\BlogCategory;

trait BlogCategoryTrait
{
    public function blogCategory()
    {
        return $categories = BlogCategory::withCount(['blogs' => function($query){
            $query->where('status', 1);
        }])->where('status', 1)->get();

    }
}
