<?php
    if(!isset($_SESSION['steamid'])) {
        header("Location: error");
    } elseif (!in_array($steamprofile['steamid'], $admins)){
        header("Location: error");
    }
    else{
        require 'views/adminpanel.views.php';
    }