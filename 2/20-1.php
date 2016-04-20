<pre>
<?php

// クラスの宣言
class クラス名 {
    //
    public function メソッド() {
        echo "call メソッド()\n";
    }
    //
    public static function 静的メソッド() {
        echo "call 静的メソッド()\n";
    }

//
//private $プロパティ;
public $プロパティ;
}

//
$インスタンス = new クラス名();
$インスタンス->プロパティ = 'test';
var_dump($インスタンス);
//
$インスタンス->メソッド();
//
クラス名::静的メソッド();


