<?php
    require_once("../../functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    #if($id == "other"){ $id == "MapName NOT LIKE 'BHOP%' AND MapName NOT LIKE 'SURF%' AND MapName NOT LIKE 'KZ%'"};
    $sid = $conn -> real_escape_string($_POST['sid']);
    #to sql ponizej to poprawne
    #$sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName LIKE '{$id}' AND SteamID = '{$sid}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
    #to do testowania, wyjebac:
    #$view = "CREATE VIEW test AS SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords WHERE MapName LIKE 'surf_ace' LIMIT 100; ";
    if($id === "%"){
        //$sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE '{$id}' AND SteamID = '{$sid}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
        $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords WHERE MapName LIKE '{$id}' ORDER BY `TimerTicks` ASC";
    }
    else{
        $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords WHERE MapName LIKE '{$id}'";
    }
    ShowRowsProfile($sql, $sid);

?>
