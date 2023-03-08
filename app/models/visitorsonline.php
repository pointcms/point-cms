<?php

use System\database\query;
use System\uri;


/**
 * Visitors statistics class
 */
class VisitorsOnline extends Base
{
    public static $table = 'visitors_online';

    /**
     * Retrieves an online by ID
     *
     * @param int $id online ID
     *
     * @return \online
     * @throws \Exception
     */
    public static function id($id)
    {
        return static::get('id', $id);

    }

    /**
     * Retrieves all visitors statistics
     *
     * @param string     $row  visitors statistics row name to compare in
     * @param string|int $val  visitors statistics value to compare to
     *
     * @return \stdClass
     * @throws \Exception
     */
    private static function get()
    {
        return Base::table('visitors_online');

    }

    /**
     * Paginates visitors statistics results
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
        $results = $query->take($perpage)->skip(($page - 1) * $perpage)->sort('date', 'desc')->get();

        return new Paginator($results, $count, $page, $perpage, Uri::to('admin/reports/visitors_online'));
    }

}
