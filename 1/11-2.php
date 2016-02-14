<?php

// 出力時に必須の関数
// (HTML用 エスケープ関数)
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// 「未入力」であるかをチェック：そもそもkeyが存在していない
if (false === isset($_POST['name'])) {
  echo "名前が入力されていません<br>\n";
  return ;
}

// HTMLから値を受け取る
$name = $_POST['name'];

// 値が空である
if ('' === $name) {
  echo "名前が入力されていません<br>\n";
  return ;
}

// 空でなければ出力する
echo "入力された名前は" , $name , "です。<br>\n";

