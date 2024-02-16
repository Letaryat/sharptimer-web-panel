<link rel="stylesheet" type="text/css" href="./assets/css/profiles.css?version=0">
<div id="profile-wrapper" class="wrapper">
    <div class="profileheader <?php if ($rowsec['IsVip'] === "1") {
        echo 'vip';
    } ?>">
        <div class="user-info">
            <a href="https://steamcommunity.com/profiles/<?php echo $row['SteamID'] ?>">
                <div class="avatar">
                    <img src="<?php echo getAvatar($sid) ?>" alt="<?php echo $sid ?>">
                </div>
            </a>

            <div class="infos">
                <h3>
                    <?php if (empty($row['PlayerName'])) {
                        echo 'Player stats not found';
                    } else {
                        echo $row['PlayerName'];
                    } ?>
                </h3>
                <span>
                    <img id="rank" src="./assets/images/ranks/sharptimer/s<?php echo $rand ?>.svg" alt="rank">
                    <p>
                        <?php if (empty($rowsec)) {
                            echo "no info";
                        } else {
                            echo $rowsec['GlobalPoints'] . " points";
                        } ?>
                    </p>
                </span>

            </div>
        </div>
    </div>
    <div class="player-settings">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="statistics">
                            <h4>Times connected</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    echo $rowsec['TimesConnected'];
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-plug"></i>
                        </div>
                        <div class="statistics">
                            <h4>Last Connected</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    echo date("Y-m-d H:i:s", $rowsec['LastConnected']);
                                } ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="statistics">
                            <h4>Favourite map</h4>
                            <p>
                                <?php if (empty($rowfav)) {
                                    echo "no info";
                                } else {
                                    echo "<i>" . $rowfav['MapName'] . "</i> - " . $rowfav['TimesFinished'];
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div class="statistics">
                            <h4>Records</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    echo mysqli_num_rows($result);
                                } ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-stopwatch-20"></i>
                        </div>
                        <div class="statistics">
                            <h4>Timer</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    if ($rowsec['HideTimerHud'] === "1") {
                                        echo "On";
                                    } else {
                                        echo "Off";
                                    }
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-regular fa-keyboard"></i>
                        </div>
                        <div class="statistics">
                            <h4>Hidden keys</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    if ($rowsec['HideKeys'] === "1") {
                                        echo "On";
                                    } else {
                                        echo "Off";
                                    }
                                } ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-volume-off"></i>
                        </div>
                        <div class="statistics">
                            <h4>Sounds</h4>
                            <p>
                                <?php if (empty($rowsec)) {
                                    echo "no info";
                                } else {
                                    if ($rowsec['SoundsEnabled'] === "1") {
                                        echo "On";
                                    } else {
                                        echo "Off";
                                    }
                                } ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<main>
    <div class="wrapper">
        <div class="map-list2">
            <div id="sticky">
                <div class="togglemaps" onclick="toggleMaps()"></div>
                <ul class="modes">

                    <?php
                    if ($mapdivision === true) {
                        if ($resultsurf->num_rows > 0) {
                            echo '<li class="tablink ';
                            if ($tabopened == "surf") {
                                echo ' active"';
                            } else {
                                echo '"';
                            }
                            echo 'onclick="openMode(event,' . "'surf'" . ')">Surf</li>';
                        }
                        if ($resultbh->num_rows > 0) {
                            echo '<li class="tablink ';
                            if ($tabopened == "bh") {
                                echo ' active"';
                            } else {
                                echo '"';
                            }
                            echo 'onclick="openMode(event,' . "'bh'" . ')">Bhop</li>';
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
                    <li class="selector active" data-id="%" onclick="selectorActive(event)">All Personal Best</li>
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
        <div id="profile-leaderboard" class="leaderboard">
            <div class="info">
                <div class="row">
                    <span> <i class="fa-solid fa-ranking-star"></i> </span>
                    <span> <i class="fa-solid fa-person-running"></i> Player </span>
                    <span> <i class="fa-solid fa-clock"></i> Time</span>
                    <span> <i class="fa-solid fa-map"></i> Map </span>
                    <span> <i class="fa-solid fa-flag-checkered"></i> Finished </span>
                </div>
            </div>
            <div class="players">
                <?php
                //$sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished` FROM PlayerRecords WHERE SteamID = '{$sidexplode[0]}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
                $sql = "SELECT `SteamID`, `PlayerName`, `FormattedTime`, `MapName`, `TimesFinished`, RANK() OVER(ORDER BY `TimerTicks` ASC) AS 'Ranking' FROM PlayerRecords ORDER BY `TimerTicks` ASC";
                ShowRowsProfile($sql, $sidexplode[0])
                /*
                $i = 0;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        echo '<div';
                        if ($i % 2 == 0) {
                            echo ' id="stripped"';
                        } else {
                            echo "";
                        }
                        echo ' class="row">
                            <span>' . $i . '</span>
                            <span>' . $row['PlayerName'] . '</span>
                            <span>' . $row['FormattedTime'] . '</span>
                            <span>' . $row['MapName'] . '</span>
                            <span>' . $row['TimesFinished'] . '</span>
                            </div>';
                    }
                } else {
                    echo "<div id='strangerdanger' class='row'>Player not found.</div>";
                }
                */
                ?>
            </div>
        </div>
    </div>
</main>
<?php require_once('partials/footer.php') ?>
<script>
    $('.selector').on('click', function () {
        var data_id = $(this).data('id');
        var sid_data = "<?php echo $sidexplode[0] ?>";
        $.ajax({
            url: 'scripts/ajax/selectionprofile.php',
            type: 'POST',
            data: { id: data_id, sid: sid_data },
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

    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        autoplay: true,
        loop: true,
        slidesPerView: 4,
        spaceBetween: 10,
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        breakpoints: {
            320: {
                slidesPerView: 2,

            },
            480: {
                slidesPerView: 3,

            },
            640: {
                slidesPerView: 4,

            }
        }
    });


</script>
</body>

</html>