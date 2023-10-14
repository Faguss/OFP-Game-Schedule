<?php

// Userspice
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF']))
	die();

require_once "common.php";
$Parsedown = new Parsedown();
languageSwitcher();
?>

<DIV ID="page-wrapper">
<DIV CLASS="container">

<?php
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
			gs_mods.createdby,
			gs_mods.website,
			gs_mods.logo,
			users.username AS addedby
			
		FROM 
			gs_mods,
			users
					   
		WHERE
			gs_mods.createdby = users.id AND
			gs_mods.removed   = 0 AND 
			gs_mods.access    = ''
					   
		ORDER BY 
			gs_mods.name
	";
	
	$db->query($sql_allmods);
	
	$modfolders    = $db->results(true);
	$modfolders_id = [];
	
	foreach ($modfolders as $key=>$value)
		$modfolders_id[] = $value["id"];


	// Sort mods
	$mod_labels = [];
	$anchors    = ["replacement", "addonpack", "supplement", "missionpack", "tools"];
	for ($i=0; $i<=GS_MOD_TYPE_NUM; $i++)
		$mod_labels[] = lang("GS_STR_MOD_TYPE{$i}");
	
	foreach ($mod_labels as $label)
		$mods_to_add[$label] = [];
		
	foreach ($modfolders as $key=>$value) {
		$label                 = lang("GS_STR_MOD_TYPE{$value["type"]}");
		$mods_to_add[$label][] = $key;
		$added_labels[$label]  = true;
	}


	// Display tables
	$html = "";
	foreach ($mod_labels as $key=>$label) {
		$label_description = "";
		
		for ($i=0; $i<=GS_MOD_TYPE_NUM; $i++)
			if ($label == lang("GS_STR_MOD_TYPE{$i}"))
				$label_description = ucfirst(lang("GS_STR_MOD_TYPE{$i}_DESC"));

		$section_name = "mod_table_$key";
		
		$html .= "
		<a name=\"{$anchors[$key]}\"></a><br><br><br>
		<div id=\"$section_name\">
		<h1>$label (".count($mods_to_add[$label]).")</h1>
		<h4>$label_description</h4>
		<table class=\"table table-mods-striped table-bordered table-hover\">
			<tr>
				<th></th>
				<th>".lang("GS_STR_MOD")."</th>
				<th>".lang("GS_STR_MOD_DESCRIPTION")."</th>
				<th>".ucfirst(lang("GS_STR_ADDED_BY"))."</th>
				<th></th>
				<th></th>
			</tr>
			";
			
		foreach ($mods_to_add[$label] as $i) {
			if (!isset($modfolders[$i]["name"]) || !isset($modfolders[$i]["uniqueid"]))
				continue;
			
			$html .= "
			<tr>
				<td>";
			
			if (!empty($modfolders[$i]["logo"]) && substr($modfolders[$i]["logo"], -3)!="paa")
				$html .= "<img width=64 height=64 src=\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$modfolders[$i]["logo"]}\">";
			else
				$html .= "<img src=\"images\\placeholder\\placeholder_mod_64.png\">";
				
			$html .= "
				</td>
				<td><b>{$modfolders[$i]["name"]}</b></td>
				<td>". $Parsedown->line($modfolders[$i]["description"]) ."</td>
				<td>{$modfolders[$i]["addedby"]}</td>
				<td><a target='_blank' href=\"show.php?mod={$modfolders[$i]["uniqueid"]}\"><span class=\"glyphicon glyphicon-link\"></span></a></td>
				<td>";
				
			if (!empty($modfolders[$i]["website"]))
				$html .= "<a target='_blank' href=\"{$modfolders[$i]["website"]}\"><span class=\"glyphicon glyphicon-globe\"></span></a>";
				
			$html .= "</td></tr>";
		}
		
		$html .= "</table></div><hr style=\"margin-top:50px;margin-bottom:50px;\">";
	}
	

	
	echo "<div class=\"jumbotron\">
		<h1 align=\"center\">".lang("GS_STR_INDEX_ALLMODS"). " (" .count($modfolders_id) . ")</h1>
		<p align=\"center\" style=\"font-size: 1em;\">";
	
	foreach ($mod_labels as $key=>$label)
		echo "<a align=\"center\" href=\"#".$anchors[$key]."\">$label</a>  &nbsp; ";
	
	echo "</p><h4><center><a href=\"https://youtu.be/KSK_H8Dc4oo\">".lang("GS_STR_MOD_HOWTO_INSTALL")."</a></center></h4></div>";
	
	echo $html;
?>


	</DIV> <!-- /.container -->
</DIV> <!-- /.wrapper -->


<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
	
	