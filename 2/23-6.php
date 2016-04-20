<pre>
<?php

// 「必須入力」の実装
if ( (false === isset($_GET['data']))or(0 === strlen($_GET['data'])) ) {
    echo "必須チェックfalse(1)\n";
}
if ('' === (string)@$_GET['data']) {
    echo "必須チェックfalse(2)\n";
}

// 「数値であること(整数/小数)」「文字であること」などの文字種指定
if (true === ctype_alpha($_GET['data'])) {
    echo "全て英文字です\n";
}
if (true === ctype_digit($_GET['data'])) {
    echo "全て数字です\n";
}
if (true === ctype_alnum($_GET['data'])) {
    echo "全て英数字です\n";
}
// 上級で出てくる関数ですが、覚えておくと便利です
if (false !== filter_var($_GET['data'], FILTER_VALIDATE_FLOAT)) {
    echo "float(小数点数)です\n";
}

// 日付の書式フォーマットの確認( checkdate()関数もありますが、strtotimeのほうが汎用的で便利な事が多いです )
if (false !== strtotime($_GET['data'])) {
    echo "日付フォーマットの文字列です\n";
}

// 郵便番号の書式フォーマットの確認
$ret = preg_match('/(\d{3})[ -]?(\d{4})/', $_GET['data'], $matches);
if (1 === $ret) {
    echo "郵便番号フォーマットの文字列です\n";
    var_dump($matches);
}

// 年齢などの数値の範囲チェック
if (true === ctype_digit($_GET['data'])) {
    if (20 > $_GET['data']) {
        echo "範囲の下限よりも小さいです\n";
    }
    if (60 < $_GET['data']) {
        echo "範囲の上限よりも大きいです\n";
    }
} else {
    echo "数字ではない入力なので範囲チェックできません\n";
}

// emailアドレスの有効性の確認

// XXX 厳密だが、厳密すぎて「一部の日本国内で有効なアドレス」がはじかれてしまう
if (false !== filter_var($_GET['data'], FILTER_VALIDATE_EMAIL)) {
    echo "有効なメールアドレスです(1)\n";
}

// ググると比較的よく出てくる正規表現だが、"誤りが多いために使ってはいけない"
// 有効なのに無効になる例： test+add@example.com
// 有効なのに無効になる例： "!"@example.com
// 無効なのに有効になる例： test@a_a.example.com(ドメイン名にアンダースコアは許容されない(事が多い))
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_GET['data'])) {
    echo "有効なメールアドレスかもしれません(2)\n";
} else {
    echo "有効なメールアドレスではないかもしれません(2)\n";
}

