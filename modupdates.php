<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";

if ($lang["THIS_CODE"] == "en-US") {
	$lang = array_merge($lang, array(
		#Mod updates page
		"GS_MU_DESCRIPTION" => "Description of the mod versioning system in the OFP Game Schedule",
		
		#Section titles
		"GS_MU_SECTION1_TITLE" => "Adding a new version",
		"GS_MU_SECTION2_TITLE" => "Example",
		"GS_MU_SECTION3_TITLE" => "Editing an existing version",
		"GS_MU_SECTION4_TITLE" => "Jumping between versions",
		"GS_MU_SECTION5_TITLE" => "Testing",
		
		#Add a new version
		"GS_MU_SECTION1_PAR1" => "On the OFP Game Schedule website you can register a change to your mod files and players will be able to download the update.",
		"GS_MU_SECTION1_PAR2" => "<b>Note:</b> there's no need to change version if you only change mod details (e.g. name).",
		"GS_MU_SECTION1_PAR3" => "After modifying mod files and uploading them to the host of your choice, go to the OFP GS main page. Find your mod and select \"Installation\".",
		"GS_MU_SECTION1_PAR4" => "<b>OPTION #1:</b> If you have overwritten existing download package then little action is required. Website automatically suggest a new version number and selects last used installation script. Just fill in the patch notes and click on the \"Add New Version\" button.</b>",
		"GS_MU_SECTION1_PAR5" => "<b>OPTION #2:</b> If you have a new file to download then select \"Installation script: Add a new script\" and paste the URL below. Fill in the correct download size and patch notes and then click on the \"Add New Version\".",
		"GS_MU_SECTION1_PAR6" => "When users check for updates they will download the latest mod version number from the website and compare it against the number stored in the identification file <code>__gs_id</code> inside the modfolder. If the latter is lower then the option to update the mod will appear.",
		"GS_MU_SECTION1_PAR7" => "Clicking on the option starts the update process. Website combines installation scripts based on what the user is missing. If the same script is repeated multiple times (option #1) it will be served only once in order to avoid duplicating downloads (see example below).",
		"GS_MU_SECTION1_PAR8" => "Installer <a href=\"install_scripts\" target=\"_blank\">executes</a> the instructions.",
		
		#Example
		"GS_MU_SECTION2_PAR1" => "Here's an example of a mod that reuses the same installation script (option #1).",
		"GS_MU_SECTION2_PAR2" => "All versions use the same installation script. Users, regardless of their version, will download <code>mod.zip</code> only once in order to get to the latest version.",
		"GS_MU_SECTION2_PAR3" => "You can see what the installation process will look like by clicking on the \"Preview Installation\" link on the bottom of the \"Installation\" page.",
		"GS_MU_SECTION2_PAR4" => "Every time this mod gets updated the users will redownload the same file. This might get burdensome with large archives so instead you could provide a new, smaller package that only contains patched files (option #2).",
		"GS_MU_SECTION2_PAR5" => "In this example new users will download all three files.",
		"GS_MU_SECTION2_PAR6" => "Players who already have the mod will download one or two patches.",
		
		#Edit existing version
		"GS_MU_SECTION3_PAR1" => "To change previously added mod version go to the \"Installation\" page and select number from the version list.",
		"GS_MU_SECTION3_PAR2" => "You can use script from any other version by selecting it from the \"Installation script\" list. Alternatively select \"Add a new script\" to make this version use a new one.",
		"GS_MU_SECTION3_PAR3" => "Contents of a script can be modified here as well. This will affect all the versions that use this particular script. For example: you have changed the host for your files and now you want to update all URLs. In case of a single script (option #1) you only have to do it once in any version. With multiple scripts (option #2) you'll have to modify all of them.",
		"GS_MU_SECTION3_PAR4" => "Editing an existing version will not cause file changes for users who already downloaded this version. You'll have to add a new version.",
		"GS_MU_SECTION3_PAR5" => "It is not possible to remove an update because it would lead to a situation where users have newer version of the mod than the website database.",
		
		#Jumps between versions
		"GS_MU_SECTION4_PAR1" => "Jumps provide alternative installation process for the new users or users with an older version of the mod.",
		"GS_MU_SECTION4_PAR2" => "Look again at the example with multiple scripts (option #2).",
		"GS_MU_SECTION4_PAR3" => "Let's assume that <code>patch2.zip</code> already contains all the changes from the <code>patch1.zip</code> so the latter is obsolete. It's possible to skip it so that players will download less data.",
		"GS_MU_SECTION4_PAR4" => "Go to the \"Installation\" page and select \"Jumps Between Versions\". In the field \"From version\" you determine source of the jump. Type \"version = 1\" to target users with the first version of the mod. Select below \"Installation script: Same as in version 1.1 to 1.2\" which downloads <code>patch2.zip</code>. Click on \"Add New Jump\".",
        "GS_MU_SECTION4_PAR5" => "In the preview you'll see that new users will download <code>mod.zip</code> and then <code>patch2.zip</code>. File <code>patch1.zip</code> will be ignored.",
		"GS_MU_SECTION4_PAR6" => "It's possible to simultaneously provide a single large package (<code>mod_new.zip</code>) for the new users and small patches (<code>patch.zip</code>) for the existing users (option #1 and #2).",
		"GS_MU_SECTION4_PAR7" => "In the field \"From version\" write \"version = 0\" to target new users. From the list \"To version\" select \"Always to the newest one\". Write the new installation script below and click on the \"Add New Jump\".",
		"GS_MU_SECTION4_PAR8" => "Now every time you add a new version this jump will be automatically adjusted. Don't forget to upload new <code>mod_new.zip</code>.",
		
		#Testing
		"GS_MU_SECTION5_PAR1" => "Create a new mod just for testing. Add a password to hide it from other users.",
		"GS_MU_SECTION5_PAR2" => "Now you can add new versions and jumps to test how they work.",
		"GS_MU_SECTION5_PAR3" => "To download this mod launch the game, select MODS --> [Download Mods] --> [Show Private Mods]. Type in password and press ENTER.",
		"GS_MU_SECTION5_PAR4" => "Now the mod will appear on the list.",
		"GS_MU_SECTION5_PAR5" => "See also <a href=\"install_scripts#testing\">testing installation scripts</a>.",
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
		#Mod updates page
		"GS_MU_DESCRIPTION" => "Opis systemu wersjonowania modów w Rozkładzie Rozgrywek do OFP",
		
		#Section titles
		"GS_MU_SECTION1_TITLE" => "Dodawanie nowej wersji",
		"GS_MU_SECTION2_TITLE" => "Przykład",
		"GS_MU_SECTION3_TITLE" => "Zmienianie istniejącej wersji",
		"GS_MU_SECTION4_TITLE" => "Skakanie pomiędzy wersjami",
		"GS_MU_SECTION5_TITLE" => "Testowanie",
		
		#Add a new version
		"GS_MU_SECTION1_PAR1" => "Na stronie Rozkładu Rozgrywek do OFP możesz zarejestrować zmianę w plikach twojego modu i gracze będą mogli pobrać to uaktualnienie.",
		"GS_MU_SECTION1_PAR2" => "<b>Uwaga:</b> nie ma potrzeby dodawania nowej wersji jeśli zmieniasz tylko szczegóły moda (np. nazwa).",
		"GS_MU_SECTION1_PAR3" => "Po zmodyfikowaniu plików w modzie i zapisaniu ich na wybranym serwerze przejdź do strony głównej RR OFP. Znajdź swój modfolder i wybierz \"Instalacja\".",
		"GS_MU_SECTION1_PAR4" => "<b>WARIANT #1:</b> Jeśli nadpisałeś istniejącą paczkę to procedura jest bardzo prosta. Strona automatycznie zasugeruje nowy numer wersji i wybierze ostatni użyty skrypt instalacyjny. Wypełnij tylko opis zmian i naciśnij na \"Dodaj Nową Wersję\".",
		"GS_MU_SECTION1_PAR5" => "<b>WARIANT #2:</b> Jeśli utworzyłeś nowe archiwum do ściągnięcia to wybierz \"Skrypt instalacyjny: dodaj nowy skrypt\" i wklej adres URL poniżej. Wpisz rozmiar pliku do ściągnięcia i opis zmian. Na koniec naciśnij na \"Dodaj Nową Wersję\".",
		"GS_MU_SECTION1_PAR6" => "Użytkownicy, sprawdzając aktualizacje, ściągają najnowszy numer wersji moda i porównują go z numerem zapisanym w pliku identyfikacyjnym <code>__gs_id</code> znajdującym się w modfolderze. Jeśli ten ostatni jest mniejszy to wtedy pojawi się opcja uaktualnienia moda.",
		"GS_MU_SECTION1_PAR7" => "Wybranie tej opcji rozpoczyna proces uaktualnienia. Strona łączy skrypty instalacyjne na podstawie brakującej liczby aktualizacji. Jeśli ten sam skrypt powtarza się wielokrotnie (wariant #1) to zostanie on podany tylko raz aby uniknąć ściągania tego samego pliku w kółko (patrz przykład poniżej).",		
		"GS_MU_SECTION1_PAR8" => "Instalator <a href=\"install_scripts\" target=\"_blank\">wykonuje</a> instrukcje.",
		
		#Example
		"GS_MU_SECTION2_PAR1" => "Oto przykład modu który wielokrotnie wykorzystuje ten sam skrypt instalacyjny (wariant #1).",
		"GS_MU_SECTION2_PAR2" => "Wszystkie aktualizacje posługują się tym samym skryptem instalacyjnym. Użytkownik, niezależnie od posiadanej wersji, ściągnie plik <code>mod.zip</code> tylko raz aby przejść do najnowszej wersji",
		"GS_MU_SECTION2_PAR3" => "Proces instalacyjny możesz podejrzeć poprzez odsyłacz \"Podgląd Instalacji\" na dole strony \"Instalacja\".",
		"GS_MU_SECTION2_PAR4" => "Przy każdej aktualizacji tego moda użytkownik będzie ściągał ten sam plik. To może okazać się problemem jeśli archiwum jest duże więc zamiast tego mógłbyś dostarczyć nową, małą paczkę która zawiera wyłącznie poprawione pliki (wariant #2).",
		"GS_MU_SECTION2_PAR5" => "W tym przykładzie nowi użytkownicy ściągną wszystkie trzy pliki.",
		"GS_MU_SECTION2_PAR6" => "Gracze którzy już posiadają ten mod ściągną jedną lub dwie łatki.",
		
		#Edit existing version
		"GS_MU_SECTION3_PAR1" => "Żeby zmodyfikować wcześniej dodaną wersję przejdź do strony \"Instalacja\" i wybierz numer z listy wersji.",
		"GS_MU_SECTION3_PAR2" => "Możesz wykorzystać skrypt z dowolnej innej wersji wybierając go z listy \"Skrypt instalacyjny\". Alternatywnie wybierz \"Dodaj nowy skrypt\" żeby zamienić obecny skrypt na nowy.",
		"GS_MU_SECTION3_PAR3" => "Treść skryptu może tutaj zostać zmieniona. Będzie to dotyczyć każdej wersji wykorzystującej tej skrypt. Na przykład: zmieniłeś serwer na którym przechowujesz swoje pliki i chciałbyś teraz podmienić wszystkie adresy URL. W przypadku pojedynczego skryptu (wariant #1) wystarczy że zmienisz go raz w którejkolwiek z wersji. Przy wielu skryptach (wariant #2) będziesz musiał poprawić każdy z nich pojedynczo.",
		"GS_MU_SECTION3_PAR4" => "Edycja istniejącej wersji nie spowoduje zmian w plikach u użytkowników, którzy już pobrali tą wersję. Należy dodać nową wersję moda.",
		"GS_MU_SECTION3_PAR5" => "Nie jest możliwe usuwanie wersji ponieważ prowadziłoby do sytuacji w której użytkownicy mają wersję nowszą niż baza danych na stronie.",
		
		#Jumps between versions
		"GS_MU_SECTION4_PAR1" => "Skoki tworzą alternatywną scieżkę instalacji dla nowych użytkowników lub posiadaczy starszej wersji moda.",
		"GS_MU_SECTION4_PAR2" => "Wrócmy do przykładu z wieloma skryptami instalacyjnymi (wariant #2).",
		"GS_MU_SECTION4_PAR3" => "Załóżmy, że archiwum <code>patch2.zip</code> zawiera już wszystkie zmiany z <code>patch1.zip</code> i to ostatnie jest zbędne. Możliwe jest jego pominięcie tak by graczej mieli mniej danych do ściągnięcia.",
		"GS_MU_SECTION4_PAR4" => "Przejdź do strony \"Instalacja\". Wybierz \"Skoki pomiędzy wersjami\" na górze strony. W polu \"Z wersji\" wybierasz źródło skoku. Wpisz \"version = 1\" żeby zaadresować użytkowników z pierwszą wersją moda. Poniżej wybierz \"Skrypt instalacyjny: Taki sam jak w wersji 1.1 do 1.2\" który ściąga <code>patch2.zip</code>. Naciśnij na \"Dodaj nowy skok\".",
        "GS_MU_SECTION4_PAR5" => "W podglądzie zobaczysz że nowi użytkownicy ściągną <code>mod.zip</code> oraz <code>patch2.zip</code>. Plik <code>patch1.zip</code> zostanie pominięty.",
		"GS_MU_SECTION4_PAR6" => "Można również jednocześnie dostarczać jedną dużą paczkę (<code>mod_new.zip</code>) dla nowych użytkowników i małe łatki (<code>patch.zip</code>) dla obecnych użytkowników (wariant #1 i #2).",
		"GS_MU_SECTION4_PAR7" => "W polu \"Z wersji\" wpisz \"version = 0\" żeby zaadresować użytkowników którzy jeszcze nie posiadają tego modu. Z listy \"Do wersji\" wybierz \"Zawsze do najnowszej\". Poniżej napisz nowy skrypt instalacyjny i naciśnij na \"Dodaj nowy skok\".",
		"GS_MU_SECTION4_PAR8" => "Od teraz, za każdym razem gdy dodasz nową wersję ten skok zostanie automatycznie dopasowany. Nie zapomnij uaktualnić <code>mod_new.zip</code>.",
		
		#Testing
		"GS_MU_SECTION5_PAR1" => "Utwórz nowy mod wyłącznie do testowania. Dodaj hasło, żeby nie pokazywał się innym użytkownikom.",
		"GS_MU_SECTION5_PAR2" => "Teraz możesz dodawać nowe wersje i skoki by sprawdzić jak działają.",
		"GS_MU_SECTION5_PAR3" => "Żeby ściągnąć ten mod włącz grę, wybierz MODY --> [Ściągnij mody] --> [Pokaż prywatne mody]. Wpisz hasło i wciśnij ENTER.",
		"GS_MU_SECTION5_PAR4" => "Teraz mod będzie widoczny się na liście.",
		"GS_MU_SECTION5_PAR5" => "Zobacz także <a href=\"install_scripts#testing\">testowanie skryptów instalacyjnych</a>.",
	));
}


