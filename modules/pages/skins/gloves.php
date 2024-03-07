<?php
require_once(dirname(__FILE__) . '/../../../config.php');
require_once 'class/config.php';
require_once 'class/database.php';
require_once 'class/utils.php';
require_once 'class/poorfunctions.php';
$db = new DataBase();
$steamid = $_POST['steam_id'];
$skins = UtilsClass::GlovesFromJson();

$glovesarray = [
    4725 => "Broken Fang Gloves",
    5027 => "Bloodhound Gloves",
    5030 => "Sport Gloves",
    5031 => "Driver Gloves",
    5032 => "Hand Wraps",
    5033 => "Moto Gloves",
    5034 => "Specialist Gloves",
    5035 => "Hydra Gloves",
];

//$querySelectedGloves = $db->select("SELECT `weapon_defindex` FROM `wp_player_gloves` WHERE `wp_player_gloves`.`steamid` = {$steamid}");
$querySelected = $db->select("SELECT `weapon_defindex`, `weapon_paint_id`, `weapon_wear`, `weapon_seed` FROM `wp_player_skins` WHERE `wp_player_skins`.`steamid` = :steamid", ["steamid" => $steamid]);
$selectedSkins = UtilsClass::getSelectedSkins($querySelected);

?>

<?php
/*
print_r($gloves);
echo "-==-=--=";
foreach ($gloves as $defindex) {
    echo "<pre>";
    print_r($gloves[]);

    echo "</pre>";
}


foreach($glovesarray as $defindex){
    echo "<pre>";
    echo $defindex;
    print_r($skins[$defindex]);
    echo "</pre>";
}

?>

<?php

foreach($glovesarray as $defindex){
    echo "<pre>";
    echo $defindex;
    print_r($skins[$defindex]);
    echo "</pre>";
}



        for($x = 0; $x < count($glovesarray); $x++){
            echo $glovesarray[$x].' ';
            echo count($skins[$glovesarray[$x]]['paint']);
            echo "<pre>";
            print_r( glovesFromJson());
            //print_r($skins[$glovesarray[$x]]);
            echo "</pre>";
        }
        foreach($defindex as $index){
 
        }

    foreach($glovesarray as $defindex => $key){
        echo "<pre>";
        //nazwa:
        echo $glovesarray[$defindex] . "<br/>";
        echo $defindex . "<br/>";;
        print_r(skinPaintFromJson($defindex, 'paint_name'));
        echo " </pre>";

    }
*/

    //print_r(skinImage('4725', '10087'));

foreach ($glovesarray as $defindex => $key) {
    if (array_key_exists($defindex, $selectedSkins)) { 
        //print_r($selectedSkins[$defindex]['weapon_paint_id']);
        ?>
    
        <div class="card" id="rarity_ancient_weapon" data-weaponid="500" style="display: flex;">
            <div class="card-header">
                <h4 class="card-title item-name">
                    <?php echo $glovesarray[$defindex] ?>
                </h4>
            </div><img src="<?php echo skinImage($defindex, $selectedSkins[$defindex]['weapon_paint_id']) ?>" class="skin-image">
            <div class="card-footer">
                <span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
                    data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
                        class="fa-solid fa-paintbrush"></i></span>
                <span href="javascript:void(0)" data-target="<?php echo $defindex ?>" data-skinname="<?php echo $defindex ?>"
                    class="skin-edit"><i class="fa-solid fa-pen"></i></span>
            </div>
            <div class="skin-info">
                <p>Wear:
                    <?php echo $selectedSkins[$defindex]['weapon_wear']?> </p>
                <p>Seed:
                <?php echo $selectedSkins[$defindex]['weapon_seed']?> </p>
            </div>

        </div>
    <?php } else { ?>
        <div class="card" id="rarity_ancient_weapon" data-weaponid="<?php echo $defindex ?>" style="display: flex;">
            <div class="card-header">
                <h4 class="card-title item-name">
                    <?php echo $glovesarray[$defindex] ?>
                </h4>
            </div><img src="<?php echo skinPaintFromJson($defindex, 'image') ?>" class="skin-image not-selected-skin">
            <div class="card-footer">
                <span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
                    data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
                        class="fa-solid fa-paintbrush"></i></span>
                <span href="javascript:void(0)" data-target="<?php echo $defindex ?>" data-skinname="<?php echo $defindex ?>"
                    class="skin-edit"><i class="fa-solid fa-pen"></i></span>
            </div>
            <div style="display:none" class="skin-info">

            </div>

        </div>
    <?php }
    ?>

<?php } ?>



<script>

$('.skin-change').on('click', function () {
		var weapon_id = $(this).data('target');
		var weapon_name = $(this).data('name');
		var steam_id = '<?php echo $steamid ?>';
		var modal = $('.modal');
		modal.addClass("active fadein");
		$(document.body).addClass('modalactive');
		$('.modal-container').addClass("slideup");
		$.ajax({
			url: 'modules/pages/skins/gloveschange.php',
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