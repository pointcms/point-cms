<?php

use System\config;
use System\database\query;
use System\input;
use System\route;
use System\uri;

Route::collection(['before' => 'auth,install_exists'], function () {

    Route::get('admin/notification/newcomments', function () {

        $lastCheckTimestamp = strtotime('-1 day'); // Example: One day ago

        // Retrieve new pending and spam comments
        $newComments = Query::table(Base::table('comments'))
            ->where('status', '=', 'pending')
            ->or_where('status','=', 'spam')
            ->where('date', '>', $lastCheckTimestamp) // Use the last check timestamp to filter new comments
            ->get();

        // Prepare an array with new comment data
        $commentsData = [];
        foreach ($newComments as $comment) {
            $commentsData[] = [
                'name' => $comment->name,
                'text' => $comment->text,
                'status' => $comment->status,
            ];
        }

        // Return new pending and spam comments as JSON response
        return Response::json(['newComments' => $commentsData]);
    });

});