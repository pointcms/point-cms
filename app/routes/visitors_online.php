<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\uri;
use System\view;

Route::collection(['before' => 'auth,install_exists'], function () {

    /**
     * List Visitors statistics
     */
    Route::get([
        'admin/reports/visitors_online',
        'admin/reports/visitors_online/(:num)'
    ], function ($page = 1) {
        $vars['token'] = Csrf::token();

        $vars['timezone'] = Config::app('timezone');

        $today = date("y-m-d");

        $vars['visitors_online'] = VisitorsOnline::paginate($page, Config::get('admin.posts_per_page'));

        if (Auth::admin()) {
            return View::create('reports/visitors_online', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

});