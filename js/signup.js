$(document).ready(function () {
  /* 정규식 */
  var regEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
  var regPwd =
    /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;
  var regMobile = /^[0-9]+$/;

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
      $('#err_email').css({ display: 'none' });
      return true;
    }
  };

  $('#email').on('keyup', function () {
    emailCheck();
  });

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
        .text('문자/숫자/특수문자 포함 8자 이상 입력해주세요');
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
      $('#err_repwd').css({ display: 'block' }).text('비밀번호 확인을 입력해주세요');
      return false;
    } else if ($("#pwd").val() != $("#repwd").val()) {
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
    var name_len = $("#name").val().length;

    if (!$('#name').val()) {
      $('#name').addClass('err_input').focus();
      $('#name').removeClass('signup_input');
      $('#err_name').css({ display: 'block' }).text('비밀번호 확인을 입력해주세요');
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
    var nickname_len = $("#nickname").val().length;

    if (!$('#nickname').val()) {
      $('#nickname').addClass('err_input').focus();
      $('#nickname').removeClass('signup_input');
      $('#err_nickname').css({ display: 'block' }).text('비밀번호 확인을 입력해주세요');
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
      $('#err_mobile').css({ display: 'block' }).text('휴대폰 번호를 입력해주세요');
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

  // const applyCheck = () => {
  //   if (!chackbox01.checked) {
  //     err_apply.style.display = 'block';
  //     err_apply.innerHTML = '필수약관에 동의해주세요';
  //     return false;
  //   } else {
  //     err_apply.style.display = "none"
  //     return true;
  //   }
  // };

  // chackbox01.addEventListener('change', applyCheck);
  // chackbox02.addEventListener('change', applyCheck);

  $('#signup_btn').on('click', function () {
    if (
      !emailCheck() ||
      !pwdCheck() ||
      !repwdCheck() ||
      !nameCheck() ||
      !nicknameCheck() ||
      !mobileCheck()
    ) {
      emailCheck();
      pwdCheck();
      repwdCheck();
      nameCheck();
      nicknameCheck();
      mobileCheck();
      return false;
    } else $('#signup_form').submit();
  });
});
