<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

?>
<?php
require_once "common.php";

function format_logo($record_type, $filename) {
	$url   = "";
	$color = $record_type=="server" ? "blue" : "green" ;
		
	if (substr($filename, -3) == "jpg")
		$url = "logo/$filename";
	else
		if (substr($filename, -3) == "paa")
			$url = "images/placeholder_32_".$color."_paa.png";
		else
			$url = "images/placeholder_32_".$color.".png";
		
	return $url;
}

function format_items($key_array, $items, $record_type, $record_column, $permission_to, $gs_my_permission_level) {
	$html        = "";
	$item_count  = 0;
	$row_started = false;
	$total_items = 0;
	
	$sorted      = sort_into_columns($key_array, 3);
	$column_size = ceil(12 / $sorted["number_of_columns"]);
	
	if ($column_size < 1)
		$column_size = 1;

	for ($current_row=0; $current_row<$sorted["number_of_rows"]; $current_row++) {
		$html .= '<div class="row">';
		
		for ($current_column=0; $current_column<$sorted["number_of_columns"]; $current_column++) {
			$key = $sorted["columns"][$current_column][$current_row];
			
			if (!isset($key))
				break;
			
			// Determine user's rights to edit the item
			$item          = $items[$key];
			$owner         = $gs_my_permission_level == GS_PERM_ADMIN  ||  $item["isowner"] == "1";
			$html_controls = "";
			
			foreach ($permission_to as $permission=>$value)
				if ($owner || isset($item["right_".strtolower($permission)]) &&  $item["right_".strtolower($permission)] && !in_array($permission,GS_FORM_ACTIONS_NON_SHAREABLE)) {
					if ($permission == "Delete")
						$html_controls .= '<li role="separator" class="divider"></li>';
					
					$html_controls .= '<li><a href="edit_'.$record_type.'.php?uniqueid='.$item["uniqueid"].'&display_form='.$permission.'">'.lang(GS_FORM_ACTIONS[$permission]).'</a></li>';
				}
				
			if (empty($html_controls))
				continue;
			
			$total_items++;
			$html .= '
			<div class="col-lg-'.$column_size.'">
				<div class="media">
					<div class="media-left">
						<img width=32 height=32 src='.format_logo($record_type, $item["logo"]).'>
					</div>
					<div class="media-body media-middle">
						<div class="dropdown">
							<p id="dropdownMenu'.$item["uniqueid"].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								'.($item["name"]!="" ? $item["name"] : $item["uniqueid"]).'
								<span class="caret"></span>
							</p>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu'.$item["uniqueid"].'">
								<li><a href="show.php?'.$record_column.'='.$item["uniqueid"].'">'.lang("GS_STR_INDEX_SHOW").'</a></li>
								<li role="separator" class="divider"></li>
								'.$html_controls.'
							</ul>
						</div><!--end dropdown-->
					</div><!--end media-body-->
				</div><!--end media-->
			</div><!--end col-->';
		}
		
		$html .= '</div><!--end row-->';
	}
	
	if ($total_items == 0)
		$html = '<div class="row"><div class="col-lg-12"><p>'.lang("GS_STR_INDEX_NO_RECORDS").'</p></div></div>';
	
	return $html;
}
		
function format_server_status($status) {
	$output = [
		"status"  => lang(GS_SERVER_STATUS[0]),
		"mission" => "",
		"players" => "",
		"summary" => lang(GS_SERVER_STATUS[0]),
	];
	
	$server_status_mission = "";
	$server_status_players = "";
	
	$server_status = json_decode($status, true);
	
	if (isset($server_status)) {
		if (isset($server_status["gstate"])) {
			$output["status"]  = lang(GS_SERVER_STATUS[$server_status["gstate"]]);
			$output["summary"] = $output["status"];
		}
		
		if (!empty($server_status["gametype"]) && !empty($server_status["mapname"])) {
			$output["mission"]  = $server_status["gametype"] . "." . $server_status["mapname"];
			$output["summary"] .= " - " . $output["mission"];
		}
		
		if (isset($server_status["numplayers"]) && isset($server_status["players"])) {
			$output["players"] = $server_status["numplayers"];
			
			if (!empty($server_status["players"])) {
				$output["summary"] .= " -";
				
				foreach($server_status["players"] as $player) {
					$output["players"] .= "<br>" . $player["player"];
					$output["summary"] .= " " . $player["player"];
				}
			}
			
		}
	}
	
	return $output;
}

