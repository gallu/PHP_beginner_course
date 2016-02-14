<?php

// 出力時に必須の関数
// (HTML用 エスケープ関数)
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// HTMLから受け取った要素を出力する
echo "入力された名前は" , h($_POST['name']) , "です。<br>\n";
echo "入力された年齢は" , h($_POST['age']) , "です。<br>\n";


