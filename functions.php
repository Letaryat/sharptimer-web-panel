<?php 

    #getAvatar function is made by: https://github.com/bman46/Steam-Avatar
    function getAvatar($steamIDCode){
        require 'config.php';
        if(empty($steamauth['apikey'])){
            return "https://steamuserimages-a.akamaihd.net/ugc/885384897182110030/F095539864AC9E94AE5236E04C8CA7C2725BCEFF/";
        }
        else{
            $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$steamIDCode); 
            $content = json_decode($url, true);
    
            $returnVal = $content['response']['players'][0]['avatarfull'];
    
            if(is_null($returnVal)||$returnVal == ""){
                return "https://steamuserimages-a.akamaihd.net/ugc/885384897182110030/F095539864AC9E94AE5236E04C8CA7C2725BCEFF/";
            } else {
                return $returnVal;
            }
        }

    }

/*
    function BaseURL(){
        $url = $_SERVER['REQUEST_URI'];
        $rurl = explode("/", $url);
        echo "/".$rurl[1]."/";
    }
*/
    function UriExplode($uri){
        $ex = explode("/", $uri);
        $x = "/".$ex[1]."/";
        return $x;
    }
    function UriExplodeControllers($uri){
        $ex = explode("/", $uri);
        $x = $ex[2];
        return $x;
    }

    function BasicURL(){
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        return UriExplode($uri);
    }
    function ShowRows($sql){
        $i = 0;
        require('config.php');
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $i++;
                echo '<a href="profile?sid='.$row['SteamID'] . '/"><div';
                if($i % 2 == 0){
                    echo ' id="stripped"';
                }
                else{echo "";}
                echo ' class="row">
                <span>'.$i.'</span>
                <span>'.$row['PlayerName'].'</span>
                <span>'.$row['FormattedTime'].'</span>
                <span>'.$row['MapName'].'</span>
                </div></a>';
            }
        }
        else{
            echo "<div id='strangerdanger' class='row'>Player not found.</div>";
        }
    }

    function CountSocialUrl($uri, $arrek){
        $json = file_get_contents("views/partials/socials.json");
        $myJson = json_decode($json, true);
        for($x = 0; $x < count($myJson); $x++){
            if($myJson[$x]['local'] == true){
                #$c = $uri . $myJson[$x]['url'];
                $v = "controllers/" . $myJson[$x]['name'];
                array_push($arrek,$myJson[$x]);
            }
        }
    }

    function SocialURL(){
        $json = file_get_contents("views/partials/socials.json");
        $myJson = json_decode($json, true);
        for($x = 0; $x < count($myJson); $x++){
            if($myJson[$x]['local'] == true){?>
            <li><a href="<?php echo $myJson[$x]['url']?>"><?php echo $myJson[$x]['name'] ?></a></li><?php
            }
            else{?>
                <li><a href="<?php echo $myJson[$x]['url']?>"><?php echo $myJson[$x]['name']?></a></li><?php 
            }
        }
    }

    //Funkcja ktora bierze mapy grane przez gracza:
    function playedmaps($id,$sid){
        $sql = "SELECT `SteamID`, `MapName` FROM playerrecords WHERE `SteamID` = '{$sid}' AND 'MapName' LIKE 'surf_%'";
        require('config.php');
        $result = $conn -> query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo  $row['MapName']. "<br/>";
            }
        }
    }

    //Funkcja ktora kalkuluje procent
    function calculaterank($ranking, $mapname){
        $sqltest = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords WHERE MapName LIKE '{$mapname}'";
        require('config.php');
        $result = $conn -> query($sqltest);
        $c = mysqli_num_rows($result);
        $p = ($c / $ranking) * 100;
        #echo $sqltest . "</;>";
        echo "Count: ".$c. " Ranking: ".$ranking. " P: ".$p;
    }
    //Funkcja ktora pokazuje na profilu wszystkie mapy grane przez gracza

    function ShowRowsProfile($sql, $sid){
        require('config.php');
        $i = 1;
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $f = mysqli_num_rows($result);
                if($row['SteamID'] == $sid){
                    echo '<div class="row">
                    <span>';
                    if(empty($row['Ranking'])){
                        echo $i;
                        $i++;
                    }else{
                        echo $row['Ranking'];
                    }
                    echo '</span>
                    <span>'.$row['PlayerName'].'</span>
                    <span>'.$row['FormattedTime'].'</span>
                    <span>'.$row['MapName'].'</span>
                    </div>';
                }
            }
        }
        else{
            echo "<div id='strangerdanger' class='row'>Player not found.</div>";
        }
    }

    function ShowRowsProfileOryginal($sql, $sid){
        require('config.php');
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $f = mysqli_num_rows($result);
                if($row['SteamID'] == $sid){
                    echo '<div class="row">
                    <span>'.$row['Ranking'].'</span>
                    <span>'.$row['PlayerName'].'</span>
                    <span>'.$row['FormattedTime'].'</span>
                    <span>'.$row['MapName'].'</span>
                    <span>'.calculaterank($row['Ranking'], $row['MapName']).'</span>
                    </div>';
                    #echo $f;
                }
            }
        }
        else{
            echo "<div id='strangerdanger' class='row'>Player not found.</div>";
        }
    }




?>