<?php
require_once "header.php";

// Modal for displaying server list from the master
echo '
<div class="modal fade" id="server_list_modal" tabindex="-1" role="dialog" aria-labelledby="server_list_modal_label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="server_list_modal_label">'.lang("GS_STR_SERVER_MASTER_LIST").'</h4>
			</div>
			
			<div class="modal-body">
				<p>'.lang("GS_STR_SERVER_MASTER_5MIN").'</p>
				<p id="master_server_modal_loader"></p>
				<ul id="server_list_content">
				</ul>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">'.lang("GEN_CLOSE").'</button>
			</div>
		</div>
	</div>
</div>
<script>
	var master_server = {list:[], location:[], address:[]};
</script>';


// If user wants to add new server or edit existing
if (in_array($form->hidden["display_form"], ["Add New","Edit"]))
{
	// Compile voip software list
	$voice_links_combined = "";
	foreach(GS_VOICE as $program_name=>$program_info)
		$voice_links_combined .= "<a href='{$program_info["info"]}' target='_blank'>$program_name</a>, ";
	$voice_links_combined = substr($voice_links_combined, 0, -2) . ". " . lang("GS_STR_SERVER_VOICE_HINT");
	
	if ($form->hidden["display_form"] == "Edit")
		$form->title=lang("GS_STR_SERVER_PAGE_TITLE", ["<strong>$record_title</strong>"]);
	else
		$form->title=lang("GS_STR_INDEX_ADDNEW_SERVER");
		
	$master_list = '<a data-toggle="modal" data-target="#server_list_modal" onclick="GS_get_server_list(master_server, \'server_list_content\');">'.lang("GS_STR_SERVER_PICK_IP").'</a>';
	$form->add_text("ip", lang("GS_STR_SERVER_ADDRESS"), lang("GS_STR_SERVER_ADDRESS_HINT")."<p>$master_list</p>", "192.168.1.101:2302");
	
	// Auto configuration
	$form->include_file("usersc/js/gs_functions.js");
	$form->add_html("
	<div class=\"form-group\" style=\"margin-left:35px;margin-right:35px;\">
		<div id=\"gs_drop_zone\" class=\"gs_drop_zone\" ondrop=\"GS_drop_handler(event, this);\" ondragover=\"GS_drag_over_handler(event, this, 1);\" ondragleave=\"GS_drag_over_handler(event, this, 0);\">
			<p>".lang("GS_STR_SERVER_DRAGDROP")."</p>
			<label class=\"gs_drop_zone_upload\">
				<input style=\"display:none\" type=\"file\" multiple=\"multiple\" onchange=\"GS_read_server_config(this, [['hostname','name'], ['password','password'], ['equalModRequired','equalmodreq'], ['MaxCustomFileSize','maxcustomfilesize'], ['motd[]','message']])\">
				".lang("GS_STR_SERVER_SELECT_FILES")."
			</label>
		</div>
	</div>");
	
	$form->add_text("name"             , lang("GS_STR_SERVER_NAME")         , lang("GS_STR_SERVER_NAME_HINT")      , lang("GS_STR_SERVER_NAME_EXAMPLE"));
	$form->add_text("password"         , lang("GS_STR_SERVER_PASSWORD")     , lang("GS_STR_SERVER_PASSWORD_HINT")  , "123", "", 0, "");
	$form->add_select("persistent"     , lang("GS_STR_SERVER_PERSISTENT")   , lang("GS_STR_SERVER_PERSISTENT_HINT"), [[lang("GS_STR_MOD_MPCOMP_YES"),0], [lang("GS_STR_SERVER_PERSISTENT_OFF"),1]]);
	$form->add_text("access"           , lang("GS_STR_SERVER_ACCESSCODE")   , lang("GS_STR_SERVER_ACCESSCODE_HINT"), "", "", 0, "");
	$form->add_select("version"        , lang("GS_STR_SERVER_VERSION")      , lang("GS_STR_SERVER_VERSION_HINT")   , GS_GAME_VERSIONS, "1.99");
	$form->add_select("equalmodreq"    , lang("GS_STR_SERVER_EQUALMODS")    , lang("GS_STR_SERVER_EQUALMODS_HINT") , [[lang("GS_STR_DISABLED"),0], [lang("GS_STR_ENABLED"),1]]);	
	$form->add_text("maxcustomfilesize", lang("GS_STR_SERVER_CUSTOMFILE")   , lang("GS_STR_SERVER_CUSTOMFILE_HINT"), "102400");
	$form->add_text("languages"        , lang("GS_STR_SERVER_LANGUAGES")    , lang("GS_STR_SERVER_LANGUAGES_HINT") , "English, Polski");
	$form->add_text("location"         , lang("GS_STR_SERVER_LOCATION")     , lang("GS_STR_SERVER_LOCATION_HINT")  , "Poland");
	$form->add_text("message"          , lang("GS_STR_SERVER_MESSAGE")      , lang("GS_STR_SERVER_MESSAGE_HINT")   , lang("GS_STR_SERVER_MESSAGE_EXAMPLE"), "", 3);
	$form->add_text("website"          , lang("GS_STR_SERVER_WEBSITE")      , lang("GS_STR_SERVER_WEBSITE_HINT")   , GS_get_current_url(true, false));
	$form->add_text("voice"            , lang("GS_STR_SERVER_VOICE_ADDRESS"), $voice_links_combined                , "ts3server://192.168.1.101?password=123");
	$form->add_imagefile("logo"        , lang("GS_STR_SERVER_LOGO")         , lang("GS_STR_SERVER_LOGO_HINT")      , GS_LOGO_FOLDER, 10240*2.5);
	
	// Trigger info download on IP change
	$form->change_control("location", ["Group"=>"id=\"location_group\""]);
	$form->change_control("ip", ["Property"=>"onchange=\"GS_get_server_status('ip')\""]);
	
	
	// If user submitted form
	if (in_array($form->hidden["action"], ["Edit","Add New"])) {
		$data = &$form->save_input();
		
		$data["website"] = filter_var($data["website"], FILTER_SANITIZE_URL);
		$data["access"]  = preg_replace("/[^A-Za-z0-9 ]/", '', $data["access"]);
		
		if (substr($data["voice"],0,30) == "https://discordapp.com/invite/")
			$data["voice"] = "https://discord.gg/".substr($data["voice"],30);
		
		// Validate user input				
		$form->init_validation     (["max"=>GS_MAX_TXT_INPUT_LENGTH]);
		$form->add_validation_rules(["ip"]                             , ["required"=>true]);
		$form->add_validation_rules(["message","voice"]                , ["max"=>GS_MAX_MSG_INPUT_LENGTH]);	
		$form->add_validation_rules(["access"]                         , ["max"=>GS_MAX_CODE_INPUT_LENGTH]);	
		$form->add_validation_rules(["version", "Custom"]              , ["is_num"=>true]);
		$form->add_validation_rules(["equalmodreq","maxcustomfilesize"], ["is_int"=>true]);

		$custom_errors = [];
		if (!empty($data["website"])  &&  !filter_var($data["website"], FILTER_VALIDATE_URL))
			$custom_errors[] = [lang("GS_STR_SERVER_URL_ERROR"), "website"];
		
		$voice_found = false;
		foreach(GS_VOICE as $program_name=>$program_info)
			if (substr($data["voice"],0,strlen($program_info["url"])) == $program_info["url"])
				$voice_found = true;
			
		if (!$voice_found && $date["voice"]!="")
			$custom_errors[] = [lang("GS_STR_SERVER_VOICE_ERROR"), "voice"];


		// Send data to the table
		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA"))) {
			$form->upload_image();
			
			$data["modified"]   = date("Y-m-d H:i:s");
			$data["modifiedby"] = $uid;
			
			if ($data["maxcustomfilesize"] > 102400)
				$data["maxcustomfilesize"] = 102400;
			
			if ($form->hidden["action"] == "Add New") {
				$data["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$data["createdby"] = $uid;
			}
								
			$data["id"] = $id;
			$result     = $db->insert("gs_serv", $data, true);
			
			$form->keep_image($result);
			$form->feedback(
				$result, 
				lang($form->hidden["action"]=="Add New" ? "GS_STR_SERVER_ADDED"       : "GS_STR_SERVER_UPDATED"),
				lang($form->hidden["action"]=="Add New" ? "GS_STR_SERVER_ADDED_ERROR" : "GS_STR_SERVER_UPDATED_ERROR")
			);
			
			if ($result) {
				$form->hidden["display_name"] = $data["name"]!="" ? $data["name"] : $data["ip"];
				$form->title                  = lang("GS_STR_SERVER_PAGE_TITLE", ["<strong>$record_title</strong>"]);
				
				if ($form->hidden["action"] == "Add New") {
					$id = $db->lastId();
					$db->insert("gs_serv_admins", ["serverid"=>$id, "userid"=>$uid, "isowner"=>1]);
				}
				
				$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>($form->hidden["action"]=="Add New" ? GS_LOG_SERVER_ADDED : GS_LOG_SERVER_UPDATED), "added"=>date("Y-m-d H:i:s")]);
				
				// Update logo hash
				$db->update("gs_serv", $id, ["logohash"=>empty($data["logo"]) ? "" : hash_file('crc32', $form->image_dir.$data["logo"])]);
				
				if ($form->hidden["action"] == "Add New")
					Redirect::to("edit_server.php?uniqueid={$data["uniqueid"]}&display_form=Edit");
			}
		}
	} else
		// If no submit then load data for the selected server
		if ($form->hidden["display_form"] == "Edit")
			if (!$form->load_record("gs_serv", $id)) {
				if ($gs_my_permission_level == GS_PERM_ADMIN)
					echo $sql . $db->errorString();
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
			}
		
	$form->add_button("action", $form->hidden["display_form"], lang($form->hidden["display_form"]=="Edit" ? "GS_STR_SERVER_SUBMIT" : "GS_STR_INDEX_ADDNEW_SERVER"), "btn-primary btn-lg");
}	










