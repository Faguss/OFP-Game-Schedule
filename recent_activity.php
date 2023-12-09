<?php

// Userspice
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF']))
	die();

require_once "common.php";
$table = GS_get_activity_log(500, GS_GENERAL_RSS_EXCLUDE, false, GS_get_permission_level($user), GS_get_common_input());

echo "
<br>

<div class=\"gs_section_title\">".lang("GS_STR_INDEX_RECENT")."</div>

<div class=\"row\">		
<div class=\"col-lg-12\">
<div class=\"panel panel-default gs_section_title_border\">
<div class=\"panel-body servers_background\" style=\"display:flex;\">
<table style=\"width:100%\">
";

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

echo "</table>

<div>
	<a href=\"recent_activity\"><span class=\"glyphicon glyphicon-link\"></span></a>
	<br>
	<a href=\"rss\"><span class=\"fa fa-rss\"></span></a>
</div>

</div></div></div></div>";
?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
	
	