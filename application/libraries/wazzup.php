<?php

class Wazzup {
    private static $token = '38bf7b77d71c43dbaa07b9ed936af840';

    public static function send($endpoint, $body, $method="POST") {
            $header = array(
                'Authorization: Bearer '.self::$token,
                'Content-Type: application/json',
            );
    
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, "https://api.wazzup24.com/v3/".$endpoint);
            
            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                curl_setopt($ch, CURLOPT_POST, 1);
            }
            
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            
            $result = curl_exec($ch);
            
            return json_decode($result);
        }
}