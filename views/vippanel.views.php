<div style="position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 100%;
  flex-flow: column;
  box-sizing: border-box;
  margin-top: 15px;
  ">
<div class="adminpanel">
            <p>Vip management</p>
            <ul class="admin-functions">
                <li class="add"><a >ADD</a></li>
                <li class="delete"><a>DELETE</a></li>
            </ul>
        </div>
</div>
    <main>
        <div class="wrapper">
        <div style="width:100%;"class="leaderboard">
                <div class="players">
                    <?php
                        $sql = "SELECT * from playerstats WHERE IsVip = 1";
                        $result = mysqli_query($conn, $sql) or die("Bad query");
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<div style="grid-template-columns: 2fr 3fr 1fr 1fr; min-height:55px;" class="row">
                                <span><a href="profile?sid=' . $row['SteamID'] . '/">' . $row['PlayerName'] . '</a></span>';
                                if(filter_var($row['BigGifID'], FILTER_VALIDATE_URL) === FALSE){
                                    echo "<span>Not a valid URL</span>";
                                }else{
                                    echo '<img src="'.$row['BigGifID'].'">';
                                }
                                echo '
                                <span  href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '"  class="admin-button edit"><i class="fa-solid fa-pen"></i></span>
                                <label class="checkbox-container">
                                <input type="checkbox" value="' . $row['SteamID'] . '" class="admin-button"></input>
                                <span class="checkmark"></span>
                                </label>
                                </div>';
                            }
                        }else{
                            echo "<div id='strangerdanger' class='row' style='grid-template-columns: 1fr 1fr;''>No vips were found.</div>";
                        }

                    ?>
                </div>
            </div>
        </div>
    </main>


    <div class="modal">
    <div class="modal-exit"><i class="fa-solid fa-circle-xmark"></i></div>
        <div class="modal-container"></div>
    </div>

    <script>
        $('.add').on('click', function () {
            $("input:checked").each(function(){
                $('input:checkbox').prop('checked', false);
            })
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            $.ajax({
                url: 'scripts/ajax/adminpanel/vipadd.php',
                type: 'POST',
                success: function (data) {
                    $('.modal-container').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-container').html('');
                    alert('Error Loading');
                }
            });
        });

        $('.edit').on('click', function () {
            $("input:checked").each(function(){
                $('input:checkbox').prop('checked', false);
            })
            var steam_id = $(this).data('steamid');
            console.log(steam_id);
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            $.ajax({
                url: 'scripts/ajax/adminpanel/vipedit.php',
                type: 'POST',
                data: { steamdata: steam_id},
                dataType: 'text',
                success: function (data) {
                    $('.modal-container').html(data);
                    //console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-container').html('');
                    alert('Error Loading');
                }
            });
        });

/*
        $('.edit').on('click', function () {
            console.log("help");
            var steam = $(this).data('steamid');
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            console.log(steam);
            $.ajax({
                url: 'scripts/ajax/adminpanel/vipedit.php',
                type: 'POST',
                data: { steamdata: steam},
                dataType: 'text',
                success: function (data) {
                    //$('.modal-container').html(data);
                    //console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-container').html('');
                    alert('Error Loading');
                }
            });
        });
*/
        $('.delete').on('click', function () {
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            var checkbox = new Array();
            $("input:checked").each(function(){
                checkbox.push($(this).val());
            })
            var steam = $('.edit').data('steamid');
            $.ajax({
                url: 'scripts/ajax/adminpanel/vipdelete.php',
                type: 'POST',
                data: { checkbox: checkbox},
                dataType: 'text',
                success: function (data) {
                    $('.modal-container').html(data);
                    console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-container').html('');
                    alert('Error Loading');
                }
            });
        });

    </script>

</html>