<?php
require('../../../config.php');
if(isset($_POST['steamid'])){
    $steamids = $_POST['steamid'];
    for($a = 0; $a < count($steamids); $a++){
        $steamidx = $steamids[$a];
        echo $steamidx;
        $sql = "UPDATE PlayerStats SET IsVip = 0 WHERE SteamID = '$steamidx'";
        if ($conn->query($sql) === TRUE) {
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }
}



?>