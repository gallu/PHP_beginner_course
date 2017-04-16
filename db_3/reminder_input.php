<?php

/*
 * パスワード再設定用Pageのためのメールアドレス入力画面
 */


// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');

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

入力されたemailに、パスワード再設定のURLを送ります。

  <form action="./reminder_input_fin.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo h($csrf_token); ?>">

<?php if ( (isset($view_data['error_must_email']))&&(true === $view_data['error_must_email']) ) : ?>
    <span class="error">メールアドレスが未入力です<br></span>
<?php endif; ?>
    メールアドレス：<input type="text" name="email" value="<?php echo h(@$view_data['email']); ?>"><br>
    <br>
    <button type="submit">データ登録</button>
  </form>
</body>
</html>
