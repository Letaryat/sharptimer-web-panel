<?php
require('../../../config.php');
    $nick = $_POST['nickname'];
    $gif = $_POST['gif'];
    $steam = $_POST['steam_id'];
    $sql = "SELECT * FROM PlayerStats WHERE SteamID = '{$steam}'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      echo "chuj jeden";
      $sqlupdate = "UPDATE PlayerStats SET PlayerName = '$nick', BigGifID = '$gif', IsVip = '1' WHERE SteamID = '$steam'";
      if ($conn->query($sqlupdate) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    else{
      echo "chuj dwa";
      $sqladd = "INSERT INTO PlayerStats (SteamID, PlayerName, TimesConnected, LastConnected, GlobalPoints, HideTimerHud, HideKeys, SoundsEnabled, IsVip, BigGifID) VALUES ('{$steam}', '{$nick}', 0, 0, 0, 0, 0, 0, 1, '{$gif}')";
      if ($conn->query($sqladd) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }





?>