<pre>
<?php

$i = 100;

//
$string = <<<EOD
ヒアドキュメント用の文字列です。
\tや\n、{$i}なども書いてみましょう。
EOD;
var_dump($string);

//
$string = <<<'EOD'
ヒアドキュメント(NowDoc)用の文字列です。
\tや\n、{$i}なども書いてみましょう。
EOD;
var_dump($string);


