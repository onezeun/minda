window.onload = function () {
  var email = document.getElementById('email');
  var pwd = document.getElementById('pwd');
  var repwd = document.getElementById('repwd');
  var name = document.getElementById('name');
  var nickname = document.getElementById('nickname');
  var mobile = document.getElementById('mobile');

  var err_email = document.getElementById('err_email');
  var err_pwd = document.getElementById('err_pwd');
  var err_repwd = document.getElementById('err_repwd');
  var err_name = document.getElementById('err_name');
  var err_nickname = document.getElementById('err_nickname');
  var err_mobile = document.getElementById('err_mobile');

  const emailCheck = () => {
    if (!email.value) {
      err_email.style.display = 'block';
      email.setAttribute('class', "err_email_input")
      err_email.innerHTML = '이메일을 입력해주세요';
      email.focus();
    } else {
      email.removeAttribute('class', "err_email_input")
      email.setAttribute('class', "email_input")
      err_email.style.display = 'none';
      return false;
    }
  };
  email.addEventListener('keyup', emailCheck);

  const pwdCheck = () => {
    if (!pwd.value) {
      err_pwd.style.display = 'block';
      pwd.setAttribute('class', "err_input")
      err_pwd.innerHTML = '비밀번호를 입력해주세요';
      pwd.focus();
    } else {
      err_pwd.style.display = 'none';
      pwd.removeAttribute('class', "err_input")
      pwd.setAttribute('class', "signup_input")
      return false;
    }
  };
  pwd.addEventListener('keyup', pwdCheck);

  const repwdCheck = () => {
    if (!repwd.value) {
      err_repwd.style.display = 'block';
      repwd.setAttribute('class', "err_input")
      err_repwd.innerHTML = '비밀번호 확인을 입력해주세요';
      repwd.focus();
    } else if(pwd.value != repwd.value) {
      err_repwd.style.display = 'block';
      err_repwd.innerHTML = '비밀번호가 일치하지 않습니다.';
    } else {
      err_repwd.style.display = 'none';
      repwd.removeAttribute('class', "err_input")
      repwd.setAttribute('class', "signup_input")
      return false;
    }
  };
  repwd.addEventListener('keyup', repwdCheck);

  const nameCheck = () => {
    if (!name.value) {
      err_name.style.display = 'block';
      name.setAttribute('class', "err_input")
      err_name.innerHTML = '이메일을 입력해주세요';
      name.focus();
    } else {
      err_name.style.display = 'none';
      name.removeAttribute('class', "err_input")
      name.setAttribute('class', "signup_input")
      return false;
    }
  };
  name.addEventListener('keyup', nameCheck);

};
