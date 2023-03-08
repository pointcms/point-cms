<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\view;

Route::collection(['before' => 'auth,csrf,install_exists'], function () {

    /**
     * List users
     */
    Route::get([
        'admin/users',
        'admin/users/(:num)'
    ], function ($page = 1) {
        $vars['users'] = User::paginate($page, Config::get('admin.posts_per_page'));

        return View::create('users/index', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    /**
     * Edit user
     */
    Route::get('admin/users/edit/(:num)', function ($id) {

        $vars['token'] = Csrf::token();
        $vars['user'] = User::find($id);

        $vars['statuses'] = [
            'inactive' => __('global.inactive'),
            'active' => __('global.active')
        ];
        $vars['roles'] = [
            'administrator' => __('global.administrator'),
            'editor' => __('global.editor'),
            'contributor' => __('global.contributor')
        ];

        $vars['posts_count'] = Query::table(Base::table('posts'))
            ->where('author', '=', $id)
            ->count();


        return View::create('users/edit', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    Route::post('admin/users/edit/(:num)', function ($id) {
        $input = Input::get([
            'username',
            'email',
            'real_name',
            'bio',
            'image',
            'role',
            'status'
        ]);


        $password_reset = false;

        if (Auth::user()->role == 'administrator' && Auth::user()->id == $id) {
            $input['role'] = 'administrator';
        } elseif (Auth::user()->role == 'editor') {
            $input['role'] = 'editor';
        } elseif (Auth::user()->role == 'contributor') {
            $input['role'] = 'contributor';
        }


        // A little higher to avoid messing with the password
        foreach ($input as $key => &$value) {
            $value = eq($value);
        }

        if ($password = Input::get('password')) {
            $input['password'] = $password;
            $password_reset = true;
        }

        $validator = new Validator($input);

        $validator->add('safe', function ($str) use ($id) {
            return ($str != 'inactive' and Auth::user()->id == $id);
        });

        $validator->check('username')
            ->is_max(2, __('users.username_missing', 2));

        $validator->check('email')
            ->is_email(__('users.email_missing'));

        if ($password_reset) {
            $validator->check('password')
                ->is_max(6, __('users.password_too_short', 6));
        }

        if ($errors = $validator->errors()) {
            Input::flash();
            Notify::error($errors);

            return Response::redirect('admin/users/edit/' . $id);
        }

        if ($password_reset) {
            $input['password'] = Hash::make($input['password']);
        }

        User::update($id, $input);

        Notify::success(__('users.updated'));

        return Response::redirect('admin/users/edit/' . $id);
    });

    /**
     * Add user
     */
    Route::get('admin/users/add', function () {

        $vars['token'] = Csrf::token();

        $vars['statuses'] = [
            'inactive' => __('global.inactive'),
            'active' => __('global.active')
        ];

        $vars['roles'] = [
            'administrator' => __('global.administrator'),
            'editor' => __('global.editor'),
            'contributor' => __('global.contributor')
        ];

        return View::create('users/add', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    Route::post('admin/users/add', function () {
        $input = Input::get([
            'username',
            'email',
            'real_name',
            'password',
            'bio',
            'status',
            'role'
        ]);


        foreach ($input as $key => &$value) {
            if ($key === 'password') {
                continue;
            }

            // Can't avoid, so skip.
            $value = eq($value);
        }

        $validator = new Validator($input);

        $validator->check('username')
            ->is_max(3, __('users.username_missing', 2));

        $validator->check('email')
            ->is_email(__('users.email_missing'));

        $validator->check('password')
            ->is_max(6, __('users.password_too_short', 6));

        if ($errors = $validator->errors()) {
            Input::flash();
            Notify::error($errors);

            return Response::redirect('admin/users/add');
        }

        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        Notify::success(__('users.created'));

        return Response::redirect('admin/users');
    });

    /**
     * Delete user
     */
    Route::get('admin/users/delete/(:num)', function ($id) {
        $self = Auth::user();

        if ($self->id == $id) {
            Notify::error(__('users.delete_error'));

            return Response::redirect('admin/users/edit/' . $id);
        }

        $user = Query::table(User::table())
            ->where('id', '=', $id)
            ->fetch();

        User::where('id', '=', $id)->delete();

        $image = $user->image;

        if (isset($image) and strlen($image)) {
            //delete image from content folder
            $resource = PATH . $image;
            file_exists($resource) and unlink(PATH . $image);
        }

        Notify::success(__('users.deleted'));

        return Response::redirect('admin/users');
    });
});
