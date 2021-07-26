<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85404b4ff121be3da6cb3338bd6ca126
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpKit\\ExtPDO\\' => 14,
        ),
        'I' => 
        array (
            'Interfaces\\' => 11,
        ),
        'G' => 
        array (
            'Game\\' => 5,
        ),
        'F' => 
        array (
            'Factory\\' => 8,
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Collections\\' => 28,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpKit\\ExtPDO\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-kit/ext-pdo/src',
        ),
        'Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Interfaces',
        ),
        'Game\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Jdr',
        ),
        'Factory\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Factory',
        ),
        'Doctrine\\Common\\Collections\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/collections/lib/Doctrine/Common/Collections',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Classe',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85404b4ff121be3da6cb3338bd6ca126::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85404b4ff121be3da6cb3338bd6ca126::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85404b4ff121be3da6cb3338bd6ca126::$classMap;

        }, null, ClassLoader::class);
    }
}