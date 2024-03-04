<?php

#getAvatar function is made by: https://github.com/bman46/Steam-Avatar
function getAvatar($steamIDCode)
{
    //require 'gunwo/config.php';
    require 'config.php';
    if (empty($steamapikey)) {
        return "https://steamuserimages-a.akamaihd.net/ugc/885384897182110030/F095539864AC9E94AE5236E04C8CA7C2725BCEFF/";
    } else {
        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $steamapikey . "&steamids=" . $steamIDCode);
        $content = json_decode($url, true);
        $returnVal = $content['response']['players'][0]['avatarfull'];
        if (is_null($returnVal) || $returnVal == "") {
            return "https://steamuserimages-a.akamaihd.net/ugc/885384897182110030/F095539864AC9E94AE5236E04C8CA7C2725BCEFF/";
        } else {
            return $returnVal;
        }
    }

}

function UriExplode($uri)
{
        $ex = explode("/", $uri);
        if(count($ex) === 3){
            $x = "/" . $ex[1] . "/";
            return $x;
        }elseif(count($ex) === 2){
            return "/";
        }

}
function UriExplodeControllers($uri)
{
    $ex = explode("/", $uri);
    //$x = $ex[1];
    if(count($ex) === 3){
        $x = $ex[2];
    }
    elseif(count($ex) === 2){
        $x = $ex[1];
    }
    return $x;
}

function BasicURL()
{
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    return UriExplode($uri);
}

function CustomStyles(){
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $filename = glob('modules/pages/*');
    foreach($filename as $page){
        $page2 = explode("/", $page);
        if($page2[2] === UriExplodeControllers($uri)){
            if(file_exists($page.'/'.$page2[2].'_style.css')){
                //echo $page;
                echo '<link rel="stylesheet" type="text/css" href="'.$page.'/'.$page2[2].'_style.css">';
            }
        }
    }
}

function CustomJS(){
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $filename = glob('modules/pages/*');
    foreach($filename as $page){
        $page2 = explode("/", $page);
        if($page2[2] === UriExplodeControllers($uri)){
            if(file_exists($page.'/'.$page2[2].'_script.js')){
                echo '<script type="text/javascript"  src="'.$page.'/'.$page2[2].'_script.js"></script>';
            }
        }
    }
}

function CustomMainStyles(){
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $filename = glob('modules/main/*');
    $z = UriExplode($uri);
    foreach($filename as $page){
        $page2 = explode("/", $page);
        $page3 = explode("-", $page2[2]);
        if($uri === $z){
            if(file_exists($page.'/'.$page3[1].'_style.css')){
                echo '<link rel="stylesheet" href="'.$page.'/'.$page3[1].'_style.css" type="text/css">';
            }
        }
    }
}
function CustomMainJS(){
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $filename = glob('modules/main/*');
    $z = UriExplode($uri);
    foreach($filename as $page){
        $page2 = explode("/", $page);
        $page3 = explode("-", $page2[2]);
        //echo $page.'/'.$page3[1].'_script.js'."<br/>";
        if($uri === $z){
            if(file_exists($page.'/'.$page3[1].'_script.js')){
                echo '<script type="module"  src="'.$page.'/'.$page3[1].'_script.js"></script>';
            }
        }
    }
}


function ShowRows($sql)
{
    $i = 0;
    require('config.php');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $i++;
            echo '<a href="profile?sid=' . $row['SteamID'] . '/"><div';
            if ($i % 2 == 0) {
                echo ' id="stripped"';
            } else {
                echo "";
            }
            echo ' class="row" data_number="'.$i.'">
                <span>' . $i . '</span>
                <span>' . $row['PlayerName'] . '</span>
                <span>' . $row['FormattedTime'] . '</span>
                <span>' . $row['MapName'] . '</span>
                <span>' . $row['TimesFinished'] . '</span>
                </div></a>';
        }
        echo '<div class="last-row-number" data-last="'.$i.'"></div>';
    } 

    else {
        echo "<div id='strangerdanger' class='row'>Player not found.</div>";
    }
}


function ShowRowsGlobal($sql)
{
    $i = 0;
    require('config.php');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $i++;
            echo '<a href="profile?sid=' . $row['SteamID'] . '/"><div';
            if ($i % 2 == 0) {
                echo ' id="stripped"';
            } else {
                echo "";
            }
            echo ' class="row">
                <span>' . $i . '</span>
                <span>' . $row['PlayerName'] . '</span>
                <span>' . $row['GlobalPoints'] . '</span>
                <span>' . $row['Cunt'] . '</span>
                </div></a>';
        }
        echo '<div class="last-row-number" data-last="'.$i.'"></div>';
    } else {
        echo "<div id='strangerdanger' class='row'>Player not found.</div>";
    }
}

