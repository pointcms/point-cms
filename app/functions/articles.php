<?php

/*******************************
 * Theme functions for articles
 *******************************/

/**
 * Grab the ID of the current article
 *
 * @return int article ID
 */
function article_id()
{
    return Registry::prop('article', 'id');
}

/**
 * Return the number of the article
 *
 * @return int article number
 * @throws \Exception
 */
function article_number()
{
    return Post::where(Base::table('posts.status'), '=', 'published')
        ->where(Base::table('posts.id'), '<=', article_id())
        ->count();
}

/**
 * Get the article title
 *
 * @return string article title
 */
function article_title()
{
    return Registry::prop('article', 'title');
}

/**
 * Get the article slug
 *
 * @return string article slug
 */
function article_slug()
{
    return Registry::prop('article', 'slug');
}

/**
 * Get the URL to the previous article
 *
 * @param boolean $draft (optional) whether to include drafted articles
 * @param boolean $archive (optional) whether to include archived articles
 *
 * @return string
 * @throws \Exception
 */
function article_previous_url($draft = false, $archive = false)
{
    return article_adjacent_url('previous', $draft, $archive);
}

/**
 * Get the URL to the next article
 *
 * @param boolean $draft (optional) whether to include drafted articles
 * @param boolean $archive (optional) whether to include archived articles
 *
 * @return string
 * @throws \Exception
 */
function article_next_url($draft = false, $archive = false)
{
    return article_adjacent_url('next', $draft, $archive);
}

/**
 * Get the URL of the current article
 *
 * @return string current article URL
 */
function article_url()
{
    $page = Registry::get('posts_page');

    return base_url($page->slug . '/' . article_slug());
}

/**
 * Get the article description
 *
 * @return string article description
 */
function article_description()
{
    return html_entity_decode(Registry::prop('article', 'description'));
}

function article_image()
{
    $hasimage = Registry::prop('article', 'image');
    if ($hasimage) {
        $image = base_url($hasimage);
    } else {
        $image = base_url('assets/img/no_img.png');
    }
    return $image;
}

function generateVideoIframe($link)
{
    if (strpos($link, 'youtube.com') !== false || strpos($link, 'youtu.be') !== false) {
        // YouTube video
        $videoId = getYouTubeVideoId($link);
        return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
    } elseif (strpos($link, 'vimeo.com') !== false) {
        // Vimeo video
        $videoId = getVimeoVideoId($link);
        return '<iframe src="https://player.vimeo.com/video/' . $videoId . '" width="560" height="315" frameborder="0" allowfullscreen></iframe>';
    } else {
        return 'Unsupported video link';
    }
}

function article_videolink()
{
    $url = Registry::prop('article', 'videolink');

    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        $videoId = null;

        if (strpos($url, 'youtube.com') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $query); // Extract the query parameters
            $videoId = $query['v']; // Get the 'v' parameter from the query string
        } elseif (strpos($url, 'youtu.be') !== false) {
            $path = parse_url($url, PHP_URL_PATH); // Extract the path
            $videoId = trim($path, '/'); // Remove any slashes from the extracted path
        }
        return '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe></div>';

    } elseif (strpos($url, 'vimeo.com') !== false) {
        $videoId = trim(parse_url($url, PHP_URL_PATH), '/'); // Extracts the path and removes leading and trailing slashes
        return '<div class="ratio ratio-16x9"><iframe src="https://player.vimeo.com/video/' . $videoId . '" frameborder="0" allowfullscreen></iframe></div>';

    }
}

/**
 * Grab the time the article was created
 *
 * @return string article creation timestamp
 */
function article_time()
{
    if ($created = Registry::prop('article', 'created')) {
        return Date::format($created, 'U');
    }
}

/**
 * Grab the date the article was created
 *
 * @return string article creation date
 */
function article_date()
{
    if ($created = Registry::prop('article', 'created')) {
        return Date::format($created);
    }
}

/**
 * Grab the current status of the article
 *
 * @return string article status
 */
function article_status()
{
    return Registry::prop('article', 'status');
}

/**
 * Get the name of the category this article belongs to
 *
 * @return string article category title
 */
function article_category()
{
    if ($category = Registry::prop('article', 'category')) {
        $categories = Registry::get('all_categories');

        return $categories[$category]->title;
    }
}

