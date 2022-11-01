$(document).ready(function () {
  $(".top_user_name").on('click', function() {
    $('.top_user_menu').stop().fadeToggle(150);
  })

  $(document).on('mouseup', function (e) {
    if (!$(e.target).hasClass('area')) {
      $('.top_user_menu').fadeOut(150);
    }
  });
});