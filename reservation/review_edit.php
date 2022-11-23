<?php
  include "../inc/session.php";

  $ldg_idx = $_POST['ldg_idx'];
  $r_idx = $_POST['r_idx'];
  $rv_score = $_POST['rv_score'];
  $rv_content = $_POST['rv_content'];
  $rv_time = date("Y-m-d H:i");

  /* DB 연결 */
  include "../inc/dbcon.php";

  $sql = "UPDATE review SET rv_score='$rv_score', rv_content='$rv_content' WHERE u_idx=$s_idx AND ldg_idx=$ldg_idx;";

  mysqli_query($dbcon, $sql);

  /* DB 접속 종료 */
  mysqli_close($dbcon);

  /* 페이지 이동 */
  echo "
  <script type=\"text/javascript\">
    location.href = \"user_last_reservation.php\";
  </script>
  ";
?>