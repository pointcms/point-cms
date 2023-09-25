<?php

use System\database\query;
use System\uri;

/**
 * user class
 */
class user extends Base
{
    public static $table = 'users';

    /**
     * Searches for users
     *
     * @param array $params search parameters
     *
     * @return \stdClass
     * @throws \Exception
     */
    public static function search($term, $pageNum = 1, $per_page = 10)
    {
        $query = static::where(Base::table('users.status'), '=', 'active')
            ->where(Base::table('users.real_name'), 'like', '%' . $term . '%');
           // ->or_where(Base::table('users.bio'), 'like', '%' . $term . '%'); // This could cause problems?

        $total = $query->count();
        $users = $query->take($per_page)
            ->skip(--$pageNum * $per_page)
            ->get([Base::table('users.*')]);

        foreach ($users as $key => $user) {
            if ($user->data['status'] !== 'active') {
                unset($users[$key]);
            }
        }

        if (count($users) < 1) {
            $total = 0;
        }

        return [$total, $users];
    }

    /**
     * Paginates the user list
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
        $results = $query
            ->take($perpage)
            ->skip(($page - 1) * $perpage)
            ->sort('real_name', 'desc')
            ->get();

        return new Paginator($results, $count, $page, $perpage, Uri::to('admin/users'));
    }
}
