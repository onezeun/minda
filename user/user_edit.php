<?php
  session_start();
  include '../inc/session.php';
  
  /*  1. 이전 페이지에서 값 가져오기 */
  // 사용자들이 쓴 값을 $변수에 저장

  $u_name = $_POST["u_name"]; 
  $u_nickname = $_POST["u_nickname"];
  $u_phone = $_POST["u_phone"]; 
  $u_marketing = $_POST["u_marketing"];
  $remove_img = $_POST["remove_img"];
  $u_img_err = $_FILES['u_img']["error"];

  // 이미지 저장
  if($u_img_err == 0) {
    $u_img_tmp = $_FILES['u_img']['tmp_name'];
    $u_img_name = $_FILES['u_img']['name'];
    $upload_folder = "profilephoto/";
    move_uploaded_file( $u_img_tmp, $upload_folder . $u_img_name );
    
    $path = $upload_folder.$u_img_name;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    // $type = mime_content_type($path);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
  } else if($remove_img == 1){
    $base64 = "http://localhost/KDT-1st-project-minda/user/profilephoto/default_profile.png";
  } else {
    $base64 = $s_img;
  }

  // 값 확인
  // echo "<p> 이름 : ".$u_name."</p>";
  // echo "<p> 닉네임 : ".$u_nickname."</p>";
  // echo "<p> 모바일 : ".$u_phone."</p>";
  // echo "<p> 마케팅수신동의 : ".$u_marketing."</p>";
  // echo "<p>타입 : ".$type."</p>";
  // echo '<img src="'.$base64.'">';
  
  /* 2. DB 연결 */
  include "../inc/dbcon.php";

  /* 3. 쿼리 작성 */
  $sql ="UPDATE user SET u_name='$u_name', u_nickname='$u_nickname', u_phone='$u_phone', u_marketing='$u_marketing', u_img='$base64' WHERE u_idx=$s_idx;";

  /* 4. 쿼리 전송 */
  mysqli_query($dbcon, $sql);


  /* 5. 전송된 값 가져오기 & 세션 저장 */
  $img_session = "select u_idx, u_name, u_email, u_pwd, u_img from user where u_idx='$s_idx';";
  $result = mysqli_query($dbcon, $img_session);
  $array = mysqli_fetch_array($result);

  unset($_SESSION["s_name"]);
  unset($_SESSION["s_img"]);

  $_SESSION['s_name'] = $array['u_name'];
  $_SESSION['s_img'] = $array['u_img'];

  /* 5. DB 접속 종료 */
  mysqli_close($dbcon);

  /* 6.페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"user.html\";
    </script>
    ";
?>