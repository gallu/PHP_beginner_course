-- パスワード再発行用のトークン管理テーブル
DROP TABLE IF EXISTS reminder_token;
CREATE TABLE reminder_token (
  `token` varbinary(255) NOT NULL COMMENT '識別するためのID',
  `user_id` bigint unsigned NOT NULL COMMENT 'ユーザID',
  `created` datetime NOT NULL COMMENT '作成日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP が使いやすい
  PRIMARY KEY (`token`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB, COMMENT='1レコードが「1ユーザの１回のパスワード変更用トークン」を意味するテーブル';
