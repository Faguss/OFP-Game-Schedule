<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
$url = GS_get_current_url() . "api";

if ($lang["THIS_CODE"] == "en-US") {
	$lang = array_merge($lang, array(
		#API documentation page
		"GS_API_TITLE" => "OFP Game Schedule API",
		"GS_API_OVERVIEW" => "To get information in JSON format about the servers and mods on the website send a request to the <a href=\"%m1%\">%m1%</a> with the following arguments (GET or POST):",
		"GS_API_SERVER" => "server identificator. Alternatively write \"current\" to get all public servers with upcoming game times or \"all\" for all the public servers.",
		"GS_API_MOD" => "mod identificator. Alternatively write \"all\" to get all public mods.",
		"GS_API_VER" => "mod version number. Installation details will start from the specified version. Default is 0.",
		"GS_API_PASSWORD" => "password required to preview a private server or a private mod (if it's assigned to a private server).",
		"GS_API_NOTE_ARGS" => "Separate multiple values with a comma. \"ver\" is a parallel list to \"mod\".",
		"GS_API_EXAMPLES" => "Examples:",
		"GS_API_EXAMPLEPHP" => "Example PHP script"
	));
}

if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
		#API documentation page
		"GS_API_TITLE" => "API Расписания Игр OFP",
		"GS_API_OVERVIEW" => "Чтобы получить информацию о серверах и модах на сайте в формате JSON, напишите запрос по ссылке <a href=\"%m1%\">%m1%</a> со следующими пунктами (GET или POST):",
		"GS_API_SERVER" => "server - идентификатор сервера. Вы можете написать \"current\" (текущий), чтобы получить информацию о всех открытых серверах с расписанием будущих игр, или же можете написать \"all\" (все), чтобы получить информацию о всех открытых серверах.",
		"GS_API_MOD" => "идентификатор мода. Вы можете написать \"all\" (все), чтобы получить информацию о всех доступных модах.",
		"GS_API_VER" => "версия мода. Скрипт установки будет загружен из указанной версии. По умолчанию: 0.",
		"GS_API_PASSWORD" => "пароль, который требуется для предварительного просмотра частного сервера или мода (если мод прикреплен к частному серверу).",
		"GS_API_NOTE_ARGS" => "Требуется разделить значения запятой. \"ver\" является параллельным \"mod\".",
		"GS_API_EXAMPLES" => "Примеры:",
		"GS_API_EXAMPLEPHP" => "Пример скрипта PHP"
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
		#API documentation page
		"GS_API_TITLE" => "API do Rozkładu Rozgrywek OFP",
		"GS_API_OVERVIEW" => "Żeby otrzymać dane o serwerach i modach w formacie JSON wyślij zapytanie do <a href=\"%m1%\">%m1%</a> z następującymi argumentami (GET lub POST):",
		"GS_API_SERVER" => "identyfikator serwera. Alternatywnie napisz \"current\" żeby dostać dane o wszystkich publicznych serwerach z nadchodzącymi rozgrywkami albo \"all\" żeby dostać dane o wszystkich publicznych serwerach.",
		"GS_API_MOD" => "identyfikator moda. Alternatywnie napisz \"all\" żeby otrzymać dane o wszystkich publicznych modach.",
		"GS_API_VER" => "numer wersji moda. Informacje o instalacji zacznie się od podanej wersji. Domyślnie zero.",
		"GS_API_PASSWORD" => "hasło wymagane do wyświetlenia prywatnego serwera lub prywatnego moda (dodanego do prywatnego serwera).",
		"GS_API_NOTE_ARGS" => "W przypadku zbioru wartości porozdzielaj je przecinkami. \"ver\" jest listą równoległą do \"mod\".",
		"GS_API_EXAMPLES" => "Przykłady:",
		"GS_API_EXAMPLEPHP" => "Przykładowy skrypt PHP"
	));
}

echo '
<div id="page-wrapper">
	<div class="container">
	
	<br>
	<div class="panel panel-default">
		<div class="panel-heading"><strong>'.lang("GS_API_TITLE").'</strong></div>	
		<div class="panel-body">
			<p>'.lang("GS_API_OVERVIEW",[$url]).'</p>
			<br>
			
			<ul>';
			
$api_arguments = ["server", "mod", "ver", "password"];
foreach ($api_arguments as $api_argument)
	echo "<li><b>$api_argument</b> - " . lang("GS_API_".strtoupper($api_argument)) . "</li>";

echo '
			</ul>
			<br>
			<p>'.lang("GS_API_NOTE_ARGS").'</p>
			
			<br>
			<p><b>'.lang("GS_API_EXAMPLES").'</b><br>
				<a href="api?server=4abc47b3">api?server=4abc47b3</a><br>
				<a href="api?server=1eec0bb4&password=test">api?server=1eec0bb4&password=test</a><br>
				<a href="api?mod=559d7b3a">api?mod=559d7b3a</a><br>
				<a href="api?mod=c803832d,c4d807e7&ver=1.15,1">api?mod=c803832d,c4d807e7&ver=1.15,1</a><br>
				<a href="api?mod=all,6361f10f&ver=0,1.15">api?mod=all,6361f10f&ver=0,1.15</a><br>
				<a href="api?mod=6361f10f&password=test">api?mod=6361f10f&password=test</a><br>
			</p>
			
			<br>
			<p><a href="api_example.txt">'.lang("GS_API_EXAMPLEPHP").'</a></p>
		</div>
	</div><!-- /panel -->				

	</div>
</div>';
?>
<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>