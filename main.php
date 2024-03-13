<?php $part = isset($_SERVER['PATH_INFO']) ? explode('/', preg_replace('~^/?(.*?)/?
	$~', '$1', $_SERVER['PATH_INFO'])) : array();
$mod_co = count($part);
$webFolder = 'app_modules/';
//config route 
$view = [
	"home" => [
		"appFolder" => $webFolder . "home/",
		"appFile" => $webFolder . "home/index.php",
		"title" => "หน้าหลัก"
	],
	"products" => [
		"appFolder" => $webFolder . "products/",
		"appFile" => $webFolder . "products/index.php",
		"title" => "สินค้า"
	],
];
//config 
$web = [
	"domain" => "http://localhost/gerun-wallet/",
];

$menu = [
	"home" => [
		"type" => "Link",
		"icon" => "fa fa-file",
		"title" => "หน้าหลัก",
		"url" => "home",
	],
	"products" => [
		"type" => "Link",
		"icon" => "fa fa-file",
		"title" => "สินค้า",
		"url" => "products",
	]
];