if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
#Mod updates page
"GS_MU_DESCRIPTION" => "Описание системы версий модов в расписании игр OFP. Переведено Google",

#Section titles
"GS_MU_SECTION1_TITLE" => "Добавление новой версии",
"GS_MU_SECTION2_TITLE" => "Пример",
"GS_MU_SECTION3_TITLE" => "Редактирование существующей версии",
"GS_MU_SECTION4_TITLE" => "Перескакивание между версиями",
"GS_MU_SECTION5_TITLE" => "Тестирование",

#Add a new version
"GS_MU_SECTION1_PAR1" => "На веб-сайте расписания игр OFP вы можете зарегистрировать изменение файлов вашего мода, и игроки смогут загрузить обновление.",
"GS_MU_SECTION1_PAR2" => "<b>Примечание:</b> нет необходимости менять версию, если вы меняете только детали мода (например, название).",
"GS_MU_SECTION1_PAR3" => "После изменения файлов мода и загрузки их на выбранный вами хост перейдите на главную страницу OFP GS. Найдите свой мод и выберите \"Установка\".",
"GS_MU_SECTION1_PAR4" => "<b>ВАРИАНТ №1.</b> Если вы перезаписали существующий загружаемый пакет, от вас потребуется немного действий. Веб-сайт автоматически предлагает новый номер версии и выбирает последний использовавшийся сценарий установки. Просто заполните примечания к патчу и нажмите кнопку \"Добавить новую версию\".</b>",
"GS_MU_SECTION1_PAR5" => "<b>ВАРИАНТ #2:</b> Если у вас есть новый файл для загрузки, выберите \"Сценарий установки: Добавить новый скрипт\" и вставьте URL-адрес ниже. Заполните правильный размер загрузки и примечания к патчу, а затем нажмите «Добавить новую версию».",
"GS_MU_SECTION1_PAR6" => "Когда пользователи проверяют наличие обновлений, они загружают номер последней версии мода с веб-сайта и сравнивают его с номером, хранящимся в идентификационном файле <code>__gs_id</code> внутри папки мода. Если последний ниже, появится возможность обновить мод.",
"GS_MU_SECTION1_PAR7" => "Нажатие на опцию запускает процесс обновления. Веб-сайт объединяет сценарии установки в зависимости от того, чего не хватает пользователю. Если один и тот же скрипт повторяется несколько раз (вариант №1), он будет обслуживаться только один раз, чтобы избежать дублирования загрузок (см. пример ниже).",
"GS_MU_SECTION1_PAR8" => "Установщик <a href=\"install_scripts\" target=\"_blank\">выполняет</a> инструкции.",

