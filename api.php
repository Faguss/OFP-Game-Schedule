<?php
require_once "minimal_init.php";
require_once "common.php";

header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');


// Get data from db
$input   = GS_get_common_input();
$db      = DB::getInstance();
$servers = GS_list_servers($input["server"], $input["password"], GS_REQTYPE_WEBSITE, 0);
$mods    = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_WEBSITE, $servers["lastmodified"]);

$servers_keys = array_keys($servers["info"]);
$mod_keys     = array_keys($mods["info"]);
$all_user_id  = [];
$to_remove    = ["id", "ip", "port", "password", "access", "type", "starttime", "timezone", "duration", "modified1", "modified2"];


// Edit server columns
foreach($servers_keys as $id) {
	$servers["info"][$id]["admin"]             = "";
	$servers["info"][$id]["voice"]             = "";
	$servers["info"][$id]["logo"]              = $servers["info"][$id]["logo"]!="" ? (GS_get_current_url().GS_LOGO_FOLDER."/".$servers["info"][$id]["logo"]) : "";
	$servers["info"][$id]["equalmodreq"]       = $servers["info"][$id]["equalmodreq"]=="1" ? true : false;
	$servers["info"][$id]["maxcustomfilesize"] = intval($servers["info"][$id]["maxcustomfilesize"]);
	$servers["info"][$id]["version"]           = floatval($servers["info"][$id]["version"]);
	$servers["info"][$id]["modified"]          = strtotime($servers["info"][$id]["modified1"]);
	$servers["info"][$id]["created"]           = strtotime($servers["info"][$id]["created"]);
	
	// Replace mod id with mod unique id
	foreach($servers["info"][$id]["mods"] as $index=>$mod_id)
		$servers["info"][$id]["mods"][$index] = $mods["info"][$mod_id]["uniqueid"];
		
	// Replace voice ip with program name
	foreach(GS_VOICE as $program_name=>$program_info)
		if (substr($servers["info"][$id]["voice"],0,strlen($program_info["url"])) == $program_info["url"])
			$servers["info"][$id]["voice"] = $program_name;
	
	// Add user id to the list
	if (!in_array($servers["info"][$id]["createdby"],$all_user_id))
		$all_user_id[] = $servers["info"][$id]["createdby"];
	
	if (!in_array($servers["info"][$id]["modifiedby"],$all_user_id))
		$all_user_id[] = $servers["info"][$id]["modifiedby"];
}


