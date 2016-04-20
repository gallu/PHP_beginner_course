<?php

// elseif について学びましょう
$age = 20;
if (20 > $age) {
    echo "あなたはまだ未成年ですね<br>\n";
} else {
    echo "あなたはもう成年ですね<br>\n";
}

//
if (18 > $age) {
    echo "あなたはまだ選挙権のない未成年ですね<br>\n";
} elseif (20 > $age) {
    echo "あなたは選挙権のある未成年ですね<br>\n";
} else {
    echo "あなたはもう成年ですね<br>\n";
}

// if文のネストを学びましょう
$gender = 'male';
if (20 <= $age) {
    if ('male' === $gender) {
        echo "あなたは成人男性ですね<br>\n";
    } elseif ('female' === $gender) {
        echo "あなたは成人女性ですね<br>\n";
    }
}

// 「:を使い、波括弧を使わない」if文の書き方を学びましょう
if (20 > $age) :
    echo "あなたはまだ未成年ですね<br>\n";
else :
    echo "あなたはもう成年ですね<br>\n";
endif;


// 論理演算子を学びましょう
// and
if ( (20 <= $age)and('male' === $gender) ) {
    echo "あなたは成人男性ですね<br>\n";
}
// or
if ( (20 > $age)or('famale' === $gender) ) {
    echo "あなたは未成年か、または女性ですね<br>\n";
}


