$(document).ready(function () {
  $('#header-include').load('http://localhost/KDT-1st-project-minda/inc/header.php', function(){
    $('.gnb li li').on('click', function(){
      $(this).parentsUntil('li').addClass('menu_select');
      $(this).addClass('menu_select_bar');
      $('.gnb li li').not(this).removeClass('menu_select_bar');
    })
  });
  $('#footer-include').load('http://localhost/KDT-1st-project-minda/inc/footer.html');
  $('#partner-footer-include').load('http://localhost/KDT-1st-project-minda/inc/partner_footer.html');
});
