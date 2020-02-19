<?php


namespace App\Services\SMS;


class Msg91
{

    protected static $authkey='';

    public static function send($mobile, $message){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.msg91.com/api/sendhttp.php?authkey=".self::$authkey."&mobiles=$mobile&unicode=&country=91&message=$message&sender=PKGSPR&route=4",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        //var_dump($response);die;
        if ($err) {
          return false;
        } else {
          return true;
        }
    }
}
