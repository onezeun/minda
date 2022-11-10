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

  /* 숙소 소개 팝업 */
  $(".ldg_info_btn").on("click", function (e) {
    e.preventDefault();

    $(".ldg_info_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $("#ldg_pop_cancel").on("click", function () {
    $(".ldg_info_modal_bg").hide();
    $("body").removeClass("scrollLock");
  });

  $('#info_img_btn').on('click', function() {
    $('#ldg_info_btn').text("등록 내용 확인").css({color : "#eeb72f"})
    $(".ldg_info_modal_bg").hide();
    $("body").removeClass("scrollLock");
  })

  /* 객실 등록 팝업 */
  $("#room_btn").on("click", function (e) {
    e.preventDefault();

    $(".room_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $("#room_pop_cancel").on("click", function () {
    $(".room_modal_bg").hide();
    $("body").removeClass("scrollLock");
  });

});
