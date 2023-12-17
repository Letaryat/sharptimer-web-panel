<?php
require_once("./config.php");
require_once("./assets/php/functions.php");


if(isset($_GET['sid'])){
    //print_r($sasaexplode);

    #print_r (explode("/",$_GET['sid']));
    $sid = mysqli_real_escape_string($conn, $_GET['sid']);
    $sidexplode = explode("/", $sid);
    //$sidexplode = $sid;
    //print_r ($sidexplode);
    $query = "SELECT * FROM `playerrecords` WHERE SteamID = '{$sidexplode[1]}'";
    $result = mysqli_query($conn, $query) or die("bad query");
    $row = mysqli_fetch_array($result);
    if(empty($row)){
        header("Location: ../index.php");
    }
}
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
    <link rel="stylesheet" type="text/css" href="./assets/css/profiles.css?version=0">
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
    <main>
        <div id="profile-wrapper" class="wrapper">
                <div class="profileheader">
                    <div class="user-info">
                    <a target="_blank" href="https://steamcommunity.com/profiles/<?php echo $row['SteamID']?>"><div class="avatar">
                            <img  src="<?php echo getAvatar($sid)?>" alt="<?php echo $sid?>">
                        </div></a>

                        <div class="infos">
                            <h3><?php echo $row['PlayerName']?></h3>
                            <span>
                                <img id="rank" src="./assets/images/ranks/sharptimer/s1.svg" alt="rank">
                                <p>Adam Malysz 1</p>
                            </span>

                        </div>
                    </div>
                <!--
                    <div class="user-links">
                        <a href="">Steam</a>
                        <a href="">Faceit</a>
                    </div>
            -->
                </div>
                <div class="leaderboard">
                <div class="info">
                    <div class="row">
                        <span> <i class="fa-solid fa-ranking-star"></i> </span>
                        <span> <i class="fa-solid fa-person-running"></i> Player </span>
                        <span> <i class="fa-solid fa-clock"></i> Time</span>
                        <span> <i class="fa-solid fa-map"></i> Map </span>
                        <span> <i class="fa-solid fa-check"></i> Completed </span>
                    </div>
                </div>
                <div class="players">
                    <?php
                    $sql = "SELECT * FROM PlayerRecords WHERE SteamID = '{$sidexplode[1]}' ORDER BY `TimerTicks` ASC";

                    $result = $conn->query($sql);
                    $i = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            echo '<a target="_blank" href="/sharptimer-web-panel/profile/' . $row['SteamID'] . '/"><div';
                            if ($i % 2 == 0) {
                                echo ' id="stripped"';
                            } else {
                                echo "";
                            }
                            echo ' class="row">';
                            echo '<span>' . $i . '</span>';
                            echo '<span>' . $row['PlayerName'] . '</span>';
                            echo '<span>' . $row['FormattedTime'] . '</span>';
                            echo '<span>' . $row['MapName'] . '</span>';
                            echo '<span>' . $row['MapName'] . '</span>';
                            echo '</div></a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </main>
    <footer>

        <a id="topbutton" href="<?php echo $_SERVER['REQUEST_URI'];?>#top"><i class="fa-solid fa-arrow-up"></i></a>
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
</body>

</html>