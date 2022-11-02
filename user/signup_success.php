<?php
include "../inc/session.php";
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>회원가입 완료</title>
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <link rel="stylesheet" type="text/css" href="../css/header.css" />
    <link rel="stylesheet" type="text/css" href="../css/footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/signup_success.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.1.js"
      integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $('#header-include').load('../header.html');
        $('#footer-include').load('../footer.html');

        $('.gomain_btn').on('click', function() {
          location.href="../index.html"
          <?php unset($_SESSION["s_name"]); ?>
        })

        $('.login_btn').on('click', function() {
          location.href="../login.html"
          <?php unset($_SESSION["s_name"]); ?>
        })
      });
    </script>
  </head>

  <body>
    <div class="wrap">
      <!-- header -->
      <header>
        <div id="header-include"></div>
      </header>

      <!-- content -->
      <main id="content" class="content">
        <h2 class="success_icon indent">회원가입완료페이지</h2>
        <p class="success_txt1">회원가입이 완료되었습니다.</p>
        <p class="success_txt2">
          <span class="user_name"><?php echo $s_name; ?></span>님의 회원가입을
          축하합니다.
        </p>
        <p class="success_txt3">민다에서 다양한 숙소를 확인해보세요!</p>
        <button type="button" class="gomain_btn">메인으로</button>
        <button type="button" class="login_btn">로그인</button>
      </main>

      <!-- footer -->
      <footer>
        <div id="footer-include"></div>
      </footer>
    </div>
  </body>
</html>
