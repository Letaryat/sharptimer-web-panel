<?php
require_once("../../config.php");
require_once("../../functions.php");
$steamdata = $conn -> real_escape_string($_POST['steamdata']);
$map = $conn -> real_escape_string($_POST['mapname']);
$sql = "SELECT * from PlayerRecords WHERE `SteamID` LIKE '{$steamdata}%' AND `MapName` LIKE '{$map}'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result-> fetch_assoc()){
        echo '<div class="modal-content">
        <div class="player-edit rotate">
        <img src="'.getAvatar($steamdata).'" alt="'.$row['PlayerName'].'">
        <h3>'.$row['PlayerName'].'</h3>    
        </div>
        <p id="mapname-edit">Map: '.$map.'</p>
        <form>
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" required>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" step="2" required>
        <label for="time">Ticks:</label>
        <input type="time" id="time" name="time" step="2" required>
        <label for="finished">Times Finished</label>
        <input type="number" min="0" id="finished" name="finished" required>
        <div class="form-button-container">
        <input id="success" type="submit" value="Update">
        </div></div>
        </form>
        
';

    }
}


?>