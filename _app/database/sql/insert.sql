SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- テーブルの構造 `funeral`(葬儀)

CREATE TABLE `funeral` (
  `funeral_id` int(4) NOT NULL AUTO_INCREMENT COMMENT '葬儀ID',
  `funeral_status` varchar(20) NOT NULL COMMENT '進捗状況',
  `decd_lname` varchar(20) NOT NULL COMMENT '苗字',
  `decd_fname` varchar(20) NOT NULL COMMENT '名前',
  `decd_lname_kana` varchar(20) NOT NULL COMMENT '苗字(カナ)',
  `decd_fname_kana` varchar(20) NOT NULL COMMENT '名前(カナ)',
  `decd_gender` varchar(10) NOT NULL COMMENT '性別',
  `decd_region` varchar(20) NOT NULL COMMENT '住民票',
  `plan` varchar(20) NOT NULL COMMENT '葬儀プラン',
  `ensconce` varchar(20) NOT NULL COMMENT '安置方法',
  `ensconce_address` varchar(60) NOT NULL COMMENT '安置住所',
  `dest_name` varchar(20) NOT NULL COMMENT 'お迎え先名',
  `dest_address` varchar(60) NOT NULL COMMENT 'お迎え先住所',
  `funeral_date` datetime NOT NULL COMMENT '葬儀希望日',
  `hall` text NOT NULL COMMENT '希望葬儀式場',
  `crematory` text NOT NULL COMMENT '希望火葬場',
  `option` text NOT NULL COMMENT 'オプション',
  `totalpeople` varchar(4) NOT NULL COMMENT '人数',
  `funeral_comment` text NOT NULL COMMENT 'コメント',
  `insert_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `insert_by` varchar(4) NOT NULL,
  `update_by` varchar(4) NOT NULL,
  `deleteFlg` tinyint(4) NOT NULL,
  PRIMARY KEY (`funeral_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `funeral` (
    PRIMARY KEY (`funeral_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
