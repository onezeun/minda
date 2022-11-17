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
    subImg(e);
  });

  $('#sub_img_del_btn').on('click', function () {
    $('img').remove('.ldg_sub_img');
  });

  const subImg = (e) => {
    var maxFileCnt = 4; // 이미지 최대 개수
    var attFileCnt = $('.ldg_sub_img_wrap').children().length; // 기존 추가된 이미지 개수
    var remainFileCnt = maxFileCnt - attFileCnt; // 추가로 첨부가능한 개수
    var curFileCnt = e.target.files.length; // 현재 선택된 이미지 개수

    // 이미지 개수 확인
    if (curFileCnt > remainFileCnt) {
      alert('이미지는 최대 ' + maxFileCnt + '개 까지 첨부 가능합니다.');
      return false;
    };

    for (var image of e.target.files) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var sub_img = $('<img class="ldg_sub_img">');
        sub_img.attr('src', e.target.result);
        $('.ldg_sub_img_wrap').append(sub_img);
      };

      if (image.length > 4) {
        image = image.slice(0, 4);
      }
      console.log(image);
      reader.readAsDataURL(image);
    }
  };

  /* 유효성검사 */
  $('#ldg_edit_btn').on('click', function () {
    $('#ldg_edit_form').submit();
  });
});
