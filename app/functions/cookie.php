<?php

use System\config;
use System\database\query;
use System\input;


function cookie_policy()
{
    return Config::meta('cookie');
}

function cookie_policy_page()
{
    $cookie_policy_page = Registry::get('cookie_policy_page');

    return  base_url($cookie_policy_page->slug);
}