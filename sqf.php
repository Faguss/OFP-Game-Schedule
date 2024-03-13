<?php
require_once "minimal_init.php";
require_once "common.php";

class igsedb {
	const SIGNATURE = 0x626465736769;
	const VERSION   = 1;
	public $keys    = [];
	public $values  = [];
	
	// Add data to the database
	function add($key,$value) {
		$this->keys[]   = $key;
		$this->values[] = $value;
	}
	
	// Output database
	function generate($last_modified, $mods_simple_array) {
		$voice = "";
		foreach (GS_VOICE as $program_name=>$program_info)
			$voice .= "]+[[\"{$program_name}\"," . (in_array($program_name,["Discord","Steam"]) ? "true" : "false") . ",\"{$program_info["download"]}\"]";
		
		$this->add("general", "GS_FWATCH_LAST_UPDATE=" . GS_FWATCH_LAST_UPDATE . ";GS_VERSION=" . GS_VERSION . ";GS_VOICE=[$voice];GS_MODS_TO_VERIFY=[$mods_simple_array];");
		$this->add("timestamp", "_last_modified=\"".file_get_contents("mods_timestamp.txt")."\";");
		
		// Create hashes and sort them
		$hashes = [];
		foreach($this->keys as $key)
			$hashes[] = hexdec(hash("fnv1a32", $key));

		array_multisort($hashes, $this->keys, $this->values);

		// Create pointers to key and data
		$pointer_keys = [16 + count($this->keys)*12];
		
		for ($i=1; $i<count($this->keys); $i++)
			$pointer_keys[$i] = $pointer_keys[$i-1] + strlen($this->keys[$i-1])+1;

		$pointer_values = [$pointer_keys[count($pointer_keys)-1] + strlen($this->keys[count($pointer_keys)-1])+1];
		
		for ($i=1; $i<count($this->values); $i++)
			$pointer_values[$i] = $pointer_values[$i-1] + strlen($this->values[$i-1])+1;

		// Write header
		$output = pack("P", self::SIGNATURE) . pack("V", self::VERSION) . pack("V", count($this->keys));

		// Write data
		foreach($hashes as $hash)
			$output .= pack("V", $hash);
			
		foreach($pointer_keys as $ptr)
			$output .= pack("V", $ptr);
			
		foreach($pointer_values as $ptr)
			$output .= pack("V", $ptr);
			
		foreach($this->keys as $key)
			$output .= $key . pack("c", 0);
			
		foreach($this->values as $value)
			$output .= $value . pack("c", 0);
			
		return $output;
	}
}

$input      = GS_get_common_input();
$input_mode = isset($_GET['mode']) ? $_GET['mode'] : "schedule";
$db         = DB::getInstance();
$output     = "";

if (!$db)
	die("false");

switch($input["language"]) {
	case "Polish"  : include("usersc/lang/pl-PL.php"); break;
	case "Russian" : include("usersc/lang/ru-RU.php"); break;
}

