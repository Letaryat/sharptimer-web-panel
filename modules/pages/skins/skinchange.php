<?php
require_once("class/poorfunctions.php");
require_once 'class/utils.php';
$sid = $_POST['steam_id'];
$wid = $_POST['weapon_id'];
$sname = $_POST['weapon_name'];

$skins = UtilsClass::skinsFromJson();
//echo $sid;
//$sname = $_POST['skin_name'];
//echo $sid . " " . $wid . " " . $sname . "<br/>";
?>

<div class="modal-content">
    <div style="display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 600;">
        <?php
        getskinimg($wid, $sname);
        $name = explode("|", $sname);
        echo "<span data-weaponname='".print_r($name[0])."' class='weapon-name'>";

        echo "</span>";
        ?>
    </div>
        <div class="skinchange-container">
            <?php
            foreach ($skins[$wid] as $paintKey => $paint) {
                echo "<div id='";
                getrarity($paint['paint_name']);
                echo "' class='skin-box' data-paintid='{$paintKey}'>
                {$paint['paint_name']}
                <span style='text-align:center; position:absolute;' class='loader'></span>
                <img class='weapon-list-img' src='{$paint['image_url']}'>
                </div>";

            }
            ?>
        </div>
</div>

<script>
    $('.skin-box').on('click', function(){
        var formDatadwa = {
                sid: "<?php echo $sid ?>",
                wid: <?php echo $wid ?>,
                //sname: $(".weapon-name").data('weaponname'),
                paintid : $(this).data('paintid')
            };
            $.ajax({
                type: "POST",
                url: "modules/pages/skins/data/queries/weaponquery.php",
                data: formDatadwa,
                encode: true,
                success: function (data) {
                    console.log(data);
                    setTimeout(() => {
                        location.reload()
                    }, 500);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
            event.preventDefault();
    })

    $('.weapon-list-img').on('load', function(){
        setTimeout(() => {
            $('.loader').remove();
            $('.weapon-list-img').addClass('fadein');
        }, 800);
    })
    $('.weapon-list-img').on('error', function(){
        //console.log($(this));
       $(this).attr('src', "https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/items/2022180/12c61de3e5a1edfb535a5e8c05c4e338091a1e07.png");

    })

    
if(knifes.includes("<?php echo $wid?>")){
    document.querySelectorAll('.skin-box').forEach((e) =>{
    e.setAttribute("id", "rarity_ancient_weapon");
  })
}

</script>