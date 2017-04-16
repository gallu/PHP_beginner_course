<?php
// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

// セッションに入っている情報を確認する
//var_dump($_SESSION);

// セッション内に「エラー情報のフラグ」が入っていたら取り出す
$view_data = array();
if (true === isset($_SESSION['output_buffer'])) {
    $view_data = $_SESSION['output_buffer'];
}
// 確認
//var_dump($view_data);

// (二重に出力しないように)セッション内の「出力用情報」を削除する
unset($_SESSION['output_buffer']);

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
  <form action="./login.php" method="post">

<?php if ( (isset($view_data['error_invalid_login']))&&(true === $view_data['error_invalid_login']) ) : ?>
    <span class="error">メールアドレスまたはパスワードに誤りがあります<br></span>
<?php endif; ?>

<?php if ( (isset($view_data['error_must_email']))&&(true === $view_data['error_must_email']) ) : ?>
    <span class="error">メールアドレスが未入力です<br></span>
<?php endif; ?>
    メールアドレス：<input type="text" name="email" value="<?php echo h(@$view_data['email']); ?>"><br>

<?php if ( (isset($view_data['error_must_pass']))&&(true === $view_data['error_must_pass']) ) : ?>
    <span class="error">パスワードが未入力です<br></span>
<?php endif; ?>
    パスワード：<input type="password" name="pass" value=""><br>

    <br>
    <button type="submit">ログイン</button>
  </form>
</body>
</html>
