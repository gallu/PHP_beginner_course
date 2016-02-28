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
$sql = 'SELECT * FROM test_users;';
$pre = $dbh->prepare($sql);

// 値を紐づける
// XXX 今回は紐づける値はなし

// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラーが発生したので表示(本番では出さないこと!!)
    var_dump($pre->errorInfo());
}

// 表示用のテーブル開始タグ
echo '<table border="1">';

// データを取得する
while($row = $pre->fetch(PDO::FETCH_ASSOC)) {
    // 行の開始
    echo '<tr>';

    // ユーザID表示
    echo '<td>';
    echo htmlspecialchars($row['user_id'], ENT_QUOTES, 'UTF-8');

    // 名前表示
    echo '<td>';
    echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');

    // 年齢表示
    echo '<td>';
    echo htmlspecialchars($row['age'], ENT_QUOTES, 'UTF-8');

    // 作成日時表示
    echo '<td>';
    echo htmlspecialchars($row['insert_date'], ENT_QUOTES, 'UTF-8');
}

// 表示用のテーブル終了タグ
echo '</table>';

