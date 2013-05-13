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
    if ($item != 'images') {
        $pieces = explode('.', $item,-1);
        
        /*
        // usual offset at 664-828
        $data=file_get_contents('phar://php_manual_en.tar.gz/php-chunked-xhtml/' . $item, false, NULL, 640, 512); 
        
        if (preg_match('`<h1[^>]*>([^< ]+)</h1>`', $data, $refname)) {
            // TODO? Title
        }
        */
        
        foreach ($pieces as $piece) $refs[str_replace('-','',$piece)]=0b0;
    }
}

foreach ($remove as $out) unset($refs[$out]);

$output = "{\n" . '"';
$output.= implode('":"1",' . "\n" . '"', array_keys($refs));
$output.= '":"1"' . "\n}";

file_put_contents('PHPreferences.json', $output);

print "\nMemory: " . number_format(memory_get_usage()/1048576, 2, '.', ' ') . 
      " Mb \t[Peak: " . number_format(memory_get_peak_usage()/1048576, 2, '.', ' ') . " Mb]\n";
