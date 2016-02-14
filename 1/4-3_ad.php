<?php

// 出したい広告を配列で所持しておく
$ads = array (
  '<a href="http://ad.example.com/landing_page.html"><img src="http://ad.example.com/img/image.png"></a>',
  '<a href="http://ad.example.com/landing_page2.html"><img src="http://ad.example.com/img/image2.png"></a>',
  '<a href="http://ad.example.com/landing_page3.html"><img src="http://ad.example.com/img/image3.png"></a>',
  '<a href="http://ad.example.com/landing_page4.html"><img src="http://ad.example.com/img/image4.png"></a>',
);

// ランダムに1つを選んで出力する
echo $ads( mt_rand(0, count($ads) - 1) );
