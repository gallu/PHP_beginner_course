<?php
  // 入力値を受け取る
  $height = 0;
  $weight = 0;
  if (true === isset($_GET['height'])) {
    $height = floatval($_GET['height']);
  }
  if (true === isset($_GET['weight'])) {
    $weight = floatval($_GET['weight']);
  }
/*
  $height = (float)@$_GET['height'];
  $weight = (float)@$_GET['weight'];
*/
//var_dump($height);
//var_dump($weight);

  // validateする
  // ・０はやだ
  // ・負の値もやだ
  if ( (0 >= $height)||(0 >= $weight) ) {
    //echo 'エラーっぽいよ？';
    $bmi = 0;
  } else {
    // 値が正しければ…
    // 値を使ったり処理したりする
    $bmi = $weight / (($height / 100) * ($height / 100)); // 単位をmにして計算する
//var_dump($bmi);
    $bmi = intval($bmi * 100 + 0.5) / 100; // 小数点以下第二位まで有効、且つ四捨五入する
//var_dump($bmi);
  }

?>
<html>
<head><title>BMI計算</title><meta charset="UTF-8"></head>
<body>
<h1>BMI計算</h1>
<form action="3-2.php" method="get">
身長(cm)<input name="height" value="<?php echo $height; ?>"><br>
体重(Kg)<input name="weight" value="<?php echo $weight; ?>"><br>
<input type="submit" value="計算">
</form>
<?php
  if (0 < $bmi) {
    echo "あなたのBMI値は{$bmi}です。<br>";?>
    <?php if ($bmi < 18.5): ?>
      軽体重(やせ形)ですね。
    <?php elseif ($bmi < 25): ?>
      普通体重ですね。
    <?php elseif ($bmi < 30): ?>
      肥満(１度)ですね。
    <?php elseif ($bmi < 35): ?>
      肥満(２度)ですね。
    <?php elseif ($bmi < 40): ?>
      肥満(３度)ですね。
    <?php else: ?>
      肥満(４度)ですね。
    <?php endif; ?>
<?php
  }
?>
<br>
<br>
</body>
</html>
