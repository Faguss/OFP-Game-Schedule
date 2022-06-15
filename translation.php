<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
?>
<div id="page-wrapper">
	<div class="container">
	
<style>
.context_link {
	color: #e34bd0; 
	text-decoration: underline; 
	font-weight: bold;
	font-size: x-small;
};
</style>

<?php
require_once "common.php";
require_once "translation_strings.php";


// Build a language list where en-US=>English
$languages = [];
foreach(GS_LANGUAGES["game"] as $index=>$value)
	$languages[GS_LANGUAGES["file"][$index]] = $value;


// Find user's permissions
$permissions = [];

forEach($languages as $language_key=>$language_name)
	$permissions[$language_key] = false;

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

foreach($db->results(true) as $row) {	
	forEach($languages as $language_key=>$language_name) {
		$permission_name = strtolower($language_name) . "_translator";
		
		if (strcasecmp($row["name"],$permission_name) == 0)
			$permissions[$language_key] = true;
	}
}


// User pressed on the "Convert" button - convert translation_strings.php (utf8) to strings.txt (windows-1250/1251) for the game
if ($permissions["en-US"]) {
	if (isset($_POST["convert"])) {
		$text = "\tstring stringtable[][STR_MAX] = {\r\n";

		forEach($addoninstaller as $language_key=>$language) {
			$text .= "\t\t{\r\n";
			
			forEach($language as $stringtable_key => $stringtable_value) {
				$stringtable_value = str_replace("\\", "\\\\", $stringtable_value);
				$text .= "\t\t\t\"".GS_convert_utf8_to_windows($stringtable_value)."\"".($stringtable_key!=array_key_last($language)?",":"")."\t\t//$stringtable_key\r\n";
			}
				
			$text .= "\t\t}".($language_key!=array_key_last($addoninstaller)?",":"")."\r\n";
		}
		
		$text .= "\t};" . str_repeat("\r\n", 10);
		
		$array = array_keys($mainmenu);
		for($i=count($array)-1; $i>=0; $i--) {
			$language_key = $array[$i];
			$language     = $mainmenu[$language_key];
			
			if ($language_key != "en-US")
				$text .= "\tif (CURRENT_LANGUAGE == \"{$languages[$language_key]}\") then {\r\n\t\tMAINMENU_STR = [\r\n";
			else
				$text .= "\tif (Format[\"%1\", count MAINMENU_STR] == \"scalar\") then {\r\n\t\tMAINMENU_STR = [\r\n";
			
			forEach($language as $stringtable_key => $stringtable_value)
				$text .= "\t\t\t\"".GS_convert_utf8_to_windows($stringtable_value)."\"".($stringtable_key!=array_key_last($language)?",":"")."\t\t//$stringtable_key\r\n";
				
			$text .= "\t\t];\r\n\t};\r\n\r\n";
		}

		$handle = fopen("strings.txt", 'w');
		if ($handle) {
			fwrite($handle, $text); 
			fclose($handle);
			echo "Generated strings.txt successfully";
		} else
			echo "Failed to create strings.txt";
	} else 
		echo '<form action="" method="post"><button name="convert" value="">Convert</button></form>';
	
	echo "<br>";
}



