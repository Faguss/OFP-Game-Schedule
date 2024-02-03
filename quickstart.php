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
	"GS_STR_QUICKSTART_TAB_JOIN_SERVER" => "How to join a server?",
	"GS_STR_QUICKSTART_TAB_MAKE_SERVER" => "How to add a server?",
	"GS_STR_QUICKSTART_TAB_MAKE_MOD" => "How to add a mod?",
	"GS_STR_QUICKSTART_TAB_INSTALL_MOD" => "How to install mods?",
	
	#Add a server
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "First you log in with your %m1% account",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Add a new server record. Fill the fields with information about the OFP server you're going to play on",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Now go to the \"Schedule\" section. Set the game start time",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Optionally: if the server uses mods then add them from the list. You can also submit your own mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "After adding a game time the server will be listed publicly. Players can join now",
	
	#Join server
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Install Fwatch 1.16 and OFP Aspect Ratio pack 2.07. %m1%Download%m2%<br><span style=\"font-size:small\">Archive password is \"fwatch\". Extract it and run the installer. <a href=\"/fwatch/116test\">More info. </a>Watch <a href=\"https://youtu.be/wD74VpadQY4\">video</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Start the game with fwatch.exe. You'll see \"Mods\" button in the lower left corner. Click on it and then on the \"Schedule\" button. Select server from the list",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Double-click on the server name to show available options. If you lack required mods then double-click on the \"Download\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Wait for the installer to finish. Playing the game or even quitting it won't affect the installation",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Once it's done go to the server options again and double-click on the \"Connect\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "There's also an option to connect automatically to a scheduled game",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Have fun playing!",
	
	#Add a mod
	"GS_STR_QUICKSTART_MOD_LAUNCH" => "Go to the fwatch\\data folder and launch addonInstarrer.exe",
	"GS_STR_QUICKSTART_MOD_SCRIPT" => "Paste download links to your files in the \"Edit Script\" input. If you don't have a direct link to the file then click on the \"Convert download link\" button. Once you're done select \"Save and Test\"",
	"GS_STR_QUICKSTART_MOD_TEST" => "Write the name of your mod in the \"Mod name\" field. If you want to install it to a different directory then fill \"Dir name\" field. Press \">\" button to test your installation script",
	"GS_STR_QUICKSTART_MOD_VIEW" => "When it's done select \"Open mod folder\" to view the installed files. If you're satisfied with the result then move on to the next step. If not then see %m1%documentation%m2% and use commands",
	"GS_STR_QUICKSTART_MOD_LOGIN" => "%m1%Log in%m2% to the OFP GS website. Then select \"Add a new mod\"",
	"GS_STR_QUICKSTART_MOD_FORM" => "Fill the form fields. Copy installation script from the addonInstarrer program. Copy download size number from the \"Testing\" section.",
	"GS_STR_QUICKSTART_MOD_DONE" => "Finally click on the \"Add a New Mod\" to publish it. Other players can now install your mod",
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
	"GS_STR_QUICKSTART_TAB_JOIN_SERVER" => "Как подключиться?",
"GS_STR_QUICKSTART_TAB_MAKE_SERVER" => "Как устроить?",
"GS_STR_QUICKSTART_TAB_MAKE_MOD" => "How to add a mod?",
	"GS_STR_QUICKSTART_TAB_INSTALL_MOD" => "Как установить моды?",
	
	#Add a server
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Для начала нужно войти в аккаунт %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Добавьте новый сервер. Заполните поля для информации о сервере, на котором будете играть.",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Перейдите в раздел \"Расписание\". Задайте время начала игры",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Дополнительно: если на Вашем сервере используются моды, выберите и добавьте их в список. Вы также можете добавить свой собственный мод",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Сервер будет отображаться для всех после добавления времени начала игры. Игроки могут подключиться.",
	
	#Join server
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Вам понадобится Fwatch 1.16 и OFP Aspect Ratio сборки 2.07. %m1%Скачать%m2%<br><span style=\"font-size:small\">Пароль архива \"fwatch\". Извлеките его и запустите установщик. <a href=\"/fwatch/116test\">Больше информации</a>. Смотрите <a href=\"https://youtu.be/wD74VpadQY4\">видео</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Запустите игру, используя fwatch.exe. Вы увидите кнопку \"Mods\" в левом нижнем углу. Нажмите на неё, а затем на кнопку \"Расписание\". Выберите сервер из списка",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Нажмите два раза на название сервера, чтобы просмотреть опции. Если Вам не хватает необходимых модов, нажмите два раза на \"Скачать\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Дождитесь завершения установки. Установка не прервётся во время или при закрытии игры",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Как только установка закончится, перейдите к опциям сервера и нажмите два раза на \"Подключиться\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Так же есть возможность автоматически подключиться к запланированной игре",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Приятной игры!",
	
	#Add a mod
