$(document).ready(function () {
  /* 슬라이드 */
  $('#room_slide')
    .not('.slick-initialized')
    .slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      variableWidth: true,
      prevArrow: $('#room_btn1'),
      nextArrow: $('#room_btn2'),
    });

  /* 객실 사진 등록 */
  $('#room_img_btn').on('click', function () {
    $('#room_img_input').click();
  });

  /* 미리보기 */
  $('#room_img_input').change(function () {
    roomImg(this, '#room_img');
  });

  const roomImg = (input, expression) => {
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

    /* 유효성검사 */
    $('#room_submit_btn').on('click', function () {
      $('#room_form').submit();
    });
});
