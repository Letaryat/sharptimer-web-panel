<?php
require_once("../../functions.php");
require_once("../../config.php");
$last = $_GET['last'];
$i = $last;
$clicked = $_GET['clicked']; //how many times it clicked button
$dataid = $_GET['dataid']; //map
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 5;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;


if($dataid === "global"){
    //$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints` FROM PlayerStats ORDER BY `GlobalPoints` DESC LIMIT $limit";
    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE PlayerStats.SteamID = PlayerRecords.SteamID) AS 'Cunt' FROM PlayerStats ORDER BY `GlobalPoints` DESC LIMIT $last, $offset";
    $sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE PlayerStats.SteamID = PlayerRecords.SteamID) AS 'Cunt' FROM PlayerStats ORDER BY `GlobalPoints` DESC";
}
elseif($dataid === "alltime"){
    $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords ORDER BY `TimerTicks` ASC LIMIT $last, $offset";
    $sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords ORDER BY `TimerTicks` ASC ";
}
else{
    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE '{$dataid}'  ORDER BY `TimerTicks` ASC LIMIT $last, $offset";
    $sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE '{$dataid}' ORDER BY `TimerTicks` ASC ";
}





#/*
//$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC LIMIT $limit, $offset";
//$sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC ";
#SQL KTORE DAJA WSZYSTKIE REKORDY
#$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords ORDER BY `TimerTicks` ASC LIMIT $limit, $offset";
#$sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords ORDER BY `TimerTicks` ASC ";
//echo "KLIKLES TYLE: " . $clicked;
//echo "LAST: ". $last;
$resultAll = $conn->query($sqlAll);
$result = $conn->query($sql);

#echo "OSTATEK: " . $resultAll->num_rows;
#echo 'limit: ' .$limit . " last:" . $last;

if($last == $resultAll->num_rows){
    return;
}else{
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $i += 1;
            echo '<a test='.$i.' href="profile?sid=' . $row['SteamID'] . '/"><div';
            if ($i % 2 == 0) {
                echo ' id="stripped"';
            } else {
                echo "";
            }
            echo ' class="row" data_number="'.$i.'">
                <span>' . $i . '</span>
                <span>' . $row['PlayerName'] . '</span>';
                if(empty($row['FormattedTime'])){
                    echo '<span>' . $row['GlobalPoints'] . '</span>
                    <span>' . $row['Cunt'] . '</span>';
                }
                else{
                    echo '<span>' . $row['FormattedTime'] . '</span>
                    <span>' . $row['MapName'] . '</span>
                    <span>' . $row['TimesFinished'] . '</span>';
                }
                echo '</div></a>';
        }
        echo '<div class="last-row-number" data-last="'.$i.'"></div>';
    } 
}

#*/

?>