<link rel="stylesheet" href="views/assets/css/adminpanel.css">
<div style="position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 100%;
  flex-flow: column;
  box-sizing: border-box;
  margin-top: 15px;
  ">
<div class="adminpanel">
            <p>Welcome back to the Poor-Panel</p>
            <p>What are we going to do today?</p>
            <ul class="admin-functions">
                <a class="delete"><li>DELETE</li></a>
                <a class="vip" href="vippanel"><li>Manage VIP</li></a>
            </ul>
        </div>
</div>
       <main>
    <div class="wrapper">

    <div class="map-list2">
                <div id="sticky">
                <div class="togglemaps" onclick="toggleMaps()"></div>
                    <ul class="modes">
                        <?php
                        //SURF SQL:
                        $sqlsurf = "SELECT DISTINCT MapName FROM `PlayerRecords` WHERE MapName LIKE 'SURF%' ORDER BY MapName ASC ";
                        $resultsurf = $conn->query($sqlsurf);
                        //KZ SQL:
                        $sqlkz = "SELECT DISTINCT MapName FROM `PlayerRecords` WHERE MapName LIKE 'KZ%' ORDER BY MapName ASC ";
                        $resultkz = $conn->query($sqlkz);
                        //BunnyHop SQL:
                        $sqlbh = "SELECT DISTINCT MapName FROM `PlayerRecords` WHERE MapName LIKE 'BHOP%' ORDER BY MapName ASC ";
                        $resultbh = $conn->query($sqlbh);
                        //OTHERS SQL:
                        $sqlother = "SELECT DISTINCT MapName FROM `PlayerRecords` WHERE MapName NOT LIKE 'BHOP%' AND MapName NOT LIKE 'SURF%' AND MapName NOT LIKE 'KZ%' ORDER BY MapName ASC ";
                        $resultother = $conn->query($sqlother);
                        if ($mapdivision === true) {
                            if ($resultsurf->num_rows > 0) {
                                echo '<li class="tablink';
                                if ($tabopened == "surf") {
                                    echo ' active"';
                                } else {
                                    echo '"';
                                }
                                echo 'onclick="openMode(event,' . "'surf'" . ')">SURF</li>';
                            }
                            if ($resultbh->num_rows > 0) {
                                echo '<li class="tablink';
                                if ($tabopened == "bh") {
                                    echo ' active"';
                                } else {
                                    echo '"';
                                }
                                echo 'onclick="openMode(event,' . "'bh'" . ')">BH</li>';
                            }
                            if ($resultkz->num_rows > 0) {
                                echo '<li class="tablink';
                                if ($tabopened == "kz") {
                                    echo ' active"';
                                } else {
                                    echo '"';
                                }
                                echo 'onclick="openMode(event,' . "'kz'" . ')">KZ</li>';
                            }
                            if ($resultother->num_rows > 0) {
                                echo '<li class="tablink';
                                if ($tabopened == "other") {
                                    echo ' active"';
                                } else {
                                    echo '"';
                                }
                                echo 'onclick="openMode(event,' . "'other'" . ')">Other</li>';
                            }
                        } else {
                            echo "";
                        }
                        ?>

                    </ul>
                    <ul class="mappeno" <?php 
                    if ($mapdivision === false){ 
                        echo 'style="display: block"';
                    }else {
                        echo "";
                    }
                    
                    ?>>
                    <?php
                        if ($mapdivision === true) {
                            if ($resultsurf->num_rows > 0) {
                                echo '<ol id="surf" class="content';
                                if ($tabopened === "surf") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultsurf->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '" onclick="selectorActive(event)">' . $row['MapName'] . '</li>';
                                } ?>

                                <?php
                                echo '</ol>';
                            }
                            if ($resultbh->num_rows > 0) {
                                echo '<ol id="bh" class="content';
                                if ($tabopened === "bh") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultbh->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</ol>';
                            }
                            if ($resultkz->num_rows > 0) {
                                echo '<ol id="kz" class="content';
                                if ($tabopened === "kz") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultkz->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</ol>';
                            }
                            if ($resultother->num_rows > 0) {
                                echo '<ol id="other" class="content';
                                if ($tabopened === "other") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultother->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</ol>';
                            }
                        } else {
                            $sql = "SELECT DISTINCT MapName FROM `PlayerRecords` ORDER BY MapName ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }

                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

        <div class="leaderboard">
                <div class="info">
                    <div class="row">
                        <span> <i class="fa-solid fa-ranking-star"></i> </span>
                        <span> <i class="fa-solid fa-person-running"></i> Player </span>
                        <span> <i class="fa-solid fa-clock"></i> Time</span>
                        <span> <i class="fa-solid fa-map"></i> Map </span>
                        <span> <i class="fa-solid fa-map"></i> Action </span>
                    </div>
                </div>
                <div id="refresh" class="players">
                <div id='strangerdanger' class='row' style="grid-template-columns: 1fr 1fr;">If you want to manage records you need to choose map.</div>
                    <?php
                    /*
                    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = 'surf_mesa_revo'  ORDER BY `TimerTicks` ASC";
                    ShowRowsAdminPanel($sql);
                    */
                    
                    ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal">
    <div class="modal-exit"><i class="fa-solid fa-circle-xmark"></i></div>
        <div class="modal-container"></div>
    </div>
    <script>
        $('.selector').on('click', function () {
            var data_id = $(this).data('id');
            $.ajax({
                url: 'scripts/ajax/adminpanel/selectionadminpanel.php',
                type: 'POST',
                data: { id: data_id },
                dataType: 'text',
                success: function (data) {
                    $('.players').html(data);
                    //console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.players').html('');
                    alert('Error Loading');
                }
            });
        });


        $('.modal-exit').on('click', function(){
            console.log();
            $('.modal').addClass('fadeout');
            $('.modal-container').addClass("slidedown");
            setTimeout(function(){
            $('.modal').removeClass('active fadein fadeout');
            $('.modal-container').removeClass('slideup slidedown');
            $(document.body).removeClass('modalactive');
            $('.modal-content').remove();
            }, 500);
            $("input:checked").each(function(){
                $('input:checkbox').prop('checked', false);
            })
        })
        $('.delete').on('click', function () {
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            var checkbox = new Array();
            $("input:checked").each(function(){
                checkbox.push($(this).val());
            })
            var map_name = $('.edit').data('mapname');
            $.ajax({
                url: 'scripts/ajax/adminpanel/delete.php',
                type: 'POST',
                data: { checkbox: checkbox, mapname: map_name},
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
        /*
        $('.delete').on('click', function () {
            var steam_id = $(this).data('steamid');
            var map_name = $(this).data('mapname');
            console.log(steam_id);
            var modal = $('.modal');
            modal.addClass("active fadein");
            $.ajax({
                url: 'scripts/ajax/edit.php',
                type: 'POST',
                data: { steamdata: steam_id, mapname: map_name},
                dataType: 'text',
                success: function (data) {
                    $('.modal-content').html(data);
                    //console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-content').html('');
                    alert('Error Loading');
                }
            });
        });
        */
    </script>
</html>