// Define each table
$table_info = [
	"website" => [
		"name"            => "Website: general",
		"source"          => "",
		"context_key"     => [
			"GS_STR_DISABLED"         => "images/context/enabled_disabled.png",
			"GS_STR_ENABLED"          => "images/context/enabled_disabled.png",
			"GS_STR_ADDED_BY_ON"      => "images/context/managed_by.png",
			"GS_STR_MANAGED_BY_SINCE" => "images/context/managed_by.png"
		],
		"context_section" => [
			"Drop-down menu in the navigation bar"       => "images/context/drop_down_menu_ru.png",
			"Home page"                                  => "images/context/home_page_ru.png",
			"Edit server details page"                   => "images/context/edit_server_details_page_ru.png",
			"Edit server details page feedback"          => "images/context/edit_server_details_page_feedback_ru.png",
			"Display server info page"                   => "images/context/display_server_info_page_ru.png",
			"Edit server schedule page"                  => "images/context/edit_server_schedule_page_ru.png",
			"Edit server schedule page feedback"         => "images/context/edit_server_schedule_page_feedback_ru.png",
			"Edit server mods page"                      => "images/context/edit_server_mods_page_ru.png",
			"Edit server mods feedback"                  => "images/context/edit_server_mods_page_feedback_ru.png",
			"Edit mod details page"                      => "images/context/edit_mods_details_page_ru.png",
			"Convert download link modal"                => "images/context/convert_download_link_modal_ru.png",
			"Edit mod details page feedback"             => "images/context/edit_mod_details_page_feedback_ru.png",
			"Display mod info page"                      => "images/context/display_mod_info_page_ru.png",
			"Add/Edit mod version section"               => "images/context/addedit_mod_version_section_ru.png",
			"Add/Edit mod version section feedback"      => "images/context/addedit_mod_version_section_feedback_ru.png",
			"Jump between mod versions section"          => "images/context/jump_between_mod_versions_section_ru.png",
			"Jump between mod versions section feedback" => "images/context/jump_between_mod_versions_section_feedback_ru.png",
			"Share server/mod page"                      => "images/context/share_servermod_page_ru.png",
			"Share server/mod page feedback"             => "images/context/share_servermod_page_feedback_ru.png",
			"Delete page"                                => "images/context/delete_page_ru.png",
			"Activity log"                               => "recent_activity"
		],
		"hide_rows"       => true,
		"instructions"    => "Done"
	], 
	
	"website_quickstart" => [
		"name"            => "Website: quickstart",
		"source"          => "quickstart.php",
		"context_key"     => [], 
		"context_section" => ["Quickstart page"=>"quickstart"],
		"hide_rows"       => false,
		"instructions"    => "Done"
	], 
	
	"website_modupdates" => [
		"name"            => "Website: mod updates",
		"source"          => "modupdates.php",
		"context_key"     => [], 
		"context_section" => ["Mod updates page"=>"mod_updates"],
		"hide_rows"       => true,
		"instructions"    => "This entire page needs to be translated"
	], 
	
	"website_dedicated"  => [
		"name"            => "Website: dedicated server",
		"source"          => "installdedicated.php",
		"context_key"     => [], 
		"context_section" => ["Dedicated server support page"=>"dedicated_server"],
		"hide_rows"       => false,
		"instructions"    => "This entire page needs to be translated"
	],
	
	"website_api" => [
		"name"            => "Website: api documentation",
		"source"          => "api_documentation.php",
		"context_key"     => [], 
		"context_section" => ["API documentation page"=>"api_documentation"],
		"hide_rows"       => false,
		"instructions"    => "Done"
	],
	
	"mainmenu" => [
		"name"            => "Game Main Menu",
		"source"          => "translation_strings.php",
		"context_key"     => [
			0 => "images/context/mainmenu/failedtocreatedialog.jpg",
			1 => "images/context/mainmenu/resourceisoutdated.jpg",
			2 => "images/context/mainmenu/modsmenu.jpg",
			3 => "images/context/mainmenu/modsmenu.jpg",
			4 => "images/context/mainmenu/thisisthecurrentmasterserver.jpg",
			5 => "images/context/mainmenu/typeinpasswordtoshowprivategames.jpg",
			6 => "images/context/mainmenu/modsmenu.jpg",
			7 => "images/context/mainmenu/thisisthecurrentmasterserver.jpg",
			8 => "images/context/mainmenu/theresnothingtosave.jpg",
			9 => "images/context/mainmenu/itsalreadyonthelist.jpg",
			10 => "images/context/mainmenu/downloadingschedule.jpg",
			11 => "images/context/mainmenu/downloaditem.jpg",
			12 => "images/context/mainmenu/openinvite.jpg",
			13 => "images/context/mainmenu/failedtocreatedirectory.jpg",
			14 => "images/context/mainmenu/downloadingschedule.jpg",
			15 => "images/context/mainmenu/downloadfailed.jpg",
			16 => "images/context/mainmenu/downloadingschedule.jpg",
			17 => "images/context/mainmenu/downloadingschedule.jpg",
			18 => "images/context/mainmenu/invaliddata.jpg",
			19 => "images/context/mainmenu/no_servers.jpg",
			20 => "images/context/mainmenu/incorrectscheduleversion.jpg",
			23 => "images/context/mainmenu/sortinggametimes.jpg",
			24 => "images/context/mainmenu/gameschedule.jpg",
			25 => "images/context/mainmenu/gameschedule.jpg",
			26 => "images/context/mainmenu/serverconnect.jpg",
			27 => "images/context/mainmenu/serverconnect.jpg",
			28 => "images/context/mainmenu/serverdownloadmods.jpg",
			29 => "images/context/mainmenu/serverdownloadmods.jpg",
			30 => "images/context/mainmenu/serverdownloadmods.jpg",
			31 => "images/context/mainmenu/serverdownloadmods.jpg",
			32 => "images/context/mainmenu/serverdownloadmods.jpg",
			33 => "images/context/mainmenu/withvoice.jpg",
			34 => "images/context/mainmenu/withvoice.jpg",
			36 => "images/context/mainmenu/modfolderconflict.jpg",
			37 => "images/context/mainmenu/modfolderconflict.jpg",
			38 => "images/context/mainmenu/modfolderconflict.jpg",
			39 => "images/context/mainmenu/modfolderconflict.jpg",
			42 => "images/context/mainmenu/restart_when_done.jpg",
			43 => "images/context/mainmenu/installation_process.jpg",
			44 => "images/context/mainmenu/installation_process.jpg",
			46 => "images/context/mainmenu/requires_exact_mods.jpg",
			47 => "images/context/mainmenu/game_will_be_restarted_at.jpg",
			48 => "images/context/mainmenu/update_fwatch.jpg",
			49 => "images/context/mainmenu/update_fwatch.jpg",
			50 => "images/context/mainmenu/server_info.jpg",
			58 => "images/context/mainmenu/server_info.jpg",
			59 => "images/context/mainmenu/server_info.jpg",
			60 => "images/context/mainmenu/server_info.jpg",
			61 => "images/context/mainmenu/server_info.jpg",
			62 => "images/context/mainmenu/server_info.jpg",
			65 => "images/context/mainmenu/server_info.jpg",
			66 => "images/context/mainmenu/server_info.jpg",
			67 => "images/context/mainmenu/server_info.jpg",
			68 => "images/context/mainmenu/server_info.jpg",
			69 => "images/context/mainmenu/server_info.jpg",
			70 => "images/context/mainmenu/server_info.jpg",
			71 => "images/context/mainmenu/server_info.jpg",
			72 => "images/context/mainmenu/server_info.jpg",
			73 => "images/context/mainmenu/server_info.jpg",
			74 => "images/context/mainmenu/requires_exact_mods.jpg",
			76 => "images/context/mainmenu/cannot_update_while_loaded.jpg",
			77 => "images/context/mainmenu/cannot_update_while_loaded.jpg",
			80 => "images/context/mainmenu/update_fwatch.jpg",
			82 => "images/context/mainmenu/modsmenu.jpg",
			83 => "images/context/mainmenu/download_mods.jpg",
			84 => "images/context/mainmenu/download_mods.jpg",
			85 => "images/context/mainmenu/installation_process.jpg",
			86 => "images/context/mainmenu/there_is_new_fwatch_available.jpg",
			87 => "images/context/mainmenu/available_mod_updates.jpg",
			88 => "images/context/mainmenu/installation_process.jpg",
			89 => "images/context/mainmenu/download_mods.jpg",
			91 => "images/context/mainmenu/download_mods.jpg",
			92 => "images/context/mainmenu/type_mod_or_category_name.jpg",
			93 => "images/context/mainmenu/mod_info.jpg",
			94 => "images/context/mainmenu/mod_info.jpg",
			95 => "images/context/mainmenu/mod_info.jpg",
			96 => "images/context/mainmenu/mod_info.jpg",
			97 => "images/context/mainmenu/mod_info.jpg",
			98 => "images/context/mainmenu/mod_info.jpg",
			99 => "images/context/mainmenu/mod_info.jpg",
			104 => "images/context/mainmenu/mod_info.jpg",
			105 => "images/context/mainmenu/mod_info_right_click.jpg"
		],
		"context_section" => [],
		"hide_rows"       => false,
		"instructions"    => "On the bottom I've marked strings that have been changed/added within the last year because I don't remember which ones you've translated and which I did. If the string is correct then click on it and then click elsewhere to remove the red marking."
	], 
	
	"addoninstaller" => [
		"name"            => "Addon Installer",
		"source"          => "translation_strings.php",
		"context_key"     => [
			"STR_PROGRESS"           => "https://ofp-faguss.com/schedule/images/context/mainmenu/restart_when_done.jpg",
			"STR_ACTION_DOWNLOADING" => "https://ofp-faguss.com/schedule/images/context/mainmenu/restart_when_done.jpg",
			"STR_DOWNLOAD_LEFT"      => "https://ofp-faguss.com/schedule/images/context/mainmenu/restart_when_done.jpg",
			"STR_ERROR"              => "https://ofp-faguss.com/schedule/images/context/mainmenu/installation_move_error.jpg",
			"STR_ERROR_INVERSION"    => "https://ofp-faguss.com/schedule/images/context/mainmenu/installation_move_error.jpg",
			"STR_ERROR_ONLINE"       => "https://ofp-faguss.com/schedule/images/context/mainmenu/installation_move_error.jpg"
		],
		"context_section" => [],
		"hide_rows"       => false,
		"instructions"    => "On the bottom I've marked strings that have been changed/added within the last year because I don't remember which ones you've translated and which I did. If the string is correct then click on it and then click elsewhere to remove the red marking."
	]
];



