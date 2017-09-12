<?php

/**
 * 
 * @param string $class_name имя класса
 */
function __autoload($class_name)
{
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    foreach ($array_paths as $path) {
        $class_name = explode('\\', $class_name);
        $class_name = end($class_name);

        $path = ROOT_PATH . $path . $class_name . '.php';

        if (is_file($path)) {
            require_once $path;
        }
    }
}
