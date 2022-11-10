<?php
  include "inc/session.php";
  
  /*  1. 이전 페이지에서 값 가져오기 */
  // 사용자들이 쓴 값을 $변수에 저장
  $p_name = $_POST["p_name"]; 
  $p_biznum = $_POST["p_biznum"]; 
  $p_tel = $_POST["p_tel"]; 
  $s_idx = $_SESSION["s_idx"];

  echo $p_name;
  echo $p_biznum;
  echo $p_tel;
  echo $s_idx;

  /* 2. DB 연결 */
  include "../inc/dbcon.php";

  /* 3. 쿼리 작성 */
  $sql ="INSERT INTO partner_user(u_idx, p_name, p_biznum, p_tel) VALUES('$s_idx', '$p_name', '$p_biznum', '$p_tel');";

  /* 4. 쿼리 전송 */
  mysqli_query($dbcon, $sql);

  /* 5. 전송된 값 가져오기 & 세션 저장 */
  // $array = mysqli_fetch_array($result);

  /* 5. DB 접속 종료 */
  mysqli_close($dbcon);

  /* 6.페이지 이동 */
  echo "
    <script type=\"text/javascript\">
      location.href = \"http://localhost/KDT-1st-project-minda/partner/partner_info.php\";
    </script>
    ";
?>