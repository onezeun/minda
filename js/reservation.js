$(document).ready(function () {

  /* 유효성 검사 */
  const nameCheck = () => {
    if (!$("#name_input").val()) {
      $("#name_input").addClass("err_input").focus();
      $("#err_name").css({ display: "inline-block" }).text("이름을 입력해주세요");
      return false;
    } else return true;
  }

  const mobileCheck = () => {
    if (!$("#mobile_input").val()) {
      $("#mobile_input").addClass("err_input").focus();
      $("#err_mobile").css({ display: "inline-block" }).text("연락처를 입력해주세요");
      return false;
    } else return true;
  }

  const emailCheck = () => {
    if (!$("#email_input").val()) {
      $("#email_input").addClass("err_input").focus();
      $("#err_email").css({ display: "inline-block" }).text("이메일주소를 입력해주세요");
      return false;
    } else return true;
  }

  const TimeCheck = () => {
    if (!$("#checkin_input").val()) {
      $("#checkin_input").addClass("err_input").focus();
      $("#err_checkin").css({ display: "inline-block" }).text("체크인예정시간을 입력해주세요");
      return false;
    } else return true;
  }


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

  $("#checkin_input").on("keyup", function () {
    $("#checkin_input").removeClass("err_input");
    $("#err_checkin").css({ display: "none" });
  });


  $("#reservation_btn").on("click", function () {
    if (!nameCheck() || !mobileCheck() || !emailCheck() || !TimeCheck()) {
      nameCheck();
      mobileCheck();
      emailCheck();
      TimeCheck();
      return false;
    } else $("#reservation_form").submit();
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

    console.log("check1",check1)
    if(check1 && check2 == true){
      $("#check_all").prop("checked", true);
    } 
  })
});