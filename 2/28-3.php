<?php

// XMLを取得
$xml_string = file_get_contents('http://blogs.itmedia.co.jp/yoshimasa/index.rdf');

// XMLをパース
$xml = simplexml_load_string( $xml_string );
//var_dump($xml);
//var_dump($xml->channel);
//var_dump((string)$xml->channel->title);


// 簡単に「タイトルとリンク」だけ表示してみる
foreach($xml->item as $i) {
  echo '<hr>';
  var_dump((string)$i->title);
  echo '<br>';
  var_dump((string)$i->link);
  echo '<br>';
}

