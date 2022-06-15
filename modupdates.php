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
		
		#Add a new version
		"GS_MU_SECTION1_PAR1" => "OFP Game Schedule website allows you to register a new mod version and distribute the new installation process to the users.",
		"GS_MU_SECTION1_PAR2" => "<b>Note:</b> there's no need to update version if you only change mod details (e.g. name).",
		"GS_MU_SECTION1_PAR3" => "After modifying mod files and uploading them to the host of your choice, go to the OFP GS main page. Find your mod and select \"Installation\".",
		"GS_MU_SECTION1_PAR4" => "<b>OPTION #1:</b> If you have overwritten existing download package then little action is required. Website automatically suggest a new version number and selects last used installation script. Just fill in the patch notes and click on the \"Add New Version\" button.</b>",
		"GS_MU_SECTION1_PAR5" => "<b>OPTION #2:</b> If you have a new file to download then select \"Installation script: Add a new script\" and paste the URL below. Fill in the correct download size and patch notes and then click on the \"Add New Version\".",
		"GS_MU_SECTION1_PAR6" => "When users check for updates they will download the latest mod version number from the website and compare it against the number stored in the identification file <code>__gs_id</code> inside the modfolder. If the latter is lower then the option to update the mod will appear.",
		"GS_MU_SECTION1_PAR7" => "Clicking on the option starts the update process. Website combines installation scripts based on what the user is missing. Scripts that are repeated (option #1) are ignored to avoid duplicating downloads (see example below).",
		"GS_MU_SECTION1_PAR8" => "Installer downloads this compilation of instructions and <a href=\"install_scripts\" target=\"_blank\">executes</a> it.",
		
		#Example
		"GS_MU_SECTION2_PAR1" => "Here's an example of a mod that reuses the same installation script (option #1).",
		"GS_MU_SECTION2_PAR2" => "All versions use the same installation script so that the user, regardless of their version, will download <code>mod.zip</code> only once in order to get to the newest version.",
		"GS_MU_SECTION2_PAR3" => "You can see what the installation process will look like by clicking on the \"Preview Installation\" link on the on the bottom of the \"Installation\" page.",
		"GS_MU_SECTION2_PAR4" => "Every time this mod gets updated the users will redownload the same file. This might get burdensome with large archives so instead you could provide a new, smaller package that only contains patched files (option #2).",
		"GS_MU_SECTION2_PAR5" => "In this example new users will download all three files.",
		"GS_MU_SECTION2_PAR6" => "Players who already have the mod will download one or two patches.",
		
		#Edit existing version
		"GS_MU_SECTION3_PAR1" => "To modify an update that you've added before go to the \"Installation\" page and select version number from the version list.",
		"GS_MU_SECTION3_PAR2" => "You can freely assign script from any other version by using the \"Installation script\" drop-down. Option \"Add a new script\" will replace the current script with a new one. Scripts that aren't assigned to any version are deleted.",
		"GS_MU_SECTION3_PAR3" => "Contents of an installation script can be changed here as well. Be aware that this will change installation process for all the versions that use this script. For example: you have changed the host for your files and now you want to update all URLs. In case of a single script (option #1) you only have to change it once in any of the versions. With multiple scripts (option #2) you'll have to modify all of them.",
		"GS_MU_SECTION3_PAR4" => "It is not possible to remove an update because it would lead to a situation where users have newer version of the mod than the website database.",
		
		#Jumps between versions
		"GS_MU_SECTION4_PAR1" => "Jumps are used to provide alternative installation process for new users or users with an older version of the mod.",
		"GS_MU_SECTION4_PAR2" => "Look again at the example with multiple scripts (option #2).",
		"GS_MU_SECTION4_PAR3" => "Let's assume that <code>patch2.zip</code> already contains all the changes from the <code>patch1.zip</code> and the latter is obsolete. It's possible to skip it so that players will download less data.",
		"GS_MU_SECTION4_PAR4" => "Go to the \"Installation\" page. Select \"Jumps Between Versions\" on the top of the page. In the field \"From version\" you determine source of the jump. Type \"version = 1\" to target users with the first version of the mod. Select below \"Installation script: Same as in version 1.1 to 1.2\" which downloads <code>patch2.zip</code>. Click on \"Add New Jump\".",
        "GS_MU_SECTION4_PAR5" => "In the preview you'll see that new users will download <code>mod.zip</code> and then <code>patch2.zip</code>. File <code>patch1.zip</code> will be ignored.",
		"GS_MU_SECTION4_PAR6" => "It's possible to provide both a single package (<code>mod_new.zip</code>) for the new users and small patches (<code>patch.zip</code>) for existing users (option #1 and #2).",
		"GS_MU_SECTION4_PAR7" => "In the field \"From version\" write \"version = 0\" to target new users. From the list \"To version\" select \"Always to the newest one\". Write the new installation script below and click on the \"Add New Jump\".",
		"GS_MU_SECTION4_PAR8" => "Now every time you add a new version this jump will be automatically adjusted. Don't forget to upload new <code>mod_new.zip</code>."
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
		
		#Add a new version
		"GS_MU_SECTION1_PAR1" => "Strona Rozkładu Rozgrywek do OFP daje możliwość zarejestrowania nowej wersji moda i dystrybucję nowego procesu instalacyjnego do użytkowników.",
		"GS_MU_SECTION1_PAR2" => "<b>Uwaga:</b> nie ma potrzeby dodawania nowej wersji jeśli zmieniasz tylko szczegóły moda (np. nazwa).",
		"GS_MU_SECTION1_PAR3" => "Po zmodyfikowaniu plików w modzie i zapisaniu ich na wybranym serwerze przejdź do strony głównej RR OFP. Znajdź swój modfolder i wybierz \"Instalacja\".",
		"GS_MU_SECTION1_PAR4" => "<b>WARIANT #1:</b> Jeśli nadpisałeś istniejącą paczkę to procedura jest bardzo prosta. Strona automatycznie zasugeruje nowy numer wersji i wybierze ostatni użyty skrypt instalacyjny. Wypełnij tylko opis zmian i naciśnij na \"Dodaj Nową Wersję\".",
		"GS_MU_SECTION1_PAR5" => "<b>WARIANT #2:</b> Jeśli utworzyłeś nowe archiwum do ściągnięcia to wybierz \"Skrypt instalacyjny: dodaj nowy skrypt\" i wklej adres URL poniżej. Wpisz rozmiar pliku do ściągnięcia i opis zmian. Na koniec naciśnij na \"Dodaj Nową Wersję\".",
		"GS_MU_SECTION1_PAR6" => "Użytkownicy, sprawdzając aktualizacje, ściągają najnowszy numer wersji moda i porównują go z numerem zapisanym w pliku identyfikacyjnym <code>__gs_id</code> znajdującym się w modfolderze. Jeśli ten ostatni jest mniejszy to wtedy pojawi się opcja uaktualnienia moda.",
		"GS_MU_SECTION1_PAR7" => "Wybranie tej opcji rozpoczyna proces uaktualnienia. Strona łączy skrypty instalacyjne na podstawie brakującej liczby aktualizacji. Powtarzające się skrypty (wariant #1) są ignorowane aby uniknąć ściągania tego samego pliku (patrz przykład poniżej).",
		"GS_MU_SECTION1_PAR8" => "Instalator ściąga wyżej wymienioną kompilację i <a href=\"install_scripts\" target=\"_blank\">wykonuje jej instrukcje</a>.",
		
		#Example
		"GS_MU_SECTION2_PAR1" => "Oto przykład modu który wielokrotnie wykorzystuje ten sam skrypt instalacyjny (wariant #1).",
		"GS_MU_SECTION2_PAR2" => "Wszystkie aktualizacje posługują się tym samym skryptem instalacyjnym więc użytkownik, niezależnie od posiadanej wersji, ściągnie plik <code>mod.zip</code> tylko raz by móc przejść do najnowszej wersji",
		"GS_MU_SECTION2_PAR3" => "Proces instalacyjny możesz podejrzeć poprzez odsyłacz \"Podgląd Instalacji\" na dole strony \"Instalacja\".",
		"GS_MU_SECTION2_PAR4" => "Przy każdej aktualizacji tego moda użytkownik będzie ściągał ten sam plik. To może okazać się problemem jeśli archiwum jest duże więc zamiast tego mógłbyś dostarczyć nową, małą paczkę która zawiera wyłącznie poprawione pliki (wariant #2).",
		"GS_MU_SECTION2_PAR5" => "W tym przykładzie nowi użytkownicy ściągną wszystkie trzy pliki.",
		"GS_MU_SECTION2_PAR6" => "Gracze którzy już posiadają ten mod ściągną jedną lub dwie łatki.",
		
		#Edit existing version
		"GS_MU_SECTION3_PAR1" => "Żeby zmodyfikować wcześniej dodaną wersję przejdź do strony \"Instalacja\" i wybierz numer z listy wersji.",
		"GS_MU_SECTION3_PAR2" => "Możesz dowolnie przypisywać skrypty instalacyjne do różnych wersji przy pomocy listy \"Skrypt instalacyjny\". Opcja \"Dodaj nowy skrypt\" zamieni obecny skrypt na nowy. Skrypty niepodpięte do jakiejkolwiek wersji zostaną usunięte.",
		"GS_MU_SECTION3_PAR3" => "Treść skryptu instalacyjnego może tutaj zostać zmieniona. Pamiętaj że zmodyfikuje to proces instalacji dla wszystkich wersji które wykorzystują ten skrypt. Na przykład: zmieniłeś serwer na którym przechowujesz swoje pliki i chciałbyś teraz podmienić wszystkie adresy URL. W przypadku pojedynczego skryptu (wariant #1) wystarczy że zmienisz go raz w którejkolwiek z wersji. Przy wielu skryptach (wariant #2) będziesz musiał poprawić każdy z nich pojedynczo.",
		"GS_MU_SECTION3_PAR4" => "Nie jest możliwe usuwanie wersji ponieważ prowadziłoby do sytuacji w której użytkownicy mają wersję nowszą niż baza danych na stronie.",
		
		#Jumps between versions
		"GS_MU_SECTION4_PAR1" => "Skoki służą do utworzenia alternatywnej scieżki instalacji dla nowych użytkowników lub posiadaczy starszej wersji moda.",
		"GS_MU_SECTION4_PAR2" => "Wrócmy do przykładu z wieloma skryptami instalacyjnymi (wariant #2).",
		"GS_MU_SECTION4_PAR3" => "Załóżmy, że archiwum <code>patch2.zip</code> zawiera już wszystkie zmiany z <code>patch1.zip</code> i to ostatnie jest zbędne. Możliwe jest jego pominięcie tak by graczej mieli mniej danych do ściągnięcia.",
		"GS_MU_SECTION4_PAR4" => "Przejdź do strony \"Instalacja\". Wybierz \"Skoki pomiędzy wersjami\" na górze strony. W polu \"Z wersji\" wybierasz źródło skoku. Wpisz \"version = 1\" żeby zaadresować użytkowników z pierwszą wersją moda. Poniżej wybierz \"Skrypt instalacyjny: Taki sam jak w wersji 1.1 do 1.2\" który ściąga <code>patch2.zip</code>. Naciśnij na \"Dodaj nowy skok\".",
        "GS_MU_SECTION4_PAR5" => "W podglądzie zobaczysz że nowi użytkownicy ściągną <code>mod.zip</code> oraz <code>patch2.zip</code>. Plik <code>patch1.zip</code> zostanie pominięty.",
		"GS_MU_SECTION4_PAR6" => "Można również dostarczać jedną paczkę (<code>mod_new.zip</code>) dla nowych użytkowników i małe łatki (<code>patch.zip</code>) dla obecnych użytkowników (wariant #1 i #2).",
		"GS_MU_SECTION4_PAR7" => "W polu \"Z wersji\" wpisz \"version = 0\" żeby zaadresować użytkowników którzy jeszcze nie posiadają tego modu. Z listy \"Do wersji\" wybierz \"Zawsze do najnowszej\". Poniżej napisz nowy skrypt instalacyjny i naciśnij na \"Dodaj nowy skok\".",
		"GS_MU_SECTION4_PAR8" => "Od teraz, za każdym razem gdy dodasz nową wersję ten skok zostanie automatycznie dopasowany. Nie zapomnij uaktualnić <code>mod_new.zip</code>."
	));
}