#Example
"GS_MU_SECTION2_PAR1" => "Вот пример мода, который повторно использует один и тот же скрипт установки (вариант №1).",
"GS_MU_SECTION2_PAR2" => "Все версии используют один и тот же сценарий установки. Пользователи, независимо от их версии, будут загружать <code>mod.zip</code> только один раз, чтобы получить последнюю версию.",
"GS_MU_SECTION2_PAR3" => "Вы можете увидеть, как будет выглядеть процесс установки, щелкнув ссылку «Предварительный просмотр установки» в нижней части страницы «Установка».",
"GS_MU_SECTION2_PAR4" => "Каждый раз, когда этот мод обновляется, пользователи будут повторно загружать один и тот же файл. Это может стать обременительным для больших архивов, поэтому вместо этого вы можете предоставить новый пакет меньшего размера, содержащий только пропатченные файлы (вариант № 2).",
"GS_MU_SECTION2_PAR5" => "В этом примере новые пользователи будут загружать все три файла.",
"GS_MU_SECTION2_PAR6" => "Игроки, у которых уже есть мод, загрузят один или два патча.",

#Edit existing version
"GS_MU_SECTION3_PAR1" => "Чтобы изменить ранее добавленную версию мода, перейдите на страницу «Установка» и выберите номер из списка версий.",
"GS_MU_SECTION3_PAR2" => "Вы можете использовать скрипт из любой другой версии, выбрав его из списка \"Скрипт установки\". В качестве альтернативы выберите \"Добавить новый скрипт\", чтобы эта версия использовала новый.",
"GS_MU_SECTION3_PAR3" => "Здесь также можно изменить содержимое скрипта. Это повлияет на все версии, использующие этот конкретный скрипт. Например: вы изменили хост для своих файлов и теперь хотите обновить все URL-адреса. В случае одного скрипта (вариант №1) вам нужно сделать это только один раз в любой версии. При наличии нескольких сценариев (вариант №2) вам придется модифицировать их все.",
"GS_MU_SECTION3_PAR4" => "Редактирование существующей версии не приведет к изменению файла для пользователей, которые уже загрузили эту версию. Вам придется добавить новую версию.",
"GS_MU_SECTION3_PAR5" => "Невозможно удалить обновление, потому что это приведет к ситуации, когда у пользователей будет более новая версия мода, чем база данных веб-сайта.",

