<?php

use System\database\query;
use System\uri;

/**
 * category class
 */
class images extends Base
{
    public static $table = 'images';

    /**
     * Retrieves a list of categories
     *
     * @return array
     * @throws \ErrorException
     * @throws \Exception
     */
    public static function dropdown()
    {
        $items = [];
        $query = Query::table(static::table());

        foreach ($query->sort('date')->get() as $item) {
            $items[$item->id] = $item->title;
        }

        return $items;
    }


    /**
     * Paginates images results
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
        $results = $query->take($perpage)->skip(($page - 1) * $perpage)->sort('date')->get();

        return new Paginator($results, $count, $page, $perpage, Uri::to('admin/filemanager'));
    }
}
