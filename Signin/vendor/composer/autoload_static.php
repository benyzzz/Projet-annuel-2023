<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbfb5cbd52144982beeaac0ac58035cbf
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbfb5cbd52144982beeaac0ac58035cbf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbfb5cbd52144982beeaac0ac58035cbf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbfb5cbd52144982beeaac0ac58035cbf::$classMap;

        }, null, ClassLoader::class);
    }
}