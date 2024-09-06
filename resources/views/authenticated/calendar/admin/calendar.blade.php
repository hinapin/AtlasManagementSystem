@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto #ECF1F6;">
  <div class="border w-100" style="border-radius:5px; padding: 20px; margin: 40px 30px 10px 30px; background:#FFF;">
    <p style="text-align: center;">{{ $calendar->getTitle() }}</p>
    <p style="">{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
