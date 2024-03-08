<?php
function getrarity($name){
	$count = 0;
	$json = json_decode(file_get_contents(__DIR__ . "/../data/rarity.json"), true);
	foreach ($json as $skin) {
		if($skin['name'] === $name){
			if($count === 0){
				$exp = explode("_", $skin['rarity']['id']);
				echo $exp[1];
				//echo $skin['rarity']['id'] ;
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

/* GLOVES */
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
			echo "<div id='ancient' class='skin-box' data-paintid='{$skin['paint']}'>{$skin['paint_name']}
			<span style='text-align:center; position:absolute;' class='loader'></span>
			<img class='weapon-list-img' src='{$skin['image']}'>
			</div>";
		}

	}
}

/* AGENTS */

function getrarityagents($name){
	$count = 0;
	$json = json_decode(file_get_contents(__DIR__ . "/../data/agentsrarity.json"), true);
	foreach ($json as $skin) {
		if($skin['name'] == $name){
			$exp = explode("_", $skin['rarity']['id']);
			echo $exp[1];
			//print_r($skin['rarity']['id']);
		}

	}
}

function agentsPaintFromJson($index, $arg)
{
	/*
	team
	image
	model
	agent_name
	*/
	$count = 0;
	$skins = [];
	$json = json_decode(file_get_contents(__DIR__ . "/../data/agents.json"), true);
	foreach ($json as $skin) {
		if($skin['team'] === $index && $count === 0){
			echo $skin[$arg];
			$count++;
		}

	}
}

function getagentspaint($index)
{
	/*
	team === $index
	image
	model
	agent_name
	*/

	$json = json_decode(file_get_contents(__DIR__ . "/../data/agents.json"), true);
	foreach ($json as $skin) {
		if($skin['team'] == $index){
			echo "<div id='";
			getrarityagents($skin['agent_name']);
			echo "' class='skin-box' data-paintid='{$skin['model']}'>{$skin['agent_name']}
			<span style='text-align:center; position:absolute;' class='loader'></span>
			<img class='weapon-list-img' src='{$skin['image']}'>
			</div>";
		}

	}
}

function AgentInfoFromModel($index, $arg)
{
	/*
	team === $index
	image
	model
	agent_name
	*/
	$json = json_decode(file_get_contents(__DIR__ . "/../data/agents.json"), true);
	foreach ($json as $skin) {
		if($skin['model'] == $index){
			return $skin[$arg];
		}
	}
}