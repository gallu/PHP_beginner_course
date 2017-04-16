<?php
// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('../common_function.php');

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
  <title>DB講座上級: 管理画面</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

<div class="container">
  <h1>管理画面</h1>

  <div class="row">
<?php if ( (isset($view_data['error_invalid_login']))&&(true === $view_data['error_invalid_login']) ) : ?>
    <span class="text-danger">メールアドレスまたはパスワードに誤りがあります<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_id']))&&(true === $view_data['error_must_id']) ) : ?>
    <span class="text-danger">IDが未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_pass']))&&(true === $view_data['error_must_pass']) ) : ?>
    <span class="text-danger">パスワードが未入力です<br></span>
<?php endif; ?>

  <form action="./login.php" method="post" class="form-signin col-md-4">
    <input name="id" class="form-control" placeholder="ID"  value="<?php echo h(@$view_data['id']); ?>"required autofocus>
    <input name="pass" type="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
  </form>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
