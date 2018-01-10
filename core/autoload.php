<?php

spl_autoload_register(function($class)
{
    $base_dir = __DIR__ . '/../';

    $class_dirs = explode('\\', $class);
    $classname = array_pop($exploded_class);
    foreach ($class_dirs as &$dir)
    {
    	$dir = strtolower($dir);
    }

    $file = $base_dir . implode('/', $exploded_class . '/' . $classname) . '.php';

    if (file_exists($file))
    {
        require $file;
    }
});