function compare_two_servers($a, $b) {
	foreach(['date','players','status'] as $key) {
		$cmp = strcmp($a[$key], $b[$key]);
		if ($cmp !== 0)
			return $cmp*-1;
	}
	
	return 0;
}

function sort_into_columns($items, $number_of_columns=4) {
	$number_of_rows = count($items) / $number_of_columns;
	$columns_id     = [];

	$i = 0;
	foreach ($items as $key=>$item) {
		if (!isset($columns_id[$i]))
			$columns_id[$i] = [];
		
		$columns_id[$i][] = $key;
		
		if (count($columns_id[$i]) >= $number_of_rows)
			$i++;
	}
	
	return [
		"columns"           => $columns_id, 
		"number_of_rows"    => count($columns_id[0]), 
		"number_of_columns" => count($columns_id)
	];
}

$gs_my_permission_level = GS_get_permission_level($user);

// Get servers
$servers      = GS_list_servers(["current"], [], GS_REQTYPE_WEBSITE, 0, $lang["THIS_LANGUAGE"], $user);
$mods         = GS_list_mods($servers["mods"], [], [], [], GS_REQTYPE_WEBSITE, $servers["lastmodified"]);
$servers_html = "";

$all_events    = [];
$persistent    = [];
$js_event_data = [];
$js_serv_id    = [];
$js_expired    = [];

foreach($servers["info"] as $server_key=>$server) {
	$player_count   = 0;
	$current_status = 0;
	$status_query   = json_decode($server["status"]);
	
	if (isset($status_query->gstate))
		$current_status = intval($status_query->gstate);

	if (isset($status_query->numplayers))
		$player_count = intval($status_query->numplayers);
	
	if ($server["persistent"]) {	
		$persistent[] = ["date"=>0, "players"=>$player_count, "status"=>$current_status, "key"=>$server_key];
	} else {		
		foreach($server["events"] as $event_key=>$event) {
			$event_date   = new DateTime($event["iso8601"]);
			$all_events[] = ["date"=>$event_date->getTimestamp(), "players"=>$player_count, "status"=>$current_status, "key"=>["server"=>$server_key, "event"=>$event_key]];
		}
	}
	
	$js_serv_id[] = $server["uniqueid"];
	$js_expired[] = strtotime("now") > strtotime($server["status_expires"]);
}

if (!empty($all_events)) {
	$servers_html .= '<p><strong>'.lang("GS_STR_SERVER_EVENT_CURRENT").':</strong></p>';
	usort($all_events, 'compare_two_servers');
	$current_event_data = [];

	foreach($all_events as $sorted_item) {
		$key         = $sorted_item["key"];
		$server      = $servers["info"][$key["server"]];
		$event       = $server["events"][$key["event"]];
		$server_name = empty($server["name"]) ? $server["uniqueid"] : $server["name"];
		$status      = format_server_status($server["status"]);
		
		$server_mods = [];
		foreach($server["mods"] as $mod_id)
			$server_mods[] = '<a target="_blank" href="show.php?mod='.$mods["info"][$mod_id]["uniqueid"].'">'.$mods["info"][$mod_id]["name"].'</a>';
		
		$mods_html .= '
		<div class="col-lg-3">
			<div class="media">
				<div class="media-left">
					<img width=32 height=32 src='.format_logo($record_type, $item["logo"]).'>
				</div>
				<div class="media-body media-middle">
					<a href="show.php?mod='.$item["uniqueid"].'" target="_blank">'.$mod_name.'</a>
				</div>
			</div>
		</div>';
		
		$servers_html .= '
		<div class="row">
			<div class="col-lg-4">
				<div class="media">
					<div class="media-left">
						<img width=32 height=32 src='.format_logo("server", $server["logo"]).'>
					</div>
					<div class="media-body media-middle">
						<a target="_blank" href="show.php?server='.$server["uniqueid"].'">'.$server_name.'</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 servergametime">'.$event["description"].'</div>
			<div class="col-lg-4" id="query'.$server["uniqueid"].'">'.$status["summary"].'</div>
		</div>';

		$js_event_data[] = [[
			"starttime" => $event["iso8601"],
			"duration"  => $event["duration"],
			"type"      => $event["type"],
			"started"   => $event["started"]
		]];
	}
}

