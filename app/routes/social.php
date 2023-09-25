<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\view;

Route::collection(['before' => 'auth,install_exists'], function () {

    /**
     * Social links
     */
    Route::get('admin/extend/social', function () {
        $vars = [
            'token' => Csrf::token(),
            'meta' => Config::get('meta')
        ];

        if (Auth::admin()) {
            return View::create('extend/social/edit', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        } else {
            return View::create('error/permission', $vars)
                ->partial('header', 'partials/header')
                ->partial('footer', 'partials/footer');
        }
    });

    /**
     * Update Social Links
     */
    Route::post('admin/extend/social', function () {
        $input = Input::get([
            'facebook',
            'instagram',
            'twitter',
            'youtube',
            'linkedin',
            'pinterest',
            'vkontakte',
            'tumblr'
        ]);

        foreach ($input as $key => $value) {
            $input[$key] = eq($value);
        }

        $validator = new Validator($input);

        $validator->check('email')
                  ->is_max(3, __('metadata.email_missing'));



        if ($errors = $validator->errors()) {
            Input::flash();
            Notify::error($errors);

            return Response::redirect('admin/extend/social');
        }



        foreach ($input as $key => $v) {
            $v = is_null($v) ? 0 : $v;

            Query::table(Base::table('meta'))
                 ->where('key', '=', $key)
                 ->update(['value' => $v]);
        }

        Notify::success(__('social.updated'));

        return Response::redirect('admin/extend/social');
    });
});
