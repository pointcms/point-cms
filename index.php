<?php
define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));
define('VERSION', '0.0.2');
define('MIGRATION_NUMBER', 0);

define('PATH', __DIR__ . DS);
define('APP', PATH . 'app' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

/** @noinspection PhpIncludeInspection */
require APP . 'composer_check' . EXT;
/** @noinspection PhpIncludeInspection */
require SYS . 'start' . EXT;
