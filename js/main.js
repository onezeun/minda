$(document).ready(function () {
  var nowPage = $('#now_page');
  var totalPage = $('#total_page');

  /* 메인 배너 이미지 캐러셀 */
  $('.mb_reco_slide').on('init', function (event, slick) {
    nowPage.text(1);
    totalPage.text(slick.slideCount);
  });

  $('.mb_reco_slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    arrows: true,
    prevArrow: $('.carousel_prev'),
    nextArrow: $('.carousel_next'),
  });

  $('.mb_reco_slide').on(
    'afterChange',
    function (event, slick, currentSlide, nextSlide) {
      var i = (currentSlide ? currentSlide : 0) + 1;
      nowPage.text(i);
      totalPage.text(slick.slideCount);
    },
  );

  $('.carousel_play').click(function () {
    $('.mb_reco_slide').slick('slickPlay');
    $('.carousel_stop').show();
    $('.carousel_play').hide();
  });

  $('.carousel_stop').click(function () {
    $('.mb_reco_slide').slick('slickPause');
    $('.carousel_play').show();
    $('.carousel_stop').hide();
  });


  /* 중간 배너 이미지 캐러셀  */
  $('.sale_slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    dotsClass : "sale_slide_btn2",
    // customPaging: function(slider, i) { 
    //   return '<button class="sale_slide_btn1">' + $(slider.$slides[i]) + '</button>';
  // },
  });

  /* 이벤트 배너 이미지 캐러셀  */

  $('.event_slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    arrows: true,
    prevArrow: $('.event_prev'),
    nextArrow: $('.event_next'),
  });
});
