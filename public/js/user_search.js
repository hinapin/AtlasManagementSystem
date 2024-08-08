
$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  // $('.subject_edit_btn').click(function () {
  //   $('.subject_inner').slideToggle();
  // });
});

$(function () {
  $('.search_accordion').click(function () {
    $(this).toggleClass("open", 300);
  });
});


$(function () {
  $('.categories_conditions').click(function () {
    $(this).siblings('.categories_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});

$(function () {
  $('.categories_accordion').click(function () {
    $(this).toggleClass("open", 300);
  });
});
