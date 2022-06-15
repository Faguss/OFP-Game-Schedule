<?php
require_once 'users/init.php';
require_once "common.php";

// Create a language list where English=>en-US
$languages = [];
foreach(GS_LANGUAGES["game"] as $index=>$language_name)
	$languages[$language_name] = GS_LANGUAGES["file"][$index];



// Verify input
$input = [
	"area"            => "",
	"language"        => "",
	"stringtable_key" => "",
	"text_new"        => ""
];

$valid_data = 0;

foreach(array_keys($input) as $key)
	if (isset($_GET[$key])) {
		$input[$key] = $_GET[$key];
		$valid_data++;
	}

if ($valid_data != count($input) || !isset($languages[$input["language"]]))
	die("[Invalid input]");

if (!isset($user) || !$user->isLoggedIn())
	die("[Login required]");



// Find user's language permissions
$permissions = [];

forEach($languages as $language_name=>$language_key)
	$permissions[$language_key] = false;

$db  = DB::getInstance();
$sql = "
	SELECT 
		permissions.name
		
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
	die(lang("GS_STR_ERROR_GET_DB_RECORD"));
}

forEach($db->results(true) as $row)
	forEach($languages as $language_name=>$language_key)
		if (strcasecmp($row["name"], "{$language_name}_translator") == 0)
			$permissions[$language_key] = true;

if (!$permissions[$languages[$input["language"]]])
	die("[No permission]");



// Find which file is going to be edited
$file_name    = null;
$to_find_list = [];
$add_tab      = false;

switch($input["area"]) {
	case "website" : 
		$file_name    = "usersc//lang//" . $languages[$input["language"]] . ".php"; 
		$to_find_list = ["\"{$input["stringtable_key"]}\" => "]; 
		$add_tab      = true;
		break;
		
	case "website_quickstart" : 
		$file_name    = "quickstart.php";
		$to_find_list = ["if (\$lang[\"THIS_CODE\"] == \"{$languages[$input["language"]]}\")", "\"{$input["stringtable_key"]}\" => "]; 
		$add_tab      = true;
		break;
		
	case "website_modupdates" : 
		$file_name    = "modupdates.php";
		$to_find_list = ["if (\$lang[\"THIS_CODE\"] == \"{$languages[$input["language"]]}\")", "\"{$input["stringtable_key"]}\" => "]; 
		$add_tab      = true;
		break;
		
	case "website_dedicated" : 
		$file_name    = "installdedicated.php";
		$to_find_list = ["if (\$lang[\"THIS_CODE\"] == \"{$languages[$input["language"]]}\")", "\"{$input["stringtable_key"]}\" => "]; 
		$add_tab      = true;
		break;
		
	case "website_api" : 
		$file_name    = "api_documentation.php";
		$to_find_list = ["if (\$lang[\"THIS_CODE\"] == \"{$languages[$input["language"]]}\")", "\"{$input["stringtable_key"]}\" => "]; 
		$add_tab      = true;
		break;
		
	case "mainmenu" : 
		$file_name    = "translation_strings.php"; 
		$to_find_list = ["\${$input["area"]} = [", "\"{$languages[$input["language"]]}\" => [", "{$input["stringtable_key"]} => "]; 
		break;
		
	case "addoninstaller" : 
		$file_name    = "translation_strings.php"; 
		$to_find_list = ["\${$input["area"]} = [", "\"{$languages[$input["language"]]}\" => [", "\"{$input["stringtable_key"]}\" => "]; 
		break;
}

if (!isset($file_name))
	die("[Invalid area]");



// Parse file
$file = fopen($file_name, 'r');

if (!$file)
	die("[Failed to open file]");

$replaced    = false;
$contents    = "";
$first       = true;
$to_find_pos = 0;

while (!feof($file)) {
	$line = fgets($file);
	
	// To get to the wanted line find each item in the $to_find_list
	if ($to_find_pos < count($to_find_list)) {
		$to_find = $to_find_list[$to_find_pos];
		
		if (stristr($line,$to_find)) {
			$pos = strpos($line, $to_find);
			if ($pos !== false) {
				$to_find_pos++;
				
				// Replace text if found the final item
				if ($to_find_pos == count($to_find_list)) {
					$start = strpos($line,"\"", $pos+strlen($to_find));
					
					if ($start !== false) {
						$start++;
						$end = strrpos($line, "\"", $start);
						
						if ($end !== false) {
							$input["text_new"] = str_replace(["\\", "\$", "\"", "\n", "\r"], ["\\\\", "\\\$", "\\\"", "\\\\n", ""], $input["text_new"]);
							$line              = substr_replace($line, $input["text_new"], $start, $end-$start);
							$replaced          = true;
							
							// Indicate that the data has been changed
							if ($add_tab) {
								// for website strings by adding tabulator at the beginning
								if ($line[0] != "\t")
									$line = "\t" . $line;
							} else {
								// for game and installer by changing the php array
								$contents2 = file_get_contents('translation_strings.php');								
								$start     = strpos($contents2, "\${$input["area"]}_updated");
								
								if ($start !== false) {
									$start = strpos($contents2, "\"{$languages[$input["language"]]}\"", $start);
									
									if ($start !== false) {
										$start = strpos($contents2, "[", $start);
										$end   = strpos($contents2, "]", $start);
										
										if ($start!==false  &&  $end!==false) {
											$array = explode(",", substr($contents2, $start+1, $end-$start-1));
											$index = array_search($input["stringtable_key"], $array);
											
											if ($index !== false) {
												unset($array[$index]);
												$contents2 = substr_replace($contents2, implode(",",$array), $start+1, $end-$start-1);
												file_put_contents('translation_strings.php', $contents2);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	$contents .= $line;
}

fclose($file);



// Rewrite file if text was replaced
if ($replaced) {
	$file = fopen($file_name, 'wb');
	
	if ($file) {
		$contents = str_replace("\r", "", $contents);
		$contents = str_replace("\n", "\r\n", $contents);
		
		if (fwrite($file, $contents) !== false) {
			echo "OK";
		} else
			echo "[Write error]";
		
		fclose($file);
	} else
		die("[Failed to rewrite file]");
} else
	echo "[Key not found] {$to_find} - {$to_find_pos} - " . implode(",", $to_find_list);
?>