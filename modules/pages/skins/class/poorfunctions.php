<?php
function getrarity($name){
	$count = 0;
	$json = json_decode(file_get_contents(__DIR__ . "/../data/rarity.json"), true);
	foreach ($json as $skin) {
		if($skin['name'] === $name){
			if($count === 0){
				echo $skin['rarity']['id'] ;
				$count++;
			}
		} if($skin === "undefined"){
            echo "";
        }
	}
}

function getskinname($wid, $pid){
	$json = json_decode(file_get_contents(__DIR__ . "/../data/skins.json"), true);
	foreach ($json as $skin) {
		if( $skin['weapon_defindex'] == $wid && $skin['paint'] == $pid){
			echo $skin['paint_name'];
		}
	}
}

function getskinimg($wid, $pid){
	$json = json_decode(file_get_contents(__DIR__ . "/../data/skins.json"), true);
	foreach ($json as $skin) {
		if( $skin['weapon_defindex'] == $wid && $skin['paint'] == $pid){
			echo "<img style='min-width: 144px; max-width: 30%;' src='".$skin['image']."'/>";
		}
	}
}

function skinPaintFromJson($index, $arg)
{
	/*
	weapon_defindex
	paint
	image
	paint_name
	*/
	$count = 0;
	$skins = [];
	$json = json_decode(file_get_contents(__DIR__ . "/../data/gloves.json"), true);
	foreach ($json as $skin) {
		if($skin['weapon_defindex'] === $index && $count === 0){
			echo $skin[$arg];
			$count++;
		}

	}
}

function skinImage($index, $paint)
{
	/*
	weapon_defindex
	paint
	image
	paint_name
	*/
	$count = 0;
	$skins = [];
	$json = json_decode(file_get_contents(__DIR__ . "/../data/gloves.json"), true);
	foreach ($json as $skin) {
		if($skin['weapon_defindex'] == $index && $skin['paint'] == $paint){
			echo $skin['image'];
		}
			/*
		echo "<pre>";
			print_r($skin);
		echo "</pre>";
		}
	*/
}
}

function getglovespaint($index)
{
	/*
	weapon_defindex
	paint
	image
	paint_name
	*/

	$json = json_decode(file_get_contents(__DIR__ . "/../data/gloves.json"), true);
	foreach ($json as $skin) {
		if($skin['weapon_defindex'] == $index){
			echo "<div id='rarity_ancient_weapon' class='skin-box' data-paintid='{$skin['paint']}'>{$skin['paint_name']}
			<span style='text-align:center; position:absolute;' class='loader'></span>
			<img class='weapon-list-img' src='{$skin['image']}'>
			</div>";
		}

	}
}