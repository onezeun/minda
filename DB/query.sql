SELECT u.u_idx, p.p_idx, u.u_email, u.u_pwd, u.u_name, u.u_img, p.p_name FROM users u LEFT OUTER JOIN partner_user p ON u.u_idx = p.u_idx WHERE u_email='ts@ts.ts';

SELECT * FROM lodging WHERE ldg_name LIKE '%런던%';

SELECT * FROM lodging WHERE ldg_name LIKE '%런던%' OR ldg_city LIKE '%런던%' OR ldg_country LIKE '%런던%';

-- Active: 1668050788298@@127.0.0.1@3306@minda
SELECT l.ldg_idx, l.ldg_name, l.ldg_main_img, l.ldg_country, l.ldg_city, r.r_idx, r.r_name, r.r_price FROM lodging l JOIN room r ON l.ldg_idx = r.ldg_idx WHERE l.ldg_idx=2 AND r.r_idx=2;

CREATE DATABASE minda
    DEFAULT CHARACTER SET = 'utf8mb4';
    
-- 메인 조회
SELECT l.ldg_idx, l.ldg_name, l.ldg_country, l.ldg_city, MIN(r.r_price) r_price, f.l_file_src FROM lodging l JOIN lodging_file f ON l.ldg_idx = f.ldg_idx JOIN room r ON l.ldg_idx = r.ldg_idx GROUP BY ldg_idx;

-- 일반회원 USER
CREATE TABLE users (
  u_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_email VARCHAR(50) NOT NULL,
  u_pwd VARCHAR(20) NOT NULL,
  u_name VARCHAR(30) NOT NULL,
  u_nickname VARCHAR(15) NOT NULL,
  u_phone VARCHAR(20) NOT NULL,
  u_marketing CHAR(1),
  u_img LONGBLOB,
  reg_date DATETIME
);

-- USER 회원가입 INSERT 쿼리
INSERT INTO users(u_email, u_pwd, u_name, u_nickname, u_phone, u_marketing, reg_date) VALUES('$u_email', '$u_pwd', '$u_name', '$u_nickname', '$u_phone', '$u_marketing', '$reg_date');


-- 파트너회원
CREATE TABLE partner_user (
  p_idx INT AUTO_INCREMENT PRIMARY KEY,
  p_name VARCHAR(30) NOT NULL,
  p_biznum VARCHAR(50) NOT NULL,
  p_phone VARCHAR(30) NOT NULL,
  u_idx INT,
  FOREIGN KEY (u_idx) REFERENCES users (u_idx) ON DELETE CASCADE
);

INSERT INTO partner_user(u_idx, p_name, p_biznum, p_phone) VALUES('$u_idx', '$p_name', '$p_biznum', '$p_phone');

-- 일반 회원 중 파트너로 가입되어 있는 사람들
SELECT p.u_idx, p.p_idx, u.u_email, u.u_name, u.u_img, p.p_name FROM partner_user p JOIN users u ON u.u_idx = p.u_idx;
SELECT u.u_idx, p.p_idx, u.u_email, u.u_pwd, u.u_name, u.u_img, p.p_name FROM users u JOIN partner_user p ON u.u_idx = p.u_idx WHERE u_email='테스트3';

-- 예약 RESERVATION
create table reservation (
  res_idx INT AUTO_INCREMENT PRIMARY KEY,
  res_name VARCHAR(30) NOT NULL,
  res_phone VARCHAR(20) NOT NULL,
  res_email VARCHAR(50) NOT NULL,
  res_gender CHAR(1) NOT NULL,
  res_checkin DATE NOT NULL,
  res_checkout DATE NOT NULL,
  res_time DATETIME NOT NULL,
  res_nop INT NOT NULL,
  res_nod INT NOT NULL,
  res_date DATE NOT NULL,
  res_state CHAR(1) NOT NULL,
  total_price INT NOT NULL,
  pay_date DATE NOT NULL,
  pay_method VARCHAR(20) NOT NULL,
  ldg_idx INT,
  r_idx INT,
  u_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx),
  FOREIGN KEY (r_idx) REFERENCES room (r_idx),
  FOREIGN KEY (u_idx) REFERENCES users (u_idx)
);

