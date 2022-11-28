<?php

  $srch_txt = isset($_GET['srch_txt']) ? $_GET['srch_txt'] : $_POST['srch_txt'];
  $srch_start = isset($_POST['srch_start']) ? $_POST['srch_start'] : "";
  $srch_end = isset($_POST['srch_end']) ? $_POST['srch_start'] : "";

  // DB 연결
  include "../inc/dbcon.php";

  $sql = "SELECT * FROM lodging WHERE ldg_name LIKE '%$srch_txt%' OR ldg_city LIKE '%$srch_txt%' OR ldg_country LIKE '%$srch_txt%';";

  // 쿼리 전송
  $result = mysqli_query($dbcon, $sql);

  // 전체 데이터 가져오기
  $total = mysqli_num_rows($result);

  // paging : 한 페이지 당 보여질 목록 수
  $list_num = 4;

  // paging : 한 블럭 당 페이지 수
  $page_num = 5;

  // paging : 현재 페이지
  $page = isset($_GET["page"]) ? $_GET["page"] : 1 ;

  // paging : 전체 페이지 수 = 전체 데이터 / 페이지 당 목록 수,  ceil : 올림값, floor : 내림값, round : 반올림
  $total_page = ceil($total / $list_num);
  // echo "전체 페이지수 : ".$total_page;
  // exit;

  // paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수
  $total_block = ceil($total_page / $page_num);

  // paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수
  $now_block = ceil($page / $page_num);
  
  // paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭 번호 - 1) * 블럭 당 페이지 수 + 1
  $s_pageNum = ($now_block - 1) * $page_num + 1;
  if($s_pageNum <= 0){
      $s_pageNum = 1;
  };

  // paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수
  $e_pageNum = $now_block * $page_num;
  // 블럭 당 마지막 페이지 번호가 전체 페이지 수를 넘지 않도록
  if($e_pageNum > $total_page){
      $e_pageNum = $total_page;
  };
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>숙소 검색</title>
  <link rel="shortcut icon" href="../images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="stylesheet" type="text/css" href="../css/lodging_search.css">
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
  <script type="text/javascript" src="../js/lodging_search.js"></script>
</head>

