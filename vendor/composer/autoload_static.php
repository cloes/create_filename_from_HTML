<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita437491a4c261b0c8eeb0e8fa054878d
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zend\\Dom\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zend\\Dom\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-dom/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita437491a4c261b0c8eeb0e8fa054878d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita437491a4c261b0c8eeb0e8fa054878d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