#Jumps between versions
"GS_MU_SECTION4_PAR1" => "Jumps предоставляет альтернативный процесс установки для новых пользователей или пользователей с более старой версией мода.",
"GS_MU_SECTION4_PAR2" => "Посмотрите еще раз на пример с несколькими скриптами (вариант №2).",
"GS_MU_SECTION4_PAR3" => "Предположим, что <code>patch2.zip</code> уже содержит все изменения из <code>patch1.zip</code>, поэтому последний устарел. Его можно пропустить, чтобы игроки скачивали меньше данных.",
"GS_MU_SECTION4_PAR4" => "Перейдите на страницу \"Установка\" и выберите \"Переходы между версиями\". В поле «От версии» вы указываете источник перехода. Введите \"version = 1\", чтобы нацелить пользователей на первую версию мода. Выберите ниже \"Сценарий установки: такой же, как в версиях с 1.1 по 1.2\", который загружает <code>patch2.zip</code>. Нажмите на \"Добавить новый прыжок\".",
"GS_MU_SECTION4_PAR5" => "В предварительном просмотре вы увидите, что новые пользователи будут загружать <code>mod.zip</code>, а затем <code>patch2.zip</code>. Файл <code>patch1.zip</code> будет проигнорирован.",
"GS_MU_SECTION4_PAR6" => "Можно одновременно предоставить один большой пакет (<code>mod_new.zip</code>) для новых пользователей и небольшие патчи (<code>patch.zip</code>) для существующих пользователей (варианты #1 и # 2).",
"GS_MU_SECTION4_PAR7" => "В поле \"Из версии\" напишите \"версия = 0\" для новых пользователей. Из списка «К версии» выберите «Всегда к самой новой». Напишите новый сценарий установки ниже и нажмите «Добавить новый переход».",
"GS_MU_SECTION4_PAR8" => "Теперь каждый раз, когда вы добавляете новую версию, этот прыжок будет автоматически корректироваться. Не забудьте загрузить новый <code>mod_new.zip</code>.",
		
