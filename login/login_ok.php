<?php
// 세션 시작
session_start();

/* 데이터 가져오기 */
$u_email = $_POST['u_email'];
$u_pwd = $_POST['u_pwd'];
// 데이터 확인
echo $u_email."/".$u_pwd;

/* DB 연결 */
include '../inc/dbcon.php';

/* 쿼리 작성 */
$sql = "select u_idx, u_name, u_email, u_pwd from user where u_email='$u_email';";
// 확인
// echo $sql;

/* 쿼리 전송 */
$result = mysqli_query($dbcon, $sql);

/* DB에서 데이터 가져오기 */
// 전체 데이터 개수 조회 / select count(*) from members; -> 페이지 네이션 구현할 때 필요
// mysqli_num_rows("전송한 쿼리") : 컬럼 이름을 이용해서 데이터를 가져옴
$num = mysqli_num_rows($result);
// echo $num;

/* 조건 처리 */
if (!$num) {
    // 일치하는 아이디가 없다면
    // 메세지 출력 후 이전 페이지로 이동
    echo "
      <script type=\"text/javascript\">
        alert(\"일치하는 아이디가 없습니다.\");
        history.back();
      </script>
      ";
} else {
    // 일치하는 아이디가 존재하면
    // DB에서 사용자 정보(비밀번호) 가져오기
    $array = mysqli_fetch_array($result);
    $g_pwd = $array['u_pwd'];

    if ($u_pwd != $g_pwd) {
      // 사용자가 입력한 비밀번호와 DB에서 가져온 비밀번호가 일치하지 않는다면
      // 메세지 출력 후 이전 페이지 이동
      echo "
      <script type=\"text/javascript\">
        alert(\"비밀번호가 일치하지 않습니다.\");
        history.back();
      </script>
      ";
    } else {
      // 비밀번호가 일치한다면
      echo "
      <script type=\"text/javascript\">
        alert(\"로그인 되었습니다.\");
      </script>
      ";
        // 세션 변수 생성
        // $_SESSION["세션변수명"] = "저장할 값";
        $_SESSION['s_idx'] = $array['u_idx'];
        $_SESSION['s_name'] = $array['u_name'];
        $_SESSION['s_email'] = $array['u_email'];
    }
}

// DB 종료
mysqli_close($dbcon);

// 페이지 이동
echo "
<script type=\"text/javascript\">
  location.href = \"../index.html\";
</script>
";
?>
