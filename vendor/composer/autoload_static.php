<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85bcb2510167cbb4e1f8e8d574dee4b6
{
    public static $files = array (
        '7c9b72b4e40cc7adcca6fd17b1bf4c8d' => __DIR__ . '/..' . '/indigophp/hash-compat/src/hash_equals.php',
        '43d9263e52ab88b5668a28ee36bd4e65' => __DIR__ . '/..' . '/indigophp/hash-compat/src/hash_pbkdf2.php',
        'e40631d46120a9c38ea139981f8dab26' => __DIR__ . '/..' . '/ircmaxell/password-compat/lib/password.php',
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SecurityLib' => 
            array (
                0 => __DIR__ . '/..' . '/ircmaxell/security-lib/lib',
            ),
        ),
        'R' => 
        array (
            'RandomLib' => 
            array (
                0 => __DIR__ . '/..' . '/ircmaxell/random-lib/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit85bcb2510167cbb4e1f8e8d574dee4b6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit85bcb2510167cbb4e1f8e8d574dee4b6::$classMap;

        }, null, ClassLoader::class);
    }
}