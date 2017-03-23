--
SELECT * FROM test_form WHERE name LIKE '名前%';
SELECT * FROM test_form WHERE name LIKE '%名前%';
SELECT * FROM test_form WHERE name LIKE '%名前'; -- 使用頻度としては低め

--
SELECT * FROM test_form WHERE post LIKE '123%';