if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
#Mod updates page
"GS_MU_DESCRIPTION" => "Description of the mod versioning system in the OFP Game Schedule",

#Section titles
"GS_MU_SECTION1_TITLE" => "Adding a new version",
"GS_MU_SECTION2_TITLE" => "Example",
"GS_MU_SECTION3_TITLE" => "Editing an existing version",
"GS_MU_SECTION4_TITLE" => "Jumping between versions",

#Add a new version
"GS_MU_SECTION1_PAR1" => "OFP Game Schedule website allows you to register a new mod version and distribute the new installation process to the users.",
"GS_MU_SECTION1_PAR2" => "<b>Note:</b> there's no need to update version if you only change mod details (e.g. name).",
"GS_MU_SECTION1_PAR3" => "After modifying mod files and uploading them to the host of your choice, go to the OFP GS main page. Find your mod and select \"Installation\".",
"GS_MU_SECTION1_PAR4" => "<b>OPTION #1:</b> If you have overwritten existing download package then little action is required. Website automatically suggest a new version number and selects last used installation script. Just fill in the patch notes and click on the \"Add New Version\" button.</b>",
"GS_MU_SECTION1_PAR5" => "<b>OPTION #2:</b> If you have a new file to download then select \"Installation script: Add a new script\" and paste the URL below. Fill in the correct download size and patch notes and then click on the \"Add New Version\".",
"GS_MU_SECTION1_PAR6" => "When users check for updates they will download the latest mod version number from the website and compare it against the number stored in the identification file <code>__gs_id</code> inside the modfolder. If the latter is lower then the option to update the mod will appear.",
"GS_MU_SECTION1_PAR7" => "Clicking on the option starts the update process. Website combines installation scripts based on what the user is missing. Scripts that are repeated (option #1) are ignored to avoid duplicating downloads (see example below).",
"GS_MU_SECTION1_PAR8" => "Installer downloads this compilation of instructions and <a href=\"install_scripts\" target=\"_blank\">executes</a> it.",

