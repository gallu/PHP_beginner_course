<pre>
<?php

function hoge() {
  $i = $i + 1;
  var_dump($i);
}
//
$i = 0;
hoge();
hoge();
var_dump($i);
