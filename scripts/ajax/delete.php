<?php
require_once("../../config.php");
require_once("../../functions.php");
$map = $conn -> real_escape_string($_POST['mapname']);
echo "<div class='modal-content' style='display:grid;height: 500px;
grid-template-rows: 1fr 5fr 1fr;'>";
if(isset($_POST['checkbox'])){
    $checkbox = $_POST['checkbox'];
    echo '<h4>Are you sure that you want to delete these records:</h4><div style="min-height: 350px;max-height: 350px;
    overflow: scroll;width: 100%;">';
    for($a = 0; $a < count($checkbox); $a++){
        $b = $checkbox[$a];
        $sql = "SELECT * from PlayerRecords WHERE `SteamID` LIKE '{$b}' AND `MapName` LIKE '{$map}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="delete-info" data-map='.$map.' data-deleteid="'.$b.'" style="display: grid;
                grid-template-columns:1fr 1fr 1fr;
                width: 100%;
                margin-top:5px;
                box-sizing: border-box;
                padding: 10px;
                border-bottom: 1px solid var(--stripe-hover);">
                <span>'.$row['PlayerName'].'</span>'.
                '<span>'.$row['FormattedTime'].'</span>'.
                '<span>'.$row['MapName'].'</span>'.
                '</div>
                
                ';
            }
        }
    }
    echo '</div><div id="cancel" >DELETE RECORDS</div>';
}
else{
    $checkbox = "";
    echo "<div style='width:100%; height:500px; display:flex; justify-content:center; align-items:center;'><h3>Firstly, you need to check records to delete them.</h3></div>";
}

?>

<script>
    $('#cancel').on('click',function(){
        var steamid = new Array();
        var map = $('.delete-info').data('map');
        $(".delete-info").each(function(){
            steamid.push($(this).data('deleteid'));
        })
        console.log(steamid);
        $.ajax({
            url:'scripts/ajax/deletequery.php',
            type: 'POST',
            data: {steamid: steamid, map:map},
            dataType: 'text',
            success: function(data){
                //console.log(data);
                location.reload()
            },
            error:function(jqXHR,textStatus,errorThrown){
                console.log(errorThrown);
            }
        })
    })
</script>

<?php 
echo '</div>';

?>