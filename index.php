<?php
require('functions.php');
require('config.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
echo __DIR__ . "<br/>"; 
echo $uri . "<br/>";

$z = UriExplode($uri);


$routes = [
    $z => 'controllers/index.php',
    $z.'profile' => 'controllers/profile.php',
];

if(array_key_exists($uri, $routes)){
    require $routes[$uri];
}else{
    http_response_code(404);
    require('views/error.php');
}