$output         = "";
$instructions   = [];
$first_table_id = "";

// Table selection control
$output .=  "<label for=\"table_select\">Section: &nbsp; </label><select id=\"table_select\" onchange=\"display_table(this.options[this.selectedIndex].value)\">";

forEach($table_info as $table_id=>$table_options) {
	$output                 .= "<option value=\"$table_id\">{$table_options["name"]}</option>";
	$instructions[$table_id] = $table_options["instructions"];
	
	if (empty($first_table_id))
		$first_table_id = $table_id;
}
	
$output .= "</select><br><br><p id=\"instructions\"></p><br>";


// Buttons for hiding table columns
$output .=  "<label>Show columns:</label> &nbsp; ";

forEach($languages as $language_key=>$language_name)
	$output .= "<input type=\"checkbox\" name=\"$language_name\" value=\"1\" onclick=\"table_column_toggle(this, '$language_key')\" checked>&nbsp;<label for=\"$language_name\">$language_name</label> &nbsp; &nbsp; ";
?>



<script>
var instructions = <?php echo json_encode($instructions) ?>;

// When the page is loaded then show the first table or the one from the URL fragment
window.onload = function() {
	var table_info = {
		active_table : <?php echo "\"$first_table_id\"" ?>, 
		active_row   : null
	};
	
	if (window.location.hash)
		table_info = find_stringtable_key(window.location.hash.slice(1));
	
	display_table(table_info.active_table);

	if (table_info.active_row)
		scroll_to_table_row(table_info.active_row, true);
};

