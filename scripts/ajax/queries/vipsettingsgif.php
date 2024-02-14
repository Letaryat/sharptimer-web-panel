<?php
require('../../../config.php');
$gif = $_POST['gifurl'];
$steam = $_POST['steam_id'];
$nick = $_POST['nick'];
$sql = "SELECT * FROM PlayerStats WHERE SteamID = '{$steam}'";
$result = $conn->query($sql);
$gifsize = getimagesize($gif);
if($gifsize !== false){
  if($gifsize[0] <= 275 && $gifsize[1] <= 55 ){
    if ($result->num_rows > 0) {
      $sqlupdate = "UPDATE PlayerStats SET BigGifID = '$gif' WHERE SteamID = '$steam'";
      echo "";
      if ($conn->query($sqlupdate) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      $sqladd = "INSERT INTO PlayerStats (SteamID, PlayerName, TimesConnected, LastConnected, GlobalPoints, HideTimerHud, HideKeys, SoundsEnabled, IsVip, BigGifID) VALUES ('{$steam}', '{$nick}', 0, 0, 0, 0, 0, 0, 1, '{$gif}')";
      if ($conn->query($sqladd) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
  else{
    if($gifsize[0] <= 275){
      echo "mniejsze";
    }
    echo $gifsize[0]." ".$gifsize[1];
  }
}

?>