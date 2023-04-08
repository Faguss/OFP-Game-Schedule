<?php
define("GS_FWATCH_LAST_UPDATE","[2023,4,8,6,14,39,2,706,120,FALSE]");
define("GS_VERSION", 0.6);
define("GS_ENCRYPT_KEY", 0);
define("GS_MODULUS_KEY", 0);
define("GS_DECRYPT_KEY", 0);
define("GS_LOGO_FOLDER", "logo");	// Folder to save uploaded images in
define("GS_OTHER_URL", []);			// Links to other schedule websites
define("GS_SIZE_TYPES", ["KB", "MB", "GB"]);
define("GS_MOD_TYPE_NUM", 4);		// Number of available mod types

// Available actions for pages
define("GS_FORM_ACTIONS", [
	"Add New"  => "GS_STR_INDEX_ADDNEW", 
	"Edit"     => "GS_STR_INDEX_EDIT", 
	"Schedule" => "GS_STR_INDEX_SCHEDULE", 
	"Mods"     => "GS_STR_INDEX_MODS", 
	"Share"    => "GS_STR_INDEX_SHARE", 
	"Delete"   => "GS_STR_INDEX_DELETE", 
	"Update"   => "GS_STR_INDEX_INSTALLATION",
]);

define("GS_FORM_ACTIONS_BY_PAGE", [
	"server" => ["Add New", "Edit", "Schedule", "Mods", "Share", "Delete"],
	"mod"    => ["Add New", "Edit", "Update",           "Share", "Delete"]
]);

define("GS_FORM_ACTIONS_NON_SHAREABLE", ["Add New", "Share", "Delete"]);

define("GS_FORM_ACTIONS_MODUPDATE", [
	"Add"    => "GS_STR_MOD_SECTION_VERSION",
	"Link"   => "GS_STR_MOD_SECTION_JUMP"
]);

// List of VOIP software
define("GS_VOICE", [
	"TeamSpeak3" => ["url"=>"ts3server://"        , "info"=>"https://web.archive.org/web/20121115204541/https://support.teamspeakusa.com/index.php?/Knowledgebase/Article/View/46/0/how-can-i-link-to-my-teamspeak-3-server-on-my-webpage", "download"=>"https://teamspeak.com/en/downloads/"],
	"Mumble"     => ["url"=>"mumble://"           , "info"=>"https://wiki.mumble.info/wiki/Mumble_URL"                               , "download"=>"https://www.mumble.com/mumble-download.php"],
	"Discord"    => ["url"=>"https://discord.gg/" , "info"=>"https://support.discordapp.com/hc/en-us/articles/208866998-Invites-101" , "download"=>"https://discordapp.com/download"],
	"Steam"      => ["url"=>"https://s.team/chat/", "info"=>"https://steamcommunity.com/updates/chatupdate"                          , "download"=>"https://store.steampowered.com/about/"]
]);

// Maximal input length
define("GS_MAX_TXT_INPUT_LENGTH"   , 100);
define("GS_MAX_MSG_INPUT_LENGTH"   , 255);
define("GS_MAX_CODE_INPUT_LENGTH"  , 10);
define("GS_MAX_SCRIPT_INPUT_LENGTH", 10000);

// Log codes
define("GS_LOG_UNKNOWN"              , 0);
define("GS_LOG_SERVER_ADDED"         , 1);
define("GS_LOG_SERVER_UPDATED"       , 2);
define("GS_LOG_SERVER_EVENT_REMOVED" , 3);
define("GS_LOG_SERVER_EVENT_UPDATE"  , 4);
define("GS_LOG_SERVER_EVENT_ADDED"   , 5);
define("GS_LOG_SERVER_MOD_REMOVED"   , 6);
define("GS_LOG_SERVER_MOD_ADDED"     , 7);
define("GS_LOG_SERVER_REVOKE_ACCESS" , 8);
define("GS_LOG_MOD_REVOKE_ACCESS"    , 9);
define("GS_LOG_SERVER_SHARE_ACCESS"  , 10);
define("GS_LOG_MOD_SHARE_ACCESS"     , 11);
define("GS_LOG_SERVER_TRANSFER_ADMIN", 12);
define("GS_LOG_MOD_TRANSFER_ADMIN"   , 13);
define("GS_LOG_SERVER_DELETE"        , 14);
define("GS_LOG_MOD_DELETE"           , 15);
define("GS_LOG_MOD_ADDED"            , 16);
define("GS_LOG_MOD_UPDATED"          , 17);
define("GS_LOG_MOD_SCRIPT_UPDATED"   , 18);
define("GS_LOG_MOD_SCRIPT_ADDED"     , 19);
define("GS_LOG_MOD_VERSION_ADDED"    , 20);
define("GS_LOG_MOD_VERSION_UPDATED"  , 21);
define("GS_LOG_MOD_LINK_ADDED"       , 22);
define("GS_LOG_MOD_LINK_UPDATED"     , 23);
define("GS_LOG_MOD_LINK_DELETED"     , 24);
define("GS_LOG_SERVER_MOD_CHANGED"   , 25);
define("GS_LOG_INSTALLER_UPDATE"     , 26);

// User permissions
define("GS_PERM_NOUSER",0);
define("GS_PERM_USER",1);
define("GS_PERM_ADMIN", 2);
define("GS_PERM_UNLIMITED", 3);
define("GS_PERM_EXPERIENCED", 4);
define("GS_PERMISSION_LEVELS", [		// Order matters here
	GS_PERM_NOUSER,
	GS_PERM_USER,
	GS_PERM_EXPERIENCED,
	GS_PERM_UNLIMITED,
	GS_PERM_ADMIN
]);

define("GS_PERMISSION_MAX_SERVERS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 4,
	GS_PERM_EXPERIENCED => 10,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);
define("GS_PERMISSION_MAX_MODS", GS_PERMISSION_MAX_SERVERS);

define("GS_PERMISSION_MAX_SERV_SCHEDULE", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 4,
	GS_PERM_EXPERIENCED => 10,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);

define("GS_PERMISSION_MAX_SERV_MODS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 8,
	GS_PERM_EXPERIENCED => 20,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);

define("GS_PERMISSION_MAX_SERV_CONTRIBUTORS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 6,
	GS_PERM_EXPERIENCED => 20,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);
define("GS_PERMISSION_MAX_MOD_CONTRIBUTORS", GS_PERMISSION_MAX_SERV_CONTRIBUTORS);

// Function options
define("GS_NO_OPTIONS", 0);
define("GS_USER_INFO", 1);
define("GS_SPLIT_PERSISTENT", 2);

// Request types for GS_list_servers and GS_list_mods
define("GS_REQTYPE_WEBSITE", 0);
define("GS_REQTYPE_GAME", 1);
define("GS_REQTYPE_GAME_DOWNLOAD_MODS", 2);
define("GS_REQTYPE_INSTALL_SCRIPT", 3);

// Available languages on the website
define("GS_LANGUAGES", ["game"=>["English","Russian","Polish"], "file"=>["en-US","ru-RU","pl-PL"]]);



// Functions
// Check user's permission level
function GS_get_permission_level($user) {
	$gs_my_permission_level = GS_PERM_NOUSER;
	
	if (isset($user) && $user->isLoggedIn()) {
		$db  = DB::getInstance();
		$sql = "
			SELECT 
				permission_id 
				
			FROM 
				user_permission_matches,
				permissions 
				
			WHERE 
				user_permission_matches.permission_id = permissions.id AND 
				user_permission_matches.user_id       = ?
		";

		if ($db->query($sql,[$user->data()->id])->error()) {
			if ($user->data()->id == 1)
				echo $sql . $db->errorString();
			echo lang("GS_STR_ERROR_GET_DB_RECORD");
			return $gs_my_permission_level;
		}

		// Final permission level is the one farthest in the array
		foreach($db->results(true) as $row) {
			$selected = array_search($row["permission_id"], GS_PERMISSION_LEVELS);
			$current  = array_search($gs_my_permission_level, GS_PERMISSION_LEVELS);

			if ($selected > $current)
				$gs_my_permission_level = $row["permission_id"];
		}
	}
	
	return $gs_my_permission_level;
}

// Format list with installation scripts for html select 
function GS_script_list_to_script_select($script_list, $name, $section) {
	$scripts_select = [];
	
	foreach ($script_list as $sid=>$description) {
		$option_name = "";
		$first_item  = true;
		
		// For a duplicated script id make option name indicate it
		for ($i=0, $max=count($description);  $i<$max;  $i++) {
			if ($first_item) {
				$first_item  = false;
				$option_name = $section!="Modify" ? lang("GS_STR_MOD_SAME_AS")." {$name} " : "";
			}
			else
				$option_name .= " ".lang("GS_STR_MOD_AND")." ";
			
			$option_name .= $description[$i];
			
			if ($i==3  &&  $max>4) {
				$others       = $max - $i - 1;
				$plural       = $others == 1 ? "" : "s";
				$option_name .= " " . lang("GS_STR_MOD_AND") . " " . GS_lang("GS_STR_MOD_X_OTHERS", [$others]);
				break;
			}
		}
		
		$scripts_select[] = [$option_name, $sid];
	}
	
	return $scripts_select;
}

// Convert list of usernames to the list of records id
function GS_username_to_id($userlist) {
	$sql = "
		SELECT 
			users.id, 
			users.username 
		FROM 
			users 
		WHERE 
			users.username IN (". substr( str_repeat(",?",count($userlist)), 1) . ")
	";
	
	$db          = DB::getInstance();
	$result      = $db->query($sql, $userlist);
	$success     = false;
	$userlist_id = [];
	
	if ($result) {
		$users = $db->results(true);
		
		foreach ($users as $user)		
			if (array_search($user["username"], $userlist) !== FALSE)
				$userlist_id[] = $user["id"];	
	}
	
	return $userlist_id;
}

// Convert list of uniqueid to the list of records id
function GS_uniqueid_to_id($table_name, $id_list) {
	$output = [];
	
	if (!empty($id_list)) {
		$db  = DB::getInstance();
		$sql = "
			SELECT 
				$table_name.id,
				$table_name.uniqueid
			FROM 
				$table_name 
			WHERE 
				$table_name.uniqueid IN (". substr(str_repeat(",?",count($id_list)), 1) . ")
		";

		if (!$db->query($sql,$id_list)->error()) {
			foreach($id_list as $uniqueid)
				foreach($db->results(true) as $row)
					if ($uniqueid == $row["uniqueid"])
						$output[] = $row["id"];
		}
	}
	
	return $output;
}

