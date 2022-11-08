<?php
  include '../inc/session.php';
  
  /*  1. 이전 페이지에서 값 가져오기 */
  // 사용자들이 쓴 값을 $변수에 저장
  $u_pwd = $_POST["u_pwd"]; 

  /* 2. DB 연결 */
  include "../inc/dbcon.php";

  /* 3. 쿼리 작성 */
  $sql ="UPDATE user SET u_pwd='$u_pwd' WHERE u_idx=$s_idx;";

  /* 4. 쿼리 전송 */
  mysqli_query($dbcon, $sql);
  
  /* 5. DB 접속 종료 */
  mysqli_close($dbcon);

  echo "
  <script type=\"text/javascript\">
    alert(\"비밀번호가 변경되었습니다.\");
    location.href = \"user.html\";
  </script>
  ";
?>