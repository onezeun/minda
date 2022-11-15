$(document).ready(function () {
  /* 슬라이드 */
  $('#room_slide').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    prevArrow: $('#room_btn1'),
    nextArrow: $('#room_btn2'),
  });

  /* 숙소 소개 팝업 */
  $(".ldg_info_btn").on("click", function (e) {
    e.preventDefault();

    $(".ldg_info_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $("#ldg_pop_cancel").on("click", function () {
    $(".ldg_info_modal_bg").hide();
    $("body").removeClass("scrollLock");
  });

  $('#info_save_btn').on('click', function() {
    $('#ldg_info_btn').text("등록 내용 확인").css({color : "#eeb72f"})
    $(".ldg_info_modal_bg").hide();
    $("body").removeClass("scrollLock");
  })

  /* 메인 이미지 등록 */
  $('#main_img_btn').on('click', function () {
    $('#ldg_mainimg_input').click();
  });

    /* 미리보기 */
    $('#ldg_mainimg_input').change(function () {
      setImageFromFile(this, '#ldg_pop_main_img');
    });
  
    const setImageFromFile = (input, expression) => {
      if (input.files && input.files[0]) {
        //파일이 있으면
        var reader = new FileReader(); //파일을 읽는 객체 생성
        reader.onload = function (e) {
          //파일을 읽기에 성공하면 e 변수로 접근
          //이미지 Tag의 SRC속성에 읽어들인 File내용을 지정
          //(아래 코드에서 읽어들인 dataURL형식)
          $(expression).attr('src', e.target.result); // html태그 중 id 가 empImg 인 태그에 src 속성 값을 읽은 파일로 변경 ( src = "파일에서 읽은 값 즉 파일")
          // console.log(e.target.result);
        };
        // File내용을 읽어 dataURL형식의 문자열로 저장
        reader.readAsDataURL(input.files[0]);
      }
    };

    // $('.ck_box').change(function () {
    //   if(!$(this).is(":checked")) {
    //     $(this).attr('value', '0');
    //     console.log($(this).val());
    //   } else {
    //     $(this).attr('value', '1');
    //     console.log($(this).val());
    //   }
    // });

  /* 숙소 유효성검사 */
  $('#ldg_submit_btn').on('click', function(){

    // var ckbox = $('.ck_box');
    // var facility_length = ckbox.length;
    // for (var i=0; i<facility_length; i++) {
    //   if(ckbox[i].val() != "1") {
    //     ckbox.val("0");
    //     console.log("0일때",ckbox.val())
    //   } else {
    //     ckbox.val("1");
    //     console.log("1일때",ckbox.val())
    //   }
    $('#ldg_form').submit();
  // }
});

  /* 객실 등록 팝업 */
  $("#room_btn").on("click", function (e) {
    e.preventDefault();

    $(".room_modal_bg").fadeTo("fast", 1);
    $("body").addClass("scrollLock");
  });

  $("#room_pop_cancel").on("click", function () {
    $(".room_modal_bg").hide();
    $("body").removeClass("scrollLock");
  });

});
