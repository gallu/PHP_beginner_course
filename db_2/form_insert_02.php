<?php
// セッションの開始
ob_start();
session_start();

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
  <title>DB講座中級</title>
  <style type="text/css">
    .error { color: red; }
  </style>
</head>

<body>
  <form action="./form_insert_fin.php" method="post">
<?php if ( (isset($view_data['error_must_name']))&&(true === $view_data['error_must_name']) ) : ?>
    <span class="error">名前が未入力です<br></span>
<?php endif; ?>
    名前：<input type="text" name="name" value=""><br>

<?php if ( (isset($view_data['error_must_post']))&&(true === $view_data['error_must_post']) ) : ?>
    <span class="error">郵便番号が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_format_post']))&&(true === $view_data['error_format_post']) ) : ?>
    <span class="error">郵便番号の書式に誤りがあります<br></span>
<?php endif; ?>
    郵便番号(例：999-9999)：<input type="text" name="post" value=""><br>

<?php if ( (isset($view_data['error_must_address']))&&(true === $view_data['error_must_address']) ) : ?>
    <span class="error">住所が未入力です<br></span>
<?php endif; ?>
    住所：<input type="text" name="address" value=""><br>

<?php if ( (isset($view_data['error_must_birthday_yy']))&&(true === $view_data['error_must_birthday_yy']) ) : ?>
    <span class="error">誕生日(年)が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_birthday_mm']))&&(true === $view_data['error_must_birthday_mm']) ) : ?>
    <span class="error">誕生日(月)が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_must_birthday_dd']))&&(true === $view_data['error_must_birthday_dd']) ) : ?>
    <span class="error">誕生日(日)が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($view_data['error_format_birthday']))&&(true === $view_data['error_format_birthday']) ) : ?>
    <span class="error">誕生日の書式に誤りがあります<br></span>
<?php endif; ?>
    誕生日：西暦<input type="text" name="birthday_yy" value="">年<input type="text" name="birthday_mm" value="">月<input type="text" name="birthday_dd" value="">日<br>
    <br>
    <button type="submit">データ登録</button>
  </form>
</body>
</html>
