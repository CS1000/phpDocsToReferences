<?php

$remove = ['about', 'html', 'more', 'notes', 'translations', 'examples', 'installation', 'requirements', 'resources', 
           'setup', 'connect', 'disconnect', 'shutdown', 'timezones', 'africa', 'america', 'antarctica', 'arctic', 
           'asia', 'atlantic', 'australia', 'europe', 'indian', 'pacific', 'others', 'get', 'concept_cache', 
           'connection_pool', 'sharing_connections', 'configuration'];

// direct download link (not used)
//$download=file_get_contents('http://www.php.net/get/php_manual_en.tar.gz/from/this/mirror');

$files = scandir('phar://php_manual_en.tar.gz/php-chunked-xhtml');
$refs = [];
foreach ($files as $item) {
    $pieces = explode('.', $item,-1);
    foreach ($pieces as $piece) $refs[str_replace('-','',$piece)]=0b0;
}

foreach ($remove as $out) unset($refs[$out]);

$output = "var PHPreferences = { '";
$output.= implode("' : 1, \n'", array_keys($refs));
$output.= "' };\n";

file_put_contents('PHPreferences.js', $output);

print "\nMemory: " . number_format(memory_get_usage()/1048576, 2, '.', ' ') . 
      " Mb \t[Peak: " . number_format(memory_get_peak_usage()/1048576, 2, '.', ' ') . " Mb]\n";
// not ending the script tag like a baws
