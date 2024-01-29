<?php
#idk what is happening here but it works somehow :)
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$z = UriExplode($uri);
$filename = "modules/" . UriExplodeControllers($uri) . ".php";
$routes = [
    $z => 'controllers/index.php',
    $z.'profile' => 'controllers/profile.php',
    $z.'adminpanel' => 'controllers/adminpanel.php',
    $z.'vippanel' => 'controllers/vippanel.php',
];
if(array_key_exists($uri, $routes)){
    require $routes[$uri];
}
elseif(file_exists($filename)){
    require $filename;
}
else{
    http_response_code(404);
    require('views/error.php');
}