<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";

if ($lang["THIS_CODE"] == "en-US") {
	$lang = array_merge($lang, array(
		#Dedicated server support page
		"GS_DEDICATED_TITLE" => "Installing Mods on a Dedicated Server with Fwatch",
		"GS_DEDICATED_OVERVIEW" => "You can remotely install and update modfolders by running this special mission:",
		"GS_DEDICATED_INITSQS" => "Open file %m1% and change id value to your server public identifier (you'll find it in the \"Edit Server Details\" page)",
		"GS_DEDICATED_PRIVATE" => "If the server record has schedule password then copy file %m1% (which contains the password) from your computer to the server.",
        "GS_DEDICATED_SAFETY" => "For safety reasons only the server admin should have access to this mission.",
        "GS_DEDICATED_REQUIRED" => "Fwatch must be running on the server. It's not required for the player.",
        "GS_DEDICATED_PROCESS" => "After starting the mission current schedule will be downloaded and mods will be installed. If modfolder already exists but doesn't have id then installer will create a new copy. Installer will terminate when encountered commands %m1% that require user input.",
        "GS_DEDICATED_LOGFILES" => "In case of issues check log files:"
	));
}

if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
		#Dedicated server support page
"GS_DEDICATED_TITLE" => "Установка модов на выделенный сервер с помощью Fwatch. Переведено Google",
"GS_DEDICATED_OVERVIEW" => "Вы можете удаленно устанавливать и обновлять папки модов, выполнив эту специальную миссию:",
"GS_DEDICATED_INITSQS" => "Откройте файл %m1% и измените значение id на общедоступный идентификатор вашего сервера (вы найдете его на странице «Редактировать сведения о сервере»).",
"GS_DEDICATED_PRIVATE" => "Если в записи сервера указан пароль расписания, скопируйте файл %m1% (который содержит пароль) с вашего компьютера на сервер.",
"GS_DEDICATED_SAFETY" => "В целях безопасности только администратор сервера должен иметь доступ к этой миссии.",
"GS_DEDICATED_REQUIRED" => "Fwatch должен быть запущен на сервере. Для игрока это не требуется.",
"GS_DEDICATED_PROCESS" => "После запуска миссии будет загружено текущее расписание и установлены моды. Если папка мода уже существует, но не имеет идентификатора, установщик создаст новую копию. Установщик прекратит работу при обнаружении команд %m1%, требующих ввода данных пользователем.",
"GS_DEDICATED_LOGFILES" => "В случае возникновения проблем проверьте лог-файлы:"
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
		#Dedicated server support page
		"GS_DEDICATED_TITLE" => "Instalowanie modów na serwerze dedykowanym z Fwatchem",
		"GS_DEDICATED_OVERVIEW" => "Możesz zdalnie zainstalować i zaktualizować mody używając tej specjalnej misji:",
		"GS_DEDICATED_INITSQS" => "Otwórz file %m1% i zmień wartość id na publiczny identyfikator twojego serwera (znajdziesz go na stronie edycji szczegółów serwera).",
        "GS_DEDICATED_PRIVATE" => "Jeśli wpis serwera ma ustawione hasło do rozkładu to wtedy skopiuj plik %m1% (który zawiera hasło) ze swojego komputera na serwer.",
        "GS_DEDICATED_SAFETY" => "Ze względów bezpieczeństwa tylko administrator powinien mieć dostęp do tej misji.",
        "GS_DEDICATED_REQUIRED" => "Fwatch musi być uruchomiony na serwerze. Nie jest wymagany dla graczy.",
        "GS_DEDICATED_PROCESS" => "Po uruchomieniu misji aktualny rozkład zostanie ściągnięty i mody zostaną zainstalowane. Jeśli modfolder już istnieje ale nie ma identifykatora to wtedy instalator utworzy nową kopię. Program instalacyjny zostanie zamknięty jeśli natrafi na komendy %m1% które wymagają decyzji użytkownika.",
        "GS_DEDICATED_LOGFILES" => "W razie problemów sprawdź zapisy działań:"
	));
}

echo '<div id="page-wrapper">
	<div class="container">
	
	<br>
	<div class="panel panel-default">
		<div class="panel-heading"><strong>'.lang("GS_DEDICATED_TITLE").'</strong></div>	
		<div class="panel-body">
			<p>'.lang("GS_DEDICATED_OVERVIEW").'</p>
			<p><a style="margin-left:20px;" href="download\gameschedule_dedicated_install.Intro.7z">gameschedule_dedicated_install.Intro.7z</a> 

			<span style="color:#993366;font-size:10px;">('.GS_convert_size_in_bytes(filesize("download/gameschedule_dedicated_install.Intro.7z"), "website").')</span>
			<span style="float:right;font-size:10px;">'.date("F d Y H:i",filemtime("download/gameschedule_dedicated_install.Intro.7z")).'</span>

			</p>
			<br>
			<br>';
			
			$stringlist = [
				"GS_DEDICATED_INITSQS"  => ["<i>init.sqs</i>"],
                "GS_DEDICATED_PRIVATE"  => ["<i>fwatch\\tmp\\schedule\\params.bin</i>"],
                "GS_DEDICATED_SAFETY"   => [],
                "GS_DEDICATED_REQUIRED" => [],
                "GS_DEDICATED_PROCESS"  => ["(<i>ASK_GET</i>, <i>ASK_RUN</i>)"]
			];
            
            foreach($stringlist as $key=>$arguments)
                echo "<p>" . lang($key, $arguments) . "</p>";
										
			echo '<br>
			<br>

			<p>'.lang("GS_DEDICATED_LOGFILES").'</p>
			<ul>
				<li>fwatch\data\addonInstallerLog.txt</li>
				<li>fwatch\tmp\schedule\downloadLog.txt</li>
				<li>fwatch\tmp\schedule\unpackLog.txt</li>
				<li>fwatch\tmp\schedule\schedule.sqf</li>
			</ul>
		</div>
	</div><!-- /panel -->				

	</div>
</div>';

?>
<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>