switch($input_mode) {
	case "schedule_v2_last_modified" : {
		break;
	}
	
	// Return server information
	case "schedule_v2" : {
		$servers = GS_list_servers($input["server"], $input["password"], GS_REQTYPE_GAME, GS_fwatch_date_to_timestamp(GS_FWATCH_LAST_UPDATE), $input["language"], NULL, $input["timeoffset"]);
		$mods    = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_GAME, $servers["lastmodified"]);
		$database          = new igsedb();
		$mods_simple_array = "";
		
		// Prepare server data
		foreach($servers["info"] as $id=>$server) {
			$server_info = "";
			
			// Format server properties
			foreach($server as $key=>$value) {
				$new_value = $value;
				$add_value = $value != "";

				switch ($key) {
					case "uniqueid" : 
					case "website"  :
					case "message"  : 
					case "location" : 
					case "name"     : {
						$new_value = "\"".GS_convert_utf8_to_windows($value, $language)."\""; 
						break;
					}
					
					case "equalmodreq" : $new_value=$value=="1" ? "true" : "false"; break;
					case "version"     : $new_value="$value"; break;
					case "logo"        : $new_value="\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$value}\""; break;
					case "logohash"    : $new_value="\"{$value}\""; break;
					
					case "maxcustomfilesize" : {
						if ($add_value)
							$server_info .= "_server_maxcustombytes=\"$value\";";
						$new_value = GS_convert_size_in_bytes($value, "game");
						break;
					}
					
					case "ip" : {
						$ip       = $value;
						$ip_parts = explode(":", $value);
						if (count($ip_parts) >= 2) {
							$ip = $ip_parts[0];
							$server_info .= "_server_port=\"".GS_encrypt($ip_parts[1], GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\";";
						}
						$new_value = "\"".GS_encrypt($ip, GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\""; 
						break;
					}
					
					case "password" : {
						$new_value = "\"".GS_encrypt($value, GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\""; 
						break;
					}
					
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
										break;
									}
									
									default : $new_value.=GS_encrypt(substr($value,strlen($program_info["url"])), GS_ENCRYPT_KEY, GS_MODULUS_KEY);
								}

								$new_value .= "\"]";;
								$add_value = true;
								break;
							}
							
							$index++;
						}
						break;
					}
					
					case "languages" : {
						$temp_array = preg_split('/[\s|\,]/', $value);
						$new_value  = "[";
						
						foreach($temp_array as $item)
							if (!empty($item))
								$new_value .= "]+[\"".trim($item)."\"";
							
						$new_value .= "]";
						break;
					}
					
					default : $add_value=false;
				}
					
				if ($add_value)
					$server_info .= "_server_{$key}={$new_value};";
			}

			if (GS_ENCRYPT_KEY==0 ||  GS_MODULUS_KEY==0)
				$server_info .= "_server_encrypted=false;";
					
			// Add server events
			$server_info .= "_server_game_times=[";

			foreach($server["events"] as $gametime)
				$server_info .= "]+[{$gametime["description"]}";
				
			$server_info .= "];_server_game_times2=[";
			
			foreach($server["events"] as $gametime)
				$server_info .= "]+[[{$gametime["description"]},\"{$gametime["eventid"]}\",{$gametime["date_sqf"]}]";
				
			$server_info .= "];";
					
			// Add server mods
			$server_info .= "_server_modfolders=[";

			foreach($server["mods"] as $mod_key) {
				$mod                = $mods["info"][$mod_key];
				$server_info       .= "]+[[\"{$mod["uniqueid"]}\",\"{$mod["name"]}\",{$mod["version"]},{$mod["forcename"]},\"{$mod["size"]}\",{$mod["sizearray"]}]";
				$mods_simple_array .= "]+[[\"{$mod["uniqueid"]}\",\"{$mod["name"]}\",{$mod["forcename"]}]";
			}

			$server_info .= "];";
			
			// Format server status
			$status = json_decode($server["status"]);
			if (!empty($status) && !isset($status->error)) {
				$to_find_list = ["gstate", "numplayers", "gametype", "mapname"];
				$server_info .= "_server_status=[";
				
				foreach($to_find_list as $i=>$attribute) {
					if ($i != 0)
						$server_info .= ",";
					
					if ($i <= 1)
						$server_info .= $status->$attribute;
                    else
						$server_info .= "\"" . $status->$attribute . "\"";
					
					if ($i == 1)
						$servers["info"][$id]["playercount"] = $status->$attribute;
				}
				
				$server_info .= ",\"";
				
				foreach($status->players as $i=>$player) {
					if ($i != 0)
						$server_info .= "\\n";
					
					$server_info .= $player->player;
				}
				
				$server_info .= "\"]";
			}
			
			$database->add($server["uniqueid"], $server_info);
		}

		// Prepare server listbox data
		$servers_listbox                   = "";
		$servers_id_sorted_by_playing_time = "";
		$player_count                      = 0;
		
		foreach($servers["listbox"] as $category_name=>$list) {
			$servers_id_sorted_by_playing_time .= "GS_PLAYING_$category_name=[";

			if (!empty($list)) {
				$servers_listbox .= "]+[[\"$category_name\"]";

				foreach($list as $id) {
					$server      = $servers["info"][$id];
					$listbox_row = isset($servers["info"][$id]["playercount"]) ? "({$server["playercount"]}) {$server["name"]}" : $server["name"];
					
					$servers_listbox                   .= "]+[[\"$listbox_row\",\"{$server["uniqueid"]}\"]";
					$servers_id_sorted_by_playing_time .= "]+[\"{$server["uniqueid"]}\"";
					
					if (isset($servers["info"][$id]["playercount"]))
						$player_count += intval($servers["info"][$id]["playercount"]);
				}
			}
				
			$servers_id_sorted_by_playing_time .= "];";
		}

		$database->add("listbox", "GS_SERVERS=[$servers_listbox];$servers_id_sorted_by_playing_time");
		$database->add("playercount", "_player_count=$player_count;");
		$output .= $database->generate($mods["lastmodified"], $mods_simple_array);
		break;
	}
		
	// Return last modification date for mods database
	case "mods_v2_last_modified" : {
		$output .= "GS_FWATCH_LAST_UPDATE=" . GS_FWATCH_LAST_UPDATE . ";GS_VERSION=" . GS_VERSION . ";GS_LAST_MODIFIED=\"".file_get_contents("mods_timestamp.txt")."\";true";
		break;
	}
		
	// Return mod information
	case "mods_v2" : {
		$mods = GS_list_mods([], ["all"], $input["modver"], $input["password_mods"], GS_REQTYPE_GAME, 0);
		$database = new igsedb();
		
		// Get user names from user id list
		$user_list = [];
		$sql       = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($mods["userlist"])), 1) . ")";

		if (!$db->query($sql,$mods["userlist"])->error())
			foreach($db->results(true) as $row)
				$user_list[$row["id"]] = $row["username"];

		// Count duplicates
		$all_names = [];
		foreach($mods["info"] as $mod) {
			if (array_key_exists($mod["name"], $all_names))
				$all_names[$mod["name"]]++;
			else
				$all_names[$mod["name"]] = 1;
		}
				
		// Prepare mods listbox data
		$mods_simple_array          = "";
		$mods_that_user_can_update  = "";
		$mods_that_user_doesnt_have = "";
		$mods_update_count          = 0;
		
		uasort($mods["info"], 'GS_compare_names_with_trim');
		
		foreach($mods["info"] as $id=>$mod) {
			$formatted_name = $mod["name"];
			
			if (!empty($mod["subtitle"]) && $all_names[$mod["name"]] > 1)
				$formatted_name .= " ({$mod["subtitle"]})";
			
			$mods_simple_array .= "]+[[\"{$mod["uniqueid"]}\",\"$formatted_name\",{$mod["forcename"]}]";
			
			if ($mod["userver"] == 0) {
				if (empty($mods_that_user_doesnt_have))
					$mods_that_user_doesnt_have = "]+[[\"missing\"]";
				
				$mods_that_user_doesnt_have .= "]+[[\"$formatted_name\",\"{$mod["uniqueid"]}\",{$mod["type"]}]";
			} else
				if ($mod["userver"] != $mod["version"]) {
					if (empty($mods_that_user_can_update))
						$mods_that_user_can_update = "]+[[\"update\"]";
		
					$mods_that_user_can_update .= "]+[[\"$formatted_name\",\"{$mod["uniqueid"]}\",{$mod["type"]}]";
					$mods_update_count++;
				}
			
			$mod_info = "";
			
			foreach(["name","type","version","forcename","size","sizearray","is_mp","addedby","description","website","logo","logohash","req_version"] as $property) {
				$property_name  = $property;
				$property_value = $mod[$property];
				
				switch($property) {
					case "name"     : 
					case "size"     :
					case "website"  : 
					case "logohash" : $property_value="\"$property_value\""; break;
					
					case "addedby" : $property_value="\"{$user_list[$mod["createdby"]]} (".date("d.m.y",strtotime($mod["created"])).")\""; break;
					case "logo"    : $property_name="logo"; $property_value="\"".(empty($property_value) ? "" : GS_get_current_url(false).GS_LOGO_FOLDER."/$property_value")."\""; break;
					
					case "description" : $property_value=GS_convert_utf8_to_windows($property_value, $input["language"]); break;
				}
				
				$mod_info .= "_mod_$property_name=$property_value;";
			}
			
			$database->add($mod["uniqueid"], $mod_info);
		}
		
		$database->add("listbox", "GS_MODS=[$mods_that_user_can_update$mods_that_user_doesnt_have];");
		$database->add("modupdatecount", "_mod_update_count=$mods_update_count;");
		$output .= $database->generate($mods["lastmodified"], $mods_simple_array);
		break;
	}

	// Return mod installation script
	case "install" : {
		$mods    = GS_list_mods([], array_keys($input["modver"]), $input["modver"], $input["password_mods"], GS_REQTYPE_INSTALL_SCRIPT, 0);
		$output .= !empty($mods["info"]) ? "install_version ".GS_VERSION : "";
		
		foreach($mods["info"] as $id=>$mod) {
			$alias   = $mod["alias"]=="" ? "?" : $mod["alias"];
			$scripts = "begin_mod {$mod["name"]} {$mod["uniqueid"]} {$mod["forcename"]} \"$alias\"";
			
			foreach($mod["updates"] as $update) {
				// html_entity_decode was already run before so &amp;#xA9; has been converted to &#xA9;
				// If I run it again I don't get what I want even when I specify the charset so I'm converting it manually:
				$script_decoded = $update["script"];
				$index          = FALSE;
				$offset         = 0;
				
				while (($index=strpos($script_decoded, "&#x", $offset)) !== FALSE) {
					if ($script_decoded[$index+5] == ";") {
						$hex_number     = substr($script_decoded, $index+3, 2);
						$script_decoded = substr_replace($script_decoded, chr(intval($hex_number, 16)), $index, 6);
					}
					$offset = $index + 1;
				}

				$scripts .= "\nbegin_ver {$update["version"]} " . strtotime($update["date"]) . "\n$script_decoded";
			}
			
			$output .= "\n$scripts";
			
			if (isset($_SERVER['HTTP_OFPGSINSTALL'])) {
				$column_name = $mod["userver"] ? "dls_upd" : "dls_new";
				$db->query("UPDATE gs_mods SET $column_name=$column_name+1 WHERE id=$id");
			}
		}
		
		break;
	}
	
	// Return server and event information for use by scheduled gameRestart.exe launch
	case "gamerestart" : {
		define("GR_OK", 0);
		define("GR_INCORRECT_PARAM", 1);
		define("GR_SERVER_GONE", 2);
		define("GR_EVENT_GONE", 3);
		
		define("GR_TAG_STATUS", 1);
		define("GR_TAG_SERVER_VERSION", 2);
		define("GR_TAG_EVENT_DATE_START", 3);
		define("GR_TAG_EVENT_DATE_END", 4);
		define("GR_TAG_EVENT_TYPE", 5);
		define("GR_TAG_FWATCH_DATE", 6);
		define("GR_TAG_EXE_ARGUMENTS", 7);
		define("GR_TAG_MOD_INFO", 8);
		define("GR_TAG_EVENT_VACATION", 9);
		define("GR_TAG_EVENT_DATE_ORIGINAL", 10);
		define("GR_TAG_EVENT_DATE_VACATION_START", 11);
		define("GR_TAG_EVENT_DATE_VACATION_END", 12);
		
		function packString(...$strings) {
			$output = "";
			foreach ($strings as $string)
				$output .= pack("V",strlen($string)) . $string;
			return $output;
		}

		$output .= 
			"OFPGS" . pack("xxx") .
			pack("V", GR_TAG_FWATCH_DATE) . packString(GS_FWATCH_LAST_UPDATE) .
			pack("V", GR_TAG_STATUS);
		
		if (!isset($_GET["server"]) || !isset($_GET["eventid"])) {
			$output .= pack("l", GR_INCORRECT_PARAM);
			break;
		}
		
		$servers = GS_list_servers($input["server"], $input["password"], GS_REQTYPE_GAME_RESTART, GS_fwatch_date_to_timestamp(GS_FWATCH_LAST_UPDATE), $input["language"], NULL, $input["timeoffset"]);
		$mods    = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_GAME, $servers["lastmodified"]);

		if (empty($servers["info"])) {
			$output .= pack("l", GR_SERVER_GONE);
			break;
		}
		
		$server = $servers["info"][array_keys($servers["info"])[0]];
		$event  = null;
		foreach($server["events"] as $key=>$current_event) {
			if ($current_event["eventid"] == $_GET["eventid"]) {
				$event = $current_event;
				break;
			}
		}
		
		if (!isset($event)) {
			$output .= pack("l", GR_EVENT_GONE);
			break;
		}
		
		// Get exe arguments to connect to the server
		$argline  = " -serveruniqueid={$server["uniqueid"]} ";
		$modifier = GS_ENCRYPT_KEY==0 || GS_MODULUS_KEY==0 ? "" : "e";
		$ip       = $server["ip"];
		$ip_parts = explode(":", $ip);
		
		if (count($ip_parts) >= 2) {
			$ip = $ip_parts[0];
			$argline .= "-".$modifier."port=".GS_encrypt($ip_parts[1], GS_ENCRYPT_KEY, GS_MODULUS_KEY)." ";
		}
		
		$argline .= "-".$modifier."connect=".GS_encrypt($ip, GS_ENCRYPT_KEY, GS_MODULUS_KEY)." ";
		
		if (!empty($server["password"]))
			$argline .= "-".$modifier."password=".GS_encrypt($server["password"], GS_ENCRYPT_KEY, GS_MODULUS_KEY)." ";
		
		if (!empty($server["equalmodreq"]))
			$argline .= "-serverequalmodreq=true ";
		
		if (isset($server["maxcustomfilesize"]))
			$argline .= "-maxcustom={$server["maxcustomfilesize"]} ";

		if (!empty($server["voice"])) {
			$index = 0;
			foreach(GS_VOICE as $program_name=>$program_info) {
				if (substr($server["voice"],0,strlen($program_info["url"])) == $program_info["url"]) {
					$voice_url = $program_info["url"];
					
					switch ($program_name) {
						case "TeamSpeak3" : {
							$parts = [];
							parse_str(parse_url($server["voice"], PHP_URL_QUERY), $parts);
							
							if (isset($parts["password"]))
								$parts["password"] = GS_encrypt($parts["password"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);
							
							if (isset($parts["channelpassword"]))
								$parts["channelpassword"] = GS_encrypt($parts["channelpassword"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);

							$voice_url .= GS_encrypt(substr(strtok($server["voice"],"?"),strlen($program_info["url"])),GS_ENCRYPT_KEY,GS_MODULUS_KEY) . "?" . http_build_query($parts);
							break;
						}
						
						default : $voice_url.=GS_encrypt(substr($server["voice"],strlen($program_info["url"])), GS_ENCRYPT_KEY, GS_MODULUS_KEY);
					}

					$argline .= "-".$modifier."voice=$voice_url ";
				}
				
				$index++;
			}
		}
		
		$arg_mod  = "";
		$mod_info = "";
		
		foreach($server["mods"] as $mod_key) {
			$mod       = $mods["info"][$mod_key];
			$arg_mod  .= "{$mod["uniqueid"]};";
			$mod_info .= packString($mod["name"], $mod["uniqueid"], $mod["version"]) . pack("c", intval($mod["forcename"]));
		}
		
		if (!empty($arg_mod))
			$argline .= "-modid=$arg_mod ";
		
		function packDate($tag, $date) {
			return pack("Vvvvvvvvv", $tag,
				$date->format("Y"),
				$date->format("n"),
				$date->format("w"),
				$date->format("j"),
				$date->format("H"),
				$date->format("i"),
				$date->format("s"),
				0
			);
		}
			
		$output .= 
			pack("l", GR_OK) .
			pack("Vl", GR_TAG_SERVER_VERSION, array_search($server["version"], [1=>"1.96", 2=>"1.99", 3=>"2.01"])) . 
			packDate(GR_TAG_EVENT_DATE_START, $event["date"]) .
			packDate(GR_TAG_EVENT_DATE_END, $event["date_end"]) .
			pack("Vl", GR_TAG_EVENT_TYPE, $event["type"]) .
			pack("Vc", GR_TAG_EVENT_VACATION, intval($event["vacation"])) .
			pack("V" , GR_TAG_EXE_ARGUMENTS) . packString($argline) . 
			pack("VV", GR_TAG_MOD_INFO, count($mods["info"])) .
			$mod_info .
			packDate(GR_TAG_EVENT_DATE_ORIGINAL, $event["date_original"]) .
			packDate(GR_TAG_EVENT_DATE_VACATION_START, $event["date_vacation_start"]) .
			packDate(GR_TAG_EVENT_DATE_VACATION_END, $event["date_vacation_end"]);

		break;
	}
	
	// Legacy
	case "mods" : 		
	case "schedule" :
	case "lastmodified" : 
		$output .= "GS_FWATCH_LAST_UPDATE=". GS_FWATCH_LAST_UPDATE . ";SCHEDULE_LAST_UPDATE=GS_FWATCH_LAST_UPDATE;GS_VERSION=" . GS_VERSION . "; GS_LAST_MODIFIED=\"0\";true";
		break;
}

echo $output;
?>