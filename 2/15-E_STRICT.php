<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

class hoge {
  public function foo() {
    echo "foo\n";
  }
}
// staticの付いていないメソッドを静的にcallしている
hoge::foo();
