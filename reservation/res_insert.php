<?php
  include "../inc/session.php";

  $ldg_idx = $_GET['ldg_idx'];
  $r_idx = $_GET['r_idx'];

  $res_name = $_POST['res_name'];
  $res_phone = $_POST['res_phone'];
  $res_email = $_POST['res_email'];
  $res_gender = $_POST['res_gender'];
  $res_checkin = $_POST['res_checkin'];
  $res_checkout = $_POST['res_checkout'];
  $res_time = $_POST['res_time'];
  $res_nop = $_POST['res_nop'];
  $res_nod = $_POST['res_nod'];
  $total_price = $_POST['total_price'];

  // 현재 시간(예약 날짜)
  $res_date = date("Y-m-d");

  // 예약 상태
  $res_state = "결제 대기"; 

  // echo "<p>이름 : ".$res_name."</p>";
  // echo "<p>연락처 : ".$res_phone."</p>";
  // echo "<p>이메일 : ".$res_email."</p>";
  // echo "<p>성별 : ".$res_gender."</p>";
  // echo "<p>체크인날짜 : ".$res_checkin."</p>";
  // echo "<p>체크아웃날짜 : ".$res_checkout."</p>";
  // echo "<p>체크인예정시간 : ".$res_time."</p>";
  // echo "<p>인원 : ".$res_nop."</p>";
  // echo "<p>숙박일 : ".$res_nod."</p>";
  // echo "<p>결제금액 : ".$total_price."</p>";

  /* DB 연결 */
  include "../inc/dbcon.php";

  $sql = "INSERT INTO reservation ( res_name, res_phone, res_email, res_gender, res_checkin, res_checkout, res_time, res_nop, res_nod, total_price, res_date, res_state, ldg_idx, r_idx, u_idx) VALUES ( '$res_name', '$res_phone', '$res_email', '$res_gender', '$res_checkin', '$res_checkout', '$res_time', '$res_nop', '$res_nod', '$total_price', '$res_date', '$res_state', '$ldg_idx', '$r_idx', '$s_idx');";

  mysqli_query($dbcon, $sql);

  /* DB 접속 종료 */
  mysqli_close($dbcon);

    /* 페이지 이동 */
    echo "
    <script type=\"text/javascript\">
      location.href = \"reservation_success.html\";
    </script>
    ";
?>