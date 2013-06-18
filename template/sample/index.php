<?php
include '../Mobi/Mtld/DA/Api.php';

echo '<pre>';

$s = microtime(true);

$memcache_enabled = extension_loaded("memcache");
$no_cache = array_key_exists("nocache", $_GET);
if ($memcache_enabled && !$no_cache) {
  $memcache = new Memcache;
  $memcache->connect('localhost', 11211);
  $tree = $memcache->get('tree');
}

if (!is_array($tree)) {
  $tree = Mobi_Mtld_DA_Api::getTreeFromFile("json/DeviceAtlas.json");
  if ($memcache_enabled && !$no_cache) {
    $memcache->set('tree', $tree, false, 10);
  }
}

if ($memcache_enabled && !$no_cache) {
  $memcache->close();
}

$properties = Mobi_Mtld_DA_Api::getProperties($tree, $_SERVER['HTTP_USER_AGENT']);
//further performance can be gained through caching the properties against the user-agent as a key (since many requests are likely to come from one device during its visit)

$e = microtime(true);
print "Time taken: " . floor(($e - $s)*1000) . "ms\r\n";

print_r($properties);

echo '</pre>';
?>
