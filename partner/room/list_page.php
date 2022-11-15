<?php
  include "../inc/session.php";

  // 로그인 사용자만 접근
  include '../inc/login_check.php';

  // DB 연결
  include "../inc/dbcon.php";

  // 쿼리 작성
  // $sql = "select * from lodging where p_idx='$sp_idx';";
  $sql = "SELECT l.ldg_idx, l.ldg_name, i.l_file_src, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l LEFT OUTER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx LEFT OUTER JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE p_idx='$sp_idx';";
  // 쿼리 전송
  $result = mysqli_query($dbcon, $sql);

  // 전체 데이터 가져오기
  $total = mysqli_num_rows($result);

  // paging : 한 페이지 당 보여질 목록 수
  $list_num = 3;

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
        <p class="list_title">총 <span><?php echo $total; ?></span>개의 숙소가 등록되어있습니다.</p>
        <a href="new_room_page.php" class="new_ldg btn_hover">신규 등록</a>
        <?php
          // paging : 해당 페이지의 글 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 목록 수
          $start = ($page - 1) * $list_num;

          // paging : 시작번호부터 페이지 당 보여질 목록수 만큼 데이터 구하는 쿼리 작성
          // limit 몇번부터, 몇 개
          $sql = "SELECT l.ldg_idx, l.ldg_name, i.l_file_src, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l LEFT OUTER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx LEFT OUTER JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx LIMIT $start, $list_num;";
          // echo $sql;
          /* exit; */

          // DB에 데이터 전송
          $result = mysqli_query($dbcon, $sql);

          // DB에서 데이터 가져오기
          // pager : 글번호
          $i = $start + 1;
          while($array = mysqli_fetch_array($result)){
        ?>
        <div class="ldg_card">
          <div class="ldg_card_img_wrap">
            <img src="<?php echo $array["l_file_src"]; ?>" alt="숙소이미지">
          </div>
          <ul class="ldg_card_menu">
            <li><a href="../reservation/partner_reservation_page.php" class="menu_btn btn_hover">예약관리</a></li>
            <li><a href="edit_room_page.php?ldg_idx=<?php echo $array["ldg_idx"]; ?>"
                class="menu_btn btn_hover">숙소관리</a></li>
            <li><a href="#" class="menu_btn btn_hover">후기관리</a></li>
            <li><a href="#" class="menu_btn del_btn">숙소삭제</a></li>
          </ul>
          <div class="ldg_card_left">
            <div class="ldg_card_top">
              <p id="ldg_name" class="lodging_name"><?php echo $array["ldg_name"]; ?></p>
              <?php
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
              <p class="room_type"><?php echo $type; ?></p>
            </div>
            <div class="ldg_card_bot">
              <p class="ldg_meal"><?php echo $meal." 제공"; ?></p>
              <p class="facility"><?php echo $facility; ?></p>
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
        <?php 
          $i++; 
          }; 
        ?>

        <div class="pager_wrap">
          <p class="pager">
            <?php
          // pager : 페이지 번호 출력
          for($print_page = $s_pageNum;  $print_page <= $e_pageNum; $print_page++){
          ?>
            <?php if ($print_page == $page) { ?>
            <a href="list_page.php?page=<?php echo $print_page;?>" class="page01"><?php echo $print_page; ?></a>
            <?php } else { ?>
            <a href="list_page.php?page=<?php echo $print_page;?>" class="page02"><?php echo $print_page; ?></a>
            <?php }}; ?>
          </p>
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