"GS_STR_QUICKSTART_MOD_LAUNCH" => "Go to fwatch\\data folder and launch addonInstarrer.exe",
"GS_STR_QUICKSTART_MOD_SCRIPT" => "Paste download links to your files in the \"Edit Script\" input. If you don't have a direct link to the file then click on the \"Convert download link\" button. Once you're done select \"Save and Test\"",
"GS_STR_QUICKSTART_MOD_TEST" => "Write the name of your mod in the \"Mod name\" field. If you want to install it to a different directory then fill \"Dir name\" field. Press \">\" button to test your installation script",
"GS_STR_QUICKSTART_MOD_VIEW" => "When it's done select \"Open mod folder\" to view the installed files. If you're satisfied with the result then move on to the next step. If not then see %m1%documentation%m2% and use commands",
"GS_STR_QUICKSTART_MOD_LOGIN" => "%m1%Log in%m2% to the OFP GS website. Then select \"Add a new mod\"",
"GS_STR_QUICKSTART_MOD_FORM" => "Fill the form fields. Copy installation script from the addonInstarrer program. Copy download size number from the \"Testing\" section.",
"GS_STR_QUICKSTART_MOD_DONE" => "Finally click on the \"Add a New Mod\" to publish it. Other players can now install your mod",
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
	"GS_STR_QUICKSTART_TAB_JOIN_SERVER" => "Jak dołączyć do serwera?",
	"GS_STR_QUICKSTART_TAB_MAKE_SERVER" => "Jak dodać serwer?",
	"GS_STR_QUICKSTART_TAB_MAKE_MOD" => "Jak dodać mod?",
	"GS_STR_QUICKSTART_TAB_INSTALL_MOD" => "Jak zainstalować mody?",
	
	#Add a server
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN" => "Najpierw zaloguj się przy pomocy konta %m1%",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV" => "Dodaj nowy wpis serwera. Wypełnij puste pola danymi o serwerze na którym będzieci grali",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE" => "Przejdź do sekcji \"Harmonogram\". Ustaw czas rozpoczęcia gry",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV" => "Dodatkowo: jeśli serwer używa modów to dodaj je z listy. Możesz także dodać własny mod",
	"GS_STR_QUICKSTART_FORORGANIZERS_READY" => "Po dodaniu czasu rozpoczęcia gry serwer pojawi się na publicznej liście. Gracze mogą już dołączyć",
	
	#Join server
	"GS_STR_QUICKSTART_FORPLAYERS_INSTALL" => "Zainstaluj Fwatch 1.16 oraz OFP Aspect Ratio pack 2.07. %m1%Pobierz%m2%<br><span style=\"font-size:small\">Hasło archiwum to \"fwatch\". Wypakuj je i uruchom instalator. <a href=\"/fwatch/116test\">Więcej informacji</a>. Patrz <a href=\"https://youtu.be/wD74VpadQY4\">film</a></span>",
	"GS_STR_QUICKSTART_FORPLAYERS_START" => "Uruchom grę przez fwatch.exe. W lewym dolnym rogu pojawi się przycisk \"Mods\". Kliknij na nim a potem na przycisku \"Plan Rozgrywek\". Wybierz serwer z listy",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV" => "Kliknij dwa razy na nazwie serwera żeby wyświetlić opcje. Jeśli nie masz wymaganych modów to kliknij dwa razy na \"Ściągnij\"",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL" => "Zaczekaj aż instalator skończy. Granie albo wyjście z gry nie ma wpływu na proces instalacji",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT" => "Po instalacji przejdź ponownie do opcji serwera i kliknij podwójnie na \"Dołącz\"",
	"GS_STR_QUICKSTART_FORPLAYERS_AUTO_CONNECT" => "Masz również opcję automatycznego podłączenia się do zaplanowanej gry",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN" => "Miłej zabawy!",
	
	#Add a mod
	"GS_STR_QUICKSTART_MOD_LAUNCH" => "Przejdź do katalogu fwatch\\data i uruchom addonInstarrer.exe",
	"GS_STR_QUICKSTART_MOD_SCRIPT" => "Wklej linki do ściągnięcia twoich plików w polu \"Edytuj Skrypt\". Jeśli nie masz bezpośredniego linku do pliku to naciśnij na przycisk \"Skonwertuj link\". Gdy skończysz wybierz \"Zapisz i Przetestuj\"",
	"GS_STR_QUICKSTART_MOD_TEST" => "Wpisz nazwę swojego moda w polu \"Nazwa moda\". Jeśli chcesz go zainstalować w innym katalogu to wypełnij pole \"Folder\". Naciśnij na przycisk \">\", żeby przetestować swój skrypt instalacyjny",
	"GS_STR_QUICKSTART_MOD_VIEW" => "Gdy instalacja się zakończy wybierz \"Otwórz mod folder\", żeby przejrzeć zainstalowane pliki. Jeśli odpowiada ci rezultat to przejdź do następnego kroku. Jeśli nie to przejrzyj %m1%dokumentację%m2% i użyj komend",
	"GS_STR_QUICKSTART_MOD_LOGIN" => "%m1%Zaloguj się%m2% na stronie OFP GS. Następnie wybierz \"Dodaj nowy mod\"",
	"GS_STR_QUICKSTART_MOD_FORM" => "Wypełnij formularz. Skopiuj skrypt instalacyjny z programu addonInstarrer. Skopiuj wielkość pobranych plików z sekcji \"Testowanie\"",
	"GS_STR_QUICKSTART_MOD_DONE" => "Na końcu wybierz \"Dodaj Nowy Mod\" by go opublikować. Inni gracze mogą teraz zainstalować twój mod",
	));
}

