$(document).ready(function () {
  /* 슬라이드 */
  $('#checkin_slide').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#checkin_btn1'),
    nextArrow: $('#checkin_btn2'),
  });

  $('#checkout_slide').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#checkout_btn1'),
    nextArrow: $('#checkout_btn2'),
  });
});
