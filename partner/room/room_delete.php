<?php
// 데이터 가져오기 - get 방식 활용, 페이지 경로에 데이터 포함
$ldg_idx = $_GET["ldg_idx"];
$r_idx = $_GET["r_idx"];

// DB 연결
include "../inc/dbcon.php";

// 쿼리 작성
// delete from 테이블명 where 필드명='값';
$sql = "DELETE FROM room WHERE r_idx=$r_idx;";

// 쿼리 전송
mysqli_query($dbcon, $sql);

// DB 종료
mysqli_close($dbcon);

// 페이지 이동
echo "
    <script type=\"text/javascript\">
        alert(\"정상 처리되었습니다.\");
        location.href = \"room_page.php?ldg_idx=$ldg_idx\";
    </script>
    ";
?>