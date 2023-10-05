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
	"GS_STR_QUICKSTART_TITLE" => "Players automatically install mods and connect to the server",
	"GS_STR_QUICKSTART_SUBTITLE" => "for the game Operation Flashpoint / Arma: Cold War Assault",
	"GS_STR_QUICKSTART_WHY" => "Why use it?",
	"GS_STR_QUICKSTART_WHY_URL" => "https://youtu.be/UoT6sQQ6dLY",
	"GS_STR_QUICKSTART_FORPLAYERS" => "How to join a server?",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "How to setup a server?",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "First you log in with your %m1% account",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Add a new server record. Fill the fields with information about the OFP server you're going to play on",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Now go to the \"Schedule\" section. Set the game start time",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Optionally: if the server uses mods then add them from the list",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "You can also submit your own mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "After adding a game time the server will be listed publicly. Players can join now",
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Install Fwatch 1.16 and OFP Aspect Ratio pack 2.07. %m1%Download%m2%<br><span style=\"font-size:small\">Archive password is \"fwatch\". Extract it and run the installer. <a href=\"/fwatch/116test\">More info</a><br>Watch <a href=\"https://youtu.be/wD74VpadQY4\">video</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Start the game with fwatch.exe. You'll see \"Mods\" button in the lower left corner. Click on it and then on the \"Schedule\" button. Select server from the list",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Double-click on the server name to show available options. If you lack required mods then double-click on the \"Download\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Wait for the installer to finish. Playing the game or even quitting it won't affect the installation",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Once it's done go to the server options again and double-click on the \"Connect\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "There's also an option to connect automatically to a scheduled game",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Have fun playing!"
	));
}

if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
	#Quickstart page
	"GS_STR_QUICKSTART_WELCOME" => "Расписание Игр для Operation Flashpoint / Arma: Cold War Assault с расширением Fwatch",
	"GS_STR_QUICKSTART_DESCRIPTION" => "Собирайтесь с другими игроками на одном сервере с одинаковыми аддонами в одно и то же время.",
	"GS_STR_QUICKSTART_TITLE" => "Игроки автоматически устанавливают моды и подключаются к серверу",
	"GS_STR_QUICKSTART_SUBTITLE" => "для игры Operation Flashpoint / Arma: Cold War Assault",
	"GS_STR_QUICKSTART_WHY" => "Зачем это использовать?",
	"GS_STR_QUICKSTART_WHY_URL" => "https://youtu.be/o0dPXTGngcQ",
	"GS_STR_QUICKSTART_FORPLAYERS" => "Как подключиться?",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "Как устроить?",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Для начала нужно войти в аккаунт %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Добавьте новый сервер. Заполните поля для информации о сервере, на котором будете играть.",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Перейдите в раздел \"Расписание\". Задайте время начала игры",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Дополнительно: если на Вашем сервере используются моды, выберите и добавьте их в список",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "Вы также можете добавить свой собственный мод",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Сервер будет отображаться для всех после добавления времени начала игры. Игроки могут подключиться.",
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Вам понадобится Fwatch 1.16 и OFP Aspect Ratio сборки 2.07. %m1%Скачать%m2%<br><span style=\"font-size:small\">Пароль архива \"fwatch\". Извлеките его и запустите установщик. <a href=\"/fwatch/116test\">Больше информации</a><br>Смотрите <a href=\"https://youtu.be/wD74VpadQY4\">видео</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Запустите игру, используя fwatch.exe. Вы увидите кнопку \"Mods\" в левом нижнем углу. Нажмите на неё, а затем на кнопку \"Расписание\". Выберите сервер из списка",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Нажмите два раза на название сервера, чтобы просмотреть опции. Если Вам не хватает необходимых модов, нажмите два раза на \"Скачать\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Дождитесь завершения установки. Установка не прервётся во время или при закрытии игры",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Как только установка закончится, перейдите к опциям сервера и нажмите два раза на \"Подключиться\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Так же есть возможность автоматически подключиться к запланированной игре",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Приятной игры!"
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
	#Quickstart page
	"GS_STR_QUICKSTART_WELCOME" => "Rozkład Rozgrywek do gry Operation Flashpoint / Arma: Cold War Assault z rozszerzeniem Fwatch",
	"GS_STR_QUICKSTART_DESCRIPTION" => "Zgromadź graczy na jednym serwerze, o tej samej porze, z identycznymi addonami",
	"GS_STR_QUICKSTART_TITLE" => "Gracze automatycznie instalują mody i podłączają się do serwera",
	"GS_STR_QUICKSTART_SUBTITLE" => "do gry Operation Flashpoint / Arma: Cold War Assault",
	"GS_STR_QUICKSTART_WHY" => "Dlaczego warto skorzystać?",
	"GS_STR_QUICKSTART_WHY_URL" => "https://youtu.be/UoT6sQQ6dLY",
	"GS_STR_QUICKSTART_FORPLAYERS" => "Jak dołączyć do serwera?",
	"GS_STR_QUICKSTART_FORORGANIZERS" => "Jak ustawić serwer?",
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Najpierw zaloguj się przy pomocy konta %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Dodaj nowy wpis serwera. Wypełnij puste pola danymi o serwerze na którym będzieci grali",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Przejdź do sekcji \"Harmonogram\". Ustaw czas rozpoczęcia gry",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Dodatkowo: jeśli serwer używa modów to dodaj je z listy",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD" => "Możesz także dodać własny mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Po dodaniu czasu rozpoczęcia gry serwer pojawi się na publicznej liście. Gracze mogą już dołączyć",
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Zainstaluj Fwatch 1.16 oraz OFP Aspect Ratio pack 2.07. %m1%Pobierz%m2%<br><span style=\"font-size:small\">Hasło archiwum to \"fwatch\". Wypakuj je i uruchom instalator. <a href=\"/fwatch/116test\">Więcej informacji</a><br>Patrz <a href=\"https://youtu.be/wD74VpadQY4\">film</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Uruchom grę przez fwatch.exe. W lewym dolnym rogu pojawi się przycisk \"Mods\". Kliknij na nim a potem na przycisku \"Plan Rozgrywek\". Wybierz serwer z listy",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Kliknij dwa razy na nazwie serwera żeby wyświetlić opcje. Jeśli nie masz wymaganych modów to kliknij dwa razy na \"Ściągnij\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Zaczekaj aż instalator skończy. Granie albo wyjście z gry nie ma wpływu na proces instalacji",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Po instalacji przejdź ponownie do opcji serwera i kliknij podwójnie na \"Dołącz\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Masz również opcję automatycznego podłączenia się do zaplanowanej gry",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Miłej zabawy!"
	));
}