if (!empty($persistent)) {
	$style         = !empty($all_events) ? 'style="margin-top: 2em;"' : '';
	$servers_html .= '<p '.$style.'><strong>'.lang("GS_STR_INDEX_PERSISTENT").':</strong></p>';
	usort($persistent, 'compare_two_servers');

	foreach($persistent as $sorted_item) {
		$key          = $sorted_item["key"];
		$server       = $servers["info"][$key];
		$server_name  = empty($server["name"]) ? $server["uniqueid"] : $server["name"];
		$player_count = $sorted_item["players"];
		$status       = format_server_status($server["status"]);
		
		$server_mods = [];
		foreach($server["mods"] as $mod_id)
			$server_mods[] = '<a target="_blank" href="show.php?mod='.$mods["info"][$mod_id]["uniqueid"].'">'.$mods["info"][$mod_id]["name"].'</a>';
		
		$servers_html .= '
		<div class="row">
			<div class="col-lg-4">
				<div class="media">
					<div class="media-left">
						<img width=32 height=32 src='.format_logo("server", $server["logo"]).'>
					</div>
					<div class="media-body media-middle">
						<a target="_blank" href="show.php?server='.$server["uniqueid"].'">'.$server_name.'</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4" id="query'.$server["uniqueid"].'">'.$status["summary"].'</div>
		</div>';	
	}
}

// Get mods
$sql = "
	SELECT 
		gs_mods.name,
		gs_mods.logo,
		gs_mods.subtitle,
		gs_mods.uniqueid,
		gs_mods.removed,
		gs_mods.access
		
	FROM
		gs_mods
		
	WHERE
		gs_mods.removed = 0 AND gs_mods.access = ''
		
	ORDER BY 
		gs_mods.name ASC
";

$db = DB::getInstance();
if ($db->query($sql)->error()) {
	if ($gs_my_permission_level == GS_PERM_ADMIN)
		echo $sql . $db->errorString();
	die("Failed to load {$record_type}s");
}

$items     = $db->results(true);
$sorted    = sort_into_columns($items);
$mods_html = '
	<div class="permalink_parent">
		<a class="permalink_child" href="allmods"><span class="glyphicon glyphicon-link"></span></a>
	</div>';

for ($current_row=0; $current_row<$sorted["number_of_rows"]; $current_row++) {
	$mods_html .= '<div class="row">';

	for ($current_column=0; $current_column<$sorted["number_of_columns"]; $current_column++) {
		$key = $sorted["columns"][$current_column][$current_row];
		
		if (!isset($key))
			break;
		
		$item     = $items[$key];
		$mod_name = empty($item["name"]) ? $item["uniqueid"] : $item["name"];
						
		if (!empty($item["subtitle"]))
			$mod_name .= ' <span class="gs_mod_subtitle">('.$item["subtitle"].')</span>';
		
		$mods_html .= '
		<div class="col-lg-3">
			<div class="media">
				<div class="media-left">
					<img width=32 height=32 src='.format_logo($record_type, $item["logo"]).'>
				</div>
				<div class="media-body media-middle">
					<a href="show.php?mod='.$item["uniqueid"].'" target="_blank">'.$mod_name.'</a>
				</div>
			</div>
		</div>';
	}

	$mods_html .= '</div><!-- end row -->';
}




