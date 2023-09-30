<?php

// Userspice
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF']))
	die();

require_once "common.php";
$Parsedown = new Parsedown();
?>

<?php
$servers = GS_list_servers(["current"], [], GS_REQTYPE_WEBSITE, 0, $lang["THIS_LANGUAGE"], $user);
$mods    = GS_list_mods($servers["mods"], [], [], [], GS_REQTYPE_WEBSITE, $servers["lastmodified"]);

echo "<div class=\"row\">" . GS_format_server_info($servers, $mods, 12, GS_SPLIT_PERSISTENT) . "</div>";

echo '<div class="index_section">';
languageSwitcher();
echo '</div>';
?>


<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
	
	