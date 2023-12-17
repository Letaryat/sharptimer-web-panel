<?php
require("../../config.php");
$i = 0;
$id = $conn -> real_escape_string($_POST['id']);
$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = '{$id}'  ORDER BY `TimerTicks` ASC LIMIT $limit";

$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $i++;
        echo '<a target="_blank" href="/sharptimer-web-panel/profile/' . $row['SteamID'] . '/"><div';
        if($i % 2 == 0){
            echo ' id="stripped"';
        }
        else{echo "";}
        echo ' class="row">
        <span>'.$i.'</span>
        <span>'.$row['PlayerName'].'</span>
        <span>'.$row['FormattedTime'].'</span>
        <span>'.$row['MapName'].'</span>
        </div></a>';
    }
}

?>
