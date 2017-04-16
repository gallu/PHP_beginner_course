-- 管理ユーザテーブルの作成
DROP TABLE IF EXISTS admin_users;
CREATE TABLE admin_users (
  `user_id` varbinary(255) NOT NULL COMMENT '識別するためのID',
  --
  `name` varchar(128) NOT NULL COMMENT '表示用の名前',
  `pass` varbinary(255) NOT NULL COMMENT 'パスワード：password_hash()関数利用',
  `role` tinyint unsigned default 0 COMMENT 'ユーザ権限：0:閲覧のみ / 1:通常操作のみ / 2:管理者を管理できる',
  --
  `created` datetime NOT NULL COMMENT '作成日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP が使いやすい
  `updated` datetime NOT NULL COMMENT '修正日時', -- バージョン的に可能なら DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP が使いやすい
  PRIMARY KEY (`user_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB, COMMENT='1レコードが1管理者を意味するテーブル';

-- 管理ユーザロックテーブルの作成
DROP TABLE IF EXISTS admin_user_login_lock;
CREATE TABLE admin_user_login_lock (
  `user_id` varbinary(255) NOT NULL COMMENT '識別するためのID',
  `error_count` tinyint unsigned NOT NULL COMMENT 'ログインエラーの回数(ログイン成功したら一度リセット)',
  `lock_time` datetime NOT NULL COMMENT 'ロック時間。0000-00-00 00:00:00 なら「ロックされてない」',
  PRIMARY KEY (`user_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB, COMMENT='1レコードが「1ユーザのロック状態」を意味するテーブル';


-- １件「全権限管理者」を作成しておく
INSERT INTO admin_users(user_id, name, pass, role, created, updated) VALUES('dummy_root', 'ダミー管理者', 'XXXX', 2, now(), now());

