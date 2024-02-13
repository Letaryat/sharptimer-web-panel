<?php
$queryplayervip = "SELECT * FROM `PlayerStats` WHERE `IsVip` = '1'";
$resultplayervip = mysqli_query($conn, $queryplayervip) or die("bad query playervip");
$rowplayervip = mysqli_fetch_array($resultplayervip);

if (!isset($_SESSION['steamid'])) {
    header("Location: error");
} elseif (!in_array($steamprofile['steamid'], $admins)) {
    header("Location: error");
} else {
    require 'views/vippanel.views.php';
}


