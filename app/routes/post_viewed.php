<?php


use System\config;
use System\database\query;
use System\input;
use System\route;
use System\uri;
use System\view;

Route::collection(['before' => 'auth,install_exists'], function () {

    // TODO: Unused page parameter, what for?
    Route::get([
        'admin/reports/post_viewed',
        'admin/reports/post_viewed/(:num)'
    ], function ($page = 1) {
        $vars['posts'] = PostsViewed::paginate($page, Config::get('admin.posts_per_page'));
        $vars['token'] = Csrf::token();

        $total = Query::table(Base::table('posts'))
            ->sum_viewed();

        $vars['total_viewed'] = $total;

        if (Auth::admin()) {
            return View::create('reports/post_viewed', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });


});