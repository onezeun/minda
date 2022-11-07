$(document).ready(function () {
  /* 정규식 */
  var regEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
  var regPwd =
    /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;
  var regMobile = /^[0-9]+$/;

  //이메일 체크여부 확인 (이메일 중복일 경우 = 0 , 중복이 아닐경우 = 1 )
  var idck = 0;

  const emailCheck = () => {
    if (!$('#email').val()) {
      $('#email').addClass('err_email_input').focus();
      $('#email').removeClass('email_input');
      $('#err_email').css({ display: 'block' }).text('이메일을 입력해주세요');
      return false;
    } else if (!regEmail.test($('#email').val())) {
      $('#email').addClass('err_email_input').focus();
      $('#email').removeClass('email_input');
      $('#err_email')
        .css({ display: 'block' })
        .text('올바른 이메일 형식이 아닙니다');
      return false;
    } else {
      $('#email').addClass('email_input');
      $('#email').removeClass('err_email_input');
      $('#email').removeClass('succ_email_input');
      $('#err_email').css({ display: 'none' });
      return true;
    }
  };

  $('#email').on('keyup', function () {
    emailCheck();
    idck = 0;
  });

  // 이메일 중복검사
  $('#email_check').on('click', function () {
    let u_email = $('#email').val();

    if (!u_email) {
      $('#email').addClass('err_email_input').focus();
      $('#email').removeClass('email_input');
      $('#err_email')
        .css({ display: 'block' })
        .removeClass('succ_txt')
        .addClass('err_txt')
        .text('이메일을 입력해주세요');
      return false;
    } else {
      $.ajax({
        async: true,
        url: '../user/email_check.php',
        type: 'GET',
        data: { u_email: u_email },
        success: function (data) {
          if (data == 'Y') {
            $('#email').addClass('err_email_input').focus();
            $('#email').removeClass('email_input');
            $('#err_email')
              .css({ display: 'block' })
              .removeClass('succ_txt')
              .addClass('err_txt')
              .text('사용중인 이메일입니다.');
            return false;
          } else if (!regEmail.test($('#email').val())) {
            $('#email').addClass('err_email_input').focus();
            $('#email').removeClass('email_input');
            $('#err_email')
              .css({ display: 'block' })
              .removeClass('succ_txt')
              .addClass('err_txt')
              .text('올바른 이메일 형식이 아닙니다');
            return false;
          } else {
            $('#email').addClass('succ_email_input');
            $('#email').removeClass('email_input');
            $('#err_email')
              .css({ display: 'block' })
              .removeClass('err_txt')
              .addClass('succ_txt')
              .text('사용가능한 이메일입니다.');
            // 아이디 중복이 아니면
            idck = 1;
          }
        },
      });
    }
  });

  const emailCheck2 = () => {
    if (idck == 1) {
      $('#err_email').css({ display: 'none' });
    } else if (idck == 0) {
      alert('아이디 중복확인을 해주세요');
    }
  };

  const pwdCheck = () => {
    if (!$('#pwd').val()) {
      $('#pwd').addClass('err_input').focus();
      $('#pwd').removeClass('signup_input');
      $('#err_pwd').css({ display: 'block' }).text('비밀번호를 입력해주세요');
      return false;
    } else if (!regPwd.test($('#pwd').val())) {
      $('#pwd').addClass('err_input').focus();
      $('#pwd').removeClass('signup_input');
      $('#err_pwd')
        .css({ display: 'block' })
        .text('문자/숫자/특수문자 포함 8자 ~ 20자 사이로 입력해주세요');
      return false;
    } else {
      $('#pwd').addClass('signup_input');
      $('#pwd').removeClass('err_input');
      $('#err_pwd').css({ display: 'none' });
      return true;
    }
  };

  $('#pwd').on('keyup', function () {
    pwdCheck();
  });

  const repwdCheck = () => {
    if (!$('#repwd').val()) {
      $('#repwd').addClass('err_input').focus();
      $('#repwd').removeClass('signup_input');
      $('#err_repwd')
        .css({ display: 'block' })
        .text('비밀번호 확인을 입력해주세요');
      return false;
    } else if ($('#pwd').val() != $('#repwd').val()) {
      $('#repwd').addClass('err_input').focus();
      $('#repwd').removeClass('signup_input');
      $('#err_repwd')
        .css({ display: 'block' })
        .text('비밀번호가 일치하지 않습니다');
      return false;
    } else {
      $('#repwd').addClass('signup_input');
      $('#repwd').removeClass('err_input');
      $('#err_repwd').css({ display: 'none' });
      return true;
    }
  };

  $('#repwd').on('keyup', function () {
    repwdCheck();
  });

  const nameCheck = () => {
    var name_len = $('#name').val().length;

    if (!$('#name').val()) {
      $('#name').addClass('err_input').focus();
      $('#name').removeClass('signup_input');
      $('#err_name').css({ display: 'block' }).text('이름을 입력해주세요');
      return false;
    } else if (name_len < 2) {
      $('#name').addClass('err_input').focus();
      $('#name').removeClass('signup_input');
      $('#err_name')
        .css({ display: 'block' })
        .text('두 글자 이상 입력해주세요');
      return false;
    } else {
      $('#name').addClass('signup_input');
      $('#name').removeClass('err_input');
      $('#err_name').css({ display: 'none' });
      return true;
    }
  };

  $('#name').on('keyup', function () {
    nameCheck();
  });

  const nicknameCheck = () => {
    var nickname_len = $('#nickname').val().length;

    if (!$('#nickname').val()) {
      $('#nickname').addClass('err_input').focus();
      $('#nickname').removeClass('signup_input');
      $('#err_nickname')
        .css({ display: 'block' })
        .text('닉네임을 입력해주세요');
      return false;
    } else if (nickname_len < 2) {
      $('#nickname').addClass('err_input').focus();
      $('#nickname').removeClass('signup_input');
      $('#err_nickname')
        .css({ display: 'block' })
        .text('두 글자 이상 입력해주세요');
      return false;
    } else {
      $('#nickname').addClass('signup_input');
      $('#nickname').removeClass('err_input');
      $('#err_nickname').css({ display: 'none' });
      return true;
    }
  };

  $('#nickname').on('keyup', function () {
    nicknameCheck();
  });

  const mobileCheck = () => {
    if (!$('#mobile').val()) {
      $('#mobile').addClass('err_input').focus();
      $('#mobile').removeClass('signup_input');
      $('#err_mobile')
        .css({ display: 'block' })
        .text('휴대폰 번호를 입력해주세요');
      return false;
    } else if (!regMobile.test($('#mobile').val())) {
      $('#mobile').addClass('err_input').focus();
      $('#mobile').removeClass('signup_input');
      $('#err_mobile')
        .css({ display: 'block' })
        .text('"-"없이 숫자만 입력해주세요');
      return false;
    } else {
      $('#mobile').addClass('signup_input');
      $('#mobile').removeClass('err_input');
      $('#err_mobile').css({ display: 'none' });
      return true;
    }
  };

  $('#mobile').on('input', function () {
    mobileCheck();
  });

  const applyCheck = () => {
    var check1 = $('.checkbox01').is(':checked');
    var check2 = $('.checkbox02').is(':checked');

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

  $('.term')
    .find('input')
    .on('change', function () {
      var checked = $(this).is(':checked');
      var check1 = $('.checkbox01').is(':checked');
      var check2 = $('.checkbox02').is(':checked');

      applyCheck();
      if (check1 && check2) {
        $('#err_apply').css({ display: 'none' });
      }
    });

  $('#signup_btn').on('click', function () {
    if (idck == 0) {
      emailCheck2();
      return false;
    } else if (
      !emailCheck() ||
      !pwdCheck() ||
      !repwdCheck() ||
      !nameCheck() ||
      !nicknameCheck() ||
      !mobileCheck() ||
      !applyCheck()
    ) {
      emailCheck();
      pwdCheck();
      repwdCheck();
      nameCheck();
      nicknameCheck();
      mobileCheck();
      applyCheck();
      return false;
    } else $('#signup_form').submit();
  });

  /* 약관 동의 체크 */
  // 체크박스 전체 선택, 해제
  $('#check_all').on('click', function () {
    var checked = $(this).is(':checked');
    if (checked) {
      $('.term_wrap').find('input').prop('checked', true);
    } else {
      $('.term_wrap').find('input').prop('checked', false);
    }
  });

  // 하나 체크 해제했을 때 전체선택 해제
  $('.nomal').on('click', function () {
    var checked = $(this).is(':checked');

    if (!checked) {
      $('#check_all').prop('checked', false);
    }
  });

  // 개별 선택으로 두개 다 체크되었을 때 전체선택에도 체크
  $('.nomal').on('click', function () {
    var check1 = $('.checkbox01').is(':checked');
    var check2 = $('.checkbox02').is(':checked');
    var check3 = $('.checkbox03').is(':checked');

    if (check1 && check2 && check3 == true) {
      $('#check_all').prop('checked', true);
    }
  });
});
