<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit361e210e397f546315cab60ce5bbd3f8
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LaJoie\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LaJoie\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit361e210e397f546315cab60ce5bbd3f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit361e210e397f546315cab60ce5bbd3f8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit361e210e397f546315cab60ce5bbd3f8::$classMap;

        }, null, ClassLoader::class);
    }
}
