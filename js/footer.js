$(document).ready(function () {
  /* 팝업 */
  $(".footer_gopatner").on("click", function (e) {
    e.preventDefault();

    $(".ptn_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $(".ptn_pop_cancel_btn").on("click", function () {
    $(".ptn_modal_bg").hide();
    $("body").removeClass("scrollLock");
    $("#ptn_pop_name")
      .val("")
      .addClass("ptn_pop_input")
      .removeClass("ptn_err_input mr");
    $("#ptn_pop_tel")
      .val("")
      .addClass("ptn_pop_input")
      .removeClass("ptn_err_input");
    $("#ptn_err_name").css({ display: "none" });
    $("#ptn_err_tel").css({ display: "none" });
    $("#ptn_pop_err_apply").css({ display: "none" });
    $("input[type=checkbox]").prop('checked', false);
  });

  $(".ptn_signup_cancel_btn").on("click", function () {
    $(".ptn_modal_bg").hide();
    $("body").removeClass("scrollLock");
    $("#ptn_pop_name")
      .val("")
      .addClass("ptn_pop_input")
      .removeClass("ptn_err_input mr");
    $("#ptn_pop_tel")
      .val("")
      .addClass("ptn_pop_input")
      .removeClass("ptn_err_input");
    $("#ptn_err_name").css({ display: "none" });
    $("#ptn_err_tel").css({ display: "none" });
    $("#ptn_pop_err_apply").css({ display: "none" });
    $("input[type=checkbox]").prop('checked', false);
  });

  /* 유효성 검사 */
  var regTel = /^[0-9]+$/;
  const nameCheck = () => {
    var name_len = $("#ptn_pop_name").val().length;

    if (!$("#ptn_pop_name").val()) {
      $("#ptn_pop_name").addClass("ptn_pop_err_input ptn_pop_mr").focus();
      $("#ptn_pop_name").removeClass("ptn_pop_input");
      $("#ptn_err_name")
        .css({ display: "block" })
        .text("파트너명을 입력해주세요");
      return false;
    } else if (name_len < 2) {
      $("#ptn_pop_name").addClass("ptn_pop_err_input ptn_pop_mr").focus();
      $("#ptn_pop_name").removeClass("ptn_pop_input");
      $("#ptn_err_name")
        .css({ display: "block" })
        .text("두 글자 이상 입력해주세요");
      return false;
    } else {
      $("#ptn_pop_name").addClass("ptn_pop_input");
      $("#ptn_pop_name").removeClass("ptn_pop_err_input ptn_pop_mr");
      $("#ptn_err_name").css({ display: "none" });
      return true;
    }
  };

  $("#ptn_pop_name").on("keyup", function () {
    nameCheck();
  });

  const telCheck = () => {
    if (!$("#ptn_pop_tel").val()) {
      $("#ptn_pop_tel").addClass("ptn_pop_err_input ptn_pop_mr").focus();
      $("#ptn_pop_tel").removeClass("ptn_pop_input");
      $("#ptn_err_tel")
        .css({ display: "block" })
        .text("업체 연락처를 입력해주세요");
      return false;
    } else if (!regTel.test($("#ptn_pop_tel").val())) {
      $("#ptn_pop_tel").addClass("ptn_pop_err_input ptn_pop_mr").focus();
      $("#ptn_pop_tel").removeClass("ptn_pop_input");
      $("#ptn_err_tel")
        .css({ display: "block" })
        .text('"-"없이 숫자만 입력해주세요');
      return false;
    } else {
      $("#ptn_pop_tel").addClass("ptn_pop_input");
      $("#ptn_pop_tel").removeClass("ptn_pop_err_input ptn_pop_mr");
      $("#ptn_err_tel").css({ display: "none" });
      return true;
    }
  };

  $("#ptn_pop_tel").on("input", function () {
    telCheck();
  });

  const applyCheck = () => {
    var check1 = $(".ptn_pop_checkbox01").is(":checked");
    var check2 = $(".ptn_pop_checkbox02").is(":checked");
    var check3 = $(".ptn_pop_checkbox03").is(":checked");

    if (!check1 || !check2 || !check3) {
      $("#ptn_pop_err_apply")
        .css({ display: "block" })
        .text("필수약관에 동의해주세요");
      return false;
    } else {
      $("#ptn_pop_err_apply").css({ display: "none" });
      return true;
    }
  };

  $(".ptn_pop_term")
    .find("input")
    .on("change", function () {
      var checked = $(this).is(":checked");
      var check1 = $(".ptn_pop_checkbox01").is(":checked");
      var check2 = $(".ptn_pop_checkbox02").is(":checked");
      var check3 = $(".ptn_pop_checkbox03").is(":checked");
      applyCheck();
      if (check1 && check2 && check3) {
        $("#ptn_pop_err_apply").css({ display: "none" });
      }
    });

  /* 약관 동의 체크 */
  // 체크박스 전체 선택, 해제
  $("#ptn_pop_check_all").on("click", function () {
    var checked = $(this).is(":checked");
    if (checked) {
      $(".ptn_pop_term_wrap").find("input").prop("checked", true);
    } else {
      $(".ptn_pop_term_wrap").find("input").prop("checked", false);
    }
  });

  // 하나 체크 해제했을 때 전체선택 해제
  $(".ptn_nomal").on("click", function () {
    var checked = $(this).is(":checked");

    if (!checked) {
      $("#ptn_pop_check_all").prop("checked", false);
    }
  });

  // 개별 선택으로 두개 다 체크되었을 때 전체선택에도 체크
  $(".ptn_nomal").on("click", function () {
    var check1 = $(".ptn_pop_checkbox01").is(":checked");
    var check2 = $(".ptn_pop_checkbox02").is(":checked");
    var check3 = $(".ptn_pop_checkbox03").is(":checked");

    if (check1 && check2 && check3) {
      $("#ptn_pop_check_all").prop("checked", true);
    }
  });
});
