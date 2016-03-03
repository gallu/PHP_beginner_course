DROP TABLE IF EXISTS inquiry_data;
CREATE TABLE inquiry_data (
  `inquiry_id` bigint NOT NULL AUTO_INCREMENT COMMENT '問い合わせID',
  `name` varbinary(128) NOT NULL COMMENT '名前',
  `email` varbinary(512) NOT NULL COMMENT '連絡先email',
  `inquiry` blob COMMENT '問い合わせ内容',
  `insert_date` datetime,
  PRIMARY KEY (`inquiry_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;

