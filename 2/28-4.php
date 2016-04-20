<?php

/*
 元のXMLがしっかりとあって、そこに微修正を加える場合などの一例
 */

// header出力があるので出力バッファ
ob_start();

// XMLを取得
$xml_string = file_get_contents('./28-1.xml');

// XMLをパース
$xml = simplexml_load_string( $xml_string );
//var_dump($xml);
$xml_item = $xml->addChild('addItem');
//var_dump($xml);
$xml_item->addChild('addDetail', 'ho<>ge');
//var_dump($xml);

// XMLを出力
// XXX 実際には「application/rdf+xml」などのほうが一般的な可能性が高いが、今回は「特に中身を定めていない」XMLなので、RFC3023準拠で
header('Content-type: text/xml');

// XMLの出力
echo $xml->asXML();