languageSwitcher();

echo '
<ul id="quickstart_tabs" class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#players" aria-controls="players" role="tab" data-toggle="tab">'.lang("GS_STR_QUICKSTART_FORPLAYERS").'</a></li>
	<li role="presentation"><a href="#organizers" aria-controls="organizers" role="tab" data-toggle="tab">'.lang("GS_STR_QUICKSTART_FORORGANIZERS").'</a></li>
</ul>
<div class="jumbotron">
<div class="tab-content">
';

$sections = [
	"players"=>[
		[
			"title"     => "GS_STR_QUICKSTART_FORPLAYERS",
			"anchor"    => "players",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_INSTALL",
			"image"     => "0_fwatch_installer",
			"arguments" => ["<A HREF=\"https://ofp-faguss.com/fwatch/download/fwatch116beta_installer.7z\">", "</a>"],
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_START",
			"image"     => "6_serverdisplay",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV",
			"image"     => "7_downloadmods",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL",
			"image"     => "8_installing",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_CONNECT",
			"image"     => "9_connect",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT",
			"image"     => ["10_autoconnect", "11_autoconnect"],
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN",
		],
	],
	
	"organizers"=>[
		[
			"title"     => "GS_STR_QUICKSTART_FORORGANIZERS",
			"anchor"    => "organizers",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_LOGIN",
			"image"     => "1_mainmenu",
			"arguments" => ["<a href='users/login.php' target='_blank'>Steam / Discord / VK / Google / Facebook</a>"],
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV",
			"image"     => "2_addnewserver",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE",
			"image"     => "3_schedule",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV",
			"image"     => "4_assignmod",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD",
			"image"     => "5_addnewmod",
		],
		[
			"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_READY",
		],
	],
];

foreach ($sections as $section_name=>$paragraphs) {
	echo '<div role="tabpanel" class="tab-pane active" id="'.$section_name.'">';
	
	forEach ($paragraphs as $pkey=>$paragraph) {
		$arguments = isset($paragraph["arguments"]) ? $paragraph["arguments"] : [];
		
		if (isset($paragraph["string"]))
			echo "<p align=\"center\">".lang($paragraph["string"], $arguments)."</p>";
		
		if (isset($paragraph["title"])) {
			#echo "<a name=\"".$paragraph["anchor"]."\"></a>";
			
			if ($pkey > 0)
				echo "<br><hr><br>";
			
			echo "<h2 align=\"center\" style=\"color:#cc4f80;font-size:45px\">".lang($paragraph["title"])."</h2><br>";
		}
		
		if (isset($paragraph["image"])) {
			$array = $paragraph["image"];
			
			if (!is_array($paragraph["image"]))
				$array = [$paragraph["image"]];
			
			echo "<div class=\"text-center\">";
			
			forEach ($array as $index=>$item) {
				$image_name = "images/quickstart/" . $item . "_" . substr($lang["THIS_CODE"],0,2) . ".png";
				
				if (!file_exists($image_name))
					$image_name = substr($image_name,0,-3) . "jpg";
				
				echo "<img " . ($index!=0 ? "style=\"margin-top:0.7em;\"" : "") . " src=\"$image_name\" alt=\"$item\" class=\"img-thumbnail blackborder\">";
			}
			
			echo "</div><br><br>";
		}
	}
	
	echo '</div>';
}

?>

			
	<br><br>
	<p><small><?=lang("GS_STR_TRANSLATION") ?></small></p>
	<br><br>
	</div>			
</div>

<script>
$(document).ready(() => {
	let url = location.href.replace(/\/$/, "");
	if (location.hash) {
		const hash = url.split("#");
		$('#quickstart_tabs a[href="#'+hash[1]+'"]').tab("show");
		url = location.href.replace(/\/#/, "#");
		history.replaceState(null, null, url);
		setTimeout(() => {
			$(window).scrollTop(0);
		}, 400);
	} 

	$('a[data-toggle="tab"]').on("click", function() {
		let newUrl;
		const hash = $(this).attr("href");
		
		if (hash == "#players") {
			newUrl = url.split("#")[0];
		} else {
			newUrl = url.split("#")[0] + hash;
		}
		
		newUrl += "/";
		history.replaceState(null, null, newUrl);
	});
});

</script>
<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
