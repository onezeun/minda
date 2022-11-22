<?php 
  // 세션으로 데이터 가져오기
  include '../inc/session.php';

  // 로그인 사용자만 접근
  include '../inc/login_check.php';

  // DB 연결
  include '../inc/dbcon.php';

  $ldg_idx = $_GET['ldg_idx'];

  $r_idx = $_POST['r_idx'];
  $checkin_date = $_POST['checkin_date'];
  $checkout_date = $_POST['checkout_date'];
  $rv_price = $_POST['rv_price'];
  $rv_nop = $_POST['rv_nop'];
  $rv_date = $_POST['rv_date'];

  // echo "<p>".$ldg_idx."</p>";
  // echo "<p>".$r_idx."</p>";
  // echo "<p>".$checkin_date."</p>";
  // echo "<p>".$checkout_date."</p>";
  // echo "<p>".$rv_price."</p>";
  // echo "<p>".$rv_nop."</p>";
  // echo "<p> 숙박일자 : ".$rv_date."</p>";

  $sql = "SELECT l.ldg_idx, l.ldg_name, l.ldg_main_img, l.ldg_country, l.ldg_city, r.r_idx, r.r_name, r.r_price FROM lodging l JOIN room r ON l.ldg_idx = r.ldg_idx WHERE l.ldg_idx=$ldg_idx AND r.r_idx=$r_idx;";
  $result = mysqli_query($dbcon, $sql);
  $array = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>숙소 예약</title>
  <link rel="shortcut icon" href="../images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="stylesheet" type="text/css" href="../css/reservation.css">
  <link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
    </script>
  <script type="text/javascript" src="../js/includ.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="../js/reservation.js"></script>
</head>

