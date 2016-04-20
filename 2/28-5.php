<?php

/*
 XMLをフルスクラッチで作成する場合などの一例
 */

// header出力があるので出力バッファ
ob_start();

// 変数を埋め込む場合、変数はかならずエスケープする！
$data = 'ho<>ge';
$data_e = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

// XML string
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<movies>
    <movie>
        <title>PHP: Behind the Parser</title>
        <characters>
            <character>
                <name>Ms. Coder</name>
                <actor>Onlivia Actora</actor>
            </character>
            <character>
                <name>Mr. Coder</name>
                <actor>El Act&#211;r</actor>
            </character>
        </characters>
        <plot>
            So, this language. It's like, a programming language. Or is it a
            scripting language? All is revealed in this thrilling horror spoof
            of a documentary.
        </plot>
        <great-lines>
            <line>PHP solves all my web problems</line>
        </great-lines>
        <rating type="thumbs">7</rating>
        <rating type="stars">5</rating>
    </movie>
    <itemAdd>
        <itemDetail>{$data_e}</itemDetail>
    </itemAdd>
</movies>
XML;

// XMLを出力
// XXX 実際には「application/rdf+xml」などのほうが一般的な可能性が高いが、今回は「特に中身を定めていない」XMLなので、RFC3023準拠で
header('Content-type: text/xml');

// XMLの出力
echo $xmlstr;
