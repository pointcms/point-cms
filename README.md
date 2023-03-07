# Point CMS

Point is a super-simple, lightweight blog system, made to let you just write. [Check out the site](http://point.pixel.com.ro/) or checkout the [documentation here](http://point.pixel.com.ro/docs).

## Requirements

- PHP 8.0+
    - curl
    - gd
    - pdo\_mysql or pdo\_sqlite
- MySQL 7.4 + recommended

To determine your PHP version, create a new file with this PHP code: `<?php echo PHP_VERSION; ?>// version.php` or run `php -v` in the command line. This will print your version number to the screen.

## Installation

1. Ensure that you have the required components.
2. Download the blog script either from [here](https://github.com/pointcms/point-cms/releases), by cloning this Github repo or by running:
```
composer create-project pointcms/point-cms point
```
3. Upload Point through FTP/SFTP or whatever upload method you prefer to the public-facing directory of your site.
4. Ensure that the permissions for the `content` and `app/config` folders are set to `0775` and that all files belong to the web user or is a part of the same group as the web user.
5. Create a database for Point to install to. You may name it anything you like. The method for database creation varies depending on your webhost but may require using PHPMyAdmin or Sequel Pro. If you are unsure of how to create this, ask your host.
6. Navigate your browser to your Point installation URL, if you have placed Point in a sub directory make sure you append the folder name to the URL: `http://MYDOMAINNAME.com/point`
7. Follow the installer instructions.
8. For security purposes, delete the `install` directory when you are done.

## Problems?

If you can't install Point, check the [github](https://github.com/pointcms/point-cms/); there's probably someone there who's had the same problem as you, and the community is always happy to help. Additionally, check out the [documentation](http://point.pixel.com.ro/docs).

## Contributing

If you'd like to help out and contribute to this project, please take a look at the [contributing guidelines](https://github.com/pointcms/point-cms/blob/master/.github/CONTRIBUTING.md). All information you need to get started should be included in there. If you have any questions then create an issue, make a forum post or message us directly.


> This project is based on **[Anchor CMS](https://github.com/anchorcms/anchor-cms)**
> .The illustrations used in this project are made by [illu station](https://themeisle.com/illustrations/)
