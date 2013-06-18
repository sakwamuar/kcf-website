<?php

$tree = Mobi_Mtld_DA_Api::getTreeFromFile("sample/json/DeviceAtlas.json");
$ua = $_SERVER['HTTP_USER_AGENT'];
try{
  $vendor = Mobi_Mtld_DA_Api::getProperty($tree, $ua, 'vendor');
} catch (Mobi_Mtld_Da_Exception_InvalidPropertyException $e) {
	$vendor = "Unknown";
}

$width = Mobi_Mtld_DA_Api::getProperty($tree, $ua, 'displayWidth');
$height = Mobi_Mtld_DA_Api::getProperty($tree, $ua, 'displayHeight');

?>
