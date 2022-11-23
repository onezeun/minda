<?php
  include "../inc/session.php";
  $res_idx = $_GET['res_idx'];
  echo $res_idx;

  /* DB 연결 */
  include "../inc/dbcon.php";

  $res_date = date("Y-m-d H:i:s");
  // 예약 상태
  // 1 : 결제 대기 (결제), 2 : 예약완료 (예약취소), 3 : 예약취소(환불진행중, 환불완료), 4 : 숙박완료(리뷰쓰기)
  $sql = "UPDATE reservation SET res_state='3', res_time='$res_date' WHERE res_idx=$res_idx;";

  mysqli_query($dbcon, $sql);


  /* DB 접속 종료 */
  mysqli_close($dbcon);

  /* 페이지 이동 */
  echo "
  <script type=\"text/javascript\">
    location.href = \"user_cancel_reservation.php\";
  </script>
  ";
?>