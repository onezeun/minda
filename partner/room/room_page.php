<?php
  include "../inc/session.php";

  // 로그인 사용자만 접근
  include '../inc/login_check.php';

  // DB 연결
  include "../inc/dbcon.php";
  $ldg_idx = $_GET["ldg_idx"];

  $sql = "SELECT * FROM room WHERE ldg_idx=$ldg_idx";
  $result = mysqli_query($dbcon, $sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>파트너 숙소관리 페이지</title>
  <link rel="shortcut icon" href="../../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../../css/reset.css" />
  <link rel="stylesheet" type="text/css" href="../../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/room.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/include.js"></script>
  <script type="text/javascript" src="../../js/slick.js"></script>
  <script type="text/javascript" src="../js/room.js"></script>
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
      <div class="room_cont">
          <?php 
            $list_sql = "SELECT * FROM room WHERE ldg_idx=$ldg_idx";
            $list_result = mysqli_query($dbcon, $list_sql);
            $num = mysqli_num_rows($list_result);
            if(!$num) {
          ?>
          <div class="room_list">
            <p class="room_txt">등록된 객실이 없습니다.</p>
          <?php } else {?>
        <div class="room_list">
          <ul id="room_slide" class="room_slide">
            <?php 
              while($list_arr = mysqli_fetch_array($list_result)){ 
            ?>
            <li>
              <div id="card" class="card room1">
              <a href="room_page.php?ldg_idx=<?php echo $ldg_idx;?>&r_idx=<?php echo $list_arr["r_idx"];?>" id="room_edit" class="room_edit block">
                <img src="<?php echo $list_arr["r_img"]; ?>" alt="객실이미지">
                <div class="card_cont_wrap">
                    <p class="room_title"><?php echo $list_arr["r_name"]; ?></p>
                    <div class="room_cont_txt">
                      <?php 
                        $gender = $list_arr["r_gender"];

                        if($gender == "1") {
                          $gender = "남여공용";
                        } else if($gender == "2") {
                          $gender = "여성";
                        } else {
                          $gender = "남성";
                        };

                        $type = $list_arr["r_type"];

                        if($type == "1") {
                          $type = "도미토리";
                        } else if($type == "2") {
                          $type = "개인실";
                        } else {
                          $type = "콘도형";
                        };
                      ?>
                      <p><?php echo $gender." ".$type;?></p>
                      <p>객실정원 <?php echo $list_arr["r_gender"]." ~ ".$list_arr["r_max"]; ?></p>
                    </div>
                    <div class="room_price_wrap">
                      <span class="room_price_txt">1박 금액</span><span class="room_price"><?php echo number_format($list_arr["r_price"]); ?> 원</span>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <?php }; ?>
          </ul>
          <a href="#" id="room_btn1" class="card_prev">이전</a>
          <a href="#" id="room_btn2" class="card_next">다음</a>
          <?php }; ?>
        </div>
        <?php 
          $r_idx = isset($_GET["r_idx"]) ? $_GET['r_idx'] : "";
          if($r_idx == "") { 
        ?>
        <form name="room_form" id="room_form" class="room_form" action="room_insert.php" method="post"
          enctype="multipart/form-data">
          <input type="hidden" name="ldg_idx" value="<?php echo $_GET["ldg_idx"]; ?>">
          <table class="room_edit_table">
            <tr>
              <th>객실 이름</th>
              <td>
                <div class="room_name_wrap">
                  <input type="text" name="r_name" id="room_name" class="room_name" placeholder="객실 이름을 입력해주세요.">
                  <span class="room_name_txt">신규</span>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <p>객실 사진</p>
                <button type="button" id="room_img_btn" class="room_img_btn btn_hover">이미지 업로드</button>
              </th>
              <td>
                <div class="room_img_wrap">
                  <input type="file" accept="image/*" name="r_img" id="room_img_input" class="room_img_input">
                  <img src="" id="room_img" class="room_img">
                </div>
              </td>
            </tr>
            <tr>
              <th>객실 유형</th>
              <td class="room_facility_wrap">
                <input type="radio" name="r_gender" id="room_unisex" value="1"><label for="room_unisex">남여공용</label>
                <input type="radio" name="r_gender" id="room_womanonly" value="2"><label
                  for="room_womanonly">여성용</label>
                <input type="radio" name="r_gender" id="manonly" value="3"><label for="manonly">남성용</label>
                <div class="rf_line"></div>
                <input type="radio" name="r_type" id="room_dormitory" value="1"><label for="room_dormitory">도미토리</label>
                <input type="radio" name="r_type" id="room_privateroom" value="2"><label
                  for="room_privateroom">개인실</label>
                <input type="radio" name="r_type" id="room_condo" value="3"><label for="room_condo">콘도형</label>
              </td>
            </tr>
            <tr>
              <th>객실인원</th>
              <td class="room_maxnop">
                <span>최소<input type="text" name="r_min" id="r_min">명</span> ~ <span>최대<input type="text" name="r_max"
                    id="r_max">명</span>
              </td>
            </tr>
            <tr>
              <th>금액</th>
              <td class="room_price">
                <span class="room_price_txt">1인 1박 기준</span><input type="text" name="r_price"
                  id="r_price"><span>원</span>
              </td>
            </tr>
          </table>
          <button type="button" id="room_submit_btn" class="room_submit_btn btn_hover">객실 등록</button>
        </form>
        <?php
          } else { 
          $r_idx = $_GET["r_idx"];
          $r_sql = "SELECT * FROM room WHERE r_idx=$r_idx;";
          $r_result = mysqli_query($dbcon, $r_sql);
          $r_arr = mysqli_fetch_array($r_result);
        ?>
        <form name="room_edit_form" id="room_edit_form" class="room_form" action="room_edit.php" method="post"
          enctype="multipart/form-data">
          <input type="hidden" name="ldg_idx"id="ldg_idx" value="<?php echo $_GET["ldg_idx"]; ?>">
          <input type=hidden name="r_idx" id="r_idx" value="<?php echo $r_idx;?>">
          <table class="room_edit_table">
            <tr>
              <th>객실 이름</th>
              <td>
                <input type="text" name="r_name" id="room_name" class="room_name" placeholder="객실 이름을 입력해주세요." value="<?php echo $r_arr["r_name"];?>">
              </td>
            </tr>
            <tr>
              <th>
                <p>객실 사진</p>
                <button type="button" id="room_img_btn" class="room_img_btn btn_hover">이미지 업로드</button>
              </th>
              <td>
                <div class="room_img_wrap">
                  <input type="file" accept="image/*" name="r_img" id="room_img_input" class="room_img_input">
                  <img src="<?php echo $r_arr["r_img"];?>" id="room_img" class="room_img">
                </div>
              </td>
            </tr>
            <tr>
              <th>객실 유형</th>
              <?php
                $gender = $r_arr["r_gender"];
                $type = $r_arr["r_type"];
              ?>
              <td class="room_facility_wrap">
                <input type="radio" name="r_gender" id="room_unisex" value="1" <?php if($gender == '1'){echo "checked";}; ?>><label for="room_unisex">남여공용</label>
                <input type="radio" name="r_gender" id="room_womanonly" value="2" <?php if($gender == '2'){echo "checked";}; ?>><label
                  for="room_womanonly">여성용</label>
                <input type="radio" name="r_gender" id="manonly" value="3" <?php if($gender == '3'){echo "checked";}; ?>><label for="manonly">남성용</label>
                <div class="rf_line"></div>
                <input type="radio" name="r_type" id="room_dormitory" value="1" <?php if($type == '1'){echo "checked";}; ?>><label for="room_dormitory">도미토리</label>
                <input type="radio" name="r_type" id="room_privateroom" value="2" <?php if($type == '2'){echo "checked";}; ?>><label
                  for="room_privateroom">개인실</label>
                <input type="radio" name="r_type" id="room_condo" value="3" <?php if($type == '3'){echo "checked";}; ?>><label for="room_condo">콘도형</label>
              </td>
            </tr>
            <tr>
              <th>객실인원</th>
              <td class="room_maxnop">
                <span>최소<input type="text" name="r_min" id="r_min" value="<?php echo $r_arr["r_min"];?>">명</span> ~ <span>최대<input type="text" name="r_max" id="r_max" value="<?php echo $r_arr["r_max"];?>">명</span>
              </td>
            </tr>
            <tr>
              <th>금액</th>
              <td class="room_price">
                <span class="room_price_txt">1인 1박 기준</span><input type="text" name="r_price"id="r_price" value="<?php echo $r_arr["r_price"];?>"><span>원</span>
              </td>
            </tr>
          </table>
          <a href="room_page.php?ldg_idx=<?php echo $ldg_idx;?>" class="new_room_btn btn_hover">신규객실등록</a>
          <button type="button" id="room_delete_btn" class="cancel_btn btn_hover_cancel">객실 삭제</button>
          <button type="button" id="room_edit_btn" class="room_submit_btn btn_hover">객실 수정</button>
        </form>
        <?php }; ?>
      </div>
    </main>

    <!-- footer -->
    <footer>
      <div id="partner-footer-include"></div>
    </footer>
  </div>
</body>

</html>