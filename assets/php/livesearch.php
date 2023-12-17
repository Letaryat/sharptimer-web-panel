<?php 
    require_once("./functions.php");
    require_once("../../config.php");
    $i = 0;
    if(isset($_POST['input'])){
        $input = $conn -> real_escape_string($_POST['input']);
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE `PlayerName` LIKE '{$input}%' OR `SteamID` LIKE '{$input}%' ORDER BY `TimerTicks`";
        ShowRows($sql);
    }
?>