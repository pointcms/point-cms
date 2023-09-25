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
        'admin/search',
        'admin/search/(:any)',
        'admin/search/(:any)/(:any)',
        'admin/search/(:any)/(:any)/(:num)'
    ],
        function ($whatSearching = 'all', $slug = '', $offset = 1) {
            $vars['token'] = Csrf::token();

            // mock search page
            $page = new Page();
            $page->id = 0;
            $page->title = 'Search';
            $page->slug = 'search';

            if ($offset <= 0) {
                return Response::create(new Template('404'), 404);
            }

            // Convert custom escaped characters and escape MySQL special characters.
            // http://stackoverflow.com/questions/712580/list-of-special-characters-for-sql-like-clause
            $term = str_replace(
                ['-sl-', '-bsl-', '-sp-', '%', '_'],
                ['/', '\\\\', ' ', '\\%', '\\_'],
                $slug
            );

            // Posts, pages, or all
            if ($whatSearching === 'posts') {
                list($total, $results) = Post::search($term, $offset, Post::perPage());
            } elseif ($whatSearching === 'pages') {
                list($total, $results) = Page::search($term, $offset);
            } elseif ($whatSearching === 'categories') {
                list($total, $results) = Category::search($term, $offset);
            } elseif ($whatSearching === 'users') {
                list($total, $results) = User::search($term, $offset);
            } else {
                $postResults = Post::search($term, $offset, Post::perPage());
                $pageResults = Page::search($term, $offset);
                $categoryResults = Category::search($term, $offset);
                $userResults = User::search($term, $offset);
                $total = $postResults[0] + $pageResults[0] + $categoryResults[0] + $userResults[0];
                $results = array_merge($postResults[1], $pageResults[1], $categoryResults[1],$userResults[1]);
            }

            // search templating vars
            $safeTerm = eq(str_replace(
                ['\\\\', '\\%', '\\_'],
                ['\\', '%', '_'],
                $term
            ));

            Registry::set('page', $page);
            Registry::set('page_offset', $offset);
            Registry::set('search_term', $safeTerm);
            Registry::set('search_results', new Items($results));
            Registry::set('total_posts', $total);


        return View::create('search', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    Route::post('admin/search', function () {

        // Search term, placeholders for / and \
        $term = str_replace(
            ['/', '\\', ' '],
            ['-sl-', '-bsl-', '-sp-'],
            Input::get('term', '')
        );
        $term = rawurlencode($term);

        // Get what we are searching for
        $whatSearch = Input::get('whatSearch', '');

        // clamp the choices
        switch ($whatSearch) {
            case 'posts':
                break;
            case 'pages':
                break;
            case 'categories':
                break;
            case 'users':
                break;
            default:
                $whatSearch = 'all';
                break;
        }

        return Response::redirect('admin/search/' . $whatSearch . '/' . $term);
    });

});