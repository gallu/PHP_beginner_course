-- 実際に説明に使うテーブルを作成する
CREATE TABLE practice_1 (
    num    int,
    floating_point_num    double,
    string_1    varchar(16),
    string_2    varbinary(16),
    created     datetime
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;


-- データをinsertしてみる
INSERT INTO practice_1(num, floating_point_num, string_1, string_2, created) VALUES(10, 0.3, '文字列1', '文字列2', '2000-01-01 00:11:22');
INSERT INTO practice_1(num, floating_point_num, string_1, string_2) VALUES(100, 3.141592, '文字列3', '文字列4');
INSERT INTO practice_1(num, floating_point_num, string_1, string_2) VALUES(1000, 11.23, '文字列5', '文字列6');


-- データを全件読み込む(業務で行う時は注意！！)
SELECT * FROM practice_1;

-- データを１件だけ読み込む
SELECT * FROM practice_1 WHERE num=10;


-- データを１件、更新する
UPDATE practice_1 SET created='2020-02-03 12:34:56' WHERE num=100;
-- データの確認
SELECT * FROM practice_1;

-- データを更新する(通常業務ではまずやらないSQLなので十分に注意してください！！)
UPDATE practice_1 SET created='2099-01-01 11:22:33';
-- データの確認
SELECT * FROM practice_1;


-- データを１件削除する
DELETE FROM practice_1 WHERE num=100;
-- データの確認
SELECT * FROM practice_1;

-- データを全件削除する(通常業務ではまずやらないSQLなので十分に注意してください！！)
DELETE FROM practice_1;
-- データの確認
SELECT * FROM practice_1;

