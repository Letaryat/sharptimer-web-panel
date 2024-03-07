<?php

require_once 'class/config.php';
require_once 'class/database.php';
require_once 'class/utils.php';
require_once 'class/poorfunctions.php';
$db = new DataBase();

if (isset($_SESSION['steamid'])) {

	$steamid = $_SESSION['steamid'];
	$weapons = UtilsClass::getWeaponsFromArray();
	$skins = UtilsClass::skinsFromJson();
	$querySelected = $db->select("SELECT `weapon_defindex`, `weapon_paint_id`, `weapon_wear`, `weapon_seed` FROM `wp_player_skins` WHERE `wp_player_skins`.`steamid` = :steamid", ["steamid" => $steamid]);
	$selectedSkins = UtilsClass::getSelectedSkins($querySelected);
	//$selectedSkins = $db->select("SELECT * FROM `wp_player_skins` WHERE `wp_player_skins`.`steamid` = :steamid", ["steamid" => $steamid]);
	$selectedKnife = $db->select("SELECT * FROM `wp_player_knife` WHERE `wp_player_knife`.`steamid` = :steamid", ["steamid" => $steamid]);
	$knifes = UtilsClass::getKnifeTypes();
	if (isset($_POST['forma'])) {
		$ex = explode("-", $_POST['forma']);

		if ($ex[0] == "knife") {
			$db->query("INSERT INTO `wp_player_knife` (`steamid`, `knife`) VALUES(:steamid, :knife) ON DUPLICATE KEY UPDATE `knife` = :knife", ["steamid" => $steamid, "knife" => $knifes[$ex[1]]['weapon_name']]);
		} else {
			if (array_key_exists($ex[1], $skins[$ex[0]])) {

				if (array_key_exists($ex[0], $selectedSkins)) {
					$db->query("UPDATE wp_player_skins SET weapon_paint_id = :weapon_paint_id, weapon_wear = :weapon_wear, weapon_seed = :weapon_seed WHERE steamid = :steamid AND weapon_defindex = :weapon_defindex", ["steamid" => $steamid, "weapon_defindex" => $ex[0], "weapon_paint_id" => $ex[1], "weapon_wear" => 0.1, "weapon_seed" => 1]);
				} else {
					$db->query("INSERT INTO wp_player_skins (`steamid`, `weapon_defindex`, `weapon_paint_id`, `weapon_wear`, `weapon_seed`) VALUES (:steamid, :weapon_defindex, :weapon_paint_id, :weapon_wear, :weapon_seed)", ["steamid" => $steamid, "weapon_defindex" => $ex[0], "weapon_paint_id" => $ex[1], "weapon_wear" => 0.1, "weapon_seed" => 1]);
				}
			}
		}
		header("Location: skins");
	}
} else {
	header("Location: error");
}
?>
<main style="flex-flow:column;">
	<div class="selectors">
		<div class="weapon-selector weapons" onclick="showgroup(event, 'knifes')">
			<img clas="weapon-icon "
				src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_knife_butterfly.svg">
			Weapons
		</div>
		<div class="weapon-selector gloves" onclick="showgroup(event, 'knifes')">
			<img clas="weapon-icon"
				src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_knife_butterfly.svg">
			Gloves
		</div>
		<div class="weapon-selector agents" onclick="showgroup(event, 'knifes')">
			<img clas="weapon-icon"
				src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_knife_butterfly.svg">
			Agents
		</div>
	</div>

	<div class="wrapper skins-container">
		<div class="card">
			<?php
			$actualKnife = $knifes[0];
			if ($selectedKnife != null) {
				foreach ($knifes as $knife) {
					if ($selectedKnife[0]['knife'] == $knife['weapon_name']) {
						$actualKnife = $knife;
						break;
					}
				}
			}

			echo "<div class='card-header'>";
			echo "<h4 class='card-title item-name'>{$actualKnife["paint_name"]}</h4>";
			echo "</div>";
			echo "<img src='{$actualKnife["image_url"]}' class='skin-image'>";
			?>
			<div class="card-footer">
				<form class="skin-update" action="" method="POST">
					<div class="custom-select" style="width:200px;">
						<select name="forma" class="form-control select" onchange="this.form.submit()"
							class="SelectWeapon">
							<option disabled>Select knife</option>
							<?php
							foreach ($knifes as $knifeKey => $knife) {
								if ($selectedKnife[0]['knife'] == $knife['weapon_name'])
									echo "<option selected value=\"knife-{$knifeKey}\">{$knife['paint_name']}</option>";
								else
									echo "<option value=\"knife-{$knifeKey}\">{$knife['paint_name']}</option>";
							}
							?>
						</select>
					</div>
				</form>
			</div>
		</div>


	</div>
