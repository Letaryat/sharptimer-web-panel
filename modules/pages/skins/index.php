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
			if (array_key_exists($ex[1], $skins[$ex[0]]) ) {

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
		<div class="weapon-selector active" onclick="showgroup(event, 'pistols')">
			<img clas="weapon-icon"
				src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_usp_silencer.svg">
			Pistols
		</div>
		<div class="weapon-selector" onclick="showgroup(event, 'rifles')">
			<img clas="weapon-icon" src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_ak47.svg">
			Rifles
		</div>
		<div class="weapon-selector" onclick="showgroup(event, 'smg')">
			<img clas="weapon-icon" src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_mac10.svg">
			Smgs
		</div>
		<div class="weapon-selector" onclick="showgroup(event, 'shotguns')">
			<img clas="weapon-icon" src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_nova.svg">
			Shotguns
		</div>
		<div class="weapon-selector" onclick="showgroup(event, 'snipers')">
			<img clas="weapon-icon" src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_ssg08.svg">
			Sniper rifles
		</div>
		<div class="weapon-selector" onclick="showgroup(event, 'knifes')">
			<img clas="weapon-icon"
				src="<?php echo BasicURL() ?>modules/pages/skins/data/weapons/weapon_knife_butterfly.svg">
			Knifes
		</div>
	</div>
	<div class="wrapper">
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

		<?php

		foreach ($weapons as $defindex => $default) {
			?>
			<div class="card" id="<?php
			if (array_key_exists($defindex, $selectedSkins)) {
				getrarity($skins[$defindex][$selectedSkins[$defindex]['weapon_paint_id']]["paint_name"]);
			} ?>" data-weaponid="<?php echo $defindex ?>">
				<?php
				echo $defindex;
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
				?>" class="skin-change">CHANGE MEEEEEE</span>
					<form class="skin-update" action="" method="POST"
						id="<?php print_r($skins[$defindex][0]['weapon_name']) ?>">
						<div id="<?php print_r($skins[$defindex][0]['weapon_name']) ?>" class="custom-select"
							style="width:200px;">
							<select name="forma" class="form-control select" class="SelectWeapon">
								<option disabled>Select skin</option>
								<?php
								foreach ($skins[$defindex] as $paintKey => $paint) {
									if (array_key_exists($defindex, $selectedSkins) && $selectedSkins[$defindex]['weapon_paint_id'] == $paintKey)
										echo "<option selected value=\"{$defindex}-{$paintKey}\">{$paint['paint_name']}</option>";
									else
										echo "<option value=\"{$defindex}-{$paintKey}\">{$paint['paint_name']}</option>";
								}
								?>
							</select>
						</div>
						<?php
						$selectedSkinInfo = isset($selectedSkins[$defindex]) ? $selectedSkins[$defindex] : null;
						$steamid = $_SESSION['steamid'];
						if ($selectedSkinInfo):
							?>
							<span href="javascript:void(0)" data-target="<?php echo $defindex ?>"
								data-skinname="<?php echo $selectedSkinInfo['weapon_paint_id'] ?>" class="skin-edit"><i
									class="fa-solid fa-pen"></i></span>
						<?php else: ?>
						<?php endif; ?>
					</form>
		</div>

		</div>
	<?php } ?>
	</div>
</main>

<div class="modal">
	<div class="modal-exit"><i class="fa-solid fa-circle-xmark"></i></div>
	<div class="modal-container" style="width:700px;"></div>
</div>
<script>

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

	window.onload = function(){
		showgroup(event, 'pistols');

	}

	
	//  wear
	function updateWearValue<?php echo $defindex ?>(selectedValue) {
		var wearInputElement = document.getElementById("wear<?php echo $defindex ?>");
		wearInputElement.value = selectedValue;
	}

	function validateWear(inputElement) {
		inputElement.value = inputElement.value.replace(/[^0-9]/g, '');
	}
	// seed
	function validateSeed(input) {
		// Check entered value
		var inputValue = input.value.replace(/[^0-9]/g, ''); // Just get the numbers

		if (inputValue === "") {
			input.value = 0; // Set to 0 if empty or no numbers
		} else {
			var numericValue = parseInt(inputValue);
			numericValue = Math.min(1000, Math.max(1, numericValue)); // Interval control

			input.value = numericValue;
		}
	}
</script>