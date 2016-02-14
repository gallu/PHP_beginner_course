<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php

// 共通処理部分を読み込み
require_once('14-3-common.php');

// エラー判定用の変数(フラグ)を用意する
$error_flg = false;

// 「未入力」であるかをチェック：そもそもkeyが存在していない
if (false === isset($_POST['name'])) {
  echo "名前が入力されていません<br>\n";
  $error_flg = true;
}
if (false === isset($_POST['age'])) {
  echo "年齢が入力されていません<br>\n";
  $error_flg = true;
}
// エラーであれば処理を終了
if (true === $error_flg) {
  return ;
}

// HTMLから値を受け取る
$name = $_POST['name'];
$age = $_POST['age'];

// 入力値のチェック
if ('' === $name) {
  echo "名前が入力されていません<br>\n";
  $error_flg = true;
}
if ('' === $age) {
  echo "年齢が入力されていません<br>\n";
  $error_flg = true;
}
// 年齢の値が数字かどうかをチェック
if (false === ctype_digit($age)) {
  echo "年齢が数値ではありません<br>\n";
  $error_flg = true;
}
// エラーであれば処理を終了
if (true === $error_flg) {
  return ;
}

// ここまできたら、正しい情報が得られていると見なす

// DBに情報を入れる
// ------------------------------

// 「準備された文(prepared statement)」を用意する
$sql = 'INSERT INTO test_users(name, age, insert_date) VALUES( :name, :age, now() );';
$pre = $dbh->prepare($sql);

// プレースホルダーに値をバインドする
$pre->bindValue(':name', $name, PDO::PARAM_STR);
$pre->bindValue(':age', $name, PDO::PARAM_INT);

// SQLを実行する
$r = $pre->execute();

//
echo '情報をinsertしました。<br>';

