<?php
require_once("../../config.php");
require_once("../../functions.php");
$steamdata = $conn -> real_escape_string($_POST['steamdata']);
$map = $conn -> real_escape_string($_POST['mapname']);
$sql = "SELECT * from PlayerRecords WHERE `SteamID` LIKE '{$steamdata}%' AND `MapName` LIKE '{$map}'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result-> fetch_assoc()){?>
    <div class="modal-content">
        <h3>Are you sure you want to delete this record?</h3>
    </div>


    <?php }
}
?>