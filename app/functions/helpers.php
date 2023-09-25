<?php

use System\config;
use System\uri;

/**************************
 * Theme helpers functions
 **************************/

/**
 * Retrieves the full URL to a URI
 *
 * @param string $url
 *
 * @return string
 */
function full_url($url = '')
{
    return Uri::full($url);
}

/**
 * Retrieves the base URL to a URI
 *
 * @param string $url
 *
 * @return string
 */
function base_url($url = '')
{
    return Uri::to($url);
}

/**
 * Retrieves the theme URL
 *
 * @param string $file (optional) file path to append
 *
 * @return string
 */
function theme_url($file = '')
{
    $theme_folder = Config::meta('theme');
    $base         = 'themes' . '/' . $theme_folder . '/';

    return asset($base . ltrim($file, '/'));
}

/**
 * Require a theme file
 *
 * @param string $file path to file to include
 *
 * @return mixed
 */
function theme_include($file)
{
    $theme_folder = Config::meta('theme');
    $base         = PATH . 'themes' . DS . $theme_folder . DS;

    if (is_readable($path = $base . ltrim($file, DS) . EXT)) {
        /** @noinspection PhpIncludeInspection */
        return require $path;
    }
}

/**
 * Retrieve the URL to an asset
 *
 * @param string $extra (optional) string to append
 *
 * @return string
 */
function asset_url($extra = '')
{
    return asset('assets/' . ltrim($extra, '/'));
}

/**
 * Retrieves the escaped current URL
 *
 * @return string
 * @throws \ErrorException
 * @throws \OverflowException
 */
function current_url()
{
    return htmlentities(raw_current_url());
}

/**
 * Retrieves the raw current URL
 *
 * @return string
 * @throws \ErrorException
 * @throws \OverflowException
 */
function raw_current_url()
{
    return Uri::current();
}

/**
 * Retrieves the canonical URL
 *
 * @return string
 * @throws \ErrorException
 * @throws \OverflowException
 */
function canonical()
{
    // get the rigth protocol
    $protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';

// simply render canonical base on the current http host ( multiple host ) + requests
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
/**
 * Retrieves the RSS URL
 *
 * @return string
 */
function rss_url()
{
    return base_url('feeds/rss');
}
/**
 * Retrieves the Contact URL
 *
 * @return string
 */
function contact_url()
{
    return base_url('contact');
}

/**
 * Binds an event to the page
 *
 * @param string   $page
 * @param \Closure $fn
 *
 * @return void
 */
function bind($page, $fn)
{
    Events::bind($page, $fn);
}

/**
 * Receives an event
 *
 * @param string $name
 *
 * @return string
 */
function receive($name = '')
{
    return Events::call($name);
}

/**
 * Receives the email
 *
 * @param string email
 *
 * @return string
 */
function site_email()
{
    return Config::meta('email');
}

