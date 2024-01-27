<?php
function ShowRowsAdminPanel($sql)
{
    $i = 0;
    require('config.php');
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $i++;
            echo '<div ';
            if ($i % 2 == 0) {
                echo ' id="stripped"';
            } else {
                echo "";
            }
            echo ' class="row">
            <span>' . $i . '</span>
            <span><a href="profile?sid=' . $row['SteamID'] . '/">' . $row['PlayerName'] . '</a></span>
            <span>' . $row['FormattedTime'] . '</span>
            <span>' . $row['MapName'] . '</span>
            <span href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '" data-mapname="' . $row['MapName'] . '"  class="admin-button edit"><i class="fa-solid fa-pen"></i> Edit Record</span>
            <label class="checkbox-container">
            <input type="checkbox" value="' . $row['SteamID'] . '" class="admin-button"></input>
            <span class="checkmark"></span>
            </label>
            </div>';
        }
    } else {
        echo "<div id='strangerdanger' class='row'>Player not found.</div>";
    }
}

if (!isset($_SESSION['steamid'])) {
    header("Location: error");
} elseif (!in_array($steamprofile['steamid'], $admins)) {
    header("Location: error");
} else {
    require 'views/adminpanel.views.php';
}


#<span href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '" data-mapname="' . $row['MapName'] . '" class="admin-button delete"><i class="fa-solid fa-trash"></i> Delete Record</span>
