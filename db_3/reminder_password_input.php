<?php

/*
 * パスワード再設定Page
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

// トークンを取り出す
// XXX エラーチェックはfinのほうでやるので、ここではどんな値でも一端素通し
$token = (string)@$_GET['t'];

// セッション内に「エラー情報のフラグ」が入っていたら取り出す
$view_data = array();
if (true === isset($_SESSION['output_buffer'])) {
    $view_data = $_SESSION['output_buffer'];
}
// 確認
//var_dump($view_data);

// (二重に出力しないように)セッション内の「出力用情報」を削除する
unset($_SESSION['output_buffer']);

// CSRFトークンの取得
$csrf_token = create_csrf_token();

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級</title>
  <style type="text/css">
    .error { color: red; }
  </style>
</head>

<body>
<?php if ( (isset($view_data['error_csrf']))&&(true === $view_data['error_csrf']) ) : ?>
    <span class="error">CSRFトークンでエラーが起きました。正しい遷移を、５分以内に操作してください。<br></span>
<?php endif; ?>

パスワードを変更します。

  <form action="./reminder_password_input_fin.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo h($csrf_token); ?>">
    <input type="hidden" name="t" value="<?php echo h($token); ?>">

<?php if ( (isset($view_data['error_must_pass_1']))&&(true === $view_data['error_must_pass_1']) ) : ?>
    <span class="error">パスワードが未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_toolong_pass_1']))&&(true === $view_data['error_toolong_pass_1']) ) : ?>
    <span class="error">パスワードは72文字以内でお願いします<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_invalid_pass']))&&(true === $view_data['error_invalid_pass']) ) : ?>
    <span class="error">パスワードとパスワード(再)が異なります<br></span>
<?php endif; ?>
    パスワード：<input type="password" name="pass_1" value=""><br>
<?php if ( (isset($view_data['error_must_pass_2']))&&(true === $view_data['error_must_pass_2']) ) : ?>
    <span class="error">パスワードが未入力です<br></span>
<?php endif; ?>
    パスワード(再度)：<input type="password" name="pass_2" value=""><br>
    <br>
    <button type="submit">データ登録</button>
  </form>
</body>
</html>
