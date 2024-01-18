<?php
#idk what is happening here but it works somehow :)
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$z = UriExplode($uri);
$x = UriExplodeControllers($uri);
$filename = "controllers/" . $x . ".php";

#I think that this isn't needed anymore since I've made a dynamic router but:
#If I would like to make a modules not in controllers folder but for example in module folder it should be needed
#The dynamic router checks if the file exists in controllers folder and if so it requires a file. So let it stay for now.
$routes = [
    $z => 'controllers/index.php',
];
#echo "<div class='row' id='strangerdanger'>Routing URL: ".$uri . "</div><br/>";
#echo $filename;

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