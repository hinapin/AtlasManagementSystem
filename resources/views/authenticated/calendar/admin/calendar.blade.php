@extends('layouts.sidebar')

@section('content')
<div class="h-100 w-75 m-auto #ECF1F6;">
  <div class="" style="padding: 20px; margin: 20px;background:#FFF;">
    <p style="text-align: center;">{{ $calendar->getTitle() }}</p>
    <p style="">{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
