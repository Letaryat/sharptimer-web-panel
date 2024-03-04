<?php 
    require_once(dirname(__FILE__).'../../../../../../config.php');
    $sid = $conn -> real_escape_string($_POST['sid']);
    $wid = $conn -> real_escape_string($_POST['wid']);
    $sname = $conn -> real_escape_string($_POST['sname']);
    $seed = $conn -> real_escape_string($_POST['seed']);
    $wear = $conn -> real_escape_string($_POST['wear']);
    $sql = "SELECT * FROM wp_player_skins WHERE steamid = {$sid} AND weapon_defindex = {$wid}";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sqlupdate = "UPDATE wp_player_skins SET weapon_paint_id = {$sname}, weapon_wear = {$wear}, weapon_seed = {$seed} WHERE steamid = {$sid} AND weapon_defindex = {$wid}";
        if ($conn->query($sqlupdate) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      else{
        $sqladd = "INSERT INTO wp_player_skins (steamid, weapon_defindex, weapon_paint_id, weapon_wear, weapon_seed) VALUES ('{$sid}', '{$wid}', '{$sname}, {$wear}, {$seed}'')";
        if ($conn->query($sqladd) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

?>