<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

?>
<div id="page-wrapper">
	<div class="container">
<?php
require_once "common.php";
$gs_my_permission_level = GS_get_permission_level($user);
$csrf = Session::get(Config::get('session/token_name'));

if (isset($user) && $user->isLoggedIn()) ;
	else languageSwitcher();

if(isset($user) && $user->isLoggedIn()){
	$uid          = $user->data()->id;
	$record_types = ["server","mod"];

	foreach ($record_types as $record_type) 
	{
		// Build a query and run it
		$record_table  = $record_type=="server" ? "serv"   : "mods";
		$record_column = $record_type=="server" ? "server" : "mod";
		$sql           = "
			SELECT 
				gs_{$record_table}.uniqueid,
				gs_{$record_table}.name,
				gs_{$record_table}_admins.*
				
			FROM 
				gs_{$record_table}, 
				gs_{$record_table}_admins 
				
			WHERE 
				gs_{$record_table}.removed       = 0 AND
				gs_{$record_table}_admins.userid = ? AND 
				gs_{$record_table}.id            = gs_{$record_table}_admins.{$record_column}id	
		";
		
		if ($gs_my_permission_level == GS_PERM_ADMIN)
			$sql = "
			SELECT 
				gs_{$record_table}.uniqueid,
				gs_{$record_table}.name
				
			FROM 
				gs_{$record_table}
				
			WHERE 
				gs_{$record_table}.removed = 0";

		if ($db->query($sql,[$uid])->error()) {
			if ($gs_my_permission_level == GS_PERM_ADMIN)
				echo $sql . $db->errorString();
			die("Failed to load {$record_type}s");
		}
		
		$items         = $db->results(true);
		$permission_to = [];
		$my_item_count = 0;	
		
		foreach (GS_FORM_ACTIONS_BY_PAGE[$record_type] as $action)
			if ($action != "Add New")
				$permission_to[$action] = false;
			
		$display_my    = "
		<div class=\"col-lg-6\">
			<div class=\"page-header\"><h2>" .lang($record_type=="server" ? "GS_STR_INDEX_MYSERVERS" : "GS_STR_INDEX_MYMODS"). ":</h2></div>
			<div class=\"panel panel-default\">
				<div class=\"panel-body {$record_type}s_background\">";
			
		$display_shared = "<div class=\"col-lg-6\">";
		$button_class   = $record_type == "server" ? "primary" : "mods";
		$php_script     = "edit_{$record_type}.php";
		

		// Go through results and create forms
		foreach ($items as $item) {
			$form    = new Generated_Form([], $csrf, $php_script, false);
			$display = "";
			$label   = $item["name"]!="" ? $item["name"] : $item["uniqueid"];
			$owner   = $gs_my_permission_level == GS_PERM_ADMIN  ||  $item["isowner"] == "1";
			
			$form->hidden["uniqueid"]     = $item["uniqueid"];
			$form->hidden["display_name"] = $label;

			foreach ($permission_to as $permission=>$value)
				if ($owner || isset($item["right_".strtolower($permission)]) &&  $item["right_".strtolower($permission)] && !in_array($permission,GS_FORM_ACTIONS_NON_SHAREABLE)) {
					$form->add_button("display_form", $permission, lang(GS_FORM_ACTIONS[$permission]), "btn-$button_class btn-xs");
					$form->change_control(-1, ["Label"=>$label, "Inline"=>-1, "LabelClass"=>" "]);
				}
			
			if (count($form->controls) > 0) {
				$form->change_control(-1, ["CloseInline"=>true]);
			
				if ($owner) {
					$display_my .= $display . $form->display();
					$my_item_count++;
				} else {
					if (strpos($display_shared,"<h2>") === false)
						$display .= "
							<div class=\"page-header\"><h2>".lang($record_type=="server" ? "GS_STR_INDEX_OURSERVERS" : "GS_STR_INDEX_OURMODS").":</h2></div>
							<div class=\"panel panel-default\">
								<div class=\"panel-body {$record_type}s_background\">";
					
					$display_shared .= $display . $form->display();
				}
			}
		}
	
		$limit = $record_type=="server" ? GS_PERMISSION_MAX_SERVERS[$gs_my_permission_level] : GS_PERMISSION_MAX_MODS[$gs_my_permission_level];		
		$form  = new Generated_Form([], $csrf, $php_script, false, "form-inline");
		
		if ($my_item_count < $limit)
			$form->add_button("display_form", "Add New", lang($record_type=="server" ? "GS_STR_INDEX_ADDNEW_SERVER" : "GS_STR_INDEX_ADDNEW_MOD"), "btn-$button_class btn-sm");
		else {
			$form->add_text("limitreached", "");
			$form->change_control(-1, ["Type"=>"Static", "Text"=>lang("GS_STR_INDEX_LIMIT_REACHED")]);
		}
		
		$display_my .= $form->display();
		
		
		
		$display_my .= "
				</div><!-- end panel body -->
			</div><!-- end panel -->
		</div><!-- end column -->\n";

		if (strpos($display_shared,"<h2>") !== false)
			$display_shared .= "
				</div><!-- end panel body -->
			</div><!-- end panel -->";

		$display_shared .= "
		</div><!-- end column -->\n";

		echo "<div CLASS=\"row\">" . $display_my . $display_shared . "</div><!-- end row -->\n\n<hr style=\"margin-bottom: 40px;\">";
	}
} else {
	echo "
	<div class=\"jumbotron\">
		<h1 align=\"center\">".lang("GS_STR_INDEX_WELCOME")."</h1>
		<p align=\"center\" class=\"text-muted\">".lang("GS_STR_INDEX_DESCRIPTION")."</p>
		<h3 align=\"center\"><a href=\"quickstart\">".lang("GS_STR_INDEX_QUICKSTART")."</a></h3>
	</div>
	
	<div class=\"gs_section_title\">".lang("GS_STR_INDEX_UPCOMING")."</div>";
}
	

