<?php
    require_once("./functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = '{$id}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
    ShowRows($sql);
?>
