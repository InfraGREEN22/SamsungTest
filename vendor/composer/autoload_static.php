<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9ae7489ed0d9a7c9458e2b847ee4f1e
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rooxie\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rooxie\\' => 
        array (
            0 => __DIR__ . '/..' . '/rooxie/omdb/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9ae7489ed0d9a7c9458e2b847ee4f1e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9ae7489ed0d9a7c9458e2b847ee4f1e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
