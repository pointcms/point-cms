<?php

use System\config;
use System\input;
use System\uri;
use System\database\query;

/**
 * Checks whether there are any search results
 *
 * @return bool
 */
function admin_has_search_results()
{
    return Registry::get('total_posts', 0) > 0;
}

/**
 * Retrieves the total number of search results
 *
 * @return int
 */
function admin_total_search_results()
{
    return Registry::get('total_posts', 0);
}

/**
 * Loops through the search results
 *
 * @return bool
 */
function admin_search_results()
{
    /** @var \items $posts */
    $posts = Registry::get('search_results');

    if ($result = $posts->valid()) {

        // register single post
        Registry::set('admin_search_item', $posts->current());

        // move to next
        $posts->next();
    }

    return $result;
}

/**
 * Retrieves the search term
 *
 * @return string
 */
function admin_search_term()
{
    return Registry::get('search_term');
}

/**
 * Checks whether the search results are paginated
 *
 * @return bool
 */
function admin_has_search_pagination()
{
    return Registry::get('total_posts') > Config::meta('posts_per_page');
}

function admin_search_pagination()
{
    $total    = Registry::get('total_posts');
    $offset   = Registry::get('page_offset');
    $per_page = Config::get('admin.posts_per_page');
    $term        = Registry::get('search_term');

    Session::put(slug($term), $term);

    $url      = Uri::to('admin/search/all/' . $term . '/' );

    $pagination = new Paginator([], $total, $offset, $per_page, $url);

    return $pagination->links();
}
/**
 * Retrieves the search URL
 *
 * @return string
 */
function admin_search_url()
{
    return uri::to('admin/search');
}

/**
 * Generates the search input field
 *
 * @param string $extra (optional) additional HTML attributes for the input tag
 *
 * @return string
 */
function admin_search_form_input($extra = '')
{
    return '<input name="term" type="text" ' . $extra . ' value="' . admin_search_term() . '">';
}

/**
 * Get the search item object from the registry.
 *
 * @return Object
 */
function admin_search_item()
{
    return Registry::get('admin_search_item');
}

/**
 * Retrieves the search item type (post/page/other)
 *
 * @return string
 */
function admin_search_item_type()
{
    $item_class = strtolower(get_class(admin_search_item()));
    if ($item_class == 'page') {
        return 'page';
    } elseif ($item_class == 'post') {
        return 'post';
    } elseif ($item_class == 'category') {
        return 'category';
    } elseif ($item_class == 'user') {
        return 'user';
    } else {
        return 'unknown';
    }
}

/**
 * Retrieves the current search item ID
 *
 * @return int
 */
function admin_search_item_id()
{
    $item = admin_search_item();

    if ($item) {
        return $item->id;
    }
}

/**
 * Retrieves the current search item title
 *
 * @return string
 */
function admin_search_item_title()
{
    $item = admin_search_item();

    if ($item) {
        // Check if the current search item is a user
        if (admin_search_item_type() === 'user') {
            return $item->real_name;
        } else {
            return $item->title;
        }
    }
}

function admin_search_item_html()
{
    $item = admin_search_item();

    if ($item) {
        return $item->html;
    }
}
/**
 * Retrieves the current search item name
 *
 * @return string
 */
function admin_search_item_name()
{
    $item = admin_search_item();

    if ($item) {
        return $item->name;
    }
}
/**
 * Retrieves the current search item name
 *
 * @return string
 */
function admin_search_item_real_name()
{
    $item = admin_search_item();

    if ($item) {
        return $item->real_name;
    }
}
/**
 * Retrieves the current search item slug
 *
 * @return string
 */
function admin_search_item_slug()
{
    $item = admin_search_item();

    if ($item) {
        return $item->slug;
    }
}

/**
 * Retrieves the current search item URL
 *
 * @return string
 */
function admin_search_item_url()
{
    $item = admin_search_item();
    $type = admin_search_item_type();

    if ($type == 'page') {
        $page = Page::slug(admin_search_item_slug());
        return Uri::to('/admin/pages/edit/' . $page->id);
    }

    if ($type == 'post') {
        $post = Post::slug(admin_search_item_slug());
        return  Uri::to('admin/posts/edit' . '/' .$post->id);
    }
    if ($type == 'category') {
        $category = Category::slug(admin_search_item_slug());
        return  Uri::to('admin/categories/edit' . '/' .$category->id);
    }
    if ($type == 'user') {
       $user = User::where('real_name', '=', admin_search_item_real_name())->fetch();
       return  Uri::to('admin/users/edit' . '/' .$user->id);

    }
}

function admin_search_item_cat()
{
    $type = admin_search_item_type();

    if ($type == 'page') {
        $page = "Page";
        return $page;
    }
    if ($type == 'post') {
        $post = "Post";
        return $post;
    }
    if ($type == 'category') {
        $category = "Category";
        return $category;
    }
    if ($type == 'user') {
        $user = "User";
        return $user;
    }
}