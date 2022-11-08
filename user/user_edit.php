<?php
  include '../inc/session.php';
  
  /*  1. 이전 페이지에서 값 가져오기 */
  // 사용자들이 쓴 값을 $변수에 저장
  $u_name = $_POST["u_name"]; 
  $u_nickname = $_POST["u_nickname"];
  $u_phone = $_POST["u_phone"]; 
  $u_marketing = $_POST["u_marketing"];

  // 값 확인
  // echo "<p> 이름 : ".$u_name."</p>";
  // echo "<p> 닉네임 : ".$u_nickname."</p>";
  // echo "<p> 모바일 : ".$u_phone."</p>";
  // echo "<p> 마케팅수신동의 : ".$u_marketing."</p>";

  /* 2. DB 연결 */
  include "../inc/dbcon.php";

  /* 3. 쿼리 작성 */
  $sql ="UPDATE user SET u_name='$u_name', u_nickname='$u_nickname', u_phone='$u_phone', u_marketing='$u_marketing' WHERE u_idx=$s_idx;";
  echo $sql;

  /* 4. 쿼리 전송 */
  mysqli_query($dbcon, $sql);

  /* 5. 전송된 값 가져오기 & 세션 저장 */
  // $array = mysqli_fetch_array($result);

  /* 5. DB 접속 종료 */
  mysqli_close($dbcon);

  /* 6.페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"user.html\";
    </script>
    ";
?>