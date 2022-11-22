$(document).ready(function () {
  /* 유효성 검사 */
  var regEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

  const nameCheck = () => {
    if (!$("#name_input").val()) {
      $("#name_input").addClass("err_input");
      $("#err_name").css({ display: "inline-block" }).text("이름을 입력해주세요");
      return false;
    } else return true;
  }

  const mobileCheck = () => {
    if (!$("#mobile_input").val()) {
      $("#mobile_input").addClass("err_input");
      $("#err_mobile").css({ display: "inline-block" }).text("연락처를 입력해주세요");
      return false;
    } else return true;
  }

  const emailCheck = () => {
    if (!$("#email_input").val()) {
      $("#email_input").addClass("err_input");
      $("#err_email").css({ display: "inline-block" }).text("이메일주소를 입력해주세요");
      return false;
    } else if (!regEmail.test($('#email_input').val())) {
      $('#email_input').addClass('err_input');
      $('#email_input').removeClass('email_input');
      $('#err_email')
        .css({ display: 'inline-block' })
        .text('올바른 이메일 형식이 아닙니다');
      return false;
    } else {
      $('#email_input').addClass('email_input');
      $('#email_input').removeClass('err_input');
      $('#err_email').css({ display: 'none' });
      return true;
    }
  }

  const timeCheck = () => {
    if (!$("#checkin_input").val()) {
      $("#checkin_input").addClass("err_input");
      $("#err_checkin").css({ display: "inline-block" }).text("체크인예정시간을 입력해주세요");
      return false;
    } else return true;
  }

  const genderCheck = () => {
    var checkedMan = $("#man").is(":checked");
    var checkedWoman = $("#woman").is(":checked");
    if(!checkedMan && !checkedWoman) {
      $("#err_gender").css({ display: "inline-block" }).text("숙박자 성별을 선택해주세요");
      return false;
    } else return true;
  }

  const applyCheck = () => {
    var check1 = $('#check1').is(':checked');
    var check2 = $('#check2').is(':checked');

    if (!check1 || !check2) {
      $('#err_apply')
        .css({ display: 'inline-block' })
        .text('필수약관에 동의해주세요');
      return false;
    } else {
      $('#err_apply').css({ display: 'none' });
      return true;
    }
  };

  const payCheck = () => {
    if (!$('input:radio[name="pay_method"]').is(':checked')) {
      $('#err_pay')
      .css({ display: 'inline-block' })
      .text('결제 방법을 선택해주세요');
      return false;
    } else {
      $('#err_pay').css({ display: 'none' });
      return true;
    }
  }


  $('#check_all').on('change', function() {
    var checked = $(this).is(':checked');
    if(checked) {
      $('#err_apply').css({ display: 'none' });
    }
  });

  $("#name_input").on("keyup", function () {
    $("#name_input").removeClass("err_input");
    $("#err_name").css({ display: "none" });
  });

  $("#mobile_input").on("keyup", function () {
    $("#mobile_input").removeClass("err_input");
    $("#err_mobile").css({ display: "none" });
  });

  $("#email_input").on("keyup", function () {
    $("#email_input").removeClass("err_input");
    $("#err_email").css({ display: "none" });
  });

  $("#checkin_input").on("change", function () {
    $("#checkin_input").removeClass("err_input");
    $("#err_checkin").css({ display: "none" });
  });

  $(".gender").on("click", function () {
    $("#err_gender").css({ display: "none" });
  });

  $('input:radio[name="pay_method"]').on("click", function () {
    $("#err_pay").css({ display: "none" });
  });

  /* 체크인예정시간 달력 */
  $('#checkin_input').daterangepicker({
    autoUpdateInput: false,
    singleDatePicker: true,
    timePicker: true,
    timePickerIncrement: 10,
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

  $('#checkin_input').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(
      picker.startDate.format('YYYY-MM-DD H:mm')
    );
    $("#checkin_input").removeClass("err_input");
    $("#err_checkin").css({ display: "none" });
  });
  
  /* 체크 박스 */
  // 체크박스 전체 선택, 해제
  $("#checkbox_group").on("click", "#check_all", function () {
    var checked = $(this).is(":checked");

    if(checked){
      $(this).parents("#checkbox_group").find('input').prop("checked", true);
    } else {
      $(this).parents("#checkbox_group").find('input').prop("checked", false);
    }
  });

  // 하나 체크 해제했을 때 전체선택 해제
  $(".nomal").on('click', function(){
    var checked = $(this).is(":checked");

    if(!checked) {
      $("#check_all").prop("checked", false);
    }
  })

  // 개별 선택으로 두개 다 체크되었을 때 전체선택에도 체크
  $(".nomal").on('click', function(){
    var check1 = $("#check1").is(":checked")
    var check2 = $("#check2").is(":checked")

    if(check1 && check2 == true){
      $("#check_all").prop("checked", true);
      $('#err_apply').css({ display: 'none' });
    } 
  });

  $("#reservation_btn").on("click", function () {
    if (!nameCheck() || !mobileCheck() || !emailCheck() || !timeCheck() || !payCheck() || !genderCheck() || !applyCheck()) {
      nameCheck();
      mobileCheck();
      emailCheck();
      timeCheck();
      genderCheck();
      applyCheck();
      payCheck();
      return false;
    } else if($('#pay1').is(':checked')){
      inicisRequestPay();
    }else if($('#pay2').is(':checked')) {
      kakaoRequestPay();
    } else $("#reservation_form").submit();
  });

      /* 카카오페이 결제 */
      var IMP = window.IMP; 
      IMP.init('imp80244728');
      const kakaoRequestPay = () => {
        // IMP.request_pay(param, callback) 결제창 호출
        IMP.request_pay({
          pg : 'kakaopay',
          pay_method : 'card',
          merchant_uid: 'MDorder_no_'+ new Date().getTime(), //상점에서 생성한 고유 주문번호
          name : $('.room_info_name').text()+" / "+ $('.room_info_type').text(),
          amount : 1,
          buyer_email : $('#email_input').val(),
          buyer_name : $('#name_input').val(),
          buyer_tel : $('#mobile_input').val(),
          // buyer_addr : '서울특별시 강남구 삼성동',
          // buyer_postcode : '123-456',
        }, 
        function (rsp) { // callback
            if (rsp.success) {
              console.log(rsp);
               $("#reservation_form").submit();
            } else {
              console.log(rsp);
              alert("결제에 실패하였습니다.");
            }
        });
      }

      const inicisRequestPay = () => {
        // IMP.request_pay(param, callback) 결제창 호출
        IMP.request_pay({
          pg : 'html5_inicis',
          pay_method : 'card',
          merchant_uid: 'MDorder_no_'+ new Date().getTime(), // 상점에서 관리하는 주문 번호를 전달
          name : $('.room_info_name').text()+" / "+ $('.room_info_type').text(),
          amount : 1,
          buyer_email : $('#email_input').val(),
          buyer_name : $('#name_input').val(),
          buyer_tel : $('#mobile_input').val(),
          // buyer_addr : '서울특별시 강남구 삼성동',
          // buyer_postcode : '123-456',
      },
        function (rsp) { // callback
            if (rsp.success) {
              console.log(rsp);
               $("#reservation_form").submit();
            } else {
              console.log(rsp);
              alert("결제에 실패하였습니다.");
            }
        });
      }
});