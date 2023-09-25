<?php

/********************************
 *  Theme functions for likes
 ********************************/

use System\input;
use System\uri;

function has_likes()
{
    if (!$itm = Registry::get('article')) {
        return false;
    }

    if (!$likes = Registry::get('likes')) {
        $likes = Like::where('post', '=', $itm->id)
            ->get();

        $likes = new Items($likes);

        Registry::set('likes', $likes);
    }

    return $likes->length();
}

function total_likes()
{
    if (!has_likes()) {
        return 0;
    }

    $likes = Registry::get('likes');

    return $likes->length();
}

function hasLiked($article_id) {
    $visitor_ip = visitor_ip();

    // Check if a like record exists for this post and IP
    $like = Query::table(Base::table('likes'))
        ->where('post', '=', $article_id)
        ->where('visitor_ip', '=', $visitor_ip)
        ->get();

    // Return true if a like exists, false otherwise
    return !empty($like);
}



/**
 * Retrieves the comment form action URI
 *
 * @return string
 * @throws \ErrorException
 * @throws \OverflowException
 */
function like_url()
{
    return Uri::to(Uri::current());
}
