<?php
  include '../inc/session.php';

  // DB 연결
  include "../inc/dbcon.php";

  $ldg_idx = $_GET['ldg_idx'];
  $r_idx = $_GET['r_idx'];
  // 쿼리 작성
  // delete from 테이블명 where 필드명='값';
  $sql = "DELETE FROM review WHERE u_idx=$s_idx AND ldg_idx=$ldg_idx AND r_idx=$r_idx;";

  // 쿼리 전송
  mysqli_query($dbcon, $sql);

  // DB 종료
  mysqli_close($dbcon);


  // 페이지 이동
  echo "
    <script type=\"text/javascript\">
      alert(\"정상 처리되었습니다.\");
      location.href = \"user_last_reservation.php\";
    </script>
  ";

?>