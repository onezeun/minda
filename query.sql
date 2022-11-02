-- 회원(고객) USER
create table user (
  u_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_email VARCHAR(50) NOT NULL,
  u_pwd VARCHAR(20) NOT NULL,
  u_name VARCHAR(30) NOT NULL,
  u_nickname VARCHAR(15) NOT NULL,
  u_phone VARCHAR(20) NOT NULL,
  u_marketing TINYINT(1),
  u_img LONGBLOB,
  reg_date DATETIME
);

-- USER 회원가입 INSERT 쿼리
INSERT INTO user(u_email, u_pwd, u_name, u_nickname, u_phone, u_marketing, reg_date) VALUES('$u_name', '$u_pwd', '$u_name', '$u_nickname', '$u_phone', '$u_marketing', '$reg_date');

-- 회원(업주) OWNER
create table owner_table (
  o_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_idx INT,
  o_name VARCHAR(20) NOT NULL,
  o_number VARCHAR(20) NOT NULL,
  o_phone VARCHAR(20) NOT NULL,
  FOREIGN KEY (u_idx) REFERENCES user (u_idx)
);

-- 예약 RESERVATION
create table reservation (
  res_idx INT AUTO_INCREMENT PRIMARY KEY,
  ldg_idx INT,
  u_idx INT,
  res_name VARCHAR(20) NOT NULL,
  res_phone VARCHAR(20) NOT NULL,
  res_email VARCHAR(20) NOT NULL,
  res_gender CHAR(1) NOT NULL,
  res_checkin DATE NOT NULL,
  res_checkout DATE NOT NULL,
  res_time DATETIME NOT NULL,
  res_nop INT NOT NULL,
  res_date DATE NOT NULL,
  res_state VARCHAR(20) NOT NULL,
  total_price INT NOT NULL,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx),
  FOREIGN KEY (u_idx) REFERENCES user (u_idx)
);

-- 결제 PAYMENT
create table payment (
  pay_idx INT AUTO_INCREMENT PRIMARY KEY,
  res_idx INT,
  pay_date DATE NOT NULL,
  pay_method VARCHAR(20) NOT NULL,
  FOREIGN KEY (res_idx) REFERENCES reservation (res_idx)
);

-- 좋아요 LIKE
create table like_table (
  ldg_idx INT,
  u_idx INT,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx),
  FOREIGN KEY (u_idx) REFERENCES user (u_idx)
);

-- 숙소 LODGING
create table lodging (
  ldg_idx INT AUTO_INCREMENT PRIMARY KEY,
  o_idx INT,
  ldg_name VARCHAR(50) NOT NULL,
  ldg_addr VARCHAR(100) NOT NULL,
  ldg_tel VARCHAR(20) NOT NULL,
  ldg_info TEXT,
  ldg_maxnop INT NOT NULL,
  toilet INT NOT NULL,
  shower INT NOT NULL,
  FOREIGN KEY (o_idx) REFERENCES owner_table (o_idx)
);

-- 숙소 시설 LODGING_FACILITY
create table lodging_facility (
  ldg_idx INT,
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
  FOREIGN KEY (res_idx) REFERENCES reservation (res_idx)
);

-- 객실 ROOM
create table room (
  r_idx INT AUTO_INCREMENT PRIMARY KEY,
  ldg_idx INT,
  r_name VARCHAR(50) NOT NULL,
  r_price INT NOT NULL,
  r_type VARCHAR(10) NOT NULL,
  r_nop INT NOT NULL,
  r_minimum INT,
  r_unisex VARCHAR(5) NOT NULL,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx)
);

-- 리뷰 REVIEW
create table review (
  rv_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_idx INT,
  ldg_idx INT,
  rv_score INT NOT NULL,
  rv_content TEXT NOT NULL,
  FOREIGN KEY (ldg_idx) REFERENCES lodging (ldg_idx),
  FOREIGN KEY (u_idx) REFERENCES user (u_idx)
);

-- 커뮤니티 COMMUNITY
create table community (
  cmm_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_idx INT,
  cmm_title VARCHAR(20) NOT NULL,
  cmm_date DATE NOT NULL,
  cmm_content TEXT NOT NULL,
  category VARCHAR(5) NOT NULL,
  view_cnt INT DEFAULT 0,
  FOREIGN KEY (u_idx) REFERENCES user (u_idx)
);

-- 커뮤니티 댓글 COMMUNITY_COMMENT
create table community_comment (
  co_idx INT AUTO_INCREMENT PRIMARY KEY,
  u_idx INT,
  cmm_idx INT,
  co_content TEXT NOT NULL,
  co_date DATE NOT NULL,
  FOREIGN KEY (u_idx) REFERENCES user (u_idx),
  FOREIGN KEY (cmm_idx) REFERENCES community (cmm_idx)
);