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

// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// 「準備されたSQL文」を用意
$sql = 'SELECT * FROM inquiry_data;';
$pre = $dbh->prepare($sql);

// 値を紐づける
// XXX 今回はなし

// SQL文を発行する
$r = $pre->execute();
if (false === $r) {
    // エラーが発生したので表示
    var_dump($pre->errorInfo());
    return;
}

// 軽くヘッダを表示
echo '<h1>問い合わせ一覧</h1>';

// 表示用のテーブル開始タグ
echo '<table border="1">';

// データを取得する
while($row = $pre->fetch(PDO::FETCH_ASSOC)) {
    // 行の開始
    echo '<tr>';

    // ID表示
    echo '<td>';
    echo htmlspecialchars($row['inquiry_id'], ENT_QUOTES, 'UTF-8');
    echo '(<a href="./detail.php?id=';
    echo urlencode($row['inquiry_id']);
    echo '">詳細を見る</a>)';

    // 名前表示
    echo '<td>';
    echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');

    // 連絡先表示
    echo '<td>';
    echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');

    // 問い合わせ内容表示
    echo '<td>';
    echo '<pre>';
    $s = mb_substr($row['inquiry'], 0, 20, 'UTF-8'); // 先頭から20文字切り出す
    echo htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    echo '</pre>';

    // 作成日時表示
    echo '<td>';
    echo htmlspecialchars($row['insert_date'], ENT_QUOTES, 'UTF-8');
}

// 表示用のテーブル終了タグ
echo '</table>';

