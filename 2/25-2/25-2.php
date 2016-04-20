<pre>
<?php

// Cookieを有効にするパス名の指定(指定しない場合)
setcookie('not_specify_path_name_cookie', 'data1-1', time() + 60*60);
// Cookieを有効にするパス名の指定(指定する場合)
setcookie('specify_path_name_cookie', 'data2-2', time() + 60*60, '/');





//
echo 'setcookie fin.';
