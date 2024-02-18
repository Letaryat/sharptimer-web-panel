<?php
require_once("../../functions.php");
require_once("../../config.php");
$i = 0;
$last = $_GET['last'];
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 5;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;
$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC LIMIT $limit, $offset";
$sqlAll = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE MapName LIKE 'surf_ace' ORDER BY `TimerTicks` ASC ";
$resultAll = $conn->query($sqlAll);
echo "LAST: ". $last;
echo "OSTATEK: " . $resultAll->num_rows;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $i++;
        if($i === $resultAll->num_rows){
         echo '<div class="asd" data-last="'.$i.'">KURWA KONIEC</div>';
        }
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