/**
 * Get the name of the category this article belongs to
 *
 * @return string article category title
 */
function article_category_description()
{
    if ($category = Registry::prop('article', 'category')) {
        $categories = Registry::get('all_categories');

        return $categories[$category]->description;
    }
}

/**
 * Get the slug of the category this article belongs to
 *
 * @return string article category slug
 */
function article_category_slug()
{
    if ($category = Registry::prop('article', 'category')) {
        $categories = Registry::get('all_categories');

        return $categories[$category]->slug;
    }
}

/**
 * Get the URL of the category this article belongs to
 *
 * @return string article category URL
 */
function article_category_url()
{
    if ($category = Registry::prop('article', 'category')) {
        $categories = Registry::get('all_categories');

        return base_url('category/' . $categories[$category]->slug);
    }
}

/**
 * Get the number of comments for this article
 *
 * @return int number of article comments
 */
function article_total_comments()
{
    return Registry::prop('article', 'total_comments');
}

/**
 * Get the author of this article
 *
 * @return string article author name
 */
function article_author()
{
    return Registry::prop('article', 'author_name');
}

/**
 * Get the author avatar of this article
 *
 * @return string article author avatar
 */
function article_author_avatar()
{
    $hasimage = Registry::prop('article', 'author_avatar');
    if ($hasimage) {
        $image = base_url($hasimage);
    } else {
        $image = base_url('assets/img/no_img.png');
    }
    return $image;
}

/**
 * Get the ID of the article author
 *
 * @return int article author ID
 */
function article_author_id()
{
    return Registry::prop('article', 'author_id');
}

/**
 * Get the authors bio
 *
 * @return string article author bio
 */
function article_author_bio()
{
    return Registry::prop('article', 'author_bio');
}

/**
 * Get the authors email
 *
 * @return string article author email
 */
function article_author_email()
{
    return Registry::prop('article', 'author_email');
}

/**
 * Get the article as an object
 *
 * @return object
 */
function article_object()
{
    return Registry::get('article');
}

/**
 * Get the URL to an adjacent article
 *
 * @param string $side (optional) one of prev, previous or next
 * @param boolean $draft (optional) whether to include drafted articles
 * @param boolean $archived (optional) whether to include archived articles
 *
 * @return string adjacent article URL
 * @throws \Exception
 */
function article_adjacent_url($side = 'next', $draft = false, $archived = false)
{
    $comparison = '>';
    $order = 'asc';

    if (strtolower($side) == 'prev' || strtolower($side) == 'previous') {
        $comparison = '<';
        $order = 'desc';
    }

    $page = Registry::get('posts_page');

    /** @var \System\database\query $query */
    $query = Post::where('created', $comparison, Registry::prop('article', 'created'));

    if (!$draft) {
        $query = $query->where('status', '!=', 'draft');
    }
    if (!$archived) {
        $query = $query->where('status', '!=', 'archived');
    }

    if ($query->count()) {
        $article = $query->sort('created', $order)->fetch();
        $page = Registry::get('posts_page');

        return base_url($page->slug . '/' . $article->slug);
    }
}

/**
 * Retrieves a list of related articles
 *
 * @param int $n number of articles desired
 *
 * @return array related articles
 * @throws \Exception
 */
function related_posts($n)
{
    $posts = Post::get(Base::table('posts'), '=', 'published');
    $postArr = [];

    foreach ($posts as $post) :
        if ($post->id != article_id()) {
            if ($post->category == article_category_id()) {
                array_push($postArr, $post);
            }
        }
    endforeach;

    shuffle($postArr);

    $postArr = array_slice($postArr, 0, $n);

    return $postArr;
}

/**
 * Retrieves the article category ID
 *
 * @return string
 */
function article_category_id()
{
    if ($category = Registry::prop('article', 'category')) {
        $categories = Registry::get('all_categories');

        return $categories[$category]->id;
    }
}

/**
 * Get the article description
 *
 * @return string article description
 */
function readingTime()
{
    $word = str_word_count(strip_tags(article_description()));
    $m = floor($word / 200);

    if (!$m) {
        return 'less than a minute';
    }

    $est = $m . ' minute' . ($m == 1 ? '' : 's');

    return $est;
}