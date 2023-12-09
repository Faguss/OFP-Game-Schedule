<?php
require_once "minimal_init.php";
require_once "common.php";
header('Content-type: application/xml');
$db         = DB::getInstance();
$input      = GS_get_common_input();
$url        = GS_get_current_url();
$feed_title = "Recent Activity";
$output     = "";

$exclude_list = GS_GENERAL_RSS_EXCLUDE;

if (!empty($input["mod"])) {
	$exclude_list = [
		GS_LOG_SERVER_MOD_REMOVED,
		GS_LOG_SERVER_MOD_ADDED,
		GS_LOG_SERVER_MOD_CHANGED,
		GS_LOG_MOD_REVOKE_ACCESS,
		GS_LOG_MOD_SHARE_ACCESS,
		GS_LOG_MOD_TRANSFER_ADMIN
	];
	
	if (in_array("all",$input["mod"])) {
		$exclude_list = array_merge($exclude_list, [
			GS_LOG_MOD_UPDATED,
			GS_LOG_MOD_SCRIPT_UPDATED,
			GS_LOG_MOD_SCRIPT_ADDED,
			GS_LOG_MOD_VERSION_UPDATED,
			GS_LOG_MOD_LINK_ADDED,
			GS_LOG_MOD_LINK_UPDATED,
			GS_LOG_MOD_LINK_DELETED
		]);
	}
}

if (!empty($input["server"])) {
	$exclude_list = [
		GS_LOG_SERVER_MOD_CHANGED,
		GS_LOG_SERVER_REVOKE_ACCESS,
		GS_LOG_SERVER_SHARE_ACCESS,
		GS_LOG_SERVER_TRANSFER_ADMIN
	];
	
	if (in_array("all",$input["server"])) {
		$exclude_list = array_merge($exclude_list, [
			GS_LOG_SERVER_UPDATED,
		]);
	}
}


$table      = GS_get_activity_log(40, $exclude_list, false, GS_get_permission_level($user), $input);
$timestamps = [];

foreach($table as $row) {
	$guid = $row["date"];

	if (in_array($row["date"],$timestamps))
		$guid = $row["date"] . count($timestamps);
	else
		$timestamps[] = $row["date"];
	
	$description = "";
	
	if (isset($row["server_name"])) {
		if ($row["typenum"] == GS_LOG_SERVER_ADDED && !empty($row["message"]))
			$description .= "{$row["message"]}<br><br>";
		
		$description .= "<a href=\"{$url}show.php?server={$row["server_id"]}\">".lang("GS_STR_SERVER")."</a><br>";
		
		if (!empty($input["server"])) {
			if (in_array("all",$input["server"]))
				$feed_title = "Server Updates";
			else
				$feed_title = "Server Updates: {$row["server_name"]}";
		}
	}
	
	if (isset($row["mod_name"])) {
		$version = "";
		
		if (isset($row["mod_version"]))	
			$version = "&ver=".(floatval($row["mod_version"])-0.01);
		
		if ($row["typenum"] == GS_LOG_MOD_ADDED && !empty($row["mod_desc"]))
			$description .= "{$row["mod_desc"]}<br><br>";
		
		$description .= "<a href=\"{$url}show.php?mod={$row["mod_id"]}$version\">".lang("GS_STR_MOD_PREVIEW_INST")."</a><br>";
		
		if (!empty($input["mod"])) {
			if (in_array("all",$input["mod"]))
				$feed_title = "Mod Updates";
			else
				$feed_title = "Mod Updates: {$row["mod_name"]}";
		}
	}
	
	if (isset($row["mod_changelog"]))
		$description .= "<br>".nl2br($row["mod_changelog"]);
		
	if (isset($row["installversion"]))
		$description = "<a href=\"install_scripts#changelog{$row["installversion"]}\">".lang("GS_STR_SHOW_CHANGELOG")."</a>";
	
	$output .= "
		<item>
			<title>{$row["description"]}</title>
			<link>{$url}recent_activity</link>
			<guid>$guid</guid>
			<pubDate>".date(DATE_RSS,$row["date"])."</pubDate>
			<description><![CDATA[$description]]></description>
		</item>
	";
}
		
echo  "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">

<channel>
<title>OFP Game Schedule - $feed_title</title>
<link>{$url}recent_activity</link>
<atom:link href=\"{$url}rss\" rel=\"self\" type=\"application/rss+xml\" />
<description>Organize OFP multiplayer sessions</description>
<language>en-us</language>
<lastBuildDate>" . date(DATE_RSS) . "</lastBuildDate>

<image>
	<title>OFP Game Schedule</title>
	<url>{$url}images/icon_128.jpg</url>
	<link>{$url}</link>
	<width>128</width>
	<height>128</height>
</image>
" . $output . "</channel></rss>";
?>