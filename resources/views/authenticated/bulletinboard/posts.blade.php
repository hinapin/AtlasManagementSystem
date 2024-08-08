@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <p><span class="subcategory">{{ $post->subCategories()->first()->sub_category }}</span></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class=""> {{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}"> {{ $post->likes->count() }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}"> {{ $post->likes->count() }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class="m-4">
      <div class="w-45 vh-10 border p-3 post-btn" style="border-radius: 5px;"><a href="{{ route('post.input') }}" class="post-font">投稿</a></div>

      <div class="d-flex-a keyword">
        <form class="search_form" id="postSearchRequest" method="GET" action="{{ route('post.show') }}">
        <input type="text" placeholder="キーワードを検索" class="search_box" name="keyword">
        <button type="submit" class="search_btn">検索</button>
        </form>
      </div>

      <span class="posts-btn">
        <input type="submit" name="like_posts" class="category_btn like_post_btn" value="いいねした投稿" form="postSearchRequest">
        <input type="submit" name="my_posts" class="category_btn my_post_btn" value="自分の投稿" form="postSearchRequest">
      </span>

      <div class="categorytitle">カテゴリー検索</div>
        <ul>
          @foreach($categories as $category)
          <li class="main_categories" category_id="{{ $category->id }}">
            <dt class="categories_conditions categories_accordion">{{ $category->main_category }}</dt>
            <div class="b-color"></div>
                @foreach($category->subcategories as $sub_category)
                  <div class="sub_side_area categories_conditions_inner"><input type="submit" name="category_word" class="sub_side" value="{{ $sub_category->sub_category }}" form="postSearchRequest">
                  <div class="b-color2"></div>
                  </div>
                @endforeach
          </li>
          @endforeach
        </ul>
    </div>
  </div>
</div>
@endsection
