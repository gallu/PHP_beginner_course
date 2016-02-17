<?php
$awk = array ();
$awk['chemistry'] = 80;
$awk['math'] = 65;
$awk['national_lang'] = 79;
$awk['society'] = 92;
$awk['english'] = 45;
$awk['physics'] = 66;
foreach($awk as $k => $v) {
  echo $k , " is ", $v, "<br>\n";
}
