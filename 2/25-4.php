<?php

// sessionを使うので、出力バッファリングをしておく
ob_start();
session_start();

// 入力されたIDとパスワードを把握
$id = (string)@$_POST['id'];
$pw = (string)@$_POST['pw'];

// DB等に保存してあるIDとパスワードの情報を取得
// XXX 今回は固定の文字列で。本来であれば、例えば以下のようなSQLで取得
// SELECT * FROM ユーザテーブル WHERE id = :id;
$db_id = 'id';
$db_pw = '$2y$10$AcZWWwGAdBZN0hmpSUhayOljzc.0bIKBbO/6oORu2b.gKifoh40Ra'; // password_hash関数でhash化したパスワード(pass)

/*
 password_hash関数は、PHP5.5.0以降での実装。5.4系以下の場合は https://github.com/ircmaxell/password_compat で、ユーザーランドでの実装が入手可能
 */

// IDとパスワードを比較
// XXX 「hash化されたパスワード」の比較には、password_verify関数を用いる
if ( ($id !== $db_id)or(false === password_verify($pw, $db_pw)) ) {
    echo 'IDまたはパスワードが違います！！';
    return ;
}

// id(email)とパスワードが一致した場合、ログイン処理
$_SESSION['user_id'] = $id;
session_regenerate_id(true); // セッションフィクセイションなどの防御用

//
ob_end_flush();
?>
ログイン処理をしました！
