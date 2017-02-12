<?php

// パラメタから「読み込むデータのプライマリキー」を取得：悪意のあるdelete
// $id = $_GET['id'];
$id = "1;DELETE FROM practice_5;--";

// SQLの組み立て
$sql = "SELECT * FROM practice_5 WHERE practice_id={$id};";

// 「組み立てたSQL」の表示
echo $sql;
