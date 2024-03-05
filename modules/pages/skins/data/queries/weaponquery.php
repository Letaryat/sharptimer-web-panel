<?php 
    require_once(dirname(__FILE__).'../../../../../../config.php');
    $sid = $conn -> real_escape_string($_POST['sid']);
    $wid = $conn -> real_escape_string($_POST['wid']);
    $paintid = $conn -> real_escape_string($_POST['paintid']);
    $knifes = array("500","503","505","506","507","508","509","512","514","515","516","517","518","519","520","521","522","523","525");
    //$sname = $conn -> real_escape_string($_POST['sname']);
    echo $sid;
    $wear = 0.01;
    $seed = 1;
    $sql = "SELECT * FROM wp_player_skins WHERE steamid = '{$sid}' AND weapon_defindex = '{$wid}'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sqlupdate = "UPDATE wp_player_skins SET weapon_paint_id = {$paintid}, weapon_wear = {$wear}, weapon_seed = {$seed} WHERE steamid = {$sid} AND weapon_defindex = {$wid}";
        if ($conn->query($sqlupdate) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      else{
        $sqladd = "INSERT INTO wp_player_skins (steamid, weapon_defindex, weapon_paint_id, weapon_wear, weapon_seed) VALUES ({$sid}, {$wid}, {$paintid}, {$wear}, {$seed})";
        echo $sqladd;
        if ($conn->query($sqladd) === TRUE) {

        } else {
          echo "Error: " . $sqladd . "<br>" . $conn->error;
        }
      }

?>