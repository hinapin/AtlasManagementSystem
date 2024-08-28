@extends('layouts.sidebar')

@section('content')
<div class="" style="background:#ECF1F6;">
  <div class="m-auto pt-5 pb-5" style="border-radius:5px; background:#ECF1F6;">
    <div class="w-75 m-auto border" style="border-radius:5px; background:#FFF; padding: 10px;">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary reserve" value="予約する" form="reserveParts" onclick="return confirm('本当に登録しますか？')">
    </div>
  </div>
</div>

<!-- モーダル -->
<div class="modal js-modal">
  <div class="modal__bg"></div>
  <div class="modal__content">
    <form action="{{ route('calendar.general.cancel') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <!-- 予約日 -->
          <p id="reserveDate"></p>
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <!-- 予約時間　場所 -->
          <p id="reserveTime">
          <p id="reserveLocation"></p>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="reserve-modal-hidden" name="reserve_date" value="">
          <input type="hidden" class="reserve-modal-hidden" name="reserve_time" value="">
          <input type="submit" class="btn btn-primary d-block" value="キャンセル" onclick="return confirm('本当に予約をキャンセルしますか？')">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>

@endsection
