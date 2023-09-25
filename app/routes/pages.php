<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\uri;
use System\view;

Route::collection(['before' => 'auth,csrf,install_exists'], function () {

    /**
     * List Pages
     */
    Route::get([
        'admin/pages',
        'admin/pages/(:num)'
    ], function ($page = 1) {
        $perpage = Config::get('admin.posts_per_page');
        $total = Page::count();
        $url = Uri::to('admin/pages');
        $pages = Page::sort('title')
            ->take($perpage)
            ->skip(($page - 1) * $perpage)
            ->get();

        $pagination = new Paginator($pages, $total, $page, $perpage, $url);

        $vars['pages'] = $pagination;
        $vars['status'] = 'all';

        if (Auth::admin()) {
            return View::create('pages/index', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

    /**
     * List pages by status and paginate through them
     */
    Route::get([
        'admin/pages/status/(:any)',
        'admin/pages/status/(:any)/(:num)'
    ], function ($status, $page = 1) {
        $query = Page::where('status', '=', $status);
        $perpage = Config::get('admin.posts_per_page');
        $total = $query->count();
        $url = Uri::to('admin/pages/status');
        $pages = $query->sort('title')
            ->take($perpage)
            ->skip(($page - 1) * $perpage)
            ->get();

        $pagination = new Paginator($pages, $total, $page, $perpage, $url);

        $vars['pages'] = $pagination;
        $vars['status'] = $status;

        if (Auth::admin()) {
            return View::create('pages/index', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

    /**
     * Edit Page
     */
    Route::get('admin/pages/edit/(:num)', function ($id) {
        $vars['token'] = Csrf::token();
        $vars['deletable'] = (Page::count() > 1) &&
            (Page::posts()->id != $id);

        $vars['page'] = Page::find($id);
        $vars['pages'] = Page::dropdown(['exclude' => [$id], 'show_empty_option' => true]);

        $vars['statuses'] = [
            'published' => __('global.published'),
            'draft' => __('global.draft'),
            'archived' => __('global.archived')
        ];

        if (Auth::admin()) {
            return View::create('pages/edit', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer')
                ->partial('editor', 'partials/editor');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

    Route::post('admin/pages/edit/(:num)', function ($id) {
        $input = Input::get([
            'name',
            'title',
            'slug',
            'description',
            'status',
            'redirect',
            'show_in_menu',
            'show_in_footer'
        ]);

        // if there is no slug try and create one from the title
        if (empty($input['slug'])) {
            $input['slug'] = $input['title'];
        }

        // convert to ascii
        $input['slug'] = slug($input['slug']);

        // an array of items that we shouldn't encode - they're no XSS threat
        $dont_encode = ['description'];

        foreach ($input as $key => &$value) {
            if (in_array($key, $dont_encode)) {
                continue;
            }

            $value = eq($value);
        }

        $validator = new Validator($input);

        $validator->add('duplicate', function ($str) use ($id) {
            return Page::where('slug', '=', $str)
                    ->where('id', '<>', $id)
                    ->count() == 0;
        });

        $validator->check('title')
            ->is_max(3, __('pages.title_missing'));

        $validator->check('slug')
            ->is_max(3, __('pages.slug_missing'))
            ->is_duplicate(__('pages.slug_duplicate'))
            ->not_regex('#^[0-9_-]+$#', __('pages.slug_invalid'));

        if ($input['redirect']) {
            $validator->check('redirect')
                ->is_url(__('pages.redirect_missing'));
        }

        if ($errors = $validator->errors()) {
            Input::flash();

            Notify::error($errors);

            return Response::redirect('admin/pages/edit/' . $id);
        }

        if (empty($input['name'])) {
            $input['name'] = $input['title'];
        }

        // encode title
        $input['title'] = e($input['title'], ENT_COMPAT);
        $input['show_in_menu'] = is_null($input['show_in_menu']) || empty($input['show_in_menu']) ? 0 : 1;
        $input['show_in_footer'] = is_null($input['show_in_footer']) || empty($input['show_in_footer']) ? 0 : 1;

        Page::update($id, $input);

        Notify::success(__('pages.updated'));

        return Response::redirect('admin/pages/edit/' . $id);
    });

    /*
        Add Page
    */
    Route::get('admin/pages/add', function () {
        $vars['token'] = Csrf::token();
        $vars['pages'] = Page::dropdown(['exclude' => [], 'show_empty_option' => true]);

        $vars['statuses'] = [
            'published' => __('global.published'),
            'draft' => __('global.draft'),
            'archived' => __('global.archived')
        ];

        if (Auth::admin()) {
            return View::create('pages/add', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer')
                ->partial('editor', 'partials/editor');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

    Route::post('admin/pages/add', function () {
        $input = Input::get([
            'name',
            'title',
            'slug',
            'description',
            'status',
            'redirect',
            'show_in_menu',
            'show_in_footer'
        ]);

        // if there is no slug try and create one from the title
        if (empty($input['slug'])) {
            $input['slug'] = $input['title'];
        }

        // convert to ascii
        $input['slug'] = slug($input['slug']);

        // an array of items that we shouldn't encode - they're no XSS threat
        $dont_encode = ['description'];


        foreach ($input as $key => &$value) {
            if (in_array($key, $dont_encode)) {
                continue;
            }

            $value = eq($value);
        }

        $validator = new Validator($input);

        $validator->add('duplicate', function ($str) {
            return Page::where('slug', '=', $str)->count() == 0;
        });

        $validator->check('title')
            ->is_max(3, __('pages.title_missing'));

        $validator->check('slug')
            ->is_max(3, __('pages.slug_missing'))
            ->is_duplicate(__('pages.slug_duplicate'))
            ->not_regex('#^[0-9_-]+$#', __('pages.slug_invalid'));

        if ($input['redirect']) {
            $validator->check('redirect')
                ->is_url(__('pages.redirect_missing'));
        }

        if ($errors = $validator->errors()) {
            Input::flash();

            Notify::error($errors);

            return Response::redirect('admin/pages/add');
        }

        if (empty($input['name'])) {
            $input['name'] = $input['title'];
        }

        $input['show_in_menu'] = is_null($input['show_in_menu']) || empty($input['show_in_menu']) ? 0 : 1;
        $input['show_in_footer'] = is_null($input['show_in_footer']) || empty($input['show_in_footer']) ? 0 : 1;

        $page = Page::create($input);
        $id = $page->id;

        return Response::redirect('admin/pages/edit/' . $id);
    });

    /**
     * Delete Page
     */
    Route::get('admin/pages/delete/(:num)', function ($id) {
        if (
            (Page::count() > 1) &&
            (Page::posts()->id != $id)
        ) {
            Page::find($id)->delete();

            Notify::success(__('pages.deleted'));
        } else {
            Notify::error('Unable to delete page. The target must not be a posts page.');
        }

        return Response::redirect('admin/pages');
    });
});
