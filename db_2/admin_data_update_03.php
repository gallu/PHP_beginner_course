<?php

/*
 * (管理画面想定)１件のform情報の編集画面
 */

// HTTP responseヘッダを出力する可能性があるので、バッファリングしておく
ob_start();
// セッションの開始
session_start();

// 共通関数のinclude
require_once('common_function.php');
require_once('test_form_data.php');


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// パラメタを受け取る
// XXX エラーチェックは get_test_form() 関数側でやっているのでここではオミット
$test_form_id = (string)@$_GET['test_form_id'];
// 確認
//var_dump($test_form_id);

// データの取得
$datum = get_test_form($test_form_id);
if (true === empty($datum)) {
    header('Location: ./admin_data_list.php');
    exit;
}

// $_SESSION['output_buffer']にデータがある場合は、情報を上書きする
// XXX 配列の「加算演算子による結合」では先に出したほうが優先されるので、セッション情報を先に書く
if (true === isset($_SESSION['output_buffer'])) {
    $datum = $_SESSION['output_buffer'] + $datum;
}
//var_dump($datum);

// (二重に出力しないように)セッション内の「出力用情報」を削除する
unset($_SESSION['output_buffer']);

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>DB講座中級: 管理画面イメージ</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

<div class="container">
  <h1>フォーム内容修正</h1>

<?php if ( (isset($datum['error_must_name']))&&(true === $datum['error_must_name']) ) : ?>
    <span class="text-danger">名前が未入力です<br></span>
<?php endif; ?>

<?php if ( (isset($datum['error_must_post']))&&(true === $datum['error_must_post']) ) : ?>
    <span class="text-danger">郵便番号が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($datum['error_format_post']))&&(true === $datum['error_format_post']) ) : ?>
    <span class="text-danger">郵便番号の書式に誤りがあります<br></span>
<?php endif; ?>

<?php if ( (isset($datum['error_must_address']))&&(true === $datum['error_must_address']) ) : ?>
    <span class="text-danger">住所が未入力です<br></span>
<?php endif; ?>

<?php if ( (isset($datum['error_must_birthday']))&&(true === $datum['error_must_birthday']) ) : ?>
    <span class="text-danger">誕生日が未入力です<br></span>
<?php endif; ?>
<?php if ( (isset($datum['error_format_birthday']))&&(true === $datum['error_format_birthday']) ) : ?>
    <span class="text-danger">誕生日の書式に誤りがあります<br></span>
<?php endif; ?>

  <form action="./admin_data_update_fin.php" method="post">
  <input type="hidden" name="test_form_id" value="<?php echo h($datum['test_form_id']); ?>">
  <table class="table table-hover">
  <tr>
    <td>名前
    <td><input name="name" value="<?php echo h($datum['name']); ?>">
  <tr>
    <td>郵便番号
    <td><input name="post" value="<?php echo h($datum['post']); ?>">
  <tr>
    <td>住所
    <td><input name="address" value="<?php echo h($datum['address']); ?>">
  <tr>
    <td>誕生日
    <td><input name="birthday" value="<?php echo h($datum['birthday']); ?>">
  </table>
  <button>情報を修正する</button>
  </form>

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