</main>

<div class="modal">
	<div class="modal-exit"><i class="fa-solid fa-circle-xmark"></i></div>
	<div class="modal-container" style="width:700px;"></div>
</div>
<script>
	$(document).ready(function(){
		var steam_id = '<?php echo $_SESSION['steamid'] ?>';
		$.ajax({
			url: 'modules/pages/skins/weapons.php',
			type: 'POST',
			data: { steam_id: steam_id },
			dataType: 'text',
			beforeSend: function () {
				$('.skins-container').html('<span style="text-align:center" class="loader"></span>');
				$('.skins-container').css('display', 'flex');
				$('.skins-container').css('justify-content', 'center');
			},
			success: function (data) {
				$('.skins-container').css('display', '');
				$('.skins-container').css('justify-content', '');
				$('.loader').remove();
				$('.skins-container').addClass('skins-weapons');
				$('.skins-container').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal-container').html('');
				alert('Error Loading');
			}
		})
	})


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

	$('.skin-change').on('click', function () {
		var weapon_id = $(this).data('target');
		var weapon_name = $(this).data('name');
		var steam_id = '<?php echo $_SESSION['steamid'] ?>';
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


	$('.weapons').on('click', function () {
		var steam_id = '<?php echo $_SESSION['steamid'] ?>';
		$.ajax({
			url: 'modules/pages/skins/weapons.php',
			type: 'POST',
			data: { steam_id: steam_id },
			dataType: 'text',
			beforeSend: function () {
				$('.skins-container').html('<span style="text-align:center" class="loader"></span>');
				$('.skins-container').css('display', 'flex');
				$('.skins-container').css('justify-content', 'center');
			},
			success: function (data) {
				$('.skins-container').css('display', '');
				$('.skins-container').css('justify-content', '');
				$('.loader').remove();
				$('.skins-container').addClass('skins-weapons');
				$('.skins-container').html(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal-container').html('');
				alert('Error Loading');
			}
		})
	})

	$('.gloves').on('click', function () {
		$('.skins-container').removeClass('skins-weapons');
		var steam_id = '<?php echo $_SESSION['steamid'] ?>';
		$.ajax({
			url: 'modules/pages/skins/gloves.php',
			type: 'POST',
			data: { steam_id: steam_id },
			dataType: 'text',
			beforeSend: function () {
				$('.skins-container').html('<span style="text-align:center" class="loader"></span>');
				$('.skins-container').css('display', 'flex');
				$('.skins-container').css('justify-content', 'center');
			},
			success: function (data) {
				$('.skins-container').css('display', '');
				$('.skins-container').css('justify-content', '');
				$('.loader').remove();
				$('.skins-container').html(data);
				//console.log(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal-container').html('');
				alert('Error Loading');
			}
		})
	})

	$('.agents').on('click', function () {
		$.ajax({
			url: 'modules/pages/skins/data/queries/agents.php',
			type: 'POST',
			dataType: 'text',
			beforeSend: function () {
				//$('.modal-container').append('<span style="text-align:center" class="loader"></span>');
				//$('.modal-container').css('justify-content', "center");
			},
			success: function (data) {
				//$('.loader').remove();
				// $('.modal-container').css('justify-content', '');
				$('.wrapper').html(data);
				//console.log(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal-container').html('');
				alert('Error Loading');
			}
		})
	})


	window.onload = function () {
		//showgroup(event, 'knifes');
		showgroup(event, sessionStorage.getItem('selectedgroup') || 'knifes');

	}

</script>