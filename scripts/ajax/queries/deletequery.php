<?php
require('../../../config.php');
$map = $conn -> real_escape_string($_POST['map']);
if(isset($_POST['steamid'])){
    $steamids = $_POST['steamid'];
    for($a = 0; $a < count($steamids); $a++){
        $sqldel = "DELETE from playerrecords WHERE SteamID = '$steamids[$a]' AND MapName = '$map';";
        $conn->query($sqldel);
    }
}



?>