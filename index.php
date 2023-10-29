<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

require_once "common.php";

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
			$item    = $items[$key];
			$owner   = $gs_my_permission_level == GS_PERM_ADMIN  ||  $item["isowner"] == "1";
			$include = false;
			
			foreach ($permission_to as $permission=>$value)
				if ($owner || isset($item["right_".strtolower($permission)]) &&  $item["right_".strtolower($permission)] && !in_array($permission,GS_FORM_ACTIONS_NON_SHAREABLE)) {
					$include = true;
					break;
				}
				
			if (!$include)
				continue;
			
			$total_items++;
			$html .= '
			<div class="col-lg-'.$column_size.'">
				<div class="media">
					<div class="media-left">
						'.GS_output_item_logo($record_type, $item["logo"]).'
					</div>
					<div class="media-body media-middle">
						'.GS_show_dropdown_controls($item, $record_type, $permission_to, $gs_my_permission_level).'
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
		
function compare_two_servers($a, $b) {
	foreach(['date','players','status','name'] as $key) {
		$func = $key=='name' ? "strnatcasecmp" : "strcmp";
		$cmp  = $func($a[$key], $b[$key]);
		
		if ($cmp != 0)
			return $cmp * ($key=='name' ? 1 : -1);
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
$servers_html = '
	<div class="permalink_parent">
		<div class="permalink_child">
			<a href="allservers"><span class="glyphicon glyphicon-link"></span></a>
			<a href="rss?server=all"><span class="fa fa-rss"></span></a>
		</div>
	</div>';

$all_events    = [];
$persistent    = [];
$js_event_data = [];
$js_serv_id    = [];
$js_expired    = [];

foreach($servers["info"] as $server_key=>$server) {
	$player_count   = 0;
	$current_status = 0;
	$status_query   = json_decode($server["status"]);
	$server_name    = GS_trim_servermod_name(empty($server["name"]) ? $server["uniqueid"] : $server["name"]);
	
	if (isset($status_query->gstate))
		$current_status = intval($status_query->gstate);

	if (isset($status_query->numplayers))
		$player_count = intval($status_query->numplayers);
	
	if ($server["persistent"]) {	
		$persistent[] = [
			"date"    => 0, 
			"players" => $player_count, 
			"status"  => $current_status, 
			"name"    => $server_name, 
			"key"     => $server_key
		];
	} else {		
		foreach($server["events"] as $event_key=>$event) {
			$event_date   = new DateTime($event["iso8601"]);
			$all_events[] = [
				"date"    => $event_date->getTimestamp(), 
				"players" => $player_count, 
				"status"  => $current_status, 
				"name"    => $server_name, 
				"key"     => ["server"=>$server_key, "event"=>$event_key]
			];
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
		$status      = GS_parse_game_server_status($server["status"]);
		
		$server_mods = [];
		foreach($server["mods"] as $mod_id)
			$server_mods[] = '<a target="_blank" href="show.php?mod='.$mods["info"][$mod_id]["uniqueid"].'">'.$mods["info"][$mod_id]["name"].'</a>';
		
		$servers_html .= '
		<div class="row">
			<div class="col-lg-4">
				<div class="media">
					<div class="media-left">
						'.GS_output_item_logo("server", $server["logo"]).'
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
		$status       = GS_parse_game_server_status($server["status"]);
		
		$server_mods = [];
		foreach($server["mods"] as $mod_id)
			$server_mods[] = '<a target="_blank" href="show.php?mod='.$mods["info"][$mod_id]["uniqueid"].'">'.$mods["info"][$mod_id]["name"].'</a>';
		
		$servers_html .= '
		<div class="row">
			<div class="col-lg-4">
				<div class="media">
					<div class="media-left">
						'.GS_output_item_logo("server", $server["logo"]).'
					</div>
					<div class="media-body media-middle">
						<a target="_blank" href="show.php?server='.$server["uniqueid"].'">'.$server_name.'</a>
					</div>
				</div>
			</div>
			<div class="col-lg-8" id="query'.$server["uniqueid"].'">'.$status["summary"].'</div>
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
usort($items, 'GS_compare_names_with_trim');

$sorted    = sort_into_columns($items);
$mods_html = '
	<div class="permalink_parent">
		<div class="permalink_child">
			<a href="allmods"><span class="glyphicon glyphicon-link"></span></a>
			<a href="rss?mod=all"><span class="fa fa-rss"></span></a>
		</div>
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
					'.GS_output_item_logo("mod", $item["logo"]).'
				</div>
				<div class="media-body media-middle">
					<a href="show.php?mod='.$item["uniqueid"].'" target="_blank">'.$mod_name.'</a>
				</div>
			</div>
		</div>';
	}

	$mods_html .= '</div><!-- end row -->';
}


$js_faq_sections = [];

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
				gs_{$record_table}.access,
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
				gs_{$record_table}.logo,
				gs_{$record_table}.access
				
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
		
		$items = $db->results(true);
		usort($items, 'GS_compare_names_with_trim');
		
		// Sort items into owned and shared
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
		
		$tab_all_id = $record_type=="mod" ? "allmods" : "currentevents";
		
		// Display
		echo '
		<div class="index_section">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#my'.$record_type.'" aria-controls="my'.$record_type.'" role="tab" data-toggle="tab">'.$my_tab_title.'</a></li>
				<li role="presentation"><a href="#our'.$record_type.'" aria-controls="our'.$record_type.'" role="tab" data-toggle="tab">'.$our_tab_title.'</a></li>
				<li role="presentation"><a href="#'.$tab_all_id.'" aria-controls="'.$tab_all_id.'" role="tab" data-toggle="tab">'.$all_tab_title.'</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background active" id="my'.$record_type.'">'.$my_tab.$button_html.'</div>
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background" id="our'.$record_type.'">'.$our_tab.'</div>
				<div role="tabpanel" class="tab-pane '.$record_type.'s_background" id="'.$tab_all_id.'">'.($record_type=="server"?$servers_html:$mods_html).'</div>
			</div>

		</div>';
	}
} else {
	// FAQ Stringtable
	if ($lang["THIS_CODE"] == "en-US") {
		$lang = array_merge($lang, array(
			#Section titles
			"GS_FAQ_SECTION1_TITLE" => "What is OFP Game Schedule?",
			"GS_FAQ_SECTION2_TITLE" => "How does it work?",
			"GS_FAQ_SECTION3_TITLE" => "How do the mods work?",
			"GS_FAQ_SECTION4_TITLE" => "Why use OFP Game Schedule?",
			
			#What is OFP Game Schedule? 
			"GS_FAQ_SECTION1_PAR1" => "OFP Game Schedule is a system facilitating arrangement of multiplayer sessions for the 2001 video game Operation Flashpoint (made by Bohemia Interactive) and its 2011 re-release ARMA: Cold War Assault",
			"GS_FAQ_SECTION1_PAR2" => "The OFP GS website is a database of servers and mods. Players, after installing required game extensions, can browse them in the OFP's main menu, download mods and connect to the servers",
			
			#How does it work?
			"GS_FAQ_SECTION2_PAR1" => "Person organizing an event logs in to the website. They can do it via Steam so the entire setup can be done from the Steam game overlay",
			"GS_FAQ_SECTION2_PAR2" => "They add information about the server that the game will take place on (IP address, game time, mods)",
			"GS_FAQ_SECTION2_PAR3" => "Players install Fwatch 1.16 with OFP Aspect Ratio pack 2.07. Server will show up in the Game Schedule menu. From there they'll be able to download required mods and join the server",
			
			#How do the mods work?
			"GS_FAQ_SECTION3_PAR1" => "OFP Game Schedule is also a package manager for OFP mods. Users may register new mods on the website",
			"GS_FAQ_SECTION3_PAR2" => "They submit instructions on how to install their mod. It may be as simple as a single download link or they might micromanage specific files using scripting commands",
			"GS_FAQ_SECTION3_PAR3" => "Players install mods from the game using <a target=\"_blank\" href=\"https://ofp-faguss.com/fwatch/modmanager\">Mods</a> menu or the Game Schedule menu (when a mod is assigned to a server)",
			"GS_FAQ_SECTION3_PAR4" => "Mods can be updated and players will see a notification in the game's main menu",
			
			#Why use OFP Game Schedule?
			"GS_FAQ_SECTION4_PAR1" => "Joining server with a single button. No need to type ip address, password and mods",
			"GS_FAQ_SECTION4_PAR2" => "Joining on time. Players may add event to the Windows Task Scheduler so that they won't miss it",
			"GS_FAQ_SECTION4_PAR3" => "Joining with voice. Automatically connect to a TeamSpeak3 or a Mumble server when joining the OFP server",			
			"GS_FAQ_SECTION4_PAR4" => "Automatic mod installation. No need to send links and instructions to players",
			"GS_FAQ_SECTION4_PAR5" => "Custom mod faces. User's face texture may be stored in a modfolder and it will be automatically activated",
			"GS_FAQ_SECTION4_PAR6" => "Disabling custom files when necessary. Players don't have to worry about their custom files preventing them from joining a server",
			"GS_FAQ_SECTION4_PAR7" => "Faster loading. Modfolders can now store the missions so that players don't have to download them during the game",
			"GS_FAQ_SECTION4_PAR8" => "Server security. If the server is behind password then the only way to connect is through the Game Schedule menu. Website encrypts the password. This way users with wrong mods won't crash the server by joining it",
		));
	}

	if ($lang["THIS_CODE"] == "pl-PL") {
		$lang = array_merge($lang, array(
			#Section titles
			"GS_FAQ_SECTION1_TITLE" => "Co to jest Rozkład Rozgrywek do OFP?",
			"GS_FAQ_SECTION2_TITLE" => "Jak to działa?",
			"GS_FAQ_SECTION3_TITLE" => "Jak działają mody?",
			"GS_FAQ_SECTION4_TITLE" => "Po co używać Rozkład Rozgrywek do OFP?",
			
			#What is OFP Game Schedule? 
			"GS_FAQ_SECTION1_PAR1" => "Rozklad Rozgrywek do OFP to system ułatwiający organizowanie sesji sieciowych do gry Operation Flashpoint (stworzonej przez Bohemia Interactive w 2001) oraz jej reedycji ARMA: Cold War Assault z 2011",
			"GS_FAQ_SECTION1_PAR2" => "Strona Rozkładu Rozgrywek do OFP to baza danych serwerów i modów. Gracze, po zainstalowaniu wymaganych rozszerzeń gry, mogą je przeglądać w menu głównym OFP, ściągać mody i podłączać się do serwerów",
			
			#How does it work?
			"GS_FAQ_SECTION2_PAR1" => "Osoba organizująca sesję loguje się do strony. Mogą to zrobić poprez Steam dzięki czemu wszystko można ustawić z poziomu Nakładki Steam",
			"GS_FAQ_SECTION2_PAR2" => "Dodaje informacje o serwerze na którym będzie toczyła się gra (adres IP, czas gry, mody)",
			"GS_FAQ_SECTION2_PAR3" => "Gracze instalują Fwatch 1.16 z paczką OFP Aspect Ratio 2.07. Serwer pojawi się w menu Rozkład Rozgrywek. Stamtąd gracze będą mogli pobrać wymagane mody i dołączyć do serwera",
			
			#How do the mods work?
			"GS_FAQ_SECTION3_PAR1" => "Rozkład Rozgrywek do OFP to także system zarządzania modami do OFP. Użytkownicy mogą zarejestrować nowe mody na stronie",
			"GS_FAQ_SECTION3_PAR2" => "Wpisują instrukcje instalacji modu. Może to być po prostu pojedynczy link do wymaganego pliku albo mogą też zarządzać konkretnymi plikami przy użyciu komend skryptowych",
			"GS_FAQ_SECTION3_PAR3" => "Greacze instalują mody z poziomu gry używając menu <a target=\"_blank\" href=\"https://ofp-faguss.com/fwatch/modmanager\">Mods</a> lub menu Rozkład Rozgrywek (gdy mod został przypisany do serwera)",
			"GS_FAQ_SECTION3_PAR4" => "Mody mogą być aktualizowane i gracze zobaczą powiadomienie w menu głównym gry",
			
			#Why use OFP Game Schedule?
			"GS_FAQ_SECTION4_PAR1" => "Dołączanie do serwera jednym przyciskiem. Nie trzeba pisać adresu ip, hasła i linii modów",
			"GS_FAQ_SECTION4_PAR2" => "Dołączanie o czasie. Gracze mogą dodać sesję do Harmonogramu Windows dzięki czemu jej nie przegapią",
			"GS_FAQ_SECTION4_PAR3" => "Dołączanie z czatem głosowym. Automatyczne podłączanie się do serwera TeamSpeak3 lub Mumble przy dołączaniu do serwera OFP",
			"GS_FAQ_SECTION4_PAR4" => "Automatyczna instalacja modów. Nie ma potrzeby rozsyłania graczom linków do ściągnięcia modu i instrukcji",
			"GS_FAQ_SECTION4_PAR5" => "Twarze w modach. Własna tekstura twarzy może być przechowywana w modfolderze i będzie aktywowana automatycznie",
			"GS_FAQ_SECTION4_PAR6" => "Disabling custom files when necessary. Players don't have to worry about their custom files preventing them from joining a server",
			"GS_FAQ_SECTION4_PAR7" => "Szybsze ładowanie. Modfoldery mogą teraz przechowywać misje dzięki czemu gracze nie będą musieli ich ściągać podczas rozgrywki",
			"GS_FAQ_SECTION4_PAR8" => "Bezpieczeństwo serwera. Jeśli serwer jest na hasło to można się do niego podłączyć jedynie poprzez menu Rozkład Rozgrywek. Strona szyfruje hasło. W ten sposób użytkownicy z nieprawidłowymi modami nie wejdą do serwera i go nie zawieszą",
		));
	}

	if ($lang["THIS_CODE"] == "ru-RU") {
		$lang = array_merge($lang, array(
			#Section titles
"GS_FAQ_SECTION1_TITLE" => "What is OFP Game Schedule?",
"GS_FAQ_SECTION2_TITLE" => "How does it work?",
"GS_FAQ_SECTION3_TITLE" => "How do the mods work?",
"GS_FAQ_SECTION4_TITLE" => "Why use OFP Game Schedule?",
			
			#What is OFP Game Schedule? 
"GS_FAQ_SECTION1_PAR1" => "OFP Game Schedule is a system facilitating arrangement of multiplayer sessions for the 2001 video game Operation Flashpoint (made by Bohemia Interactive) and its 2011 re-release ARMA: Cold War Assault",
"GS_FAQ_SECTION1_PAR2" => "The OFP GS website is a database of servers and mods. Players, after installing required game extensions, can browse them in the OFP's main menu, download mods and connect to the servers",
			
			#How does it work?
"GS_FAQ_SECTION2_PAR1" => "Person organizing an event logs in to the website. They can do it via Steam so the entire setup can be done from the Steam game overlay",
"GS_FAQ_SECTION2_PAR2" => "They add information about the server that the game will take place on (IP address, game time, mods)",
"GS_FAQ_SECTION2_PAR3" => "Players install Fwatch 1.16 with OFP Aspect Ratio pack 2.07. Server will show up in the Game Schedule menu. From there they'll be able to download required mods and join the server",
			
			#How do the mods work?
"GS_FAQ_SECTION3_PAR1" => "OFP Game Schedule is also a package manager for OFP mods. Users may register new mods on the website",
"GS_FAQ_SECTION3_PAR2" => "They submit instructions on how to install their mod. It may be as simple as a single download link or they might micromanage specific files using scripting commands",
"GS_FAQ_SECTION3_PAR3" => "Players install mods from the game using <a target=\"_blank\" href=\"https://ofp-faguss.com/fwatch/modmanager\">Mods</a> menu or the Game Schedule menu (when a mod is assigned to a server)",
"GS_FAQ_SECTION3_PAR4" => "Mods can be updated and players will see a notification in the game's main menu",
			
			#Why use OFP Game Schedule?
"GS_FAQ_SECTION4_PAR1" => "Joining server with a single button. No need to type ip address, password and mods",
"GS_FAQ_SECTION4_PAR2" => "Joining on time. Players may add event to the Windows Task Scheduler so that they won't miss it",
"GS_FAQ_SECTION4_PAR3" => "Joining with voice. Automatically connect to a TeamSpeak3 or a Mumble server when joining the OFP server",			
"GS_FAQ_SECTION4_PAR4" => "Automatic mod installation. No need to send links and instructions to players",
"GS_FAQ_SECTION4_PAR5" => "Custom mod faces. User's face texture may be stored in a modfolder and it will be automatically activated",
"GS_FAQ_SECTION4_PAR6" => "Disabling custom files when necessary. Players don't have to worry about their custom files preventing them from joining a server",
"GS_FAQ_SECTION4_PAR7" => "Faster loading. Modfolders can now store the missions so that players don't have to download them during the game",
"GS_FAQ_SECTION4_PAR8" => "Server security. If the server is behind password then the only way to connect is through the Game Schedule menu. Website encrypts the password. This way users with wrong mods won't crash the server by joining it",
		));
	}
	
	echo '
	<div class="well">
		<h1 class="text-center">'.lang("GS_STR_INDEX_WELCOME").'</h1>
		<p class="text-muted text-center">'.lang("GS_STR_INDEX_DESCRIPTION").'</p>
		<img class="img-responsive" src="images/index_main_graphic.png">
		<div class="row">
			<div class="col-lg-2 col-lg-offset-4">
				<h3 class="text-center">
				<a style="cursor:pointer" onclick="$(\'#FAQ\').collapse(\'toggle\')">'.lang("GS_STR_INDEX_LEARN_MORE").'</a>
				</h3>
			</div>
			<div class="col-lg-2">
				<h3 class="text-center">
				<a href="quickstart">'.lang("GS_STR_INDEX_QUICKSTART").'</a>
				</h3>
			</div>
		</div>
	</div>';
	
	$faq = [
		[
			"id"=>"whatisofpgs",
			"paragraphs"=>[
				["image"=>"ofp_cwa_logo.jpg","alt"=>"Game Logo"],
				["image"=>"ofp_extra_menu.jpg","alt"=>"Main Menu"]
			],
		],
		[
			"id"=>"howdoesitwork",
			"paragraphs"=>[
				["image"=>"ofp_steam_login.jpg","alt"=>"Steam Login"],
				["image"=>"website_server_options.png","alt"=>"Server details"],
				["image"=>"ofp_test_server_options.jpg","alt"=>"Joining server"],
			],
		],
		[
			"id"=>"howdothemodswork",
			"paragraphs"=>[
				["image"=>"website_add_new_mod.png","alt"=>"Add Mod"],
				["image"=>"website_installation_scripts.png","alt"=>"Installation script"],
				["image"=>"ofp_mod_menu.jpg","alt"=>"Mod menu"],
				["image"=>"ofp_available_mod_updates.jpg","alt"=>"Available updates"],
			],
		],
		[
			"id"=>"whyuseofpgs",
			"paragraphs"=>[
				["image"=>"ofp_test_server_options.jpg","alt"=>"Joining server"],
				["image"=>"windows_task_scheduler.png","alt"=>"Scheduler"],
				["image"=>"ofp_with_ts3.jpg","alt"=>"VOIP"],
				["image"=>"ofp_mod_installation.jpg","alt"=>"Mod installation"],
				["image"=>"custom_mod_face.jpg","alt"=>"Face"],
				["image"=>"custom_sounds.png","alt"=>"Custom sounds"],
				["image"=>"ofp_briefing.jpg","alt"=>"Briefing"],
				["image"=>"ofp_locked_server.jpg","alt"=>"Locked server"],
			],
		]
	];

	echo '
	<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
	<div class="collapse" id="FAQ">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

	foreach($faq as $key => $section) {
		$section_number    = $key + 1;
		$js_faq_sections[] = $section["id"];
		
		echo '
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="FAQ_section'.$section_number.'">
				<h4 class="panel-title">
				<a '.($section_number!=1?'class="collapsed"':'').' role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$section["id"].'" aria-expanded="'.($section_number==1 ? "true" : "false").'" aria-controls="'.$section["id"].'">
				'.lang("GS_FAQ_SECTION".$section_number."_TITLE").'
				</a>
			</h4>
			</div>
			<div id="'.$section["id"].'" class="panel-collapse collapse '.($section_number==1?'in':'').'" role="tabpanel" aria-labelledby="FAQ_section'.$section_number.'">
				<div class="panel-body">
		';
		
		foreach($section["paragraphs"] as $pkey => $paragraph) {
			$paragraph_number = $pkey + 1;
			$left             = $paragraph_number % 2;
			$thumbnail        = substr_replace($paragraph["image"], "_300", -4, 0);
			$paragraph_text   = lang("GS_FAQ_SECTION".$section_number."_PAR".$paragraph_number);
			
			if ($section_number == 4) {
				$heading_end = strpos($paragraph_text, ".");
				if ($heading_end !== FALSE) {
					$paragraph_text = '<h4 class="media-heading">' . substr($paragraph_text,0,$heading_end) . '</h4><p class="faq_paragraph faq_paragraph_smaller">' . substr($paragraph_text,$heading_end+2) . '</p>';
				}
			} else {
				$paragraph_text = '<p class="faq_paragraph">'.$paragraph_text.'</p>';
			}

			$html_img = '<a target="_blank" href="images/index/'.$paragraph["image"].'"><img class="media-object faq_image" src="images/index/'.$thumbnail.'" alt="'.$paragraph["alt"].'"></a>';
			$html_txt = '<div class="media-body media-middle">'.$paragraph_text.'</div>';
			
			echo '<div class="media '.($left?"":"text-right").'">';
			
			if ($left)
				echo '<div class="media-left">'.$html_img.'</div>'.$html_txt;
			else
				echo $html_txt.'<div class="media-right">'.$html_img.'</div>';
			
			echo '</div><!-- end media -->';
		}
		
		echo '
				</div><!-- end panel body -->
			</div><!-- end panel collaspse -->
		</div><!-- end panel -->
		';
	}

	echo '
	</div><!-- end panel group -->
	</div><!-- end collapse -->
	</div><!-- end column -->
	</div><!-- end row -->';

	echo '
	<div class="index_section">
		<ul id="main_info_tabs" class="nav nav-tabs" role="tablist">
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
		<div class="col-lg-3 recentactivity">'.date(DATE_ISO8601, $row["date"]).'</div>
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
	GS_query_game_server('.json_encode($js_serv_id).', '.json_encode($server_status_list).', '.json_encode($js_expired).', "summary");
	GS_localize_date(\'recentactivity\');
	
	let url = location.href.replace(/\/$/, "");
	let faq_sections = '.json_encode($js_faq_sections).'
	
	if (location.hash) {
		const hash  = url.split("#");
		let element = "";

		if (faq_sections.includes(hash[1])) {
			element = $(\'#FAQ\')[0];
			element.collapse(\'show\');
			$(\'#whatisofpgs\').collapse(\'hide\');
			$(\'#\'+hash[1]).collapse(\'show\');
		}
		
		if (hash[1] == "allmods") {
			let item = $(\'a[href="#allmods"]\');
			item.tab("show");
			element = item[0];
		}
		
		if (hash[1] == "recent_activity") {
			element = $(\'#recent_activity\')[0];
		}
		
		if (element) {
			const y = element.getBoundingClientRect().top + window.scrollY;
			window.scroll({top:y, behavior:\'smooth\'});
		}
	} 
});
</script>';
?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
