    <main style="flex-flow:column;">
        <?php 
        require_once("./functions.php");
        require_once("./config.php");
        $sql = "SELECT DISTINCT `SteamID`, `PlayerName`, `GlobalPoints`, (SELECT COUNT(*) FROM PlayerRecords WHERE playerstats.SteamID = playerrecords.SteamID) AS 'Cunt' FROM playerstats";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br/>".$row['SteamID'];
                echo "<br/>".$row['Test'];
            }
    
        }
        
        ?>
    </main>
</html>