$(document).ready(function() {
  var email = document.getElementById('email');
  var pwd = document.getElementById('pwd');
  var repwd = document.getElementById('repwd');
  var name = document.getElementById('name');
  var nickname = document.getElementById('nickname');
  var mobile = document.getElementById('mobile');
  var chackbox01 = document.getElementById('chackbox01');
  var chackbox02 = document.getElementById('chackbox02');

  var err_email = document.getElementById('err_email');
  var err_pwd = document.getElementById('err_pwd');
  var err_repwd = document.getElementById('err_repwd');
  var err_name = document.getElementById('err_name');
  var err_nickname = document.getElementById('err_nickname');
  var err_mobile = document.getElementById('err_mobile');
  var err_apply = document.getElementById('err_apply');

  /* 정규식 */
  var regEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
  var regPwd = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;
  var regMobile = /^[0-9]+$/;

  const emailCheck = () => {
    if (!email.value) {
      err_email.style.display = 'block';
      email.setAttribute('class', "err_email_input");
      err_email.innerHTML = '이메일을 입력해주세요';
      email.focus();
      return false;
    } else if(!regEmail.test(email.value)) { 
      err_email.style.display = 'block';
      email.setAttribute('class', "err_email_input");
      err_email.innerHTML = '올바른 이메일 형식이 아닙니다';
      email.focus();
      return false;
    }else {
      email.removeAttribute('class', "err_email_input");
      email.setAttribute('class', "email_input");
      err_email.style.display = 'none';
      return true;
    }
  };
  email.addEventListener('keyup', emailCheck);

  const pwdCheck = () => {
    if (!pwd.value) {
      err_pwd.style.display = 'block';
      pwd.setAttribute('class', "err_input");
      err_pwd.innerHTML = '비밀번호를 입력해주세요';
      pwd.focus();
      return false;
    } else if(!regPwd.test(pwd.value)) {
      err_pwd.style.display = 'block';
      pwd.setAttribute('class', "err_input");
      err_pwd.innerHTML = '문자/숫자/특수문자 포함 8자 이상 입력해주세요';
      pwd.focus();
      return false;
    } else {
      err_pwd.style.display = 'none';
      pwd.removeAttribute('class', "err_input");
      pwd.setAttribute('class', "signup_input");
      return true;
    }
  };
  pwd.addEventListener('keyup', pwdCheck);

  const repwdCheck = () => {
    if (!repwd.value) {
      err_repwd.style.display = 'block';
      repwd.setAttribute('class', "err_input");
      err_repwd.innerHTML = '비밀번호 확인을 입력해주세요';
      repwd.focus();
      return false;
    } else if(pwd.value != repwd.value) {
      err_repwd.style.display = 'block';
      repwd.setAttribute('class', "err_input");
      err_repwd.innerHTML = '비밀번호가 일치하지 않습니다.';
      return false;
    } else {
      err_repwd.style.display = 'none';
      repwd.removeAttribute('class', "err_input");
      repwd.setAttribute('class', "signup_input");
      return true;
    }
  };
  repwd.addEventListener('keyup', repwdCheck);

  const nameCheck = () => {
    var name_len = name.value.length
    if (!name.value) {
      err_name.style.display = 'block';
      name.setAttribute('class', "err_input");
      err_name.innerHTML = '이름을 입력해주세요';
      name.focus();
      return false;
    } else if(name_len < 2) {
      err_name.style.display = 'block';
      name.setAttribute('class', "err_input");
      err_name.innerHTML = '두 글자 이상 입력해주세요';
      name.focus();
    } else {
      err_name.style.display = 'none';
      name.removeAttribute('class', "err_input");
      name.setAttribute('class', "signup_input");
      return true;
    }
  };
  name.addEventListener('keyup', nameCheck);

  const nicknameCheck = () => {
    var nickname_len = nickname.value.length
    if (!nickname.value) {
      err_nickname.style.display = 'block';
      nickname.setAttribute('class', "err_input");
      err_nickname.innerHTML = '닉네임을 입력해주세요';
      nickname.focus();
      return false;
    } else if(nickname_len < 2) {
      err_nickname.style.display = 'block';
      nickname.setAttribute('class', "err_input");
      err_nickname.innerHTML = '두 글자 이상 입력해주세요';
      nickname.focus();
    } else {
      err_nickname.style.display = 'none';
      nickname.removeAttribute('class', "err_input");
      nickname.setAttribute('class', "signup_input");
      return true;
    }
  };
  nickname.addEventListener('keyup', nicknameCheck);

  const mobileCheck = () => {
    if (!mobile.value) {
      err_mobile.style.display = 'block';
      mobile.setAttribute('class', "err_input");
      err_mobile.innerHTML = '휴대폰번호를 입력해주세요';
      mobile.focus();
      return false;
    } else if(!regMobile.test(mobile.value)) {
      err_mobile.style.display = 'block';
      mobile.setAttribute('class', "err_input");
      err_mobile.innerHTML = '"-"없이 숫자만 입력해주세요';
      mobile.focus();
    } else {
      err_mobile.style.display = 'none';
      mobile.removeAttribute('class', "err_input");
      mobile.setAttribute('class', "signup_input");
      return true;
    }
  };
  mobile.addEventListener('input', mobileCheck);

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


  $("#signup_form").on("submit", function() {
    if(emailCheck() == true);
    if(pwdCheck() == true);
    if(repwdCheck() == true);
    if(nameCheck() == true);
    if(nicknameCheck() == true);
    if(mobileCheck() == true) return true;
    
    else return false;
  })
});
