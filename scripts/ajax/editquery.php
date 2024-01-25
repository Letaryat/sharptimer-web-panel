<?php
    require('../../config.php');
    $nick = $_POST['nickname'];
    $ftime = $_POST['ftime'];
    $ticks = $_POST['ticks'];
    $steamid = $_POST['steam_id'];
    $map = $_POST['map_name'];
    echo $nick . " " . $ftime . " " . $ticks . " " . $steamid . " " . $map;
    #$sql = "INSERT INTO playerrecords (MapName, SteamID, PlayerName, TimerTicks, FormattedTime) VALUES ('$map','$steam','$nickname','$ticks','$time')";
    $sql = "UPDATE playerrecords SET PlayerName = '$nick', TimerTicks = '$ticks', FormattedTime = '$ftime' WHERE SteamID = '$steamid' AND MapName = '$map'";
    if ($conn->query($sql) === TRUE) {
        header("Refresh: 0");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

?>