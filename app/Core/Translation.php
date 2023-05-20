<?php

$files = array();

$recursive_path = base_path('resources/lang/ar');

require_once_dir($recursive_path. "/*");

for($f = 0; $f < count($files); $f++){

    $file = $files[$f];

    require_once($file);
}
function require_once_dir($dir): void
{
    global $files;

    $item = glob($dir);

    foreach ($item as $filename) {

        if(is_dir($filename)) {

            require_once_dir($filename.'/'. "*");

        }elseif(is_file($filename)){

            $files[] = $filename;
        }
    }
}
function translate($str): String
{
    global $lang;
    if(!empty($lang[$str])) {
        return  $lang[$str];
    }
    return $str;
}