-- res_state 예약 상태 -> 1 : 결제 대기 (결제), 2 : 예약 완료 (예약취소), 3 : 예약취소(환불진행중, 환불완료), 4 : 숙박완료(리뷰쓰기)
SELECT res.res_idx, l.ldg_idx, r.r_idx, r.r_name, res.res_checkin, res.res_checkout, res.total_price, res.res_state 
FROM reservation res JOIN lodging l ON res.ldg_idx = l.ldg_idx JOIN room r ON res.r_idx = r.r_idx 
WHERE res.u_idx=3 AND res.res_checkin < CURDATE();

-- 결제 PAYMENT
-- create table payment (
--   pay_idx INT AUTO_INCREMENT PRIMARY KEY,
--   pay_date DATE NOT NULL,
--   pay_method VARCHAR(20) NOT NULL,
--   res_idx INT,
--   FOREIGN KEY (res_idx) REFERENCES reservation (res_idx)
-- );

-- 좋아요 LIKE
create table like_table (
  ldg_idx INT,
  u_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx) ON DELETE CASCADE,
  FOREIGN KEY (u_idx) REFERENCES users (u_idx)
);


SELECT l.ldg_idx, l.ldg_name, l.ldg_main_img, l.ldg_country, l.ldg_city, MIN(r.r_price) r_price FROM lodging l JOIN room r ON l.ldg_idx = r.ldg_idx GROUP BY ldg_idx;
-- 숙소 LODGING
create table lodging (
  ldg_idx INT AUTO_INCREMENT PRIMARY KEY,
  ldg_name VARCHAR(50) NOT NULL,
  ldg_country VARCHAR(50) NOT NULL,
  ldg_city VARCHAR(50) NOT NULL,
  ldg_tel VARCHAR(20),
  ldg_main_img LONGBLOB,
  ldg_sub_img LONGBLOB,
  ldg_info TEXT,
  ldg_maxnop INT NOT NULL,
  ldg_time DATE,
  toilet INT NOT NULL,
  shower INT NOT NULL,
  p_idx INT,
  FOREIGN KEY (p_idx) REFERENCES partner_user (p_idx)
);

-- 숙소 첨부 파일
--  l_file_size VARCHAR(255),
-- create table lodging_file (
--   l_file_idx INT AUTO_INCREMENT PRIMARY KEY,
--   l_file_main CHAR(1),
--   l_file_src LONGBLOB,
--   l_file_name VARCHAR(255),
--   l_file_type VARCHAR(25),
--   ldg_idx INT,
--   FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx) ON DELETE CASCADE
-- );

-- 숙소 시설 LODGING_FACILITY
create table lodging_facility (
  dormitory TINYINT(1),
  privateroom TINYINT(1),
  condo TINYINT(1),
  womenonly TINYINT(1),
  wifi TINYINT(1),
  kitchen TINYINT(1),
  elevator TINYINT(1),
  locker TINYINT(1),
  parking TINYINT(1),
  breakfast TINYINT(1),
  lunch TINYINT(1),
  dinner TINYINT(1),
  ldg_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx) ON DELETE CASCADE
);

