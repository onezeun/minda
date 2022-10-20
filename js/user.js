$(document).ready(function () {

  $('.edit_btn').on('click', function(){
    $('.edit_cont').toggle();
    $('.default_cont').toggle();
    $('.btn').toggle();
    $('.edit_btn').toggleClass('edit_btn_click');
  })


});