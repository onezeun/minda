$(document).ready(function () {
  /* 메인 이미지 등록 */
  $('#main_img_btn').on('click', function () {
    $('#ldg_mainimg_input').click();
  });

  /* 미리보기 */
  $('#ldg_mainimg_input').change(function () {
    mainImg(this, '#ldg_main_img');
  });

  const mainImg = (input, expression) => {
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

  /* 서브 이미지 등록 */
  $('#sub_img_btn').on('click', function () {
    $('#ldg_subimg_input').click();
  });

  /* 미리보기 */
  $('#ldg_subimg_input').change(function (e) {
    var sub_img = $('.ldg_sub_img_wrap').children().length;
    if(sub_img <= 3 ) {
      subImg(e);
    } else {
      alert("4개까지만 등록 가능합니다.")
    }
  });

  const subImg = (e) => {
    for (var image of e.target.files) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var sub_img = $('<img class="ldg_sub_img">');
        sub_img.attr('src', e.target.result);
        $('.ldg_sub_img_wrap').append(sub_img);
      };
      console.log(image);
      reader.readAsDataURL(image);
    }
  };

  /* 유효성검사 */
  $('#ldg_submit_btn').on('click', function () {
    $('#ldg_form').submit();
  });
});
