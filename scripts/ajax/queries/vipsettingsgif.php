<?php
require('../../../config.php');
$gif = $conn->real_escape_string($_POST['gifurl']);
$steam = $conn->real_escape_string($_POST['steam_id']);
$nick = $conn->real_escape_string($_POST['nick']);
$sql = "SELECT * FROM PlayerStats WHERE SteamID = '{$steam}'";
$result = $conn->query($sql);
//$gifvalidate = preg_match('/^(http|https):\/\/(.*?)\.(imgur)\.(com)\/(.*?)\.(png|jpg|gif|PNG|JPG|GIF)$/i',$gif);
$gifvalidate = preg_match('/^(http|https):\/\/(.*?)\.(imgur)\.(com)\/(.*?)\.(gif|GIF)$/i',$gif);
if(filter_var($gif, FILTER_VALIDATE_URL) === FALSE || $gifvalidate === 0){
  echo '<div style="display: flex;
  justify-content: space-between;
  align-items: center;" id="strangerdanger" class="toast-element slideup"><p>Provide a valid URL!</p></div>';
}
else{
  $gifsize = getimagesize($gif);
  if($gifsize !== false){
    if($gifsize[0] <= 275 && $gifsize[1] <= 55 ){
      if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE PlayerStats SET BigGifID = '$gif' WHERE SteamID = '$steam'";
        echo '<div style="display: flex;
        justify-content: space-between;
        align-items: center;" id="success" class="toast-element slideup"><p>Gif changed!</p></div>';
        if ($conn->query($sqlupdate) === TRUE) {
        } else {
          echo '<div style="display: flex;
          justify-content: space-between;
          align-items: center;" id="strangerdanger" class="toast-element slideup"><p>Error: '.$sql.' <br/>'.$conn->error.'</p></div>';

        }
      } else {
        $sqladd = "INSERT INTO PlayerStats (SteamID, PlayerName, TimesConnected, LastConnected, GlobalPoints, HideTimerHud, HideKeys, SoundsEnabled, IsVip, BigGifID) VALUES ('{$steam}', '{$nick}', 0, 0, 0, 0, 0, 0, 1, '{$gif}')";
        if ($conn->query($sqladd) === TRUE) {
        } else {
          echo '<div style="display: flex;
          justify-content: space-between;
          align-items: center;" id="strangerdanger" class="toast-element slideup"><p>Error: '.$sql.' <br/>'.$conn->error.'</p></div>';
        }
      }
    }
    else{
      echo '<div style="display: flex;
      justify-content: space-between;
      align-items: center;"  id="strangerdanger" class="toast-element slideup"><p>Gif is too big! <br/> Maximum: 275x55!</p></div>';
    }
  }
}


?>