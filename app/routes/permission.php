<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\view;

Route::collection(['before' => 'auth,install_exists'], function () {

    /**
     * Permission
     */
    Route::get('admin/permission', function () {
        $vars = [
            'token' => Csrf::token(),
        ];

        return View::create('error/permission', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

});