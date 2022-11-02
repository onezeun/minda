$(document).ready(function () {
  $('#header-include').load('../inc/header.php', function (response, status, xhr) {
      if (status == 'error') {
        // alert(msg + xhr.status + " " + xhr.statusText);
        console.log(msg + xhr.status + ' ' + xhr.statusText);
      }
    }
  );
  $('#footer-include').load('../inc/footer.html');
});