// If URL fragment has changed then show appropiate table and scroll to the selected row
$(window).bind('hashchange', function () {
	table_info = find_stringtable_key(window.location.hash.slice(1));
	display_table(table_info.active_table);

	if (table_info.active_row)
		scroll_to_table_row(table_info.active_row, false);
});

// Show selected table and hide all others
function display_table(selected_table) {
	var wanted_table       = selected_table;
	var wanted_table_index = -1;
	
	if (typeof selected_table === 'string')
		wanted_table = document.getElementById(selected_table);
	
	var tables = document.getElementsByTagName("table");
	
	for (var i=0; i<tables.length; i++) {
		tables[i].style.display = tables[i]==wanted_table ? "table" : "none";
		wanted_table_index      = i;
	}
	
	var paragraph       = document.getElementById("instructions");
	paragraph.innerHTML = instructions[wanted_table.id];
	
	// Adjust table select drop-down list
	var select = document.getElementById("table_select");
	
	for (var i=0; i<select.options.length; i++)
		if (select.options[i].value == selected_table.id)
			select.selectedIndex = i;
}

// Show or hide language column
function table_column_toggle(checkbox, column_class) {
	var columns = document.getElementsByClassName(column_class);

	for (var i=0; i<columns.length; i++)
		columns[i].style.display = checkbox.checked ? "table-cell" : "none";
	
	// Resize context cells
	var tables = document.getElementsByTagName("table");
	if (tables.length > 0) {
		var how_many_visible     = 0;
		var table_head           = tables[0].firstElementChild;
		var table_head_row       = table_head.firstElementChild;
		var table_head_row_items = table_head_row.children;
		
		for (var j=0; j<table_head_row_items.length; j++)
			if (table_head_row_items[j].style.display != "none")
				how_many_visible++;
			
		var irregular_cells = document.getElementsByClassName("context_cell");
		for (var i=0; i<irregular_cells.length; i++)
			irregular_cells[i].setAttribute("colspan", how_many_visible);
	}
	
};