if (isset($user) && $user->isLoggedIn()){
	$uid          = $user->data()->id;
	$record_types = ["server","mod"];

	// Get records and display them
	foreach ($record_types as $record_type) {
		$record_table  = $record_type=="server" ? "serv"   : "mods";
		$record_column = $record_type=="server" ? "server" : "mod";
		$sql           = "
			SELECT 
				gs_{$record_table}.uniqueid,
				gs_{$record_table}.name,
				gs_{$record_table}.logo,
				gs_{$record_table}_admins.*
				
			FROM 
				gs_{$record_table}, 
				gs_{$record_table}_admins 
				
			WHERE 
				gs_{$record_table}.removed       = 0 AND
				gs_{$record_table}_admins.userid = ? AND 
				gs_{$record_table}.id            = gs_{$record_table}_admins.{$record_column}id
				
			ORDER BY
				gs_{$record_table}.name
		";
		
		if ($gs_my_permission_level == GS_PERM_ADMIN)
			$sql = "
			SELECT 
				gs_{$record_table}.uniqueid,
				gs_{$record_table}.name,
				gs_{$record_table}.logo
				
			FROM 
				gs_{$record_table}
				
			WHERE 
				gs_{$record_table}.removed = 0
				
			ORDER BY
				gs_{$record_table}.name
			";

		if ($db->query($sql,[$uid])->error()) {
			if ($gs_my_permission_level == GS_PERM_ADMIN)
				echo $sql . $db->errorString();
			die("Failed to load {$record_type}s");
		}
		
		// Sort items into owned are someone else's
		$items     = $db->results(true);
		$my_items  = [];
		$our_items = [];
		
		foreach ($items as $key=>$item)
			if ($gs_my_permission_level == GS_PERM_ADMIN || $item["isowner"] == "1")
				$my_items[$key] = "";
			else
				$our_items[$key] = "";
		
		// Make a list of items
		$permission_to = [];
		
		foreach (GS_FORM_ACTIONS_BY_PAGE[$record_type] as $action)
			if ($action != "Add New")
				$permission_to[$action] = false;
		
		$my_tab_title  = lang($record_type=="server" ? "GS_STR_INDEX_MYSERVERS" : "GS_STR_INDEX_MYMODS");
		$our_tab_title = lang($record_type=="server" ? "GS_STR_INDEX_OURSERVERS" : "GS_STR_INDEX_OURMODS");
		$my_tab        = format_items($my_items, $items, $record_type, $record_column, $permission_to, $gs_my_permission_level);
		$our_tab       = format_items($our_items, $items, $record_type, $record_column, $permission_to, $gs_my_permission_level);
		
		// Add new button
		$button_text  = $record_type == "server" ? "GS_STR_INDEX_ADDNEW_SERVER" : "GS_STR_INDEX_ADDNEW_MOD";
		$button_class = $record_type == "server" ? "primary" : "mods";
		$limit        = $record_type == "server" ? GS_PERMISSION_MAX_SERVERS[$gs_my_permission_level] : GS_PERMISSION_MAX_MODS[$gs_my_permission_level];
		$button_html  = "";
		
		if (count($my_items) < $limit)
			$button_html = '<a href="edit_'.$record_type.'.php?display_form=Add%20New" class="btn btn-'.$button_class.' btn-sm" style="margin-top:1.5em;">'.lang($button_text).'</a>';
		else
			$button_html = '<div style="margin-top:1.5em;">'.lang("GS_STR_INDEX_LIMIT_REACHED").'</div>';
		
		$all_tab_title = $record_type == "server" ? lang("GS_STR_INDEX_SCHEDULE") : lang("GS_STR_INDEX_ALLMODS") ;
		
		// Display
		echo '
		<div class="index_section">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#my'.$record_type.'" aria-controls="my'.$record_type.'" role="tab" data-toggle="tab">'.$my_tab_title.'</a></li>
				<li role="presentation"><a href="#our'.$record_type.'" aria-controls="our'.$record_type.'" role="tab" data-toggle="tab">'.$our_tab_title.'</a></li>
				<li role="presentation"><a href="#all'.$record_type.'" aria-controls="all'.$record_type.'" role="tab" data-toggle="tab">'.$all_tab_title.'</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background active" id="my'.$record_type.'">'.$my_tab.$button_html.'</div>
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background" id="our'.$record_type.'">'.$our_tab.'</div>
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background" id="all'.$record_type.'">'.($record_type=="server"?$servers_html:$mods_html).'</div>
			</div>

		</div>';
	}
} else {
	echo '
	<div class="jumbotron">
		<h1 align="center">'.lang("GS_STR_INDEX_WELCOME").'</h1>
		<p align="center" class="text-muted">'.lang("GS_STR_INDEX_DESCRIPTION").'</p>
		<h3 align="center"><a href="quickstart">'.lang("GS_STR_INDEX_QUICKSTART").'</a></h3>
	</div>';
	
	echo '
	<div class="index_section">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#currentevents" aria-controls="currentevents" role="tab" data-toggle="tab">'.lang("GS_STR_INDEX_SCHEDULE").'</a></li>
			<li role="presentation"><a href="#allmods" aria-controls="all'.$record_type.'" role="tab" data-toggle="tab">'.lang("GS_STR_INDEX_ALLMODS").'</a></li>
		</ul>

		<div class="tab-content">
			<div role="tabpanel" class="tab-pane servers_background active" id="currentevents">'.$servers_html.'</div>
			<div role="tabpanel" class="tab-pane mods_background" id="allmods">'.$mods_html.'</div>
		</div>

	</div>';
}


