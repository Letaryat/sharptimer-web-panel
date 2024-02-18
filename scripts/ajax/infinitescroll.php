<?php
require_once("../../functions.php");
require_once("../../config.php");

$random = 10;
$id = $conn->real_escape_string($_POST['id']);
$last= $conn->real_escape_string($_POST['last']);
$offset = $last + $random;



//$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints` FROM PlayerStats ORDER BY `GlobalPoints` DESC LIMIT $limit";
if($id === "global"){
    $sqldwa = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE PlayerStats.SteamID = PlayerRecords.SteamID) AS 'Cunt' FROM PlayerStats ORDER BY `GlobalPoints` DESC ";
    //ShowRowsGlobal($sqldwa);
}
elseif($id === "alltime"){
    $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords ORDER BY `TimerTicks` LIMIT $limitdwa OFFSET $offset";
    //ShowRows($sql);
}
else{
    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE '{$id}'  ORDER BY `TimerTicks` LIMIT $last, $offset";
    ShowRows($sql);
}

//$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords  ORDER BY `TimerTicks` ASC LIMIT $start, $limit";
//ShowRows($sql);

?>