<body>
  <div class="wrap">
    <!-- header -->
    <header>
      <div id="header-include"></div>
    </header>

    <!-- content -->
    <main id="content" class="content">
      <div class="search_bar_wrap">
        <div class="search_bar">
          <form name="search_form" id="search_form" action="lodging_search.php" method="post">
            <input name="srch_txt" type="text" class="search_keyword" placeholder="도시명 또는 숙소명을 검색해보세요">
            <div class="search_date">
              <input type="text" id="daterange_search" readonly>
              <label class="checkin_label">체크인</label>
              <span id="checkin_val" class="checkin_val"></span>
              <img src="../images/date_arrow.png" alt="화살표아이콘" class="date_arrow">
              <label class="checkout_label">체크아웃</label>
              <span id="checkout_val" class="checkout_val"></span>
            </div>

            <div class="search_count_wrap">
              <a href="#" class="search_count"></a>
              <span class="search_count_txt">객실 및 인원</span>
              <input type="text" id="search_count_room" min="0">
              <input type="text" id="search_count_prs" min="0">
              <div class="val_txt_wrap">
                <span>객실</span><span id="room_count_val">0</span> ·
                <span>인원</span><span id="prs_count_val">0</span>
              </div>
              <div class="count_box area">
                <div class="count_title_wrap area">
                  <p class="count_title area">객실 및 인원</p>
                  <span class="warning_msg"></span>
                  <button type="button" class="cancel_btn indent">닫기</button>
                </div>
                <div class="room area">
                  <p class="sub_title area">객실</p>
                  <div class="room_btn_wrap">
                    <button type="button" id="room_mbtn" class="prs_mbtn area"></button>
                    <span id="room_count" class="area">0</span>
                    <button type="button" id="room_pbtn" class="prs_pbtn area"></button>
                  </div>
                </div>
                <div class="prs area">
                  <p class="sub_title area">인원</p>
                  <div class="prs_btn_wrap">
                    <button type="button" id="prs_mbtn" class="prs_mbtn area"></button>
                    <span id="prs_count" class="area">0</span>
                    <button type="button" id="prs_pbtn" class="prs_pbtn area"></button>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="search_btn btn_hover">검색</button>
          </form>
        </div>
      </div>

      <div class="search_wrap">
        <div class="search_filter">
          <p class="search_filter_title">원하시는 숙소를 찾아보세요</p>
          <a href="#" class="search_filter_map indent">지도에서 숙소보기</a>

          <div class="filter_price_range">
            <p class="filter_title">가격범위(1박 기준)</p>
            <div class="multi_range_slider">
              <!-- 진짜 슬라이더 -->
              <input type="range" id="input_left" min="0" max="100" value="0" />
              <input type="range" id="input_right" min="0" max="100" value="100" />

              <!-- 커스텀 슬라이더 -->
              <div class="slider">
                <div class="track"></div>
                <div class="range"></div>
                <div class="thumb left"></div>
                <div class="thumb right"></div>
              </div>
              <div class="range_value_wrap">
                <p class="range_value1"><span id="value1"></span><span>만원</span></p>
                <p class="range_value2"><span id="value2"></span><span>만원</span></p>
              </div>
            </div>
          </div>

          <div class="filter_room_type">
            <p class="filter_title">객실 유형</p>
            <div class="checkbox_wrap">
              <div class="room_type1">
                <input type="checkbox" id="room_type1"><label for="room_type1">도미토리</label>
              </div>
              <div class="room_type2">
                <input type="checkbox" id="room_type2"><label for="room_type2">개인실</label>
              </div>
              <div class="room_type3">
                <input type="checkbox" id="room_type3"><label for="room_type3">콘도형</label>
              </div>
              <div class="room_type4">
                <input type="checkbox" id="room_type4"><label for="room_type4">여성전용</label>
              </div>
            </div>
          </div>

          <div class="filter_meal">
            <p class="filter_title">식사</p>
            <div class="checkbox_wrap">
              <div class="meal1">
                <input type="checkbox" id="meal1"><label for="meal1">조식</label>
              </div>
              <div class="meal2">
                <input type="checkbox" id="meal2"><label for="meal2">중식</label>
              </div>
              <div class="meal3">
                <input type="checkbox" id="meal3"><label for="meal3">석식</label>
              </div>
            </div>
          </div>
          <div class="filter_public">
            <p class="filter_title">공용시설</p>
            <div class="checkbox_wrap">
              <div class="public1">
                <input type="checkbox" id="public1"><label for="public1">Wifi</label>
              </div>
              <div class="public2">
                <input type="checkbox" id="public2"><label for="public2">게스트 부엌</label>
              </div>
              <div class="public3">
                <input type="checkbox" id="public3"><label for="public3">엘리베이터</label>
              </div>
              <div class="public4">
                <input type="checkbox" id="public4"><label for="public4">개인사물함</label>
              </div>
              <div class="public5">
                <input type="checkbox" id="public5"><label for="public5">주차가능</label>
              </div>
            </div>
          </div>

          <div class="filter_benefit">
            <p class="filter_title">혜택/추천 숙소</p>
            <div class="checkbox_wrap">
              <div class="benefit1">
                <input type="checkbox" id="benefit1"><label for="benefit1">한달살기특가</label>
              </div>
              <div class="benefit2">
                <input type="checkbox" id="benefit2"><label for="benefit2">할인</label>
              </div>
              <div class="benefit3">
                <input type="checkbox" id="benefit3"><label for="benefit3">프리미엄숙소</label>
              </div>
              <div class="benefit4">
                <input type="checkbox" id="benefit4"><label for="benefit4">숙소제공쿠폰</label>
              </div>
              <div class="benefit5">
                <input type="checkbox" id="benefit5"><label for="benefit5">숙소이벤트</label>
              </div>
            </div>
          </div>
        </div>


        <div class="search_result">
          <p class="search_result_title">검색된 한인민박 <span><?php echo $total; ?></span>개</p>
          <?php
            // paging : 해당 페이지의 글 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 목록 수
            $start = ($page - 1) * $list_num;

            // paging : 시작번호부터 페이지 당 보여질 목록수 만큼 데이터 구하는 쿼리 작성
            // limit 몇번부터, 몇 개
            $sql = "SELECT l.ldg_idx, l.ldg_name, l.ldg_main_img, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE ldg_name LIKE '%$srch_txt%' OR ldg_city LIKE '%$srch_txt%' OR ldg_country LIKE '%$srch_txt%' LIMIT $start, $list_num;";
            // echo $sql;
            /* exit; */

            // DB에 데이터 전송
            $result = mysqli_query($dbcon, $sql);

            // DB에서 데이터 가져오기
            // pager : 글번호
            $i = $start + 1;
            while($array = mysqli_fetch_array($result)){
              $ldg_idx = $array["ldg_idx"];
              $r_sql = "SELECT MIN(r_price) r_price FROM room WHERE ldg_idx=$ldg_idx;";
              $r_result = mysqli_query($dbcon, $r_sql);
              $r_arr = mysqli_fetch_array($r_result);

              $rv_sql = "SELECT AVG(rv_score) rv_score FROM review WHERE ldg_idx=$ldg_idx;";
              $rv_result = mysqli_query($dbcon, $rv_sql);
              $rv_arr = mysqli_fetch_array($rv_result);
              $rv_num = mysqli_num_rows($rv_result);
              $avg = $rv_arr['rv_score'];

              $dormitory = $array["dormitory"] == "1" ? "도미토리" : "";
              $privateroom = $array["privateroom"] == "1" ? "개인실" : "";
              $condo = $array["condo"] == "1" ? "콘도형" : "";
              $womenonly = $array["womenonly"] == "1" ? "여성전용" : "";
              $wifi = $array["wifi"] == "1" ? "Wifi" : "";
              $kitchen = $array["kitchen"] == "1" ? "게스트부엌" : "";
              $elevator = $array["elevator"] == "1" ? "엘리베이터" : "";
              $locker = $array["locker"] == "1" ? "개인사물함" : "";
              $parking = $array["parking"] == "1" ? "주차가능" : "";
              $breakfast = $array["breakfast"] == "1" ? "조식" : "";
              $lunch = $array["lunch"] == "1" ? "중식" : "";
              $dinner = $array["dinner"] == "1" ? "석식" : "";

              $type_arr = array("$dormitory","$privateroom", "$condo", "$womenonly");
              $type_arr2 = array_filter($type_arr);
              $type = trim(implode(" · ", $type_arr2)," · ");

              $meal_arr =  array("$breakfast", "$lunch", "$dinner");
              $meal_arr2 = array_filter($meal_arr);
              $meal = trim(implode(", ", $meal_arr2),", ");

              $facility_arr = array("$wifi","$kitchen", "$elevator", "$locker", "$parking");
              $facility_arr2 = array_filter($facility_arr);
              $facility = trim(implode(" · ", $facility_arr2)," · ");
          ?>
          <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx ?>">
            <div class="result_room">
              <img src="<?php echo '../partner/room/images/'.$array['ldg_main_img']; ?>" alt="검색된숙소이미지" class="result_room_img">
              <div class="result_room_left">
                <div class="result_room_top">
                  <p class="lodging_name"><?php echo $array["ldg_name"]; ?></p>
                  <p class="room_type"><?php echo $type; ?></p>
                </div>
                <div class="result_room_bot">
                  <p class="room_service"><?php echo $meal." 제공, ".$facility; ?></p>
                  <div class="result_room_review">
                    <?php 
                        if(!$avg) {
                      ?>
                      <span class="review_comment">등록된 후기가 없습니다</span>
                    <?php }else { ?>
                    <span class="star">
                      ★★★★★
                      <span style="width :<?php echo ($avg*20-3) ."%"; ?> ">★★★★★</span>
                    </span>
                    <span class="star_gpa"><?php echo $avg?></span>
                    <span class="review_comment"><?php echo $rv_num; ?>개의 이용후기</span>
                    <?php }; ?>
                  </div>
                  <div class="result_room_like">
                    <span class="like_sign">좋아요</span>
                    <span class="like_count">132</span>
                  </div>
                </div>
              </div>
              <div class="result_room_right">
                <p class="result_room_day indent">1박</p>
                <p class="result_room_price"><?php echo number_format($r_arr['r_price']); ?> 원~</p>
              </div>
            </div>
          </a>
          <?php 
          $i++; 
          }; 
          ?>

          <div class="pager_wrap">
            <p class="pager">
              <?php
            // pager : 이전 페이지
            if($page <= 1){
            ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=1" class="page_prev indent">이전</a>
              <?php } else{ ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=<?php echo ($page - 1); ?>"
                class="page_prev indent">이전</a>
              <?php }; ?>

              <?php
            // pager : 페이지 번호 출력
            for($print_page = $s_pageNum;  $print_page <= $e_pageNum; $print_page++){
            ?>
              <?php if ($print_page == $page) { ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=<?php echo $print_page;?>"
                class="page01"><?php echo $print_page; ?></a>
              <?php } else { ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=<?php echo $print_page;?>"
                class="page02"><?php echo $print_page; ?></a>
              <?php }}; ?>
              <?php
            // pager : 다음 페이지
            if($page >= $total_page){
            ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=<?php echo $total_page; ?>"
                class="page_next indent">다음</a>
              <?php } else{ ?>
              <a href="lodging_search.php?srch_txt=<?php echo $srch_txt;?>&page=<?php echo ($page + 1); ?>"
                class="page_next indent">다음</a>
              <?php }; ?>
            </p>
          </div>
        </div>
      </div>
    </main>

    <!-- footer -->
    <footer>
      <div id="footer-include"></div>
    </footer>
  </div>

</body>

</html>