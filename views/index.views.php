<?php if ($serverlist === true && !empty($serverq)) { ?>
    <div class="server-container">
        <div class="serverlist"></div>
    </div>
<?php } else {
    echo "";
} ?>
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
                if ($mapdivision === false) {
                    echo 'style="display: block"';
                } else {
                    echo "";
                }

                ?>>

                    <li class="selector active" data-id="global" onclick="selectorActive(event)">Global Points</li>

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
                                echo '<li class="selector" data-id="' . $row['MapName'] . '" onclick="selectorActive(event)">' . $row['MapName'] . '</li>';
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
                                echo '<li class="selector" data-id="' . $row['MapName'] . '" onclick="selectorActive(event)">' . $row['MapName'] . '</li>';
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
                                echo '<li class="selector" data-id="' . $row['MapName'] . '" onclick="selectorActive(event)">' . $row['MapName'] . '</li>';
                            }
                            echo '</ol>';
                        }
                    } else {
                        $sql = "SELECT DISTINCT MapName FROM `PlayerRecords` ORDER BY MapName ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="selector" data-id="' . $row['MapName'] . '" onclick="selectorActive(event)">' . $row['MapName'] . '</li>';
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
                    <span> <i class="fa-solid fa-clock"></i> Points</span>
                    <span> <i class="fa-solid fa-clock"></i> Maps Finished</span>
                </div>
            </div>
            <div class="players">
                <?php
                $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE playerstats.SteamID = playerrecords.SteamID) AS 'Cunt' FROM playerstats ORDER BY `GlobalPoints` DESC LIMIT $limit";
                ShowRowsGlobal($sql);
                ?>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        console.log('ladowanko');
        $.ajax({
            url: "views/serverlist.views.php",
            type: "POST",
            beforeSend: function () {
            $('.serverlist').html('<span style="text-align:center" class="loader"></span>');
            $('.serverlist').css('grid-template-columns', 'auto');
            $('.serverlist').css('justify-content', 'center');
            },
            success: function (data) {
                setTimeout(() => {
                    $('.serverlist').css('grid-template-columns', '');
                    $('.serverlist').css('justify-content', '');
                    //$('.server-container').addClass('fadein')
                    $('.server-container').addClass('slideup')
                    $('.serverlist').html(data);
                }, 50);
            }
        })
    })

    $('.selector').on('click', function () {
        var data_id = $(this).data('id');
        $.ajax({
            url: 'scripts/ajax/selection.php',
            type: 'POST',
            data: { id: data_id },
            dataType: 'text',
            beforeSend: function(){
                $('.players').html('<span style="text-align:center" class="loader"></span>');
                $('.players').css('display', 'flex');
                $('.players').css('justify-content', 'center');
            },
            success: function (data) {
                $('.players').css('display', '');
                $('.players').css('justify-content', '');
                $('.players').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.players').html('');
                alert('Error Loading');
            }
        });
    });

    $('.selector').on('click', function () {
        var data_id = $(this).data('id');
        $.ajax({
            url: 'scripts/ajax/rowinfo.php',
            type: 'POST',
            data: { id: data_id },
            dataType: 'text',
            success: function (data) {
                $('.info').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.info').html('');
                alert('Error Loading');
            }
        });
    });


    $(document).ready(function () {
        $("#search").keyup(function () {
            var input = $(this).val();
            if (input != "") {
                $.ajax({
                    url: 'scripts/ajax/livesearch.php',
                    type: 'POST',
                    data: { input: input },
                    dataType: 'text',
                    beforeSend: function(){
                        $('.players').css('display', 'flex');
                        $('.players').css('justify-content', 'center');
                        $('.players').html('<span style="text-align:center" class="loader"></span>');
                    },
                    success: function (data) {
                        $('.players').css('display', '');
                        $('.players').css('justify-content', '');
                        $('.players').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('.players').html('');
                        alert('Error Loading');
                    }
                });
            } else {
            }
        });
    });
</script>