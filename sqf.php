<?php
require_once "minimal_init.php";
require_once "common.php";

function GS_output_mods_arrays(&$mods, $full=true) {
	$db = DB::getInstance();
	
	// Get user names from user id list
	$user_list = [];
	$sql       = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($mods["userlist"])), 1) . ")";

	if (!$db->query($sql,$mods["userlist"])->error())
		foreach($db->results(true) as $row)
			$user_list[$row["id"]] = $row["username"];	
				
	$output                = "";
	$arrays[]              = [];
	$arrays["name"]        = "GS_MODS_NAME=[";
	$arrays["version"]     = "GS_MODS_VER=[";
	$arrays["forcename"]   = "GS_MODS_FORCENAME=[";
	$arrays["size"]        = "GS_MODS_SIZE=[";
	$arrays["sizearray"]   = "GS_MODS_SIZEARRAY=[";
	
	if ($full) {
		$arrays["type"]        = "GS_MODS_TYPE=[";
		$arrays["ismp"]        = "GS_MODS_ISMP=[";
		$arrays["addedby"]     = "GS_MODS_ADDEDBY=[";
		$arrays["description"] = "GS_MODS_DESCRIPTION=[";
		$arrays["website"]     = "GS_MODS_WEBSITE=[";
		$arrays["logo"]        = "GS_MODS_LOGO=[";
		$arrays["logohash"]    = "GS_MODS_LOGOHASH=[";
	}
	
	foreach ($mods["info"] as $mod) {
		$arrays["name"]        .= "]+[\"{$mod["name"]}\"";
		$arrays["version"]     .= "]+[{$mod["version"]}";
		$arrays["forcename"]   .= "]+[{$mod["forcename"]}";
		$arrays["size"]        .= "]+[\"{$mod["size"]}\"";
		$arrays["sizearray"]   .= "]+[{$mod["sizearray"]}";
		
		if ($full) {
			$arrays["type"]        .= "]+[{$mod["type"]}";
			$arrays["ismp"]        .= "]+[{$mod["is_mp"]}";
			$arrays["addedby"]     .= "]+[\"{$user_list[$mod["createdby"]]} (".date("d.m.y",strtotime($mod["created"])).")\"";
			$arrays["description"] .= "]+[{$mod["description"]}";
			$arrays["website"]     .= "]+[\"{$mod["website"]}\"";
			$arrays["logo"]        .= empty($mod["logo"]) ? "]+[\"\"" : "]+[\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$mod["logo"]}\"";
			$arrays["logohash"]    .= "]+[\"{$mod["logohash"]}\"";
		}
	}
	
	foreach ($arrays as $key=>$value)
		if (!empty($key))
			$output .= $value . "];";
		
	return $output;
};

$input      = GS_get_common_input();
$input_mode = isset($_GET['mode']) ? $_GET['mode'] : "schedule";
$db         = DB::getInstance();
$output     = "";

if ($db) {
	// Handle schedule request
	if (in_array($input_mode,["schedule","lastmodified"])) {
		$servers = GS_list_servers($input["server"], $input["password"], GS_REQTYPE_GAME, GS_fwatch_date_to_timestamp(GS_FWATCH_LAST_UPDATE), $input["language"]);
		$mods    = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_GAME, $servers["lastmodified"]);

		// If user wants the last modification date
		if ($input_mode == "lastmodified") {
			$output .= "GS_MODS_ID=[";
			$ver     = "]; GS_MODS_VER=[";
			
			// Pass mods info so that user can respond with his version numbers
			foreach ($mods["id"] as $id=>$uniqueid) {
				$output .= "]+[\"{$uniqueid}\"";
				$ver    .= "]+[\"{$mods["info"][$id]["version"]}\"";
			}

			$output .= $ver . "]; GS_LAST_MODIFIED=\"{$mods["lastmodified"]}\";true";
		}
		
		// If user wants complete schedule
		if ($input_mode == "schedule") {
			$output .= "GS_FWATCH_LAST_UPDATE=". GS_FWATCH_LAST_UPDATE . "; SCHEDULE_LAST_UPDATE=GS_FWATCH_LAST_UPDATE; GS_VERSION=" . GS_VERSION . ";GS_URLS=[";

			foreach (GS_OTHER_URL as $url)
				$output .= "]+[\"{$url}\"";
				
			$output .= "];GS_VOICE=[";
			
			foreach (GS_VOICE as $program_name=>$program_info) {
				$is_invite = in_array($program_name,["Discord","Steam"]) ? "true" : "false";
				$output   .= "]+[[\"{$program_name}\",$is_invite,\"{$program_info["download"]}\"]";
			}

			$output .= "];" . GS_output_mods_arrays($mods, 0) . "GS_SERVERS=[";

			foreach ($servers["info"] as $server) {
				$output .= "]+[\"{$server["sqf"]}_server_game_times=[";

				foreach ($server["events"] as $gametime)
					$output .= "]+[{$gametime}";

				$output .= "];_server_modfolders=[";

				foreach ($server["mods"] as $mod_key)
					$output .= "]+[\"\"{$mods["id"][$mod_key]}\"\"";

				$output .= "];true\"";
			}

			$output .= "];GS_LAST_MODIFIED=\"{$mods["lastmodified"]}\";true";
		}
	}

	// Handle request for mod installation script
	if ($input_mode == "install") {
		$mods    = GS_list_mods([], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_GAME, 0);
		$output .= !empty($mods["info"]) ? "install_version ".GS_VERSION : "";
		
		foreach ($mods["info"] as $id=>$mod) {
			$output .= "\n" . $mod["script"];
			
			if (isset($_SERVER['HTTP_OFPGSINSTALL'])) {
				$column_name = $mod["userver"] ? "dls_upd" : "dls_new";
				$db->query("UPDATE gs_mods SET $column_name=$column_name+1 WHERE id=$id");
			}
		}
	}
	
	if ($input_mode == "mods") {
		$mods = GS_list_mods([], $input["mod"], $input["modver"], $input["password"], GS_REQTYPE_GAME_DOWNLOAD_MODS, 0);		
				
		$output .= "GS_FWATCH_LAST_UPDATE=". GS_FWATCH_LAST_UPDATE . "; SCHEDULE_LAST_UPDATE=GS_FWATCH_LAST_UPDATE; GS_VERSION=" . GS_VERSION . "; GS_URLS=[";

		foreach (GS_OTHER_URL as $url)
			$output .= "]+[\"{$url}\"";

		$output .= "]; GS_MODS_ID=[";

		foreach ($mods["id"] as $id)
			$output .= "]+[\"{$id}\"";

		$output .= "];" . GS_output_mods_arrays($mods) . "true";
	}
	
	echo $output;
} else 
	die("false");

?>