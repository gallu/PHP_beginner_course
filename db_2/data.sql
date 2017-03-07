-- 「テーブルがもし存在していたらテーブルを破棄する」というSQLです。なくてもよいのですが、個人的には書いておくことが多いです
DROP TABLE IF EXISTS test_form;

-- 実際のテーブルを作成します
CREATE TABLE test_form (
  `test_form_id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT '識別するためのID',
  --
  `name` varchar(128) NOT NULL COMMENT '入力値：名前',
  `post` varchar(8) NOT NULL COMMENT '入力値：郵便番号(nnn-nnnnの形式で)',
  `address` varchar(256) NOT NULL COMMENT '入力値：住所',
  `birthday` date NOT NULL COMMENT '入力値：誕生日',
  --
  `created` datetime NOT NULL COMMENT '作成日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP が使いやすい
  `updated` datetime NOT NULL COMMENT '修正日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP が使いやすい
  PRIMARY KEY (`test_form_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB, COMMENT='1レコードが1入力を意味するテーブル';

