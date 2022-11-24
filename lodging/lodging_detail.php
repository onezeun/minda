<?php
  include "../inc/session.php";

  // DB 연결
  include "../inc/dbcon.php";

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
      <?php 
      $l_sql = "SELECT l.ldg_idx, l.ldg_name, l.ldg_main_img, l.ldg_sub_img, l.ldg_info, l.ldg_country, l.ldg_city, l.ldg_maxnop, l.toilet, l.shower, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE l.ldg_idx=$ldg_idx;";
      $l_result = mysqli_query($dbcon, $l_sql);
      $l_array = mysqli_fetch_array($l_result); 
      $ldg_info = $l_array['ldg_info'];
      ?>
      <h2 class="indent">숙소상세페이지</h2>
      <div class="main_cont">
        <div class="main_cont_left">
          <ul class="slider-for">
            <li><img src="<?php echo "../partner/room/images/".$l_array['ldg_main_img'] ?>" alt="숙소대표이미지" /></li>
            <?php
              $sub_arr = explode(",",$l_array['ldg_sub_img'] );
              for($i=0; $i<count($sub_arr); $i++){
                echo "
                  <li><img src=\"../partner/room/images/{$sub_arr[$i]}\" alt=\"숙소대표이미지\"/></li>
                  ";
                }
            ?>
          </ul>
          <div class="carousel">
            <ul class="slider-nav">
              <li><img src="<?php echo "../partner/room/images/".$l_array['ldg_main_img']?>" alt="숙소대표이미지"
                  class="nav_img" /></li>
              <?php
                $sub_arr = explode(",",$l_array['ldg_sub_img'] );
                for($i=0; $i<count($sub_arr); $i++){
                echo "
                  <li><img src=\"../partner/room/images/{$sub_arr[$i]}\" alt=\"숙소대표이미지\" class=\"nav_img\"/></li>
                  ";
                }
              ?>
            </ul>
            <a href="#" id="ldg_prev" class="ldg_prev indent">이전</a>
            <a href="#" id="ldg_next" class="ldg_next indent">다음</a>
          </div>
        </div>
        <?php 
          $rv_sql = "SELECT r.ldg_idx, MIN(r.r_price) r_price, AVG(rv.rv_score) rv_score FROM room r LEFT OUTER JOIN review rv ON r.ldg_idx = rv.ldg_idx WHERE r.ldg_idx = $ldg_idx GROUP BY ldg_idx;";
          $rv_result = mysqli_query($dbcon, $rv_sql);
          $rv_num = mysqli_num_rows($rv_result);
          $rv_array = mysqli_fetch_array($rv_result);
        ?>
        <div class="main_cont_right">
          <h3><?php echo $l_array['ldg_name'];?></h3>
          <p class="ldg_price"><?php echo number_format($rv_array['r_price']);?>원 ~</p>
          <div class="ldg_btn">
            <a href="#" class="ldg_share indent">공유</a>
            <a href="#" class="ldg_like indent">좋아요</a>
          </div>
          <div class="relike_wrap">

            <div class="main_cont_review">
              <?php 
                $avg = $rv_array['rv_score'];
                if(!$avg) {
              ?>
              <span class="m_star_null">등록된 리뷰가 없습니다</span>
              <?php }else {?>
              <span class="m_star">
                ★★★★★
                <span style="width :<?php echo ($avg*20-3) ."%"; ?> ">★★★★★</span>
              </span>
              <span class="m_star_gpa"><?php echo $avg?></span>
              <?php }; ?>
            </div>
            <div class="main_cont_like">
              <p>이 숙소를 좋아하는 <span class="like_color_txt">132</span>명</p>
            </div>
          </div>
          <div class="pictogram">
            <ul>
              <?php 
                $toilet = $l_array['toilet'];
                $shower = $l_array['shower'];
                $ldg_maxnop = $l_array['ldg_maxnop'];
                $dormitory = $l_array['dormitory'];
                $privateroom = $l_array['privateroom'];

                if($dormitory == 1) {
              ?>
              <li><span class="picto_img01 indent">이미지</span>
                <p>도미토리</p>
              </li>
              <?php }; ?>
              <?php if($privateroom == 1) { ?>
              <li><span class="picto_img02 indent">이미지</span>
                <p>개인실</p>
              </li>
              <?php }; ?>
              <?php if($ldg_maxnop > 0) { ?>
              <li><span class="picto_img03 indent">이미지</span>
                <p>최대 <?php echo $ldg_maxnop; ?>명</p>
              </li>
              <?php }; ?>
              <?php if($toilet > 0) { ?>
              <li><span class="picto_img04 indent">이미지</span>
                <p>화장실 <?php echo $toilet; ?>개</p>
              </li>
              <?php }; ?>
              <?php if($shower > 0) { ?>
              <li><span class="picto_img05 indent">이미지</span>
                <p>샤워실 <?php echo $shower; ?>개</p>
              </li>
              <?php }; ?>
            </ul>
          </div>
          <div class="other_info">
            <div class="public">
              <?php
                $wifi = $l_array["wifi"] == "1" ? "Wifi" : "";
                $kitchen = $l_array["kitchen"] == "1" ? "게스트부엌" : "";
                $elevator = $l_array["elevator"] == "1" ? "엘리베이터" : "";
                $locker = $l_array["locker"] == "1" ? "개인사물함" : "";
                $parking = $l_array["parking"] == "1" ? "주차가능" : "";
                $breakfast = $l_array["breakfast"] == "1" ? "조식" : "";
                $lunch = $l_array["lunch"] == "1" ? "중식" : "";
                $dinner = $l_array["dinner"] == "1" ? "석식" : "";

                $meal_arr =  array("$breakfast", "$lunch", "$dinner");
                $meal_arr2 = array_filter($meal_arr);
                $meal = trim(implode(", ", $meal_arr2),", ");

                $facility_arr = array("$wifi","$kitchen", "$elevator", "$locker", "$parking");
                $facility_arr2 = array_filter($facility_arr);
                $facility = trim(implode(" · ", $facility_arr2)," · ");
              ?>
              <h4>공용시설</h4>
              <p class="ldg_meal"><?php echo $meal." 제공"; ?></p>
              <p class="facility"><?php echo $facility; ?></p>
            </div>
            <div class="location">
              <h4>위치</h4>
              <p><?php echo $l_array["ldg_country"]." · ".$l_array["ldg_city"]?></p>
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
            <input type="text" placeholder="인원" class="prs_box" min="1" max="10" readonly>
            <div class="prs_btn_wrap">
              <button type="button" class="prs_mbtn"></button>
              <button type="button" class="prs_pbtn"></button>
            </div>
            <span class="warning_msg"></span>
          </div>
        </div>
        <?php 
        $r_sql = "SELECT * FROM room WHERE ldg_idx=$ldg_idx";
        $r_result = mysqli_query($dbcon, $r_sql);
        $r_total = mysqli_num_rows($r_result);
        ?>
        <div class="room_list">
          <div class="room_list_txt">
            <p>총 <span><?php echo $r_total; ?></span>개의 객실이 있습니다.</p>
          </div>

          <?php 
            while($r_array = mysqli_fetch_array($r_result)){
              $r_idx = $r_array['r_idx'];
              $gender = $r_array["r_gender"];
              if($gender == "1") {
                $gender = "남여공용";
              } else if($gender == "2") {
                $gender = "여성";
              } else {
                $gender = "남성";
              };

              $type = $r_array["r_type"];
              if($type == "1") {
                $type = "도미토리";
              } else if($type == "2") {
                $type = "개인실";
              } else {
                $type = "콘도형";
              };
          ?>
          <div class="room">
            <div class="room_img_wrap">
              <img src="<?php echo $r_array['r_img']; ?>" alt="방 이미지">
            </div>
            <div class="room_left">
              <p class="room_type"><?php echo $r_array["r_name"]; ?></p>
              <p class="room_left_txt01"><?php echo $gender." ".$type; ?></p>
              <p class="room_left_txt02">객실정원 <?php echo $r_array["r_min"]." ~ ".$r_array["r_max"]; ?></p>
            </div>
            <div class="room_right">
              <form name="rv_room_form" id="rv_room_form"
                action="../reservation/reservation.php?s_idx=<?php echo $s_idx; ?>&ldg_idx=<?php echo $ldg_idx; ?>"
                method="post">
                <input type="hidden" name="r_idx" id="r_idx" value="<?php echo $r_array['r_idx'];?>">
                <div id="price_wrap" class="room_right_txt_wrap">
                  <p class="room_right_txt01"><span class="rv_nop">1</span>인 <span class="rv_date">1</span>박</p>
                  <input type="hidden" class="price" value="<?php echo $r_array['r_price']; ?>">
                  <input type="hidden" class="s_idx" value="<?php echo $s_idx ?>">
                  <p class="room_right_txt02"><span
                      class="rv_price"><?php echo number_format($r_array['r_price']); ?></span>원</p>

                  <input type="hidden" name="checkin_date" class="checkin_date">
                  <input type="hidden" name="checkout_date" class="checkout_date">
                  <input type="hidden" name="rv_price" id="rv_price">
                  <input type="hidden" name="rv_nop" id="rv_nop">
                  <input type="hidden" name="rv_date" id="rv_date">
                </div>
                <!-- <a href="../reservation/reservation.php?s_idx=<?php echo $s_idx; ?>&ldg_idx=<?php echo $ldg_idx; ?>&r_idx=<?php echo $r_array['r_idx']; ?>" class="room_right_btn btn_hover">예약</a> -->
                <button type="button" class="room_right_btn btn_hover">예약</button>
              </form>
            </div>
          </div>
          <?php }; ?>
        </div>
        <div class="room_intro">
          <h3>숙소 소개</h3>
          <div class="intro_txt"><?php echo $ldg_info;?></div>
        </div>
        <?php 
          $rv_sql = "SELECT u.u_name, rv.rv_score, rv.rv_content FROM review rv JOIN users u ON u.u_idx = rv.u_idx WHERE rv.ldg_idx = $ldg_idx";
          $rv_result = mysqli_query($dbcon, $rv_sql);
          $rv_total = mysqli_num_rows($rv_result);
          // paging : 한 페이지 당 보여질 목록 수
          $list_num = 3;

          // paging : 한 블럭 당 페이지 수
          $page_num = 5;

          // paging : 현재 페이지
          $page = isset($_GET["page"]) ? $_GET["page"] : 1 ;

          // paging : 전체 페이지 수 = 전체 데이터 / 페이지 당 목록 수,  ceil : 올림값, floor : 내림값, round : 반올림
          $total_page = ceil($rv_total / $list_num);
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

          // paging : 해당 페이지의 글 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 목록 수
          $start = ($page - 1) * $list_num;
        ?>
        <div class="review">
          <?php 
            $avg_sql = "SELECT AVG(rv_score) avg_score FROM review WHERE ldg_idx = $ldg_idx;";
            $avg_result = mysqli_query($dbcon, $avg_sql);
            $avg_array = mysqli_fetch_array($avg_result);
            $avg =  $avg_array['avg_score'];
            if(!$avg) {
          ?>
          <div class="review_wrap01">
            <h3>리뷰</h3>
            <p class="review_txt">리뷰의 신뢰도를 위해 실제로 숙박하신 분들만 작성 가능합니다.</p>
            <div class="star_wrap">
              <p class="ostar_title">등록된 리뷰가 없습니다.</p>
            </div>
          </div>
          <?php
            } else { 
          ?>
          <div class="review_wrap01">
            <h3>리뷰</h3>
            <p class="review_txt">리뷰의 신뢰도를 위해 실제로 숙박하신 분들만 작성 가능합니다.</p>
            <div class="star_wrap">
              <p class="star_title">추천해요</p>
              <p class="star_score_wrap">
                <span class="star">
                  ★★★★★
                  <span style="width : <?php echo ($avg*20)."%"; ?>">★★★★★</span>
                  <input type="range" name="rv_score" class="rv_score" value="<?php echo $avg;?>" step="0.5" min="0"
                    max="5">
                </span>
                <span class="star_gpa"><?php echo $avg_array['avg_score'];?></span>
              </p>
              <p class="review_cnt">전체리뷰 <?php echo $rv_total;?>개</p>
            </div>
          </div>
          <?php }; ?>
          <ul>
            <?php 
              // DB에서 데이터 가져오기
              // pager : 글번호(역순)
              // 전체데이터 - ((현재 페이지 번호 -1) * 페이지 당 목록 수)
              $rv_list_sql = "SELECT u.u_name, rv.rv_score, rv.rv_content FROM review rv JOIN users u ON u.u_idx = rv.u_idx WHERE rv.ldg_idx = $ldg_idx LIMIT $start, $list_num;";
              $rv_list_result = mysqli_query($dbcon, $rv_list_sql);

              $i = $rv_total - (($page - 1) * $list_num);
              while($rv_array = mysqli_fetch_array($rv_list_result)){ 
            ?>
            <li>
              <p class="comment_name"><?php echo $rv_array['u_name'];?></p>
              <p class="comment_star_wrap">
                <span class="comment_star">
                  ★★★★★
                  <span style="width : <?php echo ($rv_array['rv_score']*20)."%"; ?>">★★★★★</span>
                  <input type="range" name="rv_score" class="rv_score" value="<?php echo $rv_array['rv_score'];?>"
                    step="0.5" min="0" max="5">
                </span>
                <span class="comment_star_gpa"><?php echo $rv_array['rv_score'];?></span>
              </p>
              <p class="comment_txt"><?php echo $rv_array['rv_content'];?></p>
            </li>
            <?php 
                $i--;
              };
            ?>
          </ul>
          <p class="pager">
            <?php
            // pager : 이전 페이지
            if($page <= 1){
            ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=1" class="page_prev indent">이전</a>
            <?php } else{ ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=<?php echo ($page - 1); ?>"
              class="page_prev indent">이전</a>
            <?php }; ?>

            <?php
            // pager : 페이지 번호 출력
            for($print_page = $s_pageNum;  $print_page <= $e_pageNum; $print_page++){
            ?>
            <?php if ($print_page == $page) { ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=<?php echo $print_page;?>"
              class="page01"><?php echo $print_page; ?></a>
            <?php } else { ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=<?php echo $print_page;?>"
              class="page02"><?php echo $print_page; ?></a>
            <?php }}; ?>
            <?php
            // pager : 다음 페이지
            if($page >= $total_page){
            ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=<?php echo $total_page; ?>"
              class="page_next indent">다음</a>
            <?php } else { ?>
            <a href="lodging_detail.php?ldg_idx=<?php echo $ldg_idx;?>&page=<?php echo ($page + 1); ?>"
              class="page_next indent">다음</a>
            <?php }; ?>
          </p>
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