// Recent activity
$exclude_list = [
	GS_LOG_SERVER_UPDATED,
	GS_LOG_SERVER_REVOKE_ACCESS,
	GS_LOG_MOD_REVOKE_ACCESS,
	GS_LOG_SERVER_SHARE_ACCESS,
	GS_LOG_MOD_SHARE_ACCESS,
	GS_LOG_SERVER_TRANSFER_ADMIN,
	GS_LOG_MOD_TRANSFER_ADMIN,
	GS_LOG_MOD_UPDATED,
	GS_LOG_MOD_SCRIPT_UPDATED,
	GS_LOG_MOD_SCRIPT_ADDED,
	GS_LOG_MOD_VERSION_UPDATED,
	GS_LOG_MOD_LINK_ADDED,
	GS_LOG_MOD_LINK_UPDATED,
	GS_LOG_MOD_LINK_DELETED
];

$table         = GS_get_activity_log(5, $exclude_list, false, $gs_my_permission_level);
$activity_html = "";

foreach($table as $row) {
	$description = $row["description"];

	if (isset($row["server_id"]))
		$description = str_replace($row["server_name"], "<a href=\"show.php?server={$row["server_id"]}\">{$row["server_name"]}</a>", $description);

	if (isset($row["mod_id"]))
		$description = str_replace($row["mod_name"], "<a href=\"show.php?mod={$row["mod_id"]}\">{$row["mod_name"]}</a>", $description);

	$activity_html .= '
	<div class="row">
		<div class="col-lg-3">'.date("l, jS F Y", $row["date"]).'</div>
		<div class="col-lg-9">'.$description.'</div>
	</div>';
}

echo '
<div class="index_section">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#recent_activity" aria-controls="recent_activity" role="tab" data-toggle="tab">'.lang("GS_STR_INDEX_RECENT").'</a>
		</li>
	</ul>

	<div class="tab-content">		
		<div role="tabpanel" class="tab-pane servers_background active" id="recent_activity">
			<div class="permalink_parent">
				<div class="permalink_child">
					<a href="recent_activity"><span class="glyphicon glyphicon-link"></span></a>
					<a href="rss"><span class="fa fa-rss"></span></a>
				</div>
			</div>
			'.$activity_html.'
		</div>
	</div>

</div>';


echo '<div class="index_section">';
languageSwitcher();
echo '</div>';


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

$locale_file = "en-gb";

switch(lang("THIS_CODE")) {
	case "ru-RU" : $locale_file="ru"; break;
	case "pl-PL" : $locale_file="pl"; break;
}
	
foreach($localized_strings as $key=>$value)
	$localized_strings[$key] = lang($value);
	
$recurrence_strings = [
	"GS_EVENT_SINGLE" => GS_EVENT_SINGLE,
	"GS_EVENT_WEEKLY" => GS_EVENT_WEEKLY,
	"GS_EVENT_DAILY"  => GS_EVENT_DAILY
];

// Show server status
$server_status_list = [];
foreach(GS_SERVER_STATUS as $string_key)
	$server_status_list[] = lang($string_key);

echo '
<script type="text/javascript" src="usersc/js/gs_functions.js"></script>
<script type="text/javascript" src="usersc/js/moment.js"></script>
<script type="text/javascript" src="usersc/js/'.$locale_file.'.js"></script>
<script type="text/javascript">
GS_convert_server_events('.json_encode($js_event_data).','.json_encode($localized_strings).','.json_encode($recurrence_strings).');
$(document).ready(function() {
	GS_query_game_server('.json_encode($js_serv_id).', '.json_encode($server_status_list).', '.json_encode($js_expired).', "summary")
});
</script>';
?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
