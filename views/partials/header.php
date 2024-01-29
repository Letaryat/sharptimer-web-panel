<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="views/assets/css/style.css?version=4">
    <link rel="stylesheet" type="text/css" href="views/assets/css/profiles.css?version=4">
    <link href="/views/assets/css/hamburgers.min.css" rel="stylesheet">
    <script type="text/javascript" src="views/assets/js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="views/assets/js/jquery.mask.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="views/assets/images/favicons/favicon-32x32.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $pagetitle ?>">
    <meta property="og:description" content="Your statistics in one place!">
    <meta property="og:url" content="">
    <meta property="og:image" content="https://i.imgur.com/6gHn8TN.png">
    <meta property="og:image:secure_url" content="https://i.imgur.com/6gHn8TN.png">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:footer" content="SharpTimer">
    <meta name="theme-color" content="#6389E8">
    <meta name="description" content="Your SharpTimer statistics and leaderboard in one place!">
    <title>
        <?php echo $pagetitle ?>
    </title>
</head>
<body>
    <div id="top"></div>
    <div class="mobiletoggler" onclick="toggleMobile()">
        <button class="hamburger hamburger--spin" type="button" aria-label="Menu">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
    <div class="mobile-nav">
        <ul>
            <?php
            SocialURL();
            ?>
        </ul>
    </div>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="<?php echo BasicURL();?>views/assets/images/logo.png" alt="logo">
                <h1>
                    <a href='<?php echo BasicURL(); ?>'>
                        <?php echo $pagetitle ?>
                    </a>
                </h1>
                <div class="helpme">
                    <input id="search" type="search" placeholder="Search by Nickname or SteamID64">
                </div>
            </div>
            <ul>
                <?php
                SocialURL();
                ?>
            <!--
            <div class="dropdown">
                <li class="dropbtn">DropDown</li>
                <ul class="dropdown-content">
                    <li><a href="dupnie">Error Page</a></li>
                    <li><a href="">link</a></li>
                    <li><a href="">link</a></li>
                    <li><a href="">link</a></li>
                    <li><a href="">link</a></li>
                    <li><a href="">link</a></li>
                </ul>
            </div> -->
            <?php
            if(!isset($_SESSION['steamid'])) {

                loginbutton(); //login button
            
            }  else {
                require('admins.php');
                include ('scripts/steamauth/userInfo.php'); //To access the $steamprofile array
                //Protected content
                echo "<div onclick='DropDownClick(event)' class='dropdown'>
                <img  class='dropbtn' style='border-radius:100%;' src='".$steamprofile['avatar']."'>
                    <ul class='dropdown-content'>
                        <li><a href='profile?sid=".$steamprofile['steamid']."/'>".$steamprofile['personaname']."</a></li>
                        <li><a href=''>link</a></li>";
                        if(in_array($steamprofile['steamid'], $admins)){
                            echo "<li><a href='adminpanel'>Admin Panel</a></li>";
                        }
                echo "<form id='steam-logout-form' action='' method='get'><button class='steam-button' name='logout' type='submit'><i class='fa-solid fa-arrow-right-from-bracket'></i>Logout</button></form>
                        </ul>
                </div>";
            }     



            ?>
            </ul>

        </div>
    </header>
