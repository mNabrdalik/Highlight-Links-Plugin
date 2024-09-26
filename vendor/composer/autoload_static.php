<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbdea05cc3dd049c422b09e92ed93ff8e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pixelpath\\HighlightLink\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pixelpath\\HighlightLink\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PixelPath\\HighlightLink\\Classes\\SettingsPage' => __DIR__ . '/../..' . '/inc/Classes/SettingsPage.php',
        'PixelPath\\HighlightLink\\Interfaces\\HookContent' => __DIR__ . '/../..' . '/inc/Interfaces/HookContent.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbdea05cc3dd049c422b09e92ed93ff8e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbdea05cc3dd049c422b09e92ed93ff8e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbdea05cc3dd049c422b09e92ed93ff8e::$classMap;

        }, null, ClassLoader::class);
    }
}
