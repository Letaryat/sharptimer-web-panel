<?php
    require_once("../../functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    $sid = $conn -> real_escape_string($_POST['sid']);
    $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName LIKE '{$id}' AND SteamID = '{$sid}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
    ShowRows($sql);
?>
