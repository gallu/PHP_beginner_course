<pre>
<?php

setcookie('num', mt_rand(0, 999), time() + 86400);

var_dump($_COOKIE);
