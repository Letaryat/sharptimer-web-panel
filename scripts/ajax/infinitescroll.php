<?php
require_once("../../functions.php");
require_once("../../config.php");
$i = 0;
//$last = $_GET['last'];
$clicked = $_GET['clicked'];
$dataid = $_GET['dataid'];
$checkdata;
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 5;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
//$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC LIMIT $limit, $offset";
//$sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC ";

#SQL KTORE DAJA WSZYSTKIE REKORDY
$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords ORDER BY `TimerTicks` ASC LIMIT $limit, $offset";
$sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords ORDER BY `TimerTicks` ASC ";

$resultAll = $conn->query($sqlAll);
//echo "KLIKLES TYLE: " . $clicked;
//echo "LAST: ". $last;
//echo "OSTATEK: " . $resultAll->num_rows;
$result = $conn->query($sql);
if($limit > $resultAll->num_rows){
    echo "przed: " . $limit;
    $limit = 5;
    echo " po : " . $limit;
}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $i++;
        echo '<a test='.$i.' href="profile?sid=' . $row['SteamID'] . '/"><div';
        if ($i % 2 == 0) {
            echo ' id="stripped"';
        } else {
            echo "";
        }
        echo ' class="row" data_number="'.$i.'">
            <span>' . $i . '</span>
            <span>' . $row['PlayerName'] . '</span>
            <span>' . $row['FormattedTime'] . '</span>
            <span>' . $row['MapName'] . '</span>
            <span>' . $row['TimesFinished'] . '</span>
            </div></a>';
    }
} 


?>