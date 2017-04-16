<?php

/*
 * 管理者登録画面
 */

// 認証処理のinclude
require_once('./auth_full_control.php');

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
$csrf_token = create_csrf_token_admin();
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座上級 管理画面</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">

  <a href="./top.php">topに戻る</a><br>

  <h1>管理者登録</h1>
<?php if ( (isset($view_data['error_csrf']))&&(true === $view_data['error_csrf']) ) : ?>
    <span class="text-danger">CSRFトークンでエラーが起きました。正しい遷移を、５分以内に操作してください。<br></span>
<?php endif; ?>

<?php if ( (isset($view_data['error_overlap_user_id']))&&(true === $view_data['error_overlap_user_id']) ) : ?>
    <span class="text-danger">user_idが重複しています。別のuser_idを指定してください<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_user_id']))&&(true === $view_data['error_must_user_id']) ) : ?>
    <span class="text-danger">user_idが未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_name']))&&(true === $view_data['error_must_name']) ) : ?>
    <span class="text-danger">名前が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_role']))&&(true === $view_data['error_must_role']) ) : ?>
    <span class="text-danger">役割が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_pass_1']))&&(true === $view_data['error_must_pass_1']) ) : ?>
    <span class="text-danger">パスワードが未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_pass_2']))&&(true === $view_data['error_must_pass_2']) ) : ?>
    <span class="text-danger">パスワード(再)が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_invalid_pass']))&&(true === $view_data['error_invalid_pass']) ) : ?>
    <span class="text-danger">パスワードとパスワード(再)が不一致です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_toolong_pass_1']))&&(true === $view_data['error_toolong_pass_1']) ) : ?>
    <span class="error">パスワードは72文字以内でお願いします<br></span>
<?php endif; ?>


  <form action="./register_fin.php" method="post">
  <input type="hidden" name="csrf_token" value="<?php echo h($csrf_token); ?>">

  <table class="table table-hover">
  <tr>
    <th>ログイン用ID
    <td><input name="user_id" value="<?php echo h(@$view_data['user_id']); ?>">
  <tr>
    <th>名前
    <td><input name="name" value="<?php echo h(@$view_data['name']); ?>">
  <tr>
    <th>役割
    <td>
      <label><input name="role" type="radio" value="0" <?php if (0 == @$view_data['role']): ?>checked<?php endif; ?> >閲覧のみ</label>
      <label><input name="role" type="radio" value="1" <?php if (1 == @$view_data['role']): ?>checked<?php endif; ?> >通常操作まで</label>
      <label><input name="role" type="radio" value="2" <?php if (2 == @$view_data['role']): ?>checked<?php endif; ?> >管理者を管理できる</label>
  <tr>
    <th>パスワード
    <td><input name="pass_1" type="password" value="">
  <tr>
    <th>パスワード(再)
    <td><input name="pass_2" type="password" value="">
  </table>
  <button>新しい管理者を登録する</button>
  </form>

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
