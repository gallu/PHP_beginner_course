<?php

// 管理者の初期登録時のSQL作成用「パスワードhash文字列の簡単作成」用ミニマムコード
$pass = '';
echo password_hash($pass, PASSWORD_DEFAULT);
