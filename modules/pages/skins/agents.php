<?php
require_once(dirname(__FILE__) . '/../../../config.php');
require_once(dirname(__FILE__) . '/../../../functions.php');
require_once 'class/config.php';
require_once 'class/database.php';
require_once 'class/utils.php';
require_once 'class/poorfunctions.php';
$db = new DataBase();
$steamid = $_POST['steam_id'];
//$skins = UtilsClass::GlovesFromJson();

//$querySelectedGloves = $db->select("SELECT `weapon_defindex` FROM `wp_player_gloves` WHERE `wp_player_gloves`.`steamid` = {$steamid}");
$querySelected = "SELECT * FROM `wp_player_agents` WHERE `wp_player_agents`.`steamid` = {$steamid}";
$result = $conn->query($querySelected);

//$selectedSkins = UtilsClass::getSelectedSkins($querySelected);

$glovesarray = [
	2 => "agent_t",
	3 => "agent_ct",
];
?>

<?php
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	foreach($glovesarray as $defindex => $key){
		if(empty($row[$glovesarray[$defindex]]) || $row[$glovesarray[$defindex]] == "0"){ ?>
	<div class="card" id="mythical" data-weaponid="<?php echo $defindex ?>" style="display: flex;">
			<div class="card-header">
				<h4 class="card-title item-name">
					<?php echo $glovesarray[$defindex]?>
					
				</h4>
			</div><img src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/agents/<?php echo $glovesarray[$defindex]?>.png" class="skin-image not-selected-skin">
			<div class="card-footer">
				<span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
					data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
						class="fa-solid fa-paintbrush"></i></span>

			</div>
			<div style="display:none" class="skin-info">

			</div>

		</div>

		<?php }else{ 
			$test = AgentInfoFromModel($row[$glovesarray[$defindex]], 'agent_name');?>
			
			<div class="card" id="<?php getrarityagents($test)?>" data-weaponid="<?php echo $defindex ?>" style="display: flex;">
			<div class="card-header">
				<h4 class="card-title item-name">
					<?php echo AgentInfoFromModel($row[$glovesarray[$defindex]], 'agent_name')?>
				</h4>
			</div><img src="<?php echo AgentInfoFromModel($row[$glovesarray[$defindex]], 'image')?>" class="skin-image">
			<div class="card-footer">
				<span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
					data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
						class="fa-solid fa-paintbrush"></i></span>

			</div>
			<div style="display:none" class="skin-info">

			</div>

		</div>
		<?php }
	}


}
/*
foreach ($glovesarray as $defindex => $key) {
	
	if (array_key_exists($defindex, $querySelected)) { 
		//print_r($selectedSkins[$defindex]['weapon_paint_id']);
		?>
	
		<div class="card" id="mythical" data-weaponid="<?php echo $defindex ?>" style="display: flex;">
			<div class="card-header">
				<h4 class="card-title item-name">
					<?php echo $glovesarray[$defindex] ?>
				</h4>
			</div><img src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/agents/<?php echo $glovesarray[$defindex]?>.png" class="skin-image">
			<div class="card-footer">
				<span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
					data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
						class="fa-solid fa-paintbrush"></i></span>

			</div>
			<div class="skin-info">

			</div>

		</div>
	<?php } else { ?>
		<div class="card" id="mythical" data-weaponid="<?php echo $defindex ?>" style="display: flex;">
			<div class="card-header">
				<h4 class="card-title item-name">
					<?php echo $glovesarray[$defindex] ?>
				</h4>
			</div><img src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/agents/<?php echo $glovesarray[$defindex]?>.png" class="skin-image not-selected-skin">
			<div class="card-footer">
				<span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
					data-name="<?php echo $glovesarray[$defindex] ?>" class="skin-change"><i
						class="fa-solid fa-paintbrush"></i></span>

			</div>
			<div style="display:none" class="skin-info">

			</div>

		</div>
	<?php }
	?>

<?php } */ ?>



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
			url: 'modules/pages/skins/agentschange.php',
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

	$('.skin-edit').on('click', function () {
		var weapon_id = $(this).data('target');
		var skin_name = $(this).data('skinname');
		var steam_id = '<?php echo $steamid ?>';
		var modal = $('.modal');
		modal.addClass("active fadein");
		$(document.body).addClass('modalactive');
		$('.modal-container').addClass("slideup");
		$.ajax({
			url: 'modules/pages/skins/modal-settings.php',
			type: 'POST',
			data: { weapon_id: weapon_id, steam_id: steam_id, skin_name: skin_name },
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