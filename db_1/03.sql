-- テーブル作成
CREATE TABLE practice_4 (
    num    int
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- 初期データ作成
INSERT INTO practice_4(num) VALUES(1);
INSERT INTO practice_4(num) VALUES(2);
INSERT INTO practice_4(num) VALUES(3);
INSERT INTO practice_4(num) VALUES(4);
INSERT INTO practice_4(num) VALUES(5);
INSERT INTO practice_4(num) VALUES(10);
INSERT INTO practice_4(num) VALUES(9);
INSERT INTO practice_4(num) VALUES(8);
INSERT INTO practice_4(num) VALUES(7);
INSERT INTO practice_4(num) VALUES(6);

-- レコード数を数える
SELECT count(num) FROM practice_4;

-- 条件に合致したレコードを取り出す
SELECT * FROM practice_4 WHERE num = 1;
SELECT * FROM practice_4 WHERE num < 3;
SELECT * FROM practice_4 WHERE num > 3 AND num < 8;
SELECT * FROM practice_4 WHERE num >= 3 AND num <= 8;

-- 範囲検索
SELECT * FROM practice_4 WHERE num BETWEEN 3 AND 8;

-- 順番を並べ替える
SELECT * FROM practice_4; -- 並べ替えなし
SELECT * FROM practice_4 ORDER BY num; -- 昇順
SELECT * FROM practice_4 ORDER BY num DESC; -- 降順

-- 取り出すデータの個数を指定する(MySQL/MariaDBの場合)
SELECT * FROM practice_4 ORDER BY num LIMIT 0, 3;
SELECT * FROM practice_4 ORDER BY num DESC LIMIT 0, 3;

