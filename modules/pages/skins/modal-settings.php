<?php 
    require_once("class/poorfunctions.php");
    $sid = $_POST['steam_id'];
    $wid = $_POST['weapon_id'];
    $sname = $_POST['skin_name'];
    //echo $sid;
    //echo $sid . " " . $wid . " " . $sname . "<br/>";
?>
<div class="modal-content">
<div style="display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 600;">
    <?php 
        getskinimg($wid, $sname);
        getskinname($wid, $sname);
    ?>
</div>
<form id="#form" >
    <label for="seed">Seed:</label>
    <input type="number" id="seed" name="seed" min="0" max="999" value="1" required>
    <label for="time">Wear:</label>
    <p id="wear-value">0.01</p>
    <input type="range" min="0.01" max="0.99" step="0.01" value="0.01" id="scale">
    <div class="form-button-container">
    <input id="success" type="submit" value="Update">
    </div>
</form>
</div>

<script>
    var wear = document.querySelector("#wear-value");
    document.getElementById("scale").oninput = function(){
        wear.innerHTML = this.value;
        console.log("test");
    }

    $("form").submit(function (event) {
            var formData = {
                sid: <?php echo $sid ?>,
                wid: <?php echo $wid ?>,
                sname: <?php echo $sname ?>,
                seed : $('#seed').val(),
                wear : $('#scale').val(),
            };
            $.ajax({
                type: "POST",
                url: "modules/pages/skins/data/queries/weaponsettings.php",
                data: formData,
                encode: true,
                success: function (data) {
                    setTimeout(() => {
                        console.log(data);
                        location.reload()
                    }, 200);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
            event.preventDefault();
        });

</script>