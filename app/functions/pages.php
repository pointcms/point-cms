<?php

/*****************************
 *  Theme functions for pages
 *****************************/

use System\config;

/**
 * Retrieves the current page ID
 *
 * @param \page|array|null $page_item
 *
 * @return mixed|null
 */
function page_id($page_item = null)
{
    if (is_array($page_item)) {
        return $page_item['id'];
    }

    return ($page_item ? $page_item->id : Registry::prop('page', 'id'));
}

/**
 * Retrieves the URL of a page
 *
 * @param \page|array|null $page_item page to retrieve the URL from
 *
 * @return string
 * @throws \Exception
 */
function page_url($page_item = null)
{
    return ($page_item
        ? $page_item->uri()
        : Registry::get('page')->uri()
    );
}

/**
 * Retrieves the slug of a page
 *
 * @param \page|array|null $page_item page to retrieve the slug from
 *
 * @return string
 */
function page_slug($page_item = null)
{
    if (is_array($page_item)) {
        return $page_item['slug'];
    }

    return ($page_item
        ? $page_item->slug
        : Registry::prop('page', 'slug')
    );
}

/**
 * Retrieves the name of a page
 *
 * @param \page|array|null $page_item page to retrieve the name from
 *
 * @return string
 */
function page_name($page_item = null)
{
    if (is_array($page_item)) {
        return $page_item['name'];
    }

    return ($page_item
        ? $page_item->name
        : Registry::prop('page', 'name')
    );
}

/**
 * Retrieves the title of the current page page
 *
 * @param string $default fallback value for missing titles
 *
 * @return string title if found, default if given, empty string otherwise
 */
function page_title($default = '')
{
    if ($title = Registry::prop('article', 'title')) {
        return $title;
    }

    if ($title = Registry::prop('page', 'title')) {
        return $title;
    }

    return $default;
}

/**
 * Retrieves the content of a page
 *
 * @param \page|array|null $page_item (optional) page to retrieve content from
 *
 * @return string
 */
function page_content($page_item = null)
{
    if (is_array($page_item)) {
        return $page_item['description'];
    }

    return ($page_item  ? $page_item->html : Registry::prop('page', 'description'));
}

/**
 * Retrieves the status of a page
 *
 * @param \page|array|null $page_item page to retrieve the status from
 *
 * @return bool
 */
function page_status($page_item = null)
{
    if (is_array($page_item)) {
        return $page_item['status'];
    }

    return ($page_item
        ? $page_item->status
        : Registry::prop('page', 'status')
    );
}

/**
 * Retrieves the current page description
 *
 * @param string $default (optional) default for missing description
 *
 * @return string description if available, default if given, empty string otherwise
 */
function page_description($default = '')
{
    if ($title = Registry::prop('article', 'meta_description')) {
        return $title;
    }

    if ($title = Config::meta('meta_description')) {
        return $title;
    }

    return $default;
}
