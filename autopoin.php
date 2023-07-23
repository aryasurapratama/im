<?php
date_default_timezone_set("Asia/Jakarta");
require('./helper/app.php');



for ($i = 0; $i < 5; $i++) {
    echo color('green', "[" . date("H:i:s") . "] ") . "Input File example (token.txt) : ";
    $file = trim(fgets(STDIN));
    echo "\n";
    $list = explode("\n", str_replace("\r", "", file_get_contents($file)));
    foreach ($list as $key => $token) {
        $cekuser = curl('https://api.im2019.com/api/userinfo', null, $token);
        if (strpos($cekuser, '"ok"')) {
            echo color('green', "[" . date("H:i:s") . "] ") . "Token Valid..\n";
            $account = json_decode($cekuser)->data->nickname;
            $saldo = json_decode($cekuser)->data->now_money;
            $poin = json_decode($cekuser)->data->integral;


            echo color('green', "[" . date("H:i:s") . "] ") . "Data Account :\n";
            echo color('green', "[" . date("H:i:s") . "] ") . "Nick name : $account\n";
            echo color('green', "[" . date("H:i:s") . "] ") . "saldo : $saldo\n";
            echo color('green', "[" . date("H:i:s") . "] ") . "poin : $poin\n";


            $coupon = curl('https://api.im2019.com/api/sign/integral', '{}', $token);
            if (strpos($coupon, '200') !== false) {
                echo "Claim poin berhasil \n";
            } else {
                echo "Claim poin gagal";
        }
            
            
            
        }
    }
}
?>