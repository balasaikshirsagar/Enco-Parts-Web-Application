<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit240f8d4a05b6cb64f95fda40431b3b76
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kshirsagarbalasai\\Adminphp\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kshirsagarbalasai\\Adminphp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit240f8d4a05b6cb64f95fda40431b3b76::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit240f8d4a05b6cb64f95fda40431b3b76::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit240f8d4a05b6cb64f95fda40431b3b76::$classMap;

        }, null, ClassLoader::class);
    }
}
