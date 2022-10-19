$(document).ready(function () {
  /* 숙소 검색 달력 */
  $('#daterange_check').daterangepicker({
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

  /* 값 넣기*/
  $('#daterange_check').on('apply.daterangepicker', function (ev, picker) {
    $("#checkin_val").text(picker.startDate.format('YYYY-MM-DD'))
    $("#checkout_val").text(picker.endDate.format('YYYY-MM-DD'))
  });

  /* 인원 선택 */
  $(".prs_mbtn").on('click', function(){
    var prs_num = Number($(".prs_box").val());
    if(prs_num == 0) {
      prs_num = 0;
      $(".prs_box").val(prs_num);
    } else {
      prs_num -= 1;
      $(".prs_box").val(prs_num);
      $(".warning_msg").hide()
    }
  })

  $(".prs_pbtn").on('click', function(){
    var prs_num = Number($(".prs_box").val()); 
    if (prs_num == 10) {
      $(".prs_box").val(prs_num);
      $(".warning_msg").show()
      $(".warning_msg").text("최대 10명까지만 입력 가능합니다")
    } else {
      prs_num += 1;
      $(".prs_box").val(prs_num);
    }
  })
});


