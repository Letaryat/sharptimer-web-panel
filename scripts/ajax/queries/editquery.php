<?php
    require('../../../config.php');
    $nick = $conn->real_escape_string($_POST['nickname']);
    $ftime = $conn->real_escape_string($_POST['ftime']);
    $ticks = $conn->real_escape_string($_POST['ticks']);
    $steamid = $conn->real_escape_string($_POST['steam_id']);
    $map = $conn->real_escape_string($_POST['map_name']);
    echo $nick . " " . $ftime . " " . $ticks . " " . $steamid . " " . $map;
    #$sql = "INSERT INTO playerrecords (MapName, SteamID, PlayerName, TimerTicks, FormattedTime) VALUES ('$map','$steam','$nickname','$ticks','$time')";
    $sql = "UPDATE PlayerRecords SET PlayerName = '$nick', TimerTicks = '$ticks', FormattedTime = '$ftime' WHERE SteamID = '$steamid' AND MapName = '$map'";
    if ($conn->query($sql) === TRUE) {
        header("Refresh: 0");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

?>