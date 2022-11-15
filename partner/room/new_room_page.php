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
  <link rel="stylesheet" type="text/css" href="../css/new_room.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick.css" />
  <link rel="stylesheet" type="text/css" href="../../css/slick-theme.css" />
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/include.js"></script>
  <script type="text/javascript" src="../../js/slick.js"></script>
  <script type="text/javascript" src="../js/new_room.js"></script>

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

      <div class="room_edit_cont">
        <form name="ldg_form" id="ldg_form" action="room_insert.php" method="post" enctype="multipart/form-data">
          <table class="room_edit_table">
            <tr>
              <th>숙소명</th>
              <td>
                <input type="text" name="ldg_name" id="ldg_name" class="ldg_name" placeholder="숙소명을 입력해주세요"
                  maxlength="50">
              </td>
            </tr>
            <tr>
              <th>숙소주소</th>
              <td>
                <!-- <input type="hidden" name="ldg_ps_code" id="ldg_ps_code" class="ldg_addr" placeholder="주소를 입력해주세요">
                <input type="hidden" name="ldg_addr_a" id="ldg_addr_a" class="ldg_addr" placeholder="주소를 입력해주세요">
                <input type="hidden" name="ldg_addr_b" id="ldg_addr_b" class="ldg_addr" placeholder="주소를 입력해주세요">
                <span id="ldg_addr" class="ldg_addr">주소를 입력해주세요</span>
                <button type="button">검색</button> -->
                <input type="text" name="ldg_addr" id="ldg_addr" class="ldg_addr" placeholder="주소를 입력해주세요">
              </td>
            </tr>
            <tr>
              <th>숙소소개</th>
              <td class="ldg_info_td">
                <a href="#" id="ldg_info_btn" class="ldg_info_btn">숙소 이미지 및 소개말을 입력해주세요</a>
                <div class="ldg_info_modal_bg">
                  <div class="ldg_info_pop">
                    <p class="ldg_pop_title">숙소 소개</p>
                    <button type="button" id="ldg_pop_cancel" class="pop_cancel_btn indent">닫기</button>
                    <div class="ldg_pop_wrap">
                      <div class="ldg_pop_left">
                        <p class="ldg_pop_left_txt_wrap">
                          <span class="ldg_pop_sub_title1">대표 사진 등록</span>
                          <input type="file" name="ldg_mainimg" id="ldg_mainimg_input"
                            class="ldg_img_input">
                          <button type="button" id="main_img_btn" class="img_btn">이미지 업로드</button>
                        </p>
                        <img src="" id="ldg_pop_main_img" class="ldg_pop_main_img">

                        <div class="ldg_pop_left_txt_wrap">
                          <span class="ldg_pop_sub_title2">숙소 사진 등록</span>
                          <input type="file" accept="image/*" name="ldg_subimg[]" id="ldg_subimg_input"
                            class="ldg_img_input" multiple />
                          <button type="button" id="sub_img_btn" class="img_btn">이미지 업로드</button>
                        </div>
                        <div class="ldg_pop_img_wrap">
                          <div class="ldg_pop_img"></div>
                          <div class="ldg_pop_img"></div>
                          <div class="ldg_pop_img"></div>
                          <div class="ldg_pop_img"></div>
                        </div>
                      </div>
                      <div class="ldg_pop_right">
                        <p class="ldg_pop_sub_title3">소개말 입력</p>
                        <textarea name="ldg_info" id="ldg_pop_info_txt" class="ldg_pop_info_txt"></textarea>
                      </div>
                    </div>
                    <button type="button" id="info_save_btn" class="info_save_btn btn_hover">저장</button>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>숙소객실유형</th>
              <td class="room_type_wrap">
                <input type="checkbox" name="dormitory" id="dormitory"><label for="dormitory">도미토리</label>
                <input type="checkbox" name="privateroom" id="privateroom"><label for="privateroom">개인실</label>
                <input type="checkbox" name="condo" id="condo"><label for="condo">콘도형</label>
                <input type="checkbox" name="womenonly" id="womenonly"><label for="womenonly">여성전용</label>
              </td>
            </tr>
            <tr>
              <th>숙소시설</th>
              <td class="room_facility_wrap">
                <input type="checkbox" name="wifi" id="wifi"><label for="wifi">Wifi</label>
                <input type="checkbox" name="kitchen" id="kitchen"><label for="kitchen">게스트부엌</label>
                <input type="checkbox" name="elevator" id="elevator"><label for="elevator">엘리베이터</label>
                <input type="checkbox" name="locker" id="locker"><label for="locker">개인사물함</label>
                <input type="checkbox" name="parking" id="parking"><label for="parking">주차가능</label>
                <div class="rf_line"></div>
                <input type="checkbox" name="breakfast" id="breakfast"><label for="breakfast">조식</label>
                <input type="checkbox" name="lunch" id="lunch"><label for="lunch">중식</label>
                <input type="checkbox" name="dinner" id="dinner"><label for="dinner">석식</label>
              </td>
            </tr>
            <tr>
              <th>공용시설</th>
              <td class="pubilc_facility_wrap">
                <span>화장실<input name="toilet" id="toilet" type="text">개</span>
                <span>샤워실<input name="shower" id="shower" type="text">개</span>
                <span>최대인원<input name="ldg_maxnop" id="ldg_maxnop" type="text">명</span>
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
                      <button type="button" id="card_delete_btn" class="card_delete_btn indent">삭제</button>
                      <img src="../images/bestroom_image01.jpg" alt="영국런던런던스테이">
                      <div class="card_cont_wrap">
                        <a href="#" class="block">
                          <p class="room_title">2인 여성 도미토리</p>
                          <div class="room_cont_txt">
                            <p>여성도미토리</p>
                            <p>객실정원 1 ~ 2</p>
                            <p>최소예약 1박 이상</p>
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
              <tr>
                <th>객실 이름</th>
                <td>
                  <input type="text" name="r_name" id="room_pop_name" class="room_pop_name" placeholder="객실 이름을 입력해주세요.">
                </td>
              </tr>
              <tr class="room_pop_img_list">
                <th>
                  <p>객실 사진</p>
                  <button type="button" class="room_pop_img_btn btn_hover">이미지 업로드</button>
                </th>
                <td>
                  <div class="room_pop_info_wrap">
                      <input type="file" accept="image/*" name="r_img" id="room_img_input" class="ldg_img_input">
                      <div class="room_pop_img"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>객실 유형</th>
                <td class="room_pop_facility_wrap">
                  <input type="radio" name="r_gender" id="room_unisex"><label for="room_unisex">남여공용</label>
                  <input type="radio" name="r_gender" id="room_womanonly"><label for="room_womanonly">여성용</label>
                  <input type="radio" name="r_gender" id="manonly"><label for="manonly">남성용</label>
                  <div class="rf_line"></div>
                  <input type="checkbox" name="r_dormitory" id="room_dormitory"><label for="room_dormitory">도미토리</label>
                  <input type="checkbox" name="r_privateroom" id="room_privateroom"><label for="room_privateroom">개인실</label>
                  <input type="checkbox" name="r_condo" id="room_condo"><label for="room_condo">콘도형</label>
                </td>
              </tr>
              <tr>
                <th>객실인원</th>
                <td class="room_pop_maxnop">
                  <span>최소<input type="text" name="r_min" >명</span> ~ <span>최대<input type="text" name="r_max">명</span>
                </td>
              </tr>
              <tr>
                <th>금액</th>
                <td class="room_pop_price">
                  <span class="room_pop_price_txt">1인 1박 기준</span><input type="text" name="r_price"><span>원</span>
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