<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments')->get();
        $categories = MainCategory::with('subCategories')->get();
        // ↓新しいLikeモデルのインスタンスを作成するための文
        $like = new Like;
        $post_comment = new Post;

        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $posts = Post::with('user', 'postComments','subCategories')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhereHas('subCategories', function ($q) use ($keyword) {
                $q->where('sub_category', $keyword);
            })->get();


        }else if($request->category_word){
            $subcategory_word = $request->category_word;
            $posts = Post::with('user','postComments','subCategories')
            ->whereHas('subCategories',function ($q) use ($subcategory_word){
                $q->where('sub_category',$subcategory_word);
            })->get();

            // ddd($posts);


        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        // dd($posts);

        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){

        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
            // 'post_category_id' => $request->post_category_id,
        ]);

        $post->subCategories()->attach($request->post_category_id);



        // post_category_idをビューに渡す
        return redirect()->route('post.show', ['post_category_id' => $request->post_category_id]);
    }

    // 編集ーーーーーー
    public function postEdit(Request $request){

        $request->validate([
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
        ]);

        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }
    // ーーーーーーーー

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    // メインカテゴリー
    public function mainCategoryCreate(Request $request){

        // dd($request->all());

        $request->validate([
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
        ]);


        MainCategory::create([
            'main_category' => $request->main_category_name,
        ]);

        return redirect()->route('post.input');
    }

    // 追加したサブカテゴリー追加メソッド///

    public function subCategoryCreate(Request $request){

        // dd($request->all());

        $request->validate([
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
            'main_category_id' => 'required|exists:main_categories,id',
        ]);

        SubCategory::create([
            'sub_category' => $request->sub_category_name,
            'main_category_id' => $request->main_category_id,
        ]);
        return redirect()->route('sub.category.create');
    }

    //////////////////////////////////////////

    public function commentCreate(Request $request){

        $request->validate([
            'comment' => 'required|string|max:250',
        ]);

        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
