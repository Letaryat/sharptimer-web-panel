<?php
require_once(dirname(__FILE__) . '/../../../config.php');
require_once 'class/config.php';
require_once 'class/database.php';
require_once 'class/utils.php';
require_once 'class/poorfunctions.php';
$db = new DataBase();
$steamid = $_POST['steam_id'];
$weapons = UtilsClass::getWeaponsFromArray();
$skins = UtilsClass::skinsFromJson();
//$querySelectedGloves = $db->select("SELECT `weapon_defindex` FROM `wp_player_gloves` WHERE `wp_player_gloves`.`steamid` = {$steamid}");
$querySelected = $db->select("SELECT `weapon_defindex`, `weapon_paint_id`, `weapon_wear`, `weapon_seed` FROM `wp_player_skins` WHERE `wp_player_skins`.`steamid` = :steamid", ["steamid" => $steamid]);
$selectedSkins = UtilsClass::getSelectedSkins($querySelected);

?>

<div class="selectors">
		<div class="weapon-selector knifes" onclick="showgroup(event, 'knifes')">
			<img clas="weapon-icon">
			Knifes
		</div>
		<div class="weapon-selector pistols" onclick="showgroup(event, 'pistols')">
			<img clas="weapon-icon">
			Pistols
		</div>
	</div>
<div style="display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
  justify-content: center;
  align-items: center;
  gap: 10px;">
<?php
foreach ($weapons as $defindex => $default) {

    ?>
    <div style="display:none" class="card" id="<?php
    if (array_key_exists($defindex, $selectedSkins)) {
        getrarity($skins[$defindex][$selectedSkins[$defindex]['weapon_paint_id']]["paint_name"]);
    } ?>" data-weaponid="<?php echo $defindex ?>">
        <?php

        //print_r($skins[1][0]['weapon_name']);
        if (array_key_exists($defindex, $selectedSkins)) {
            echo "<div class='card-header'>";
            echo "<h4 class='card-title item-name'>{$skins[$defindex][$selectedSkins[$defindex]['weapon_paint_id']]["paint_name"]}</h4>";
            echo "</div>";
            echo "<img src='{$skins[$defindex][$selectedSkins[$defindex]['weapon_paint_id']]['image_url']}' class='skin-image'>";
        } else {
            echo "<div class='card-header'>";
            echo "<h4 class='card-title item-name'>{$default["paint_name"]}</h4>";
            echo "</div>";
            echo "<img src='{$default["image_url"]}' class='skin-image'>";
        }
        ?>
        <div class="card-footer">
            <span href="javascript:void(0)" data-target="<?php echo $defindex ?>" data-name="
        <?php
        echo $default["paint_name"];
        ?>" class="skin-change"><i class="fa-solid fa-paintbrush"></i></span>
            <span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
                data-skinname="<?php echo $selectedSkins[$defindex]['weapon_paint_id'] ?>" class="skin-edit"><i
                    class="fa-solid fa-pen"></i></span>
            <?php ?>
        </div>
        <div class="skin-info">
            <p>Wear:
                <?php if (isset($selectedSkins[$defindex]['weapon_wear'])) {
                    echo $selectedSkins[$defindex]['weapon_wear'];
                } ?>
            </p>
            <p>Seed:
                <?php if (isset($selectedSkins[$defindex]['weapon_wear'])) {
                    echo $selectedSkins[$defindex]['weapon_seed'];
                } ?>
            </p>
        </div>

    </div>
<?php

} ?>
</div>


<script>

var weapongroup = document.querySelectorAll(".weapon-selector");
var skins = document.querySelectorAll(".card");
var skinsrarity = [];

function showgroup(evt, weapons){

  console.log('chujek');
  skinsrarity = [];
  var selected = "knifes";
  if(weapons === "pistols"){
    selected = pistols;
  }
  if(weapons === "rifles"){
    selected = rifles;
  }
  if(weapons === "smg"){
    selected = smg;
  }
  if(weapons === "shotguns"){
    selected = shotguns;
  }
  if(weapons === "snipers"){
    selected = snipers;
  }
  if(weapons === "knifes"){
    selected = knifes;
  }


  for(var x = 0; x < weapongroup.length; x++){
    weapongroup[x].className = weapongroup[x].className.replace(" active", "");
  }

  if(evt === undefined){
    console.log('test');
  }else{
    evt.currentTarget.className += " active";
  }

  //console.log(skins.length);
  //console.log(skins[2].getAttribute('data-weaponid'));
  
  for(var x = 0; x < skins.length; x++){
    if(selected.includes(skins[x].getAttribute('data-weaponid'))){
      skinsrarity.push(skins[x]);
      //applyCustomOrder(skinsrarity, rarityarray);
      //document.querySelector(".card").remove();
      //console.log(skins[x]);
      skins[x].style.display = "flex";
    }else{
      skins[x].style.display = "none";
    }
    if(selected === knifes){
      if(selected.includes(skins[x].getAttribute('data-weaponid'))){
        skins[x].setAttribute("id", 'rarity_ancient_weapon');
      }
    }
}

sessionStorage.setItem('selectedgroup', weapons);
setTimeout(() => {
  for(var x = 0; x < weapongroup.length; x++){
    if(weapongroup[x].classList.contains(weapons)){
      weapongroup[x].classList.add('active');
    }
  }
}, 200);



}


showgroup(event, "knifes");

$('.skin-change').on('click', function () {
		var weapon_id = $(this).data('target');
		var weapon_name = $(this).data('name');
		var steam_id = '<?php echo $steamid ?>';
		var modal = $('.modal');
		modal.addClass("active fadein");
		$(document.body).addClass('modalactive');
		$('.modal-container').addClass("slideup");
		$.ajax({
			url: 'modules/pages/skins/skinchange.php',
			type: 'POST',
			data: { weapon_id: weapon_id, steam_id: steam_id, weapon_name: weapon_name },
			dataType: 'text',
			beforeSend: function () {
				$('.modal-container').append('<span style="text-align:center" class="loader"></span>');
				$('.modal-container').css('justify-content', "center");
			},
			success: function (data) {
				$('.loader').remove();
				$('.modal-container').css('justify-content', '');
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