// Show or hide a single section in a table
function display_table_section(section_row, action) {
	var table_body     = section_row.parentNode;
	var table_rows     = table_body.children;
	var started_toggle = false;

	for (var i=0; i<table_rows.length; i++) {
		var row = table_rows[i];
		
		if (started_toggle)
			if (row.getAttribute('class') != "info") {
				if (action == "toggle")
					row.style.display = row.style.display=="none" ? "table-row" : "none";
				else
					if (action == "show")
						row.style.display = "table-row";
					else
						if (action == "hide")
							row.style.display = "none";
			} else
				break;

		if (row == section_row) 
			started_toggle = true;
	}
};

// Find table row with selected key and return table object and row object
function find_stringtable_key(key) {
	//https://stackoverflow.com/questions/298503/how-can-you-check-for-a-hash-in-a-url-using-javascript
	var table_row = document.getElementById(key);
	
	if (!table_row) {
		alert(key.substring(1) + " not found");
		return {active_table:null, active_row:null};
	}
	
	var table_body = table_row.parentNode;
	var table      = table_body.parentNode;
	
	if (table.style.display == "none")
		table.style.display = "table";
	
	if (table_row.style.display == "none") {
		var table_body          = table_row.parentNode;
		var table_rows          = table_body.children;
		var last_info_row       = null;
		
		for (var i=0; i<table_rows.length; i++) {
			if (table_rows[i].getAttribute('class') == "info")
				last_info_row = table_rows[i];

			if (table_rows[i] == table_row) 
				break
		}
		
		display_table_section(last_info_row, "show");
	}
	
	return {active_table:table, active_row:table_row}; 
};

// Scroll window to the selected item
function scroll_to_table_row(table_row, on_webpage_load) {
	// scrollto doesn't seem to work when window is scrolled to the bottom so force top of the page
	if (on_webpage_load)
		window.scrollTo(0, 0);

	var y = table_row.getBoundingClientRect().top + window.scrollY;
	
	var navbar_test = document.getElementById("navbar_test");
	var div         = navbar_test.parentNode;
	y              -= div.getBoundingClientRect().height;    
			
	window.scrollTo({ top: y, behavior: 'smooth' });
}

