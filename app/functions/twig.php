<?php

use app\src\Flash;

$file_exists = new Twig\TwigFunction('file_exists', function($file){
    return file_exists($file);
});

$message = new Twig\TwigFunction('message', function($index){
    echo Flash::get($index);
});

return [
  $file_exists,
  $message
];