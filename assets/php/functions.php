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
    function BaseURL(){
        $url = $_SERVER['REQUEST_URI'];
        $rurl = explode("/", $url);
        echo "/".$rurl[1]."/";
    }

    function ShowRows($sql){
        $i = 0;
        require(SITE_ROOT."/config.php");
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $i++;
                echo '<a target="_blank" href="profile/'.$row['SteamID'] . '/"><div';
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
    function SocialURL(){
        $json = file_get_contents("core/socials.json");
        $myJson = json_decode($json, true);
        #echo count($myJson);
        for($x = 0; $x < count($myJson); $x++){
            if($myJson[$x]['local'] == true){?>
            <li><a href="<?php echo BaseURL().$myJson[$x]['url']?>"><?php echo $myJson[$x]['name'] ?></a></li><?php
            }
            else{?>
                <li><a href="<?php echo $myJson[$x]['url']?>"><?php echo $myJson[$x]['name']?></a></li><?php 
            }
        }
    }




?>