#Example
"GS_MU_SECTION2_PAR1" => "Here's an example of a mod that reuses the same installation script (option #1).",
"GS_MU_SECTION2_PAR2" => "All versions use the same installation script so that the user, regardless of their version, will download <code>mod.zip</code> only once in order to get to the newest version.",
"GS_MU_SECTION2_PAR3" => "You can see what the installation process will look like by clicking on the \"Preview Installation\" link on the on the bottom of the \"Installation\" page.",
"GS_MU_SECTION2_PAR4" => "Every time this mod gets updated the users will redownload the same file. This might get burdensome with large archives so instead you could provide a new, smaller package that only contains patched files (option #2).",
"GS_MU_SECTION2_PAR5" => "In this example new users will download all three files.",
"GS_MU_SECTION2_PAR6" => "Players who already have the mod will download one or two patches.",

#Edit existing version
"GS_MU_SECTION3_PAR1" => "To modify an update that you've added before go to the \"Installation\" page and select version number from the version list.",
"GS_MU_SECTION3_PAR2" => "You can freely assign script from any other version by using the \"Installation script\" drop-down. Option \"Add a new script\" will replace the current script with a new one. Scripts that aren't assigned to any version are deleted.",
"GS_MU_SECTION3_PAR3" => "Contents of an installation script can be changed here as well. Be aware that this will change installation process for all the versions that use this script. For example: you have changed the host for your files and now you want to update all URLs. In case of a single script (option #1) you only have to change it once in any of the versions. With multiple scripts (option #2) you'll have to modify all of them.",
"GS_MU_SECTION3_PAR4" => "It is not possible to remove an update because it would lead to a situation where users have newer version of the mod than the website database.",

