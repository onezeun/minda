<?php
session_start();

//세션삭제 -> 로그인 할 때 만들어놨던거 다 삭제
//unset(세션변수)
unset($_SESSION["s_idx"]);
unset($_SESSION["s_name"]);
unset($_SESSION["s_email"]);

// 페이지 이동
echo "
<script type=\"text/javascript\">
location.href = \"../index.html\";
</script>
";
?>