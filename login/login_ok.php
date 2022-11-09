<?php
// 세션 시작
session_start();

/* 데이터 가져오기 */
$u_email = $_POST['u_email'];
$u_pwd = $_POST['u_pwd'];

/* DB 연결 */
include '../inc/dbcon.php';

/* 쿼리 작성 */
$sql = "select u_idx, u_name, u_email, u_pwd, u_img from user where u_email='$u_email';";

/* 쿼리 전송 */
$result = mysqli_query($dbcon, $sql);

/* DB에서 데이터 가져오기 */
// mysqli_num_rows("전송한 쿼리") : 컬럼 이름을 이용해서 데이터를 가져옴
$num = mysqli_num_rows($result);
$array = mysqli_fetch_array($result);

if(!$num){
  //일치하는 아이디 없음
  echo "1";
} else{
  if ($u_pwd != $array['u_pwd']) {
    // 비밀번호 불일치
    echo "2";
  } else {
    // 로그인
    echo "3";

    $_SESSION['s_idx'] = $array['u_idx'];
    $_SESSION['s_name'] = $array['u_name'];
    $_SESSION['s_email'] = $array['u_email'];
    $_SESSION['s_img'] = $array['u_img'];
  }
};

// DB 종료
mysqli_close($dbcon);

?>
