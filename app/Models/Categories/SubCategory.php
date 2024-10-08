<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
        'post_category_id',
    ];
    public function mainCategory(){
        // リレーションの定義
        return $this->belongsTo('App\Models\Category\mainCategory');
    }

    public function posts(){
        // リレーションの定義
        return $this->belongsToMany('App\Models\Posts\Post','post_id');
    }
}
