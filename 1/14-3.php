<?php

// DBに接続
$user = 'root';
$pass = '';
$dsn = 'mysql:dbname=test;host=localhost;charset=utf8mb4';
//
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "connect error!! (" , $e->getMessage() , ")";
    return ;
}
// 静的プレースホルダを指定
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//
//var_dump($dbh);


// 「準備されたSQL文」を用意
$sql = 'INSERT INTO test_users(user_id, name, age, insert_date) VALUES( :user_id ,  :name , :age, :insert_date );';
$pre = $dbh->prepare($sql);

// 値を紐づける
$pre->bindValue(':user_id', 1);
$pre->bindValue(':name', '山田太郎');
$pre->bindValue(':age', 20);
$pre->bindValue(':insert_date', date('Y-m-d H:i:s'));

// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラーが発生したので表示(本番では出さないこと!!)
    var_dump($pre->errorInfo());
}

// 終了したので簡単にメッセージ
echo 'SQL insert fin.';