-- 숙소 등록
INSERT INTO lodging (ldg_name, ldg_addr, ldg_info, ldg_maxnop, toilet, shower, p_idx) VALUES ( '$ldg_name', '$ldg_addr', '$ldg_info', $ldg_maxnop, $toilet, $shower, $sp_idx);
-- 등록된 숙소 idx 조회
SELECT ldg_idx FROM lodging WHERE p_idx = $sp_idx;
-- 숙소 조회
SELECT * FROM lodging WHERE p_idx=$sp_idx;
-- 숙소 첨부파일
INSERT INTO lodging_file (l_file_main, l_file_src, l_file_name, ldg_idx) VALUES ('Y', '$mainbase64', '$ldg_mainimg_name', '$ldg_idx');
-- 숙소 시설
INSERT INTO lodging_facility (dormitory, privateroom, condo, womenonly, wifi, kitchen, elevator, locker, parking, breakfast, lunch, dinner, ldg_idx) VALUES ($dormitory, $privateroom, $condo, $womenonly, $wifi, $kitchen, $elevator, $locker, $parking, $breakfast, $lunch, $dinner, $ldg_idx);
-- 숙소 상세 조회
SELECT l.ldg_idx, l.ldg_name, l.ldg_country, l.ldg_city, MIN(r.r_price) r_price, i.l_file_src, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l JOIN lodging_file i ON l.ldg_idx = i.ldg_idx JOIN room r ON l.ldg_idx = r.ldg_idx JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE l.ldg_idx=1;
-- 숙소 테이블 합치기
SELECT l.ldg_idx, l.ldg_name, i.l_file_src, f.dormitory, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner FROM lodging l JOIN lodging_file i ON l.ldg_idx = i.ldg_idx JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx;
SELECT 
l.ldg_idx, l.ldg_name, l.ldg_addr, l.ldg_tel, l.ldg_info, l.ldg_maxnop, 
i.l_file_idx, i.l_file_main, i.l_file_src, i.l_file_name, i.l_file_type, i.l_file_size, 
f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner
FROM lodging l INNER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx INNER JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx;

SELECT l.ldg_idx, l.ldg_name, l.ldg_addr, l.ldg_tel, l.ldg_info, l.ldg_maxnop, i.l_file_idx, i.l_file_main, i.l_file_src, i.l_file_name, i.l_file_type, i.l_file_size, f.dormitory, f.privateroom, f.condo, f.womenonly, f.wifi, f.kitchen, f.elevator, f.locker, f.parking, f.breakfast, f.lunch, f.dinner
FROM lodging l INNER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx INNER JOIN lodging_facility f ON l.ldg_idx = f.ldg_idx WHERE ldg_idx = $ldg_idx;
SELECT l.ldg_idx, l.ldg_name, i.l_file_src FROM lodging l INNER JOIN lodging_file i ON l.ldg_idx = i.ldg_idx;

-- 객실 ROOM
create table room (
  r_idx INT AUTO_INCREMENT PRIMARY KEY,
  r_name VARCHAR(50) NOT NULL,
  r_img LONGBLOB,
  r_gender CHAR(1) NOT NULL,
  r_type CHAR(1) NOT NULL,
  r_min INT,
  r_max INT,
  r_price INT NOT NULL,
  ldg_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx) ON DELETE CASCADE
);

SELECT MIN(r_price) r_price FROM room WHERE ldg_idx=26;

-- 리뷰 REVIEW
create table review (
  rv_idx INT AUTO_INCREMENT PRIMARY KEY,
  rv_score VARCHAR(5) NOT NULL,
  rv_content TEXT NOT NULL,
  rv_time DATETIME,
  u_idx INT,
  ldg_idx INT,
  r_idx INT,
  res_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx) ON DELETE CASCADE,
  FOREIGN KEY (r_idx) REFERENCES room (r_idx),
  FOREIGN KEY (u_idx) REFERENCES users (u_idx),
  FOREIGN KEY (res_idx) REFERENCES reservation (res_idx)
);

-- 커뮤니티 COMMUNITY
create table community (
  cmm_idx INT AUTO_INCREMENT PRIMARY KEY,
  cmm_title VARCHAR(20) NOT NULL,
  cmm_date DATE NOT NULL,
  cmm_content TEXT NOT NULL,
  category VARCHAR(5) NOT NULL,
  view_cnt INT DEFAULT 0,
  u_idx INT,
  FOREIGN KEY (u_idx) REFERENCES users (u_idx)
);

-- 커뮤니티 댓글 COMMUNITY_COMMENT
create table community_comment (
  co_idx INT AUTO_INCREMENT PRIMARY KEY,
  co_content TEXT NOT NULL,
  co_date DATE NOT NULL,
  u_idx INT,
  cmm_idx INT,
  FOREIGN KEY (u_idx) REFERENCES users (u_idx),
  FOREIGN KEY (cmm_idx) REFERENCES community (cmm_idx)
);