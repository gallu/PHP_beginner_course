<pre>
<?php

// XMLを取得
$xml_string = file_get_contents('./28-1.xml');

// XMLをパース
$xml = simplexml_load_string( $xml_string );
var_dump($xml);