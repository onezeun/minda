<?php
  include '../inc/session.php';

  // DB 연결
  include "../inc/dbcon.php";

  // 쿼리 작성
  // delete from 테이블명 where 필드명='값';
  $sql = "delete from user where u_idx=$s_idx;";

  // 쿼리 전송
  mysqli_query($dbcon, $sql);

  // DB 종료
  mysqli_close($dbcon);

  // 세션 삭제
  unset($_SESSION["s_idx"]);
  unset($_SESSION["s_name"]);
  unset($_SESSION["s_id"]);

  // 페이지 이동
  echo "
    <script type=\"text/javascript\">
      alert(\"정상 처리되었습니다.\");
      location.href = \"../index.html\";
    </script>
  ";

?>