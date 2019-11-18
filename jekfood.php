<?php

function color($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }

function fetch_value($str,$find_start,$find_end) 
    {
        $start = @strpos($str,$find_start);
        if ($start === false) {
            return "";
        }
        $length = strlen($find_start);
        $end    = strpos(substr($str,$start +$length),$find_end);
        return trim(substr($str,$start +$length,$end));
    }

function nama()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $ex = curl_exec($ch);
        // $rand = json_decode($rnd_get, true);
        preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
        return $name[2][mt_rand(0, 14) ];
    }

function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
    }


$secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-AppVersion: 3.27.0';
$headers[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$headers[] = 'X-Location: -6.405821,106.064193';

        echo "\n";
        echo "\e[92m--------------------------------------------------\n";
        echo "\e[92m|                  RE-CODE BY AL                 |\n";
        echo "\e[92m|            Komunitas Tumbuh Bersama            |\n";
        echo "\e[92m|     https://github.com/megatruh/malproject/    |\n";
        echo "\e[92m|   SCRIPT GOJEK AUTO REGIST + AUTO SAVE TOKEN   |\n";
        echo "\e[92m|                    GOODLUCK                    |\n";
        echo "\e[92m--------------------------------------------------\n";
        echo "\n";
        echo "\e[96m[+] Input Nomor HP : ";
        $number = trim(fgets(STDIN));
        $numbers = $number[0].$number[1];
        $numberx = $number[5];
        if($numbers == "08") { 
            $number = str_replace("08","628",$number);
        } elseif ($numberx == " ") {
            $number = preg_replace("/[^0-9]/", "",$number);
            $number = "1".$number;
        }
        $nama = nama();
        $email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
        $data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
        $reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
        $regs = json_decode($reg[0]);
        // Verif OTP
        if($regs->success == true) {
            echo "\e[93m[+] Input OTP : ";
            $otp = trim(fgets(STDIN));
            $data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
            $verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
            $verifs = json_decode($verif[0]);
            if($verifs->success == true) {
                // Claim Voucher
                $token = $verifs->data->access_token;
                $headers[] = 'Authorization: Bearer '.$token;
                $live = "tokens";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \n NOMOR => ".$number." \n");
                fclose($fopen1);
                echo "Token ~> ".$token;
                echo "\e[92m[+] Token Tersimpan di ~> ".$live." \n\n";
                   echo "\e[96m[!] Proses Reedem Voucher 20+10 : GOFOODSANTAI19 \n";
                $data3 = '{"promo_code":"GOFOODSANTAI19"}';
                $claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
                $claims = json_decode($claim[0]); 
                    echo "\c[92m [✓]".$claims->data->message;
                    sleep(5);
                    echo "\n";
                echo "\e[96m[!] Proses Reedem Voucher 15+10 : GOFOODSANTAI11 \n";
                $data4 = '{"promo_code":"GOFOODSANTAI11"}';
                $claim1 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
                $claims1 = json_decode($claim1[0]);
                    echo "\e[92m [✓]".$claims1->data->message;
                    sleep(5);
                    echo "\n";
                echo "\e[96m[!] Proses Redeem Voucher 10+10 : GOFOODSANTAI08 \n";
                $data5 = '{"promo_code":"GOFOODSANTAI08"}';
                $claim2 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data5, $headers);
                $claims2 = json_decode($claim2[0]);
                    echo "\e[92m [✓]".$claims2->data->message;
                    sleep(5);
                    echo "\n";
                echo "\e[96m[!] Proses Redeem Vocher : COBAINGOJEK \n";
                $data6 = '{"promo_code":"COBAINGOJEK"}';
                $claim3 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data6, $headers);
                $claims3 = json_decode($claim2[0]);
                    echo "\e[92m [✓]".$claims2->data->message;
                    sleep(5);
                    echo "\n";
                echo "\e[96m[+] Proses Redeem Vocher : AYOCOBAGOJEK \n";
                $data7 = '{"promo_code":"AYOCOBAGOJEK"}';
                $claim4 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data7, $headers);
                $claims4 = json_decode($claim2[0]);
                    echo "\e[92m [✓]".$claims2->data->message;
                    sleep(5);
                    echo "\n";

                $cekvoucher = request('https://api.gojekapi.com/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
                $total = fetch_value($cekvoucher,'"total_vouchers":',',');
                $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
                $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
                $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
                $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
                $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
                $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
                $voucher7 = getStr1('"title":"','",',$cekvoucher,"7");
                echo "\n".color("yellow","!] Total voucher ".$total." : ");
                echo "\n".color("green","1] ".$voucher1);
                echo "\n".color("green","2] ".$voucher2);
                echo "\n".color("green","3] ".$voucher3);
                echo "\n".color("green","4] ".$voucher4);
                echo "\n".color("green","5] ".$voucher5);
                echo "\n".color("green","6] ".$voucher6);
                echo "\n".color("green","7] ".$voucher7);
                echo"\n";
                $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
                $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
                $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
                $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
                $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
                $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
                $expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'7');

}
                    
                    }