function SocialURL()
{
    $json = file_get_contents("views/partials/socials.json");
    $myJson = json_decode($json, true);
    #to check if it's active
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $v = UriExplodeControllers($uri);
    for ($x = 0; $x < count($myJson); $x++) {
        if ($myJson[$x]['local'] == true) { ?>
            <li><a <?php
            #adding id that it is active
            if ($v === $myJson[$x]['url']) {
                echo 'id="active"';
            }
            ?>
                    href="<?php echo $myJson[$x]['url'] ?>">
                    <?php echo $myJson[$x]['name'] ?>
                </a></li>
            <?php
        } else { ?>
            <li><a href="<?php echo $myJson[$x]['url'] ?>">
                    <?php echo $myJson[$x]['name'] ?>
                </a></li>
        <?php
        }
    }
    if (!empty(glob('./modules'))) {
        $a = 0;
        $exptrzy = [];
        foreach (glob('modules/pages/*') as $filename) {
            $a++;
            $expjeden = explode("/", $filename);
            $expdwa = explode(".", $expjeden[2]);
            array_push($exptrzy, $expdwa[0]);
        }
        $statement = $a > 3;
        if ($statement) {
            $a++;
            echo '<div onclick="DropDownClick(event)" class="dropdown">
                <li class="dropbtn">More</li>
                <ul class="dropdown-content">';
            for ($e = 0; $e < count($exptrzy); $e++) {
                echo '<li>
                    <a ';
                if ($v === $exptrzy[$e]) {
                    echo 'id="active"';
                }
                echo 'href="' . $exptrzy[$e] . '">' . $exptrzy[$e] . '</a></li>';
            }
            echo '</ul></div>';
        } else {
            for ($e = 0; $e < count($exptrzy); $e++) {
                echo '<li>
                    <a ';
                if ($v === $exptrzy[$e]) {
                    echo 'id="active"';
                }
                echo 'href="' . $exptrzy[$e] . '">' . $exptrzy[$e] . '</a></li>';
            }
        }

    }
}
function ShowRowsProfile($sql, $sid)
{
    require('config.php');
    $i = 1;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $f = mysqli_num_rows($result);
            if ($row['SteamID'] == $sid) {
                echo '<div class="row">
                    <span>';
                if (empty($row['Ranking'])) {
                    echo $i;
                    $i++;
                } else {
                    echo $row['Ranking'];
                }
                echo '</span>
                    <span>' . $row['PlayerName'] . '</span>
                    <span>' . $row['FormattedTime'] . '</span>
                    <span>' . $row['MapName'] . '</span>
                    <span>' . $row['TimesFinished'] . '</span>
                    </div>';
            }
        }
    } else {
        echo "<div id='strangerdanger' class='row'>Player not found.</div>";
    }
}
function ShowRowsAdminPanel($sql)
{
    $i = 0;
    require('config.php');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $i++;
            echo '<div ';
            if ($i % 2 == 0) {
                echo ' id="stripped"';
            } else {
                echo "";
            }
            echo ' class="row">
            <span>' . $i . '</span>
            <span><a href="profile?sid=' . $row['SteamID'] . '/">' . $row['PlayerName'] . '</a></span>
            <span>' . $row['FormattedTime'] . '</span>
            <span>' . $row['MapName'] . '</span>
            <span>' . $row['TimesFinished'] . '</span>
            <span href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '" data-mapname="' . $row['MapName'] . '"  class="admin-button edit"><i class="fa-solid fa-pen"></i></span>
            <label class="checkbox-container">
            <input type="checkbox" value="' . $row['SteamID'] . '" class="admin-button"></input>
            <span class="checkmark"></span>
            </label>
            </div>';
        }
    } else {
        echo "<div id='strangerdanger' class='row'>Player not found.</div>";
    }
}
/*
$ranksarray = array(
    "god3",
    "god2",
    "god1",
    "r3",
    "r2",
    "r1",
    "leg3",
    "leg2",
    "leg1",
    "mas3",
    "mas2",
    "mas1",
    "d3",
    "d2",
    "d1",
    "plat3",
    "plat2",
    "plat1",
    "gold3",
    "gold2",
    "gold1",
    "s3",
    "s2",
    "s1",
);
*/
function calculateranks($result, $row){
    $ranksarray = array(
        "god.gif",
        "god.gif",
        "god.gif",
        "roayl3.png",
        "roayl2.png",
        "roayl1.png",
        "legend3.png",
        "legend2.png",
        "legend1.png",
        "master3.png",
        "master2.png",
        "master1.png",
        "dia3.png",
        "dia2.png",
        "dia1.png",
        "plat3.png",
        "plat2.png",
        "plat1.png",
        "gold3.png",
        "gold2.png",
        "gold1.png",
        "silver3.png",
        "silver2.png",
        "silver1.png",
    );
    $position = $row['Pos'];
    $percentage = $position / $result->num_rows * 100;
    if($result->num_rows < 100){
    if ($position <= 1)
    echo $ranksarray[0]; // God 3
    else if ($position <= 2)
    echo $ranksarray[1]; // God 2
    else if ($position <= 3)
    echo $ranksarray[2]; // God 1
    else if ($position <= 10)
    echo $ranksarray[3]; // Royal 3
    else if ($position <= 15)
    echo $ranksarray[4]; // Royal 2
    else if ($position <= 20)
    echo $ranksarray[5]; // Royal 1
    else if ($position <= 25)
    echo $ranksarray[6]; // Legend 3
    else if ($position <= 30)
    echo $ranksarray[7]; // Legend 2
    else if ($position <= 35)
    echo $ranksarray[8]; // Legend 1
    else if ($position <= 40)
    echo $ranksarray[9]; // Master 3
    else if ($position <= 45)
    echo $ranksarray[10]; // Master 2
    else if ($position <= 50)
    echo $ranksarray[11]; // Master 1
    else if ($position <= 55)
    echo $ranksarray[12]; // Diamond 3
    else if ($position <= 60)
    echo $ranksarray[13]; // Diamond 2
    else if ($position <= 65)
    echo $ranksarray[14]; // Diamond 1
    else if ($position <= 70)
    echo $ranksarray[15]; // Platinum 3
    else if ($position <= 75)
    echo $ranksarray[16]; // Platinum 2
    else if ($position <= 80)
    echo $ranksarray[17]; // Platinum 1
    else if ($position <= 85)
    echo $ranksarray[18]; // Gold 3
    else if ($position <= 90)
    echo $ranksarray[19]; // Gold 2
    else if ($position <= 95)
    echo $ranksarray[20]; // Gold 1
    else
    echo $ranksarray[23]; // Silver 1
    }
    else{
    if ($position <= 1)
    echo $ranksarray[0]; // God 3
    else if ($position <= 2)
    echo $ranksarray[1]; // God 2
    else if ($position <= 3)
    echo $ranksarray[2]; // God 1
    else if ($percentage <= 1)
    echo $ranksarray[3]; // Royal 3
    else if ($percentage <= 5.0)
    echo $ranksarray[4]; // Royalty 2
    else if ($percentage <= 10.0)
    echo $ranksarray[5]; // Royalty 1
    else if ($percentage <= 15.0)
    echo $ranksarray[6]; // Legend 3
    else if ($percentage <= 20.0)
    echo $ranksarray[7]; // Legend 2
    else if ($percentage <= 25.0)
    echo $ranksarray[8]; // Legend 1
    else if ($percentage <= 30.0)
    echo $ranksarray[9]; // Master 3
    else if ($percentage <= 35.0)
    echo $ranksarray[10]; // Master 2
    else if ($percentage <= 40.0)
    echo $ranksarray[11]; // Master 1
    else if ($percentage <= 45.0)
    echo $ranksarray[12]; // Diamond 3
    else if ($percentage <= 50.0)
    echo $ranksarray[13]; // Diamond 2
    else if ($percentage <= 55.0)
    echo $ranksarray[14]; // Diamond 1
    else if ($percentage <= 60.0)
    echo $ranksarray[15]; // Platinum 3
    else if ($percentage <= 65.0)
    echo $ranksarray[16]; // Platinum 2
    else if ($percentage <= 70.0)
    echo $ranksarray[17]; // Platinum 1
    else if ($percentage <= 75.0)
    echo $ranksarray[18]; // Gold 3
    else if ($percentage <= 80.0)
    echo $ranksarray[19]; // Gold 2
    else if ($percentage <= 85.0)
    echo $ranksarray[20]; // Gold 1
    else if ($percentage <= 90.0)
    echo $ranksarray[21]; // Silver 3
    else if ($percentage <= 95.0)
    echo $ranksarray[22]; // Silver 2
    else
    echo $ranksarray[23]; // Silver 1
}
}

function GetRankGlobal($steamid){
    require('config.php');
    $sql= "SELECT *, RANK() OVER(ORDER BY `GlobalPoints` DESC) AS 'Pos' FROM `PlayerStats`";
    $result = $conn->query($sql);
    #echo "chuj";
    if($result -> num_rows > 0){
    #echo $result ->num_rows;
        while($row = $result -> fetch_assoc()){
        #echo "<br/>" . "Player: " . $row['PlayerName'] . "Pos: " . $row['Pos'] . "Rank: " . calculateranks($result, $row);
         if($row['SteamID'] === "{$steamid}"){
            return calculateranks($result, $row);
        }
        }
    }

}

?>