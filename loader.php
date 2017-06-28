<?php
session_start();
include('database/mysql.php');

if(!isset($_REQUEST['a'])) {
	json_encode(array('success' => false, 'error' => 'fatal error! code: 0'));
	die;
}

$a = explode('.', $_REQUEST['a']);
$class; $method; $file = $a[0];
if(isset($a[1])) {
	$class = $a[1].'Controler';
	$method = $a[2];
}

include('controlers/'.$file.'.php');
if(isset($class)) {
	$class = new $class();
	$response = $class->$method();
	echo json_encode($response);

	unset($response);
	unset($class);
	unset($method);
}

unset($file);
?>