// Create text input when clicked on a table cell. Then send changes to the translation_request.php
function create_text_input_inside_table_cell(table_cell) {
	if (document.getElementsByTagName("textarea").length == 0) {
		var text_original = table_cell.innerHTML;
		var width         = table_cell.offsetWidth - (table_cell.offsetWidth/20);
		var height        = table_cell.offsetHeight / 1.25;
		var text_input    = document.createElement("textarea");
		
		if (text_original == "...")
			return;
		
		var text_original_converted = text_original.replaceAll("<br>", "\n");
		
		table_cell.innerHTML = "";
		table_cell.appendChild(text_input);
		text_input.focus();
		text_input.selectionStart = text_input.selectionEnd = text_input.value.length;
		text_input.style.width    = width  + "px";
		text_input.style.height   = height + "px";
		text_input.innerHTML      = text_original_converted;

		// https://stackoverflow.com/questions/152975/how-do-i-detect-a-click-outside-an-element
		text_input.addEventListener("focusout", function (event) {
			if (
				// we are still inside the dialog so don't close
				text_input.contains(event.relatedTarget) ||
				// we have switched to another tab so probably don't want to close 
				!document.hasFocus()  
			) {
				return;
			}		
			
			var text_new         = text_input.value;
			var table_cell       = text_input.parentNode;
			var table_row        = table_cell.parentNode;
			var table_row_items  = table_row.children;
			var stringtable_key  = table_row_items[0].title;
			var language         = "";
			
			// get title from the first cell in this row
			// get cell text from the first cell in this column
			for (var i=0; i<table_row_items.length; i++) {
				if (table_row_items[i] == table_cell) {
				  var table_body           = table_row.parentNode;
				  var table                = table_body.parentNode;
				  var table_head           = table.firstElementChild;
				  var table_head_row       = table_head.firstElementChild;
				  var table_head_row_items = table_head_row.children;

				  for (var j=0; j<table_head_row_items.length; j++)
					  if (j == i)
						  language = table_head_row_items[j].innerHTML;
				}
			}
			
			// Send translation request
			if (language!=""  &&  stringtable_key!==null  &&  (text_new!=text_original_converted  ||  table_cell.classList.contains('danger'))) {
				table_cell.innerHTML = "...";
				
				// I'm using GET instead of POST because my hosting is blocking it for my translator
				$.get('translation_request.php', {"area":table.title, "language":language, "stringtable_key":stringtable_key, "text_new":text_new}, function(responseText) {
						if (responseText == "OK") {
							table_cell.innerHTML = text_new.replaceAll("\n", "<br>");
							table_cell.classList.remove('danger');
						} else {
							table_cell.innerHTML = text_original;
							console.log(table.title + " " + language + " " + stringtable_key + " " + text_new + " = " + responseText);
							alert(responseText);
						}
					}
				);
			} else
				table_cell.innerHTML = text_original;
		});
		
		// Remove input on ESC
		text_input.addEventListener("keydown", function (key) {
			if (key.which === 27)
				table_cell.innerHTML = text_original;
		});
	}
}
</script>








<?php
// Trim white space from a string and then a single quotation mark
function trim_single_quote($string) {
	$string = trim($string);
	
	for ($i=0; $i<strlen($string); $i++) {
		if (!ctype_alpha($string[$i])) {
			if ($string[$i] == '"')
				$string = substr_replace($string, "", $i, 1);
			
			break;
		}
	}
	
	for ($i=strlen($string)-1; $i>0; $i--) {
		if (!ctype_alpha($string[$i])) {
			if ($string[$i] == '"')
				$string = substr_replace($string, "", $i, 1);
			
			break;
		}		
	}
	
	return $string;
}

