<?php
echo "<select>\n";
for($i = 1; $i <= 31; $i ++) {
  // 出力
    echo "<option value='" , $i , "'>" , $i , "</option>\n";
}
echo "</select>\n";
