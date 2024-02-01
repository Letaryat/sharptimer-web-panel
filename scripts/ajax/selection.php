<?php
    require_once("../../functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    if($id === "global"){
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints` FROM PlayerStats ORDER BY `GlobalPoints` DESC LIMIT $limit";
        ShowRowsGlobal($sql);
    }else{
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName = '{$id}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
        ShowRows($sql);
    }
   

?>
