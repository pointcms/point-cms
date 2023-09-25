<?php

/********************************
 *  Theme functions for visitors
 ********************************/

use System\input;
use System\uri;

function visitor_ip()
{
    if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    $ip = filter_var($ip, FILTER_VALIDATE_IP);
    $ip = ($ip === false) ? '0.0.0.0' : $ip;
    return $ip;
}

function trackVisitorActivity()
{
    $visitor_ip = visitor_ip();
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

    // Check if the visitor already exists in the database
    $existing_visitor = Query::table(Base::table('visitors'))->where('visitor_ip', '=', $visitor_ip)->fetch();

    if ($existing_visitor) {
        // Update last activity and referer
        Query::table(Base::table('visitors'))
            ->where('id', '=', $existing_visitor->id)
            ->update(['last_activity' => date('Y-m-d H:i:s'), 'referer' => $referer]);
    } else {
        // Insert new visitor
        Query::table(Base::table('visitors'))
            ->insert(['visitor_ip' => $visitor_ip, 'referer' => $referer, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
