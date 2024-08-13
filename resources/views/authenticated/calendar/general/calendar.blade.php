@extends('layouts.sidebar')

@section('content')
<div class="" style="background:#ECF1F6;">
  <div class="border  m-auto pt-5 pb-5" style="border-radius:5px; background:#ECF1F6;">
    <div class="w-75 m-auto border" style="border-radius:5px; background:#FFF; padding: 10px;">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary reserve" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
@endsection
