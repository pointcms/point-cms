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
        'admin/panel',
        'admin/panel/(:num)'
    ], function ($page = 1) {
        $vars['token'] = Csrf::token();

        /**
         * Counts the number of total  comments / posts / pages
         *
         * @return string
         * @throws \ErrorException
         * @throws \Exception
         */

        $user = Auth::user();
        if (!empty($user)) {
            $vars['user'] = $user->real_name;
        }

        $user_id = $user->id;

        $comments_count_total = Query::table(Base::table('comments'))
            ->count();

        if ($comments_count_total > 1000000000000) {
            $vars['total_comments'] = round($comments_count_total / 1000000000000, 1) . 'T';
        } elseif ($comments_count_total > 1000000000) {
            $vars['total_comments'] = round($comments_count_total / 1000000000, 1) . 'B';
        } elseif ($comments_count_total > 1000000) {
            $vars['total_comments'] = round($comments_count_total / 1000000, 1) . 'M';
        } elseif ($comments_count_total > 1000) {
            $vars['total_comments'] = round($comments_count_total / 1000, 1) . 'K';
        } else {
            $vars['total_comments'] = $comments_count_total;
        }

        $posts_count_total = Query::table(Base::table('posts'))
            ->where('author', '=', $user_id)
            ->count();

        if ($posts_count_total > 1000000000000) {
            $vars['total_posts'] = round($posts_count_total / 1000000000000, 1) . 'T';
        } elseif ($posts_count_total > 1000000000) {
            $vars['total_posts'] = round($posts_count_total / 1000000000, 1) . 'B';
        } elseif ($posts_count_total > 1000000) {
            $vars['total_posts'] = round($posts_count_total / 1000000, 1) . 'M';
        } elseif ($posts_count_total > 1000) {
            $vars['total_posts'] = round($posts_count_total / 1000, 1) . 'K';
        } else {
            $vars['total_posts'] = $posts_count_total;
        }

        $pages_count_total = Query::table(Base::table('pages'))
            ->count();

        if ($pages_count_total > 1000000000000) {
            $vars['total_pages'] = round($pages_count_total / 1000000000000, 1) . 'T';
        } elseif ($pages_count_total > 1000000000) {
            $vars['total_pages'] = round($pages_count_total / 1000000000, 1) . 'B';
        } elseif ($pages_count_total > 1000000) {
            $vars['total_pages'] = round($pages_count_total / 1000000, 1) . 'M';
        } elseif ($pages_count_total > 1000) {
            $vars['total_pages'] = round($pages_count_total / 1000, 1) . 'K';
        } else {
            $vars['total_pages'] = $pages_count_total;
        }

        $users_count_total = Query::table(Base::table('users'))
            ->count();

        if ($users_count_total > 1000000000000) {
            $vars['total_users'] = round($users_count_total / 1000000000000, 1) . 'T';
        } elseif ($users_count_total > 1000000000) {
            $vars['total_users'] = round($users_count_total / 1000000000, 1) . 'B';
        } elseif ($users_count_total > 1000000) {
            $vars['total_users'] = round($users_count_total / 1000000, 1) . 'M';
        } elseif ($users_count_total > 1000) {
            $vars['total_users'] = round($users_count_total / 1000, 1) . 'K';
        } else {
            $vars['total_users'] = $users_count_total;
        }

        $visitors_count_total = Query::table(Base::table('visitors'))
            ->count();

        if ($visitors_count_total > 1000000000000) {
            $vars['total_visitors'] = round($visitors_count_total / 1000000000000, 1) . 'T';
        } elseif ($visitors_count_total > 1000000000) {
            $vars['total_visitors'] = round($visitors_count_total / 1000000000, 1) . 'B';
        } elseif ($visitors_count_total > 1000000) {
            $vars['total_visitors'] = round($visitors_count_total / 1000000, 1) . 'M';
        } elseif ($visitors_count_total > 1000) {
            $vars['total_visitors'] = round($visitors_count_total / 1000, 1) . 'K';
        } else {
            $vars['total_visitors'] = $visitors_count_total;
        }


        return View::create('panel', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    Route::post('admin/panel/hide_alert', [
        'before' => 'auth', // Adjust the middleware as needed
        'main'   => function () {
            Session::put('hide_alert', true);
            return Response::json(['success' => true]);
        },
    ]);

});
