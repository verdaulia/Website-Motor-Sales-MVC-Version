<?php

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../app/';
    $class = str_replace('App\\', '', $class);
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});