// Start HTML table
function create_html_table_header($table_id, $languages) {
	$output = "
		<table id=\"$table_id\" title=\"$table_id\" class=\"table table-striped table-hover table-bordered\" style=\"table-layout: fixed;\">
			<thead class=\"thead-light\">
			<tr>
				<th style=\"width:100px;\">key</th>";

	forEach($languages as $language_key=>$language_name)
		$output .= "<th class=\"$language_key\">$language_name</th>";
				
	$output .= "
		</tr>
		</thead>
		<tbody>
	";
	
	return $output;
}

// Get language strings from a selected PHP file to an array
function get_file_strings($file_name, $languages) {
	$stringtable         = [];
	$comment_count       = 0;
	$completed_languages = 0;
	$text                = file_get_contents($file_name);
	$lines               = preg_split('/\r\n|\r|\n/', $text);
	$language_key        = "";
	
	foreach($lines as $line) {
		$updated = !ctype_space($line[0]);
		$line    = trim(trim($line), ",");
		
		$search_for = "if (\$lang[\"THIS_CODE\"] == \"";
		if (substr($line, 0, strlen($search_for)) == $search_for) {
			$language_key = substr($line, strlen($search_for), 5);
			continue;
		}			
		
		$tokens = explode("=>", $line);
		$hash   = strpos($line, "#");
		
		if (count($tokens) == 2) {
			$stringtable_key   = trim_single_quote($tokens[0]);
			$stringtable_value = stripslashes(trim_single_quote($tokens[1]));
			
			if (!array_key_exists($stringtable_key,$stringtable)) {
				$stringtable[$stringtable_key] = [];
				
				for($i=0; $i<count($languages); $i++)
					$stringtable[$stringtable_key][array_keys($languages)[$i]] = "";
			}
			
			$stringtable[$stringtable_key][$language_key] = ($updated ? "\t" : "") . $stringtable_value;
		} else
			if ($hash!==FALSE && $language_key=="en-US")
				$stringtable["comment".$comment_count++] = substr($line, $hash+1);
			
		if ($line == "));")
			$completed_languages++;
		
		if ($completed_languages == count($languages))
			break;
	}
	
	return $stringtable;
}

// Convert strings from an array to table rows
function stringtable_to_html_table($stringtable, $permissions, $context, $context_section, $hide_rows=false, $marked_for_change=null) {
	$output = "";
	
	foreach($stringtable as $stringtable_key=>$stringtable_values) {
		if ($stringtable_key == "GS_STR_TRANSLATION")
			continue;
		
		// Normal row - show key and its value in each language
		if (is_array($stringtable_values)) {
			$context_link = "";
			
			if (in_array($stringtable_key,array_keys($context)))
				$context_link = "&nbsp; <a class=\"context_link\" target=\"_blank\" href=\"{$context[$stringtable_key]}\">context</a>";
			
			$stringtable_key_display = str_replace("_"," ",$stringtable_key);
			
			if (substr($stringtable_key_display,0,7) == "GS STR ")
				$stringtable_key_display = substr($stringtable_key_display,7);
			
			if (substr($stringtable_key_display,0,3) == "GS ")
				$stringtable_key_display = substr($stringtable_key_display,3);
			
			$output .= "<tr id=\"$stringtable_key\" ".($hide_rows ? "style=\"display:none;\"" : "")."><td style=\"font-size:xx-small\" title=\"$stringtable_key\"><a href=\"#{$stringtable_key}\">$stringtable_key_display</a> $context_link</td>";
				
			foreach($stringtable_values as $language_key=>$language_string) {
				$class = "";
				
				// Change table cell color to red if this string is marked
				// It can be marked by a tab on the beginning OR through optional array
				if (isset($marked_for_change)) {
					if (in_array($stringtable_key,$marked_for_change[$language_key]))
						$class = "danger";
				} else {
					if ($language_string[0] == "\t") {
						$language_string = trim($language_string);
						$class           = "danger";
					}
				}
				
				$output .= "<td class=\"$class $language_key\" ";
				
				if ($permissions[$language_key])
					$output .= "onclick=\"create_text_input_inside_table_cell(this)\"";
				
				$output .= ">$language_string</td>";
			}

			$output .= "</tr>";
		} else {
			// Section title
			$link       = "";
			$section_id = "";
			
			for($i=0; $i<strlen($stringtable_values); $i++) {
				$letter = $stringtable_values[$i];
				
				if (ctype_space($letter))
					$letter = "_";
				else
					if (!ctype_alpha($letter))
						$letter = "";

				$section_id .= $letter;
			}
			
			if (in_array($stringtable_values, array_keys($context_section)))
				$link = "&nbsp;<a class=\"context_link\" target=\"_blank\" href=\"{$context_section[$stringtable_values]}\">context</a>";
			
			$output .= "
			<tr onclick=\"display_table_section(this, 'toggle')\" id=\"$section_id\" class=\"info\">
			<td class=\"context_cell\" colspan=\"4\">
				<center><b>{$stringtable_values}</b>$link</center>
			</td>
			</tr>";
		}
	}
	
	return $output;
}



