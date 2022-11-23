<?php
  // 데이터 가져오기
  $u_email = trim($_GET['u_email']);
  
  // DB 연결
  include "../inc/dbcon.php";
 
  // 쿼리 작성 후 전송
  $sql="SELECT * FROM users WHERE u_email='$u_email'";
  $result=mysqli_query($connect, $sql);
  $num_match=mysqli_num_rows($result);

  if(!$num_match){
	  echo "N";
  } else{
	  echo "Y";
  }
?>