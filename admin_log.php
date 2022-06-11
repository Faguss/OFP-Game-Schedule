<?php

// Userspice
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF']))
	die();

if (!$user->isLoggedIn())
	Redirect::to('users\login.php');

$uid = $user->data()->id;

require_once "common.php";
$gs_my_permission_level = GS_get_permission_level($user);

if ($gs_my_permission_level != GS_PERM_ADMIN)
	Redirect::to('index.php');
?>

<DIV ID="page-wrapper">
<DIV CLASS="container">

<?php
echo "<table style=\"width:100%\"><tr>";

foreach(["id","date","description"] as $cell)
	echo "<th>".ucfirst($cell)."</th>";

echo "</tr>";

$table = GS_get_activity_log(600, [GS_LOG_SERVER_MOD_CHANGED], true);

foreach($table as $row) {
	echo "<tr>
	<td>{$row["id"]}</td>
	<td>".date("D, d M Y H:i:s", $row["date"])."</td>
	<td>{$row["description"]}</td>
	</tr>";
}

echo "</table>";

echo "<br><br>";
if (isset($user) && $user->isLoggedIn())
	languageSwitcher();

?>


	</DIV> <!-- /.container -->
</DIV> <!-- /.wrapper -->


<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
	
	