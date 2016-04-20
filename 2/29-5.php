<pre>
<?php

// dump閲覧用コード
function dump_string($s) {
//var_dump($s);
  $len = strlen($s);
  $ret = '';
  for($i = 0; $i < $len; $i ++) {
    $ret .= sprintf("%02x", ord($s[$i]));
  }
  return $ret;
}

// 元データ
$key = '012345678901234567890123';
$base = 'あいうえ';

// EBCによる暗号化(非推奨
var_dump(dump_string($base));
$crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $base, MCRYPT_MODE_ECB);
var_dump(dump_string($crypt));
//
$dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_ECB);
var_dump($dec);
var_dump(dump_string($dec));
echo "\n";


// CBCによる暗号化(ブロックモード的に推奨)
var_dump(dump_string($base));
// ivの作成
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
// 暗号化
$crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $base, MCRYPT_MODE_CBC, $iv);
var_dump(dump_string($crypt));
$crypt = $iv . $crypt; // ivを暗号文につなげる
var_dump(dump_string($crypt));
//
// ivの取り出し
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$iv = substr($crypt, 0, $iv_size);
// 暗号文からivを切り出す
$crypt = substr($crypt, $iv_size);
// 復号
$dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
var_dump($dec);
var_dump(dump_string($dec));
echo "\n";


// パディングモードをPKCS#5 Paddingにする(他言語でもやり取りしやすいので推奨)
// ivの作成
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
// パディングの作成
var_dump(dump_string($base));
$blocksize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$pkcs = $blocksize - (strlen($base) % $blocksize);
$base .= str_repeat(chr($pkcs), $pkcs);
var_dump(dump_string($base));
// 暗号化
$crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $base, MCRYPT_MODE_CBC, $iv);
var_dump(dump_string($crypt));
$crypt = $iv . $crypt; // ivを暗号文につなげる
var_dump(dump_string($crypt));
//
// ivの取り出し
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$iv = substr($crypt, 0, $iv_size);
// 暗号文からivを切り出す
$crypt = substr($crypt, $iv_size);
var_dump(dump_string($crypt));
// 復号
$dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
var_dump($dec);
var_dump(dump_string($dec));
// パディングの切り取り
$pad = ord($dec[strlen($dec)-1]);
$dec = substr($dec, 0, -1 * $pad);
var_dump($dec);
var_dump(dump_string($dec));
