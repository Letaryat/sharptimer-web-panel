<?php
require_once("../../../config.php");
require_once("../../../functions.php");
$steamdata = $conn->real_escape_string($_POST['steamdata']);
$map = $conn->real_escape_string($_POST['mapname']);
$sql = "SELECT * from PlayerRecords WHERE `SteamID` LIKE '{$steamdata}%' AND `MapName` LIKE '{$map}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedtime = $row['FormattedTime'];
        if (strlen($formattedtime) <= "8") {
            $formattedtime = "0" . $formattedtime;
        } else {
            #echo "wieksze " . strlen($formattedtime);
        }
        echo '<div class="modal-content">
        <div id="steam-id" class="player-edit rotate" data-steam="' . $steamdata . '">
        <img src="' . getAvatar($steamdata) . '" alt="' . $row['PlayerName'] . '">
        <h3>' . $row['PlayerName'] . '</h3>    
        </div>
        <p class="mapname-edit" data-mapname="' . $map . '">Map: ' . $map . '</p>
        <form id="#form" action="scripts/ajax/editquery.php" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" value="' . $row['PlayerName'] . '" required>
        <label for="time">Time:</label>
        <input id="formattedtime" minlength="9" type="text" value="' . $formattedtime . '" name="time">
        <label for="time">Ticks:</label>
        <input id="ticks" type="text" class="time" name="ticks" value="' . $row['TimerTicks'] . '" required >
        <label for="finished">Times Finished</label>
        <input type="number" min="0" id="finished" name="finished" value="" required>
        <div class="form-button-container">
        <input id="success" type="submit" value="Update">
        </div>
        </form>

        
';
    }
}




?>


<script>
    var formattedtime = "<?php echo $formattedtime ?>";
    $(document).ready(function () {
        console.log(formattedtime.length);
        $('#formattedtime').mask('00:Z0.000', {translation:  {'Z': {pattern: /[0-6]/, optional: false}}});
        /*
        if( formattedtime.length <= 8){
            $('#formattedtime').mask('0:00.000');
        }else{
            $('#formattedtime').mask('00:00.000');
        }
        */

    })
    $("form").submit(function (event) {
            var formData = {
                nickname: $("#nickname").val(),
                ftime: $("#formattedtime").val(),
                ticks: $("#ticks").val(),
                steam_id : $('#steam-id').data('steam'),
                map_name : $('.mapname-edit').data('mapname'),
            };
            $.ajax({
                type: "POST",
                url: "scripts/ajax/queries/editquery.php",
                data: formData,
                encode: true,
                success: function (data) {
                    console.log(data)
                    setTimeout(() => {
                        location.reload()
                    }, 500);
                    //$("#refresh").load(" #refresh > *");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
            event.preventDefault();
        });


    var input = document.querySelector('#formattedtime');
    var wynik = document.querySelector('.time');
    input.addEventListener('input', function () {
        /*
        if(input.value[3] > 6){
            alert('nie wolno');
        }
        */
        var minutesinput = input.value[0] + input.value[1];
        var minutes = minutesinput * 60;
        var seconds = input.value[3] + input.value[4];
        var mili = input.value[6] + input.value[7] + input.value[8];
        var sum = +minutes + +seconds + +(mili / 1000);
        var tick = Math.round(sum * 64);
        if (isNaN(tick)) {
            wynik.value = "Use correct format";
        }
        else {
            wynik.value = tick;
        }



    });

</script>

<?php echo '</div>';?>