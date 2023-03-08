<?php

use System\config;
use System\database\query;
use System\input;


function visitors_online()
{
    //Visitors online record  
   
    if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
        // Check IP from internet.
        $ip = $_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        // Check IP is passed from proxy.
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
        // Get IP address from remote address.
        $ip = $_SERVER['REMOTE_ADDR'];
       }

    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    if (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI'])) {
        $url = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    } else {
        $url = '';
    }

    $date = date('Y-m-d H:i:s'); // Getting the current date

    $visitors_online   = Base::table('visitors_online');

    $query_visitors = "DELETE FROM `". $visitors_online . "` WHERE date < '" . date('Y-m-d H:i:s', strtotime('-1 hour')) . "'";
    DB::ask($query_visitors);

    $query_visitors = "REPLACE INTO  `". $visitors_online . "` SET  ip='$ip', url='$url', referer='$referer', date='$date'";
    DB::ask($query_visitors);

}