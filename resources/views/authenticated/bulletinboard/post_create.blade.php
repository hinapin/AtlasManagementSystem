@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}"></optgroup>
        <!-- サブカテゴリー表示 -->

        @endforeach
      </select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
  @can('admin')
  <div class="w-900 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="category1">
        <form id="mainCategoryRequest" action="{{ route('main.category.create') }}" method="POST">
          @csrf
          <p class="m-0">メインカテゴリー</p>
          <input type="text" class="w-100 category_a" name="main_category_name">
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0 category_a">
        </form>
      </div>
      <!-- サブカテゴリー追加 -->
      <div class="">
        <form id="mainCategoryRequest" action="{{ route('sub.category.create') }}" method="POST">
          @csrf
          <p class="m-0">サブカテゴリー</p>
          <input type="text" class="w-100 category_a" name="sub_category_name">

        <!-- 追加したとこ・・・・・ -->
          <select class="w-100 category_a" form="postCreate" name="post_category_id">
          @foreach($main_categories as $main_category)
          <optgroup><option label="{{ $main_category->main_category }}"></option>
          </optgroup>
          <!-- メインカテゴリー表示 -->
          @endforeach
          </select>
          <!-- ・・・・・・・・・・・ -->
          <input type="submit" value="追加" class="w-100 btn btn-primary p-0 category_a" form="mainCategoryRequest">
        </form>
      </div>
    </div>
  </div>
  @endcan
</div>
@endsection
