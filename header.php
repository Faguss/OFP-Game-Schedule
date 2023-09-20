<?php

// Userspice
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF']))
	die();

if (!$user->isLoggedIn())
	Redirect::to('users\login.php');

if (!Input::exists())
	Redirect::to('index.php');

$uid = $user->data()->id;

if (!Token::check($_POST["csrf"])) {
	Token::generate();
	echo "<div id=\"page-wrapper\"><div class=\"container\"><br><br><br><br><br><b>" . lang("GS_STR_ERROR_EXPIRED") . "</b><br><br><br>";
	#dump($_POST);
	die("</div></div>");
}



	
	
	
// Derive data type from page name
$record_type   = substr($_SERVER['PHP_SELF'],  strrpos($_SERVER['PHP_SELF'],'_')+1, -4);
$record_table  = $record_type=="server" ? "serv"   : "mods";
$record_column = $record_type=="server" ? "server" : "mod";





// Start form
require_once "common.php";
$gs_my_permission_level = GS_get_permission_level($user);

$form             = new Generated_Form(["uniqueid", "action", "display_form", "display_name", "display_subform"]);
$form->size       = 8;
$form->label_size = 3;
$form->input_size = 9;

if ($form->hidden["action"] == "Go Back")
	Redirect::to('index.php');

if ($form->hidden["display_subform"] == "")
	$form->hidden["display_subform"] = array_keys(GS_FORM_ACTIONS_MODUPDATE)[0];



// Get permissions
$sql = "
	SELECT 
		gs_{$record_table}_admins.*,
		gs_{$record_table}.id as id1,
		gs_{$record_table}.uniqueid,
		gs_{$record_table}.removed
		
	FROM 
		gs_{$record_table}, 
		gs_{$record_table}_admins 
		
	WHERE 
		gs_{$record_table}.id            = gs_{$record_table}_admins.{$record_column}id AND
		gs_{$record_table}_admins.userid = ?";

if ($gs_my_permission_level == GS_PERM_ADMIN)
	$sql = "
	SELECT 
		gs_{$record_table}.id as id1,
		gs_{$record_table}.uniqueid,
		gs_{$record_table}.removed
		
	FROM 
		gs_{$record_table}
		
	WHERE 
		gs_{$record_table}.id";
		
if ($db->query($sql,[$uid])->error()) {
	if ($gs_my_permission_level == GS_PERM_ADMIN)
		echo $sql . $db->errorString();
	die(lang("GS_STR_ERROR_GET_DB_RECORD"));
}

$my_records          = 0;
$record_deleted      = false;
$permission_to       = [];
$id                  = NULL;
$current_entry_owner = false;

if ($gs_my_permission_level == GS_PERM_ADMIN) {
	foreach (GS_FORM_ACTIONS_BY_PAGE[$record_type] as $name)
		$permission_to[$name] = true;
		
	foreach ($db->results(true) as $admin) {
		if ($form->hidden["uniqueid"] == $admin["uniqueid"])
			$id = $admin["id1"];
	}
} else {
	foreach (GS_FORM_ACTIONS_BY_PAGE[$record_type] as $name)
		$permission_to[$name] = false;

	// Check if user owns selected entry
	foreach ($db->results(true) as $admin) {
		$entry_id = $admin["{$record_column}id"];
		$owner    = $admin["isowner"] == "1";
		$exist    = !$admin["removed"];
		
		// unique key to primary key
		if ($form->hidden["uniqueid"] == $admin["uniqueid"])
			$id = $admin["id1"];
		
		if ($exist) {
			if ($owner)
				$my_records++;
			
			if ($id == $entry_id) {
				foreach ($permission_to as $key=>$value) {
					$column_name = "right_".strtolower($key);
					
					if ($owner) {
						$permission_to[$key] = true;
						$current_entry_owner = true;
					} else
						if (isset($admin[$column_name]))
							$permission_to[$key] = intval($admin[$column_name]);
						else
							$permission_to[$key] = false;
				}
			}
		} else
			if ($id == $entry_id)
				$record_deleted = true;
	}
}

$permission_to["Add New"] = $my_records < ($record_type=="server" ? GS_PERMISSION_MAX_SERVERS[$gs_my_permission_level] : GS_PERMISSION_MAX_MODS[$gs_my_permission_level]);


$navigation_menu = NULL;

// Show error message if there's no access
if (!$permission_to[$form->hidden["display_form"]]) {
	$message = lang($record_type=="server" ? "GS_STR_SERVER_NOPERM_ERROR" : "GS_STR_MOD_NOPERM_ERROR");
	
	if ($form->hidden["display_form"] == "Add New")
		$message = lang($record_type=="server" ? "GS_STR_SERVER_MAX_ERROR" : "GS_STR_MOD_MAX_ERROR");
	
	if ($record_deleted)
		$message = lang($record_type=="server" ? "GS_STR_SERVER_REMOVED_ERROR" : "GS_STR_MOD_REMOVED_ERROR");
	
	$form->fail($message);
} else
	if ($form->hidden["display_form"] != "Add New") {
		$button_class    = $record_type == "server" ? "primary" : "mods";
		$navigation_menu = new Generated_Form([], $form->hidden["csrf"], NULL, false);
		
		$navigation_menu->hidden["uniqueid"]     = $form->hidden["uniqueid"];
		$navigation_menu->hidden["display_name"] = $form->hidden["display_name"];
		$navigation_menu->label_size             = 0;
		
		foreach ($permission_to as $key=>$value)
			if ($value && $key!="Add New"  &&  $key!=$form->hidden["display_form"]) {
				$navigation_menu->add_button("display_form", $key, lang(GS_FORM_ACTIONS[$key]), "btn-$button_class btn-xs");
				$navigation_menu->change_control(-1, ["Inline"=>-1, "LabelClass"=>" "]);
			}
	}

?>

<?php if (isset($navigation_menu)) echo $navigation_menu->display(); ?>
