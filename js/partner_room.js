$(document).ready(function () {
  /* 슬라이드 */
  $('#room_slide').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#room_btn1'),
    nextArrow: $('#room_btn2'),
  });
});
