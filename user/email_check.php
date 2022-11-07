<?php
  // 데이터 가져오기
  $u_email = trim($_GET['u_email']);
  
  // DB 연결
  $connect = mysqli_connect("localhost","root","");
  $db_con = mysqli_select_db($connect, "minda");
 
  // 쿼리 작성 후 전송
  $sql="select * from user where u_email='$u_email'";
  $result=mysqli_query($connect, $sql);
  $num_match=mysqli_num_rows($result);

  if(!$num_match){
	  echo "N";
  } else{
	  echo "Y";
  }
?>