<?php
    require_once("../../functions.php");
    require_once("../../config.php");
    $id = $conn -> real_escape_string($_POST['id']);
    if($id === "global"){
        echo '<div class="row">
        <span> <i class="fa-solid fa-ranking-star"></i> </span>
        <span> <i class="fa-solid fa-person-running"></i> Player </span>
        <span> <i class="fa-solid fa-clock"></i> Points</span>
        <span> <i class="fa-solid fa-clock"></i> Maps Finished</span>

    </div>';
    }else{
        echo '<div class="row">
        <span> <i class="fa-solid fa-ranking-star"></i> </span>
        <span> <i class="fa-solid fa-person-running"></i> Player </span>
        <span> <i class="fa-solid fa-clock"></i> Time</span>
        <span> <i class="fa-solid fa-map"></i> Map </span>
        <span> <i class="fa-solid fa-flag-checkered"></i> Finished </span>
    </div>';
    }
   

?>
