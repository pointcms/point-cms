<?php

return [
    'url'      => dirname($_SERVER['SCRIPT_NAME']),
    'index'    => 'index.php?route=',
    'timezone' => 'UTC',
    'key'      => hash('md5', 'Blog Installer ' . VERSION),
    'language' => 'en_GB',
    'encoding' => 'UTF-8'
];
