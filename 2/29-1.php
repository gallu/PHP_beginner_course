<?php

//var_dump($_FILES);
//$uploadfile = $_FILES['userfile']['name']; // やっちゃいけないパターン
//$uploadfile = date('Ymd') . '/' . $_FILES['userfile']['name']; // やっちゃいけないパターン

//$uploadfile = hash('sha512', file_get_contents('/dev/urandom', false, NULL, 0, 128), false);
//$uploadfile = hash('sha1', file_get_contents('/dev/urandom', false, NULL, 0, 128), false);
$uploadfile = (string)microtime(true) . '.xxx'; // ファイル名を決めておく
var_dump($uploadfile);

//
if (false === is_uploaded_file($_FILES['userfile']['tmp_name'])) {
  // HTTP POST でアップロードされたファイルではないらしい
  exit;
}
//
if (false === move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  // なんか移動失敗したらしい
  // エラー出力 または エラー処理
  return ;
}
// ここまできたら、ファイルがちゃんと受信されてると思われる
// ファイルは $uploadfile で示されたところに移動している


