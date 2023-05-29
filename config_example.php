<?php
/**
 * just using PHP 7.4.x or above and run command
 * > php -S localhost:8888 and run it
 */
define('HOST', 'localhost');
define('PORT', '3306');
define('DB', 'test');
define('USER', 'test');
define('PASS', 'test');

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$dbi = new mysqli(HOST,USER,PASS,DB);
if ($dbi->connect_errno) {
    echo 'Fail to connect DB: '.$dbi->connect_error;
    exit;
}

$dbi->query("SET NAMES UTF8");