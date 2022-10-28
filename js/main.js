$(document).ready(function () {
  /* 숙소 검색 달력 */
  $('#daterange_room').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD',
      separator: ' - ',
      applyLabel: '확인',
      cancelLabel: '취소',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      weekLabel: 'W',
      daysOfWeek: ['월', '화', '수', '목', '금', '토', '일'],
      monthNames: [
        '1월',
        '2월',
        '3월',
        '4월',
        '5월',
        '6월',
        '7월',
        '8월',
        '9월',
        '10월',
        '11월',
        '12월',
      ],
    },
    applyButtonClasses: 'datepicker_apply_btn',
    cancelClass: 'datepicker_cancel_btn',
  });

  $('#daterange_room').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(
      picker.startDate.format('YYYY-MM-DD') +
        ' - ' +
        picker.endDate.format('YYYY-MM-DD'),
    );
  });

    /* 날짜 선택 */
  // $('#daterange').on('apply.daterangepicker', function (ev, picker) {
  //   console.log(picker.startDate.format('YYYY-MM-DD'));
  //   console.log(picker.endDate.format('YYYY-MM-DD'));
  // });

  /* 투어 검색 달력 */
  $('#daterange_tour').daterangepicker({
    autoUpdateInput: false,
    singleDatePicker: true,
    locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD',
      applyLabel: '확인',
      cancelLabel: '취소',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      weekLabel: 'W',
      daysOfWeek: ['월', '화', '수', '목', '금', '토', '일'],
      monthNames: [
        '1월',
        '2월',
        '3월',
        '4월',
        '5월',
        '6월',
        '7월',
        '8월',
        '9월',
        '10월',
        '11월',
        '12월',
      ],
    },
    applyButtonClasses: 'datepicker_apply_btn',
    cancelClass: 'datepicker_cancel_btn',
  });

  $('#daterange_tour').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(
      picker.startDate.format('YYYY-MM-DD')
    );
  });

  /* 숙소, 투어 검색 */
  $(".mb_search_room").on("click", function(e){
    e.preventDefault();
    $("#search_room_form").show()
    $("#search_tour_form").hide()   
    $(".mb_search_room").addClass("search_bar_boder")
    $(".mb_search_tour").removeClass("search_bar_boder")
  })

  $(".mb_search_tour").on("click", function(e){
    e.preventDefault();
    $("#search_tour_form").show()
    $("#search_room_form").hide()
    $(".mb_search_tour").addClass("search_bar_boder")
    $(".mb_search_room").removeClass("search_bar_boder")
  })

  /* 메인 배너 슬라이드 */
  $('.mb_reco_slide').on('init', function (event, slick) {
    $('#now_page').text(1);
    $('#total_page').text(slick.slideCount);
  });

  $('.mb_reco_slide').not('.slick-initialized').slick({
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
      $('#now_page').text(i);
      $('#total_page').text(slick.slideCount);
    },
  );

  $('.carousel_play').click(function (e) {
    e.preventDefault(); // 클릭 시 맨 위로 가지 않게
    $('.mb_reco_slide').slick('slickPlay');
    $('.carousel_stop').show();
    $('.carousel_play').hide();
  });

  $('.carousel_stop').click(function (e) {
    e.preventDefault();
    $('.mb_reco_slide').slick('slickPause');
    $('.carousel_play').show();
    $('.carousel_stop').hide();
  });

  /* 중간 배너 슬라이드 */
  $('.sale_slide').not('.slick-initialized').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
  });

  /* 이벤트 배너 슬라이드  */
  $('.evnt_slide').on('init', function (event, slick) {
    $('#evnt_now_page').text(1);
    $('#evnt_total_page').text(slick.slideCount);
  });

  $('.evnt_slide').not('.slick-initialized').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    arrows: true,
    prevArrow: $('.evnt_prev'),
    nextArrow: $('.evnt_next'),
  });

  $('.evnt_slide').on(
    'afterChange',
    function (event, slick, currentSlide, nextSlide) {
      var i = (currentSlide ? currentSlide : 0) + 1;
      $('#evnt_now_page').text(i);
      $('#evnt_total_page').text(slick.slideCount);
    },
  );

  $('.evnt_play').click(function (e) {
    e.preventDefault();
    $('.evnt_slide').slick('slickPlay');
    $('.evnt_stop').show();
    $('.evnt_play').hide();
  });

  $('.evnt_stop').click(function (e) {
    e.preventDefault();
    $('.evnt_slide').slick('slickPause');
    $('.evnt_play').show();
    $('.evnt_stop').hide();
  });

  /* 메인 카드 슬라이드*/
  $('#room_slide').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#room_btn1'),
    nextArrow: $('#room_btn2'),
  });

  $('#tour_slide').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    arrows: true,
    prevArrow: $('#tour_btn1'),
    nextArrow: $('#tour_btn2'),
  });

  $('#info_slide').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#info_btn1'),
    nextArrow: $('#info_btn2'),
  });

  /* 커뮤니티 */
  $(".cmnt_job").on("click", function(e){
    e.preventDefault();
    $("#cmnt_job_list").show()
    $("#cunt_deal_list").hide()   
    $(".cmnt_job").addClass("cmnt_border")
    $(".cmnt_deal").removeClass("cmnt_border")
  });

  $(".cmnt_deal").on("click", function(e){
    e.preventDefault();
    $("#cunt_deal_list").show()
    $("#cmnt_job_list").hide()
    $(".cmnt_deal").addClass("cmnt_border")
    $(".cmnt_job").removeClass("cmnt_border")
  })
});