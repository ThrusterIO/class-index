<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a7f56d21c8a07eee63a519cc1472e0c
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Foo\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Foo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9a7f56d21c8a07eee63a519cc1472e0c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9a7f56d21c8a07eee63a519cc1472e0c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
