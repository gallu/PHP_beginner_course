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


// 検索パラメタの取得
// (第一種)ホワイトリストの準備
$search_list = array (
    'search_name',
    'search_birthday_from',
    'search_birthday_to',
    'search_created',
    'search_like_name',
    'search_like_post',
);
// データの取得
$search = array();
foreach($search_list as $p) {
    if ((true === isset($_POST[$p]))&&('' !== $_POST[$p]) ) {
        $search[$p] = $_POST[$p];
    }
}
/*
// XXX 以下のようなコードは「セキュリティホールを生む」可能性が出てくるので、基本的には避けるのが望ましい
// XXX 「これならホワイトリストをいちいち作らなくても楽だから！」という理由から、発案に至る可能性があるので
// データの取得
$search = array();
foreach($_POST as $k => $v) {
    if ((0 === strncmp($k, 'search_', strlen('search_')))&&('' !== $_POST[$k])) {
        $search[$k] = $v;
    }
}
*/
// 確認
var_dump($search);


// DBハンドルの取得
$dbh = get_dbh();

// SELECT文の作成と発行
// ------------------------------
// 準備された文(プリペアドステートメント)の用意
$sql = 'SELECT * FROM test_form';

// 「検索条件がある」場合の検索条件の付与
$bind_array = array();
if (false === empty($search)) {
    //
    $where_list = array();

    // 値を把握する
    //
    if (true === isset($search['search_name'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = 'name = :name';
        // BINDする値を設定する
        $bind_array[':name'] = $search['search_name'];
    }
    //
    if (true === isset($search['search_birthday_from'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = 'birthday >= :birthday_from';
        // 日付を簡単に整える
        $search['search_birthday_from'] = date('Y-m-d', strtotime($search['search_birthday_from']));
        // BINDする値を設定する
        $bind_array[':birthday_from'] = $search['search_birthday_from'];
    }
    //
    if (true === isset($search['search_birthday_to'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = 'birthday <= :birthday_to';
        // 日付を簡単に整える
        $search['search_birthday_to'] = date('Y-m-d', strtotime($search['search_birthday_to']));
        // BINDする値を設定する
        $bind_array[':birthday_to'] = $search['search_birthday_to'];
    }
    //
    if (true === isset($search['search_created'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = 'created BETWEEN :created_from AND :created_to';
        // 日付を簡単に整える
        $search['search_created'] = date('Y-m-d', strtotime($search['search_created']));
        // BINDする値を設定する
        $bind_array[':created_from'] = $search['search_created'] . ' 00:00:00';
        $bind_array[':created_to'] = $search['search_created'] . ' 23:59:59';
    }
    //
    // XXX このまま動かすとエラーが出るので、一端「ダミー処理」を入れておく
    if (true === isset($search['search_like_name'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = '1 = 1';
        // BINDする値を設定する
        // XXX 後で！！
    }
    //
    if (true === isset($search['search_like_post'])) {
        // WHERE句に入れる文言を設定する
        $where_list[] = '1 = 1';
        // BINDする値を設定する
        // XXX 後で！！
    }

    // WHERE句を合成してSQL文につなげる
    $sql = $sql . ' WHERE ' . implode(' AND ', $where_list);

    // XXX 「sort条件」は現在指定の値を持越し。「何かデフォルトでリセットしたい」ような場合はここで$sort変数に適切な値を代入する
}

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

// SQLを閉じる
$sql .= ';';
//var_dump($sql);

// プリペアドステートメントを作成する
$pre = $dbh->prepare($sql);

// 値のバインド
if (false === empty($bind_array)) {
    foreach($bind_array as $k => $v) {
        $pre->bindValue($k, $v); // デフォルトのSTRとしておく：「数値が入る」可能性が出てきたら、is_int関数で調べて…という実装もよい
    }
}
// 値の確認
//var_dump($bind_array);

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

  <div class="row">
  <form action="./admin_data_list.php" method="post">
    <div>
      <span class="col-md-4">検索する「名前」<input name="search_name" value="<?php echo h(@$search['search_name']); ?>"></span>
      <span class="col-md-8">検索する「誕生日(YYYY-MM-DD)」<input name="search_birthday_from" value="<?php echo h(@$search['search_birthday_from']); ?>">～<input name="search_birthday_to" value="<?php echo h(@$search['search_birthday_to']); ?>"></span>
    </div>
    <div>
      <span class="col-md-12">検索する「入力日(YYYY-MM-DD)」<input name="search_created" value="<?php echo h(@$search['search_created']); ?>"></span>
    </div>
    <div>
      <span class="col-md-6">検索する「名前」(部分一致検索)<input name="search_like_name" value="<?php echo h(@$search['search_like_name']); ?>"></span>
      <span class="col-md-6">検索する「郵便番号(部分一致検索)」<input name="search_like_post" value="<?php echo h(@$search['search_like_post']); ?>"></span>
    </div>
    <span class="col-md-12"><button class="btn btn-default">検索する</button></span>
  </form>
  </div>
<?php if (false === empty($search)) : ?>
    現在、以下の項目で検索をかけています。<br>
    <?php
        foreach($search as $k => $v) {
            echo h($k), ': ', h($v), "<br>\n";
        }
    ?>
    <br>
    <a class="btn btn-default" href="./admin_data_list.php">検索項目をクリアする</a>
<?php endif;?>

  <h2>一覧</h2>
  <table class="table table-hover">
  <tr>
    <th>フォームID
    <th>名前
    <th>誕生日
    <th>入力日
    <th>修正日
  <tr>
    <td><?php a_tag_print('test_form_id', '▲'); ?>　<?php a_tag_print('test_form_id_desc', '▼'); ?>
    <td><?php a_tag_print('name', '▲'); ?>　<?php a_tag_print('name_desc', '▼'); ?>
    <td>
    <td><?php a_tag_print('created', '▲'); ?>　<?php a_tag_print('created_desc', '▼'); ?>
    <td><?php a_tag_print('updated', '▲'); ?>　<?php a_tag_print('updated_desc', '▼'); ?>
  <?php foreach($data as $datum): ?>
  <tr>
    <td><?php echo h($datum['test_form_id']); ?>
    <td><?php echo h($datum['name']); ?>
    <td><?php echo h($datum['birthday']); ?>
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
