<?php
  include "../inc/session.php";
  
  /*  1. 이전 페이지에서 값 가져오기 */

  // 업주 번호
  $sp_idx = $_SESSION["sp_idx"];

  //숙소 lodging
  $ldg_name = $_POST["ldg_name"]; 
  $ldg_addr = $_POST["ldg_addr"]; 
  $ldg_info = $_POST["ldg_info"]; 
  $ldg_maxnop = $_POST["ldg_maxnop"]; 
  $toilet = $_POST["toilet"]; 
  $shower = $_POST["shower"]; 
  $ldg_mainimg_err = $_FILES["ldg_mainimg"]["error"];

  // 숙소 첨부파일 
  // 대표 이미지 저장
  if($ldg_mainimg_err == 0) {
    $ldg_mainimg_tmp = $_FILES['ldg_mainimg']['tmp_name'];
    $ldg_mainimg_name = $_FILES['ldg_mainimg']['name'];
    $upload_folder = "images/";
    move_uploaded_file( $ldg_mainimg_tmp, $upload_folder . $ldg_mainimg_name );
    
    $path = $upload_folder.$ldg_mainimg_name;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $mainbase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
  }

  // 서브이미지 저장
  // $ldg_subimg = $_FILES["ldg_subimg"];

  // 숙소 시설
  $dormitory = isset($_POST["dormitory"]) ? "1" : "0";
  $privateroom = isset($_POST["privateroom"]) ? "1" : "0";
  $condo = isset($_POST["condo"]) ? "1" : "0";
  $womenonly = isset($_POST["womenonly"]) ? "1" : "0";
  $wifi = isset($_POST["wifi"]) ? "1" : "0";
  $kitchen = isset($_POST["kitchen"]) ? "1" : "0";
  $elevator = isset($_POST["elevator"]) ? "1" : "0";
  $locker = isset($_POST["locker"]) ? "1" : "0";
  $parking = isset($_POST["parking"]) ? "1" : "0";
  $breakfast = isset($_POST["breakfast"]) ? "1" : "0";
  $lunch = isset($_POST["lunch"]) ? "1" : "0";
  $dinner = isset($_POST["dinner"]) ? "1" : "0";

  // echo $dormitory;
  // echo $privateroom;
  // echo $condo;
  // echo $womenonly;
  // echo $wifi;
  // echo $kitchen;
  // echo $elevator;
  // echo $locker;
  // echo $parking;
  // echo $breakfast;
  // echo $lunch;
  // echo $dinner;

  // //객실 
  // $r_name = $_POST["r_name"]; 
  // $r_img = $_FILE["r_img"]; 

  // $r_gender = $_POST["r_gender"]; 
  // $r_dormitory = $_POST["r_dormitory"]; 
  // $r_privateroom = $_POST["r_privateroom"]; 
  // $r_condo = $_POST["r_condo"]; 

  // $r_min = $_POST["r_min"]; 
  // $r_max = $_POST["r_max"]; 

  // $r_price = $_POST["r_price"]; 

  /* DB 연결 */
  include "../inc/dbcon.php";

  /* 쿼리 작성 */
  $ldg_sql ="INSERT INTO lodging (ldg_name, ldg_addr, ldg_info, ldg_maxnop, toilet, shower, p_idx) VALUES ( '$ldg_name', '$ldg_addr', '$ldg_info', $ldg_maxnop, $toilet, $shower, $sp_idx);";
  // $ldg_sql ="INSERT INTO lodging (ldg_name, ldg_addr, ldg_info, ldg_maxnop, toilet, shower, p_idx) VALUES ( '$ldg_name', '$ldg_addr', '$ldg_info', $ldg_maxnop, $toilet, $shower, $sp_idx);";
  mysqli_query($dbcon, $ldg_sql);

  $ldg_sel_sql ="SELECT ldg_idx FROM lodging WHERE p_idx = $sp_idx;";

  $result = mysqli_query($dbcon, $ldg_sel_sql);
  $array = mysqli_fetch_array($result);
  $ldg_idx = $array['ldg_idx'];

  $mainimg_sql = "INSERT INTO lodging_file (l_file_main, l_file_src, l_file_name, ldg_idx) VALUES ('Y', '$mainbase64', '$ldg_mainimg_name', '$ldg_idx');";
  mysqli_query($dbcon, $mainimg_sql);

  $facility_sql ="INSERT INTO lodging_facility (dormitory, privateroom, condo, womenonly, wifi, kitchen, elevator, locker, parking, breakfast, lunch, dinner, ldg_idx) VALUES ($dormitory, $privateroom, $condo, $womenonly, $wifi, $kitchen, $elevator, $locker, $parking, $breakfast, $lunch, $dinner, $ldg_idx);";
  mysqli_query($dbcon, $facility_sql);



  /* DB 접속 종료 */
  mysqli_close($dbcon);

  /* 페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"http://localhost/KDT-1st-project-minda/partner/room/list_page.php\";
    </script>
    ";
?>