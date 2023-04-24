<?php

function classAutoLoader($class){

    $class = strtolower($class);

    $path = "includes/{$class}.php";

    file_exists($path) ? require_once $path : die("this test was a success and the class $class is missing ");

}

function redirect ($location) {

    header("Location: {$location}");

}
spl_autoload_register('classAutoLoader');