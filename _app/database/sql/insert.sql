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
-- テーブルの構造 `funeral_client`(葬儀顧客)
CREATE TABLE `funeral_client` (
  `fc_id` int(4) NOT NULL AUTO_INCREMENT COMMENT '顧客ID',
  `funeral_id` int(4) NOT NULL COMMENT '葬儀ID',
  `fc_status` varchar(20) NOT NULL COMMENT '進捗状況',
  `fc_lname` varchar(20) NOT NULL COMMENT '苗字',
  `fc_fname` varchar(20) NOT NULL COMMENT '名前',
  `fc_lname_kana` varchar(20) NOT NULL COMMENT '苗字(カナ)',
  `fc_fname_kana` varchar(20) NOT NULL COMMENT '名前(カナ)',
  `fc_gender` varchar(10) NOT NULL COMMENT '性別',
  `fc_tel` varchar(20) NOT NULL COMMENT '電話番号',
  `fc_region` varchar(20) NOT NULL COMMENT '住民票',
  `fc_relation` varchar(20) NOT NULL COMMENT '故人との関係',
  `fc_comment` text NOT NULL COMMENT 'コメント',
  `insert_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `insert_by` varchar(4) NOT NULL,
  `update_by` varchar(4) NOT NULL,
  `deleteFlg` tinyint(4) NOT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- テーブルの構造 `report`(レポート)
CREATE TABLE `report` (
  `report_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'レポートID',
  `report_category` int(4) NOT NULL COMMENT 'カテゴリ',
  `disp_flg` tinyint(4) NOT NULL COMMENT '公開／非公開',
  `title` varchar(40) NOT NULL COMMENT 'タイトル',
  `comment` text NOT NULL COMMENT 'コメント',
  `insert_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `insert_by` varchar(4) NOT NULL,
  `update_by` varchar(4) NOT NULL,
  `deleteFlg` tinyint(4) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- テーブルの構造 `report_cs`(問い合わせ)
CREATE TABLE `report_cs` (
  `report_id` int(4) NOT NULL COMMENT 'レポートID',
  `client_id` int(4) NOT NULL COMMENT '顧客ID',
  `cs_category` varchar(20) NOT NULL COMMENT 'カテゴリ',
  `cs_status` varchar(20) NOT NULL COMMENT '進捗状況',
  `cs_by` varchar(4) NOT NULL COMMENT '対応者'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- テーブルの構造 `report_approval`(承認)
CREATE TABLE `report_approval` (
  `report_id` int(4) NOT NULL COMMENT 'レポートID',
  `funeral_id` varchar(4) NOT NULL COMMENT '葬儀ID',
  `approval_date` date NOT NULL COMMENT '承認日',
  `approval_by` varchar(4) NOT NULL COMMENT '承認者',
  `approval_status` varchar(20) NOT NULL COMMENT '承認状況'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- テーブルの構造 `report_tel`(架電)
CREATE TABLE `report_tel` (
  `report_id` int(4) NOT NULL COMMENT 'レポートID',
  `tel_date` datetime NOT NULL COMMENT '架電日時',
  `tel_status` varchar(20) NOT NULL COMMENT '架電状況',
  `tel_by` varchar(4) NOT NULL COMMENT '架電者'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;