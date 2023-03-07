<?php

/****************************
 * Theme functions for menus
 ****************************/

/**
 * Checks whether the menu has any items
 *
 * @return bool
 */
function has_menu_items()
{
    return Registry::get('total_menu_items');
}

/**
 * Menu items iterator
 *
 * @return bool
 */
function menu_items()
{
    // get all pages in the menu
    /** @var \items $pages */
    $pages = Registry::get('menu');

    if ($result = $pages->valid()) {
        Registry::set('menu_item', $pages->current());

        $pages->next();
    }

    // back to the start
    if ( ! $result) {
        $pages->rewind();
    }

    return $result;
}

/**
 * Retrieves the ID of a menu item
 *
 * @param \page|array|null $menu_item menu item to retrieve an ID for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return mixed|null
 */
function menu_id($menu_item = null)
{
    if (is_array($menu_item)) {
        return $menu_item['id'];
    }

    return ($menu_item
        ? $menu_item->id
        : Registry::prop('menu_item', 'id')
    );
}

/**
 * Retrieves the URL of a menu item
 *
 * @param \page|array|null $menu_item menu item to retrieve a URL for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return string
 * @throws \Exception
 */
function menu_url($menu_item = null)
{
    if (is_array($menu_item)) {
        $menu_item = get_menu_item('id', $menu_item);
    }

    return ($menu_item ? $menu_item->uri() : Registry::get('menu_item')->uri());
}

/**
 * Retrieves the relative menu item URL
 *
 * @param \page|array|null $menu_item menu item to retrieve a URL for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return string
 * @throws \Exception
 */
function menu_relative_url($menu_item = null)
{
    if (is_array($menu_item)) {
        $menu_item = get_menu_item('id', $menu_item);
    }

    return ($menu_item ? $menu_item->relative_uri() : Registry::get('menu_item')->relative_uri());
}

/**
 * Retrieves the name of a menu item
 *
 * @param \page|array|null $menu_item menu item to retrieve a name for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return string
 */
function menu_name($menu_item = null)
{
    if (is_array($menu_item)) {
        return $menu_item['name'];
    }

    return ($menu_item ? $menu_item->name : Registry::prop('menu_item', 'name'));
}

/**
 * Retrieves the title of a menu item.
 *
 * @param \page|array|null $menu_item menu item to retrieve a title for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return string
 */
function menu_title($menu_item = null)
{
    if (is_array($menu_item)) {
        return $menu_item['title'];
    }

    return ($menu_item
        ? $menu_item->title : Registry::prop('menu_item', 'title'));
}

/**
 * Checks whether a menu item is active
 *
 * @param \page|array|null $menu_item menu item to check status for. If no item is passed,
 *                                    will use the current menu item
 *
 * @return bool
 */
function menu_active($menu_item = null)
{
    if (is_array($menu_item)) {
        $menu_item = get_menu_item('id', $menu_item);
    }

    return ($menu_item ? $menu_item->active() : Registry::get('menu_item')->active());
}


