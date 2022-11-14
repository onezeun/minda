$(document).ready(function () {

  /* DB 조회 */
  $.ajax({
    url: '../room/list_read.php',
    type: 'POST',
    datatype: 'json',
  }).done(function (data) {
    console.log(data)
    // $('.user_email_val').text(data.u_email);
    // $('#user_name_input').val(data.u_name);
    // $('#user_nickname_input').val(data.u_nickname);
    // $('#user_mobile_input').val(data.u_phone);
    // if (data.u_marketing == 'Y') {
    //   $('#mk_btn1').attr('checked', true);
    // } else {
    //   $('#mk_btn2').attr('checked', true);
    // }

    // if (data.u_img == null) {
    //   $('.profile_photo').attr('src', '../images/default_profile.png');
    // } else {
    //   $('.profile_photo').attr('src', data.u_img);
    // }

    // /* value */
    // $('#user_name_val').text(data.u_name);
    // $('#user_nickname_val').text(data.u_nickname);
    // $('#user_mobile_val').text(
    //   data.u_phone.replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`),
    // );
    // if (data.u_marketing == 'Y') {
    //   $('.mk_txt').text('수신');
    // } else {
    //   $('.mk_txt').text('수신거부');
    // }
  });
});