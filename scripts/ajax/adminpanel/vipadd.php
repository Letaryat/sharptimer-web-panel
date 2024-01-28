<?php
require_once("../../../config.php");
require_once("../../../functions.php");
?>
<div class="modal-content">
        <h3>Add new VIP</h3>
        <form id="#form" action="scripts/ajax/editquery.php" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname" required>
        <label for="steamid">SteamID64:</label>
        <input type="text" id="steamid" name="nickname" required>
        <label for="gif">Gif URL</label>
        <input id="gif" type="text" class="time" name="gif" required >
        <div class="form-button-container">
        <input id="success" type="submit" value="Update">
        </div>
        </form>     


<script>
    $("form").submit(function (event) {
            var formData = {
                nickname: $("#nickname").val(),
                gif: $("#gif").val(),
                steam_id : $('#steamid').val(),
            };
            $.ajax({
                type: "POST",
                url:'scripts/ajax/queries/vipaddquery.php',
                data: formData,
                dataType: 'text',
                encode: true,
                success: function (data) {
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