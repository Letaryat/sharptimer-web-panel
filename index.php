<?php
require_once("config.php");
require_once('assets/GameQ/Autoloader.php');
require_once('assets/php/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php BaseURL(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css?version=3">
    <link href="assets/css/hamburgers.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $pagetitle ?>">
    <meta property="og:description" content="Your statistics in one place!">
    <meta property="og:url" content="">
    <meta property="og:image" content="https://i.imgur.com/6gHn8TN.png">
    <meta property="og:image:secure_url" content="https://i.imgur.com/6gHn8TN.png">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:footer" content="SharpTimer">
    <meta name="theme-color" content="#6389E8">
    <title>
        <?php echo $pagetitle ?>
    </title>
</head>

<body>
    <div id="top"></div>
    <div class="mobiletoggler" onclick="toggleMobile()">
        <button class="hamburger hamburger--spin" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
    <div class="mobile-nav">
        <ul>
            <?php
            if (isset($links)) {
                echo $links;
            } else {
                echo "";
            }
            ?>
        </ul>
    </div>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="assets/images/logo.png" alt="logo">
                <h1>
                    <?php echo $pagetitle ?>
                </h1>
                <div class="helpme">
                    <input id="search" type="search" placeholder="Search by Nickname or SteamID64">
                </div>
            </div>
            <ul>
                <?php
                if (isset($links)) {
                    echo $links;
                } else {
                    echo "";
                }
                ?>
            </ul>

        </div>

    </header>

    <?php if ($serverlist === true && !empty($serverq)) { ?>
        <div class="server-container">
            <div class="serverlist">
                <?php

                $GameQ = new \GameQ\GameQ();
                $GameQ->addServers($serverq);
                $GameQ->setOption('timeout', 5);
                $results = $GameQ->process();

                for ($x = 0; $x <= count($serverq) - 1; $x++) {
                    //$mapbackground = 'https://image.gametracker.com/images/maps/160x120/csgo/'.$results[$serverq[$x]['host']]['map'].".jpg";
                    ?>
                    <div class="server" <?php if ($results[$serverq[$x]['host']]['gq_online'] == "0") {
                        echo 'id="offline"';
                    } else {
                        echo 'id="online"';
                    } ?>>
                        <div class="basicinfo">
                            <h4>
                                <?php
                                if (empty($serverq[$x]['fakename'])) {
                                    if ($results[$serverq[$x]['host']]['gq_online'] == "0") {
                                        echo "Dead";
                                    } else {
                                        echo $results[$serverq[$x]['host']]['gq_hostname'];
                                    }
                                } else {
                                    echo $serverq[$x]['fakename'];
                                }
                                ?>
                            </h4>
                            <p><a href="steam://connect/<?php
                            if (empty($serverq[$x]['fakeip'])) {
                                echo $serverq[$x]['host'];
                            } else {
                                echo $serverq[$x]['fakeip'];
                            }
                            ?>">
                                    <?php
                                    if (empty($serverq[$x]['fakeip'])) {
                                        echo $serverq[$x]['host'];
                                    } else {
                                        echo $serverq[$x]['fakeip'];
                                    } ?>
                                </a> </p>
                        </div>
                        <?php if ($results[$serverq[$x]['host']]['gq_online'] == "0") {
                            echo "----";
                        } else { ?>
                            <div class="moreinfo">
                                <p>Map:
                                    <?php echo $results[$serverq[$x]['host']]['map'] ?>
                                </p>
                                <p>Players:
                                    <?php echo $results[$serverq[$x]['host']]['num_players'] ?> /
                                    <?php echo $results[$serverq[$x]['host']]['max_players'] ?>
                                </p>


                            </div>

                        <?php } ?>

                    </div>
                    <?php
                }
    } else {
        echo "";

    }
    ?>


        </div>

    </div>

    <main>
        <div class="wrapper">
            <div class="map-list2">
                <div id="sticky">
                <li class="togglemaps" onclick="toggleMaps()"></li>
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
                                echo '<div id="surf" class="content';
                                if ($tabopened === "surf") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultsurf->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                } ?>

                                <?php
                                echo '</div>';
                            }
                            if ($resultbh->num_rows > 0) {
                                echo '<div id="bh" class="content';
                                if ($tabopened === "bh") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultbh->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</div>';
                            }
                            if ($resultkz->num_rows > 0) {
                                echo '<div id="kz" class="content';
                                if ($tabopened === "kz") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultkz->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</div>';
                            }
                            if ($resultother->num_rows > 0) {
                                echo '<div id="other" class="content';
                                if ($tabopened === "other") {
                                    echo ' opened">';
                                } else {
                                    echo '">';
                                }
                                while ($row = $resultother->fetch_assoc()) {
                                    echo '<li class="selector" data-id="' . $row['MapName'] . '">' . $row['MapName'] . '</li>';
                                }
                                echo '</div>';
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

                    </div>
                </div>
                <div class="players">
                    <?php
                    $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `FormattedTime`, `MapName` FROM PlayerRecords WHERE MapName = '{$defaultmap}'  ORDER BY `TimerTicks` ASC LIMIT $limit";
                    ShowRows($sql);
                    ?>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <a id="topbutton" href="#top"><i class="fa-solid fa-arrow-up"></i></a>
        <div class="wrapper">
            <div>
                <h3>
                    <?php echo $pagetitle ?>
                </h3>
                <p>
                    <?php echo $footerdesc ?>
                </p>
            </div>
            <div class="authors">SharpTimer: <a href="https://github.com/DEAFPS/SharpTimer">deafps</a> <br /> Web panel:
                <a href="https://github.com/Letaryat">Letaryat</a>
            </div>
        </div>


    </footer>
    <script src="main.js"></script>
    <script>
        $('.selector').on('click', function () {
            var data_id = $(this).data('id');
            $.ajax({
                url: 'assets/php/selection.php',
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
        $(document).ready(function () {
            $("#search").keyup(function () {
                var input = $(this).val();
                //alert(input);
                if (input != "") {
                    $.ajax({
                        url: 'assets/php/livesearch.php',
                        type: 'POST',
                        data: { input: input },
                        dataType: 'text',
                        success: function (data) {
                            $('.players').html(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('.players').html('');
                            alert('Error Loading');
                        }
                    });
                } else {
                    //console.log("essa");
                }
            });
        });
    </script>
</body>

</html>