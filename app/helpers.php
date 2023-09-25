<?php

use System\config;
use System\input;
use System\uri;
use System\database\query;
use System\session;

/**
 * translates a line of text
 *
 * @param string $line line to translate
 * @param string[] ...,  variables to replace
 *
 * @return mixed|string
 */
function __($line)
{
    $args = array_slice(func_get_args(), 1);

    return Language::line($line, null, $args);
}

/**
 * Checks whether the current request is on the admin panel
 *
 * @return bool
 * @throws \ErrorException
 * @throws \OverflowException
 */
function is_admin()
{
    // Exact URI or trailing slash after 'admin'.
    return Uri::current() === 'admin' || strpos(Uri::current(), 'admin/') === 0;
}

/**
 * Checks whether The blog script is installed
 *
 * @return bool
 */
function is_installed()
{
    return Config::get('db') !== null or Config::get('database') !== null;
}

/**
 * Creates a slug from a string
 *
 * @param string $string    string to slugify
 * @param string $separator separator character
 *
 * @return null|string|string[]
 */
function slug($string, $separator = '-')
{
    $accents_regex = '~&([a-zA-Z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = [
        '&' => 'and'
    ];
    $string        = mb_strtolower(trim($string), 'UTF-8');
    $string        = str_replace(array_keys($special_cases), array_values($special_cases), $string);
    $string        = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    $string        = preg_replace("/[^a-zA-Z0-9]/u", "$separator", $string);
    $string        = preg_replace("/[$separator]+/u", "$separator", $string);
    $string        = trim($string, '-');

    return $string;
}

/**
 * Calculate a user-readable file size
 *
 * @param int $size original size in byte
 *
 * @return string user-readable file size
 */
function readable_size($size)
{
    $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];

    return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

/**
 * copies a filesystem tree recursively (aka. "cp -R")
 *
 * @param string $src source path
 * @param string $dst destination path
 *
 * @return void
 */
function recurse_copy($src, $dst)
{
    $dir = opendir($src);

    @mkdir($dst);

    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . DS . $file)) {
                recurse_copy($src . DS . $file, $dst . DS . $file);
            } else {
                copy($src . DS . $file, $dst . DS . $file);
            }
        }
    }

    closedir($dir);
}

/**
 * deletes a filesystem tree recursively (aka. "rm -rf") by deleting all
 * individual files and folders within it
 *
 * @param string $dir directory to remove
 *
 * @return bool whether the
 */
function delTree($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);

    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}

/**
 * Admin Functions
 */

/**
 * Count Comments
 *
 * @param string count
 *
 * @return string
 */
function count_comments()
{
    $count_pending = Comment::where('status', '=', 'pending')
        ->count();
    $count_spam = Comment::where('status', '=', 'spam')
        ->count();
    $count = $count_pending + $count_spam;

    return $count;
}

/**
 * Count Visitors
 *
 * @param string count
 *
 * @return string
 */
function count_visitors_online()
{
    $count = Query::table(Base::table('visitors_online'))->count();

    return $count;
}

function avatar()
{
    $user = Auth::user();
    if ($user->image):
        $avatar = $user->image;
    else:
        $avatar = 'app/views/assets/img/no_avatar.png';
    endif;

    return $avatar;
}

function user_name()
{
    $user_name = Auth::user()->real_name;
    return $user_name;

}

function user_id()
{
    $user_id = Auth::user()->id;
    return $user_id;
}


function getReadTimeAttribute($content = '')
{
    $word = str_word_count(strip_tags($content));
    $m = floor($word / 200);

    if (! $m) {
        return 'Less than a minute';
    }

    $est = $m . ' min' . ($m == 1 ? '' : 's');

    return $est;
}

function pluralise_admin($amount, $str, $alt = '')
{
    return intval($amount) === 1 ? $str : $str . ($alt !== '' ? $alt : (__('site.s')));
}

function relative_time_admin($date) {
    if(is_numeric($date)) $date = '@' . $date;

    $user_timezone = new DateTimeZone(Config::app('timezone'));
    $date = new DateTime($date, $user_timezone);

    // get current date in user timezone
    $now = new DateTime('now', $user_timezone);

    $elapsed = $now->format('U') - $date->format('U');

    if($elapsed <= 1) {
        return 'Just now';
    }

    $times = array(
        31104000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach($times as $seconds => $title) {
        $rounded = $elapsed / $seconds;

        if($rounded > 1) {
            $rounded = round($rounded);
            return $rounded . ' ' . pluralise_admin($rounded, $title) . ' ago';
        }
    }
}

function countTotalVisitors() {
    // Count the number of visitors active within the threshold
    $count = Query::table(Base::table('visitors'))->count();

    return $count;
}

function countOnlineVisitors() {
    // Define the threshold for considering a visitor as online (e.g., within the last 5 minutes)
    $threshold = date('Y-m-d H:i:s', strtotime('-5 minutes'));

    // Count the number of visitors active within the threshold
    $count = Query::table(Base::table('visitors'))->where('last_activity', '>=', $threshold)->count();

    return $count;
}

