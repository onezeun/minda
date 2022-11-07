<?php
// 세션으로 데이터 가져오기
include '../inc/session.php';

// 로그인 사용자만 접근
include '../inc/login_check.php';

// DB 연결
include '../inc/dbcon.php';

//  json을 php에서 사용하기 위해 필요한 구문
header("Content-Type: application/json");

// 쿼리 작성
$sql = "select * from user where u_idx=$s_idx;";

// 쿼리 실행
$result = mysqli_query($dbcon, $sql);

// 데이터 가져오기
$array = mysqli_fetch_array($result); 

// json 형식으로 값 보내기
echo (json_encode($array, JSON_UNESCAPED_UNICODE));

?>
