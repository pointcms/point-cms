<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\uri;



Route::collection(['before' => 'auth,csrf,install_exists'], function () {

    // TODO: Unused page parameter, what for?
    Route::get([
        'admin/filemanager',
        'admin/filemanager/(:num)'
    ], function ($page = 1) {
        $vars['token'] = Csrf::token();

        return View::create('filemanager', $vars)
            ->partial('header', 'partials/header')
            ->partial('footer', 'partials/footer');
    });

    /**
     * List Pages
     */
    Route::get([
        'admin/filemanager_list',
        'admin/filemanager_list/(:num)'
    ], function ($page = 1) {
        $vars['token'] = Csrf::token();

        // Define the path to your images directory
        $imageDirectory = 'content/';

         // Get a list of image files in the directory
        $imageFiles = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        // Loop through the image files and generate HTML to display them
        foreach ($imageFiles as $imageFile) {

            $imageURL = Uri::to($imageFile); // Generate URL using Uri::to()
            echo '<div class="col-md-3 col-sm-4 col-6 mb-3 text-center d-flex align-items-stretch"><div class="image-item card" data-image-path="' . $imageURL . '"><img src="' . $imageURL . '" class="card-img-top" alt="Image"></div></div>';
        }

    });

    Route::post('admin/filemanager/delete', function () {
        $imagePath = Input::get('image_path'); // Assuming you're sending the image path as a POST parameter

        // Perform security checks here to ensure authorized access to delete the image.
        // For example, you might check if the user is authenticated and has the necessary permissions.

        // Define the directory where images are stored
        $imageDirectory = 'content/';

        // Construct the full path to the image
        $fullImagePath = $imageDirectory . $imagePath;

        $status = true;

        //delete image from sliders folder
        if (!unlink(PATH.$imagePath)) {
            $status = false;
        }
        unlink(PATH.$imagePath);

       return Response::json([
            'status' => $status
        ]);
    });





});
