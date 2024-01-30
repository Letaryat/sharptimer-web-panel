<?php
    require_once("../../../functions.php");
    require_once("../../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = '{$id}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
    #$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = 'surf_mesa_revo'  ORDER BY `TimerTicks` ASC";

    ShowRowsAdminPanel($sql);
?>

<script>
            $('.edit').on('click', function () {
            $("input:checked").each(function(){
                $('input:checkbox').prop('checked', false);
            })
            var steam_id = $(this).data('steamid');
            var map_name = $(this).data('mapname');
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            $.ajax({
                url: 'scripts/ajax/adminpanel/edit.php',
                type: 'POST',
                data: { steamdata: steam_id, mapname: map_name},
                dataType: 'text',
                success: function (data) {
                    $('.modal-container').html(data);
                    //console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-container').html('');
                    alert('Error Loading');
                }
            });
        });
</script>