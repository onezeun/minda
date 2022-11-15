<?php
  include "../inc/session.php";
  
  /*  1. 이전 페이지에서 값 가져오기 */

  // 업주 번호
  $sp_idx = $_SESSION["sp_idx"];
  $ldg_idx = $_POST["ldg_idx"];

  //객실 
  $r_name = $_POST["r_name"]; 
  $r_img_err = $_FILES["r_img"]["error"];

  // 객실 이미지 저장
  if($r_img_err == 0) {
    $r_img_tmp = $_FILES['r_img']['tmp_name'];
    $r_img_name = $_FILES['r_img']['name'];
    $upload_folder = "images/";
    move_uploaded_file( $r_img_tmp, $upload_folder . $r_img_name );
    
    $r_path = $upload_folder.$r_img_name;
    $r_type = pathinfo($r_path, PATHINFO_EXTENSION);
    $r_data = file_get_contents($r_path);
    $roombase64 = 'data:image/' . $r_type . ';base64,' . base64_encode($r_data);
  }
  
  $r_gender = $_POST["r_gender"]; 
  $r_dormitory = isset($_POST["r_dormitory"]) ? "1" : "0";
  $r_privateroom = isset($_POST["r_privateroom"]) ? "1" : "0";
  $r_condo = isset($_POST["r_condo"]) ? "1" : "0";

  $r_min = $_POST["r_min"]; 
  $r_max = $_POST["r_max"]; 

  $r_price = $_POST["r_price"]; 

  // echo $r_name;
  // echo $r_gender;
  // echo $r_dormitory;
  // echo $r_privateroom;
  // echo $r_condo;
  // echo $r_min;
  // echo $r_max;
  // echo $r_price;

  /* DB 연결 */
  include "../inc/dbcon.php";

  /* 쿼리 작성 */
  $sql ="INSERT INTO room (r_name, r_img, r_gender, r_dormitory, r_privateroom, r_condo, r_min, r_max, r_price, ldg_idx) VALUES ( '$r_name', '$roombase64', '$r_gender', $r_dormitory, $r_privateroom, $r_condo, $r_min, $r_max, $r_price, $ldg_idx);";

  mysqli_query($dbcon, $sql);

  /* DB 접속 종료 */
  mysqli_close($dbcon);

  /* 페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"http://localhost/KDT-1st-project-minda/partner/room/room_page.php?ldg_idx=$ldg_idx\";
    </script>
    ";
?>