// Edit mod columns
foreach($mod_keys as $id) {
	$mods["info"][$id]["admin"]     = "";
	$mods["info"][$id]["forcename"] = $mods["info"][$id]["forcename"]=="true" ? true : false;
	$mods["info"][$id]["is_mp"]     = $mods["info"][$id]["is_mp"]=="1" ? true : false;
	$mods["info"][$id]["type"]      = intval($mods["info"][$id]["type"]);
	$mods["info"][$id]["version"]   = floatval($mods["info"][$id]["version"]);
	$mods["info"][$id]["modified"]  = strtotime($mods["info"][$id]["modified"]);
	$mods["info"][$id]["created"]   = strtotime($mods["info"][$id]["created"]);
	
	$temp_array = explode(",", substr($mods["info"][$id]["sizearray"], 1, -1));
	
	foreach($temp_array as $index=>$item)
		$temp_array[$index] = intval($item);
	
	$mods["info"][$id]["sizearray"] = ["GB"=>$temp_array[0], "MB"=>$temp_array[1], "KB"=>$temp_array[2]];
	
	foreach($mods["info"][$id]["updates"] as $id2=>$update) {
		$mods["info"][$id]["updates"][$id2]["version"] = floatval($update["version"]);
		$mods["info"][$id]["updates"][$id2]["date"]    = strtotime($update["date"]);
		
		foreach($update["note_date"] as $id3=>$notedate)
			$mods["info"][$id]["updates"][$id2]["note_date"][$id3] = strtotime($notedate);
		
		foreach($update["note_version"] as $id3=>$noteversion)
			$mods["info"][$id]["updates"][$id2]["note_version"][$id3] = floatval($noteversion);
	}
	
	// Add user id to the list
	if (!in_array($mods["info"][$id]["createdby"],$all_user_id))
		$all_user_id[] = $mods["info"][$id]["createdby"];
	
	if (!in_array($mods["info"][$id]["modifiedby"],$all_user_id))
		$all_user_id[] = $mods["info"][$id]["modifiedby"];
}
	
	
// Convert user id numbers to usernames
if (!empty($all_user_id)) {
	$sql = "
		SELECT 
			users.id, 
			users.username 
			
		FROM 
			users 
			
		WHERE 
			users.id IN (". substr( str_repeat(",?",count($all_user_id)), 1) . ")
	";
	
	if (!$db->query($sql,$all_user_id)->error()) {
		$all_user_names = [];
		
		foreach($db->results(true) as $row)
			$all_user_names[$row["id"]] = $row["username"];
		
		foreach($servers_keys as $id) {
			$servers["info"][$id]["createdby"]  = $all_user_names[ $servers["info"][$id]["createdby"] ];
			$servers["info"][$id]["modifiedby"] = $all_user_names[ $servers["info"][$id]["modifiedby"] ];
		}
		
		foreach($mod_keys as $id) {
			$mods["info"][$id]["createdby"]  = $all_user_names[ $mods["info"][$id]["createdby"] ];
			$mods["info"][$id]["modifiedby"] = $all_user_names[ $mods["info"][$id]["modifiedby"] ];
		}
	} else {
		$to_remove[] = "createdby";
		$to_remove[] = "modifiedby";
	}
}
	
	
// Get server/mod administrator names
foreach(["serv","mods"] as $type) {
	$column_name      = "";
	$input_array_ptr  = "";
	$output_array_ptr = "";
	
	switch($type) {
		case "serv" : $column_name="Server"; $input_array_ptr="servers_keys"; $output_array_ptr="servers"; break;
		case "mods" : $column_name="Mod"; $input_array_ptr="mod_keys"; $output_array_ptr="mods"; break;
	}
	
	$sql = "
	SELECT 
		gs_{$type}.id, 
		users.username
		
	FROM 
		gs_{$type} JOIN gs_{$type}_admins 
			ON gs_{$type}.id = gs_{$type}_admins.{$column_name}ID 
			
		JOIN users 
			ON gs_{$type}_admins.userid = users.id
				   
	WHERE
		gs_{$type}.id IN (". substr( str_repeat(",?",count($$input_array_ptr)), 1) .") AND
		gs_{$type}_admins.isowner=1
	";	
		
	if (!$db->query($sql,$$input_array_ptr)->error()) {
		foreach($db->results(true) as $row)
			$$output_array_ptr["info"][$row["id"]]["admin"] = $row["username"];
	}
}


// Remove server columns
foreach($to_remove as $column_name)
	foreach($servers_keys as $id)
		unset($servers["info"][$id][$column_name]);


// Change server array keys from id to unique id
foreach($servers_keys as $id) {
	$uniqueid = $servers["info"][$id]["uniqueid"];
	unset($servers["info"][$id]["uniqueid"]);
	
	$servers["info"][$uniqueid] = $servers["info"][$id];
	unset($servers["info"][$id]);
}


// Change mod array keys from id to unique id
foreach($mod_keys as $id) {
	$uniqueid = $mods["info"][$id]["uniqueid"];
	unset($mods["info"][$id]["uniqueid"]);
	
	$mods["info"][$uniqueid] = $mods["info"][$id];
	unset($mods["info"][$id]);
}


/*
// List all ID if requested
$servers["listid"] = [];
$mods["listid"]    = [];

foreach($input["listid"] as $type) {
	$table_name = "";
	$array_ptr  = "";
	
	switch($type) {
		case "servers" : $table_name="serv"; $array_ptr="servers"; break;
		case "mods"    : $table_name="mods"; $array_ptr="mods"; break;
	}

	if (empty($$array_ptr["listid"])) {
		if (!$db->query("SELECT gs_{$table_name}.uniqueid FROM gs_{$table_name}")->error()) {
			foreach($db->results(true) as $row)
				$$array_ptr["listid"][] = $row["uniqueid"];
		}
	}
}*/

$mod_types = [];

for($i=0; $i<4; $i++)
	$mod_types[] = lang("GS_STR_MOD_TYPE$i") ." ". lang("GS_STR_MOD_TYPE$i_DESC");

// Output
echo json_encode([
	"info" => [
		"api_version"         => 1, 
		"gs_version"          => GS_VERSION, 
		"fwatch_lastmodified" => GS_fwatch_date_to_timestamp(GS_FWATCH_LAST_UPDATE), 
		"gs_lastmodified"     => $mods["lastmodified"], 
		"voice"               => GS_VOICE,
		"mod_types"           => $mod_types
	], 
	"servers" => $servers["info"], 
	"mods"    => $mods["info"]
]);
?>
