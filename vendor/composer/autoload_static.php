<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit653bda442b4a9d640ed00386a9e049bc
{
    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'vianafgluiz\\Recognition\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'vianafgluiz\\Recognition\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit653bda442b4a9d640ed00386a9e049bc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit653bda442b4a9d640ed00386a9e049bc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
