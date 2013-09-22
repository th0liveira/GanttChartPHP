<?php
/**
 * Bootstrap tests
 */
class Bootstrap
{
    static function getModulePath()
    {
        return __DIR__ . '/..';
    }

    static public function go()
    {
        $path = array(
                get_include_path(),
        );
        set_include_path(implode(PATH_SEPARATOR, $path));

        include 'autoloader.php';
    }
}

Bootstrap::go();