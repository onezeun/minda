<?php
  session_start();
  
  /*  1. 이전 페이지에서 값 가져오기 */
  // 사용자들이 쓴 값을 $변수에 저장
  $u_email = $_POST["u_email"]; 
  $u_pwd = $_POST["u_pwd"]; 
  $u_name = $_POST["u_name"]; 
  $u_nickname = $_POST["u_nickname"];
  $u_phone = $_POST["u_phone"]; 
  $u_marketing = isset($_POST["u_marketing"]) ? "Y" : "N"; 

  // 시간 구하기 (가입일)
  $reg_date = date("Y-m-d");

  // 값 확인
  // echo "<p> 이메일 : ".$u_email."</p>";
  // echo "<p> 비밀번호 : ".$u_pwd."</p>";
  // echo "<p> 이름 : ".$u_name."</p>";
  // echo "<p> 닉네임 : ".$u_nickname."</p>";
  // echo "<p> 모바일 : ".$u_phone."</p>";
  // echo "<p> 마케팅수신동의 : ".$u_marketing."</p>";
  // echo "<p> 가입일 : ".$reg_date."</p>";

  /* 2. DB 연결 */
  include "../inc/dbcon.php";

  /* 3. 쿼리 작성 */
  $sql ="INSERT INTO user(u_email, u_pwd, u_name, u_nickname, u_phone, u_marketing, reg_date) VALUES('$u_email', '$u_pwd', '$u_name', '$u_nickname', '$u_phone', '$u_marketing', '$reg_date');";
  $sql_name = "select u_email, u_name from user where u_email='$u_email';";

  /* 4. 쿼리 전송 */
  mysqli_query($dbcon, $sql);
  $result = mysqli_query($dbcon, $sql_name);

  /* 5. 전송된 값 가져오기 & 세션 저장 */
  $array = mysqli_fetch_array($result);
  $_SESSION['s_name'] = $array['u_name'];

  /* 5. DB 접속 종료 */
  mysqli_close($dbcon);

  /* 6.페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"signup_success.php\";
    </script>
    ";
?>