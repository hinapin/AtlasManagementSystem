<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    // 追加・・・・
    // いいねした投稿との紐付け
    public function post(){
        return $this->belongsTo('App\Models\Posts\Post', 'like_post_id');
    }

    // いいねした人との紐付け
    public function user(){
        return $this->belongsTo('App\Models\Users\User', 'like_user_id');
    }
    // ・・・・・・・

    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }
}
