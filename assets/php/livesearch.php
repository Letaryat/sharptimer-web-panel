<?php 

    include("../../config.php");

    $i = 0;
    if(isset($_POST['input'])){
        $input = $conn -> real_escape_string($_POST['input']);
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE `PlayerName` LIKE '{$input}%' OR `SteamID` LIKE '{$input}%' ORDER BY `TimerTicks`";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $i++;
                echo '<a target="_blank" href="profile/'.$row['SteamID'] . '/"><div';
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
        else{
            echo "<div id='strangerdanger' class='row'>Player not found.</div>";
        }
    }

?>