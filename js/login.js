$(document).ready(function () {
  const emailCheck = () => {
    if (!$('#email_input').val()) {
      $('#email_input').addClass('err_input').focus();
      $('#err_email')
        .css({ display: 'block' })
        .text('이메일주소를 입력해주세요');
      return false;
    } else return true;
  };
  const pwdCheck = () => {
    if (!$('#pwd_input').val()) {
      $('#pwd_input').addClass('err_input').focus();
      $('#err_pwd').css({ display: 'block' }).text('비밀번호를 입력해주세요');
      return false;
    } else return true;
  };

  $('#email_input').on('keyup', function () {
    $('#email_input').removeClass('err_input');
    $('#err_email').css({ display: 'none' });
  });

  $('#pwd_input').on('keyup', function () {
    $('#pwd_input').removeClass('err_input');
    $('#err_pwd').css({ display: 'none' });
  });

  $('#login_btn').on('click', function () {
    let u_email = $('#email_input').val();
    let u_pwd = $('#pwd_input').val();

    if (!emailCheck() || !pwdCheck()) {
      emailCheck();
      pwdCheck();
      return false;
    } else {
      $.ajax({
        async: true,
        url: '../login/login_ok.php',
        type: 'POST',
        data: {
          u_email: u_email,
          u_pwd: u_pwd,
        },
        success: function (data) {
          if (data == '1') {
            $('#email_input').addClass('err_input').focus();
            $('#err_email')
              .css({ display: 'block' })
              .text('일치하는 이메일이 없습니다');
            return false;
          } else {
            if (data == '2') {
              $('#pwd_input').addClass('err_input').focus();
              $('#err_pwd').css({ display: 'block' }).text('비밀번호가 일치하지 않습니다.');
              return false;
            } else {
              $('#login_form').submit();
              location.href = "../index.html";
            }
          }
        },
      });
    }
  });
});
