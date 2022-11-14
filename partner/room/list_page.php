<?php
  include "../inc/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>파트너 숙소리스트</title>
  <link rel="shortcut icon" href="../../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../../css/reset.css" />
  <link rel="stylesheet" type="text/css" href="../../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/room_list.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/include.js"></script>
  <script type="text/javascript" src="../../js/slick.js"></script>
  <script type="text/javascript" src="../js/room_list.js"></script>

</head>
<body>
  <div class="wrap">
    <!-- header -->
    <header>
      <div id="partner-header-include"></div>
    </header>

    <!-- content -->
    <main id="content" class="content">
      <div class="side_bar">
        <h2 class="hide">관리메뉴</h2>
        <div class="partner_info">
          <a href="../partner_info_page.php">파트너 정보</a>
        </div>
        <div class="ldg_list">
          <a href="list_page.php">숙소 리스트</a>
        </div>
        <div class="reservation">
          <a href="../reservation/partner_reservation_page.php">예약 관리</a>
        </div>
        <div class="message">
          <a href="#">메세지</a>
        </div>
        <div class="review">
          <a href="#">후기 관리</a>
        </div>
      </div>

      <div class="cont">
        <p class="list_title">총 <span>1</span>개의 숙소가 등록되어있습니다.</p>
        <a href="new_room_page.php" class="new_ldg btn_hover">신규 등록</a>
        <div class="ldg_card">
          <img src="../../images/search_room_img01.png" alt="검색된숙소이미지1">
          <ul class="ldg_card_menu">
            <li><a href="../reservation/partner_reservation_page.php" class="menu_btn btn_hover">예약관리</a></li>
            <li><a href="edit_room_page.php" class="menu_btn btn_hover">숙소관리</a></li>
            <li><a href="#" class="menu_btn btn_hover">후기관리</a></li>
          </ul>
          <div class="ldg_card_left">
            <div class="ldg_card_top">
              <p class="lodging_name">런던스테이</p>
              <p class="room_type">도미토리 · 개인실</p>
            </div>
            <div class="ldg_card_bot">
              <p class="room_service">조식, 석식 제공 · Wifi · 개인사물함</p>
              <div class="ldg_card_review">
                <span class="review_star">리뷰점수</span>
                <span class="review_count">5.0</span>
                <span class="review_comment">6개의 이용후기</span>
              </div>
            </div>
          </div>
          <div class="ldg_card_right">
            <p class="ldg_card_day indent">1박</p>
            <p class="ldg_card_price">90,900 원~</p>
          </div>
        </div>
      </div>
    </main>

    <!-- footer -->
    <footer>
      <div id="partner-footer-include"></div>
    </footer>
  </div>
</body>

</html>