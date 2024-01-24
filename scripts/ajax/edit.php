
<?php
require_once("../../config.php");
require_once("../../functions.php");
$steamdata = $conn->real_escape_string($_POST['steamdata']);
$map = $conn->real_escape_string($_POST['mapname']);
$sql = "SELECT * from PlayerRecords WHERE `SteamID` LIKE '{$steamdata}%' AND `MapName` LIKE '{$map}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedtime = $row['FormattedTime'];
        if(strlen($formattedtime) <= "8"){
            $formattedtime = "0".$formattedtime;
        }
        else{
            echo "wieksze ".strlen($formattedtime);
        }
        echo '<div class="modal-content">
        <div class="player-edit rotate">
        <img src="' . getAvatar($steamdata) . '" alt="' . $row['PlayerName'] . '">
        <h3>' . $row['PlayerName'] . '</h3>    
        </div>
        <p id="mapname-edit">Map: ' . $map . '</p>
        <form>
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" value="'.$row['PlayerName'].'" required>
        <label for="time">Time:</label>
        <input class="testek" type="text" value="'.$formattedtime.'" name="czas">
        <label for="time">Ticks:</label>
        <input type="text" class="time" name="time" value="'.$row['TimerTicks'].'" required disabled>
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


<script>
    $(document).ready(function () {
        $('.testek').mask('00:00.000');
    })


    let input = document.querySelector('.testek');
    let wynik = document.querySelector('.time');
    input.addEventListener('input', function () {
        var minutesinput = input.value[0] + input.value[1];
        var minutes = minutesinput * 60;
        var seconds = input.value[3] + input.value[4];
        var mili = input.value[6] + input.value[7] + input.value[8];
        let sum = +minutes + +seconds + +(mili / 1000);
        let tick = Math.round(sum * 64);
        if(isNaN(tick)){
            wynik.value = "Use correct format";
        }
        else{
            wynik.value = tick;
        }

    });

</script>