<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7231a4c80e74d6a55d005e49be962df
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7231a4c80e74d6a55d005e49be962df::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7231a4c80e74d6a55d005e49be962df::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc7231a4c80e74d6a55d005e49be962df::$classMap;

        }, null, ClassLoader::class);
    }
}