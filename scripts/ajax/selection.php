<?php
    require_once("../../functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    if($id === "global"){
        //$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints` FROM PlayerStats ORDER BY `GlobalPoints` DESC LIMIT $limit";
        $sqldwa = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE PlayerStats.SteamID = PlayerRecords.SteamID) AS 'Cunt' FROM PlayerStats ORDER BY `GlobalPoints` DESC";
        ShowRowsGlobal($sqldwa);
    }
    elseif($id === "alltime"){
        $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords ORDER BY `TimerTicks` ASC";
        ShowRows($sql);
    }
    else{
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE '{$id}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
        ShowRows($sql);
    }
   

?>
