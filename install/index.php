<?php

define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));
define('VERSION', '0.0.1');

define('PATH', dirname(__DIR__) . DS);
define('APP', PATH . 'install' . DS);
define('SYS', PATH . 'system' . DS);
define('EXT', '.php');

/** @noinspection PhpIncludeInspection */
require SYS . 'start' . EXT;