// Handle form for server/mod sharing
function GS_record_sharing($record_type, $record_table, $record_column, &$form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner) {
	$db          = DB::getInstance();
	$limit       = $record_type=="server" ? GS_PERMISSION_MAX_SERV_CONTRIBUTORS[$gs_my_permission_level] : GS_PERMISSION_MAX_MOD_CONTRIBUTORS[$gs_my_permission_level];
	$permissions = [];
	$permissions_select = [];

	foreach ($permission_to as $key=>$value)
		if (!in_array($key, GS_FORM_ACTIONS_NON_SHAREABLE)) {
			$permissions[]           = $key;
			$stringtable_key         = str_replace("_INDEX_","_SHARE_",GS_FORM_ACTIONS[$key]);
			$permissions_select[]    = [lang($stringtable_key), $key, "checked"];
		}
	
	if ($current_entry_owner)
		$permissions_select[] = [lang("GS_STR_SHARE_TRANSFER"), "isowner"];

	$checkbox_JS = "GS_limit_permissions_choice('permissions[]');";
	$confirm_msg = lang($record_type == "server" ? "GS_STR_SHARE_TRANSFER_CONFIRM_SERVER" : "GS_STR_SHARE_TRANSFER_CONFIRM_MOD");

	$form->title = lang($record_type=="server" ? "GS_STR_SERVER_SHARESERVER_PAGE_TITLE" : "GS_STR_SERVER_SHAREMOD_PAGE_TITLE", ["<B>{$form->hidden["display_name"]}</B>"]);

	$form->add_select("username", lang("GEN_UNAME"), "", [], "", "datalist", "placeholder=\"bob45\"");
	$form->add_select("permissions", lang("GS_STR_SHARE_PERMISSIONS"), lang("GS_STR_SHARE_TRANSFER_HINT"), $permissions_select, "", "checkbox", "onClick=\"{$checkbox_JS}\"");
	$form->add_button("action", $form->hidden["display_form"], lang("GS_STR_SHARE_GRANT"), "btn-primary", "", "onClick=\"return GS_confirm_transfer_ownership('permissions[]', '{$confirm_msg}')\"");	
	$form->add_html("<script type=\"text/javascript\">{$checkbox_JS}</script>");
	$form->include_file("usersc/js/gs_functions.js");
		
		
	// If user wants to cancel record sharing
	if ($form->hidden["action"] == "Revoke") {
		$userlist = Input::get("userlist");
		
		if (is_array($userlist)) {
			$set = "";
			
			foreach ($permissions as $permission)
				$set .= ", gs_{$record_table}_admins.right_".strtolower($permission)." = 0";

			$userlist_id = GS_username_to_id($userlist);
			if (!empty($userlist_id)) {
				// Get id of the records that are going to be modificated for logging purposes
				$records_id_list = [];
				$sql = "
					SELECT
						gs_{$record_table}_admins.id
					FROM
						gs_{$record_table}_admins
					WHERE
						gs_{$record_table}_admins.serverid = ? AND
						gs_{$record_table}_admins.userid IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")
				";
				if (!$db->query($sql, array_merge([$id],$userlist_id))->error())
					foreach($db->results(true) as $row)
						$records_id_list[] = $row["id"];
				
				// Modify table
				$sql      = "
					UPDATE 
						gs_{$record_table}_admins
					JOIN 
						users 				
					ON 
						gs_{$record_table}_admins.userid = users.id AND 
						users.id IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")

					SET " . substr($set, 1) . " , gs_{$record_table}_admins.modified=?, gs_{$record_table}_admins.modifiedby=?
				";

				$count  = count($userlist_id); /*$db->count() - 1;*/
				
				$sql_arguments   = $userlist_id;
				$sql_arguments[] = date("Y-m-d H:i:s");
				$sql_arguments[] = $uid;

				$result = $form->feedback(
					$db->query($sql, $sql_arguments),
					"GS_STR_SHARE_REMOVED", 
					"GS_STR_SHARE_REMOVED_ERROR",
					"GS_lang",
					[$count]
				);
				
				if ($result)
					foreach($records_id_list as $record_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$record_id, "type"=>constant("GS_LOG_".strtoupper($record_type)."_REVOKE_ACCESS"), "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->alert(lang("GS_STR_SHARE_FIND_USERS_ERROR"));			
		} else
			$form->alert(lang("GS_STR_SHARE_NOSEL_ERROR"));
	}
	
	
	// Find who already has access
	$sql = "
		SELECT
			gs_{$record_table}_admins.*,
			users.username
			
		FROM
			gs_{$record_table}_admins,
			users
			
		WHERE
			gs_{$record_table}_admins.{$record_column}id = ? AND
			gs_{$record_table}_admins.userid             = users.id
			
		ORDER BY
			users.username
	";
	
	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$users         = $db->results(true);
	$js_users_perm = ["name"=>"Contributors", "data"=>[]];
	$contributors  = [];

	foreach ($users as $person)
		if ($person["isowner"] == "0")
			foreach ($permissions as $permission)
				if ($person["right_".strtolower($permission)]) {
					$contributors[] = $person["username"];
					$all            = [];
					
					foreach ($permissions as $permission2)
						$all[] = $person["right_".strtolower($permission2)] ? true : false;
					
					$js_users_perm["data"][] = [
						"username"    => $person["username"],
						"permissions" => $all
					];
					break;
				}




	
	
	
	
	
	// If user wants to share server
	if ($form->hidden["action"] == "Share") {
		$data          = &$form->save_input();
		$custom_errors = [];
		$transfer      = false;
		$new_guy       = true;
		
		// If user selected option to transer ownership
		if (in_array("isowner", $data["permissions"])) {
			if (count($data["permissions"]) == 1) {	// all other options must be unchecked
				$transfer = true;
				if (!$current_entry_owner)
					$custom_errors[] = [lang("GS_STR_SHARE_NOTOWNER_ERROR"), "permissions"];
			} else
				$custom_errors[] = [lang("GS_STR_SHARE_TRANSFER_HINT"), "permissions"];
			
			$data["permissions"] = array_diff($data["permissions"], ["isowner"]);	//don't save that input
		}		
		
		$form->init_validation     ( ["max"=>40, "required"=>true] );
		$form->add_validation_rules( ["username"]   , ["min"=>3] );
		$form->add_validation_rules( ["permissions"], ["in"=>$permissions_select, "required"=>empty($custom_errors) && !$transfer] );			

		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA")))
		{
			// Create an array for inserting into table db
			$contributor = [
				"{$record_column}id" => $id,
				"userid"             => NULL
			];

			if ($transfer)
				$contributor["isowner"] = 1;
			else
				foreach ($permissions as $permission)
					$contributor["right_".strtolower($permission)] = in_array($permission, $data["permissions"]);
					
			// Find user ID number among existing contributors
			foreach ($users as $person)
				if (isset($data["username"])  &&  strcasecmp($person["username"], $data["username"]) == 0) {
					if ($person["isowner"] == 0) {
						$contributor["id"]	   = $person["id"];
						$contributor["userid"] = $person["userid"];
						$new_guy               = array_search(strtolower($person["username"]), array_map("strtolower",$contributors)) === FALSE;
					} else {
						$new_guy = false;
						$form->alert("{$data["username"]} ".lang("GS_STR_SHARE_ALREADY_ERROR"));
					}
					
					break;
				}
			
			
			// Otherwise search database
			if (isset($data["username"])  &&  !isset($contributor["userid"])  &&  $new_guy)
				if (count($contributors) < $limit) {
					$contributor["userid"] = $db->cell("users.id",["username","LIKE",$data["username"]]);
					
					if (!isset($contributor["userid"]))
						$form->alert(lang("GS_STR_SHARE_FIND_USER_ERROR")); 
				} else
					$form->alert(lang("GS_STR_SHARE_LIMIT_ERROR"));


			// Upload data
			if (isset($contributor["userid"])) {
				$contributor["modified"]   = date("Y-m-d H:i:s");
				$contributor["modifiedby"] = $uid;
				
				if ($new_guy) {
					$contributor["created"]   = date("Y-m-d H:i:s");
					$contributor["createdby"] = $uid;
				}
				
				$result = $db->insert("gs_{$record_table}_admins", $contributor, true);

				$form->feedback(
					$result, 
					($new_guy ? lang("GS_STR_SHARE_GRANTED", [$data["username"]]) : lang("GS_STR_SHARE_UPDATED")),
					($new_guy ? lang("GS_STR_SHARE_GRANTED_ERROR")                : lang("GS_STR_SHARE_UPDATED_ERROR"))
				);

				if ($result) {
					$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>constant("GS_LOG_".strtoupper($record_type)."_" . ($transfer ? "TRANSFER_ADMIN" : "SHARE_ACCESS")), "added"=>date("Y-m-d H:i:s")]);
					$data["username"] = "";
					
					if ($transfer) {
						$former_admin_record_id = -1;
						$sql = "
							SELECT
								gs_{$record_table}_admins.id
							FROM
								gs_{$record_table}_admins
							WHERE
								gs_{$record_table}_admins.serverid = ? AND
								gs_{$record_table}_admins.userid IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")
						";
						if (!$db->query($sql, array_merge([$id],$userlist_id))->error())
							foreach($db->results(true) as $row)
								$records_id_list[] = $row["id"];
						
						
						$former_admin               = ["isowner"=>0];
						$former_admin["modified"]   = date("Y-m-d H:i:s");
						$former_admin["modifiedby"] = $uid;
						
						foreach ($permissions as $permission)
							$former_admin["right_".strtolower($permission)] = false;

						$db->update("gs_{$record_table}_admins", ["and",["userid","=",$uid],["{$record_column}id","=",$id]], $former_admin);
						Redirect::to('index.php');
					} else {
						if ($db->query($sql,[$id])->error())
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
						
						$users         = $db->results(true);
						$js_users_perm = ["name"=>"Contributors", "data"=>[]];
						$contributors  = [];
						
						foreach ($users as $person)
							if ($person["isowner"] == "0")
								foreach ($permissions as $permission)
									if ($person["right_".strtolower($permission)]) {
										$contributors[] = $person["username"];
										$all            = [];
										
										foreach ($permissions as $permission2)
											$all[] = $person["right_".strtolower($permission2)] ? true : false;
										
										$js_users_perm["data"][] = [
											"username"    => $person["username"],
											"permissions" => $all
										];
										break;
									}
					}
				}
			}
		}
	}



	
	
	
	
	if (count($contributors) >= $limit) {
		$form->controls = [];
		$form->add_heading(lang("GS_STR_SHARE_LIMIT_ERROR"), "Username");
	}
	
	
	// Display form to remove users
	if (!empty($contributors)) {		
		$form->add_js_var($js_users_perm);
		$form->add_space();
		$form->add_select("userlist", lang("GS_STR_SHARE_CONTRIBUTORS"), "", $contributors, "", $limit, " onChange=\"GS_show_user_permissions('userlist', 'username', 'permissions[]', {$js_users_perm["name"]})\"");
		$form->add_button("action", "Revoke", lang("GS_STR_SHARE_REVOKE"), "btn-warning");
	}
}

// Handle form for server/mod deletion
function GS_record_delete($record_type, $record_table, &$form, $id, $uid) {
	$db = DB::getInstance();
	$record_type_localized = ucfirst(lang("GS_STR_".strtoupper($record_type)));

	$form->title = lang("GS_STR_DELETE_PAGE_TITLE", [strtolower(lang("GS_STR_".strtoupper($record_type))), "<B>{$form->hidden["display_name"]}</B>"]);
	
	$form->add_button("action", "Go Back", lang("GS_STR_DELETE_GOBACK"), "btn-success btn-lg");
	
	if ($form->hidden["action"] == "Delete") {
		$result = $db->update("gs_{$record_table}", $id, ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]);
		
		$form->feedback(
			$result,
			lang("GS_STR_DELETE_DONE", [$record_type_localized]),
			lang("GS_STR_DELETE_DONE_ERROR", [$record_type_localized])
		);
		
		if ($result)	
			$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>constant("GS_LOG_".strtoupper($record_type)."_DELETE"), "added"=>date("Y-m-d H:i:s")]);
	} else {
		$form->add_space();
		$form->add_button("action", $form->hidden["display_form"], lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]), "btn-danger btn-sm");
	}
}

// Interpret expression typed by the user (for jumping between mod versions)
function GS_parse_jump_rule($string, $from_version, $to_version) {
	$string     = str_replace(["&lt;","&gt;"], ["<",">"], strtolower(trim($string)));
	$max        = strlen($string);
	$lastType   = "";
	$wordStart  = 0;
	$triadStart = 0;
	$i          = 0;
	$triad      = [];
	$comparison = ["==", "=", "!=", "<>", ">", "<", ">=", "<="];
	$logical    = ["and", "or", "&&", "||"];
	$macro      = ["v", "ver", "version"];
	
	if ($max == 0)
		return false;
	
	// For each letter
	while ($i <= $max) {
		$letter = isset($string[$i]) ? $string[$i] : "";
		$type   = "";	
		
			// Handle parentheses ------------------------------
			if ($letter == ")") 
				return "parenthesis closed without being opened at $i: <SPAN STYLE=\"font-family:monospace;\">" . substr($string,0,$i+1) . "</SPAN>";

			if ($letter == "(") {
				$level = 0;

				for ($j=$i;  $j<$max;  $j++) {
					if ($string[$j] == "(")
						$level++;

					if ($string[$j] == ")")
						$level--;
					
					if ($level == 0)
						break;
				}
				
				if ($level == 0) {
					$parenthesis = substr($string, $i+1, $j-$i-1);
					$result      = GS_parse_jump_rule($parenthesis, $from_version, $to_version);
					
					if (is_string($result))
						return $result;
					else
						$result = $result ? "true" : "false";

					$triad      = [];
					$string     = substr_replace($string, $result, $i, $j-$i+1);
					$max        = strlen($string);
					$lastType   = "";
					$i          = 0;
					$wordStart  = 0;
					$triadStart = 0;
					continue;
				} else
					return "parenthesis opened without being closed at $i: <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$i) . "</SPAN>";
			}
			// -------------------------------------------------
		
		
		// Find word type to be able to separate word from other words
		if (ctype_alpha($letter))
			$type = "letter";
		
		if (is_numeric($letter)  ||  in_array($letter,[".","-"]))
			$type = "number";
		
		if (in_array($letter,["<",">","=","!","&","|"]))
			$type = "operator";
		
		
		// Extract word
		if ($lastType != $type) {
			$word = trim(substr($string, $wordStart, $i-$wordStart));

			if (strlen($word)>0  &&  !ctype_space($word)) {
				$triad[] = $word;
				
				if ($lastType=="letter"  &&  !in_array($word,$macro,TRUE)  &&  !in_array($word,$logical,TRUE)  &&  !in_array($word,["true","false"],TRUE))
					return "invalid operand \"$word\" in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
			}

			// When built a full expression
			if (count($triad) == 3) {
				// Replace 'ver' with version number and bools with actual bools
				for ($z=0; $z<3; $z++) {
					if (in_array($triad[$z],$macro,TRUE))
						$triad[$z] = $from_version;
					
					if (in_array($triad[$z],["true","false"],TRUE))
						$triad[$z] = $triad[$z]=="true" ? true : false;
				}
				
				$l  = &$triad[0];
				$op = &$triad[1];
				$r  = &$triad[2];
				
				// If logic operator doesn't have two boolean arguments then keep going
				if (in_array($op, $logical)  &&  (!is_bool($l) || !is_bool($r))) {
					if (!is_bool($l))
						return "left operand must be boolean in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					else {
						$i          = $wordStart;
						$triadStart = $wordStart;
						$lastType   = "";
						$triad      = [];
						continue;
					}
				}
				
				// Verify numbers
				if (in_array($op,$comparison)) {
					if (!is_numeric($l) || !is_numeric($r))
						return "operands must be numbers in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if ($l>$to_version  ||  $r>$to_version)
						return "number cannot be larger than $to_version in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if ($op==">" && $r==$to_version  ||  $op=="<" && $l==$to_version)
						return "comparison going out of range in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if (in_array($to_version,[$l,$r])  &&  in_array($op,["=","==","<=",">="],TRUE))
						return "number cannot be equal $to_version in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";					
				}
				
				if (in_array($op,$logical)  &&  (!is_bool($l) || !is_bool($r)))
					return "operands must be booleans in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";

				$result = "";
		
				// Evaluate expression
				switch ($op) {
					case "=="  : 
					case "="   : $result=$l == $r; break;
					case "!="  :
					case "<>"  : $result=$l != $r; break;
					case ">"   : $result=$l > $r; break;
					case "<"   : $result=$l < $r; break;
					case ">="  : $result=$l >= $r; break;
					case "<="  : $result=$l <= $r; break;
					case "or"  : 
					case "||"  : $result=$l || $r; break;
					case "and" : 
					case "&&"  : $result=$l && $r; break;
					default    : return "invalid operator $op in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
				}
				
				// Insert result into string and reset parsing
				$result     = $result ? "true" : "false";
				$string     = substr_replace($string, $result, $triadStart, $i-$triadStart);
				$max        = strlen($string);
				$i          = 0;
				$wordStart  = 0;
				$triadStart = 0;
				$lastType   = "";
				$triad      = [];
				continue;
			} else
				// Finished string - return result
				if ($i >= $max) {
					if (count($triad) == 1) {
						if ($word == "true")
							return true;
						else
							if ($word == "false")
								return false;
					}
							
					return "incomplete expression <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
				}

			// Move on to the next word
			$lastType  = $type;
			$wordStart = $i;
		}
		
		$i++;
	}
}

