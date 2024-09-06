@extends('layouts.sidebar')
@section('content')
<div class="w-100" style="align-items:center; justify-content:center;">
  <div class="w-100 border" style="padding:60px 120px 40px 120px;" >
    <div class="m-auto w-80 border" style="background:#FFF; border-radius:5px; ">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      {!! $calendar->render() !!}
      <div class="w-100 adjust-table-btn text-right" style="margin-right:0px;">
        <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" style="margin:5px 20px 10px 0px;" onclick="return confirm('登録してよろしいですか？')">
      </div>
    </div>
  </div>
</div>
@endsection
