<div class="toast slideup"></div>
<main style="flex-flow:column;">
    <div style="background: var(--secondary); align-items:center; box-sizing:border-box; border-radius:var(--borderradius); padding:20px;" class="wrapper">
    <div>
    <h2>Change gif</h2>
    <h3>Gif has to be 275x55 or less</h3>
    <form class="newgif-input-container" id="#form">
            <label style="margin-bottom:10px;" for="newgif-input">Insert new GIF <abbr title="example: https://i.imgur.com/Os63UKo.gif">(Imgur only)</abbr>:</label>
            <input id="gif" name="newgif-input" class="newgif-input" type="text" value="">
            <div class="form-button-container">
                <input id="success" type="submit" value="Update">
            </div>
        </form>
    </div>
    <div style="justify-content: end" class="wrapper">
        <div style="background-image:url('<?php echo BasicURL(); ?>views/assets/images/vipbanner.jpg')"
            class="vip-preview">
            <div class="newgif">
                <img style="max-width:275px; height:55px" class="newgif-img" src="<?php if($rowplayervip['BigGifID'] === "x"){
                  echo "https://i.imgur.com/GYV48np.gif";  
                }else{
                 echo $rowplayervip['BigGifID'];
                } ?>">
            </div>
        </div>
    </div>
    </div>
    <!--
    <div style="padding:20px;"id="strangerdanger">testaaaaaaaaaaaaaaaaaaaaa</div>
    -->


</main>

<script>
    const getMeta = (url, cb) => {
        const img = new Image();
        img.onload = () => cb(null, img);
        img.onerror = (err) => cb(err);
        img.src = url;
    };

    var input = document.querySelector('.newgif-input');
    var newgif = document.querySelector('.newgif-img');
    input.addEventListener('input', function () {
        var url_re = /https?[^<"]+/g
        while (m = url_re.exec(input.value)) {
            var imgur_re = /^https?:\/\/(\w+\.)?i.imgur.com\/(\w*\d\w*)+(\.[a-zA-Z]{3})?$/
            newgif.src = imgur_re.test(m);
            if (imgur_re.test(m) === true) {
                newgif.src = m;
            }
        }

    })

    $("form").submit(function (event) {
            var formData = {
                nick: "<?php echo $steamprofile['personaname']?>",
                gifurl: $("#gif").val(),
                steam_id : "<?php echo $steamprofile['steamid']?>",
            };
            $.ajax({
                type: "POST",
                url: "scripts/ajax/queries/vipsettingsgif.php",
                data: formData,
                encode: true,
                success: function (data) {
                    //console.log(data);
                    $('.toast').html(data);
                    $('.toast').addClass('visible');
                    setTimeout(() => {
                        $(".toast").removeClass('slideup');
                        $(".toast").addClass('slidedown');
                        $(".newgif").load(" .newgif > *");
                        setTimeout(() => {
                            //location.reload();
                            $(".toast").removeClass('slideup');
                            $(".toast").removeClass('slidedown');
                            $('.toast').removeClass('visible');
                            $('.toast-element').remove();

                        }, 500);
                    }, 2500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
            event.preventDefault();
        });

</script>
</html>