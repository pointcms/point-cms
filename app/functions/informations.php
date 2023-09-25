<?php

/****************************
 * Theme functions for informations links in footer
 ****************************/

/**
 * Checks whether the informations has any items
 *
 * @return bool
 */
function has_information_items()
{
    return Registry::get('total_information_items');
}

/**
 * information items iterator
 *
 * @return bool
 */
function information_items()
{
    // get all pages in the information
    /** @var \items $pages */
    $pages = Registry::get('information');

    if ($result = $pages->valid()) {
        Registry::set('information_item', $pages->current());

        $pages->next();
    }

    // back to the start
    if ( ! $result) {
        $pages->rewind();
    }

    return $result;
}

/**
 * Retrieves the ID of a information item
 *
 * @param \page|array|null $information_item information item to retrieve an ID for. If no item is passed,
 *                                    will use the current information item
 *
 * @return mixed|null
 */
function information_id($information_item = null)
{
    if (is_array($information_item)) {
        return $information_item['id'];
    }

    return ($information_item ? $information_item->id : Registry::prop('information_item', 'id') );
}

/**
 * Retrieves the URL of a information item
 *
 * @param \page|array|null $information_item information item to retrieve a URL for. If no item is passed,
 *                                    will use the current information item
 *
 * @return string
 * @throws \Exception
 */
function information_url($information_item = null)
{
    if (is_array($information_item)) {
        $information_item = get_information_item('id', $information_item);
    }

    return ($information_item ? $information_item->uri() : Registry::get('information_item')->uri());
}

/**
 * Retrieves the relative information item URL
 *
 * @param \page|array|null $information_item information item to retrieve a URL for. If no item is passed,
 *                                    will use the current information item
 *
 * @return string
 * @throws \Exception
 */
function information_relative_url($information_item = null)
{
    if (is_array($information_item)) {
        $information_item = get_information_item('id', $information_item);
    }

    return ($information_item
        ? $information_item->relative_uri()
        : Registry::get('information_item')->relative_uri()
    );
}

/**
 * Retrieves the name of a information item
 *
 * @param \page|array|null $information_item information item to retrieve a name for. If no item is passed,
 *                                    will use the current information item
 *
 * @return string
 */
function information_name($information_item = null)
{
    if (is_array($information_item)) {
        return $information_item['name'];
    }

    return ($information_item
        ? $information_item->name : Registry::prop('information_item', 'name'));
}

/**
 * Retrieves the title of a information item.
 *
 * @param \page|array|null $information_item information item to retrieve a title for. If no item is passed,
 *                                    will use the current information item
 *
 * @return string
 */
function information_title($information_item = null)
{
    if (is_array($information_item)) {
        return $information_item['title'];
    }

    return ($information_item ? $information_item->title:Registry::prop('information_item', 'title'));
}

