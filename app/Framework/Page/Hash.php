<?php
namespace SimpleWork\Framework\Page;

class Hash
{

    public static function encode($string)
    {
        $firstString            = base64_encode($string);
        $base64Reverse          = strrev($firstString);
        $base64ReverceEncode    = base64_encode($base64Reverse);
        $base64Reverse          = strrev($base64ReverceEncode);
        $base64ReverceEncode    = base64_encode($base64Reverse);
        $SubFinal               = strrev($base64ReverceEncode);
        $Final                  = base64_encode($SubFinal);

        return $Final;
    }

    public static function decode($string)
    {
        $firstString            = base64_decode($string);
        $base64Reverse          = strrev($firstString);
        $base64ReverceEncode    = base64_decode($base64Reverse);
        $base64Reverse          = strrev($base64ReverceEncode);
        $base64ReverceEncode    = base64_decode($base64Reverse);
        $SubFinal               = strrev($base64ReverceEncode);
        $Final                  = base64_decode($SubFinal);

        return $Final;
    }


    public static function valid_google_token($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('secret' => '6LfWhhIjAAAAAEpdOg9AGrqz12K2RmxBl3fZL8Gb', 'response' => $token),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->success;
    }
}