#Jumps between versions
"GS_MU_SECTION4_PAR1" => "Jumps are used to provide alternative installation process for new users or users with an older version of the mod.",
"GS_MU_SECTION4_PAR2" => "Look again at the example with multiple scripts (option #2).",
"GS_MU_SECTION4_PAR3" => "Let's assume that <code>patch2.zip</code> already contains all the changes from the <code>patch1.zip</code> and the latter is obsolete. It's possible to skip it so that players will download less data.",
"GS_MU_SECTION4_PAR4" => "Go to the \"Installation\" page. Select \"Jumps Between Versions\" on the top of the page. In the field \"From version\" you determine source of the jump. Type \"version = 1\" to target users with the first version of the mod. Select below \"Installation script: Same as in version 1.1 to 1.2\" which downloads <code>patch2.zip</code>. Click on \"Add New Jump\".",
"GS_MU_SECTION4_PAR5" => "In the preview you'll see that new users will download <code>mod.zip</code> and then <code>patch2.zip</code>. File <code>patch1.zip</code> will be ignored.",
"GS_MU_SECTION4_PAR6" => "It's possible to provide both a single package (<code>mod_new.zip</code>) for the new users and small patches (<code>patch.zip</code>) for existing users (option #1 and #2).",
"GS_MU_SECTION4_PAR7" => "In the field \"From version\" write \"version = 0\" to target new users. From the list \"To version\" select \"Always to the newest one\". Write the new installation script below and click on the \"Add New Jump\".",
"GS_MU_SECTION4_PAR8" => "Now every time you add a new version this jump will be automatically adjusted. Don't forget to upload new <code>mod_new.zip</code>."
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
	
$anchors = ["addnew", "example", "edit", "jump"];

foreach($anchors as $id=>$anchor) {
	$index = $id + 1;
	echo "<a href=\"#{$anchor}\">".lang("GS_MU_SECTION{$index}_TITLE")."</a> &nbsp; &nbsp; &nbsp;";
}
		
echo "
	</p>
</div>";

$paragraphs = [
    ["1", "2", "br", "3", "1.png", "br", "*4", "2.png", "br", "*5", "3.png", "br", "6", "4.jpg", "5.jpg", "7", "8"],
    ["1", "6.png", "2", "3", "7.png", "8.png", "br", "4", "9.png", "5", "10.png", "6", "11.png"],
    ["1", "12.png", "2", "3", "br", "4"],
    ["1", "2", "16.png", "3", "17.png", "br", "4", "13.png", "5", "14.png", "br", "br", "6", "7", "18.png", "19.png", "8", "20.png", "21.png", "22.png"]
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
				<img src=\"images/modupdate_{$parts[0]}_" . substr($lang["THIS_CODE"],0,2) . ".{$parts[1]}\" alt=\"\" class=\"img-thumbnail blackborder\" style=\"width: 40%;\">
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