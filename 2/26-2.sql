/*
DROP TABLE IF EXISTS inquiry_data;
CREATE TABLE inquiry_data (
  `inquiry_id` bigint NOT NULL AUTO_INCREMENT COMMENT '問い合わせID',
  `name` varbinary(128) NOT NULL COMMENT '名前',
  `email` varbinary(512) NOT NULL COMMENT '連絡先email',
  `inquiry` blob COMMENT '問い合わせ内容',
  `insert_date` datetime,
  PRIMARY KEY (`inquiry_id`)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
*/

-- 新規作成(おさらい)
INSERT INTO inquiry_data(name, email, inquiry, insert_date) VALUES('PHPテスト', 'php_test@example.net', '問い合わせ内容ダミー', '2016-1-1 00:00:00');

-- 単純な全件データ取得(おさらい)
SELECT * FROM inquiry_data;

-- データ１件の取得(おさらい
SELECT * FROM inquiry_data WHERE inquiry_id = 10;

-- データをsortしての全件取得(おさらい)
SELECT * FROM inquiry_data ORDER BY inquiry_id DESC;

-- データの範囲を指定しての取得(MySQLの場合)
SELECT * FROM inquiry_data ORDER BY inquiry_id DESC LIMIT 0, 5;

-- 情報の修正
UPDATE inquiry_data SET name='PHPテスト改' WHERE inquiry_id = 10;
-- UPDATE inquiry_data SET name='PHPテスト改'; -- これをやると「全てのデータのnameを一気に変更」になるのできわめて注意！！

-- 情報の削除
DELETE FROM inquiry_data WHERE inquiry_id = 10;
-- DELETE FROM inquiry_data; -- これをやると「全てのデータを一気に削除」になるのできわめて注意！！



