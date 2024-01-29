<?php
    require('../../../config.php');
    $nick = $conn->real_escape_string($_POST['nickname']);
    $gif = $conn->real_escape_string($_POST['gif']);
    $vip = $conn->real_escape_string($_POST['vip']);
    $steamid = $conn->real_escape_string($_POST['steam_id']);
    echo $nick . " " . $gif . " " . $vip . " " . $steamid . " ";
    $sql = "UPDATE PlayerStats SET PlayerName = '$nick', BigGifID = '$gif', IsVip = '$vip' WHERE SteamID = '$steamid'";
    if ($conn->query($sql) === TRUE) {
        header("Refresh: 0");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

?>