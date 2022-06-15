<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (isset($_GET["lang"])) {
	foreach(GS_LANGUAGES["files"] as $language_code) {
		if ($_GET["lang"] == substr($language_code, 0, 2)) {
			$_SESSION['us_lang'] = $language_code;
			include $abs_us_root.$us_url_root.'users/lang/'.$language_code.".php";
			break;
		}
	}
}

if ($lang["THIS_CODE"] == "en-US") {
	$lang = array_merge($lang, array(
	#Quickstart page
	"GS_STR_QUICKSTART_WELCOME" => "Game Schedule for the game Operation Flashpoint / Arma: Cold War Assault with the Fwatch extension",
	"GS_STR_QUICKSTART_DESCRIPTION" => "Bring players to the same server, at the same time with the same addons",
	"GS_STR_QUICKSTART_DESCRIPTION2" => "Players automatically install mods and connect to the server",
	"GS_STR_QUICKSTART_FORPLAYERS" => "For players",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "For organizers",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "First you log in with your %m1% account",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Add a new server record. Fill the fields with information about the OFP server you're going to play on",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Now go to the \"Schedule\" section. Set the game start time",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Optionally: if the server uses mods then add them from the list",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "You can also submit your own mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "After adding a game time the server will be listed publicly. Players can join now",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "You need Fwatch 1.16 and OFP Aspect Ratio pack 2.07. %m1%Download%m2% Start the game with Fwatch. You'll see \"Mods\" button in the lower left corner. Click on it and then on the \"Schedule\" button. Select server from the list",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Double-click on the server name to show available options. If you lack required mods then double-click on the \"Download\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Wait for the installer to finish. Playing the game or even quitting it won't affect the installation",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Once it's done go to the server options again and double-click on the \"Connect\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "If the game starts later the same day then you can enable auto-join on time",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Have fun playing!"
	));
}

if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
	#Quickstart page
	"GS_STR_QUICKSTART_WELCOME" => "Расписание Игр для Operation Flashpoint / Arma: Cold War Assault с расширением Fwatch",
	"GS_STR_QUICKSTART_DESCRIPTION" => "Собирайтесь с другими игроками на одном сервере с одинаковыми аддонами в одно и то же время.",
	"GS_STR_QUICKSTART_DESCRIPTION2" => "Игроки автоматически устанавливают моды и подключаются к серверу",
	"GS_STR_QUICKSTART_FORPLAYERS" => "Для игроков",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "Для организаторов",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Для начала нужно войти в аккаунт %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Добавьте новый сервер. Заполните поля для информации о сервере, на котором будете играть.",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Перейдите в раздел \"Расписание\". Задайте время начала игры",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Дополнительно: если на Вашем сервере используются моды, выберите и добавьте их в список",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "Вы также можете добавить свой собственный мод",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Сервер будет отображаться для всех после добавления времени начала игры. Игроки могут подключиться.",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Вам понадобится Fwatch 1.16 и OFP Aspect Ratio сборки 2.07. %m1%Скачать%m2% Запустите игру, используя Fwatch. Вы увидите кнопку \"Mods\" в левом нижнем углу. Нажмите на неё, а затем на кнопку \"Расписание\". Выберите сервер из списка",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Нажмите два раза на название сервера, чтобы просмотреть опции. Если Вам не хватает необходимых модов, нажмите два раза на \"Скачать\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Дождитесь завершения установки. Установка не прервётся во время или при закрытии игры",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Как только установка закончится, перейдите к опциям сервера и нажмите два раза на \"Подключиться\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Если игра начинается позже в этот же день, то есть опция автоматического подключения во время начала.",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Приятной игры!"
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
	#Quickstart page
	"GS_STR_QUICKSTART_WELCOME" => "Rozkład Rozgrywek do gry Operation Flashpoint / Arma: Cold War Assault z rozszerzeniem Fwatch",
	"GS_STR_QUICKSTART_DESCRIPTION" => "Zgromadź graczy na jednym serwerze, o tej samej porze, z identycznymi addonami",
	"GS_STR_QUICKSTART_DESCRIPTION2" => "Gracze automatycznie instalują mody i podłączają się do serwera",
	"GS_STR_QUICKSTART_FORPLAYERS" => "Dla graczy",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "Dla organizatorów",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Najpierw zaloguj się przy pomocy konta %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Dodaj nowy wpis serwera. Wypełnij puste pola danymi o serwerze na którym będzieci grali",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Przejdź do sekcji \"Harmonogram\". Ustaw czas rozpoczęcia gry",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Dodatkowo: jeśli serwer używa modów to dodaj je z listy",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "Możesz także dodać własny mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Po dodaniu czasu rozpoczęcia gry serwer pojawi się na publicznej liście. Gracze mogą już dołączyć",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Potrzebujesz Fwatch 1.16 oraz paczki OFP Aspect Ratio pack 2.07. %m1%Pobierz%m2% Uruchom grę z Fwatchem. W lewym dolnym rogu pojawi się przycisk \"Mods\". Kliknij na nim a potem na przycisku \"Plan Rozgrywek\". Wybierz serwer z listy",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Kliknij dwa razy na nazwie serwera żeby wyświetlić opcje. Jeśli nie masz wymaganych modów to kliknij dwa razy na \"Ściągnij\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Zaczekaj aż instalator skończy. Granie albo wyjście z gry nie ma wpływu na proces instalacji",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Po instalacji przejdź ponownie do opcji serwera i kliknij podwójnie na \"Dołącz\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Jeśli rozgrywka zacznie się później tego samego dnia to możesz włączyć automatyczne podłączenie się o czasie",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Miłej zabawy!"
	));
}
?>
<div id="page-wrapper">
	<div class="container">
		<?php languageSwitcher(); ?>
		
		<div class="jumbotron">
			<h2 align="center"><?=lang("GS_STR_QUICKSTART_WELCOME")?></h2>
			<p align="center" class="text-muted"><?=lang("GS_STR_QUICKSTART_DESCRIPTION2")?></p>
			<br>
			<h3 align="center"><a align="center" href="#players"><?=lang("GS_STR_QUICKSTART_FORPLAYERS") ?></a></h3>

			<br>
			<hr>
			<h2 align="center" style="color:#cc4f80;font-size:45px"><?=lang("GS_STR_QUICKSTART_FORORGANIZERS") ?>:</h2>
			<br>