// Get servers and mods
$servers    = GS_list_servers(["current"], [], GS_REQTYPE_WEBSITE, 0, $lang["THIS_LANGUAGE"], $user);
$mods       = GS_list_mods($servers["mods"], [], [], [], GS_REQTYPE_WEBSITE, $servers["lastmodified"]);

// Split server list into servers with events and without
$persistent = ["info"=>[], "mods"=>$servers["mods"], "id"=>[], "lastmodified"=>$servers["lastmodified"], "rights"=>$servers["rights"]];
$todelete   = [];

forEach ($servers["info"] as $index=>$server) {
	if (count($server["events"]) == 0) {
		$persistent["info"][$index] = $server;
		$persistent["id"][$index]   = $servers["id"][$index];
		$todelete[$index]           = $index;
	}
}

$servers["info"] = array_diff_key($servers["info"], $todelete);
$servers["id"]   = array_diff_key($servers["id"], $todelete);


// Show servers
echo "<div class=\"row\">" . GS_format_server_info($servers, $mods, 12) . "</div>";

if (count($persistent["info"]) > 0) {
	echo "<div class=\"gs_section_title\">".lang("GS_STR_INDEX_PERSISTENT")."</div>";
	echo "<div class=\"row\">" . GS_format_server_info($persistent, $mods, 12) . "</div>";
}

if (isset($user) && $user->isLoggedIn())
	echo "<hr style=\"margin-bottom: 40px;\">";
else
	echo "<br><div class=\"gs_section_title gs_section_title_mods\">".lang("GS_STR_INDEX_ALLMODS")."</div>";
	
$sql = "
	SELECT 
		gs_mods.name,
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

$items             = $db->results(true);
$number_of_columns = 4;
$number_of_rows    = count($items) / $number_of_columns;
$columns_id        = [];
$columns_name      = [];

for ($i=0; $i<$number_of_columns; $i++) {
	$columns_id[$i]   = [];
	$columns_name[$i] = [];
}

$i = 0;
foreach ($items as $item) {
	$columns_id[$i][]   = $item["uniqueid"];
	$columns_name[$i][] = $item["name"];
	
	if (count($columns_id[$i]) >= $number_of_rows)
		$i++;
}

echo "
<div class=\"panel panel-default gs_section_title_border\">
<div class=\"panel-body mods_background\" style=\"display:flex;\">
<table style=\"table-layout:fixed;width:100%\">";

$current_column = 0;
$current_row    = 0;

for ($current_row=0; $current_row<$number_of_rows; $current_row++) {
	echo "<tr>";

	for($current_column=0; $current_column<$number_of_columns; $current_column++)
		echo "<td><a href=\"show.php?mod={$columns_id[$current_column][$current_row]}\" target=\"_blank\">{$columns_name[$current_column][$current_row]}</a></td>";

	echo "</tr>";
}

echo "</table>

<div>
	<a href=\"allmods\"><span class=\"glyphicon glyphicon-link\"></span></a>
</div>

</div>
</div>";

if (isset($user) && $user->isLoggedIn())
	echo "<hr style=\"margin-bottom: 40px;\">";
else
	echo "<br><div class=\"gs_section_title\">".lang("GS_STR_INDEX_RECENT")."</div>";

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


echo "	<div class=\"row\">		
			<div class=\"col-lg-12\">
				<div class=\"panel panel-default gs_section_title_border\">
					<div class=\"panel-body servers_background\" style=\"display:flex;\">
					<table style=\"width:100%\">
";

$table = GS_get_activity_log(5, $exclude_list, false, $gs_my_permission_level);

foreach($table as $row) {
	$description = $row["description"];

	if (isset($row["server_id"]))
		$description = str_replace($row["server_name"], "<a href=\"show.php?server={$row["server_id"]}\">{$row["server_name"]}</a>", $description);

	if (isset($row["mod_id"]))
		$description = str_replace($row["mod_name"], "<a href=\"show.php?mod={$row["mod_id"]}\">{$row["mod_name"]}</a>", $description);

	echo "<tr>
	<td>".date("l, jS F Y", $row["date"])."</td>
	<td>$description</td>
	</tr>";
}

echo "
</table>

<div>
	<a href=\"recent_activity\"><span class=\"glyphicon glyphicon-link\"></span></a>
	<br>
	<a href=\"rss\"><span class=\"fa fa-rss\"></span></a>
</div>

</div></div></div></div>";

echo "<br><br>";
if (isset($user) && $user->isLoggedIn())
	languageSwitcher();
?>

	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
