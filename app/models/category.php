<?php

use System\database\query;
use System\uri;

/**
 * category class
 */
class category extends Base
{
    public static $table = 'categories';

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

        foreach ($query->sort('title')->get() as $item) {
            $items[$item->id] = $item->title;
        }

        return $items;
    }

    /**
     * Retrieves a category by slug
     *
     * @param string $slug
     *
     * @return \stdClass
     * @throws \Exception
     */
    public static function slug($slug)
    {
        return static::where('slug', '=', $slug)->fetch();
    }

    /**
     * Paginates category results
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
        $results = $query->take($perpage)->skip(($page - 1) * $perpage)->sort('title')->get();

        return new Paginator($results, $count, $page, $perpage, Uri::to('admin/categories'));
    }

    /**
     * Searches for categories
     *
     * @param string $term     search term
     * @param int    $pageNum  (optional) page offset
     * @param int    $per_page (optional) page limit
     *
     * @return array
     * @throws \Exception
     */
    public static function search($term, $pageNum = 1, $per_page = 10)
    {
        $query = static:: where(Base::table('categories.title'), 'like', '%' . $term . '%')
        ->or_where(Base::table('categories.description'), 'like', '%' . $term . '%'); // This could cause problems?

        $total = $query->count();
        $categories = $query->take($per_page)
            ->skip(--$pageNum * $per_page)
            ->get([Base::table('categories.*')]);


        if (count($categories) < 1) {
            $total = 0;
        }

        return [$total, $categories];
    }

}
