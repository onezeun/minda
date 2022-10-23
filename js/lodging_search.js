$(document).ready(function () {
  /* 가격 범위 input */
  $('#value1').text($('#input_left').val());
  $('#value2').text($('#input_right').val());

  const setLeftValue = () => {
    var left_val = $('#input_left').val();
    var right_val = $('#input_right').val();

    const [min, max] = [parseInt($('#input_left').attr('min')), parseInt($('#input_left').attr('max'))];

    // 교차되지 않게
    left_val = Math.min(parseInt(left_val), parseInt(right_val) - 10);
    $('#input_left').val(left_val);

    // input, thumb 같이 움직이도록
    $('.slider > .thumb.left').css('left', left_val + '%');
    $('.slider > .range').css('left', left_val + '%');
  };

  const setRightValue = () => {
    var left_val = $('#input_left').val();
    var right_val = $('#input_right').val();

    const [min, max] = [parseInt($('#input_right').attr('min')), parseInt($('#input_right').attr('max'))];

    // 교차되지 않게
    right_val = Math.max(parseInt(right_val), parseInt(left_val) + 10);
    $('#input_right').val(right_val);

    // input, thumb 같이 움직이도록
    $('.slider > .thumb.right').css('right', 100 - right_val + '%');
    $('.slider > .range').css('right', 100 - right_val + '%');
  };

  $('#input_left').on('input', function (e) {
    setLeftValue();
    $('#value1').text(e.target.value);
  });

  $('#input_right').on('input', function (e) {
    setRightValue();
    $('#value2').text(e.target.value);
  });

  /* 검색 바 */
  /* 숙소 검색 달력 */
  $('#daterange_search').daterangepicker({
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

  $('#daterange_search').on('apply.daterangepicker', function (ev, picker) {
    $('#checkin_val').text(picker.startDate.format('YYYY-MM-DD'));
    $('#checkout_val').text(picker.endDate.format('YYYY-MM-DD'));
  });

  $('.search_date')
    .find('span')
    .on('click', function () {
      $('#daterange_search').focus();
    });

  $('.search_date')
    .find('label')
    .on('click', function () {
      $('#daterange_search').focus();
    });

  /* count Box */
  $('.search_count').on('click', function () {
    $('.count_box').stop().slideToggle(150);
  });

  $('.val_txt_wrap').on('click', function () {
    $('.count_box').stop().slideToggle(150);
  });

  $('.cancel_btn').on('click', function () {
    $('.count_box').stop().slideUp(150);
  });

  /* 요소 영역 제외 선택 시 slideUp */
  $(document).on('mouseup', function (e) {
    if (!$(e.target).hasClass('area')) {
      $('.count_box').slideUp(150);
    }
  });

  /* 객실 선택 */
  $('#room_mbtn').on('click', function () {
    var num = Number($('#search_count_room').val());
    if (num == 0) {
      num = 0;
      $('#search_count_room').val(num);
      $('#room_count_val').text(num);
      $('#room_count').text(num);
    } else {
      num -= 1;
      $('#search_count_room').val(num);
      $('#room_count_val').text(num);
      $('#room_count').text(num);
      $('.warning_msg').hide();
    }
  });

  $('#room_pbtn').on('click', function () {
    var num = Number($('#search_count_room').val());
    if (num == 10) {
      $('#search_count_room').val(num);
      $('#room_count_val').text(num);
      $('#room_count').text(num);
      $('.warning_msg').show();
      $('.warning_msg').text('객실 및 인원 최대 10까지 입력 가능합니다.');
    } else {
      num += 1;
      $('#search_count_room').val(num);
      $('.val_txt_wrap').show();
      $('#room_count_val').text(num);
      $('#room_count').text(num);
    }
  });

  /* 인원 선택 */
  $('#prs_mbtn').on('click', function () {
    var num = Number($('#search_count_prs').val());
    if (num == 0) {
      num = 0;
      $('#search_count_prs').val(num);
      $('#prs_count_val').text(num);
      $('#prs_count').text(num);
    } else {
      num -= 1;
      $('#search_count_prs').val(num);
      $('#prs_count_val').text(num);
      $('#prs_count').text(num);
      $('.val_txt_wrap').show();
      $('.warning_msg').hide();
    }
  });

  $('#prs_pbtn').on('click', function () {
    var num = Number($('#search_count_prs').val());
    if (num == 10) {
      $('#search_count_prs').val(num);
      $('#prs_count_val').text(num);
      $('#prs_count').text(num);
      $('.warning_msg').show();
      $('.warning_msg').text('객실 및 인원 최대 10까지 입력 가능합니다.');
    } else {
      num += 1;
      $('#search_count_prs').val(num);
      $('#prs_count_val').text(num);
      $('#prs_count').text(num);
    }
  });
});
