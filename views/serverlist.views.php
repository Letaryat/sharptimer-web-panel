<?php
require '../scripts/SourceQuery/bootstrap.php';
require '../config.php';
use xPaw\SourceQuery\SourceQuery;

define('SQ_TIMEOUT', 1);
define('SQ_ENGINE', SourceQuery::SOURCE);
?>
<?php
for ($x = 0; $x <= count($serverq) - 1; $x++) {
    $ip = $serverq[$x]['host'];
    $port = $serverq[$x]['port'];
    try {
        $Timer = microtime(true);
        $Query = new SourceQuery();
        $Query->Connect($ip, $port, SQ_TIMEOUT, SQ_ENGINE);
        $mapbackground = 'https://image.gametracker.com/images/maps/160x120/csgo/'.$Query->GetInfo()['Map'].".jpg";

        if (empty($Query->GetInfo())) {
            echo "";
        } else {

            ?>

            <div class="server" <?php if (empty($Query->GetInfo())) {
                echo 'id="offline"';
            } else {
                echo 'id="online"';
            } 

            ?>>
            <?php             echo '<div class="server-map" style="    background: linear-gradient(to right, rgba(255,255,255,0) 20%,
              rgba(255,255,255,1)), url('.''.$mapbackground.''.');"><img  src=""></div>';?>
                <div class="basicinfo">
                    <p class="server-name">
                        <?php
                        if (empty($serverq[$x]['fakename'])) {
                            echo $Query->GetInfo()['HostName'];
                        } else {
                            echo $serverq[$x]['fakename'];
                        }
                        ?>
                    </p>
                    <p><a href="steam://connect/<?php
                    echo $ip . $port;
                    ?>">
                            <?php
                            echo $ip .":". $port;
                            ?>
                        </a></p>
                </div>
                <div class="moreinfo">
                    <p>Map:
                        <?php echo $Query->GetInfo()['Map'] ?>
                    </p>
                    <p>Players:
                        <?php echo $Query->GetInfo()['Players'] ?> /
                        <?php echo $Query->GetInfo()['MaxPlayers'] ?>
                    </p>


                </div>

            <?php }
    } catch (Exception $e) {
        echo '
        <div class="server" id="offline">
            <div class="server-map"></div><div class="basicinfo">
                <p class="server-name">
                    Dead</p>
                <p>'.$ip.':'.$port.'</p>
            </div>
            <div class="moreinfo">
                <p>---</p>
                <p>---</p>
            </div> 
     </div>';
        $Exception = $e;
    } finally {
        $Query->Disconnect();
    }
    $Timer = number_format(microtime(true) - $Timer, 4, '.', ''); ?>
    
    </div>
    <?php
}

?>
</div>
</div>
</div>