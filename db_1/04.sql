-- テーブル準備
CREATE TABLE practice_5 (
    practice_id    int NOT NULL AUTO_INCREMENT,
    data varchar(16),
    PRIMARY KEY(practice_id)
)CHARACTER SET 'utf8mb4', ENGINE=InnoDB;
-- データ準備
INSERT INTO practice_5(data) VALUES('hoge');
INSERT INTO practice_5(data) VALUES('foo');

-- つなげたSQL文
SELECT * FROM practice_5; INSERT INTO practice_5(data) VALUES('bar');

-- 結果確認
SELECT * FROM practice_5;

