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


        $perpage = Config::get('admin.posts_per_page');
        $total = Query::table(Base::table('posts'))
            ->where('author', '=', $user_id)
            ->count();
        $url = Uri::to('admin/panel');
        $posts = Post::sort('created', 'desc')
            ->where('status', '=', 'published')
            ->where('viewed', '>', '0')
            ->where('author', '=', $user_id)
            ->skip(($page - 1) * $perpage)
            ->take($perpage)
            ->get();

        $pagination = new Paginator($posts, $total, $page, $perpage, $url);

        $vars['posts'] = $pagination;

        return View::create('panel', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

});
