<?php
require('functions.php');
require('config.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
echo __DIR__ . "<br/>"; 
echo $uri;

$routes = [
    '/sharptimer-web-panel/' => 'controllers/index.php',
    '/sharptimer-web-panel/profile' => 'controllers/profile.php',
];

if(array_key_exists($uri, $routes)){
    require $routes[$uri];
}else{
    http_response_code(404);
    require('views/error.php');
}
