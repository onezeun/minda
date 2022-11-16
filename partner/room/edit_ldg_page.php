<?php
  include '../inc/session.php'; 

  // 로그인 사용자만 접근
  include '../inc/login_check.php';

  // DB 연결
  include "../inc/dbcon.php";

  $ldg_idx = $_GET["ldg_idx"];

  $l_sql = "SELECT l.ldg_name, l.ldg_country, l.ldg_city, l.ldg_tel, l.ldg_info, l.ldg_maxnop, l.toilet, l.shower, i.l_file_main, i.l_file_src, i.l_file_name, i.l_file_type, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l INNER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx INNER JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE l.ldg_idx = $ldg_idx;";

  $l_result = mysqli_query($dbcon, $l_sql);
  $l_arr = mysqli_fetch_array($l_result);
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
  <link rel="stylesheet" type="text/css" href="../css/new_ldg.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/include.js"></script>
  <script type="text/javascript" src="../../js/slick.js"></script>
  <script type="text/javascript" src="../js/edit_ldg.js"></script>

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

      <form name="ldg_edit_form" id="ldg_edit_form" class="ldg_form" action="ldg_edit.php" method="post" enctype="multipart/form-data">
        <input type=hidden name="ldg_idx" value="<?php echo $ldg_idx ?>">
        <div class="room_edit_cont">
          <table class="room_edit_table">
            <tr>
              <th>숙소명</th>
              <td>
                <input type="text" name="ldg_name" id="ldg_name" class="ldg_name" placeholder="숙소명을 입력해주세요" maxlength="50" value="<?php echo $l_arr['ldg_name'];?>">
              </td>
            </tr>
            <tr>
              <th>숙소 위치</th>
              <td>
              <div class="ldg_addr_wrap">
                <label for="ldg_country">국가명 :&nbsp;</label> <input type="text" name="ldg_country" id="ldg_contry" class="ldg_addr" placeholder="국가명을 입력해주세요" value="<?php echo $l_arr['ldg_country'];?>">
                <div class="rf_line"></div>
                <label for="ldg_city">도시명 :&nbsp;</label> <input type="text" name="ldg_city" id="ldg_city" class="ldg_addr" placeholder="도시명을 입력해주세요" value="<?php echo $l_arr['ldg_city'];?>">
              </div>
              </td>
            </tr>
            <tr>
              <th>숙소 이미지</th>
              <td>
                <div class="ldf_img_wrap">
                  <div class="ldg_img_left">
                    <div class="ldg_txt_wrap">
                      <span class="ldg_img_title">대표 사진 등록</span>
                      <button type="button" id="main_img_btn" class="img_btn">이미지 업로드</button>
                    </div>
                    <input type="file" name="ldg_mainimg" id="ldg_mainimg_input" class="ldg_img_input">
                    <img src="<?php echo $l_arr['l_file_src'];?>" id="ldg_main_img" class="ldg_main_img">
                  </div>

                  <div class="ldg_img_right">
                    <div class="ldg_txt_wrap">
                      <span class="ldg_img_title">숙소 사진 등록</span>
                      <button type="button" id="sub_img_btn" class="img_btn">이미지 업로드</button>
                    </div>
                    <input type="file" accept="image/*" name="ldg_subimg[]" id="ldg_subimg_input" class="ldg_img_input"
                      multiple />
                    <div class="ldg_sub_img_wrap">
                      <div class="ldg_sub_img"></div>
                      <div class="ldg_sub_img"></div>
                      <div class="ldg_sub_img"></div>
                      <div class="ldg_sub_img"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>숙소객실유형</th>
              <td class="room_type_wrap">
                <input type="checkbox" name="dormitory" id="dormitory"<?php if($l_arr["dormitory"] == "1"){echo "checked";}; ?>><label for="dormitory">도미토리</label>
                <input type="checkbox" name="privateroom" id="privateroom" <?php if($l_arr["privateroom"] == "1"){echo "checked";}; ?>><label for="privateroom">개인실</label>
                <input type="checkbox" name="condo" id="condo" <?php if($l_arr["condo"] == "1"){echo "checked";}; ?>><label for="condo">콘도형</label>
                <input type="checkbox" name="womenonly" id="womenonly" <?php if($l_arr["womenonly"] == "1"){echo "checked";}; ?>><label for="womenonly">여성전용</label>
              </td>
            </tr>
            <tr>
              <th>숙소시설</th>
              <td class="room_facility_wrap">
                <input type="checkbox" name="wifi" id="wifi" <?php if($l_arr["wifi"] == "1"){echo "checked";}; ?>><label for="wifi">Wifi</label>
                <input type="checkbox" name="kitchen" id="kitchen" <?php if($l_arr["kitchen"] == "1"){echo "checked";}; ?>><label for="kitchen">게스트부엌</label>
                <input type="checkbox" name="elevator" id="elevator" <?php if($l_arr["elevator"] == "1"){echo "checked";}; ?>><label for="elevator">엘리베이터</label>
                <input type="checkbox" name="locker" id="locker" <?php if($l_arr["locker"] == "1"){echo "checked";}; ?>><label for="locker">개인사물함</label>
                <input type="checkbox" name="parking" id="parking" <?php if($l_arr["parking"] == "1"){echo "checked";}; ?>><label for="parking">주차가능</label>
                <div class="rf_line"></div>
                <input type="checkbox" name="breakfast" id="breakfast"<?php if($l_arr["breakfast"] == "1"){echo "checked";}; ?>><label for="breakfast">조식</label>
                <input type="checkbox" name="lunch" id="lunch" <?php if($l_arr["lunch"] == "1"){echo "checked";}; ?>><label for="lunch">중식</label>
                <input type="checkbox" name="dinner" id="dinner" <?php if($l_arr["dinner"] == "1"){echo "checked";}; ?>><label for="dinner">석식</label>
              </td>
            </tr>
            <tr>
              <th>공용시설</th>
              <td class="pubilc_facility_wrap">
                <span>화장실<input name="toilet" id="toilet" type="text" value="<?php echo $l_arr['toilet'];?>">개</span>
                <span>샤워실<input name="shower" id="shower" type="text" value="<?php echo $l_arr['shower'];?>">개</span>
                <span>최대인원<input name="ldg_maxnop" id="ldg_maxnop" type="text" value="<?php echo $l_arr['ldg_maxnop'];?>">명</span>
              </td>
            </tr>
            <tr>
              <th>숙소 소개</th>
              <td>
                <textarea name="ldg_info" id="ldg_info_txt" class="ldg_info_txt" placeholder="소개말을 입력해주세요"><?php echo $l_arr['ldg_info'];?></textarea>
              </td>
            </tr>
          </table>
        </div>
        <button type="button" id="ldg_edit_btn" class="ldg_submit_btn btn_hover">숙소 수정</button>
      </form>
    </main>

    <!-- footer -->
    <footer>
      <div id="partner-footer-include"></div>
    </footer>
  </div>
</body>

</html>