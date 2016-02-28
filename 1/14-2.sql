DROP TABLE IF EXISTS test_users;
CREATE TABLE test_users (
  `user_id` bigint NOT NULL AUTO_INCREMENT COMMENT 'ユーザを識別するID',
  `name` varbinary(128) NOT NULL COMMENT '名前',
  `age` int DEFAULT 0 COMMENT '年齢',
  `insert_date` datetime,
  PRIMARY KEY (`user_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;

