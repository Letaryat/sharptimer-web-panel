<?php 
    require_once(dirname(__FILE__).'../../../../../../config.php');
    $sid = $conn -> real_escape_string($_POST['sid']);
    $wid = $conn -> real_escape_string($_POST['wid']);
    $paintid = $conn -> real_escape_string($_POST['paintid']);
    //$sname = $conn -> real_escape_string($_POST['sname']);
    $sql = "SELECT * FROM wp_player_agents WHERE steamid = {$sid}";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      if($wid == 2){
        $sqlupdate = "UPDATE wp_player_agents SET agent_t = '{$paintid}' WHERE steamid = {$sid}";
      } 
      else{
        $sqlupdate = "UPDATE wp_player_agents SET agent_ct = '{$paintid}' WHERE steamid = {$sid}";
      }
        //$sqlupdate = "UPDATE wp_player_agents SET weapon_paint_id = {$paintid}, weapon_wear = {$wear}, weapon_seed = {$seed} WHERE steamid = {$sid} AND weapon_defindex = {$wid}";
        if ($conn->query($sqlupdate) === TRUE) {
        } else {
          echo "[20] Error: " . $sql . "<br>" . $conn->error;
        }
      }
      else{
        if($wid == 2){
          $sqladd = "INSERT INTO wp_player_agents (steamid, agent_ct, agent_t) VALUES ({$sid}, 0, '{$paintid}')";
        }
        else{
          $sqladd = "INSERT INTO wp_player_agents (steamid, agent_ct, agent_t) VALUES ({$sid}, '{$paintid}', 0)";
        }
        //echo $sqladd;
        if ($conn->query($sqladd) === TRUE) {

        } else {
          echo "[34] Error: " . $sqladd . "<br>" . $conn->error;
        }
      }

?>