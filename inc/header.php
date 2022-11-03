<?php
  include "session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HEADER</title>
  <script 
    src="https://code.jquery.com/jquery-3.6.1.js" 
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
  </script>
<script type="text/javascript" src="http://localhost/KDT-1st-project-minda/js/header.js"></script>
</head>
<body>
  <div id="header" class="header">
    <h1 class="logo indent"><a href="http://localhost/KDT-1st-project-minda/index.html">민다</a></h1>
    <div class="top_menu_wrap">
      <h2 class="hide">사용자 메뉴</h2>
      <div class="top_menu">
      <?php if(!$s_idx) { ?>
        <!-- 로그인 전 -->
        <ul>
          <li class="top_bar"><a href="http://localhost/KDT-1st-project-minda/login/login.html">로그인</a></li>
          <li class="top_bar"><a href="http://localhost/KDT-1st-project-minda/user/signup.html">회원가입</a></li>
          <li class="top_bar"><a href="#">고객센터</a></li>
          <li class="top_bar_search indent">
            <form action="">
              <input name="q" type="search" placeholder="검색어를 입력하세요" />
              <button type="button" class="search-icon"></button>
            </form>
          </li>
        </ul>
        <?php } else {?>
        <!-- 로그인 후 -->
        <ul>
          <li><img src="http://localhost/KDT-1st-project-minda/images/profile.png" alt="사용자 프로필사진" class="top_profile_img"></li>
          <li class="top_login">
            <a href="#" class="top_user_name"><?php echo $s_name; ?></a> 님, 반갑습니다!
            <div class="top_user_menu area">
              <ul>
                <li>
                  <a href="http://localhost/KDT-1st-project-minda/user/user.html">마이민다</a>
                  <div class="top_user_bar"></div>
                </li>
                <li><a href="http://localhost/KDT-1st-project-minda/user/user_reservation.html">예약내역</a></li>
                <li>
                  <a href="#">위시리스트</a>
                  <div class="top_user_bar"></div>
                </li>
                <li><a href="http://localhost/KDT-1st-project-minda/login/logout.php">로그아웃</a></li>
              </ul>
            </div>
          </li>
          <li class="top_bar"><a href="">고객센터</a></li>
          <li class="top_bar_search indent">
            <form action="">
              <input name="q" type="search" placeholder="검색어를 입력하세요" />
              <button type="button" class="search-icon"></button>
            </form>
          </li>
        </ul>
        <?php }; ?>
      </div>
    </div>

    <nav class="gnb">
      <h2 class="hide">주요 메뉴</h2>
      <ul>
        <li class="menu1"><a href="http://localhost/KDT-1st-project-minda/lodging.html">숙소</a></li>
        <li class="menu2"><a href="#">투어</a></li>
        <li class="menu3"><a href="#">해외렌터카</a></li>
        <li class="menu4"><a href="#" class="">여행편의</a>
          <div class="menu4_sub_wrap shadow">
            <ul>
              <li class="menu4_sub1"><a href="#">해외유심</a></li>
              <li class="menu4_sub2"><a href="#">공항픽업</a></li>
            </ul>
          </div>
        </li>
        <li class="menu5"><a href="#" class="">할인&이벤트</a>
          <div class="menu5_sub_wrap shadow">
            <ul ul class="menu5_sub">
              <li class="menu5_sub1"><a href="#">땡처리할인</a></li>
              <li class="menu5_sub2"><a href="#">비수기할인</a></li>
              <li class="menu5_sub3"><a href="#">민다 이벤트</a></li>
              <li class="menu5_sub4"><a href="#">숙소 이벤트</a></li>
              <li class="menu5_sub5"><a href="#">숙소쿠폰</a></li>
            </ul>
          </div>
        </li>
        <li class="menu6"><a href="#">여행정보</a></li>
        <li class="menu7"><a href="http://localhost/KDT-1st-project-minda/community.html">커뮤니티</a>
          <div class="menu7_sub_wrap shadow">
            <ul ul class="menu7_sub">
              <li class="menu7_sub1"><a href="#">구인·구직</a></li>
              <li class="menu7_sub2"><a href="#">사고·팔고</a></li>
            </ul>
          </div>
        </li>
      </ul>
      <div class="gnb_sub"></div>
    </nav>
  </div>

</body>
</html>