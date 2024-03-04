<?php
function getrarity($name){
	$json = json_decode(file_get_contents(__DIR__ . "/rarity.json"), true);
	foreach ($json as $skin) {
		echo '<pre>';
		/*
		if($skin['name'] === $name){
			print_r($skin['rarity']['id']);
		}
		*/
		print_r($skin['rarity']);
		echo '</pre>';
	}
}
//getrarity("AK-47 | Jet Set");

function getskinname($wid, $pid){
	$json = json_decode(file_get_contents(__DIR__ . "/skins.json"), true);
	foreach ($json as $skin) {
		if( $skin['weapon_defindex'] == $wid && $skin['paint'] == $pid){
			print_r($skin['paint_name']);
		}
		/*
		echo "<pre>";
		print_r($skin);
		echo "</pre>";
		*/
	}
}

function getskinimg($wid, $pid){
	$json = json_decode(file_get_contents(__DIR__ . "/skins.json"), true);
	foreach ($json as $skin) {
		if( $skin['weapon_defindex'] == $wid && $skin['paint'] == $pid){
			echo "<img style='max-width: 30%;' src='".$skin['image']."'/>";
		}
	}
}

getskinimg(3,141)

//getskinname(3,141);

//die(var_dump($json));


?>
