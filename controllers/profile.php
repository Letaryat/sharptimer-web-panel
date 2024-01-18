<?php
if (isset($_GET['sid'])) {
    $sid = mysqli_real_escape_string($conn, $_GET['sid']);
    $sidexplode = explode("/", $sid);
    #echo "<br/> Test : " . $sid . " sidexpldoe: " . $sidexplode[0];
    $query = "SELECT * FROM `PlayerRecords` WHERE SteamID = '{$sidexplode[0]}'";
    $result = mysqli_query($conn, $query) or die("bad query");
    $row = mysqli_fetch_array($result);
    $rand = rand(1, 3);
    if (empty($row)) {
        header("Location: ../index.php");
    }
}
//SURF SQL:
$sqlsurf = "SELECT SteamID, MapName FROM `PlayerRecords` WHERE MapName LIKE 'SURF%' and SteamID = '{$sidexplode[0]}' ORDER BY MapName ASC";
$resultsurf = $conn->query($sqlsurf);
//KZ SQL:
$sqlkz = "SELECT SteamID, MapName FROM `PlayerRecords` WHERE MapName LIKE 'KZ%' and SteamID = '{$sidexplode[0]}' ORDER BY MapName ASC";
$resultkz = $conn->query($sqlkz);
//BunnyHop SQL:
$sqlbh = "SELECT SteamID, MapName FROM `PlayerRecords` WHERE MapName LIKE 'BHOP%' and SteamID = '{$sidexplode[0]}' ORDER BY MapName ASC";
$resultbh = $conn->query($sqlbh);
//OTHERS SQL:
$sqlother = "SELECT SteamID, MapName FROM `PlayerRecords` WHERE MapName NOT LIKE 'BHOP%' AND MapName NOT LIKE 'SURF%' AND MapName NOT LIKE 'KZ%'  and SteamID = '{$sidexplode[0]}' ORDER BY MapName ASC";
$resultother = $conn->query($sqlother);


require 'views/profile.views.php';
