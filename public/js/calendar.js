$(function () {
  $('.reserve-modal-open').on('click', function () {
    $('.js-modal').fadeIn();

    // ボタンのdata属性から予約情報を取得
    var reserveDate = $(this).data('reserve-date');
    var reserveTime = $(this).data('reserve-time');

    // モーダル内の要素にデータを挿入
    $('#reserveDate').text('予約日: ' + reserveDate);
    $('#reserveTime').text('予約時間: ' + reserveTime);

    $('input[name="reserve_date"]').val(reserveDate);
    $('input[name="reserve_time"]').val(reserveTime);

    return false;
  });

  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
