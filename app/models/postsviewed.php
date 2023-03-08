<?php

use System\database\query;
use System\uri;


/**
 * Post Viewed  class
 */
class PostsViewed extends Base
{
    public static $table = 'posts';

    /**
     * Retrieves an post by ID
     *
     * @param int $id online ID
     *
     * @return \viewed
     * @throws \Exception
     */
    public static function id($id)
    {
        return static::get('id', $id);

    }

    /**
     * Retrieves all post viewed
     *
     * @param string     $row online visitors row name to compare in
     * @param string|int $val online visitors value to compare to
     *
     * @return \stdClass
     * @throws \Exception
     */
    private static function get()
    {
        return Base::table('posts');

    }

    /**
     * Paginates post viewed results
     *
     * @param int $page    page offset
     * @param int $perpage page limit
     *
     * @return \Paginator
     * @throws \ErrorException
     * @throws \Exception
     */
    public static function paginate($page = 1, $perpage = 10)
    {
        $query   = Query::table(static::table());
        $count   = $query->count();
        $results = $query->take($perpage)->skip(($page - 1) * $perpage)->sort('viewed', 'desc')->get();

        return new Paginator($results, $count, $page, $perpage, Uri::to('admin/reports/posts_viewed'));
    }

}
