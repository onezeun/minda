<?php
  include "inc/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>파트너 예약관리 페이지</title>
  <link rel="shortcut icon" href="../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/reset.css" />
  <link rel="stylesheet" type="text/css" href="../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/partner_reservation.css" />
  <link rel="stylesheet" type="text/css" href="../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/include.js"></script>
  <script type="text/javascript" src="../js/slick.js"></script>
  <script type="text/javascript" src="../js/partner_reservation.js"></script>
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
        <div class="reservation">
          <a href="partner_reservation.php?p_idx=<?php echo $sp_idx ?>" id="res_menu">예약 관리</a>
        </div>
        <div class="message">
          <a href="#">메세지</a>
        </div>
        <div class="review">
          <a href="#">후기 관리</a>
        </div>
        <div class="room">
          <a href="partner_room.php?p_idx=<?php echo $sp_idx ?>" id="room_menu">숙소 및 객실 관리</a>
        </div>
        <div class="partner_info">
          <a href="partner_info.php?p_idx=<?php echo $sp_idx ?>" id="info_menu">파트너 정보 수정</a>
        </div>
      </div>

      <div class="reservation_cont">
        <div class="checkout">
          <h2 class="checkout_title">체크아웃 예정</h2>
          <!-- <ul id="checkout_slide" class="card_slide">
            <li class="block">
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img">
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>
          </ul> -->

          <div class="cstm_none">
            <img src="./images/partner_reservation_icon.png" alt="예약없음 아이콘" class="cstm_none_img" />
            <p>오늘과 내일은 체크아웃하는 게스트가 없습니다.</p>
          </div>
        </div>
        <div class="line"></div>
        <div class="checkin">
          <h2 class="checkin_title">체크인 예정</h2>
          <ul id="checkin_slide" class="card_slide">
            <li>
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img" />
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>

            <li>
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img" />
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>

            <li>
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img" />
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>

            <li>
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img" />
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>

            <li>
              <div class="cstm_card">
                <p class="cstm_num"><a href="#">예약번호 200000000</a></p>
                <img src="./images/profile.png" alt="고객 프로필 이미지" class="cstm_img" />
                <p>한지은</p>
                <p>010-0000-0000</p>
                <p>체크아웃 2023/04/23</p>
                <div class="massage_btn">
                  <a href="#">1:1 메세지</a>
                </div>
              </div>
            </li>
          </ul>

          <a href="#" id="checkin_btn1" class="card_prev">이전</a>
          <a href="#" id="checkin_btn2" class="card_next">다음</a>
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