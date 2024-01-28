<link rel="stylesheet" href="views/assets/css/adminpanel.css">
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
                <a class="delete"><li>Add</li></a>
                <a class="delete"><li>Edit</li></a>
                <a class="delete"><li>DELETE</li></a>
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
                                echo '<div style="grid-template-columns: 1fr 4fr 1fr 1fr;" class="row">
                                <span><a href="profile?sid=' . $row['SteamID'] . '/">' . $row['PlayerName'] . '</a></span>
                                <img src="'.$row['BigGifID'].'">
                                <span href="javascript:void(0)" data-steamid="' . $row['SteamID'] . '"  class="admin-button edit"><i class="fa-solid fa-pen"></i> Edit VIP</span>
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
        $('.delete').on('click', function () {
            var modal = $('.modal');
            modal.addClass("active fadein");
            $(document.body).addClass('modalactive');
            $('.modal-container').addClass("slideup");
            var checkbox = new Array();
            $("input:checked").each(function(){
                checkbox.push($(this).val());
            })
            var map_name = $('.edit').data('mapname');
            $.ajax({
                url: 'scripts/ajax/adminpanel/vipdelete.php',
                type: 'POST',
                data: { checkbox: checkbox, mapname: map_name},
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

    </script>

</html>