#Testing
"GS_MU_SECTION5_PAR1" => "Создайте новый мод только для тестирования. Добавьте пароль, чтобы скрыть его от других пользователей.",
"GS_MU_SECTION5_PAR2" => "Теперь вы можете добавлять новые версии и переходы, чтобы проверить, как они работают.",
"GS_MU_SECTION5_PAR3" => "Чтобы загрузить этот мод, запустите игру, выберите МОДЫ --> [Скачать моды] --> [Показать частные моды]. Введите пароль и нажмите ENTER.",
"GS_MU_SECTION5_PAR4" => "Теперь мод появится в списке.",
"GS_MU_SECTION5_PAR5" => "См. также <a href=\"install_scripts#testing\">тестирование сценариев установки</a>.",
	));
}
?>

<div id="page-wrapper">
	<div class="container">
	
<?php
languageSwitcher();

echo "
<div class=\"jumbotron\">
	<h1 align=\"center\">".lang("GS_STR_MOD_UPDATES")."</h1>
	<p align=\"center\" class=\"text-muted\">".lang("GS_MU_DESCRIPTION")."</p>
	<p align=\"center\" style=\"font-size: 1em;\">";
	
$anchors = ["addnew", "example", "edit", "jump", "test"];

foreach($anchors as $id=>$anchor) {
	$index = $id + 1;
	echo "<a href=\"#{$anchor}\">".lang("GS_MU_SECTION{$index}_TITLE")."</a> &nbsp; &nbsp; &nbsp;";
}
		
