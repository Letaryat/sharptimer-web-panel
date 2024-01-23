<?php
    function ShowRowsAdminPanel($sql){
        $i = 0;
        require('config.php');
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $i++;
                echo '<a href="profile?sid='.$row['SteamID'] . '/"><div';
                if($i % 2 == 0){
                    echo ' id="stripped"';
                }
                else{echo "";}
                echo ' class="row">
                <span>'.$i.'</span>
                <span>'.$row['PlayerName'].'</span>
                <span>'.$row['FormattedTime'].'</span>
                <span>'.$row['MapName'].'</span>
                <span class="edit">Edit</span>
                <span class="delete">Delete</span>
                </div></a>';
            }
        }
        else{
            echo "<div id='strangerdanger' class='row'>Player not found.</div>";
        }
    }

    if(!isset($_SESSION['steamid'])) {
        header("Location: error");
    } elseif (!in_array($steamprofile['steamid'], $admins)){
        header("Location: error");
    }
    else{
        if (isset($_GET['sid'])) {
        $sid = mysqli_real_escape_string($conn, $_GET['sid']);
        $sidexplode = explode("/", $sid);
        #echo "<br/> Test : " . $sid . " sidexpldoe: " . $sidexplode[0];
        $query = "SELECT * FROM `PlayerRecords` WHERE SteamID = '{$sidexplode[0]}'";
        $result = mysqli_query($conn, $query) or die("bad query");
        $row = mysqli_fetch_array($result);
        $rand = rand(1, 3);
        if (empty($row)) {
            header("Location: error");
        }
}
    }