<?php
$strings = [
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY",
	"GS_STR_QUICKSTART_FORPLAYERS_START",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN"
];
$images = [
	"1_mainmenu",
	"2_addnewserver",
	"3_schedule",
	"4_assignmod",
	"5_addnewmod",
	"",
	"6_serverdisplay",
	"7_downloadmods",
	"8_installing",
	"9_connect",
	["10_autoconnect", "11_autoconnect"],
	""
];

foreach ($strings as $i=>$string) {
	$arguments = [];

	if ($string == "GS_STR_QUICKSTART_FORPLAYERS_START") {
		echo "
		<a name=\"players\"></a>
		<br><br><br><br>
		<hr>
		<h2 align=\"center\" style=\"color:#cc4f80;font-size:45px\">".lang("GS_STR_QUICKSTART_FORPLAYERS")."</h2>
		<br>
		";
		$arguments = ["<A HREF=\"http://ofp-faguss.com/fwatch/116test\">", "</a><br><br>"];
	}
	
	if ($string == "GS_STR_QUICKSTART_FORORGANIZERS_LOGIN")
		$arguments = ["<a href='users/login.php' target='_blank'>Steam / Discord / VK / Google / Facebook</a>"];

	echo "<p align=\"center\">".lang($string, $arguments)."</p>";
	
	if (!empty($images[$i])) {
		$array = $images[$i];
		
		if (!is_array($images[$i]))
			$array = [$images[$i]];
		
		echo "<div class=\"text-center\">";
		
		forEach ($array as $index=>$item) {
			$image_name = "images/" . $item . "_" . substr($lang["THIS_CODE"],0,2) . ".png";
			
			if (!file_exists($image_name))
				$image_name = substr($image_name,0,-3) . "jpg";
			
			echo "<img " . ($index!=0 ? "style=\"margin-top:0.7em;\"" : "") . " src=\"$image_name\" alt=\"$item\" class=\"img-thumbnail blackborder\">";
		}
			
		echo "</div><a name=\"paragraph".($i+1)."\"></a><br><br>";
	}
}
?>

			
			<br><br>
			<p><small><?=lang("GS_STR_TRANSLATION") ?></small></p>
			<br><br>			
		</div>
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
