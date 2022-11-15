<?php
  include "../inc/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>파트너 숙소관리 페이지</title>
  <link rel="shortcut icon" href="../../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../../css/reset.css" />
  <link rel="stylesheet" type="text/css" href="../../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/room.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/include.js"></script>
  <script type="text/javascript" src="../../js/slick.js"></script>
  <script type="text/javascript" src="../js/room.js"></script>

</head>

<body>
  <div class="wrap">
    <!-- header -->
    <header>
      <div id="partner-header-include"></div>
    </header>

    <!-- content -->
    <main id="content" class="content">
      <div class="side_bar">
        <h2 class="hide">관리메뉴</h2>
        <div class="partner_info">
          <a href="../partner_info_page.php">파트너 정보</a>
        </div>
        <div class="ldg_list">
          <a href="list_page.php">숙소 리스트</a>
        </div>
        <div class="reservation">
          <a href="../reservation/partner_reservation_page.php">예약 관리</a>
        </div>
        <div class="message">
          <a href="#">메세지</a>
        </div>
        <div class="review">
          <a href="#">후기 관리</a>
        </div>
      </div>

      <form name="room_form" id="room_form" class="room_form" action="room_insert.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ldg_idx" value="<?php echo $_GET["ldg_idx"]; ?>">
        <div class="room_cont">
          <table class="room_edit_table">
            <tr>
              <th>객실 이름</th>
              <td>
                <input type="text" name="r_name" id="room_name" class="room_name" placeholder="객실 이름을 입력해주세요.">
              </td>
            </tr>
            <tr>
              <th>
                <p>객실 사진</p>
                <button type="button" id="room_img_btn" class="room_img_btn btn_hover">이미지 업로드</button>
              </th>
              <td>
                <div class="room_img_wrap">
                  <input type="file" accept="image/*" name="r_img" id="room_img_input" class="room_img_input">
                  <img src="" id="room_img" class="room_img">
                </div>
              </td>
            </tr>
            <tr>
              <th>객실 유형</th>
              <td class="room_facility_wrap">
                <input type="radio" name="r_gender" id="room_unisex" value="1"><label for="room_unisex">남여공용</label>
                <input type="radio" name="r_gender" id="room_womanonly" value="2"><label
                  for="room_womanonly">여성용</label>
                <input type="radio" name="r_gender" id="manonly" value="3"><label for="manonly">남성용</label>
                <div class="rf_line"></div>
                <input type="checkbox" name="r_dormitory" id="room_dormitory"><label for="room_dormitory">도미토리</label>
                <input type="checkbox" name="r_privateroom" id="room_privateroom"><label
                  for="room_privateroom">개인실</label>
                <input type="checkbox" name="r_condo" id="room_condo"><label for="room_condo">콘도형</label>
              </td>
            </tr>
            <tr>
              <th>객실인원</th>
              <td class="room_maxnop">
                <span>최소<input type="text" name="r_min" id="r_min">명</span> ~ <span>최대<input type="text" name="r_max"
                    id="r_max">명</span>
              </td>
            </tr>
            <tr>
              <th>금액</th>
              <td class="room_price">
                <span class="room_price_txt">1인 1박 기준</span><input type="text" name="r_price"
                  id="r_price"><span>원</span>
              </td>
            </tr>

            <tr class="room_list">
              <th>등록된 객실</th>
              <td>
                <ul id="room_slide" class="room_slide">
                  <li>
                    <div id="card" class="card room1">
                      <button type="button" id="card_delete_btn" class="card_delete_btn indent">삭제</button>
                      <img src="../images/bestroom_image01.jpg" alt="영국런던런던스테이">
                      <div class="card_cont_wrap">
                        <a href="room_page.php?ldg_idx=<?php echo $ldg_idx?>&r_idx=<?php echo $r_idx?>" class="block">
                          <p class="room_title">2인 여성 도미토리</p>
                          <div class="room_cont_txt">
                            <p>여성도미토리</p>
                            <p>객실정원 1 ~ 2</p>
                          </div>
                          <div class="room_price_wrap">
                            <span class="room_price_txt">1박 금액</span><span class="room_price">90,800 원</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </li>
                </ul>
                <a href="#" id="room_btn1" class="card_prev">이전</a>
                <a href="#" id="room_btn2" class="card_next">다음</a>
              </td>
            </tr>
          </table>
          <button type="button" id="room_submit_btn" class="room_submit_btn btn_hover">객실 등록</button>
        </div>
      </form>
    </main>

    <!-- footer -->
    <footer>
      <div id="partner-footer-include"></div>
    </footer>
  </div>
</body>

</html>