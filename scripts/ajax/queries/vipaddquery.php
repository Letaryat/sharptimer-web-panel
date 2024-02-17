<?php
require('../../../config.php');
    $nick = $conn->real_escape_string($_POST['nickname']);
    $gif = $conn->real_escape_string($_POST['gif']);
    $steam = $conn->real_escape_string($_POST['steam_id']);
    $sql = "SELECT * FROM PlayerStats WHERE SteamID = '{$steam}'";
    $gifexp = explode('/', $gif);
    $gifexp2 = explode('.gif', $gifexp[3]);
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $sqlupdate = "UPDATE PlayerStats SET PlayerName = '$nick', BigGifID = '$gifexp2[0]', IsVip = '1' WHERE SteamID = '$steam'";
      if ($conn->query($sqlupdate) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    else{
      $sqladd = "INSERT INTO PlayerStats (SteamID, PlayerName, TimesConnected, LastConnected, GlobalPoints, HideTimerHud, HideKeys, SoundsEnabled, IsVip, BigGifID) VALUES ('{$steam}', '{$nick}', 0, 0, 0, 0, 0, 0, 1, '{$gif}')";
      if ($conn->query($sqladd) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }





?>