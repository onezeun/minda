<?php
  include "inc/session.php";

  // DB 연결
  include "inc/dbcon.php";

  $ldg_idx = $_GET['ldg_idx'];
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>숙소 상세</title>
  <link rel="shortcut icon" href="../images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="stylesheet" type="text/css" href="../css/lodging_detail.css">
  <link rel="stylesheet" type="text/css" href="../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../css/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
    </script>
  <script type="text/javascript" src="../js/includ.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="../js/slick.js"></script>
  <script type="text/javascript" src="../js/lodging_detail.js"></script>
</head>

<body>
  <div class="wrap">
    <!-- header -->
    <header>
      <div id="header-include"></div>
    </header>

    <!-- content -->
    <main id="content" class="content">
      <h2 class="indent">숙소상세페이지</h2>
      <div class="main_cont">
        <div class="main_cont_left">
          <ul class="slider-for">
            <li><img src="../images/ldg_img01.jpg" alt="숙소대표이미지1"/></li>
            <li><img src="../images/ldg_img02.jpg" alt="숙소대표이미지2"/></li>
            <li><img src="../images/ldg_img03.jpg" alt="숙소대표이미지3"/></li>
            <li><img src="../images/ldg_img04.jpg" alt="숙소대표이미지4"/></li>
            <li><img src="../images/ldg_img05.jpg" alt="숙소대표이미지4"/></li>
          </ul>
          <div class="carousel">
            <ul class="slider-nav">
              <li><img src="../images/ldg_main_img.jpg" alt="숙소이미지1" class="nav_img"/></li>
              <li><img src="../images/ldg_img02.jpg" alt="숙소이미지2" class="nav_img"/></li>
              <li><img src="../images/ldg_img03.jpg" alt="숙소이미지3" class="nav_img"/></li>
              <li><img src="../images/ldg_img04.jpg" alt="숙소이미지4" class="nav_img"/></li>
              <li><img src="../images/ldg_img05.jpg" alt="숙소이미지4" class="nav_img"/></li>
            </ul>
            <a href="#" id="ldg_prev" class="ldg_prev indent">이전</a>
            <a href="#" id="ldg_next" class="ldg_next indent">다음</a>
          </div>
        </div>
        <div class="main_cont_right">
          <h3>런던스테이</h3>
          <p class="ldg_price">90,800원 ~</p>
          <div class="ldg_btn">
            <a href="#" class="ldg_share indent">공유</a>
            <a href="#" class="ldg_like indent">좋아요</a>
          </div>
          <div class="relike_wrap">
            <div class="main_cont_review">
              <span class="star_icon indent">별아이콘</span>
              <span class="gpa">5.0</span>
              <a href="#">리뷰보기</a>
            </div>
            <div class="main_cont_like">
              <p>이 숙소를 좋아하는 <span class="like_color_txt">132</span>명</p>
            </div>
          </div>
          <div class="pictogram">
            <ul>
              <li><span class="picto_img01 indent">이미지</span>
                <p>도미토리</p>
              </li>
              <li><span class="picto_img02 indent">이미지</span>
                <p>개인실</p>
              </li>
              <li><span class="picto_img03 indent">이미지</span>
                <p>최대 5명</p>
              </li>
              <li><span class="picto_img04 indent">이미지</span>
                <p>화장실 1개</p>
              </li>
              <li><span class="picto_img05 indent">이미지</span>
                <p>샤워실 1개</p>
              </li>
            </ul>
          </div>
          <div class="other_info">
            <div class="public">
              <h4>공용시설</h4>
              <p>Wifi, 헤어드라이기, 전자렌지, 커피포트, 토스트기, 엘리베이터</p>
            </div>
            <div class="location">
              <h4>위치</h4>
              <p>까탈루냐광장에서 도보 7분</p>
              <button type="button" class="location_btn">지도보기</button>
            </div>
          </div>
        </div>
      </div>
      <div class="room_cont">
        <div class="user_info">
          <h3>객실 예약</h3>
          <div class="date">
            <input type="text" id="daterange_check" class="checkin_box" readonly>
            <div class="data_placeholder">
              <span id="checkin_val" class="checkin_box_label">체크인</span>
              <img src="../images/date_arrow.png" alt="화살표아이콘" class="date_arrow">
              <span id="checkout_val" class="checkout_box_label">체크아웃</span>
            </div>
          </div>
          <div class="prs">
            <input type="text" placeholder="인원" class="prs_box" min="0" max="10" readonly>
            <div class="prs_btn_wrap">
              <button type="button" class="prs_mbtn"></button>
              <button type="button" class="prs_pbtn"></button>
            </div>
            <span class="warning_msg"></span>
          </div>
        </div>
        <div class="room_list">
          <div class="room_list_txt">
            <p>총 <span>4</span>개의 객실이 있습니다.</p>
          </div>
          <div class="room">
            <img src="../images/ldg_room_img01.jpg" alt="방 이미지">
            <div class="room_left">
              <p class="room_type">2인 여성도미토리</p>
              <p class="room_left_txt01">여성도미토리<span>객실정원 1~2</span></p>
              <p class="room_left_txt02">최소예약 1박이상</p>
            </div>
            <div class="room_right">
              <div class="room_right_txt_wrap">
                <p class="room_right_txt01">1인 1박</p>
                <p class="room_right_txt02">90,800원 (￡57)</p>
              </div>
              <button type="button" onclick="location.href='reservation.html'" class="room_right_btn btn_hover">예약</button>
            </div>
          </div>
          <div class="room">
            <img src="../images/ldg_room_img02.jpg" alt="방 이미지">
            <div class="room_left">
              <p class="room_type">2인 남성도미토리</p>
              <p class="room_left_txt01">남성도미토리<span>객실정원 1~2</span></p>
              <p class="room_left_txt02">최소예약 1박이상</p>
            </div>
            <div class="room_right">
              <div class="room_right_txt_wrap">
                <p class="room_right_txt01">1인 1박</p>
                <p class="room_right_txt02">90,800원 (￡57)</p>
              </div>
              <button type="button" onclick="location.href='reservation.html'" class="room_right_btn btn_hover">예약</button>
            </div>
          </div>
          <div class="room">
            <img src="../images/ldg_room_img03.jpg" alt="방 이미지">
            <div class="room_left">
              <p class="room_type">베이지룸 전체 (최대 2인)</p>
              <p class="room_left_txt01">개인실<span>객실정원 1~2</span></p>
              <p class="room_left_txt02">최소예약 2박이상</p>
            </div>
            <div class="room_right">
              <div class="room_right_txt_wrap">
                <p class="room_right_txt01">2인 1박</p>
                <p class="room_right_txt02">181,600원 (￡114)</p>
              </div>
              <button type="button" onclick="location.href='reservation.html'" class="room_right_btn btn_hover">예약</button>
            </div>
          </div>
          <div class="room">
            <img src="../images/ldg_room_img04.jpg" alt="방 이미지">
            <div class="room_left">
              <p class="room_type">블루룸 전체 (최대 2인)</p>
              <p class="room_left_txt01">개인실<span>객실정원 1~2</span></p>
              <p class="room_left_txt02">최소예약 2박이상</p>
            </div>
            <div class="room_right">
              <div class="room_right_txt_wrap">
                <p class="room_right_txt01">2인 1박</p>
                <p class="room_right_txt02">181,600원 (￡114)</p>
              </div>
              <button type="button" onclick="location.href='reservation.html'" class="room_right_btn btn_hover">예약</button>
            </div>
          </div>
        </div>
        <div class="room_intro">
          <h3>숙소 소개</h3>
          <div class="intro_txt">
            <p>*3박 미만 숙박을 원하시는 경우 사전 문의 부탁드립니다!</p>

            <p>안녕하세요. 쾌적하고 프라이빗한 여행 공간을 지향하는 런던스테이 입니다.<br>
              30대 한국인 부부가 직접 운영하는 소규모 숙소로 총 2개의 방(블루룸, 베이지룸)으로 구성되어 있습니다.<br>
              안전하고 프라이빗한 여행이 되실 수 있도록 편안하게 모시겠습니다:)</p>

            <p>
              <주요 특징>
            </p>
            <p>- 1존 런던 중심부에 위치한 숙소로 리젠트파크 옆 주거지역에 위치하여 안전하고 조용한 휴식 공간을 제공합니다.</p>

            <p>- 평일 아침 한식조식(꼬리곰탕, 육개장, 김치찌개, 소불고기 등)을 무료 제공해드리며, 컵라면(무료)이 구비되어 있습니다.</p>

            <p>- 특정시간 출입 제한 등의 번거로운 규칙이 없으며 지내시는 동안 개별 키를 드려 24시간 자유로운 왕래가 가능합니다.</p>

            <p>- 모든 방에 시스템 이중창이 설치되어 있어 채광, 단열, 소음에 좋습니다.</p>

            <p>- 각 침대마다 개인 옷장 및 노트북 스탠드를 제공하여 쾌적한 휴식과 여행준비가 가능합니다.</p>

            <p>- 욕실(1)과 화장실(1)가 분리되어 바쁜 아침 시간 유연한 이용이 가능합니다.</p>

            <p>- 엘리베이터가 있어 케리어와 함께 편리한 이동이 가능합니다.</p>

            <p>- 주인 부부가 함께 거주하여 안전하고 빠른 피드백이 가능합니다. 그 외 런던꿀팁은 덤</p>
          </div>
        </div>
        <div class="review">
          <div class="review_wrap01">
            <h3>리뷰</h3>
            <p class="review_txt">리뷰의 신뢰도를 위해 실제로 숙박하신 분들만 작성 가능합니다.</p>
            <div class="star_wrap">
              <p class="star_title">추천해요</p>
              <p><span class="star_img indent">별이미지</span><span class="star_gpa">5.0</span></p>
              <p class="review_cnt">전체리뷰 6개</p>
            </div>
          </div>
          <ul>
            <li>
              <p class="comment_name">이름</p>
              <p class="comment_star"><span class="comment_star_img indent">별이미지</span><span
                  class="comment_star_gpa">5.0</span></p>
              <p class="comment_txt">내용</p>
            </li>
            <li>
              <p class="comment_name">이름</p>
              <p class="comment_star"><span class="comment_star_img indent">별이미지</span><span
                  class="comment_star_gpa">5.0</span></p>
              <p class="comment_txt">내용</p>
            </li>
            <li>
              <p class="comment_name">이름</p>
              <p class="comment_star"><span class="comment_star_img indent">별이미지</span><span
                  class="comment_star_gpa">5.0</span></p>
              <p class="comment_txt">내용</p>
            </li>
          </ul>
          <div class="pagenation indent">
            <a href="#" class="pagenation_btn01">1페이지</a>
            <a href="#" class="pagenation_btn02">2페이지</a>
          </div>
        </div>
      </div>

    </main>


    <!-- footer -->
    <footer>
      <div  id="footer-include"></div>
    </footer>
  </div>

</body>

</html>