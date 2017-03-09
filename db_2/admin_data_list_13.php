<?php

/*
 * (管理画面想定)情報の一覧
 */

// セッションの開始
ob_start();
session_start();

// 共通関数のinclude
require_once('common_function.php');


// XXX 管理画面であれば、本来はこのあたり(ないしもっと手前)で認証処理を行う

// ソートパラメタの取得
$sort = (string)@$_GET['sort'];
// デフォルトの設定
if ('' === $sort) {
    $sort = 'test_form_id';
}
// 確認
//var_dump($sort);


// DBハンドルの取得
$dbh = get_dbh();

// SELECT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM test_form';
// ソート条件の付与
// (第一種)ホワイトリストによるチェック
$sort_list = array (
    'test_form_id' => 'test_form_id',
    'test_form_id_desc' => 'test_form_id DESC',
    'name' => 'name',
    'name_desc' => 'name DESC',
    'created' => 'created',
    'created_desc' => 'created DESC',
    'updated' => 'updated',
    'updated_desc' => 'updated DESC',
);
if (true === isset($sort_list[$sort])) {
    $sql .= ' ORDER BY ' . $sort_list[$sort];
}
$sql .= ';';
//var_dump($sql);
$pre = $dbh->prepare($sql);

// 値のバインド
// XXX 今回はプレースホルダがないので、バインドはなし

// SQLの実行
$r = $pre->execute();
if (false === $r) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        echo 'システムでエラーが起きました';
        exit;
}

// データをまとめて取得
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);

// $_SESSION['output_buffer']にデータがある場合は、情報を取得する
if (true === isset($_SESSION['output_buffer'])) {
    $output_buffer = $_SESSION['output_buffer'];
} else {
    $output_buffer = array();
}
//var_dump($output_buffer);

// (二重に出力しないように)セッション内の「出力用情報」を削除する
unset($_SESSION['output_buffer']);

// CSRFトークンの取得
$csrf_token = create_csrf_token_admin();

// sortのAエレメント出力用関数
function a_tag_print($type, $out) {
    if ($type === $GLOBALS['sort']) {
        echo "<a class='bg-danger text-danger' href='./admin_data_list.php?sort={$type}'>{$out}</a>";
    } else {
        echo "<a class='text-muted' href='./admin_data_list.php?sort={$type}'>{$out}</a>";
    }
}

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
  <h1>フォーム内容一覧</h1>

<?php if ( (isset($output_buffer['error_csrf']))&&(true === $output_buffer['error_csrf']) ) : ?>
    <span class="text-danger">CSRFトークンでエラーが起きました。正しい遷移を、５分以内に操作してください。<br></span>
<?php endif; ?>

  <table class="table table-hover">
  <tr>
    <td><?php a_tag_print('test_form_id', '▲'); ?>　<?php a_tag_print('test_form_id_desc', '▼'); ?>
    <td><?php a_tag_print('name', '▲'); ?>　<?php a_tag_print('name_desc', '▼'); ?>
    <td><?php a_tag_print('created', '▲'); ?>　<?php a_tag_print('created_desc', '▼'); ?>
    <td><?php a_tag_print('updated', '▲'); ?>　<?php a_tag_print('updated_desc', '▼'); ?>
  <?php foreach($data as $datum): ?>
  <tr>
    <td><?php echo h($datum['test_form_id']); ?>
    <td><?php echo h($datum['name']); ?>
    <td><?php echo h($datum['created']); ?>
    <td><?php echo h($datum['updated']); ?>
    <td><a class="btn btn-default" href="./admin_data_detail.php?test_form_id=<?php echo rawurlencode($datum['test_form_id']); ?>">詳細へ</a>
    <td><a class="btn btn-default" href="./admin_data_update.php?test_form_id=<?php echo rawurlencode($datum['test_form_id']); ?>">修正へ</a>
    <td><form action="./admin_data_delete.php" method="post">
            <input type="hidden" name="test_form_id" value="<?php echo h($datum['test_form_id']); ?>">
            <input type="hidden" name="csrf_token" value="<?php echo h($csrf_token); ?>">
            <button class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除する</button>
        </form>
  <?php endforeach; ?>
  </table>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