<body>
  <div class="wrap">
    <!-- header -->
    <header>
      <div id="header-include"></div>
    </header>

    <!-- content -->
    <main id="content" class="content">
      <div class="reservation_wrap">
        <h2 class="reservation_title">숙소 예약</h2>
        <form name="reservation_form" id="reservation_form" action="res_insert.php?s_idx=<?php echo $s_idx ?>&ldg_idx=<?php echo $ldg_idx ?>&r_idx=<?php echo $r_idx;?>" method="post">
          <div class="form_left">
            <fieldset class="room_info">
              <legend class="room_info_title">예약 정보</legend>
              <div class="room_info_cont">
                <img src="../images/<?php echo $array['ldg_main_img']; ?>" alt="숙소 대표 사진" class="reservation_roomphoto">
                <p class="room_info_country"><?php echo $array["ldg_country"]." · ".$array["ldg_city"];?></p>
                <p class="room_info_name"><?php echo $array['ldg_name']; ?></p>
                <p class="room_info_type"><?php echo $array['r_name']; ?></p>
                <p class="room_info_date"><?php echo $checkin_date." ~ ".$checkout_date." / ".$rv_date; ?>박</p>
              </div>
            </fieldset>

            <fieldset class="user_info">
              <legend class="user_info_title">숙박자 정보</legend>
              <div class="user_info_cont">
                <div class="user_info_wrap">
                  <p>이름</p>
                  <input type="text" name="res_name" id="name_input" class="user_input" maxlength="30"><span id="err_name" class="err_txt"></span>
                </div>
                <div class="user_info_wrap">
                  <p>연락처</p>
                  <input type="text" name="res_phone" id="mobile_input" class="user_input" maxlength="20"><span id="err_mobile" class="err_txt"></span>
                </div>
                <div class="user_info_wrap">
                  <p>이메일</p>
                  <input type="text" name="res_email" id="email_input" class="user_input" maxlength="50"><span id="err_email" class="err_txt"></span>
                </div>
                <div class="user_info_wrap">
                  <p>체크인예정시간</p>
                  <input type="text" name="res_time" id="checkin_input" class="user_input" readonly><span id="err_checkin"class="err_txt"></span>
                </div>
                <div class="user_info_wrap">
                  <p>숙박자 성별</p>
                  <input type="radio" name="res_gender" id="man" value="1"><label for="man" class="gender man">남</label>
                  <input type="radio" name="res_gender" id="woman" value="2"><label for="woman" class="gender">여</label>
                  <span id="err_gender"class="err_txt"></span>
                </div>
                <input type="hidden" name="res_checkin" value="<?php echo $checkin_date; ?>">
                <input type="hidden" name="res_checkout" value="<?php echo $checkout_date; ?>">
                <input type="hidden" name="res_nop" value="<?php echo $rv_nop; ?>">
                <input type="hidden" name="res_nod" value="<?php echo $rv_date; ?>">
                <input type="hidden" name="total_price" value="<?php echo $rv_price; ?>">
              </div>
              <div class="user_info_warning_wrap">
                <p class="user_info_warning_icon indent">경고</p>
                <div class="user_info_warning_msg">
                  <p>- 숙박자 정보를 꼭 정확하게 기재해주세요.<br>
                  <p class="user_info_warning_msg01">(허위정보로 확인될 경우, 통보 없이 모든 예약취소 및 민다 서비스 이용이 차단될 수 있습니다.)</p>
                  </p>
                  <p>- '체크인 예정시간'이 변경될 경우, 바우처에 기재된 숙소 연락처로 변경된 시간을 꼭 연락 주시기 바랍니다.</p>
                </div>
              </div>
            </fieldset>

            <fieldset class="pay">
              <legend class="pay_title">결제 방법</legend>
              <div class="pay_cont">
                <div class="pay1"><input type="radio" name="pay_method" id="pay1" value="1"> <label for="pay1">신용/체크카드</label></div>
                <div class="pay2"><input type="radio" name="pay_method" id="pay2" value="2"> <label for="pay2">카카오페이</label></div>
                <div class="pay3"><input type="radio" name="pay_method" id="pay3" value="3"> <label for="pay3">가상계좌</label></div>
              </div>
            </fieldset>
          </div>

          <div class="form_right">
            <fieldset class="payment">
              <legend class="payment_title">결제 정보</legend>
              <div class="payment_wrap1">
                <div class="selectroom">
                  <p class="selectroom_title">객실 1개 X <?php echo $rv_date; ?>박 X <?php echo $rv_nop; ?>명</p>
                  <p class="selectroom_account"><?php echo number_format($rv_price);?> 원</p>
                </div>
                <div class="oneday">
                  <p class="oneday_title">1박 요금</p>
                  <p class="oneday_account"><?php echo number_format($array['r_price']); ?> 원</p>
                </div>
              </div>
              <div class="payment_wrap2">
                <p class="totle_title">총 결제 금액</p>
                <p class="totle_account"><?php echo number_format($rv_price);?> 원</p>
              </div>
            </fieldset>
            <fieldset class="term">
              <legend class="term_title">약관 안내</legend>
              <div id="checkbox_group" class="term_wrap">
                <div class="checkall_wrap">
                  <input type="checkbox" id="check_all"><label for="check_all">전체 약관 동의</label>
                  <span id="err_apply" class="err_txt"></span>
                </div>
                <div class="checkterm_wrap">
                  <div class="term1">
                    <input type="checkbox" id="check1" class="nomal">
                    <label for="check1">제3자 제공 동의</label>
                    <button type="button">약관보기</button>
                  </div>
                  <div class="term2">
                    <input type="checkbox" id="check2" class="nomal">
                    <label for="check2">민다 취소 환불규정 동의</label>
                    <button type="button">규정보기</button>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="payment_warning">
              <p class="payment_warning_icon indent">경고</p>
              <div class="payment_warning_msg">
                <p class="payment_warning_msg01">
                  - 실시간 바로 예약금을 결제하지 않으시면 예약은 자동으로
                  취소됩니다
                </p>
                <p>
                  - 같은 일정을 동시에 예약한 타 여행자가 먼저 입금해 버린
                  경우에도 예약은 취소될 수 있으며, 중복 입금인 경우 나중
                  입금고객의 예약금은 전액 환불해 드립니다.
                </p>
              </div>
            </div>
            <button type="button" id="reservation_btn" class="reservation_btn btn_hover">결제하기</button>
        </form>
      </div>
    </main>

    <!-- footer -->
    <footer>
      <div  id="footer-include"></div>
    </footer>
  </div>

</body>

</html>