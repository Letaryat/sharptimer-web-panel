<main style="flex-flow:column;">
    <h2>Change gif</h2>
    <div class="newgif-input-container">
        <form style="flex-flow: column;
  display: flex;" id="#form" action="scripts/ajax/editquery.php" method="POST">
            <label style="margin-bottom:10px;" for="newgif-input">Insert new GIF <abbr title="example: https://i.imgur.com/Os63UKo.gif">(Imgur only)</abbr>:</label>
            <input name="newgif-input" class="newgif-input" type="text">
            <div class="form-button-container">
                <input id="success" type="submit" value="Update">
            </div>
        </form>

    </div>
    <div style="justify-content: center" class="wrapper">
        <div style="background-image:url('<?php echo BasicURL(); ?>views/assets/images/vipbanner.jpg')"
            class="vip-preview">
            <div class="newgif">
                <img style="max-width:275px; height:55px" class="newgif-img" src="https://i.imgur.com/GYV48np.gif">
            </div>
        </div>
    </div>
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
            var imgur_re = /^https?:\/\/(\w+\.)?imgur.com\/(\w*\d\w*)+(\.[a-zA-Z]{3})?$/
            newgif.src = imgur_re.test(m);
            if (imgur_re.test(m) === true) {
                newgif.src = m;
            }
        }

    })
</script>


</html>