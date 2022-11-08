$(document).ready(function () {
  /* DB 조회 */
  $.ajax({
    url : '../user/user_read.php',
    type : 'POST',
    data : $('#user_form').serialize(),
    datatype:'json',
  }).done(function(data){
    /* input */
    $(".user_email_val").text(data.u_email);
    $("#user_name_input").val(data.u_name);
    $("#user_nickname_input").val(data.u_nickname);
    $("#user_mobile_input").val(data.u_phone);
    if (data.u_marketing == 'Y') {
      $("#mk_btn1").attr("checked", true);
    } else {
      $("#mk_btn2").attr("checked", true);
    }

    /* value */
    $("#user_name_val").text(data.u_name);
    $("#user_nickname_val").text(data.u_nickname);
    $("#user_mobile_val").text(data.u_phone.replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`));
    if (data.u_marketing == 'Y') {
      $(".mk_txt").text("수신");
    } else {
      $(".mk_txt").text("수신거부");
    }
  })

  /* 편집 버튼 토글 */
  $(".edit_btn").on("click", function () {
    $(".edit_cont").toggle();
    $(".default_cont").toggle();
    $(".btn").show();
    $(".edit_btn").toggleClass("edit_btn_click");
  });

  $(".cancel_btn").on("click", function (e) {
    e.preventDefault();
    $(".edit_cont").hide();
    $(".btn").hide();
    $(".default_cont").show();
  });

  /* 프로필 사진 */
  $("#uplode_btn").on("click", function (e) {
    e.preventDefault();
    $("#img_input").click();
  });

  $("#remove_btn").on("click", function (e) {
    e.preventDefault();
    $("#profile_photo_edit").attr("src", "./images/profile.png");
  });

  /* 미리보기 */
  $("#img_input").change(function () {
    setImageFromFile(this, "#profile_photo_edit");
  });

  const setImageFromFile = (input, expression) => {
    if (input.files && input.files[0]) {
      //파일이 있으면
      var reader = new FileReader(); //파일을 읽는 객체 생성
      reader.onload = function (e) {
        //파일을 읽기에 성공하면 e 변수로 접근
        //이미지 Tag의 SRC속성에 읽어들인 File내용을 지정
        //(아래 코드에서 읽어들인 dataURL형식)
        $(expression).attr("src", e.target.result); // html태그 중 id 가 empImg 인 태그에 src 속성 값을 읽은 파일로 변경 ( src = "파일에서 읽은 값 즉 파일")
        // console.log(e.target.result);
      };
      // File내용을 읽어 dataURL형식의 문자열로 저장
      reader.readAsDataURL(input.files[0]);
    }
  };

  /* 유효성 검사 */
  var regMobile = /^[0-9]+$/;

  const nameCheck = () => {
    var name_len = $("#user_name_input").val().length;

    if (!$("#user_name_input").val()) {
      $("#user_name_input").addClass("err_input mr").focus();
      $("#user_name_input").removeClass("user_input");
      $("#err_name").css({ display: "block" }).text("이름을 입력해주세요");
      return false;
    } else if (name_len < 2) {
      $("#user_name_input").addClass("err_input mr").focus();
      $("#user_name_input").removeClass("user_input");
      $("#err_name")
        .css({ display: "block" })
        .text("두 글자 이상 입력해주세요");
      return false;
    } else {
      $("#user_name_input").addClass("user_input");
      $("#user_name_input").removeClass("err_input mr");
      $("#err_name").css({ display: "none" });
      return true;
    }
  };

  $("#user_name_input").on("keyup", function () {
    nameCheck();
  });

  const nicknameCheck = () => {
    var nickname_len = $("#user_nickname_input").val().length;

    if (!$("#user_nickname_input").val()) {
      $("#user_nickname_input").addClass("err_input mr").focus();
      $("#user_nickname_input").removeClass("user_input");
      $("#err_nickname")
        .css({ display: "block" })
        .text("닉네임을 입력해주세요");
      return false;
    } else if (nickname_len < 2) {
      $("#user_nickname_input").addClass("err_input mr").focus();
      $("#user_nickname_input").removeClass("user_input");
      $("#err_nickname")
        .css({ display: "block" })
        .text("두 글자 이상 입력해주세요");
      return false;
    } else {
      $("#user_nickname_input").addClass("user_input");
      $("#user_nickname_input").removeClass("err_input mr");
      $("#err_nickname").css({ display: "none" });
      return true;
    }
  };

  $("#user_nickname_input").on("keyup", function () {
    nicknameCheck();
  });

  const mobileCheck = () => {
    if (!$("#user_mobile_input").val()) {
      $("#user_mobile_input").addClass("err_input mr").focus();
      $("#user_mobile_input").removeClass("user_input");
      $("#err_mobile")
        .css({ display: "block" })
        .text("휴대폰 번호를 입력해주세요");
      return false;
    } else if (!regMobile.test($("#user_mobile_input").val())) {
      $("#user_mobile_input").addClass("err_input mr").focus();
      $("#user_mobile_input").removeClass("user_input");
      $("#err_mobile")
        .css({ display: "block" })
        .text('"-"없이 숫자만 입력해주세요');
      return false;
    } else {
      $("#user_mobile_input").addClass("user_input");
      $("#user_mobile_input").removeClass("err_input mr");
      $("#err_mobile").css({ display: "none" });
      return true;
    }
  };

  $("#user_mobile_input").on("input", function () {
    mobileCheck();
  });

  /* input 값 넘겨주기*/
  $("#save_btn").on("click", function () {
    if (!nameCheck() || !nicknameCheck() || !mobileCheck()) {
      nameCheck();
      nicknameCheck();
      mobileCheck();
      return false;
    } else {
      $('#user_form').submit();

      $.ajax({
        url: '../user/user_edit.php',
        type: 'POST',
        data: {
          u_name : $("#user_name_input").val(),
          u_nickname : $("#user_nickname_input").val(),
          u_phone : $("#user_phone_input").val(),
          u_marketing : $("#mk_btn1").val(),
        },
        seccess: function(data) {
          console.log(data);
        }
      });
    }
  });

  /* 회원 탈퇴 */
  $('#remove_user').on('click', function() {
    var rtn_val = confirm("정말 탈퇴하시겠습니까?");
    if(rtn_val == true){
      location.href = "user_delete.php"
    };
  });

  /* 비밀번호 변경 팝업 */
  $(".pwd_change_btn").on("click", function (e) {
    e.preventDefault();

    $(".pwd_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $(".modal_cancel_btn").on("click", function () {
    $(".pwd_modal_bg").hide();
    $("body").removeClass("scrollLock");
    $("#pwd").val('').addClass("pwd_input").removeClass("pwd_err_input pwd_mr");
    $("#repwd").val('').addClass("pwd_input").removeClass("pwd_err_input");
    $("#err_pwd").css({ display: "none" });
    $("#err_repwd").css({ display: "none" });
  });

  $(".pwd_cancel_btn").on("click", function () {
    $(".pwd_modal_bg").hide();
    $("body").removeClass("scrollLock");
    $("#pwd").val('').addClass("pwd_input").removeClass("pwd_err_input pwd_mr");
    $("#repwd").val('').addClass("pwd_input").removeClass("pwd_err_input");
    $("#err_pwd").css({ display: "none" });
    $("#err_repwd").css({ display: "none" });
  });

  /* 비밀번호 유효성검사 */
  var regPwd =/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;

  const pwdCheck = () => {
    if (!$("#pwd").val()) {
      $("#pwd").addClass("pwd_err_input pwd_mr").focus();
      $("#pwd").removeClass("pwd_input");
      $("#err_pwd").css({ display: "block" }).text("비밀번호를 입력해주세요");
      return false;
    } else if (!regPwd.test($("#pwd").val())) {
      $("#pwd").addClass("pwd_err_input pwd_mr").focus();
      $("#pwd").removeClass("pwd_input");
      $("#err_pwd")
        .css({ display: "block" })
        .text("문자/숫자/특수문자 포함 8자 ~ 20자 사이로 입력해주세요");
      return false;
    } else {
      $("#pwd").addClass("pwd_input");
      $("#pwd").removeClass("pwd_err_input pwd_mr");
      $("#err_pwd").css({ display: "none" });
      return true;
    }
  };

  $("#pwd").on("keyup", function () {
    pwdCheck();
  });

  const repwdCheck = () => {
    if (!$("#repwd").val()) {
      $("#repwd").addClass("pwd_err_input").focus();
      $("#repwd").removeClass("pwd_input");
      $("#err_repwd")
        .css({ display: "block" })
        .text("비밀번호 확인을 입력해주세요");
      return false;
    } else if ($("#pwd").val() != $("#repwd").val()) {
      $("#repwd").addClass("pwd_err_input").focus();
      $("#repwd").removeClass("pwd_input");
      $("#err_repwd")
        .css({ display: "block" })
        .text("비밀번호가 일치하지 않습니다");
      return false;
    } else {
      $("#repwd").addClass("pwd_input");
      $("#repwd").removeClass("pwd_err_input");
      $("#err_repwd").css({ display: "none" });
      return true;
    }
  };

  $("#repwd").on("keyup", function () {
    repwdCheck();
  });
});
