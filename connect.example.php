<?php
session_start();
$config = array(
    'host'=>'__HOST__',
    'user'=>'__USER__',
    'pass'=>'__PASS__',
    'db'=>'__DATABASE__',
    'port'=>'__PORT_NUMBER__'
);
$dbi = new Mysqli($config['host'],$config['user'],$config['pass'],$config['db'],$config['port']);
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}
$dbi->query("SET NAMES UTF8");

function dump($t){
    echo "<pre>";
    var_dump($t);
    echo "</pre>";
}

$links = array(
    'REGISTER' => array('opcard','opday'),
    'OPD' => array('opd','labcare')
);