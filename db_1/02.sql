/*
INSERT
 */

-- AUTO_INCREMENT(なし)
CREATE TABLE practice_2_1 (
    practice_id    int,
    data varchar(16)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- INSERT
INSERT INTO practice_2_1(data) VALUES('hoge');
INSERT INTO practice_2_1(data) VALUES('foo');
INSERT INTO practice_2_1(data) VALUES('bar');
-- 確認
SELECT * FROM practice_2_1;


-- AUTO_INCREMENT(あり：MySQL/MariaDBの場合)
CREATE TABLE practice_2_2 (
    practice_id    int NOT NULL AUTO_INCREMENT,
    data varchar(16),
    PRIMARY KEY(practice_id)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- INSERT
INSERT INTO practice_2_2(data) VALUES('hoge');
INSERT INTO practice_2_2(data) VALUES('foo');
INSERT INTO practice_2_2(data) VALUES('bar');
-- 確認
SELECT * FROM practice_2_2;


-- INSERT SET
INSERT practice_2_2 SET data='foobar';
-- 確認
SELECT * FROM practice_2_2;


/*
INSERTとUPDATE
 */
-- テーブル作成 (CURRENT_TIMESTAMPなし)
CREATE TABLE practice_3_1 (
    practice_id    int NOT NULL AUTO_INCREMENT,
    data    varchar(16),
    created  datetime ,
    updated  datetime ,
    PRIMARY KEY(practice_id)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- INSERT
INSERT INTO practice_3_1(data) VALUES('hoge');
INSERT INTO practice_3_1(data) VALUES('foo');
-- 確認
SELECT * FROM practice_3_1;


-- テーブル作成 (CURRENT_TIMESTAMPあり：MySQL/MariaDBの場合：バージョンに注意)
CREATE TABLE practice_3_2 (
    practice_id    int NOT NULL AUTO_INCREMENT,
    data    varchar(16),
    created  datetime DEFAULT CURRENT_TIMESTAMP,
    updated  datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(practice_id)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- INSERT
INSERT INTO practice_3_2(data) VALUES('hoge');
INSERT INTO practice_3_2(data) VALUES('foo');
-- 確認
SELECT * FROM practice_3_2;
-- UPDFATE
UPDATE practice_3_2 SET data='foobar' WHERE practice_id=2;
-- 確認
SELECT * FROM practice_3_2;



