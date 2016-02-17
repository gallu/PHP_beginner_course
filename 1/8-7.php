<?php

// 「今日の日付」を取得
$todays_date = date('d');
//var_dump($todays_date);

echo "<select>\n";
for($i = 1; $i <= 31; $i ++) {
  if ($i == $todays_date) {
    // 書き出す日付と今日の日付が合致していたら、selectedを追記
    $atr = " selected";
  } else {
    $atr = "";
  }
  // 出力
  echo "<option value='" , $i , "'" , $atr , ">" , $i , "</option>\n";
}
echo "</select>\n";
