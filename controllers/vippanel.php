<?php
$queryplayervip = "SELECT * FROM `PlayerStats` WHERE SteamID = '{$steamprofile['steamid']}' AND `IsVip` = '1'";
$resultplayervip = mysqli_query($conn, $queryplayervip) or die("bad query");
$rowplayervip = mysqli_fetch_array($resultplayervip);

if (!isset($_SESSION['steamid'])) {
    header("Location: error");
} elseif (!empty($rowplayervip) || !in_array($steamprofile['steamid'], $admins)) {
    header("Location: error");
} else {
    require 'views/vippanel.views.php';
}