// If user wants to add/remove playing times
if ($form->hidden["display_form"] == "Schedule") 
{
	$form->title = lang("GS_STR_SERVER_EVENT_PAGE_TITLE", ["<strong>$record_title</strong>"]);
	$form->size  = 9;
	
	// If user wants to remove entries
	if ($form->hidden["action"] == "Cancel") {
		$schedulelist = Input::get("schedulelist");
		
		if (is_array($schedulelist)) {
			$id_list = GS_uniqueid_to_id("gs_serv_times", $schedulelist);
			
			if (!empty($id_list)) {				
				$result = $form->feedback(
					$db->update("gs_serv_times", ["id","IN",$id_list], ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]), 
					"GS_STR_SERVER_EVENT_REMOVED", 
					"GS_STR_SERVER_EVENT_REMOVED_ERROR",
					"GS_lang"
				);
				
				if ($result)
					foreach($id_list as $item_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$item_id, "type"=>GS_LOG_SERVER_EVENT_REMOVED, "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		} else
			$form->alert(lang("GS_STR_SERVER_EVENT_NONE_ERROR"));
	}
	
	$persistent = $db->cell("gs_serv.persistent",["id","=",$id]);
	
	// Query to get all records
	$sql = "
		SELECT 
			gs_serv_times.uniqueid, 
			gs_serv_times.type, 
			gs_serv_times.starttime, 
			gs_serv_times.timezone, 
			gs_serv_times.duration, 
			gs_serv_times.breakstart,
			gs_serv_times.breakend,
			users.username 
			
		FROM 
			gs_serv_times, 
			users 
			
		WHERE 
			gs_serv_times.serverid = ? AND 
			gs_serv_times.userid   = users.id AND
			gs_serv_times.removed  = 0
			
		ORDER BY 
			gs_serv_times.starttime
	";
	
	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$schedule     = $db->results(true);
	$events_count = $db->count();
	
	
	
	

		
	// Set up form
	$user_time_zone   = $user->data()->timezone;
	$tosave_time_zone = $user_time_zone;
	
	// Code for timezone list taken from UserSpice5
	$timezone_select_list = [];
	$regions = [
		'Africa'     => DateTimeZone::AFRICA,
		'America'    => DateTimeZone::AMERICA,
		'Antarctica' => DateTimeZone::ANTARCTICA,
		'Asia'       => DateTimeZone::ASIA,
		'Atlantic'   => DateTimeZone::ATLANTIC,
		'Australia'  => DateTimeZone::AUSTRALIA,
		'Europe'     => DateTimeZone::EUROPE,
		'Indian'     => DateTimeZone::INDIAN,
		'Pacific'    => DateTimeZone::PACIFIC
	];

	foreach ($regions as $region_name=>$mask) {
		$timezone_select_list[] = [$region_name,0,"optgroup"];
		
		foreach(DateTimeZone::listIdentifiers($mask) as $timezone) {
			$time                   = new DateTime(NULL, new DateTimeZone($timezone));
			$timezone_select_list[] = [substr($timezone, strlen($region_name) + 1) . ' - ' . $time->format('H:i'),$timezone];
		}
	}


	$form->include_file("usersc/js/gs_functions.js");

	if ($form->hidden["action"] == "persistent") {
		$new_persistent = Input::get('persistent');
	
		if (in_array($new_persistent,["0","1"]) && $new_persistent != $persistent) {
			$result = $db->update("gs_serv", $id, ["persistent"=>$new_persistent]);
			
			if ($result) {
				$persistent = $new_persistent;
			} else {
				if (!$result && $gs_my_permission_level == GS_PERM_ADMIN)
					echo $sql . $db->errorString();
			}
			
		}
	}
	
	$form->title .= " &nbsp; <a style='font-size:70%;float:right' onclick=\"GS_schedule_toggle('{$form->id}','$persistent')\">" . ($persistent ? lang("GEN_ENABLE") : lang("GEN_DISABLE")) . "</a>";
	
	if (!$persistent) {
		$form->add_datetime("starttime" , lang("GS_STR_SERVER_EVENT_DATE"));
		$form->add_select("timezone"    , lang("GS_STR_SERVER_EVENT_TIMEZONE"), "", $timezone_select_list, $user_time_zone);
		$form->add_select("type"        , lang("GS_STR_SERVER_EVENT_REPEAT")  , "", [[lang("GS_STR_SERVER_EVENT_REPEAT_SINGLE"),GS_EVENT_SINGLE], [lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY"),GS_EVENT_WEEKLY], [lang("GS_STR_SERVER_EVENT_REPEAT_DAILY"),GS_EVENT_DAILY]], 0);
		$form->add_text("duration"      , lang("GS_STR_SERVER_EVENT_LENGTH")  , lang("GS_STR_SERVER_EVENT_MINUTES"), "60", 60);
		$form->add_datetime("breakstart", lang("GS_STR_SERVER_EVENT_BREAKSTART"), date('Y-m-d',strtotime("-1 days")), "jS F (l) Y", "Y-m-d");
		$form->add_datetime("breakend"  , lang("GS_STR_SERVER_EVENT_BREAKEND"), date('Y-m-d',strtotime("-1 days")), "jS F (l) Y", "Y-m-d");	
		$form->add_button("action"      , $form->hidden["display_form"]       , lang("GS_STR_SERVER_EVENT_SUBMIT"), "btn-primary",  "SubmitButton");
		$form->add_button("action"      , "Edit"                              , lang("GS_STR_SERVER_EVENT_EDIT"), "btn-info", "EditButton", "STYLE=\"display:none\"");
		$form->add_space();
		$form->add_select("schedulelist", lang("GS_STR_SERVER_EVENT_CURRENT") , "", [], "", GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]);
	
		$form->change_control(["ID"=>["SubmitButton","EditButton"]], ["Inline"=>3]);
		$form->change_control("breakstart", ["Group"=>"id=\"breakstart_group\""]);
		$form->change_control("breakend", ["Group"=>"id=\"breakend_group\""]);
		$form->change_control("type", ["Property"=>"onChange=\"GS_show_vacation_controls('type', ['breakstart_group','breakend_group'])\""]);
	}

	// Save new entry
	if (in_array($form->hidden["action"],["Edit","Schedule"])) {
		if ($events_count < GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]) {
			$data = &$form->save_input();
			
			if ($data["duration"] > 1440)
				$data["duration"] = 1440;

			$form->init_validation(["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], ["schedulelist"]);
			$form->add_validation_rules(["duration"] , [">"=>0, "is_int"=>true]);
			$form->add_validation_rules(["type"]     , [">="=>0, "<="=>2]);
			$form->add_validation_rules(["timezone"] , ["is_timezone"=>true]);
			$form->add_validation_rules(["starttime"], ["is_datetime"=>true]);
			
			if ($form->validate([], lang("GS_STR_ERROR_FORMDATA"))) {
				$data["starttime"] = substr_replace($data["starttime"],"00",-2);	//zero seconds
				
				$playing_time = [
					"serverid"   => $id,
					"userid"     => $uid,
					"type"       => $data["type"],
					"starttime"  => $data["starttime"],
					"breakstart" => $data["breakstart"],
					"breakend"   => $data["breakend"],
					"timezone"   => $data["timezone"],
					"duration"   => $data["duration"],
					"modified"   => date("Y-m-d H:i:s"),
					"modifiedby" => $uid
				];

				if ($form->hidden["action"] == "Edit") {
					if (count($data["schedulelist"]) == 1) {
						$id_list = GS_uniqueid_to_id("gs_serv_times", $data["schedulelist"]);
						
						if (!empty($id_list)) {
							$result = $form->feedback(
								$db->update("gs_serv_times", $id_list[0], $playing_time),
								lang("GS_STR_SERVER_EVENT_UPDATE"),
								lang("GS_STR_SERVER_EVENT_UPDATE_ERROR")
							);
							
							if ($result) {
								$tosave_time_zone = $data["timezone"];
								$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id_list[0], "type"=>GS_LOG_SERVER_EVENT_UPDATE, "added"=>date("Y-m-d H:i:s")]);
							}
						} else 
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
					} else
						$form->alert(lang("GS_STR_SERVER_EVENT_MULTI_ERROR"));
						
					$data = [];
				}

				if ($form->hidden["action"] == "Schedule") {
					$playing_time["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
					$playing_time["created"]   = date("Y-m-d H:i:s");
					$playing_time["createdby"] = $uid;
					
					$result = $form->feedback(
						$db->insert("gs_serv_times", $playing_time),
						lang("GS_STR_SERVER_EVENT_ADDED"),
						lang("GS_STR_SERVER_EVENT_ADDED_ERROR")
					);
					
					if ($result) {
						$tosave_time_zone = $data["timezone"];
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_SERVER_EVENT_ADDED, "added"=>date("Y-m-d H:i:s")]);
					}
				}
				
				// Save user's timezone	
				if (in_array($form->hidden["action"], ["Schedule","Edit"])  &&  isset($tosave_time_zone)  &&  $tosave_time_zone!=$user_time_zone)
					$db->update("users", $uid, ["timezone"=>$tosave_time_zone]);
				
				// Reload schedule				
				if ($db->query($sql,[$id])->error())
					$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
				
				$schedule     = $db->results(true);
				$events_count = $db->count();
			}
		} else
			$form->alert(lang("GS_STR_SERVER_EVENT_MAX_ERROR"));
	}
	
	if (!$persistent) {
		// If schedule is full after insertion then remove controls to add new playing time
		if ($events_count >= GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]) {
			$form->controls[] = [];
			$form->add_heading(lang("GS_STR_SERVER_EVENT_MAX_ERROR"));
		}
		
		// Display list of playing times to remove
		if ($events_count > 0) {
			$schedule_select   = [];
			$js_curr_schedule  = ["name"=>"Current_Schedule", "data"=>[]];
			$js_new_array      = "New_Schedule";
			$description_field = "SelectOptionDetails";
			$localized_strings = [
				"Now"     => lang("GS_STR_SERVER_EVENT_NOW"),
				"Expired" => lang("GS_STR_SERVER_EVENT_EXPIRED"),
			];

			// Make a list of options for select
			foreach ($schedule as $item) {
				$start_date = new DateTime($item["starttime"], new DateTimeZone($item["timezone"]));
				$start_day  = $start_date->format("Y.m.d");
				$start_hour = $start_date->format("H:i");
				$iso8601    = $start_date->format('c');
				$for_js     = $start_date->format("jS F (l) Y H:i");
				
				$start_date->add(new DateInterval('PT' . $item["duration"] . 'M'));
				$end_hour   = $start_date->format("H:i");
				
				$typename = lang(["GS_STR_SERVER_EVENT_REPEAT_SINGLE", "GS_STR_SERVER_EVENT_REPEAT_WEEKLY", "GS_STR_SERVER_EVENT_REPEAT_DAILY"][$item["type"]]);
				
				$description       = "$start_day &nbsp;&nbsp; $start_hour - $end_hour &nbsp;&nbsp; $type {$item["username"]} {$item["timezone"]}";
				$schedule_select[] = [$description, $item["uniqueid"]];
				$user_info         = lang("GS_STR_ADDED_BY")." {$item["username"]}";
				
				$js_curr_schedule["data"][] = [
					"type"       => $item["type"], 
					"typename"   => $typename,
					"starttime"  => $iso8601, 
					"duration"   => $item["duration"], 
					"uniqueid"   => $item["uniqueid"],
					"timezone"   => $item["timezone"], 
					"user"       => $user_info,
					"breakstart" => $item["breakstart"],
					"breakend"   => $item["breakend"]
				];
			}

			$vacation_js = "GS_show_vacation_controls('type', ['breakstart_group','breakend_group'])";

			$form->change_control("schedulelist", [
				"Options"=>$schedule_select, 
				"Property"=>"onChange=\"
					GS_display_info_when_selected(this,'{$form->hidden["display_form"]}',$js_new_array,'$description_field'); 
					GS_make_event_editable(this,$js_new_array,['starttime_input','timezone','type','duration','breakstart_input','breakend_input'],'EditButton');
					$vacation_js\""
			]);
			$form->add_button("action", "Cancel", lang("GS_STR_SERVER_EVENT_REMOVE"), "btn-warning");
			$form->add_emptyspan($description_field);
			$form->include_file("usersc/js/ru.js");
			$form->add_html("
				<script type=\"text/javascript\">
					var {$js_curr_schedule["name"]} = ".json_encode($js_curr_schedule["data"])."
					var $js_new_array = GS_format_event_list({$js_curr_schedule["name"]},'schedulelist',".json_encode($localized_strings).",".json_encode(["GS_EVENT_SINGLE"=>GS_EVENT_SINGLE,"GS_EVENT_WEEKLY"=>GS_EVENT_WEEKLY,"GS_EVENT_DAILY"=>GS_EVENT_DAILY]).");
					$vacation_js
				</script>");
		} else
			$form->remove_controls_until(["Name"=>"action"]);
	}
}















// If user wants to add/remove mods to the server
if ($form->hidden["display_form"] == "Mods")
{
	$form->title = lang("GS_STR_SERVER_MOD_PAGE_TITLE", ["<strong>$record_title</strong>"]);
	
	// If user wants to remove entries
	if ($form->hidden["action"] == "Discard") {
		$modlist = Input::get("modlist");

		// Build a delete query and run it
		if (is_array($modlist)) {
			$id_list = GS_uniqueid_to_id("gs_serv_mods", $modlist);
			
			if (!empty($id_list)) {
				$result = $form->feedback(
					$db->update("gs_serv_mods", ["id","IN",$id_list], ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]), 
					"GS_STR_SERVER_MOD_REMOVED",
					"GS_STR_SERVER_MOD_REMOVED_ERROR",
					"GS_lang"
				);
				
				if ($result)
					foreach($id_list as $item_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$item_id, "type"=>GS_LOG_SERVER_MOD_REMOVED, "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		} else
			$form->alert(lang("GS_STR_SERVER_MOD_NOSEL_ERROR"));
	}

	$server_version = $db->cell("gs_serv.version",["id","=",$id]);

	// Get all records
	$sql_allmods = "
		SELECT 
			gs_mods.id, 
			gs_mods.uniqueid,
			gs_mods.name, 
			gs_mods.description, 
			gs_mods.removed,
			gs_mods.access,
			gs_mods.type,
			gs_mods.req_version,
			gs_mods.createdby,
			users.username AS addedby,
			gs_serv_mods.id AS gs_serv_mods_id,
			gs_serv_mods.removed AS gs_serv_mods_removed,
			gs_serv_mods.serverid, 
			gs_serv_mods.modified,
			gs_serv_mods.modifiedby,
			gs_serv_mods.loadorder,
			gs_mods_admins.isowner,
			gs_mods_admins.right_edit,
			gs_mods_admins.right_update
			
		FROM 
			gs_mods LEFT JOIN gs_serv_mods 
				ON gs_mods.id            = gs_serv_mods.modid AND 
				   gs_serv_mods.serverid = ?
				   
				LEFT JOIN gs_mods_admins 
					ON gs_mods.id            = gs_mods_admins.modid AND 
					   gs_mods_admins.userid = ?
					   
				LEFT JOIN users
					ON gs_mods.createdby = users.id
					   
		WHERE
			gs_mods.req_version <= $server_version AND
			gs_mods.is_mp = 1 AND 
			gs_mods.removed = 0 AND (
				gs_mods.access              = '' OR 
				gs_serv_mods.serverid       = ? OR 
				gs_mods_admins.isowner      = 1 OR 
				gs_mods_admins.right_edit   = 1 OR 
				gs_mods_admins.right_update = 1
			)
					   
		ORDER BY 
			gs_mods.name
	";

	if ($db->query($sql_allmods,[$id,$uid,$id])->error()) {
		if ($gs_my_permission_level == GS_PERM_ADMIN)
			echo $sql . $db->errorString();
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
	}
	
	$modfolders    = $db->results(true);
	$modfolders_id = [];
	
	foreach ($modfolders as $key=>$value)
		$modfolders_id[] = $value["id"];
	
	

	
	// Save new entry
	if ($form->hidden["action"] == "Assign") {
		$reload        = false;
		$mod_to_assign = Input::get("mod_to_assign");
		
		if ($mod_to_assign == "")
			$mod_to_assign = [];
		
		// Limit records
		if (count($mod_to_assign) > GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level]) {
			$mod_to_assign = array_splice($mod_to_assign, 0, GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level]);
			$form->alert(lang("GS_STR_SERVER_MOD_MAX_ERROR"));
		}
		
		// Clear all existing
		$result = $db->update("gs_serv_mods", ["serverid"=>$id], ["removed"=>1]);
		
		if ($result && count($mod_to_assign)>0) {
			// Build an insert query
			$fields = [
				"modid"      => [],
				"serverid"   => [],
				"modified"   => [],
				"modifiedby" => [],
				"loadorder"  => []
			];
			
			$selected_modfolders = GS_uniqueid_to_id("gs_mods", $mod_to_assign);
			
			foreach ($selected_modfolders as $loadorder=>$mod_id) {
				$record_id = NULL;
				
				$index = array_search($mod_id, $modfolders_id);
				if ($index !== FALSE)
					$record_id = $modfolders[$index]["gs_serv_mods_id"];
				
				$fields["id"][]         = $record_id;
				$fields["modid"][]      = $mod_id;
				$fields["serverid"][]   = $id;
				$fields["modified"][]   = date("Y-m-d H:i:s");
				$fields["modifiedby"][] = $uid;
				$fields["removed"][]    = 0;
				$fields["loadorder"][]  = $loadorder;
			}

			$result = $form->feedback(
				$db->insert("gs_serv_mods", $fields, true), 
				"GS_STR_SERVER_MOD_UPDATED",
				"GS_STR_SERVER_MOD_ADDED_ERROR",
				"GS_lang"
			);
			
			if ($result) {
				$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_SERVER_MOD_CHANGED, "added"=>date("Y-m-d H:i:s")]);
				$reload = true;
			}
		} else
			$reload = $form->feedback($result, "GS_STR_SERVER_MOD_CLEAR", "GS_STR_SERVER_MOD_REMOVED_ERROR", "GS_lang");
		
		// Get all records again
		if ($reload) {
			if ($db->query($sql_allmods,[$id,$uid,$id])->error())
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

			$modfolders    = $db->results(true);
			$modfolders_id = [];
			
			foreach ($modfolders as $key=>$value)
				$modfolders_id[] = $value["id"];
		}
	}






	// Sort query results into different lists
	$mod_labels       = [];
	$added_labels     = [];
	$mods_to_add      = [];
	$mods_to_rem      = [];
	$mods_to_rem_sort = [];

	for ($i=0; $i<4; $i++)
		$mod_labels[] = lang("GS_STR_MOD_TYPE{$i}");

	foreach ($mod_labels as $label)
		$mods_to_add[$label] = [];

	foreach ($modfolders as $key=>$value)
		if (!isset($value["serverid"]) || $value["gs_serv_mods_removed"]==1) {
			$label                 = lang("GS_STR_MOD_TYPE{$value["type"]}");
			$mods_to_add[$label][] = $key;
			$added_labels[$label]  = true;
		} else {
			$mods_to_rem[]      = $key;
			$mods_to_rem_sort[] = $value["loadorder"];
		}
		

		
		
	$form->size           = 12;
	$form->label_size     = 2;
	$form->input_size     = 10;
	$html                 = "";
	$Parsedown            = new Parsedown();
	$currentmods_table_id = "current_mods";
	$mod_parameter_field  = "Mod_Startup_Parameter";
		
	// Display list of mods that can be removed
	array_multisort($mods_to_rem_sort, SORT_ASC, $mods_to_rem);
	
	$mods_select       = [];
	$js_mods_list      = ["name"=>"Remove_Mods_List", "data"=>[]];
	$description_field = "ModToRemoveDetails";
	
	$html .= "
	<table id=\"$currentmods_table_id\" class=\"table table-mods-striped table-bordered table-hover\">
		<tr>
			<th>".lang("GS_STR_MOD")."</th>
			<th>".lang("GS_STR_MOD_DESCRIPTION")."</th>
			<th>".ucfirst(lang("GS_STR_ADDED_BY"))."</th>
			<th>".lang("GS_STR_MOD_PREVIEW_INST")."</th>
			<th style=\"width:135px;\"></th>
		</tr>
		";
			
	foreach ($mods_to_rem as $i) {
		if (!isset($modfolders[$i]["name"]) || !isset($modfolders[$i]["uniqueid"]))
			continue;
		
		$html .= "
		<tr id=\"{$modfolders[$i]["uniqueid"]}\">
			<td><b>{$modfolders[$i]["name"]}</b></td>
			<td>". $Parsedown->line($modfolders[$i]["description"]) ."</td>
			<td>{$modfolders[$i]["addedby"]}</td>
			<td><a target='_blank' href=\"show.php?mod={$modfolders[$i]["uniqueid"]}\">{$modfolders[$i]["uniqueid"]}</a><input type=\"hidden\" name=\"mod_to_assign[]\" value=\"{$modfolders[$i]["uniqueid"]}\" /></td>
			<td>
				<button onclick=\"GS_table_rows_swap('up','{$modfolders[$i]["uniqueid"]}','$mod_parameter_field')\" type='button' class=\"btn btn-mods btn-xs\"><span class=\"fa fa-fw fa-arrow-up\"></span></button>
				<button onclick=\"GS_table_rows_swap('down','{$modfolders[$i]["uniqueid"]}','$mod_parameter_field')\" type='button' class=\"btn btn-mods btn-xs\"><span class=\"fa fa-fw fa-arrow-down\"></span></button>
				<button onclick=\"GS_table_row_transfer('$currentmods_table_id','mod_table_{$modfolders[$i]["type"]}','{$modfolders[$i]["uniqueid"]}','$mod_parameter_field',".GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level].",'".lang("GS_STR_SERVER_MOD_FULL")."')\" type='button' class=\"btn btn-warning btn-xs\">".lang("GS_STR_SERVER_MOD_DISCARD")."</button>
			</td>
		</tr>
		";
	}
	
	$html .= "</table>";
	
	$form->add_heading(lang("GS_STR_SERVER_MOD_CURRENT"));
	$form->add_html($html);
	$form->add_emptyspan($mod_parameter_field);
	$form->add_html("<SCRIPT TYPE=\"text/javascript\">GS_mod_parameter_update('$currentmods_table_id','$mod_parameter_field')</SCRIPT>");
	$form->add_button("action", "Assign", lang("GS_STR_SERVER_MOD_SUBMIT"), "btn-mods");
	$form->add_space(2);





	// Display form with a list of mods that can be added	
	if (!empty($added_labels)) {
		$html = "";
		$js_table_list = ["name"=>"Mod_Tables_List", "data"=>[]];
		
		foreach ($mod_labels as $key=>$label) {
			$label_description = "";
			
			for ($i=0; $i<4; $i++)
				if ($label == lang("GS_STR_MOD_TYPE{$i}"))
					$label_description = ucfirst(lang("GS_STR_MOD_TYPE{$i}_DESC"));
			
			$section_name            = "mod_div_$key";
			$table_name              = "mod_table_$key";
			$js_table_list["data"][] = $section_name;
			
			$html .= "
			<div id=\"$section_name\" ".($key!=0 ? "style=\"display:none\"" : "").">
			<h4>$label_description</h4>
			<table id=\"$table_name\" class=\"table table-mods-striped table-bordered table-hover\">
				<tr>
					<th>".lang("GS_STR_MOD")."</th>
					<th>".lang("GS_STR_MOD_DESCRIPTION")."</th>
					<th>".ucfirst(lang("GS_STR_ADDED_BY"))."</th>
					<th>".lang("GS_STR_MOD_PREVIEW_INST")."</th>
					<th></th>
				</tr>
				";

			foreach ($mods_to_add[$label] as $i) {
				if (!isset($modfolders[$i]["name"]) || !isset($modfolders[$i]["uniqueid"]))
					continue;
				
				$html .= "
				<tr id=\"{$modfolders[$i]["uniqueid"]}\">
					<td><b>{$modfolders[$i]["name"]}</b></td>
					<td>". $Parsedown->line($modfolders[$i]["description"]) ."</td>
					<td>{$modfolders[$i]["addedby"]}</td>
					<td><a target='_blank' href=\"show.php?mod={$modfolders[$i]["uniqueid"]}\">{$modfolders[$i]["uniqueid"]}</a></td>
					<td><button onclick=\"GS_table_row_transfer('$table_name','$currentmods_table_id','{$modfolders[$i]["uniqueid"]}','$mod_parameter_field',".GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level].",'".lang("GS_STR_SERVER_MOD_FULL")."')\" type=\"button\" class=\"btn btn-mods btn-xs\">".lang("GS_STR_SERVER_MOD_ASSIGN")."</button></td>
				</tr>
				";
			}
			
			$html .= "</table></div>";
		}
		
		$form->include_file("usersc/js/gs_functions.js");
		$form->add_js_var(["name"=>"Mod_Button_Strings", "data"=>[lang("GS_STR_SERVER_MOD_ASSIGN"), lang("GS_STR_SERVER_MOD_DISCARD")]]);
		$form->add_js_var($js_table_list);
		
		$form->add_heading(lang("GS_STR_SERVER_MOD_AVAILABLE"));
		$form->add_select("modtype", lang("GS_STR_MOD_TYPE"), "", $mod_labels, "", 0, "onChange=\"GS_display_mod_types_table(this,{$js_table_list["name"]})\"");
		$form->add_space(1);
		$form->add_html($html);
	} else 
		$form->add_heading(lang("GS_STR_SERVER_MOD_NOTHING"), lang("GS_STR_SERVER_MOD_AVAILABLE"));
}














// If user wants to grant/revoke access for others
if ($form->hidden["display_form"] == "Share")
	GS_record_sharing($record_title, $record_type, $record_table, $record_column, $form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner);

// If user wants to delete server
if ($form->hidden["display_form"] == "Delete") 
	GS_record_delete($record_title, $record_type, $record_table, $form, $id, $uid);

require_once "footer.php";
?>