echo "
	</p>
</div>";

$paragraphs = [
    [ //Section 1
		"1", 
		"2", 
		"br", 
		"3", 
		"1_installation.png", 
		"br", 
		"*4", 
		"2_option1.png", 
		"br", 
		"*5", 
		"3_option2.png", 
		"br", 
		"6", 
		"4_availableupdates.jpg", 
		"5_downloadmods.jpg", 
		"7", 
		"8"
	],
    [ //Section 2
		"1", 
		"6_example1.png", 
		"2", 
		"3", 
		"7_preview1.png", 
		"8_preview2.png", 
		"br", 
		"4", 
		"9_example2.png", 
		"5", 
		"10_preview3.png", 
		"6", 
		"11_preview4.png"
	],
    [ //Section 3
		"1", 
		"12_editexisting.png", 
		"2", 
		"3", 
		"4", 
		"br", 
		"5"
	],
    [ //Section 4
		"1", 
		"2", 
		"13_path.png", 
		"3", 
		"14_pathjump.png", 
		"br", 
		"4", 
		"15_jumpadd.png", 
		"5", 
		"16_jumppreview.png", 
		"br", 
		"br", 
		"6", 
		"7", 
		"17_jumpnewest.png", 
		"18_jumpnewestpath.png", 
		"8", 
		"19_jumpnewestpath2.png", 
		"20_jumpnewestpreview1.png", 
		"21_jumpnewestpreview2.png"
	],
    [ //Section 5
		"1", 
		"22_modpassword.png", 
		"2",
		"br",
		"3",
		"23_modpasswordgame.png", 
		"4",
		"24_privatemodonthelist.png", 
		"5"
	],
];

foreach($paragraphs as $index=>$paragraph) {
    $section_number = $index + 1;
    
    echo "<a name=\"".$anchors[$index]."\"></a><br>
    <div class=\"panel panel-default betweencommands\">
    <div class=\"panel-heading\"><strong>".lang("GS_MU_SECTION{$section_number}_TITLE")."</strong></div>
    <div class=\"panel-body\">";
    
    foreach($paragraph as $item) {
        if ($item == "br")
            echo "<br>";
        else
            if (strpos($item,".") !== FALSE) {
                $parts = explode(".", $item);
                echo "<div class=\"text-center\">
				<img src=\"images/modupdate/{$parts[0]}_" . substr($lang["THIS_CODE"],0,2) . ".{$parts[1]}\" alt=\"\" class=\"img-thumbnail blackborder\" style=\"width: 40%;\">
                </div><br>";
            } else {
                $li = false;
                
                if (substr($item,0,1) == "*") {
                    $li   = true;
                    $item = substr($item,1);
                }
                
                if ($li)
                    echo "<ul><li>";
                else
                    echo "<p>";
            
                echo lang("GS_MU_SECTION{$section_number}_PAR{$item}");
                
                if ($li)
                    echo "</li></ul>";
                else
                    echo "</p>";
            }
    }
    
    echo "</div>
	</div><!-- /panel -->";
}
?>	

	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>