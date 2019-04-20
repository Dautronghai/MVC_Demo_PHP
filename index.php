<?php 
include_once 'configs/db.php';
include_once 'configs/path.php';
session_start(); 
function __autoLoad($class){	
	$file = strtolower(str_replace('_', '/', $class)).'.php';
		include_once $file;	
}
new Libs_routeconfig(); //bootstrap