$sections = [
	[
		"id"         => "players",
		"title"      => "GS_STR_QUICKSTART_TAB_JOIN_SERVER",
		"paragraphs" => [
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
			]
		]
	],
	
	[
		"id"         => "organizers",
		"title"      => "GS_STR_QUICKSTART_TAB_MAKE_SERVER",
		"paragraphs" => [
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
				"string"    => "GS_STR_QUICKSTART_FORORGANIZERS_READY",
			]
		]
	],
	
	[
		"id"         => "modders",
		"title"      => "GS_STR_QUICKSTART_TAB_MAKE_MOD",
		"paragraphs" => [
			[
				"string"    => "GS_STR_QUICKSTART_FORPLAYERS_INSTALL",
				"image"     => "0_fwatch_installer",
				"arguments" => ["<A HREF=\"https://ofp-faguss.com/fwatch/download/fwatch116beta_installer.7z\">", "</a>"],
			],
			[
				"string"    => "GS_STR_QUICKSTART_MOD_LAUNCH",
				"image"     => "20_fwatchdata",
			],
			[
				"string"    => "GS_STR_QUICKSTART_MOD_SCRIPT",
				"image"     => "21_editscript",
			],
			[
				"string"    => "GS_STR_QUICKSTART_MOD_TEST",
				"image"     => "22_testscript",
			],
			[
				"string"    => "GS_STR_QUICKSTART_MOD_VIEW",
				"image"     => "23_testdone",
				"arguments" => ["<a href='install_scripts' target='_blank'>", "</a>", "<a href='../about' target='_blank'>", "</a>"],
			],
			[
				"string"    => "GS_STR_QUICKSTART_MOD_LOGIN",
				"image"     => "24_index",
				"arguments" => ["<a href='users/login.php' target='_blank'>","</a>"],
			],
			[
				"string" => "GS_STR_QUICKSTART_MOD_FORM",
				"image"     => "25_form",
			],
			[
				"string" => "GS_STR_QUICKSTART_MOD_DONE",
			]
		]
	]
];

// Tabs
echo '<ul id="quickstart_tabs" class="nav nav-tabs" role="tablist">';
$active = true;

foreach($sections as $section) {
	echo '<li role="presentation" class="'.($active?"active":"").'"><a href="#'.$section["id"].'" aria-controls="'.$section["id"].'" role="tab" data-toggle="tab">'.lang($section["title"]).'</a></li>';
	$active = false;
}
	
echo
	'<li><a href="https://ofp-faguss.com/fwatch/modmanager">'.lang("GS_STR_QUICKSTART_TAB_INSTALL_MOD").'</a></li>
</ul>
<div class="jumbotron">
<div class="tab-content">';


// Tab content
$active = true;

foreach ($sections as $section) {
	echo '
	<div role="tabpanel" class="tab-pane '.($active?"active":"").'" id="'.$section["id"].'">
	<h2 align="center" style="color:#cc4f80;font-size:45px">'.lang($section["title"]).'</h2><br>';
	$active = false;
	
	forEach ($section["paragraphs"] as $pkey=>$paragraph) {
		$arguments = isset($paragraph["arguments"]) ? $paragraph["arguments"] : [];
		
		if (isset($paragraph["string"]))
			echo "<p align=\"center\">".lang($paragraph["string"], $arguments)."</p>";
		
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
		
		if (isset($paragraph["list"])) {
			echo '<ul>';
			foreach($paragraph["list"] as $item)
				echo '<li>'.lang($item).'</li>';
			echo '</ul>';
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
