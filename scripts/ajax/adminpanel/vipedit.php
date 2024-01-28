<?php
require_once("../../../config.php");
require_once("../../../functions.php");
$steamdata = $conn->real_escape_string($_POST['steamdata']);
$sql = "SELECT * from PlayerStats WHERE `SteamID` LIKE '{$steamdata}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="modal-content">
        <div id="steam-id" class="player-edit rotate" data-steam="' . $steamdata . '">
        <img src="' . getAvatar($steamdata) . '" alt="' . $row['PlayerName'] . '">
        <h3>' . $row['PlayerName'] . '</h3>    
        </div>
        <form id="#form" action="scripts/ajax/editquery.php" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" value="' . $row['PlayerName'] . '" required>
        <label for="gif">Gif URL</label>
        <input id="gif" type="text" class="time" name="gif" value="' . $row['BigGifID'] . '" required >
        <label for="isvip">IsVip</label>
        <input type="number" min="0" max="1" id="isvip" name="isvip" value="'.$row['IsVip'].'" required>
        <div class="form-button-container">
        <input id="success" type="submit" value="Update">
        </div>
        </form>        
';
    }
}




?>


<script>
    $("form").submit(function (event) {
            var formData = {
                nickname: $("#nickname").val(),
                gif: $("#gif").val(),
                vip: $("#isvip").val(),
                steam_id : $('#steam-id').data('steam'),
            };
            $.ajax({
                type: "POST",
                url: "scripts/ajax/queries/vipeditquery.php",
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




</script>

<?php echo '</div>';?>