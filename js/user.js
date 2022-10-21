$(document).ready(function () {
  /* 기본 값 */
  if (!$('.user_name_val').text() == '') {
    $('#user_name_input').val($('.user_name_val').text());
  }

  if (!$('.user_nickname_val').text() == '') {
    $('#user_nickname_input').val($('.user_nickname_val').text());
  }

  if (!$('.user_mobile_val').text() == '') {
    $('#user_mobile_input').val($('.user_mobile_val').text().replace(/\-/g,''));
  }

  if ($('.mk_txt').text() === '수신') {
    $('#mk_btn1').attr('checked', true);
  } else {
    $('#mk_btn2').attr('checked', false);
  }

  /* 편집 버튼 토글 */
  $('.edit_btn').on('click', function () {
    $('.edit_cont').toggle();
    $('.default_cont').toggle();
    $('.btn').show();
    $('.edit_btn').toggleClass('edit_btn_click');
  });

  $('.cancel_btn').on('click', function (e) {
    e.preventDefault();
    $('.edit_cont').hide();
    $('.btn').hide();
    $('.default_cont').show();
  });

  /* 프로필 사진 */
  $('#uplode_btn').on('click', function(e){
    e.preventDefault();
    $('#img_input').click();
  })

  $('#remove_btn').on('click', function(e){
    e.preventDefault();
    $('#profile_photo_edit').attr('src', "./images/profile.png")
  })

  /* 미리보기 */
  $('#img_input').change(function () {
    setImageFromFile(this, '#profile_photo_edit');
  });

  const setImageFromFile = (input, expression) => {
    if (input.files && input.files[0]) {  //파일이 있으면
      var reader = new FileReader();      //파일을 읽는 객체 생성
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
  }

  /* 유효성 검사 */
  var regMobile = /^[0-9]+$/;

  const nameCheck = () => {
    var name_len = $('#user_name_input').val().length;

    if (!$('#user_name_input').val()) {
      $('#user_name_input').addClass('err_input mr').focus();
      $('#user_name_input').removeClass('user_input');
      $('#err_name').css({ display: 'block' }).text('이름을 입력해주세요');
      return false;
    } else if (name_len < 2) {
      $('#user_name_input').addClass('err_input mr').focus();
      $('#user_name_input').removeClass('user_input');
      $('#err_name')
        .css({ display: 'block' })
        .text('두 글자 이상 입력해주세요');
      return false;
    } else {
      $('#user_name_input').addClass('user_input');
      $('#user_name_input').removeClass('err_input mr');
      $('#err_name').css({ display: 'none' });
      return true;
    }
  };

  $('#user_name_input').on('keyup', function () {
    nameCheck();
  });

  const nicknameCheck = () => {
    var nickname_len = $('#user_nickname_input').val().length;

    if (!$('#user_nickname_input').val()) {
      $('#user_nickname_input').addClass('err_input mr').focus();
      $('#user_nickname_input').removeClass('user_input');
      $('#err_nickname')
        .css({ display: 'block' })
        .text('닉네임을 입력해주세요');
      return false;
    } else if (nickname_len < 2) {
      $('#user_nickname_input').addClass('err_input mr').focus();
      $('#user_nickname_input').removeClass('user_input');
      $('#err_nickname')
        .css({ display: 'block' })
        .text('두 글자 이상 입력해주세요');
      return false;
    } else {
      $('#user_nickname_input').addClass('user_input');
      $('#user_nickname_input').removeClass('err_input mr');
      $('#err_nickname').css({ display: 'none' });
      return true;
    }
  };

  $('#user_nickname_input').on('keyup', function () {
    nicknameCheck();
  });

  const mobileCheck = () => {
    if (!$('#user_mobile_input').val()) {
      $('#user_mobile_input').addClass('err_input mr').focus();
      $('#user_mobile_input').removeClass('user_input');
      $('#err_mobile')
        .css({ display: 'block' })
        .text('휴대폰 번호를 입력해주세요');
      return false;
    } else if (!regMobile.test($('#user_mobile_input').val())) {
      $('#user_mobile_input').addClass('err_input mr').focus();
      $('#user_mobile_input').removeClass('user_input');
      $('#err_mobile')
        .css({ display: 'block' })
        .text('"-"없이 숫자만 입력해주세요');
      return false;
    } else {
      $('#user_mobile_input').addClass('user_input');
      $('#user_mobile_input').removeClass('err_input mr');
      $('#err_mobile').css({ display: 'none' });
      return true;
    }
  };

  $('#user_mobile_input').on('input', function () {
    mobileCheck();
  });

  /* input 값 넘겨주기*/
  $('.save_btn').on('click', function (e) {
    e.preventDefault();

    if (!nameCheck() || !nicknameCheck() || !mobileCheck()) {
      nameCheck();
      nicknameCheck();
      mobileCheck();
      return false;
    } else {
      $('.edit_cont').hide();
      $('.default_cont').show();
      $('.btn').hide();

      if(!$('#profile_photo_edit').attr('src') == '') {
        var new_img = $('#profile_photo_edit').attr('src')
        $('#profile_photo_save').attr('src', new_img)
      }
      
      if ($('#user_name_input').val() != $('.user_name_val')) {
        $('.user_name_val').text($('#user_name_input').val());
      }

      if ($('#user_nickname_input').val() != $('.user_nickname_val')) {
        $('.user_nickname_val').text($('#user_nickname_input').val());
      }

      if ($('#user_mobile_input').val() != $('.user_mobile_val')) {
        $('.user_mobile_val').text($('#user_mobile_input').val().replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`));
      }

      if ($('#mk_btn1').is(':checked')) {
        $('.mk_txt').text('수신');
      } else {
        $('.mk_txt').text('수신거부');
      }
      
     // $('#user_form').submit();
    }
  });
});