// https://stackoverflow.com/questions/13740661/validate-windows-filename
function GS_is_valid_windows_filename($filename) {
$regex = <<<'EOREGEX'
~                               # start of regular expression
^                               # Anchor to start of string.
(?!                             # Assert filename is not: CON, PRN, AUX, NUL, COM1, COM2, COM3, COM4, COM5, COM6, COM7, COM8, COM9, LPT1, LPT2, LPT3, LPT4, LPT5, LPT6, LPT7, LPT8, and LPT9.
    (CON|PRN|AUX|NUL|COM[1-9]|LPT[1-9])
    (\.[^.]*)?                  # followed by optional extension
    $                           # and end of string
)                               # End negative lookahead assertion.
[^<>:"/\\|?*\x00-\x1F]*         # Zero or more valid filename chars.
[^<>:"/\\|?*\x00-\x1F\ .]       # Last char is not a space or dot.
$                               # Anchor to end of string.
                                #
                                # tilde = end of regular expression.
                                # i = pattern modifier PCRE_CASELESS. Make the match case insensitive.
                                # x = pattern modifier PCRE_EXTENDED. Allows these comments inside the regex.
                                # D = pattern modifier PCRE_DOLLAR_ENDONLY. A dollar should not match a newline if it is the final character.
~ixD
EOREGEX;

    return preg_match($regex, $filename) === 1;
}

// Convert bytes to a readable text or to an array for the game
function GS_convert_size_in_bytes($bytes, $output_type) {
	$bytes     = intval($bytes);
	$kilobytes = 0;
	$megabytes = 0;
	
	if ($bytes > 1048576) {
		$megabytes  = $bytes / 1048576;
		$megabytes -= fmod($megabytes, 1);
		$bytes     -= $megabytes * 1048576;
	}
	
	if ($bytes > 1024) {
		$kilobytes  = $bytes / 1024;
		$kilobytes -= fmod($kilobytes, 1);
		$bytes     -= $kilobytes * 1024;
	}
	
	if ($output_type == "game")
		return "[$bytes, $kilobytes, $megabytes]";
	
	if ($output_type == "website") {
		$array = [$bytes, $kilobytes, $megabytes];
		$index = 2;
		
		if ($array[2] == 0) 
			$index = 1;
		
		if ($array[1] == 0) 
			$index = 0;
		
		$size = $array[$index];

		if ($index > 0) 
			$size += $array[$index-1] / 1024;
		
		return (round($size, 2) . " " . ["B","KB","M"][$index]);
	}
	
	return "";
}

// Convert date in Fwatch format to a timestamp
function GS_fwatch_date_to_timestamp($input, $output_string=false) {
	$time_array  = explode(",", substr($input, 1, -1));
	$date_object = DateTime::createFromFormat('Y-n-d G:i:s.u', sprintf('%d-%02d-%02d %02d:%02d:%02d.%06d', $time_array[0],$time_array[1],$time_array[2], $time_array[4],$time_array[5],$time_array[6],$time_array[7]));
	
	if ($date_object)
		return $output_string ? $date_object->format('Y-m-d H:i:s') : $date_object->getTimestamp();
	else
		return $output_string ? "" : 0;
}

// https://www.techiedelight.com/rsa-algorithm-implementation-c/
function GS_encrypt($string, $encrypt_key, $modulus_key) {
	if ($encrypt_key==0 ||  $modulus_key==0)
		return $string;
	
	$encrypted = "";
	$letters   = str_split($string);

	foreach($letters as $letter) {
		$letter = ord($letter);
		$result = 1;
		$key    = $encrypt_key;
		
		while($key > 0) {
			if ($key % 2 == 1)
				$result = ($result * ($letter)) % $modulus_key;

			$letter = $letter * $letter % $modulus_key;
			$key    = $key / 2;
		}
		
		if ($encrypted != "")
			$encrypted .= chr(97);
		
		$digits = str_split((string)$result);
		
		foreach($digits as $digit)
			$encrypted .= chr(98 + intval($digit));
	}
	
	return $encrypted;
}

// https://www.techiedelight.com/rsa-algorithm-implementation-c/
function GS_decrypt($string, $decrypt_key, $modulus_key) {
	$numbers = [];
	$words   = explode("a",$string);
	
	foreach($words as $word) {
		$letters = str_split($word);
		$number  = "";
		
		foreach($letters as $letter)
			$number .= ord($letter) - 98;
			
		$numbers[] = intval($number);
	}
	
	foreach($numbers as $number) {
		$number = intval($number);
		$result = 1;
		$key    = $decrypt_key;
		
		while($key > 0) {
			if ($key % 2 == 1)
				$result = ($result * ($number)) % $modulus_key;

			$number = $number * $number % $modulus_key;
			$key    = $key / 2;
		}
		
		$decrypted .= chr($result);
	}
	
	return $decrypted;
}

// List servers with upcoming events
function GS_list_servers($server_id_list, $password, $request_type, $last_modified, $language="English", $user=NULL, $timeoffset=0) {
	$output          = ["info"=>[], "mods"=>[], "id"=>[], "lastmodified"=>$last_modified, "rights"=>[], "listbox"=>[]];
	$specific_server = "";
	$ignore_outdated = true;

	if (count($server_id_list)==1 && ($server_id_list[0]=="all" || $server_id_list[0]=="current")) {
		if ($server_id_list[0] == "all")
			$ignore_outdated = false;
		
		unset($server_id_list[0]);
	} else {
		$specific_server = "AND gs_serv.uniqueid IN (".substr( str_repeat(",?",count($server_id_list)), 1).")";
		$ignore_outdated = false;
	}

	// Get server list
	$sql = "
		SELECT 
			gs_serv.id,
			gs_serv.name, 
			gs_serv.ip,
			gs_serv.password,
			gs_serv.version,
			gs_serv.equalmodreq,
			gs_serv.languages,
			gs_serv.location,
			gs_serv.message,
			gs_serv.website,
			gs_serv.logo,
			gs_serv.logohash,
			gs_serv.uniqueid,
			gs_serv.access,
			gs_serv.maxcustomfilesize,
			gs_serv.voice,
			gs_serv.persistent,
			gs_serv.created,
			gs_serv.createdby,
			gs_serv.modifiedby,
			gs_serv.modified AS modified1,
			gs_serv.status,
			gs_serv.status_expires,
			gs_serv_times.type, 
			gs_serv_times.starttime, 
			gs_serv_times.timezone, 
			gs_serv_times.duration,
			gs_serv_times.modified AS modified2,
			gs_serv_admins.userid AS admin,
			gs_serv_admins.modified AS adminsince
			
		FROM 
			gs_serv LEFT JOIN gs_serv_times 
				ON gs_serv.id = gs_serv_times.serverid  
				AND gs_serv_times.removed = 0
				
			LEFT JOIN gs_serv_admins
				ON gs_serv.id = gs_serv_admins.serverid
				AND gs_serv_admins.isowner = 1
			
		WHERE 
			gs_serv.removed = 0
			$specific_server
			
		ORDER BY 
			gs_serv.name
	";
		
	// Get servers
	$db = DB::getInstance();

	if (!$db->query($sql,$server_id_list)->error()) {
		$last_id    = -1;
		$table_rows = $db->results(true);

		// First check for private servers
		$private_servers = [];
		$all_id          = [];

		foreach($table_rows as $row) {
			$all_id[] = $row["id"];

			if ($row["access"]!="" && array_search($row["access"],$password)===FALSE)
				$private_servers[] = $row["id"];
		}

		// Check if logged-in user can preview these servers
		if ($request_type==GS_REQTYPE_WEBSITE && isset($user) && $user->isLoggedIn()) {
			$sql = "
			SELECT 
				gs_serv_admins.serverid,
				gs_serv_admins.right_edit,
				gs_serv_admins.right_schedule,
				gs_serv_admins.right_mods,
				gs_serv_admins.isowner
				
			FROM 
				gs_serv, 
				gs_serv_admins
				
			WHERE 
				gs_serv.id            = gs_serv_admins.serverid AND
				gs_serv_admins.userid = ".$user->data()->id." AND
				gs_serv.id in (". implode(',',$all_id) .") AND
				(gs_serv_admins.isowner=1 OR gs_serv_admins.right_edit=1 OR gs_serv_admins.right_schedule=1 OR gs_serv_admins.right_mods=1)
			";

			if (!$db->query($sql)->error()) {
				foreach($db->results(true) as $row) {
					$permission_to = [];
					
					foreach (GS_FORM_ACTIONS_BY_PAGE["server"] as $name) {
						$column_name = "right_".strtolower($name);
						
						if ($row["isowner"] == "1")
							$permission_to[$name] = true;
						else
							$permission_to[$name] = isset($row[$column_name]) ? intval($row[$column_name]) : false;
					}

					$output["rights"][$row["serverid"]] = $permission_to;
					$private_servers                    = array_diff($private_servers, [$row["serverid"]]);
				}
			}
		}
		
		
		// Copy data from table rows to an array
		foreach($table_rows as $row) {
			$id = $row["id"];
			
			// If address not given or restricted access
			if ($row["ip"]=="" || in_array($id,$private_servers))
				continue;

			for ($i=1; $i<=2; $i++)
				if (strtotime($row["modified$i"]) > $output["lastmodified"])
					$output["lastmodified"] = strtotime($row["modified$i"]);			
			
			// Add server to the list
			if ($last_id != $id) {
				$last_id                           = $id;
				$output["info"][$id]["events"]     = [];
				$output["info"][$id]["persistent"] = $row["persistent"];
				$output["info"][$id]["uniqueid"]   = $row["uniqueid"];
				$output["id"][$id]                 = $row["uniqueid"];
				
				if ($request_type == GS_REQTYPE_GAME) {
					$output["info"][$id]["status"]         = $row["status"];
					$output["info"][$id]["status_expires"] = $row["status_expires"];
					$output["info"][$id]["ip"]             = $row["ip"];
									
					foreach ($row as $key=>$value) {
						$value     = html_entity_decode($value, ENT_QUOTES);
						$new_value = $value;
						$add_value = $value != "";

						switch ($key) {
							case "uniqueid"          : 
							case "website"           :
							case "message"           : 
							case "location"          : 
							case "name"              : $new_value="\"".GS_convert_utf8_to_windows($value, $language)."\""; if ($key=="name") $output["info"][$id]["name"]=GS_convert_utf8_to_windows($value, $language); break;
							case "equalmodreq"       : $new_value=$value=="1" ? "true" : "false"; break;
							case "version"           : $new_value="$value"; break;
							case "logo"              : $new_value="\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$value}\""; break;
							case "logohash"          : $new_value="\"{$value}\""; break;
							case "maxcustomfilesize" : {
								if ($add_value)
									$output["info"][$id]["sqf"] .= "_server_maxcustombytes=\"$value\";";
								$new_value = GS_convert_size_in_bytes($value, "game");
							} break;
							
							case "ip" : {
								$ip       = $value;
								$ip_parts = explode(":", $value);
								if (count($ip_parts) >= 2) {
									$ip = $ip_parts[0];
									$output["info"][$id]["sqf"] .= "_server_port=\"".GS_encrypt($ip_parts[1], GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\";";
								}
								$new_value = "\"".GS_encrypt($ip, GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\""; break;
							} break;
							
							case "password" : $new_value="\"".GS_encrypt($value, GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\""; break;
							
							case "voice" : {
								$add_value = false;
								$index = 0;
								foreach(GS_VOICE as $program_name=>$program_info) {
									if (substr($value,0,strlen($program_info["url"])) == $program_info["url"]) {
										$new_value = "[$index,\"{$program_info["url"]}";
										
										switch ($program_name) {
											case "TeamSpeak3" : {
												$parts = [];
												parse_str(parse_url($value, PHP_URL_QUERY), $parts);
												
												if (isset($parts["password"]))
													$parts["password"] = GS_encrypt($parts["password"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);
												
												if (isset($parts["channelpassword"]))
													$parts["channelpassword"] = GS_encrypt($parts["channelpassword"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);
												
												$new_value .= GS_encrypt(substr(strtok($value,"?"),strlen($program_info["url"])),GS_ENCRYPT_KEY,GS_MODULUS_KEY) . "?" . http_build_query($parts);
											} break;
											
											default : $new_value.=GS_encrypt(substr($value,strlen($program_info["url"])), GS_ENCRYPT_KEY, GS_MODULUS_KEY); break;
										}

										$new_value .= "\"]";;
										$add_value = true;
										break;
									}
									
									$index++;
								}
							} break;
							
							case "languages" : {
								$temp_array = explode(", ", $row["languages"]);
								$new_value  = "[";
								
								foreach($temp_array as $item)
									$new_value .= "]+[\"".trim($item)."\"";
									
								$new_value .= "]";
							} break;
							
							default : $add_value=false; break;
						}
							
						if ($add_value)
							$output["info"][$id]["sqf"] .= "_server_{$key}={$new_value};";
					}
					
					if (GS_ENCRYPT_KEY==0 ||  GS_MODULUS_KEY==0)
						$output["info"][$id]["sqf"] .= "_server_encrypted=false;";
				}
					
				if ($request_type == GS_REQTYPE_WEBSITE)
					$output["info"][$id] = $row;
			}
			
			// Add game time to the list
			if (!$row["persistent"] && isset($row["starttime"]))
				$output["info"][$id]["events"][] = [
					"timezone"  => $row["timezone"], 
					"starttime" => $row["starttime"], 
					"type"      => $row["type"], 
					"duration"  => $row["duration"]
				];
		}
		
		// Sort game times
		$playing_now    = [];
		$playing_today  = [];
		$playing_future = [];
		$server_added   = [];
		$persistent     = [];
		
		foreach($output["info"] as $id=>&$server) {
			// Filter out outdated events
			foreach($server["events"] as $key=>&$event) {
				$time_zone       = new DateTimeZone($event["timezone"]);				// time zone object
				$start_date      = new DateTime($event["starttime"], $time_zone);		// when does the game start
				$start_date_orig = clone $start_date;
				$type            = ["single", "weekly", "daily"][$event["type"]];		// recurrence
				$now             = new DateTime("now", $time_zone);		
				
				// if it's a recurrent event then I need to update it to the current time because of DST
				if ($start_date < $now  &&  $type!="single") {
					$offset = 0;
					
					if ($type=="weekly"  &&  $now->format('w')!=$start_date->format('w')) {
						$now_day   = intval($now->format('w'));
						$start_day = intval($start_date->format('w'));

						if ($start_day > $now_day)
							$offset = $start_day - $now_day;
						else
							$offset = 7 - $now_day + $start_day;
					}

					$start_date->setDate($now->format('Y'), $now->format('m'), $now->format('d'));
					$start_date->modify("+".$offset." day");
				}
				
				$end_date = clone $start_date;
				$end_date->modify("+".$event["duration"]."minutes");
				
				// If the event has not ended
				if ($end_date > $now) {
					$playtime = null;
					
					if ($request_type == GS_REQTYPE_GAME) {
						// Localize date time for the user
						$utc_start = clone $start_date;
						$utc_start->modify(($timeoffset>0?"+":"").$timeoffset." minutes");
						
						$utc_end = clone $end_date;
						$utc_end->modify(($timeoffset>0?"+":"").$timeoffset." minutes");
						
						$locale = "en_GB";
						if ($language == "Polish") $locale="pl_PL";
						if ($language == "Russian") $locale="ru_RU";
						
						$formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::FULL, "UTC", IntlDateFormatter::GREGORIAN);
						$playtime = "\"";
						
						if ($type=="single" || (($type=="weekly" || $type=="daily") && $start_date_orig > $now)) {
							$formatter->setPattern('d MMMM ');
							$playtime .= $formatter->format($utc_start);
						}
						
						if ($type == "daily")
							$playtime .= GS_convert_utf8_to_windows(lang("GS_STR_SERVER_EVENT_REPEAT_DAILY"), $language) . " ";
						
						if ($type == "weekly")
							$playtime .= GS_convert_utf8_to_windows(lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC".$utc_start->format("w")), $language) . " ";
						
						$formatter->setPattern('HH:mm');
						$playtime .= $formatter->format($utc_start) . " - " . $formatter->format($utc_end) . "\"";
					}
					
					if ($request_type == GS_REQTYPE_WEBSITE) {
						// Convert date to universal
						$start_date->setTimezone(new DateTimeZone("UTC"));
						
						// Describe event
						$playtime_text   = "";
						$playtime_format = "Y jS F H:i";
						
						if (($type!="single") && $now < $start_date_orig)
							$playtime_text .= $start_date_orig->format("Y jS F. ");
						
						switch($type) {
							case "weekly" : $playtime_text.=lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC".$start_date->format("w"))." "; $playtime_format="H:i"; break;
							case "daily"  : $playtime_text.=lang("GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC")." "; $playtime_format="H:i"; break;
						}
						
						$playtime_text .= $start_date->format($playtime_format) . $end_date->format(" - H:i T P");
						
						$playtime = [
							"type"        => intval($row["type"]), 
							"date"        => $start_date->getTimestamp(),
							"starttime"   => $start_date->format('c'),
							"duration"    => intval($row["duration"]),
							"description" => $playtime_text,
							"started"     => $now > $start_date_orig
						];
					}
					
					$event["date"]           = $start_date;
					$event["date_formatted"] = $playtime;
				
					$array_reference = &$playing_now;
					
					// If the event has not started
					if ($start_date > $now) {
						if (date_diff($now, $start_date)->format("%a") == 0)
							$array_reference = &$playing_today;
						else
							$array_reference = &$playing_future;
					}
					
					if (!in_array($id,$server_added)) {
						$server_added[]    = $id;
						$array_reference[] = $id;
					}
				} else {
					unset($server["events"][$key]);
				}
			}
			
			if (!$server["persistent"]) {
				if (count($server["events"]) > 0 || !$ignore_outdated) {
					// Sort events
					uasort($server["events"], function ($a, $b) {return $a["date"] <=> $b["date"];});

					// Include today game time
					if (in_array($id,$playing_today)) {
						$time_zone = new DateTimeZone($server["events"][0]["timezone"]);
						$offset    = $time_zone->getOffset($server["events"][0]["date"]) / 60;
						$output["info"][$id]["sqf"] .= "_today_game_time=" . $server["events"][0]["date"]->format("[Y,n,j,w,H,i,s") . ",0,$offset,false];";
					}
				} else {
					unset($output["info"][$id]);
					unset($output["id"][$id]);
				}
			} else {
				$persistent[]   = $id;
				$server_added[] = $id;
			}
		}
		
		if ($request_type == GS_REQTYPE_GAME)
			$output["listbox"] = [
				"now"        => $playing_now, 
				"today"      => $playing_today, 
				"future"     => $playing_future, 
				"persistent" => $persistent
			];
		
		// Update server status
		foreach($server_added as $id) {
			if (strtotime("now") > strtotime($output["info"][$id]["status_expires"])) {
				$ip = $output["info"][$id]["ip"];
				
				if (strpos($ip,":") === FALSE)
					$ip .= ":2302";
				
				$output["info"][$id]["status"] = GS_url_get_contents("https://ofp-api.ofpisnotdead.com/{$ip}?timeout=0.5", 1);

				$db->update("gs_serv", $id, [
					"status"         => $output["info"][$id]["status"], 
					"status_expires" => date('Y-m-d H:i:s', strtotime("+1 minute"))
				]);
			}
		}
	}

	// Get mods assigned to servers
	if (!empty($output["info"])) {
		$sql = "
			SELECT 
				gs_serv.id AS serverid,
				gs_mods.id,
				gs_mods.name,
				gs_mods.uniqueid,
				gs_serv_mods.modified

			FROM 
				gs_serv,
				gs_mods, 
				gs_serv_mods 

			WHERE 
				gs_serv.id      = gs_serv_mods.serverid AND
				gs_mods.id      = gs_serv_mods.modid    AND
				gs_serv.removed = 0                     AND
				gs_mods.removed = 0                     AND
				gs_serv_mods.removed = 0                AND
				gs_serv_mods.serverid IN (" . substr( str_repeat(",?",count($output["info"])), 1) . ")

			ORDER BY 
				gs_serv.id, gs_serv_mods.loadorder
		";
	
		if (!$db->query($sql,array_keys($output["info"]))->error()) {
			$last_id    = -1;
			$table_rows = $db->results(true);
		
			foreach($table_rows as $row) {
				if (strtotime($row["modified"]) > $output["lastmodified"])
					$output["lastmodified"] = strtotime($row["modified"]);
			
				$mod_id  = $row["id"];
				$serv_id = $row["serverid"];

				if ($last_id != $serv_id) {
					$last_id                          = $serv_id;
					$output["info"][$serv_id]["mods"] = [];
				}

				$output["info"][$serv_id]["mods"][] = $mod_id;
				
				if (!in_array($mod_id, $output["mods"]))
					$output["mods"][] = $mod_id;
			}
		}
	}
	
	return $output;
}

// List mods details
function GS_list_mods($mods_id_list, $mods_uniqueid_list, $user_mods_version, $password, $request_type, $last_modified, $user=NULL) {
	$output          = ["info"=>[], "id"=>[], "lastmodified"=>$last_modified, "userlist"=>[], "rights"=>[]];
	$mods_links      = [];
	$mods_updates    = [];
	$where_condition = "";
	$argument_list   = [];
	$Parsedown       = new Parsedown();

	if (!empty($mods_id_list)) {
		$argument_list    = $mods_id_list;
		$where_condition .= "gs_mods.id IN (".substr( str_repeat(",?",count($mods_id_list)), 1).")";
	}
	
	if (!empty($mods_uniqueid_list)) {
		if (in_array("all",$mods_uniqueid_list))
			$where_condition = "gs_mods.removed=0";
		else {
			$argument_list    = array_merge($argument_list, $mods_uniqueid_list);
			$where_condition .= ($where_condition!="" ? " OR " : "") . "gs_mods.uniqueid IN (".substr( str_repeat(",?",count($mods_uniqueid_list)), 1).") AND gs_mods.removed=0";
		}
	}
	
	if (!empty($where_condition)) {
		$sql = "
			SELECT 
				gs_mods.id,
				gs_mods.name,
				gs_mods.subtitle,
				gs_mods.description,
				gs_mods.uniqueid,
				gs_mods.type,
				gs_mods.forcename,
				gs_mods.modified AS modified1,
				gs_mods.created,
				gs_mods.createdby,
				gs_mods.modifiedby,
				gs_mods.access,
				gs_mods.alias,
				gs_mods.is_mp,
				gs_mods.type,
				gs_mods.website,
				gs_mods.logo,
				gs_mods.logohash,
				gs_mods_updates.version,
				gs_mods_updates.created AS update_created,
				gs_mods_updates.modified AS modified2,
				gs_mods_updates.changelog,
				gs_mods_updates.createdby AS update_createdby,
				gs_mods_scripts.id AS scriptid,
				gs_mods_scripts.size,
				".($request_type==GS_REQTYPE_GAME ? "' '" : "gs_mods_scripts.script")." AS script,
				gs_mods_scripts.modified AS modified3,
				gs_mods_links.fromver,
				gs_mods_links.removed,
				gs_mods_links.alwaysnewest,
				scripts2.id       AS scriptid2,
				scripts2.size     AS size2,
				".($request_type==GS_REQTYPE_GAME ? "' '" : "scripts2.script")." AS scripts2,
				scripts2.modified AS modified4,
                gs_mods_admins.userid AS admin,
				gs_mods_admins.modified AS adminsince

			FROM
				gs_mods 
					JOIN gs_mods_updates 
						ON gs_mods.id = gs_mods_updates.modid
                                
					JOIN gs_mods_scripts 
						ON gs_mods_updates.scriptid = gs_mods_scripts.id 
					
					LEFT JOIN gs_mods_links
						ON gs_mods_updates.id = gs_mods_links.updateid
					
					LEFT JOIN gs_mods_scripts scripts2
						ON gs_mods_links.scriptid = scripts2.id
                        
                    LEFT JOIN gs_mods_admins
                    	ON gs_mods.id = gs_mods_admins.modid AND gs_mods_admins.isowner = 1
				
			WHERE
				$where_condition
				
			ORDER BY
				gs_mods.name,
				gs_mods_updates.version
			";

		// Request data from db
		$db = DB::getInstance();
		
		if (!$db->query($sql,$argument_list)->error()) {
			$table_rows = $db->results(true);
			
			// First check for private mods
			$private_mods = [];
			$all_id       = [];
			
			foreach($table_rows as $row) {
				$all_id[] = $row["id"];
				
				if ($row["access"]!="" && !in_array($row["id"],$mods_id_list) && !in_array($row["id"],$private_mods) && array_search($row["access"],$password)===FALSE)
					$private_mods[] = $row["id"];
			}
			
			if (!empty($private_mods)) {
				// Check if these private mods are used on public servers or private servers for which we have a password
				$sql = "
				SELECT 
					gs_mods.id
					
				FROM 
					gs_serv, 
					gs_mods, 
					gs_serv_mods 

				WHERE 
					gs_serv.id = gs_serv_mods.serverid AND 
					gs_mods.id = gs_serv_mods.modid AND 
					gs_serv.access IN (''".substr( str_repeat(",?",count($password)), 1).") AND
					gs_mods.id IN (".substr( str_repeat(",?",count($private_mods)), 1).") AND
					gs_serv.removed = 0 AND
					gs_mods.removed = 0 AND
					gs_serv_mods.removed = 0
				";

				// If so then allow to display it
				if (!$db->query($sql,array_merge($password,$private_mods))->error())
					foreach($db->results(true) as $row)
						$private_mods = array_diff($private_mods, [$row["id"]]);
			}
				
			// Check if logged-in user can preview these mods
			if ($request_type==GS_REQTYPE_WEBSITE && isset($user) && $user->isLoggedIn()) {
				$sql = "
				SELECT 
					gs_mods_admins.modid,
					gs_mods_admins.right_edit,
					gs_mods_admins.right_update,
					gs_mods_admins.isowner
					
				FROM 
					gs_mods, 
					gs_mods_admins
					
				WHERE 
					gs_mods.id            = gs_mods_admins.modid AND
					gs_mods_admins.userid = ".$user->data()->id." AND
					gs_mods.id in (". implode(',',$all_id) .") AND
					(gs_mods_admins.isowner=1 OR gs_mods_admins.right_edit=1 OR gs_mods_admins.right_update=1)
				";

				// If so then allow to display it
				if (!$db->query($sql)->error())
					foreach($db->results(true) as $row) {
						$permission_to = [];
						
						foreach (GS_FORM_ACTIONS_BY_PAGE["mod"] as $name) {
							$column_name = "right_".strtolower($name);
							
							if ($row["isowner"] == "1")
								$permission_to[$name] = true;
							else
								$permission_to[$name] = isset($row[$column_name]) ? intval($row[$column_name]) : false;
						}

						$output["rights"][$row["modid"]] = $permission_to;
						$private_mods                    = array_diff($private_mods, [$row["modid"]]);
					}
			}


			// Copy table rows to arrays
			$last_id       = -1;
			$last_version  = 0;
			$first_version = 0;

			foreach($table_rows as $row) {
				$id      = $row["id"];
				$version = $row["version"];
				
				if (in_array($id,$private_mods))
					continue;

				if ($last_id != $id) {
					switch($request_type) {
						case GS_REQTYPE_GAME :
							$output["info"][$id]["name"]      = $row["name"];
							$output["info"][$id]["type"]      = $row["type"];
							$output["info"][$id]["createdby"] = $row["createdby"];
							$output["info"][$id]["created"]   = $row["created"];
							$output["info"][$id]["forcename"] = $row["forcename"] ? "true" : "false";
							$output["info"][$id]["is_mp"]     = $row["is_mp"] ? "true" : "false";
							$output["info"][$id]["website"]   = $row["website"];
							$output["info"][$id]["logo"]      = $row["logo"];
							$output["info"][$id]["logohash"]  = $row["logohash"];
							$output["info"][$id]["uniqueid"]  = $row["uniqueid"];
							
							if (!in_array($row["createdby"], $output["userlist"]))
								$output["userlist"][] = $row["createdby"];
							
							if (isset($Parsedown))
								$output["info"][$id]["description"] = "\"".str_replace("\"", "\"\"\"\"", html_entity_decode(strip_tags($Parsedown->line($row["description"])),ENT_QUOTES))."\"";
							break;
							
						case GS_REQTYPE_INSTALL_SCRIPT :
							$output["info"][$id]["name"]      = $row["name"];
							$output["info"][$id]["forcename"] = $row["forcename"];
							$output["info"][$id]["alias"]     = $row["alias"];
							$output["info"][$id]["uniqueid"]  = $row["uniqueid"];
							break;
					}

					$output["id"][$id] = $row["uniqueid"];
					$mods_links[$id]   = [];
					$last_id           = $id;
					$last_version      = 0;
					$first_version     = 0;
				}
				
				if ($first_version == 0)
					$first_version = $version;

				for ($i=1; $i<=4; $i++)
					if (strtotime($row["modified$i"]) > $output["lastmodified"])
						$output["lastmodified"] = strtotime($row["modified$i"]);

				if (isset($row["fromver"])) {
					$columns_to_copy = ["fromver", "version", "scriptid2", "size2", "script2", "removed", "alwaysnewest"];
					$link_num        = count($mods_links[$id]);
					
					foreach($columns_to_copy as $column)
						$mods_links[$id][$link_num][$column] = in_array($request_type,[GS_REQTYPE_GAME,GS_REQTYPE_INSTALL_SCRIPT]) ? html_entity_decode($row[$column], ENT_QUOTES) : $row[$column];
				}

				if ($last_version != $version) {
					$last_version    = $version;
					$columns_to_copy = ["version", "scriptid", "size", "script", "update_created", "changelog", "update_createdby"];
					$update_num      = count($mods_updates[$id]);
									
					foreach($columns_to_copy as $column)
						$mods_updates[$id][$update_num][$column] = in_array($request_type,[GS_REQTYPE_GAME,GS_REQTYPE_INSTALL_SCRIPT]) ? html_entity_decode($row[$column], ENT_QUOTES) : $row[$column];
				}
				
				if ($request_type == GS_REQTYPE_WEBSITE) {
					$output["info"][$id]["name"]         = $row["name"];
					$output["info"][$id]["subtitle"]     = $row["subtitle"];
					$output["info"][$id]["description"]  = $row["description"];
					$output["info"][$id]["version"]      = $version;
					$output["info"][$id]["uniqueid"]     = $row["uniqueid"];
					$output["info"][$id]["forcename"]    = $row["forcename"] == "1" ? "true" : "false";
					$output["info"][$id]["type"]         = $row["type"];
					$output["info"][$id]["createdby"]    = $row["createdby"];
					$output["info"][$id]["modifiedby"]   = $row["modifiedby"];
					$output["info"][$id]["created"]      = $row["created"];
					$output["info"][$id]["modified"]     = $row["modified1"];
					$output["info"][$id]["alias"]        = $row["alias"];
					$output["info"][$id]["is_mp"]        = $row["is_mp"];
					$output["info"][$id]["allversions"]  = [];
					$output["info"][$id]["admin"]        = $row["admin"];
					$output["info"][$id]["adminsince"]   = $row["adminsince"];
					$output["info"][$id]["access"]       = $row["access"];
					$output["info"][$id]["firstversion"] = $first_version;
					$output["info"][$id]["website"]      = $row["website"];
					$output["info"][$id]["logo"]         = $row["logo"];
					
					if (!in_array($row["createdby"], $output["userlist"]))
						$output["userlist"][] = $row["createdby"];
						
					if (!in_array($row["admin"], $output["userlist"]))
						$output["userlist"][] = $row["admin"];
				}
			}
		}

		// Process mods updates for each mod
		foreach ($mods_updates as $id=>$updates) {
			$input_version = 0;
			
			if (array_key_exists($output["id"][$id], $user_mods_version))
				$input_version = $user_mods_version[$output["id"][$id]];
			
			$output["info"][$id]["updates"] = [];
			$output["info"][$id]["userver"] = $input_version;
			$current_version                = $input_version;
			$temp_scripts_id                = [];
			$dates                          = [];
			$download_size                  = [0   , 0   , 0   ];
			$download_size_unit             = ["gb", "mb", "kb"];
			
			if ($request_type == GS_REQTYPE_WEBSITE)
				$output["info"][$id]["installversion"] = $current_version;

			// Go through every version of this mod
			foreach ($updates as $update_num=>$update) {
				$toversion = $update["version"];
				$script_id = $update["scriptid"];
				$size      = $update["size"];
				$script    = $update["script"];
				$date      = $update["update_created"];
				$changelog = nl2br(htmlspecialchars($update["changelog"]));

				// Look for a valid jump between versions
				foreach ($mods_links[$id] as $link) {
					if (!$link["removed"]) {
						$destination_version = $link["version"];
						
						if ($link["alwaysnewest"]) {
							$keys                = array_keys($updates);
							$newest              = $updates[$keys[count($keys)-1]];
							$destination_version = $newest["version"];
						}
						
						$parse_result = GS_parse_jump_rule($link["fromver"], $current_version, $destination_version);

						if ($parse_result === TRUE) {
							$toversion = $destination_version;
							$script_id = $link["scriptid2"];
							$size      = $link["size2"];
							$script    = $link["script2"];							
							
							// Find date of the update that is being jumped to
							for($i=0; $i<count($updates); $i++)
								if ($updates[$i]["version"] == $toversion) {
									$date = $updates[$i]["update_created"];
									break;
								}
							
							break;
						}
					}
				}

				// Add version details to the array
				$update_index = false;

				// If update is going sequentially then current version is smaller than update version - add info from the update
				if ($current_version < $toversion) {
					$current_version = $toversion;
					$size_array      = explode(' ', $size);

					// If script is not duplicated then add it
					if (!in_array($script_id,$temp_scripts_id)) {
						$temp_scripts_id[] = $script_id;
						$output["info"][$id]["updates"][] = ["version"=>$toversion, "date"=>$date, "script"=>$script, "createdby"=>$update["update_createdby"]];

						if (!in_array($update["update_createdby"], $output["userlist"]))
							$output["userlist"][] = $update["update_createdby"];

						if (count($size_array) > 1) {
							$size_number = floatval($size_array[0]);
							$size_unit   = strtolower($size_array[1]);
							$index_unit  = array_search($size_unit, $download_size_unit);

							if ($index_unit !== FALSE)
								$download_size[$index_unit] += $size_number;
						}
					} else {
						// If script is duplicated then find update that uses this script and change its version number and date
						$update_index = array_search($script_id, $temp_scripts_id);
						
						for ($i=count($temp_scripts_id)-1; $i>=0 && $script_id == $temp_scripts_id[$i]; $i--) {
							$output["info"][$id]["updates"][$i]["version"] = $current_version;
							$output["info"][$id]["updates"][$i]["date"]    = $date;
						}
					}
				} else {
					// If a jump was made then current version is higher than the update version - add all info from the "smaller" updates to the last item in the array
					if (!empty($output["info"][$id]["updates"]))
						$update_index = count($output["info"][$id]["updates"])-1;
				}

				if ($request_type == GS_REQTYPE_WEBSITE) {
					$output["info"][$id]["allversions"][] = $update["version"];

					// Add patch notes for every version above input mod version			
					if ($input_version==0 || $toversion>$input_version) {
						// If there was a jump or script was duplicated then add to the existing array (and refresh date)
						if ($update_index !== FALSE)
							$output["info"][$id]["updates"][$update_index]["date"] = $date;
						else
							// otherwise add to the last array
							$update_index = !empty($output["info"][$id]["updates"]) ? count($output["info"][$id]["updates"])-1 : 0;

						$output["info"][$id]["updates"][$update_index]["note"][]         = $changelog;
						$output["info"][$id]["updates"][$update_index]["note_date"][]    = $date;
						$output["info"][$id]["updates"][$update_index]["note_version"][] = $update["version"];
						$output["info"][$id]["updates"][$update_index]["note_author"][]  = $update["update_createdby"];
						
						if (!in_array($update["update_createdby"], $output["userlist"]))
							$output["userlist"][] = $update["update_createdby"];
					}
				}
			}

			// Format download size to a readable text
			if (in_array($request_type,[GS_REQTYPE_WEBSITE,GS_REQTYPE_GAME])) {
				$formatted_download_size = "0 KB";
				
				if ($download_size[2] > 1024) {
					$full_megs         = $download_size[2] / 1024;
					$download_size[1] += $full_megs;
					$download_size[0] -= $full_megs  * 1024;
				}
				
				if ($download_size[1] > 1024) {
					$full_gigs         = $download_size[1] / 1024;
					$download_size[0] += $full_gigs;
					$download_size[1] -= $full_gigs  * 1024;
				}
				
				if ($download_size[0] > 0) {
					$download_size[0]        += $download_size[1]/1024 + $download_size[2]/1048576;
					$formatted_download_size  = floatval(sprintf("%01.1f", $download_size[0])) . " GB";
				} else
					if ($download_size[1] > 0) {
						$download_size[1]        += $download_size[2]/1024;
						$formatted_download_size  = floatval(sprintf("%01.0f", $download_size[1])) . " MB";
					} else
						if ($download_size[2] > 0)
							$formatted_download_size = floatval(sprintf("%01.0f", $download_size[2])) . " KB";
				
				$output["info"][$id]["size"]      = $formatted_download_size;
				$output["info"][$id]["sizearray"] = "[" . implode(",", $download_size) . "]";
				$output["info"][$id]["version"]   = $current_version;
			}
		}
	}
	
	return $output;
}


// Handle url query string
function GS_get_common_input() {
	$input      = ["modver"=>[]];
	$input_keys = ["server", "mod", "ver", "password", "password_mods", "listid", "user"];

	foreach($input_keys as $key) {
		$input[$key] = isset($_GET[$key]) ? explode(",",$_GET[$key]) : [];
		
		if (isset($_POST[$key]))
			$input[$key] = array_merge($input[$key], explode(",",$_POST[$key]));
	}

	foreach($input["mod"] as $key=>$value)
		$input["modver"][$value] = isset($input["ver"][$key]) ? $input["ver"][$key] : 0;
	
	$input["language"] = GS_LANGUAGES["game"][0];
	
	if (isset($_GET["language"])  ||  isset($_POST["language"])) {
		$index = array_search(
			isset($_POST["language"]) ? $_POST["language"] : $_GET["language"], 
			GS_LANGUAGES["game"]
		);
		
		if ($index !== FALSE)
			$input["language"] = GS_LANGUAGES["game"][$index];
	}
	
	if (isset($_POST["timeoffset"]))
		$input["timeoffset"] = $_POST["timeoffset"];
	else
		if (isset($_GET["timeoffset"]))
			$input["timeoffset"] = $_GET["timeoffset"];	
		else
			$input["timeoffset"] = 0;

	return $input;
}

// Get current domain and folder
function GS_get_current_url($add_https=true, $add_path=true) {
	$path = $_SERVER['REQUEST_URI'];
	$pos  = strrpos($path, "/");
	
	if ($pos !== false)
		$path = substr($path, 0, $pos);

	return "http" . ($add_https && isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . ($add_path ? "$path/" : "");
}

// Read array with servers and output html
function GS_format_server_info(&$servers, &$mods, $box_size, $options=GS_NO_OPTIONS, $server_order=[]) {
	$html                 = "";
	$js_starttime         = [];
	$js_duration          = [];
	$js_type              = [];
	$js_started           = [];
	$user_list            = [];
	$js_addedon           = [];
	$js_serv_id           = [];
	$add_persistent_title = -1;
	
	// Get user list first
	if ($options & GS_USER_INFO) {
		$user_id_list = [];
		
		foreach ($servers["info"] as $server_id=>$server) {
			if (!in_array($server["createdby"], $user_id_list))
				$user_id_list[] = $server["createdby"];
				
			if (!in_array($server["admin"], $user_id_list))
				$user_id_list[] = $server["admin"];
		}
			
		$db  = DB::getInstance();
		$sql = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($user_id_list)), 1) . ")";

		if (!$db->query($sql,$user_id_list)->error())
			foreach($db->results(true) as $row)
				$user_list[$row["id"]] = $row["username"];
	}
	
	if (count($server_order) == 0)
		$server_order = $servers["id"];
	
	// Option: put servers with events first and those without at the end
	if ($options & GS_SPLIT_PERSISTENT) {
		$event_based          = [];
		$persistent           = [];
		$add_persistent_title = true;

		forEach ($servers["info"] as $index=>$server) {
			if (count($server["events"]) == 0)
				$persistent[] = $servers["id"][$index];
			else
				$event_based[] = $servers["id"][$index];
		}
		
		$server_order = array_merge($event_based, $persistent);
	}

	// Prepare a list translating game status id to a description
	$server_status_list   = [lang("GS_STR_SERVER_OFFLINE")];
	$server_status_list   = array_pad($server_status_list, 4, lang("GS_STR_SERVER_CREATE"));
	$server_status_list[] = lang("GS_STR_SERVER_EDIT");
	$server_status_list   = array_pad($server_status_list, 7, lang("GS_STR_SERVER_WAIT"));
	$server_status_list   = array_pad($server_status_list, 9, lang("GS_STR_SERVER_SETUP"));
	$server_status_list   = array_pad($server_status_list, 11, lang("GS_STR_SERVER_DEBRIEFING"));
	$server_status_list   = array_pad($server_status_list, 13, lang("GS_STR_SERVER_SETUP"));
	$server_status_list[] = lang("GS_STR_SERVER_BRIEFING");
	$server_status_list[] = lang("GS_STR_SERVER_PLAY");

	// Display server information
	foreach($server_order as $uniqueid) {
		$id = array_search($uniqueid, $servers["id"]);
		if ($id === FALSE)
			continue;

		$server            = $servers["info"][$id];
		$server_name       = empty($server["name"]) ? $server["uniqueid"] : $server["name"];
		$current_starttime = [];
		$current_duration  = [];
		$current_type      = [];
		$current_started   = [];
		
		if ($options & GS_SPLIT_PERSISTENT  &&  $add_persistent_title  &&  count($server["events"])==0) {
			$add_persistent_title = false;
			$html .= "</div><div class=\"gs_section_title\">".lang("GS_STR_INDEX_PERSISTENT")."</div><div class=\"row\">";
		}
		
		$html .= "<div class=\"col-lg-$box_size\">";
		
		// Add links to edit page if user has the right to edit this mod
		if (!empty($servers["rights"][$id])) {
			$navigation_menu = new Generated_Form([], Session::get(Config::get('session/token_name')), "edit_server.php", false);
			$navigation_menu->hidden["uniqueid"]     = $uniqueid;
			$navigation_menu->hidden["display_name"] = $server["name"];
			$navigation_menu->label_size             = 0;
			
			foreach ($servers["rights"][$id] as $key=>$value)
				if ($value  &&  $key!="Add New") {
					$navigation_menu->add_button("display_form", $key, lang(GS_FORM_ACTIONS[$key]), "btn-primary btn-xs");
					$navigation_menu->change_control(-1, ["Inline"=>-1, "LabelClass"=>" "]);
				}

			$html .= $navigation_menu->display();
		}
		
		$html .= "
			<div class=\"panel panel-default\">
				<div class=\"panel-body servers_background\" style=\"display:flex;\">
					<div style=\"flex-grow:2\">";
					
		// Show image
		if (!empty($server["logo"]) && substr($server["logo"], -3)!="paa")
			$html .= "
			<div style=\"margin-bottom: 10px;\">
			<img style=\"vertical-align:middle\" src=\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$server["logo"]}\">
			<span class=\"gs_servermod_title\">$server_name</span>
			</div>";
		else
			$html .= "<h2 style=\"margin-top:0;\">$server_name</h2>";

		$html .= "<dl class=\"row\" style=\"margin-bottom:0;\">";
		
		$keys = [
			"version"           => lang("GS_STR_SERVER_VERSION"),
			"modfolders"        => lang("GS_STR_SERVER_MODS"),
			"maxcustomfilesize" => lang("GS_STR_SERVER_CUSTOMFILE"),
			"game time"         => lang("GS_STR_SERVER_GAMETIME"),
			"languages"         => lang("GS_STR_SERVER_LANGUAGES"),
			"location"          => lang("GS_STR_SERVER_LOCATION"), 
			"voice"				=> lang("GS_STR_SERVER_VOICE_PROGRAM"),
			"website"           => lang("GS_STR_SERVER_WEBSITE"), 
			"message"           => lang("GS_STR_SERVER_MESSAGE"),
			"access"            => lang("GS_STR_SERVER_ACCESSCODE")
		];

		foreach ($keys as $key=>$name) {
			$value    = "";
			$dd_class = "";
			
			switch($key) {
				case "maxcustomfilesize" : {
					if ($server[$key] != "")
						$value = GS_convert_size_in_bytes($server[$key], "website");
				} break;
				
				case "website" : {
					if (!empty($server[$key])) {
						$domain = parse_url($server[$key])["host"];
						
						if (substr($domain,0,4) == "www." )
							$domain = substr($domain,4);
						
						$value = "<a href=\"{$server[$key]}\" target=\"_blank\">$domain</a>";
					}
				} break;
				
				case "modfolders" : {
					$mod_list_links = [];
					
					foreach ($server["mods"] as $id) {
						$version          = $mods["info"][$id]["version"]!=1 ? " &nbsp; v{$mods["info"][$id]["version"]}" : "";
						$mod_list_links[] = "<a href=\"show.php?mod={$mods["info"][$id]["uniqueid"]}\" target=\"_blank\">{$mods["info"][$id]["name"]}</a> &nbsp; <span style=\"font-size:70%;\">{$mods["info"][$id]["size"]}{$version}</span>";
					}
					
					$value = implode("<br>",$mod_list_links);
				} break;
				
				case "game time" : {
					$dd_class = "servergametime";
					foreach ($server["events"] as $event) {
						$value .= (empty($value) ? "" : "<br>") . $event["description"];
						$current_starttime[] = $event["starttime"];
						$current_duration[]  = $event["duration"];
						$current_type[]      = $event["type"];
						$current_started[]   = $event["started"];
					}
				} break;
				
				case "voice" : {
					foreach(GS_VOICE as $program_name=>$program_info)
						if (substr($server["voice"],0,strlen($program_info["url"])) == $program_info["url"])
							$value = "<a href=\"{$program_info["download"]}\">$program_name</a>";
				} break;
				
				default: $value=$server[$key];
			}
			
			if (!empty($value))
				$html .= "<dt>{$name}:</dt><dd".($dd_class!="" ? " class=\"$dd_class\"" : "").">{$value}</dd>";
		}
		
		$js_starttime[] = $current_starttime;
		$js_duration[]  = $current_duration;
		$js_type[]      = $current_type;
		$js_started[]   = $current_started;
		$js_serv_id[]   = $uniqueid;
		$js_expired[]   = strtotime("now") > strtotime($server["expires"]);
		
		// Add server status
		$server_status_name    = $server_status_list[0];
		$server_status_mission = "";
		$server_status_players = "";
		
		$server_status = json_decode($server["status"], true);
		
		if (isset($server_status)) {
			if (isset($server_status["gstate"]))
				$server_status_name = $server_status_list[$server_status["gstate"]];
			
			if (isset($server_status["gametype"]) && isset($server_status["mapname"]))
				$server_status_mission = $server_status["gametype"] . "." . $server_status["mapname"];
			
			if (isset($server_status["numplayers"]) && isset($server_status["players"])) {
				$server_status_players = $server_status["numplayers"];
				
				foreach($server_status["players"] as $player)
					$server_status_players .= "<br>" . $player["player"];
			}
		}
		
		$display_mission = $server_status_mission=="" || $server_status_mission=="." ? "none" : "block";
		$display_players = empty($server_status_name!=$server_status_list[0]) ? "none" : "block";
	
		$html .= "
			<dt>".lang("GS_STR_SERVER_STATUS") .":</dt>
			<dd id=\"query{$server["uniqueid"]}_status\">$server_status_name</dd>
			
			<dt id=\"query{$server["uniqueid"]}_mission_dt\" style=\"display:$display_mission;\">".lang("GS_STR_SERVER_MISSION").":</dt>
			<dd id=\"query{$server["uniqueid"]}_mission\" style=\"display:$display_mission;\">$server_status_mission</dd>
			
			<dt id=\"query{$server["uniqueid"]}_players_dt\" style=\"display:$display_players;\">".lang("GS_STR_SERVER_PLAYERS").":</dt>
			<dd id=\"query{$server["uniqueid"]}_players\" style=\"display:$display_players;\">$server_status_players</dd>
		</dl>";

		if (isset($user_list[$server["createdby"]])) {
			$js_addedon[] = date("c",strtotime($server["created"]));
			$html .= "<span style=\"font-size:x-small;\">$uniqueid</span><small><span style=\"float:right;\">".lang("GS_STR_ADDED_BY_ON",[$user_list[$server["createdby"]],"<span class=\"server_addedon\">".date("jS M Y",strtotime($server["created"]))."</span>"])."</span></small>";

			if ($server["admin"] != $server["createdby"])
				$html .= "<br><small><span style=\"float:right;\">".lang("GS_STR_MANAGED_BY_SINCE", [$user_list[$server["admin"]], date("jS M Y",strtotime($server["adminsince"]))])."</small>";
		}
		
		$html .= "
		</div>
		<div>
			<a href=\"show.php?server={$server["uniqueid"]}".($server["access"]!="" ? "&password={$server["access"]}" : "")."\"><span class=\"glyphicon glyphicon-link\"></span></a>
			<br>
			<a href=\"rss.php?server={$server["uniqueid"]}".($server["access"]!="" ? "&password={$server["access"]}" : "")."\"><span class=\"fa fa-rss\"></span></a>
		</div>
		
		</div></div></div>";
	}
	
	$locale_file = "en-gb";
	
	switch(lang("THIS_CODE")) {
		case "ru-RU" : $locale_file="ru"; break;
		case "pl-PL" : $locale_file="pl"; break;
	}

	$localized_strings = [
		"Daily" => "GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC",
		"0"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC0",
		"1"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC1",
		"2"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC2",
		"3"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC3",
		"4"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC4",
		"5"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC5",
		"6"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC6"
	];
	
	foreach($localized_strings as $key=>$value)
		$localized_strings[$key] = lang($value);
		
	$html .= "
	<script type=\"text/javascript\" src=\"usersc/js/gs_functions.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/moment.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/{$locale_file}.js\"></script>
	<script type=\"text/javascript\">
		GS_convert_server_events(".json_encode($js_starttime).",".json_encode($js_duration).",".json_encode($js_type).",".json_encode($js_started).",".json_encode($localized_strings).");
		GS_convert_addedon_date('server_addedon',".json_encode($js_addedon).");";
		
	// Show server status
	$html .= "
	var GS_serv_id     = ".json_encode($js_serv_id)."
	var GS_game_status = ".json_encode($server_status_list)."
	var GS_expired     = ".json_encode($js_expired)."
	
	window.onload = function() {
		for (var i=0; i<GS_serv_id.length; i++) {
			if (GS_expired[i]) {
				$.ajax({
					type: 'POST',
					data: {queryserver:GS_serv_id[i]},
					input_id: GS_serv_id[i],
					url: 'js_request.php',
					dataType: 'json',
					success: function (server) {
						if (server != null) {							
							if (server.gstate)
								$('#query'+this.input_id+'_status').html(GS_game_status[server.gstate]);
							else
								$('#query'+this.input_id+'_status').html(GS_game_status[0]);
							
							if (server.gametype && server.gametype != '') {
								var mission_name = server.gametype + '.' + server.mapname;
								$('#query'+this.input_id+'_mission').html(mission_name);
								$('#query'+this.input_id+'_mission').show();
								$('#query'+this.input_id+'_mission_dt').show();
							} else {
								$('#query'+this.input_id+'_mission').hide();
								$('#query'+this.input_id+'_mission_dt').hide();
							}
							
							if (server.gstate && server.gstate != 0) {
								var players = server.numplayers;

								if (server.players) {
									for (var j=0; j<server.players.length; j++)
										players += '<br>' + server.players[j].player;
									
									$('#query'+this.input_id+'_players').html(players);
									$('#query'+this.input_id+'_players').show();
									$('#query'+this.input_id+'_players_dt').show();
								}
							} else {
								$('#query'+this.input_id+'_players').hide();
								$('#query'+this.input_id+'_players_dt').hide();
							}
						}
					}
				});
			}
		}
	}
	";
	
	$html .= "</script>
	";
		
	return $html;
}

// Get and format data from the log table
function GS_get_activity_log($limit, $exclude_type, $show_private, $gs_permission_level, $input=["password"=>[], "user"=>[]]) {
	$db      = DB::getInstance();
	$max     = $db->cell("gs_log.count(*)");
	$offset  = 0;
	$buffer  = 100;
	$output  = [];
	$last_id = -1;
	$detailed_server_mod_change = !in_array(GS_LOG_SERVER_MOD_CHANGED, $exclude_type);
	
	if (!isset($max))
		return $output;

	while($offset < $max && count($output)<$limit) {
		$sql = "SELECT * FROM gs_log";
		
		if (!empty($exclude_type))
			$sql .= " WHERE gs_log.type NOT IN (". substr( str_repeat(",?",count($exclude_type)), 1) . ")";
			
		if (!empty($input["user"])) {
			$input["user"] = GS_username_to_id($input["user"]);
			$sql .= (empty($exclude_type) ? " WHERE" : " AND") . " gs_log.userid IN (". substr( str_repeat(",?",count($input["user"])), 1) . ")";
		}
		
		$sql    .= " ORDER BY ID DESC LIMIT $offset, $buffer";
		$logs    = $db->query($sql,array_merge($exclude_type,$input["user"]))->results(true);
		$offset += $buffer;
		
		if ($db->error())
			return $output;

		$data = [	
			"gs_serv_times"   => [],
			"gs_serv_mods"    => [],
			"gs_serv_admins"  => [],
			"gs_serv"         => [],
			"gs_mods_links"   => [],
			"gs_mods_updates" => [],
			"gs_mods_admins"  => [],
			"gs_mods_scripts" => [],
			"gs_mods"         => [],
			"gs_announce"     => [],
			"users"           => []
		];

		// First pass - determine what records from other tables we need to get
		foreach ($logs as $log) {
			$array = "";
				
			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED          : 
				case GS_LOG_SERVER_UPDATED        :
				case GS_LOG_SERVER_DELETE         : $array="gs_serv"; break;
				case GS_LOG_SERVER_EVENT_REMOVED  :
				case GS_LOG_SERVER_EVENT_UPDATE   :
				case GS_LOG_SERVER_EVENT_ADDED    : $array="gs_serv_times"; break;
				case GS_LOG_SERVER_MOD_CHANGED    : 
				case GS_LOG_SERVER_MOD_ADDED      :
				case GS_LOG_SERVER_MOD_REMOVED    : $array="gs_serv_mods"; break;
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : $array="gs_serv_admins"; break;
				case GS_LOG_MOD_REVOKE_ACCESS     :
				case GS_LOG_MOD_SHARE_ACCESS      :
				case GS_LOG_MOD_TRANSFER_ADMIN    : $array="gs_mods_admins"; break;
				case GS_LOG_MOD_ADDED             : 
				case GS_LOG_MOD_UPDATED           : 
				case GS_LOG_MOD_DELETE            : $array="gs_mods"; break;
				case GS_LOG_MOD_SCRIPT_ADDED      : 
				case GS_LOG_MOD_SCRIPT_UPDATED    : $array="gs_mods_scripts"; break;
				case GS_LOG_MOD_VERSION_ADDED     : 
				case GS_LOG_MOD_VERSION_UPDATED   : $array="gs_mods_updates"; break;
				case GS_LOG_MOD_LINK_ADDED        : 
				case GS_LOG_MOD_LINK_DELETED      :
				case GS_LOG_MOD_LINK_UPDATED      : $array="gs_mods_links"; break;
				case GS_LOG_INSTALLER_UPDATE      : $array="gs_announce"; break;
				default                           : $array=""; break;
			}
			
			if ($array != "")
				$data[$array][$log["itemid"]] = [];
				
			$data["users"][$log["userid"]] = [];
		}

		// Build SQL query
		foreach(array_keys($data) as $array) {
			$script_list_id = [];
			
			switch($array) {
				case "gs_mods_links"   : 
				case "gs_mods_updates" : $script_list_id=array_keys($data["gs_mods_scripts"]); break;
			}
			
			if (!empty($data[$array]) || !empty($script_list_id)) {
				$sql = "SELECT id";
				$columns = "";
				
				// Table columns to select
				switch($array) {
					case "users"           : $columns=["username"]; break;
					case "gs_serv"         : $columns=["name","message","uniqueid","access","removed"]; break;
					case "gs_serv_times"   : $columns=["serverid","starttime","duration","type","timezone"]; break;
					case "gs_serv_mods"    : $columns=["serverid","modid"]; break;
					case "gs_serv_admins"  : $columns=["serverid","userid"]; break;
					case "gs_mods"         : $columns=["name","description","access","uniqueid","removed"]; break;
					case "gs_mods_scripts" : $columns=["size"]; break;
					case "gs_mods_updates" : $columns=["modid","scriptid","version","changelog"]; break;
					case "gs_mods_links"   : $columns=["updateid","scriptid","fromver"]; break;
					case "gs_mods_admins"  : $columns=["modid","userid"]; break;
					case "gs_announce"     : $columns=["text"]; break;
				}
				
				foreach($columns as $column)
					$sql .= ",$array.$column";
					
				$sql .= " FROM $array WHERE ";
				
				if (!empty($data[$array]))
					$sql .= "$array.id in (". substr( str_repeat(",?",count($data[$array])), 1) . ") OR ";
				
				if (!empty($script_list_id))
					$sql .= "$array.scriptid in (". substr( str_repeat(",?",count($script_list_id)), 1) . ") OR ";
				
				$sql = substr($sql, 0, strlen($sql)-3);

				$db->query($sql, array_merge(array_keys($data[$array]),$script_list_id));

				foreach($db->results(true) as $row) {
					$data[$array][$row["id"]] = $row;
					
					switch($array) {
						case "gs_serv_times"   : $data["gs_serv"][$row["serverid"]]=[]; break;
						case "gs_serv_mods"    : $data["gs_serv"][$row["serverid"]]=[]; $data["gs_mods"][$row["modid"]]=[]; break;
						case "gs_serv_admins"  : $data["gs_serv"][$row["serverid"]]=[]; $data["users"][$row["userid"]]=[]; break;
						case "gs_mods_admins"  : $data["gs_mods"][$row["modid"]]=[]; $data["users"][$row["userid"]]=[]; break;
						case "gs_mods_updates" : $data["gs_mods"][$row["modid"]]=[]; $data["gs_mods_scripts"][$row["scriptid"]]=[]; break;
						case "gs_mods_links"   : $data["gs_mods_updates"][$row["updateid"]]=[]; $data["gs_mods_scripts"][$row["scriptid"]]=[]; break;
					}
				}
			}
		}

		$operation_names = [
			GS_LOG_SERVER_ADDED          => "GS_STR_LOG_SERVER_ADDED",
			GS_LOG_SERVER_UPDATED        => "GS_STR_LOG_SERVER_UPDATED",
			GS_LOG_SERVER_EVENT_REMOVED  => "GS_STR_LOG_SERVER_EVENT_REMOVED",
			GS_LOG_SERVER_EVENT_UPDATE   => "GS_STR_LOG_SERVER_EVENT_UPDATE",
			GS_LOG_SERVER_EVENT_ADDED    => "GS_STR_LOG_SERVER_EVENT_ADDED",
			GS_LOG_SERVER_MOD_REMOVED    => "GS_STR_LOG_SERVER_MOD_REMOVED",
			GS_LOG_SERVER_MOD_ADDED      => "GS_STR_LOG_SERVER_MOD_ADDED",
			GS_LOG_SERVER_REVOKE_ACCESS  => "GS_STR_LOG_SERVER_REVOKE_ACCESS",
			GS_LOG_MOD_REVOKE_ACCESS     => "GS_STR_LOG_MOD_REVOKE_ACCESS",
			GS_LOG_SERVER_SHARE_ACCESS   => "GS_STR_LOG_SERVER_SHARE_ACCESS",
			GS_LOG_MOD_SHARE_ACCESS      => "GS_STR_LOG_MOD_SHARE_ACCESS",
			GS_LOG_SERVER_TRANSFER_ADMIN => "GS_STR_LOG_SERVER_TRANSFER_ADMIN",
			GS_LOG_MOD_TRANSFER_ADMIN    => "GS_STR_LOG_MOD_TRANSFER_ADMIN",
			GS_LOG_SERVER_DELETE         => "GS_STR_LOG_SERVER_DELETE",
			GS_LOG_MOD_DELETE            => "GS_STR_LOG_MOD_DELETE",
			GS_LOG_MOD_ADDED             => "GS_STR_LOG_MOD_ADDED",
			GS_LOG_MOD_UPDATED           => "GS_STR_LOG_MOD_UPDATED",
			GS_LOG_MOD_SCRIPT_UPDATED    => "GS_STR_LOG_MOD_SCRIPT_UPDATED",
			GS_LOG_MOD_SCRIPT_ADDED      => "GS_STR_LOG_MOD_SCRIPT_ADDED",
			GS_LOG_MOD_VERSION_ADDED     => "GS_STR_LOG_MOD_VERSION_ADDED",
			GS_LOG_MOD_VERSION_UPDATED   => "GS_STR_LOG_MOD_VERSION_UPDATED",
			GS_LOG_MOD_LINK_ADDED        => "GS_STR_LOG_MOD_LINK_ADDED",
			GS_LOG_MOD_LINK_UPDATED      => "GS_STR_LOG_MOD_LINK_UPDATED",
			GS_LOG_MOD_LINK_DELETED      => "GS_STR_LOG_MOD_LINK_DELETED",
			GS_LOG_SERVER_MOD_CHANGED    => "GS_STR_LOG_SERVER_MOD_CHANGED",
			GS_LOG_INSTALLER_UPDATE      => "GS_STR_LOG_INSTALLER_UPDATED"
		];

		// Second pass - format data from the log
		foreach ($logs as $log) {
			$table_row            = [];
			$table_row["id"]      = $log["id"];
			$table_row["date"]    = strtotime($log["added"]);
			$table_row["user"]    = $data["users"][$log["userid"]]["username"];
			$table_row["typenum"] = $log["type"];
			
			$server_private = false;
			$mod_private    = false;
			$valid_row      = true;
			$server_id      = null;
			$mod_id         = null;
			$user_id        = null;
			$event          = null;
			$server_name    = "";
			$playtime_text  = "";
			$mod_name       = "";
			$user_name      = "";
			$versions       = [];
			$conditions     = [];
			$lang_arguments = [$table_row["user"]];
			
			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED       : 
				case GS_LOG_SERVER_UPDATED     :
				case GS_LOG_SERVER_DELETE      : $server_id = $log["itemid"]; break;
				
				case GS_LOG_SERVER_EVENT_REMOVED :
				case GS_LOG_SERVER_EVENT_UPDATE  :
				case GS_LOG_SERVER_EVENT_ADDED   : {
					$event           = $data["gs_serv_times"][$log["itemid"]];
					$type            = $event["type"];
					$server_id       = $event["serverid"];
					$time_zone       = new DateTimeZone($event["timezone"]);
					$start_date      = new DateTime($event["starttime"], $time_zone);
					$playtime_text   = "";
					$playtime_format = "jS F H:i";
					
					switch($type) {
						case "1" : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC".$start_date->format("w"))." "; $playtime_format="H:i"; break;
						case "2" : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC")." "; $playtime_format="H:i"; break;
					}
					
					$end_date       = clone $start_date;
					$end_date->modify("+{$event["duration"]} minute");
					$playtime_text .= $start_date->format($playtime_format) . $end_date->format(" - H:i");
				} break;
				
				case GS_LOG_SERVER_MOD_CHANGED : 
				case GS_LOG_SERVER_MOD_REMOVED :
				case GS_LOG_SERVER_MOD_ADDED   : {
					$serv_mod   = $data["gs_serv_mods"][$log["itemid"]];
					$mod_id     = $serv_mod["modid"];
					$server_id  = $serv_mod["serverid"];
				} break;
				
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : {
					$admin     = $data["gs_serv_admins"][$log["itemid"]];
					$server_id = $admin["serverid"];
					$user_id   = $admin["userid"];
				} break;
				
				case GS_LOG_MOD_REVOKE_ACCESS  :
				case GS_LOG_MOD_SHARE_ACCESS   :
				case GS_LOG_MOD_TRANSFER_ADMIN : {
					$admin     = $data["gs_mods_admins"][$log["itemid"]];
					$mod_id    = $admin["modid"];
					$user_id   = $admin["userid"];
				} break;
				
				case GS_LOG_MOD_ADDED   : 
				case GS_LOG_MOD_UPDATED : 
				case GS_LOG_MOD_DELETE  : $mod_id = $log["itemid"]; break;
				
				case GS_LOG_MOD_SCRIPT_ADDED   : 
				case GS_LOG_MOD_SCRIPT_UPDATED : {
					$script_id = $log["itemid"];
					$updates   = [];

					foreach($data["gs_mods_links"] as $link)
						if ($link["scriptid"] == $script_id) {
							$conditions[] = $link["fromver"];
							$updates[]    = $link["updateid"];
						}

					foreach($data["gs_mods_updates"] as $update)
						if ($update["scriptid"] == $script_id || in_array($update["id"],$updates)) {
							$versions[] = $update["version"];
							$mod_id     = $update["modid"];
						}
				} break;
				
				case GS_LOG_MOD_VERSION_ADDED   : 
				case GS_LOG_MOD_VERSION_UPDATED : {
					$update_id  = $log["itemid"];
					$update     = $data["gs_mods_updates"][$update_id];
					$versions[] = $update["version"];
					$mod_id     = $update["modid"];
					$table_row["mod_changelog"] = $update["changelog"];
				} break;
				
				case GS_LOG_MOD_LINK_ADDED   :
				case GS_LOG_MOD_LINK_DELETED :
				case GS_LOG_MOD_LINK_UPDATED : {
					$link_id      = $log["itemid"];
					$link         = $data["gs_mods_links"][$link_id];
					$conditions[] = $link["fromver"];
					$update       = $data["gs_mods_updates"][$link["updateid"]];
					$versions[]   = $update["version"];
					$mod_id       = $update["modid"];
				} break;
				
				case GS_LOG_INSTALLER_UPDATE : {
					$version_number              = $data["gs_announce"][$log["itemid"]]["text"];
					$lang_arguments              = ["<a href=\"install_scripts#changelog$version_number\">", "</a>", $version_number];
					$table_row["installversion"] = $version_number;
				} break;
			}
			
			if (isset($server_id)) {
				$server         = $data["gs_serv"][$server_id];
				$server_name    = ($server["name"]!="" ? $server["name"] : $server["uniqueid"]);
				$server_private = $server["access"]!="" && array_search($server["access"],$input["password"])===FALSE;
				
				$table_row["server_id"]   = $server["uniqueid"];
				$table_row["server_name"] = $server_name;
				$table_row["message"]     = $mod["message"];
				
				if ($log["type"] == GS_LOG_SERVER_DELETE && $server["removed"]!=1)
					$valid_row = false;
			}
			
			if (isset($mod_id)) {
				$mod         = $data["gs_mods"][$mod_id];
				$mod_name    = $mod["name"];
				$mod_private = $mod["access"]!="" && array_search($mod["access"],$input["password"])===FALSE;
				
				$table_row["mod_id"]   = $mod["uniqueid"];
				$table_row["mod_name"] = $mod_name;
				$table_row["mod_desc"] = $mod["description"];
				
				if ($log["type"] == GS_LOG_MOD_DELETE && $mod["removed"]!=1)
					$valid_row = false;
			}
			
			if (isset($user_id))
				$user_name = $data["users"][$user_id]["username"];

			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED       : 
				case GS_LOG_SERVER_UPDATED     :
				case GS_LOG_SERVER_DELETE      : {
					if (isset($server_id)) 
						$lang_arguments[] = $server_name;
					else
						$valid_row = false;
				} break;

				case GS_LOG_SERVER_EVENT_REMOVED :
				case GS_LOG_SERVER_EVENT_UPDATE  :
				case GS_LOG_SERVER_EVENT_ADDED   : {
					if (isset($server_id) && isset($event)) {
						$lang_arguments[] = $playtime_text;
						$lang_arguments[] = $server_name;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_SERVER_MOD_CHANGED : 
				case GS_LOG_SERVER_MOD_REMOVED :
				case GS_LOG_SERVER_MOD_ADDED   : {
					if (isset($server_id) && isset($mod_id)) {
						$lang_arguments[] = $mod_name;
						$lang_arguments[] = $server_name;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : {
					if (isset($server_id) && isset($user_id)) {
						$lang_arguments[] = $server_name;	
						$lang_arguments[] = $user_name;	
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_REVOKE_ACCESS  :
				case GS_LOG_MOD_SHARE_ACCESS   :
				case GS_LOG_MOD_TRANSFER_ADMIN : {
					if (isset($mod_id) && isset($user_id)) {
						$lang_arguments[] = $mod_name;	
						$lang_arguments[] = $user_name;	
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_ADDED   : 
				case GS_LOG_MOD_UPDATED : 
				case GS_LOG_MOD_DELETE  : {
					if (isset($mod_id))
						$lang_arguments[] = $mod_name;
					else
						$valid_row = false;
				} break;
					
				case GS_LOG_MOD_SCRIPT_ADDED   : 
				case GS_LOG_MOD_SCRIPT_UPDATED : {
					if (isset($mod_id)) {
						$str = $mod_name;
						
						if (!empty($versions))
							$str .= " " . mb_strtolower(lang("GS_STR_SERVER_VERSION")) . " " . max($versions);
						
						if (!empty($conditions))
							$str .= " " . $condtions[0];
						
						$lang_arguments[] = $str;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_VERSION_ADDED   : 
				case GS_LOG_MOD_VERSION_UPDATED : {
					if (isset($mod_id)) {
						$table_row["mod_version"] = max($versions);
						$lang_arguments[]         = $mod_name;
						$lang_arguments[]         = max($versions);
					} else 
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_LINK_ADDED   :
				case GS_LOG_MOD_LINK_DELETED :
				case GS_LOG_MOD_LINK_UPDATED : {
					if (isset($mod_id))
						$lang_arguments[] = "$mod_name - {$condtions[0]} ".lang("GS_STR_MOD_TO")." $versions";
					else 
						$valid_row = false;
				} break;
			}
			
			$operation_name = $operation_names[$log["type"]];
			
			if ($detailed_server_mod_change) {
				if (in_array($log["type"],[GS_LOG_SERVER_MOD_REMOVED,GS_LOG_SERVER_MOD_ADDED])) {
					$operation_name = "GS_STR_LOG_SERVER_MOD_CHANGED";
					unset($table_row["mod_name"]);
					
					if ($last_id >= 0 && $last_id==$server_id)
						$valid_row = false;
					else
						$last_id = $server_id;
				} else
					$last_id = -1;
			}
			
			if (isset($input["mod"]) && !empty($input["mod"]) && (isset($mod_id) && !in_array($mod["uniqueid"],$input["mod"]) || !isset($mod_id)))
				$valid_row = false;
			
			if (isset($input["server"]) && !empty($input["server"]) && (isset($server_id) && !in_array($server["uniqueid"],$input["server"]) || !isset($server_id)))
				$valid_row = false;

			$table_row["description"] = lang($operation_name, $lang_arguments);
                

			// Check record privacy before adding to the list
			if (
				$show_private ||
				$valid_row && (
					(!$server_private && !$mod_private) || 
					(isset($server_id) && !$server_private && $mod_private)
				)
			)
				$output[] = $table_row;
			
			if (count($output) >= $limit)
				break;
		}
	}

	return $output;
}

// Translate with plural form
function GS_lang($string_name, $number_array, $bold=0) {
	if (substr($string_name, 0, 7) != "GS_STR_")
		return $string_name;
	
	global $lang;
	$string = $lang[$string_name];
	$number = $number_array[0];
	
	if (strpos($string,"%m1%") === false)
		return $string;
	
	$current = $lang["THIS_CODE"];
	$string  = str_replace("%m1%",$number,$string);
	$ending  = "";
	
	if ($current == "en-US")
		$ending = $number!=1 ? "s" : "";

	if ($current == "ru-RU") {
		$words = explode(" ", str_replace("%m2%","",$string));
		$word  = count($words)>1 ? mb_strtolower($words[count($words)-1]) : "";
		$type  = "feminine";
		
		$ru_words = [
			"neuter"    => ["событ"],
			"masculine" => ["мод","пользовател","сервер"],
			"feminine"  => []
		];
		
		$endings = [
			"neuter"     => [
				"1"      => ["ие","ий"],
				"234"    => ["ия","ий"],
				"567890" => ["ий"]
			],
			"masculine"  => [
				"1"      => ["",""],
				"234"    => ["а","а"],
				"567890" => ["ов"]
			],
			"feminine"  => [
				"1"      => ["",""],
				"234"    => ["",""],
				"567890" => [""]
			],
		];
		
		foreach($ru_words as $current_type=>$list)
			if (in_array($word,$list))
				$type = $current_type;

		switch(substr($number,-1)) {
			case 1 : if ($number==1 || $number>20) $ending.=$endings[$type]["1"][0]; else $ending.=$endings[$type]["1"][1]; break;
			case 2 : 
			case 3 : 
			case 4 : if ($number<10 || $number>20) $ending.=$endings[$type]["234"][0]; else $ending.=$endings[$type]["234"][1]; break;
			case 5 : 
			case 6 : 
			case 7 : 
			case 8 : 
			case 9 : 
			case 0 : $ending.=$endings[$type]["567890"][0]; break;
		}
	}
	
	if ($current == "pl-PL") {
		$words = explode(" ", str_replace("%m2%","",$string));
		$word  = count($words)>1 ? mb_strtolower($words[count($words)-1]) : "";
		$type  = "feminine";
		
		$pl_words = [
			"neuter"     => [""],
			"masculine"  => ["mod","serwer"],
			"masculine2" => ["użytkownik"],
			"masculine3" => ["inn"],
			"feminine"   => ["ses"]
		];
		
		$endings = [
			"neuter"     => [
				"1"      => ["",""],
				"234"    => ["",""],
				"567890" => [""]
			],
			"masculine"  => [
				"1"      => ["","ów"],
				"234"    => ["y","ów"],
				"567890" => ["ów"]
			],
			"masculine2" => [
				"1"      => ["a","ów"],
				"234"    => ["ów","ów"],
				"567890" => ["ów"]
			],
			"masculine3" => [
				"1"      => ["y","ych"],
				"234"    => ["e","ych"],
				"567890" => ["ych"]
			],
			"feminine"  => [
				"1"      => ["ję","ji"],
				"234"    => ["je","ji"],
				"567890" => ["ji"]
			],
		];
		
		foreach($pl_words as $current_type=>$list)
			if (in_array($word,$list))
				$type = $current_type;

		switch(substr($number,-1)) {
			case 1 : if ($number==1) $ending.=$endings[$type]["1"][0]; else $ending.=$endings[$type]["1"][1]; break;
			case 2 : 
			case 3 : 
			case 4 : if ($number<10 || $number>20) $ending.=$endings[$type]["234"][0]; else $ending.=$endings[$type]["234"][1]; break;
			case 5 : 
			case 6 : 
			case 7 : 
			case 8 : 
			case 9 : 
			case 0 : $ending.=$endings[$type]["567890"][0]; break;
		}
	}
	
	if ($bold)
		$ending = "<b>$ending</b>";
	
	return str_replace("%m2%",$ending,$string);
}

// Convert Unicode characters to the Windows code page
function GS_convert_utf8_to_windows($input, $language="Windows") {
	if (mb_strlen($input) == strlen($input))
		return $input;

	$unicode = [
		#Cyrillic
		"а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я",
		"А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я",
		#Polish
		"ą","ć","ę","ł","ń","ó","ś","ź","ż",
		"Ą","Ć","Ę","Ł","Ń","Ó","Ś","Ź","Ż"
	];
		
	$windows = [
		"English" => [
			#Cyrillic phonetically
			"a","b","v","g","d","ye","yo","zh","z","i","y","k","l","m","n","o","p","r","s","t","u","f","h","ts","ch","sh","shsh","","i","","e","yu","ya",
			"A","B","V","G","D","YE","YO","ZH","Z","I","Y","K","L","M","N","O","P","R","S","T","U","F","H","TS","CH","SH","SHSH","","I","","E","YU","YA",
			#Polish without diacritics
			"a","c","e","l","n","o","s","z","z",
			"A","C","E","L","N","O","S","z","z"
		],
		
		"Russian" => [
			#Cyrillic in Windows-1251
			"\xE0","\xE1","\xE2","\xE3","\xE4","\xE5","\xB8","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB","\xEC","\xED","\xEE","\xEF","\xF0","\xF1","\xF2","\xF3","\xF4","\xF5","\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC","\xFD","\xFE","\xFF",
			"\xC0","\xC1","\xC2","\xC3","\xC4","\xC5","\xA8","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB","\xCC","\xCD","\xCE","\xCF","\xD0","\xD1","\xD2","\xD3","\xD4","\xD5","\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC","\xDD","\xDE","\xDF", 
			#Polish without diacritics
			"a","c","e","l","n","o","s","z","z",
			"A","C","E","L","N","O","S","z","z"
		],

		"Polish" => [
			#Cyrillic phonetically
			"a","b","w","g","d","ie","io","\xBF","z","i","ij","k","l","m","n","o","p","r","s","t","u","f","h","c","\xE6","sz","si","","y","","e","ju","ja",
			"A","B","W","G","D","IE","IO","\xAF","Z","I","ij","K","L","M","N","O","P","R","S","T","U","F","H","C","\xC6","sz","si","","y","","E","JU","JA",
			#Polish in Windows-1250
			"\xB9","\xE6","\xEA","\xB3","\xF1","\xF3","\x9C","\x9F","\xBF",
			"\xA5","\xC6","\xCA","\xA3","\xD1","\xD3","\x8C","\x8F","\xAF"
		],
		
		"Windows" => [
			"\xE0","\xE1","\xE2","\xE3","\xE4","\xE5","\xB8","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB","\xEC","\xED","\xEE","\xEF","\xF0","\xF1","\xF2","\xF3","\xF4","\xF5","\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC","\xFD","\xFE","\xFF",
			"\xC0","\xC1","\xC2","\xC3","\xC4","\xC5","\xA8","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB","\xCC","\xCD","\xCE","\xCF","\xD0","\xD1","\xD2","\xD3","\xD4","\xD5","\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC","\xDD","\xDE","\xDF", 
			"\xB9","\xE6","\xEA","\xB3","\xF1","\xF3","\x9C","\x9F","\xBF",
			"\xA5","\xC6","\xCA","\xA3","\xD1","\xD3","\x8C","\x8F","\xAF"
		]
	];
	
	
	$output = "";
	$length = mb_strlen($input, 'UTF-8');
	
	for ($i=0; $i<$length; $i++) {
		$letter = mb_substr($input, $i, 1, 'UTF-8');
		
		if (mb_strlen($letter) != strlen($letter)) {
			$index   = array_search($letter, $unicode);			
			$output .= $index!==false ? $windows[$language][$index] : "";
		} else
			$output .= $letter;
	}

	return $output;
}

// Code highlighting for addon installer scripting language
function GS_scripting_highlighting($code) {
	$all_commands = [
		"auto_install"    => "auto_installation",
		"download"        => "get",
		"get"             => "get",
		"unpack"          => "unpack",
		"extract"         => "unpack",
		"move"            => "move",
		"copy"            => "move",
		"makedir"         => "makedir",
		"newfolder"       => "makedir",
		"ask_run"         => "ask_run",
		"ask_execute"     => "ask_run",
		"begin_mod"       => "",
		"delete"          => "delete",
		"remove"          => "delete",
		"rename"          => "rename",
		"ask_download"    => "ask_get",
		"ask_get"         => "ask_get",
		"if_version"      => "if_version",
		"else"            => "if_version",
		"endif"           => "if_version",
		"makepbo"         => "makepbo",
		"extractpbo"      => "unpbo",
		"unpackpbo"       => "unpbo",
		"unpbo"           => "unpbo",
		"edit"            => "edit",
		"begin_ver"       => "",
		"alias"           => "alias",
		"merge_with"      => "alias",
		"filedate"        => "filedate",
		"install_version" => "",
		"exit"            => "exit",
		"quit"            => "exit"
	];
	$command_switches_names = [
		"/password:",
		"/no_overwrite",
		"/match_dir",
		"/keep_source",
		"/insert",
		"/newfile",
		"/append",
		"/match_dir_only"
	];
	$word_begin            = -1;
	$word_count            = 1;
	$arg_count             = 1;
	$word_line_num         = 1;
	$command_id            = -1;
	$last_command_line_num = -1;
	$last_url_list_id      = -1;
	$in_quote              = false;
	$remove_quotes         = true;
	$url_block             = false;
	$url_line              = false;
	$instruction_id        = [];
	$instruction_line      = [];
	$instruction_arg       = [];
	$instruction_arg_id    = [];
	$url_list              = [];
	$url_list_id           = [];
	$output                = "";
	$is_url                = function ($text) {return substr($text,0,7)=="http://" || substr($text,0,8)=="https://" || substr($text,0,6)=="ftp://" || substr($text,0,4)=="www.";};
	
	for($i=0; $i<=strlen($code); $i++) {
		$end_of_word = $i==strlen($code) || ctype_space($code[$i]);
		
		// When quote
		if ($code[$i]=="\""  ||  substr($code,$i,6)=="&quot;")
			$in_quote = !$in_quote;
		
		// If beginning of an url block
		if ($code[$i]=="{"  &&  $word_begin<0) {
			$url_block = true;
	
			// if bracket is the first thing in the line then it's auto installation
			if ($word_count == 1) {
				$last_command_line_num = $word_line_num;
				$instruction_id[]      = 0;
				$instruction_line[]    = $word_line_num;
			}
			
			$output .= "{";
			continue;
		}
		
		// If ending of an url block
		if ($code[$i]=="}"  &&  $url_block) {
			$end_of_word = true;
			
			// If there's space between last word and the closing bracket
			if ($word_begin == -1) {	
				$url_block = false;
				$url_line  = false;
				$word_count++;
				$output .= "}";
				continue;
			}
		}
		
		// Remember beginning of the word
		if (!$end_of_word  &&  $word_begin<0) {
			$word_begin = $i;
			
			// If custom delimeter - jump to the end of the argument
			if (substr($code,$i,2)==">>"  ||  substr($code,$i,8)=="&gt;&gt;") {
				$offset        = substr($code,$i,2) == ">>" ? 2 : 8;
				$separator     = $code[$i + $offset];
				$end           = strpos($code, $separator, $i+$offset+1);
				$end_of_word   = true;
				$i             = $end===false ? count($code)-1 : $end+1;
				$remove_quotes = false;
			}
		}

		// When hit end of the word
		if ($end_of_word  &&  $word_begin>=0  &&  !$in_quote) {
			$word = substr($code, $word_begin, $i-$word_begin);
				
			// If first word in the line
			if ($word_count==1  &&  !$url_block) {
				$command_id = -1;
				$arg_count  = 1;
				
				// Check if it's a valid command
				if ($is_url($word))
					$command_id = 0;
				else {
					$command_names = array_keys($all_commands);
					
					for ($j=0; $j<count($command_names) && $command_id==-1; $j++)
						if (strcasecmp($word, $command_names[$j]) == 0)
							$command_id = $j;
				}

				// If so then add it to database, otherwise skip this line
				if ($command_id != -1) {
					$last_command_line_num = $word_line_num;
					$instruction_id[]      = $command_id;
					$instruction_line[]    = $word_line_num;
					
					// If command is an URL then add it to the url database
					if ($is_url($word)) {
						$url_line         = true;
						$last_url_list_id = count($url_list_id);
						$url_list[]       = $word;
						$url_list_id[]    = $last_command_line_num;
						$output          .= "<a class=\"scripting_command_url\" href=\"$word\" target=\"_blank\">$word</a>";
					} else
						$output .= "<a class=\"scripting_command\" href=\"install_scripts#{$all_commands[array_keys($all_commands)[$command_id]]}\" target=\"_blank\">$word</a>";
				} else {
					$end     = strpos($code,"\n", $i);
					$i       = ($end===false ? strlen($code) : $end);
					$word    = substr($code, $word_begin, $i-$word_begin);
					$output .= "<span class=\"scripting_command_comment\">$word</span>";
				}
			} else {
				// Check if URL starts here
				if (!$url_line  &&  $command_id!=15)
					$url_line = $is_url($word);
				
				// Check if it's a valid command switch
				$is_switch   = false;
				$colon       = strrpos($word, ":");
				$switch_name = $colon!==FALSE ? substr($word,0,$colon+1) : $word;
				
				for ($j=0; $j<count($command_switches_names) && !$is_switch; $j++)
					$is_switch = strcasecmp($switch_name, $command_switches_names[$j]) == 0;

				// Add word to the URL database or the arguments database
				if (!$is_switch && $url_line) {
					if ($last_url_list_id == -1) {
						$last_url_list_id = count($url_list_id);
						$url_list[]       = $word;
						$url_list_id[]    = $last_command_line_num;
						$output          .= "<a class=\"scripting_command_url\" href=\"$word\" target=\"_blank\">$word</a>";
					} else {
						$url_list[$last_url_list_id] .= " " . $word;
						$output                      .= $word;
					}
				} else {
					$instruction_arg[]    = $word;
					$instruction_arg_id[] = $last_command_line_num;
					
					if ($is_switch)
						$output .= "<span class=\"scripting_command_switch\">$word</span>";
					else
						$output .= "<span class=\"scripting_command_arg".($arg_count++)."\">$word</span>";
				}
			}
			
			// If ending of an url block
			if ($code[$i]=="}"  &&  $url_block) {
				$url_block = false;
				$url_line  = false;
			}

			$word_begin = -1;
			$word_count++;
		}

		// When new line			
		if (!$in_quote  &&  $code[$i]=="\n") {
			$arg_count        = 1;
			$word_count       = 1;
			$url_line         = false;
			$last_url_list_id = -1;
			$word_line_num++;
		}

		if ($i < strlen($code) && $word_begin==-1)
			$output .= $code[$i];
	}
	
	return $output;
}

function GS_url_get_contents($url, $timeout=NULL) {
    if (!function_exists('curl_init'))
        die('CURL is not installed!');

    $request = curl_init();
	curl_setopt($request, CURLOPT_URL, $url);
	curl_setopt($request, CURLOPT_HEADER, 0);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	
	if (isset($timeout))
		curl_setopt($request, CURLOPT_TIMEOUT, $timeout);
	
    $output = curl_exec($request);
    curl_close($request);
    return $output;
}
?>