<?php

spl_autoload_register(function ($class) {
    $dir =str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
  
    if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$dir)){
    require_once $dir;
    }
});