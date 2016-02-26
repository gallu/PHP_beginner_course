<?php
$fh = fopen('./13-1.php', 'r');
while($line = fgets($fh)) {
    echo $line;
}
fclose($fh);