// Get strings from each file in usersc\lang
$stringtable   = [];
$comment_count = 0;

foreach($languages as $language_key=>$language_name) {
	$text  = file_get_contents("usersc//lang//".$language_key.".php");
	$start = strpos($text,"#");
	$end   = strrpos($text,"\"");
	
	if ($start === FALSE)
		$start = 0;
		
	if ($end === FALSE)
		$end = strlen($text);
	
	$text  = substr($text, $start, $end-$start);
	$lines = preg_split('/\r\n|\r|\n/', $text);
	
	foreach($lines as $line) {
		$updated = !ctype_space($line[0]);
		$line    = trim(trim($line), ",");
		$tokens  = explode("=>", $line);
		$hash    = strpos($line, "#");
		
		if (count($tokens) == 2) {
			$stringtable_key   = trim_single_quote($tokens[0]);
			$stringtable_value = stripslashes(trim_single_quote($tokens[1]));
			
			if (!array_key_exists($stringtable_key,$stringtable)) {
				$stringtable[$stringtable_key] = [];
				
				for($i=0; $i<count($languages); $i++)
					$stringtable[$stringtable_key][array_keys($languages)[$i]] = "";
			}
			
			$stringtable[$stringtable_key][$language_key] = ($updated ? "\t" : "") . $stringtable_value;
		} else
			if ($hash!==FALSE && $language_key=="en-US")
				$stringtable["comment".$comment_count++] = substr($line, $hash+1);
	}
}

// Render tables
forEach($table_info as $table_id=>$table_options) {
	$output .= create_html_table_header($table_id, $languages);
			
	if ($table_id!="mainmenu" && $table_id!="addoninstaller") {
		// Default table display
		$output .= stringtable_to_html_table(
			$table_id=="website" ? $stringtable : get_file_strings($table_options["source"], $languages), 
			$permissions, 
			$table_options["context_key"], 
			$table_options["context_section"], 
			$table_options["hide_rows"]
		);
	} else {
		// "mainmenu" and "addoninstaller" come from translation_strings.php which is already loaded
		$stringtable            = [];
		$source                 = $$table_id;
		$marked_for_change_name = $table_id."_updated";
		$marked_for_change      = $$marked_for_change_name;
		
		// Build a stringtable
		forEach ($source["en-US"] as $stringtable_key=>$stringtable_value) {
			$stringtable[$stringtable_key] = [];
			
			forEach ($languages as $language_key=>$language_name)
				$stringtable[$stringtable_key][$language_key] = str_replace("\\n", "<br>", $source[$language_key][$stringtable_key]);
		}
		
		$output .= stringtable_to_html_table(
			$stringtable, 
			$permissions, 
			$table_options["context_key"], 
			$table_options["context_section"], 
			$table_options["hide_rows"],
			$marked_for_change
		);
	}
	
	$output .= "</tbody></table>";
}

echo $output;
?>
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
