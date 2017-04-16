-- ユーザテーブルの作成
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT '識別するためのID',
  --
  `name` varchar(128) NOT NULL COMMENT '名前',
  `email` varbinary(512) NOT NULL UNIQUE COMMENT 'メールアドレス: UNIQUE制約付き',
  `pass` varbinary(255) NOT NULL COMMENT 'パスワード：password_hash()関数利用',
  --
  `created` datetime NOT NULL COMMENT '作成日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP が使いやすい
  `updated` datetime NOT NULL COMMENT '修正日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP が使いやすい
  PRIMARY KEY (`user_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB, COMMENT='1レコードが1ユーザを意味するテーブル';
