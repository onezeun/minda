<?php
  include "../inc/session.php";
  
  /*  이전 페이지에서 값 가져오기 */

  // 업주 번호
  $sp_idx = $_SESSION["sp_idx"];
  $ldg_idx = $_POST["ldg_idx"];

  //숙소 lodging
  $ldg_name = $_POST["ldg_name"]; 
  $ldg_country = $_POST["ldg_country"]; 
  $ldg_city = $_POST["ldg_city"]; 
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

  /* DB 연결 */
  include "../inc/dbcon.php";

  /* 쿼리 작성 */
  $ldg_sql ="UPDATE lodging SET ldg_name='$ldg_name', ldg_country='$ldg_country', ldg_city='$ldg_city', ldg_info='$ldg_info', ldg_maxnop=$ldg_maxnop, toilet=$toilet, shower=$shower WHERE ldg_idx=$ldg_idx;";
  mysqli_query($dbcon, $ldg_sql);

  $facility_sql ="UPDATE lodging_facility SET dormitory='$dormitory', privateroom='$privateroom', condo='$condo', womenonly='$womenonly', wifi='$wifi', kitchen='$kitchen', elevator='$elevator', locker='$locker', parking='$parking', breakfast='$breakfast', lunch='$lunch', dinner='$dinner' WHERE ldg_idx=$ldg_idx;";
  mysqli_query($dbcon, $facility_sql);

  $img_sql = "SELECT * FROM lodging_file WHERE ldg_idx=$ldg_idx";
  $result = mysqli_query($dbcon, $img_sql);
  $array = mysqli_fetch_array($result);
  $l_file_idx = $array['l_file_idx'];

  $mainimg_sql = "UPDATE lodging_file SET l_file_src='$mainbase64', l_file_name='$ldg_mainimg_name', l_file_type='$type' WHERE l_file_idx=$l_file_idx AND l_file_main='Y';";
  mysqli_query($dbcon, $mainimg_sql);

  /* DB 접속 종료 */
  mysqli_close($dbcon);

  /* 페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"http://localhost/KDT-1st-project-minda/partner/room/list_page.php\";
    </script>
    ";
?>