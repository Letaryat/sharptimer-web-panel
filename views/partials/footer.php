<footer>
        <a id="topbutton" href="#top" aria-label="To the top page"><i class="fa-solid fa-arrow-up"></i></a>
        <div class="wrapper">
            <div>
                <p class="pagetitle">
                    <?php echo $pagetitle ?>
                </p>
                <p>
                    <?php echo $footerdesc ?>
                </p>
            </div>
            <div class="authors">SharpTimer: <a href="https://github.com/DEAFPS/SharpTimer">deafps</a> <br /> Web panel 1.1:
                <a href="https://github.com/Letaryat">Letaryat</a>
            </div>
        </div>
    </footer>
    <?php 
    if(!empty($donatearray)){

    ?>
    <div class="donate">
        <div class="donate-container">
        <div class="donate-button">
        <i class="fa-solid fa-arrow-right"></i>
        </div>
        <ul class="donate-content">
            <?php 
            if(!empty($donatearray)){
                for($a = 0; $a < count($donatearray); $a++){
                    echo '<li><a href="'.$donatearray[$a]['url'].'" target="_blank">'.$donatearray[$a]['icon']." ".$donatearray[$a]['title'].'</a></li>';

                }
            }
            ?>
        </ul>
        </div>
    </div>

    <?php 
        }
    ?>

    <script type="text/javascript" src="views/assets/js/main.js?version=1"></script>
    <script src="views/assets/js/my_jquery.js"></script>
</body>
</html>