<pre>
<?php

function cmd_escape($user_arg) {
    // エスケープなし
    $cmd = "ls {$user_arg}";
    print "no escape > '{$cmd}'\n";

    // エスケープあり(ただし非推奨)
    $e = escapeshellcmd($user_arg);
    $cmd = "ls {$e}";
    print "escapeshellcmd > '{$cmd}'\n";

    // エスケープあり
    $e = escapeshellarg($user_arg);
    $cmd = "ls {$e}";
    print "escapeshellarg > '{$cmd}'\n";

    print "\n";
}

cmd_escape('hoge*');
cmd_escape('hoge*; cat /etc/passwd');


