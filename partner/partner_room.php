<?php
  include "inc/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>파트너 숙소관리 페이지</title>
  <link rel="shortcut icon" href="../images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/reset.css" />
  <link rel="stylesheet" type="text/css" href="../css/header.css" />
  <link rel="stylesheet" type="text/css" href="../css/footer.css" />
  <link rel="stylesheet" type="text/css" href="../css/partner_room.css" />
  <link rel="stylesheet" type="text/css" href="../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/include.js"></script>
  <script type="text/javascript" src="../js/slick.js"></script>
  <script type="text/javascript" src="../js/partner_room.js"></script>

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
        <div class="reservation">
          <a href="partner_reservation.php?p_idx=<?php echo $sp_idx ?>">예약 관리</a>
        </div>
        <div class="message">
          <a href="#">메세지</a>
        </div>
        <div class="review">
          <a href="#">후기 관리</a>
        </div>
        <div class="room">
          <a href="partner_room.php?p_idx=<?php echo $sp_idx ?>" class="this">숙소 및 객실 관리</a>
        </div>
        <div class="partner_info">
          <a href="partner_info.php?p_idx=<?php echo $sp_idx ?>">파트너 정보 수정</a>
        </div>
      </div>

      <div class="room_edit_cont">
        <form>
          <table class="room_edit_table">
            <tr>
              <th>숙소명</th>
              <td>
                <input type="text" name="ldg_name" id="ldg_name" class="ldg_name" placeholder="숙소명을 입력해주세요">
              </td>
            </tr>
            <tr>
              <th>숙소주소</th>
              <td>
                <input type="text" name="ldg_addr" id="ldg_addr" class="ldg_addr" placeholder="주소를 입력해주세요">
              </td>
            </tr>
            <tr>
              <th>숙소소개</th>
              <td class="ldg_info_td">
                <a href="#" id="ldg_info_btn" class="ldg_info_btn">대표 이미지 및 소개말을 입력해주세요</a>
                <div class="ldg_info_modal_bg">
                  <div class="ldg_info_pop">
                    <p class="ldg_pop_title">숙소 소개</p>
                    <button type="button" id="ldg_pop_cancel" class="pop_cancel_btn indent">닫기</button>
                    <div class="ldg_pop_wrap">
                      <div class="ldg_pop_left">
                        <p class="ldg_pop_left_txt_wrap">
                          <span class="ldg_pop_sub_title1">대표 사진 등록</span>
                          <button type="button" id="main_img_btn" class="main_img_btn">이미지 업로드</button>
                        </p>
                        <div class="ldg_pop_main_img"></div>
                      </div>
                      <div class="ldg_pop_right">
                        <p class="ldg_pop_sub_title2">소개말 입력</p>
                        <textarea class="ldg_pop_info_txt"></textarea>
                      </div>
                    </div>
                    <button type="button" id="info_img_btn" class="info_img_btn btn_hover">저장</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>숙소객실유형</th>
              <td class="room_type_wrap">
                <input type="checkbox" id="dormitory"><label for="dormitory">도미토리</label>
                <input type="checkbox" id="privateroom"><label for="privateroom">개인실</label>
                <input type="checkbox" id="condo"><label for="condo">콘도형</label>
                <input type="checkbox" id="womenonly"><label for="womenonly">여성전용</label>
              </td>
            </tr>
            <tr>
              <th>숙소시설</th>
              <td class="room_facility_wrap">
                <input type="checkbox" id="wifi"><label for="wifi">Wifi</label>
                <input type="checkbox" id="kitchen"><label for="kitchen">게스트부엌</label>
                <input type="checkbox" id="elevator"><label for="elevator">엘리베이터</label>
                <input type="checkbox" id="locker"><label for="locker">개인사물함</label>
                <input type="checkbox" id="parking"><label for="parking">주차가능</label>
                <div class="rf_line"></div>
                <input type="checkbox" id="breakfast"><label for="breakfast">조식</label>
                <input type="checkbox" id="lunch"><label for="lunch">중식</label>
                <input type="checkbox" id="dinner"><label for="dinner">석식</label>
              </td>
            </tr>
            <tr>
              <th>공용시설</th>
              <td class="pubilc_facility_wrap">
                <span>화장실<input type="text">개</span>
                <span>샤워실<input type="text">개</span>
                <span>최대인원<input type="text">명</span>
              </td>
            </tr>
            <tr class="room_list">
              <th>
                <p>등록된 객실</p>
                <button type="button" id="room_btn" class="room_btn btn_hover">객실등록</button>
              </th>
              <td>
                <ul id="room_slide" class="room_slide">
                  <li>
                    <div id="card" class="card room1">
                      <a href="#" class="block">
                        <img src="../images/bestroom_image01.jpg" alt="영국런던런던스테이">
                        <div class="card_cont_wrap">
                          <p class="room_title">2인 여성 도미토리</p>
                          <div class="room_cont_txt">
                            <p>여성도미토리</p>
                            <p>객실정원 1 ~ 2</p>
                            <p>최소예약 1박 이상</p>
                          </div>
                          <div class="room_price_wrap">
                            <span class="room_price_txt">1박 금액</span><span class="room_price">90,800 원</span>
                          </div>
                        </div>
                      </a>
                    </div>
                  </li>
                </ul>
                <a href="#" id="room_btn1" class="card_prev">이전</a>
                <a href="#" id="room_btn2" class="card_next">다음</a>
                <button type="button" id="ldg_submit_btn" class="ldg_submit_btn btn_hover">숙소등록(저장)</button>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <!-- 객실등록팝업 -->
      <div class="room_modal_bg">
        <div class="room_pop">
          <form>
            <p class="room_pop_title">객실 등록</p>
            <button type="button" id="room_pop_cancel" class="pop_cancel_btn indent">닫기</button>
            <table class="room_pop_table">
              <tr class="room_pop_img_list">
                <th>객실사진</th>
                <td>
                  <button type="button" class="room_pop_img_btn btn_hover">이미지 업로드</button><span>최대 5개 까지 등록
                    가능합니다.</span>
                  <div class="room_pop_img_wrap">
                    <div class="room_pop_img"></div>
                    <div class="room_pop_img"></div>
                    <div class="room_pop_img"></div>
                    <div class="room_pop_img"></div>
                    <div class="room_pop_img"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>객실유형</th>
                <td class="room_pop_facility_wrap">
                  <input type="radio" name="room_gender" id="room_unisex"><label for="room_unisex">남여공용</label>
                  <input type="radio" name="room_gender" id="room_womanonly"><label for="room_womanonly">여성용</label>
                  <input type="radio" name="room_gender" id="manonly"><label for="manonly">남성용</label>
                  <div class="rf_line"></div>
                  <input type="checkbox" id="room_dormitory"><label for="room_dormitory">도미토리</label>
                  <input type="checkbox" id="room_privateroom"><label for="room_privateroom">개인실</label>
                  <input type="checkbox" id="room_condo"><label for="room_condo">콘도형</label>
                </td>
              </tr>
              <tr>
                <th>객실인원</th>
                <td class="room_pop_maxnop">
                  <span>최소<input type="text">명</span> ~ <span>최대<input type="text">명</span>
                </td>
              </tr>
              <tr>
                <th>금액</th>
                <td class="room_pop_price">
                  <span class="room_pop_price_txt">1인 1박 기준</span><input type="text"><span>원</span>
                </td>
              </tr>
            </table>
            <button type="button" id="room_submit_btn" class="room_submit_btn btn_hover">객실 등록</button>
          </form>
        </div>
      </div>
    </main>

    <!-- footer -->
    <footer>
      <div id="partner-footer-include"></div>
    </footer>
  </div>
</body>

</html>