<?php


if (!isset($_SESSION['steamid'])) {
    header("Location: error");
} elseif (!in_array($steamprofile['steamid'], $admins)) {
    header("Location: error");
} else {
    require 'views/adminpanel.views.php';
}


#<span href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '" data-mapname="' . $row['MapName'] . '" class="admin-button delete"><i class="fa-solid fa-trash"></i> Delete Record</span>
