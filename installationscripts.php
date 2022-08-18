<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";

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
	#Title
	"GS_IS_TITLE" => "How to Write Installation Scripts",
	"GS_IS_DESCRIPTION" => "which determine how your mod is going to be installed",
	
	#Table of Contents
	"GS_IS_CONTENTS" => "Contents",
	"GS_IS_AUTOMATIC" => "Automatic Installation",
	"GS_IS_URLFORMAT" => "Download Links",
	"GS_IS_COMMANDS" => "Commands",
	"GS_IS_MISSIONS" => "Where To Put Mission Files",
	"GS_IS_EXAMPLES" => "Example Scripts",
	"GS_IS_TESTING" => "Testing Scripts",
	"GS_IS_CHANGELOG" => "Version History",
	
	#Automatic installation
	"GS_IS_AUTO_PAR1" => "Simply paste a direct download link to the file and the installer will figure out what to do on its own. If there's more than one file to download then put another link in a new line.",
	"GS_IS_AUTO_PAR2" => "If an archive requires a password then add <code>/password:</code> to the line.",
	"GS_IS_AUTO_PAR3" => "How does it work?",
	"GS_IS_AUTO_PAR4" => "Installer examines the extension of the downloaded file:",
	"GS_IS_AUTO_PAR5" => "If it's <code>.rar</code>, <code>.zip</code>, <code>.7z</code>, <code>.ace</code>, <code>.exe</code> or <code>.cab</code> then it will extract it and inspect its contents.",
	"GS_IS_AUTO_PAR6" => "If an <code>.exe</code> couldn't be unpacked and nothing else was copied up until that point then it will ask the user to run it.",
	"GS_IS_AUTO_PAR7" => "If it's a <code>.pbo</code> then it will detect its type and move it to the <code>addons</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> directory in the modfolder.",
	"GS_IS_AUTO_PAR8" => "Other types of files are ignored.",
	"GS_IS_AUTO_PAR9" => "When installer encounters a directory it will check its name and contents:",
	"GS_IS_AUTO_PAR10" => "If its name matches the name of the mod that's being installed then it will be moved to the game directory. All remaining files and folders in this location (except for other mods) will be moved to the modfolder. If directory <code>addons</code> is present then it will be merged with <code>IslandCutscenes</code> in the modfolder.",
	"GS_IS_AUTO_PAR11" => "Other modfolders will be ignored (exceptions: 1. <code>Res</code> folder 2. if the downloaded archive contains only a single folder then it won't be skipped).",
	"GS_IS_AUTO_PAR12" => "If its name matches <code>addons</code>, <code>bin</code>, <code>campaigns</code>, <code>dta</code>, <code>worlds</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code>, <code>SPTemplates</code>, <code>MissionsUsers</code>, <code>MPMissionsUsers</code> or <code>IslandCutscenes</code> then it will be moved to the modfolder (contents will be merged). If <code>MPMissions</code> contains only a single folder then that folder will be moved instead. If <code>Missions</code> contains only a single folder that matches mod name then its contents will be merged with the mod missions. If it doesn't match then it will be moved as a separate folder.",
	"GS_IS_AUTO_PAR13" => "If it contains <code>overview.html</code> then it will be moved to the <code>Missions</code> folder in the modfolder.",
	"GS_IS_AUTO_PAR14" => "If its name ends with \"anim\", \"_anim\" or \"_anims\" then it will be moved to the <code>IslandCutscenes</code>. If any of the parent folders was named \"res\" or they have words \"res\" and \"addons\" in their names then the current directory will be moved to the <code>IslandCutscenes_Res</code> instead.",
	"GS_IS_AUTO_PAR15" => "If it's a mission folder then the installer will detect its type and move it to the <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> in the modfolder. If the folder name contains words \"demo\" or \"template\" or if any of the parent folders names had words \"user\" or \"mission\" and \"demo/editor/template\" then the current folder will be moved to the <code>MissionsUsers</code> or <code>MPMissionsUsers</code> instead.",
	"GS_IS_AUTO_PAR16" => "In any other case it will go through its contents and apply the same rules for each folder (first) and file there.",
	"GS_IS_AUTO_PAR17" => "Installer overwrites existing files. Automatically creates necessary folders.",
	
	#Link format
	"GS_IS_URL_PAR1" => "1. Links should start with the protocol. Spaces should be replaced with <code>%20</code>. Links have to directly point to the file.",
	"GS_IS_URL_PAR2" => "2. If a website requires you to go through intermediate pages in order to receive a direct link then write address to each page.",
	"GS_IS_URL_STARTING_URL" => "starting url",
	"GS_IS_URL_INTERMEDIATE_URL" => "optionally intermediate links",
	"GS_IS_URL_FILE_NAME" => "file name",
	"GS_IS_URL_PAR3" => "You don't actually have to type in full intermediary URL but only the unique part that's easy to find in the page's source code. Last item is the name of the file that's going to be downloaded. If it contains spaces then put it in quotation marks.",
	"GS_IS_URL_PAR4" => "In the above example installer will:",
	"GS_IS_URL_PAR5" => "Download page https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25",
	"GS_IS_URL_PAR6" => "Find URL containing phrase <span class=\"courier\">/downloads/start/</span> and download web page behind that link",
	"GS_IS_URL_PAR7" => "Find URL containing phrase <span class=\"courier\">/downloads/mirror/</span> and download its contents as ww4mod25rel.rar",
	"GS_IS_URL_PAR8" => "On the mod update page, below the script input field you'll find a tool that automatically writes intermediate links (for a few selected sites). More information on how to find such links yourself you'll find <a href=\"#testing\">below</a>.",
	"GS_IS_URL_PAR9" => "3. If you have <b>backup links</b> then place all of them between a pair of curly brackets. Example:",
	"GS_IS_URL_PAR10" => "If the first one fails then the installer will try the second one and so on.",
	"GS_IS_URL_PAR11" => "4. To save disk space downloaded file is deleted as soon as the next download starts. To keep the files use <a href=\"#get\">GET</a> command.",
	
	#Manual installation
	"GS_IS_MANUAL_PAR1" => "There are commands to make the installer do exactly what you want:",
	"GS_IS_MANUAL_PAR2" => "Some commands have aliases. For example <code>remove</code> and <code>delete</code> are the same.",
	"GS_IS_MANUAL_PAR3" => "Write each command in a separate line.",
	"GS_IS_MANUAL_PAR4" => "Commands usually require arguments. They have to be given in the specified order. Separate them by spaces. If an argument contains space then put it in quotation marks.",
	"GS_IS_MANUAL_PAR5" => "Commands may also use switches which are optional arguments that may be written anywhere in the argument order. They begin with a forward slash.",
	"GS_IS_MANUAL_PAR6" => "I recommend to capitalize commands for readability.",
	"GS_IS_MANUAL_PAR7" => "Invalid command names will be ignored.",
	"GS_IS_MANUAL_PAR8" => "Leading and trailing spaces will be ignored.",
	"GS_IS_MANUAL_PAR9" => "Script can consist of both automatic installation and commands.",

	"GS_IS_COMMAND" => "command",
	"GS_IS_ARGUMENT" => "argument",
	"GS_IS_SWITCH" => "switch",
	"GS_IS_URL_OR_FILE" => "url or file",
	"GS_IS_FILE_OR_URL" => "file or url",
	"GS_IS_FILE" => "file",
	"GS_IS_FILE_NAME" => "file name",
	"GS_IS_FOLDER" => "folder",
	"GS_IS_PATH" => "path",
	"GS_IS_TEXT" => "text",
	"GS_IS_EXAMPLE" => "Example:",
	"GS_IS_DESTINATION" => "destination",
	"GS_IS_NEW_NAME" => "new name",
	"GS_IS_LINE_NUMBER" => "line number",
	"GS_IS_OPERATOR" => "operator",
	"GS_IS_NUMBER" => "number",
	"GS_IS_NAME1" => "name1",
	"GS_IS_NAME2" => "name2",
	"GS_IS_DATE" => "date",
	"GS_IS_WILDCARDS" => "Wildcards (see <a href=\"https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows\" target=\"_blank\">MSDN</a> and <a href=\"https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards\" target=\"_blank\">StackExchange</a>) can be used to match multiple files.",
	"GS_IS_GAME_FOLDER" => "game folder",
	"GS_IS_MOD_FOLDER" => "modfolder",

	#Unpack command
	"GS_IS_UNPACK_PAR1" => "Extracts selected archive from the <span class=\"courier\">fwatch\\tmp\\</span> directory to the <span class=\"courier\">_extracted</span> subfolder (its previous contents are wiped). If URL was given then it will download the file to the <span class=\"courier\">fwatch\\tmp\\</span> and extract it.",
	"GS_IS_UNPACK_PAR2" => "How to open nested archives:",
	"GS_IS_UNPACK_PAR3" => "Add <code>/password:</code> switch if the archive requires a password.",
	"GS_IS_UNPACK_PAR4" => "If no argument was given then it will extract the last downloaded file.",

	#Move command
	"GS_IS_MOVE_PAR1" => "Moves or copies selected file or folder from the <span class=\"courier\">fwatch\\tmp\\_extracted</span> directory to the modfolder.",
	"GS_IS_MOVE_PAR2" => "Overwrites files.",
	"GS_IS_MOVE_PAR3" => "Automatically creates sub-directories in the destination path.",
	"GS_IS_MOVE_PAR4" => "This will move",
	"GS_IS_MOVE_PAR5" => "to the",
	"GS_IS_MOVE_PAR6" => "<strong>Exception:</strong> if the directory you want to move has the same name as the modfolder you’re installing then the destination path is changed to the game folder.",
	"GS_IS_MOVE_PAR7" => "You can cancel this behaviour by specifying destination argument.",
	"GS_IS_MOVE_PAR8" => "To match both files and folders add <code>/match_dir</code> switch. To match exclusively folders use <code>/match_dir_only</code> instead.",
	"GS_IS_MOVE_PAR9" => "To rename the file that's being moved write new name after the destination path.",
	"GS_IS_MOVE_PAR10" => "Use dot if you don’t want to change destination.",
	"GS_IS_MOVE_PAR11" => "Add <code>/no_overwrite</code> switch to disable overwriting files.",
	"GS_IS_MOVE_PAR12" => "To download a file write link(s) between curly brackets.",
	"GS_IS_MOVE_PAR13" => "To move files in the modfolder start the first argument with <code>%m1%</code>.",
	"GS_IS_MOVE_PAR14" => "To move the last downloaded file use <code>%m1%</code> or <code>%m2%</code> as the first argument.",
	"GS_IS_MOVE_PAR15" => "Command <code>Copy</code> can copy files from the game directory if the path starts with <code>%m1%</code>.",

	#Unpbo command
	"GS_IS_UNPBO_PAR1" => "Extracts PBO file from the modfolder.",
	"GS_IS_UNPBO_PAR2" => "Overwrites existing files.",
	"GS_IS_UNPBO_PAR3" => "Optionally you can specify where to extract files. Sub-directories in the destination path are automatically created.",
	"GS_IS_UNPBO_PAR4" => "To unpack file from the game directory start the path with <code>%m1%</code>. If destination wasn’t specified then the addon will be unpacked to the modfolder.",

	#Makepbo command
	"GS_IS_MAKEPBO_PAR1" => "Creates a PBO file (no compression) out of a directory in the modfolder and then removes the source directory. PBO file modification date will be set to the day the specific mod version was added.",
	"GS_IS_MAKEPBO_PAR2" => "Add switch <code>/keep_source</code> to keep the original folder.",
	"GS_IS_MAKEPBO_PAR3" => "If no argument was given then it will pack the last addon extracted with <code>UnPBO</code>.",
	"GS_IS_MAKEPBO_PAR4" => "Add switch <code>/timestamp:</code> for a custom file modification date (see <a href=\"#filedate\">FILEDATE</a> command for details).",

	#Edit command
	"GS_IS_EDIT_PAR1" => "Replaces text line in the selected file from the modfolder.",
	"GS_IS_EDIT_PAR2" => "If the new text already contains quotation marks then use a custom separator to avoid conflict. Start the argument with <code>%m1%%m1%</code> and any character. End it with the same character.",
	"GS_IS_EDIT_PAR3" => "File modification date will be set to the day the specific mod version was added.",
	"GS_IS_EDIT_PAR4" => "Add switch <code>/insert</code> to add a new line instead of replacing. If the selected line number is zero or exceeds the number of lines in the file then the text will be added at the end.",
	"GS_IS_EDIT_PAR5" => "Add switch <code>/append</code> to append to the end of the line instead of replacing it.",
	"GS_IS_EDIT_PAR6" => "Add switch <code>/newfile</code> to create a new file. Existing file will be trashed.",
	"GS_IS_EDIT_PAR7" => "Add switch <code>/timestamp:</code> for a custom file modification date (see <a href=\"#filedate\">FILEDATE</a> command for details).",
	"GS_IS_EDIT_PAR8" => "To select the last downloaded file use <code>%m1%</code> or <code>%m2%</code> as the first argument.",

	#Delete command
	"GS_IS_DELETE_PAR1" => "Deletes file or folder from the modfolder.",
	"GS_IS_DELETE_PAR2" => "To match both files and folders add <code>/match_dir</code> switch.",
	"GS_IS_DELETE_PAR3" => "If no argument was given then it will delete the last downloaded file.",

	#If_version command
	"GS_IS_IFVERSION_PAR1" => "Further commands will be executed only if game version matches given condition.",
	"GS_IS_IFVERSION_PAR2" => "If it does then the following instructions are executed until the end of the script or until <code>else</code> or <code>endif</code> command is encountered. Content between <code>else</code> and <code>endif</code> will be ignored.",
	"GS_IS_IFVERSION_PAR3" => "If the condition wasn’t met then the following commands are skipped until the end of script or until <code>else</code> or <code>endif</code> commands.",
	"GS_IS_IFVERSION_PAR4" => "Allowed comparison operators are: <code>=</code>, <code>==</code>, <code>%m1%</code>, <code>%m1%=</code>, <code>%m2%</code>, <code>%m2%=</code>, <code>%m1%%m2%</code>, <code>!=</code>. If there’s no operator then equality is assumed.",
	"GS_IS_IFVERSION_PAR5" => "Conditions can be nested.",

	#Alias command
	"GS_IS_ALIAS_PAR1" => "Changes the behavior of the automatic installation as well as <code>Move</code> and <code>Copy</code> commands so that they will merge specified folder with the modfolder that's being installed. Effect lasts until the end of the current script (to make it work for all the versions use option from the mod details page).",
	"GS_IS_ALIAS_PAR2" => "For example: mod @wgl5 is being installed. Archive \"CoC_UA110_Setup.exe\" was downloaded which contains folders: @CoC and @wgl5. By default auto installation will copy @wgl5 and ignore @CoC but if you'll write:",
	"GS_IS_ALIAS_PAR3" => "then the installer won't skip @CoC but merge its contents with the @wgl5 in the game directory.",
	"GS_IS_ALIAS_PAR4" => "If no argument was given then the option is turned off.",

	#Rename command
	"GS_IS_RENAME_PAR1" => "Renames file or folder from the modfolder.",
	"GS_IS_RENAME_PAR2" => "To match both files and folders add <code>/match_dir</code> switch.",

	#Makedir command
	"GS_IS_MAKEDIR_PAR1" => "Creates folder(s).",
	"GS_IS_MAKEDIR_PAR2" => "This will create:",

	#Filedate command
	"GS_IS_FILEDATE_PAR1" => "Changes modification date of a seleted file in the modfolder. Acceptable formats are ISO 8601 (YYYY MM DD HH MM SS) or Unix timestamp. It must be in the GMT timezone.",

	#Get command
	"GS_IS_GET_PAR1" => "Downloads selected file to the <span class=\"courier\">fwatch\\tmp\\</span> directory. It will be removed at the end of the current installation script.",

	#Ask_get command
	"GS_IS_ASK_GET_PAR1" => "Requests the user to manually download the selected file. Installation is paused until user decides to continue or abort.",

	#Ask_run command
	"GS_IS_ASK_RUN_PAR1" => "Requests the user to manually launch the selected file from the <span class=\"courier\">fwatch\\tmp\\</span> directory. Installation is paused until user decides to continue or abort.",
	"GS_IS_ASK_RUN_PAR2" => "Use this command for executables that cannot be extracted.",
	"GS_IS_ASK_RUN_PAR3" => "If the file is in the modfolder then start the path with <code>%m1%</code>.",
	"GS_IS_ASK_RUN_PAR4" => "If no argument was given then the last downloaded file will be selected.",

	#Exit command
	"GS_IS_EXIT_PAR1" => "Causes the installer to skip all remaining commands in the current script.",

	#Mission files
	"GS_IS_MISSION_PAR1" => "Original game only makes use of the <code>modfolder\\Campaigns</code> but with Fwatch 1.16 you can now conveniently store any kind of mission in the modfolder.",
	"GS_IS_MISSION_PAR2" => "When you launch the game with a mod it will move contents of the mod sub-folders to the folders in the game directory.",
	"GS_IS_MISSION_PAR3" => "Source",
	"GS_IS_MISSION_PAR4" => "Destination",
	"GS_IS_MISSION_PAR5" => "Both PBO files and mission folders are moved. In the case of cutscenes and user missions only folders are moved.",
	"GS_IS_MISSION_PAR6" => "Files are moved back when you quit the game.",
	
	#Example script (WW4)
	"GS_IS_EXAMPLE_PAR1" => "This is a script for installing WW4 2.5 mod",
	"GS_IS_EXAMPLE_PAR2" => "Download archive from one of these three sources and then extract it to a temporary location",
	"GS_IS_EXAMPLE_PAR3" => "Move all the unpacked content (including folders) to the modfolder in the game directory (will be created if it doesn't exist)",
	"GS_IS_EXAMPLE_PAR4" => "Download and extract",
	"GS_IS_EXAMPLE_PAR5" => "Move text files (from the directory with extracted files) to the modfolder root",
	"GS_IS_EXAMPLE_PAR6" => "Move addons (from the directory with extracted files) to the modfolder\\addons",
	"GS_IS_EXAMPLE_PAR7" => "Move all remaining extracted files and folders to the modfolder\\Bonus",
	"GS_IS_EXAMPLE_PAR8" => "Replace modfolder\\bin\\resource.cpp (file that defines user interface) for widescreen compatibility",
	"GS_IS_EXAMPLE_PAR9" => "Replace modfolder\\dta\\anims.pbo (island cutscenes) so that a message will show up in the main menu when Fwatch is enabled",

	#Example script (FDF)
	"GS_IS_EXAMPLE_PAR10" => "This is a script for installing Finnish Defence Forces 1.4 mod",
	"GS_IS_EXAMPLE_PAR11" => "Download base version of the mod from one of these five sources and then run automatic installation",
	"GS_IS_EXAMPLE_PAR12" => "Download update from one of these six sources and then run automatic installation",
	"GS_IS_EXAMPLE_PAR13" => "Download and extract desert pack",
	"GS_IS_EXAMPLE_PAR14" => "Move extracted readme file to the modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR15" => "Move all remaining extracted files and folders to the modfolder",
	"GS_IS_EXAMPLE_PAR16" => "Download and extract Winter Maldevic island",
	"GS_IS_EXAMPLE_PAR17" => "Move extracted readme file to the modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR18" => "Move all remaining extracted files and folders to the modfolder",
	"GS_IS_EXAMPLE_PAR19" => "Download and extract Suursaari island",
	"GS_IS_EXAMPLE_PAR20" => "Move extracted addon the modfolder\\addons",
	"GS_IS_EXAMPLE_PAR21" => "Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes",
	"GS_IS_EXAMPLE_PAR22" => "Move all remaining extracted files to the modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR23" => "Download and extract Winter Kolgujev island",
	"GS_IS_EXAMPLE_PAR24" => "Move all extracted addons the modfolder\\addons",
	"GS_IS_EXAMPLE_PAR25" => "Move extracted readme file to the modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR26" => "Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes",
	"GS_IS_EXAMPLE_PAR27" => "Download and extract MT-LB addon",
	"GS_IS_EXAMPLE_PAR28" => "Move all extracted addons the modfolder\\addons",
	"GS_IS_EXAMPLE_PAR29" => "Move extracted readme file to the modfolder\\readme_addons and rename it to mt-lb22_release_info.txt",
	"GS_IS_EXAMPLE_PAR30" => "Download and extract Russians Weapons Pack",
	"GS_IS_EXAMPLE_PAR31" => "Move all extracted addons the modfolder\\addons",
	"GS_IS_EXAMPLE_PAR32" => "Move extracted readme file to the modfolder\\readme_addons and rename it to RussianWeaponsPack11_readme.txt",
	"GS_IS_EXAMPLE_PAR33" => "Automatically install fixed version of Smith & Wesson Revolvers Addon",
	"GS_IS_EXAMPLE_PAR34" => "Replace resource.cpp for widescreen compatibility",
	"GS_IS_EXAMPLE_PAR35" => "Replace island cutscenes so that a message will show up when Fwatch is enabled",
	"GS_IS_EXAMPLE_PAR36" => "Create a UI config for Fwatch - it will enlarge action menu and chat and make them blue",

	#Example script (WGL)
	"GS_IS_EXAMPLE_PAR37" => "This is a script for installing WarGames League 5.12 mod",
	"GS_IS_EXAMPLE_PAR38" => "Installer will automatically download file from one of these three sources, extract it and then move files to the game directory",
	"GS_IS_EXAMPLE_PAR39" => "Same with mod patch",
	"GS_IS_EXAMPLE_PAR40" => "If user has 1.96 version of the game or older",
	"GS_IS_EXAMPLE_PAR41" => "Extract Res\\Dta\\HWTL\\data.pbo (contains game textures) to the modfolder\\dta\\hwtl",
	"GS_IS_EXAMPLE_PAR42" => "Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data",
	"GS_IS_EXAMPLE_PAR43" => "Generate pbo file out of the recently extracted addon (data.pbo) and remove the source",
	"GS_IS_EXAMPLE_PAR44" => "Extract Res\\Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta\\hwtl",
	"GS_IS_EXAMPLE_PAR45" => "Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data3d",
	"GS_IS_EXAMPLE_PAR46" => "Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source",
	"GS_IS_EXAMPLE_PAR47" => "For game versions newer than 1.96",
	"GS_IS_EXAMPLE_PAR48" => "Extract Dta\\data.pbo (contains game textures) to the modfolder\\dta",
	"GS_IS_EXAMPLE_PAR49" => "Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\data",
	"GS_IS_EXAMPLE_PAR50" => "Generate pbo file out of the recently extracted addon (data.pbo) and remove the source",
	"GS_IS_EXAMPLE_PAR51" => "Extract Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta",
	"GS_IS_EXAMPLE_PAR52" => "Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\data3d",
	"GS_IS_EXAMPLE_PAR53" => "Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source",
	"GS_IS_EXAMPLE_PAR54" => "Close section of commands that depend on the game version",
	"GS_IS_EXAMPLE_PAR55" => "Replace resource.cpp for widescreen compatibility",
	"GS_IS_EXAMPLE_PAR56" => "Replace island cutscenes so that a message will show up when Fwatch is enabled",

	#Testing scripts
	"GS_IS_TEST_PAR1" => "Write your installation script in the <span class=\"courier\">fwatch\\data\\addonInstaller_test.txt</span>",
	"GS_IS_TEST_PAR2" => "Run <span class=\"courier\">addonInstaller.exe</span> with parameters <code>-testmod=%m1%mod name%m2%</code> and optionally <code>-testdir=%m1%folder name%m2%</code></span>",
	"GS_IS_TEST_PAR3" => "Example: <code>-testmod=@ww4mod25 -testdir=@test</code>. Folder <span class=\"courier\">@test</span> will be treated as if it's <span class=\"courier\">@ww4mod25</span>.",
	"GS_IS_TEST_PAR4" => "See <span class=\"courier\">fwatch\\data\\addonInstallerLog.txt</span> for feedback on the installation process.",
	"GS_IS_TEST_PAR5" => "Add parameter <code>-gameversion=%m1%number%m2%</code> to test conditions.",
	"GS_IS_TEST_PAR6" => "In testing mode downloaded files won't be removed so you won't have to redownload them every time you run the installer.",
	"GS_IS_TEST_PAR7" => "Installer will generate <span class=\"courier\">fwatch\\tmp\\__downloadtoken</span> file which you can use to find intermediate download links:",
	"GS_IS_TEST_PAR8" => "Open it in your web browser",
	"GS_IS_TEST_PAR9" => "Find the <i>Download</i> button, right-click on it and select <i>Inspect</i>",
	"GS_IS_TEST_PAR10" => "Property <i>href</i> contains the link you're looking for. Pick a small part of it that is constant",
	"GS_IS_TEST_PAR11" => "Do a search to make sure that the selected part does not occur anywhere else in the file",
	"GS_IS_TEST_PAR12" => "If it doesn't then you can add it to your installation script",
	));
}

if ($lang["THIS_CODE"] == "ru-RU") {
	$lang = array_merge($lang, array(
	#Title
"GS_IS_TITLE" => "How to Write Installation Scripts",
"GS_IS_DESCRIPTION" => "which determine how your mod is going to be installed",

	#Table of Contents
"GS_IS_CONTENTS" => "Contents",
"GS_IS_AUTOMATIC" => "Automatic Installation",
"GS_IS_URLFORMAT" => "Download Links",
"GS_IS_COMMANDS" => "Commands",
"GS_IS_MISSIONS" => "Where To Put Mission Files",
"GS_IS_EXAMPLES" => "Example Scripts",
"GS_IS_TESTING" => "Testing Scripts",
"GS_IS_CHANGELOG" => "Version History",

	#Automatic installation
"GS_IS_AUTO_PAR1" => "Simply paste a direct download link to the file and the installer will figure out what to do on its own. If there's more than one file to download then put another link in a new line.",
"GS_IS_AUTO_PAR2" => "If an archive requires a password then add <code>/password:</code> to the line.",
"GS_IS_AUTO_PAR3" => "How does it work?",
"GS_IS_AUTO_PAR4" => "Installer examines the extension of the downloaded file:",
"GS_IS_AUTO_PAR5" => "If it's <code>.rar</code>, <code>.zip</code>, <code>.7z</code>, <code>.ace</code>, <code>.exe</code> or <code>.cab</code> then it will extract it and inspect its contents.",
"GS_IS_AUTO_PAR6" => "If an <code>.exe</code> couldn't be unpacked and nothing else was copied up until that point then it will ask the user to run it.",
"GS_IS_AUTO_PAR7" => "If it's a <code>.pbo</code> then it will detect its type and move it to the <code>addons</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> directory in the modfolder.",
"GS_IS_AUTO_PAR8" => "Other types of files are ignored.",
"GS_IS_AUTO_PAR9" => "When installer encounters a directory it will check its name and contents:",
"GS_IS_AUTO_PAR10" => "If its name matches the name of the mod that's being installed then it will be moved to the game directory. All remaining files and folders in this location (except for other mods) will be moved to the modfolder. If directory <code>addons</code> is present then it will be merged with <code>IslandCutscenes</code> in the modfolder.",
"GS_IS_AUTO_PAR11" => "Other modfolders will be ignored (exceptions: 1. <code>Res</code> folder 2. if the downloaded archive contains only a single folder then it won't be skipped).",
"GS_IS_AUTO_PAR12" => "If its name matches <code>addons</code>, <code>bin</code>, <code>campaigns</code>, <code>dta</code>, <code>worlds</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code>, <code>SPTemplates</code>, <code>MissionsUsers</code>, <code>MPMissionsUsers</code> or <code>IslandCutscenes</code> then it will be moved to the modfolder (contents will be merged). If <code>MPMissions</code> contains only a single folder then that folder will be moved instead. If <code>Missions</code> contains only a single folder that matches mod name then its contents will be merged with the mod missions. If it doesn't match then it will be moved as a separate folder.",
"GS_IS_AUTO_PAR13" => "If it contains <code>overview.html</code> then it will be moved to the <code>Missions</code> folder in the modfolder.",
"GS_IS_AUTO_PAR14" => "If its name ends with \"anim\", \"_anim\" or \"_anims\" then it will be moved to the <code>IslandCutscenes</code>. If any of the parent folders was named \"res\" or they have words \"res\" and \"addons\" in their names then the current directory will be moved to the <code>IslandCutscenes_Res</code> instead.",
"GS_IS_AUTO_PAR15" => "If it's a mission folder then the installer will detect its type and move it to the <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> in the modfolder. If the folder name contains words \"demo\" or \"template\" or if any of the parent folders names had words \"user\" or \"mission\" and \"demo/editor/template\" then the current folder will be moved to the <code>MissionsUsers</code> or <code>MPMissionsUsers</code> instead.",
"GS_IS_AUTO_PAR16" => "In any other case it will go through its contents and apply the same rules for each folder (first) and file there.",
"GS_IS_AUTO_PAR17" => "Installer overwrites existing files. Automatically creates necessary folders.",

	#Link format
"GS_IS_URL_PAR1" => "1. Links should start with the protocol. Spaces should be replaced with <code>%20</code>. Links have to directly point to the file.",
"GS_IS_URL_PAR2" => "2. If a website requires you to go through intermediate pages in order to receive a direct link then write address to each page.",
"GS_IS_URL_STARTING_URL" => "starting url",
"GS_IS_URL_INTERMEDIATE_URL" => "optionally intermediate links",
"GS_IS_URL_FILE_NAME" => "file name",
"GS_IS_URL_PAR3" => "You don't actually have to type in full intermediary URL but only the unique part that's easy to find in the page's source code. Last item is the name of the file that's going to be downloaded. If it contains spaces then put it in quotation marks.",
"GS_IS_URL_PAR4" => "In the above example installer will:",
"GS_IS_URL_PAR5" => "Download page https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25",
"GS_IS_URL_PAR6" => "Find URL containing phrase <span class=\"courier\">/downloads/start/</span> and download web page behind that link",
"GS_IS_URL_PAR7" => "Find URL containing phrase <span class=\"courier\">/downloads/mirror/</span> and download its contents as ww4mod25rel.rar",
"GS_IS_URL_PAR8" => "On the mod update page, below the script input field you'll find a tool that automatically writes intermediate links (for a few selected sites). More information on how to find such links yourself you'll find <a href=\"#testing\">below</a>.",
"GS_IS_URL_PAR9" => "3. If you have <b>backup links</b> then place all of them between a pair of curly brackets. Example:",
"GS_IS_URL_PAR10" => "If the first one fails then the installer will try the second one and so on.",
"GS_IS_URL_PAR11" => "4. To save disk space downloaded file is deleted as soon as the next download starts. To keep the files use <a href=\"#get\">GET</a> command.",
	
	#Manual installation
"GS_IS_MANUAL_PAR1" => "There are commands to make the installer do exactly what you want:",
"GS_IS_MANUAL_PAR2" => "Some commands have aliases. For example <code>remove</code> and <code>delete</code> are the same.",
"GS_IS_MANUAL_PAR3" => "Write each command in a separate line.",
"GS_IS_MANUAL_PAR4" => "Commands usually require arguments. They have to be given in the specified order. Separate them by spaces. If an argument contains space then put it in quotation marks.",
"GS_IS_MANUAL_PAR5" => "Commands may also use switches which are optional arguments that may be written anywhere in the argument order. They begin with a forward slash.",
"GS_IS_MANUAL_PAR6" => "I recommend to capitalize commands for readability.",
"GS_IS_MANUAL_PAR7" => "Invalid command names will be ignored.",
"GS_IS_MANUAL_PAR8" => "Leading and trailing spaces will be ignored.",
"GS_IS_MANUAL_PAR9" => "Script can consist of both automatic installation and commands.",

"GS_IS_COMMAND" => "command",
"GS_IS_ARGUMENT" => "argument",
"GS_IS_SWITCH" => "switch",
"GS_IS_URL_OR_FILE" => "url or file",
"GS_IS_FILE_OR_URL" => "file or url",
"GS_IS_FILE" => "file",
"GS_IS_FILE_NAME" => "file name",
"GS_IS_FOLDER" => "folder",
"GS_IS_PATH" => "path",
"GS_IS_TEXT" => "text",
"GS_IS_EXAMPLE" => "Example:",
"GS_IS_DESTINATION" => "destination",
"GS_IS_NEW_NAME" => "new name",
"GS_IS_LINE_NUMBER" => "line number",
"GS_IS_OPERATOR" => "operator",
"GS_IS_NUMBER" => "number",
"GS_IS_NAME1" => "name1",
"GS_IS_NAME2" => "name2",
"GS_IS_DATE" => "date",
"GS_IS_WILDCARDS" => "Wildcards (see <a href=\"https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows\" target=\"_blank\">MSDN</a> and <a href=\"https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards\" target=\"_blank\">StackExchange</a>) can be used to match multiple files.",
"GS_IS_GAME_FOLDER" => "game folder",
"GS_IS_MOD_FOLDER" => "modfolder",

	#Unpack command
"GS_IS_UNPACK_PAR1" => "Extracts selected archive from the <span class=\"courier\">fwatch\\tmp\\</span> directory to the <span class=\"courier\">_extracted</span> subfolder (its previous contents are wiped). If URL was given then it will download the file to the <span class=\"courier\">fwatch\\tmp\\</span> and extract it.",
"GS_IS_UNPACK_PAR2" => "How to open nested archives:",
"GS_IS_UNPACK_PAR3" => "Add <code>/password:</code> switch if the archive requires a password.",
"GS_IS_UNPACK_PAR4" => "If no argument was given then it will extract the last downloaded file.",

	#Move command
"GS_IS_MOVE_PAR1" => "Moves or copies selected file or folder from the <span class=\"courier\">fwatch\\tmp\\_extracted</span> directory to the modfolder.",
"GS_IS_MOVE_PAR2" => "Overwrites files.",
"GS_IS_MOVE_PAR3" => "Automatically creates sub-directories in the destination path.",
"GS_IS_MOVE_PAR4" => "This will move",
"GS_IS_MOVE_PAR5" => "to the",
"GS_IS_MOVE_PAR6" => "<strong>Exception:</strong> if the directory you want to move has the same name as the modfolder you’re installing then the destination path is changed to the game folder.",
"GS_IS_MOVE_PAR7" => "You can cancel this behaviour by specifying destination argument.",
"GS_IS_MOVE_PAR8" => "To match both files and folders add <code>/match_dir</code> switch. To match exclusively folders use <code>/match_dir_only</code> instead.",
"GS_IS_MOVE_PAR9" => "To rename the file that's being moved write new name after the destination path.",
"GS_IS_MOVE_PAR10" => "Use dot if you don’t want to change destination.",
"GS_IS_MOVE_PAR11" => "Add <code>/no_overwrite</code> switch to disable overwriting files.",
"GS_IS_MOVE_PAR12" => "To download a file write link(s) between curly brackets.",
"GS_IS_MOVE_PAR13" => "To move files in the modfolder start the first argument with <code>%m1%</code>.",
"GS_IS_MOVE_PAR14" => "To move the last downloaded file use <code>%m1%</code> or <code>%m2%</code> as the first argument.",
"GS_IS_MOVE_PAR15" => "Command <code>Copy</code> can copy files from the game directory if the path starts with <code>%m1%</code>.",

	#Unpbo command
"GS_IS_UNPBO_PAR1" => "Extracts PBO file from the modfolder.",
"GS_IS_UNPBO_PAR2" => "Overwrites existing files.",
"GS_IS_UNPBO_PAR3" => "Optionally you can specify where to extract files. Sub-directories in the destination path are automatically created.",
"GS_IS_UNPBO_PAR4" => "To unpack file from the game directory start the path with <code>%m1%</code>. If destination wasn’t specified then the addon will be unpacked to the modfolder.",

	#Makepbo command
"GS_IS_MAKEPBO_PAR1" => "Creates a PBO file (no compression) out of a directory in the modfolder and then removes the source directory. PBO file modification date will be set to the day the specific mod version was added.",
"GS_IS_MAKEPBO_PAR2" => "Add switch <code>/keep_source</code> to keep the original folder.",
"GS_IS_MAKEPBO_PAR3" => "If no argument was given then it will pack the last addon extracted with <code>UnPBO</code>.",
"GS_IS_MAKEPBO_PAR4" => "Add switch <code>/timestamp:</code> for a custom file modification date (see <a href=\"#filedate\">FILEDATE</a> command for details).",

	#Edit command
"GS_IS_EDIT_PAR1" => "Replaces text line in the selected file from the modfolder.",
"GS_IS_EDIT_PAR2" => "If the new text already contains quotation marks then use a custom separator to avoid conflict. Start the argument with <code>%m1%%m1%</code> and any character. End it with the same character.",
"GS_IS_EDIT_PAR3" => "File modification date will be set to the day the specific mod version was added.",
"GS_IS_EDIT_PAR4" => "Add switch <code>/insert</code> to add a new line instead of replacing. If the selected line number is zero or exceeds the number of lines in the file then the text will be added at the end.",
"GS_IS_EDIT_PAR5" => "Add switch <code>/append</code> to append to the end of the line instead of replacing it.",
"GS_IS_EDIT_PAR6" => "Add switch <code>/newfile</code> to create a new file. Existing file will be trashed.",
"GS_IS_EDIT_PAR7" => "Add switch <code>/timestamp:</code> for a custom file modification date (see <a href=\"#filedate\">FILEDATE</a> command for details).",
"GS_IS_EDIT_PAR8" => "To select the last downloaded file use <code>%m1%</code> or <code>%m2%</code> as the first argument.",

	#Delete command
"GS_IS_DELETE_PAR1" => "Deletes file or folder from the modfolder.",
"GS_IS_DELETE_PAR2" => "To match both files and folders add <code>/match_dir</code> switch.",
"GS_IS_DELETE_PAR3" => "If no argument was given then it will delete the last downloaded file.",

	#If_version command
"GS_IS_IFVERSION_PAR1" => "Further commands will be executed only if game version matches given condition.",
"GS_IS_IFVERSION_PAR2" => "If it does then the following instructions are executed until the end of the script or until <code>else</code> or <code>endif</code> command is encountered. Content between <code>else</code> and <code>endif</code> will be ignored.",
"GS_IS_IFVERSION_PAR3" => "If the condition wasn’t met then the following commands are skipped until the end of script or until <code>else</code> or <code>endif</code> commands.",
"GS_IS_IFVERSION_PAR4" => "Allowed comparison operators are: <code>=</code>, <code>==</code>, <code>%m1%</code>, <code>%m1%=</code>, <code>%m2%</code>, <code>%m2%=</code>, <code>%m1%%m2%</code>, <code>!=</code>. If there’s no operator then equality is assumed.",
"GS_IS_IFVERSION_PAR5" => "Conditions can be nested.",

	#Alias command
"GS_IS_ALIAS_PAR1" => "Changes the behavior of the automatic installation as well as <code>Move</code> and <code>Copy</code> commands so that they will merge specified folder with the modfolder that's being installed. Effect lasts until the end of the current script (to make it work for all the versions use option from the mod details page).",
"GS_IS_ALIAS_PAR2" => "For example: mod @wgl5 is being installed. Archive \"CoC_UA110_Setup.exe\" was downloaded which contains folders: @CoC and @wgl5. By default auto installation will copy @wgl5 and ignore @CoC but if you'll write:",
"GS_IS_ALIAS_PAR3" => "then the installer won't skip @CoC but merge its contents with the @wgl5 in the game directory.",
"GS_IS_ALIAS_PAR4" => "If no argument was given then the option is turned off.",

	#Rename command
"GS_IS_RENAME_PAR1" => "Renames file or folder from the modfolder.",
"GS_IS_RENAME_PAR2" => "To match both files and folders add <code>/match_dir</code> switch.",

	#Makedir command
"GS_IS_MAKEDIR_PAR1" => "Creates folder(s).",
"GS_IS_MAKEDIR_PAR2" => "This will create:",

	#Filedate command
"GS_IS_FILEDATE_PAR1" => "Changes modification date of a seleted file in the modfolder. Acceptable formats are ISO 8601 (YYYY MM DD HH MM SS) or Unix timestamp. It must be in the GMT timezone.",

	#Get command
"GS_IS_GET_PAR1" => "Downloads selected file to the <span class=\"courier\">fwatch\\tmp\\</span> directory. It will be removed at the end of the current installation script.",

	#Ask_get command
"GS_IS_ASK_GET_PAR1" => "Requests the user to manually download the selected file. Installation is paused until user decides to continue or abort.",

	#Ask_run command
"GS_IS_ASK_RUN_PAR1" => "Requests the user to manually launch the selected file from the <span class=\"courier\">fwatch\\tmp\\</span> directory. Installation is paused until user decides to continue or abort.",
"GS_IS_ASK_RUN_PAR2" => "Use this command for executables that cannot be extracted.",
"GS_IS_ASK_RUN_PAR3" => "If the file is in the modfolder then start the path with <code>%m1%</code>.",
"GS_IS_ASK_RUN_PAR4" => "If no argument was given then the last downloaded file will be selected.",

	#Exit command
"GS_IS_EXIT_PAR1" => "Causes the installer to skip all remaining commands in the current script.",

	#Mission files
"GS_IS_MISSION_PAR1" => "Original game only makes use of the <code>modfolder\\Campaigns</code> but with Fwatch 1.16 you can now conveniently store any kind of mission in the modfolder.",
"GS_IS_MISSION_PAR2" => "When you launch the game with a mod it will move contents of the mod sub-folders to the folders in the game directory.",
"GS_IS_MISSION_PAR3" => "Source",
"GS_IS_MISSION_PAR4" => "Destination",
"GS_IS_MISSION_PAR5" => "Both PBO files and mission folders are moved. In the case of cutscenes and user missions only folders are moved.",
"GS_IS_MISSION_PAR6" => "Files are moved back when you quit the game.",
	
	#Example script (WW4)
"GS_IS_EXAMPLE_PAR1" => "This is a script for installing WW4 2.5 mod",
"GS_IS_EXAMPLE_PAR2" => "Download archive from one of these three sources and then extract it to a temporary location",
"GS_IS_EXAMPLE_PAR3" => "Move all the unpacked content (including folders) to the modfolder in the game directory (will be created if it doesn't exist)",
"GS_IS_EXAMPLE_PAR4" => "Download and extract",
"GS_IS_EXAMPLE_PAR5" => "Move text files (from the directory with extracted files) to the modfolder root",
"GS_IS_EXAMPLE_PAR6" => "Move addons (from the directory with extracted files) to the modfolder\\addons",
"GS_IS_EXAMPLE_PAR7" => "Move all remaining extracted files and folders to the modfolder\\Bonus",
"GS_IS_EXAMPLE_PAR8" => "Replace modfolder\\bin\\resource.cpp (file that defines user interface) for widescreen compatibility",
"GS_IS_EXAMPLE_PAR9" => "Replace modfolder\\dta\\anims.pbo (island cutscenes) so that a message will show up in the main menu when Fwatch is enabled",

	#Example script (FDF)
"GS_IS_EXAMPLE_PAR10" => "This is a script for installing Finnish Defence Forces 1.4 mod",
"GS_IS_EXAMPLE_PAR11" => "Download base version of the mod from one of these five sources and then run automatic installation",
"GS_IS_EXAMPLE_PAR12" => "Download update from one of these six sources and then run automatic installation",
"GS_IS_EXAMPLE_PAR13" => "Download and extract desert pack",
"GS_IS_EXAMPLE_PAR14" => "Move extracted readme file to the modfolder\\readme_addons",
"GS_IS_EXAMPLE_PAR15" => "Move all remaining extracted files and folders to the modfolder",
"GS_IS_EXAMPLE_PAR16" => "Download and extract Winter Maldevic island",
"GS_IS_EXAMPLE_PAR17" => "Move extracted readme file to the modfolder\\readme_addons",
"GS_IS_EXAMPLE_PAR18" => "Move all remaining extracted files and folders to the modfolder",
"GS_IS_EXAMPLE_PAR19" => "Download and extract Suursaari island",
"GS_IS_EXAMPLE_PAR20" => "Move extracted addon the modfolder\\addons",
"GS_IS_EXAMPLE_PAR21" => "Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes",
"GS_IS_EXAMPLE_PAR22" => "Move all remaining extracted files to the modfolder\\readme_addons",
"GS_IS_EXAMPLE_PAR23" => "Download and extract Winter Kolgujev island",
"GS_IS_EXAMPLE_PAR24" => "Move all extracted addons the modfolder\\addons",
"GS_IS_EXAMPLE_PAR25" => "Move extracted readme file to the modfolder\\readme_addons",
"GS_IS_EXAMPLE_PAR26" => "Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes",
"GS_IS_EXAMPLE_PAR27" => "Download and extract MT-LB addon",
"GS_IS_EXAMPLE_PAR28" => "Move all extracted addons the modfolder\\addons",
"GS_IS_EXAMPLE_PAR29" => "Move extracted readme file to the modfolder\\readme_addons and rename it to mt-lb22_release_info.txt",
"GS_IS_EXAMPLE_PAR30" => "Download and extract Russians Weapons Pack",
"GS_IS_EXAMPLE_PAR31" => "Move all extracted addons the modfolder\\addons",
"GS_IS_EXAMPLE_PAR32" => "Move extracted readme file to the modfolder\\readme_addons and rename it to RussianWeaponsPack11_readme.txt",
"GS_IS_EXAMPLE_PAR33" => "Automatically install fixed version of Smith & Wesson Revolvers Addon",
"GS_IS_EXAMPLE_PAR34" => "Replace resource.cpp for widescreen compatibility",
"GS_IS_EXAMPLE_PAR35" => "Replace island cutscenes so that a message will show up when Fwatch is enabled",
"GS_IS_EXAMPLE_PAR36" => "Create a UI config for Fwatch - it will enlarge action menu and chat and make them blue",

	#Example script (WGL)
"GS_IS_EXAMPLE_PAR37" => "This is a script for installing WarGames League 5.12 mod",
"GS_IS_EXAMPLE_PAR38" => "Installer will automatically download file from one of these three sources, extract it and then move files to the game directory",
"GS_IS_EXAMPLE_PAR39" => "Same with mod patch",
"GS_IS_EXAMPLE_PAR40" => "If user has 1.96 version of the game or older",
"GS_IS_EXAMPLE_PAR41" => "Extract Res\\Dta\\HWTL\\data.pbo (contains game textures) to the modfolder\\dta\\hwtl",
"GS_IS_EXAMPLE_PAR42" => "Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data",
"GS_IS_EXAMPLE_PAR43" => "Generate pbo file out of the recently extracted addon (data.pbo) and remove the source",
"GS_IS_EXAMPLE_PAR44" => "Extract Res\\Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta\\hwtl",
"GS_IS_EXAMPLE_PAR45" => "Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data3d",
"GS_IS_EXAMPLE_PAR46" => "Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source",
"GS_IS_EXAMPLE_PAR47" => "For game versions newer than 1.96",
"GS_IS_EXAMPLE_PAR48" => "Extract Dta\\data.pbo (contains game textures) to the modfolder\\dta",
"GS_IS_EXAMPLE_PAR49" => "Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\data",
"GS_IS_EXAMPLE_PAR50" => "Generate pbo file out of the recently extracted addon (data.pbo) and remove the source",
"GS_IS_EXAMPLE_PAR51" => "Extract Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta",
"GS_IS_EXAMPLE_PAR52" => "Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\data3d",
"GS_IS_EXAMPLE_PAR53" => "Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source",
"GS_IS_EXAMPLE_PAR54" => "Close section of commands that depend on the game version",
"GS_IS_EXAMPLE_PAR55" => "Replace resource.cpp for widescreen compatibility",
"GS_IS_EXAMPLE_PAR56" => "Replace island cutscenes so that a message will show up when Fwatch is enabled",

	#Testing scripts
"GS_IS_TEST_PAR1" => "Write your installation script in the <span class=\"courier\">fwatch\\data\\addonInstaller_test.txt</span>",
"GS_IS_TEST_PAR2" => "Run <span class=\"courier\">addonInstaller.exe</span> with parameters <code>-testmod=%m1%mod name%m2%</code> and optionally <code>-testdir=%m1%folder name%m2%</code></span>",
"GS_IS_TEST_PAR3" => "Example: <code>-testmod=@ww4mod25 -testdir=@test</code>. Folder <span class=\"courier\">@test</span> will be treated as if it's <span class=\"courier\">@ww4mod25</span>.",
"GS_IS_TEST_PAR4" => "See <span class=\"courier\">fwatch\\data\\addonInstallerLog.txt</span> for feedback on the installation process.",
"GS_IS_TEST_PAR5" => "Add parameter <code>-gameversion=%m1%number%m2%</code> to test conditions.",
"GS_IS_TEST_PAR6" => "In testing mode downloaded files won't be removed so you won't have to redownload them every time you run the installer.",
"GS_IS_TEST_PAR7" => "Installer will generate <span class=\"courier\">fwatch\\tmp\\__downloadtoken</span> file which you can use to find intermediate download links:",
"GS_IS_TEST_PAR8" => "Open it in your web browser",
"GS_IS_TEST_PAR9" => "Find the <i>Download</i> button, right-click on it and select <i>Inspect</i>",
"GS_IS_TEST_PAR10" => "Property <i>href</i> contains the link you're looking for. Pick a small part of it that is constant",
"GS_IS_TEST_PAR11" => "Do a search to make sure that the selected part does not occur anywhere else in the file",
"GS_IS_TEST_PAR12" => "If it doesn't then you can add it to your installation script",
	));
}

if ($lang["THIS_CODE"] == "pl-PL") {
	$lang = array_merge($lang, array(
	#Title
	"GS_IS_TITLE" => "Jak pisać skrypty instalacyjne",
	"GS_IS_DESCRIPTION" => "które decydują o tym jak twój mod będzie instalowany",
	
	#Table of Contents
	"GS_IS_CONTENTS" => "Spis treści",
	"GS_IS_AUTOMATIC" => "Automatyczna instalacja",
	"GS_IS_URLFORMAT" => "Linki do ściągania",
	"GS_IS_COMMANDS" => "Komendy",
	"GS_IS_MISSIONS" => "Gdzie wkładać pliki misji",
	"GS_IS_EXAMPLES" => "Przykładowe skrypty",
	"GS_IS_TESTING" => "Testowanie skryptów",
	"GS_IS_CHANGELOG" => "Historia zmian",
	
	#Automatic installation
	"GS_IS_AUTO_PAR1" => "Po prostu wklej bezpośredni odsyłacz do pliku, a instalator sam wykryje co trzeba zrobić. W przypadku wielu plików umieść kolejne linki w następnych linijkach.",
	"GS_IS_AUTO_PAR2" => "Jeśli archiwum wymaga hasła to dodaj <code>/password:</code> w tej same linijce.",
	"GS_IS_AUTO_PAR3" => "Jak to działa?",
	"GS_IS_AUTO_PAR4" => "Instalator sprawdza rozszerzenie ściągnętego pliku:",
	"GS_IS_AUTO_PAR5" => "W przypadku <code>.rar</code>, <code>.zip</code>, <code>.7z</code>, <code>.ace</code>, <code>.exe</code> lub <code>.cab</code> otworzy go i zbada zawartość.",
	"GS_IS_AUTO_PAR6" => "Jeśli <code>.exe</code> nie mogło być rozpakowane i żaden inny plik nie został dotychczas przekopiowany to wtedy instalator poprosi użytkownika o uruchomienie tego pliku.",
	"GS_IS_AUTO_PAR7" => "W przypadku <code>.pbo</code> sprawdzi jego typ i przeniesie go do katalogu <code>addons</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> albo <code>SPTemplates</code> w folderze z modem.",
	"GS_IS_AUTO_PAR8" => "Inne typy plików zostaną pominięte.",
	"GS_IS_AUTO_PAR9" => "Jeśli instalator napotka folder to sprawdzi jego nazwę i zawartość:",
	"GS_IS_AUTO_PAR10" => "Jeśli jego nazwa jest taka sama jak nazwa instalowanego moda to przeniesie go do katalogu z grą. Wszystkie inne pliki znajdujące się w tej lokalizacji (oprócz innych modów) zostaną przeniesione do katalogu z modem. Jeśli występuje tu folder <code>addons</code> to zostanie on połączony z folderem <code>IslandCutscenes</code> w katalogu z modem.",
	"GS_IS_AUTO_PAR11" => "Inne modfoldery zostaną pominięte (wyjątki: 1. folder <code>Res</code> 2. jeśli ściągnęte archiwum zawiera tylko pojedynczy katalog to instalator go nie pominie).",
	"GS_IS_AUTO_PAR12" => "Jeśli jego nazwa to <code>addons</code>, <code>bin</code>, <code>campaigns</code>, <code>dta</code>, <code>worlds</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code>, <code>SPTemplates</code>, <code>MissionsUsers</code>, <code>MPMissionsUsers</code> lub <code>IslandCutscenes</code> to zostanie przeniesiony do katalogu z modem (połączy zawartość). Jeśli <code>MPMissions</code> zawiera tylko pojedynczy folder to wtedy zawartość tego podfolderu zostanie przeniesiona. Jeśli <code>Missions</code> zawiera tylko pojedynczy folder, którego nazwa jest taka sama jak nazwa modu to wtedy jego zawartość zostanie połączona z misjami moda. Jeśli nie jest taka sama to będzie przeniesiony jako oddzielny katalog.",
	"GS_IS_AUTO_PAR13" => "Jeśli zawiera <code>overview.html</code> to wtedy zostanie przeniesiony do <code>Missions</code> w katalogu z modem.",
	"GS_IS_AUTO_PAR14" => "Jeśli jego nazwa kończy się na \"anim\", \"_anim\" lub \"_anims\" to zostanie przeniesiony on do <code>IslandCutscenes</code>. Jeśli jakikolwiek nadrzędny katalog nazywa się \"res\" albo miał słowa \"res\" i \"addons\" w nazwie to obecny folder będzie przeniesiony do <code>IslandCutscenes_Res</code>.",
	"GS_IS_AUTO_PAR15" => "Jeśli jest to folder misji to instalator wykryje jej typ i przeniesie do  <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> lub <code>SPTemplates</code> w katalogu z modem. Jeśli folder ma słowa \"demo\" lub \"template\" w nazwie albo jakikolwiek poprzedni katalog miał w nazwie słowa \"user\" lub \"mission\" i \"demo/editor/template\" to obecny folder zostanie przeniesiony do <code>MissionsUsers</code> lub <code>MPMissionsUsers</code>.",
	"GS_IS_AUTO_PAR16" => "W innym przypadku zbada zawartość katalogu stosując powyższe reguły do każdego zawartego w nim folderu (najpierw) i pliku.",
	"GS_IS_AUTO_PAR17" => "Instalator nadpisze istniejące pliki. Automatycznie tworzy potrzebne foldery.",
	
	#Link format
	"GS_IS_URL_PAR1" => "1. Odsyłacze powinny zaczynać się od protokołu. Odstępy powinny być zamienione na <code>%20</code>. Linki muszą bezpośrednio wskazywać na plik.",
	"GS_IS_URL_PAR2" => "2. Jeśli serwis wymaga przejścia przez pośrednie strony zanim udostępni bezpośredni link to napisz adres do każdej podstrony.",
	"GS_IS_URL_STARTING_URL" => "startowy url",
	"GS_IS_URL_INTERMEDIATE_URL" => "opcjonalnie linki do przejściowych stron",
	"GS_IS_URL_FILE_NAME" => "nazwa pliku",
	"GS_IS_URL_PAR3" => "Nie musisz pisać pełnych odsyłaczy do stron przejściowych. Wystarczy ich unikatowy fragment który łatwo jest znaleźć w źródle strony. Ostatnie wyrażenie to nazwa pliku który zostanie ściągnięty. Jeśli ma odstępy to zamknij je w cudzysłów.",
	"GS_IS_URL_PAR4" => "W powyższym przykładzie instalator:",
	"GS_IS_URL_PAR5" => "Ściągnie stronę https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25",
	"GS_IS_URL_PAR6" => "Znajdzie URL zawierający wyrażenie <span class=\"courier\">/downloads/start/</span> i ściągnię stronę pod tym linkiem.",
	"GS_IS_URL_PAR7" => "Znajdzie URL zawierający wyrażenie <span class=\"courier\">/downloads/mirror/</span> i ściągnie jego zawartość pod nazwą ww4mod25rel.rar",
	"GS_IS_URL_PAR8" => "Na stronie edycji instalacji modu, pod polem do wpisywaniu skryptu znajdziesz narzędzie, które automatycznie doda pośrednie linki (do kilku wybranych stron). Więcej informacji jak samemu szukać takowych odsyłaczy znajdziesz <a href=\"#testing\">poniżej</a>.",
	"GS_IS_URL_PAR9" => "3. Jeśli masz <b>zapasowe linki</b> to umieść je wszystkie w nawiasie klamrowym. Na przykład:",
	"GS_IS_URL_PAR10" => "Jeśli pierwszy zawiedzie to instalator przejdzie do drugiego i tak dalej.",
	"GS_IS_URL_PAR11" => "4. Dla zaoszczędzenia miejsca na dysku instalator kasuje ostatni ściągnięty plik jak tylko zacznie się pobieranie następnego. Aby zachować pliki użyj komendy <a href=\"#get\">GET</a>.",
	
	#Manual installation
	"GS_IS_MANUAL_PAR1" => "Dostępne są komendy dzięki którym możesz kontrolować zachowanie instalatora:",
	"GS_IS_MANUAL_PAR2" => "Niektóre z nich mają dodatkowe nazwy. Na przykład <code>remove</code> i <code>delete</code> są identyczne.",
	"GS_IS_MANUAL_PAR3" => "Komendy umieszczaj w oddzielnych linijkach.",
	"GS_IS_MANUAL_PAR4" => "Komendy zazwyczaj wymagają argumentów. Muszą być one podane w określonej kolejności. Oddzielaj je spacją. Jeśli argument zawiera spację to zamknij go w cudzysłów.",
	"GS_IS_MANUAL_PAR5" => "Komendy mogą używać także przełączników. Są to opcjonalne argumenty, które można umieścić gdziekolwiek w szeregu argumentów. Zaczynają się od prawego ukośnika.",
	"GS_IS_MANUAL_PAR6" => "Pisz nazwy komend dużymi literami dla zwiększenia czytelności.",
	"GS_IS_MANUAL_PAR7" => "Nieprawidłowe komendy zostaną zignorowane.",
	"GS_IS_MANUAL_PAR8" => "Odstępy na początku i końcu linii zostaną zignorowane.",
	"GS_IS_MANUAL_PAR9" => "Skrypt może mieć zarówno automatyczną instalację jak i komendy.",

	"GS_IS_COMMAND" => "komenda",
	"GS_IS_ARGUMENT" => "argument",
	"GS_IS_SWITCH" => "przełącznik",
	"GS_IS_URL_OR_FILE" => "url lub plik",
	"GS_IS_FILE_OR_URL" => "plik lub url",
	"GS_IS_FILE" => "plik",
	"GS_IS_FILE_NAME" => "nazwa pliku",
	"GS_IS_FOLDER" => "folder",
	"GS_IS_PATH" => "ścieżka",
	"GS_IS_TEXT" => "tekst",
	"GS_IS_EXAMPLE" => "Przykład:",
	"GS_IS_DESTINATION" => "folder docelowy",
	"GS_IS_NEW_NAME" => "nowa nazwa",
	"GS_IS_LINE_NUMBER" => "numer linii",
	"GS_IS_OPERATOR" => "operator relacji",
	"GS_IS_NUMBER" => "liczba",
	"GS_IS_NAME1" => "nazwa1",
	"GS_IS_NAME2" => "nazwa2",
	"GS_IS_DATE" => "data",
	"GS_IS_WILDCARDS" => "Wieloznaczniki (patrz <a href=\"https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows\" target=\"_blank\">MSDN</a> i <a href=\"https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards\" target=\"_blank\">StackExchange</a>) mogą zostać użyte do wybrania wielu plików naraz.",
	"GS_IS_GAME_FOLDER" => "katalog z grą",
	"GS_IS_MOD_FOLDER" => "katalog z modem",
	
	#Unpack command
	"GS_IS_UNPACK_PAR1" => "Wypakowuje wybrane archiwum z folderu <span class=\"courier\">fwatch\\tmp\\</span> do podfolderu <span class=\"courier\">_extracted</span> (którego poprzednia zawartość jest usuwana). Jeśli został podany URL to wtedy ściągnie plik do <span class=\"courier\">fwatch\\tmp\\</span> a następnie go rozpakuje.",
	"GS_IS_UNPACK_PAR2" => "Jak otwierać archiwa w archiwach:",
	"GS_IS_UNPACK_PAR3" => "Dodaj przełącznik <code>/password:</code> jeśli archiwum wymaga hasła.",
	"GS_IS_UNPACK_PAR4" => "Jeśli argument nie został podany to wypakowany zostanie ostatni ściągnięty plik.",

	#Move command
	"GS_IS_MOVE_PAR1" => "Przenosi lub kopiuje wybrany plik lub katalog z folderu <span class=\"courier\">fwatch\\tmp\\_extracted</span> do katalogu z modem.",
	"GS_IS_MOVE_PAR2" => "Nadpisuje pliki.",
	"GS_IS_MOVE_PAR3" => "Automatycznie tworzy foldery w ścieżce docelowej.",
	"GS_IS_MOVE_PAR4" => "Przeniesie",
	"GS_IS_MOVE_PAR5" => "do",
	"GS_IS_MOVE_PAR6" => "<strong>Wyjątek:</strong> jeśli wskazany katalog ma taką samą nazwę jak instalowany mod to instalator przeniesie go do katalogu z grą.",
	"GS_IS_MOVE_PAR7" => "Można ominąć to zachowanie podając ścieżkę docelową.",
	"GS_IS_MOVE_PAR8" => "Aby wybrać jednocześnie pliki i foldery dodaj przełącznik <code>/match_dir</code>. Aby wybrać tylko foldery użyj przełącznika <code>/match_dir_only</code>.",
	"GS_IS_MOVE_PAR9" => "Aby zmienić nazwę przenoszonego pliku napisz nową nazwę po ścieżce docelowej.",
	"GS_IS_MOVE_PAR10" => "Wstaw kropkę jeśli nie chcesz zmieniać ścieżki docelowej.",
	"GS_IS_MOVE_PAR11" => "Dodaj przełącznik <code>/no_overwrite</code> aby wyłączyć nadpisywanie plików.",
	"GS_IS_MOVE_PAR12" => "Aby ściągnąć plik umieść odsyłacz(e) w nawiasie klamrowym.",
	"GS_IS_MOVE_PAR13" => "Aby przenosić pliki znajdujące się w katalogu z modem zacznij ścieżkę źródłową od <code>%m1%</code>.",
	"GS_IS_MOVE_PAR14" => "Aby przenieść ostatni ściągnięty plik użyj <code>%m1%</code> lub <code>%m2%</code> jako pierwszego argumentu.",
	"GS_IS_MOVE_PAR15" => "Komendą <code>Copy</code> możesz kopiować pliki z katalogu z grą pod warunkiem, że ścieżka zaczyna się od <code>%m1%</code>.",

	#Unpbo command
	"GS_IS_UNPBO_PAR1" => "Wypakowuje plik PBO znajdujący się w katalogu z modem.",
	"GS_IS_UNPBO_PAR2" => "Nadpisuje istniejące pliki.",
	"GS_IS_UNPBO_PAR3" => "Opcjonalnie możesz wskazać gdzie rozpakować pliki. Foldery w ścieżce przeznaczenia zostaną automatycznie utworzone.",
	"GS_IS_UNPBO_PAR4" => "Aby wypakować plik z katalogu z grą zacznij ścieżkę źródłową od <code>%m1%</code>. Jeśli ścieżka docelowa nie została ustalona to plik zostanie rozpakowany do katalogu z modem.",

	#Makepbo command
	"GS_IS_MAKEPBO_PAR1" => "Tworzy plik PBO (bez kompresji) z wybranego folderu znajdującego się w katalogu z modem, a następnie usuwa ten źródłowy folder. Data modyfikacji pliku PBO będzie taka sama jak data dodania tej wersji moda.",
	"GS_IS_MAKEPBO_PAR2" => "Dodaj przełącznik <code>/keep_source</code> aby zachować folder źródłowy.",
	"GS_IS_MAKEPBO_PAR3" => "Jeśli argument nie został podany to spakowany zostanie ostatni addon rozpakowany przez <code>UnPBO</code>.",
	"GS_IS_MAKEPBO_PAR4" => "Dodaj przełącznik <code>/timestamp:</code> żeby zmienić datę modyfikacji pliku na wybraną (patrz komenda <a href=\"#filedate\">FILEDATE</a>).",

	#Edit command
	"GS_IS_EDIT_PAR1" => "Podmienia linijkę w pliku tekstowym (znajdującym się w katalogu z modem) na wskazaną.",
	"GS_IS_EDIT_PAR2" => "Jeśli tekst zawiera już cudzysłów to w celu uniknięcia konfliktu użyj własnego separatora. Zacznij argument od <code>%m1%%m1%</code> i dowolnego znaku. Zakończ tym samym znakiem.",
	"GS_IS_EDIT_PAR3" => "Data modyfikacji pliku będzie taka sama jak data dodania tej wersji moda.",
	"GS_IS_EDIT_PAR4" => "Dodaj przełącznik <code>/insert</code> aby dodać tekst w nowej linii zamiast ją zamieniać. Jeśli wskazany numer linii wynosi zero lub jest większy od liczby linijek w pliku to tekst zostanie umieszczony na samym końcu.",
	"GS_IS_EDIT_PAR5" => "Użyj przełącznika <code>/append</code> aby dodać tekst na końcu linii zamiast zamieniać.",
	"GS_IS_EDIT_PAR6" => "Dodaj przełącznik <code>/newfile</code> aby utworzyć nowy plik. Istniejący plik zostanie przeniesiony do kosza.",
	"GS_IS_EDIT_PAR7" => "Dodaj przełącznik <code>/timestamp:</code> żeby zmienić datę modyfikacji pliku na wybraną (patrz komenda <a href=\"#filedate\">FILEDATE</a>).",
	"GS_IS_EDIT_PAR8" => "Aby wybrać ostatni ściągnięty plik użyj <code>%m1%</code> lub <code>%m2%</code> jako pierwszego argumentu.",

	#Delete command
	"GS_IS_DELETE_PAR1" => "Usuwa plik lub folder znajdujący się w katalogu z modem.",
	"GS_IS_DELETE_PAR2" => "Aby wybrać jednocześnie pliki i foldery dodaj przełącznik <code>/match_dir</code>.",
	"GS_IS_DELETE_PAR3" => "Jeśli argument nie został podany to skasowany zostanie ostatni ściągnięty plik.",

	#If_version command
	"GS_IS_IFVERSION_PAR1" => "Następne komendy będą wykonywane tylko wtedy gdy numer wersji gry spełnia określony warunek.",
	"GS_IS_IFVERSION_PAR2" => "Jeśli warunek się zgadza to instrukcje poniżej są wykonywane do końca skryptu albo do napotkania komendy <code>else</code> lub <code>endif</code>. Treść pomiędzy <code>else</code> i <code>endif</code> zostanie zignorowana.",
	"GS_IS_IFVERSION_PAR3" => "Jeśli warunek się nie zgadza to komendy poniżej są ignorowane do końca skryptu albo do napotkania komend <code>else</code> lub <code>endif</code>.",
	"GS_IS_IFVERSION_PAR4" => "Dozwolone operatory relacji to: <code>=</code>, <code>==</code>, <code>%m1%</code>, <code>%m1%=</code>, <code>%m2%</code>, <code>%m2%=</code>, <code>%m1%%m2%</code>, <code>!=</code>. Brak operatora jest równoznaczny z porównaniem.",
	"GS_IS_IFVERSION_PAR5" => "Warunki mogą być zagnieżdżane.",

	#Alias command
	"GS_IS_ALIAS_PAR1" => "Zmienia zachowanie automatycznej instalacji oraz komend <code>Move</code> i <code>Copy</code> tak, aby łączyły treść wskazanego folderu z katalogiem z modem. Efekt trwa do końca obecnego skryptu (żeby działał na całą instalację skorzystaj z opcji na stronie edycji szczegółów moda).",
	"GS_IS_ALIAS_PAR2" => "Na przykład: instalowany jest mod @wgl5. Zostało ściągnięte archiwum \"CoC_UA110_Setup.exe\" które zawiera katalogi: @CoC i @wgl5. Domyślnie automatyczna instalacja skopiuje @wgl5 i zignoruje @CoC ale jeśli napiszesz:",
	"GS_IS_ALIAS_PAR3" => "to wtedy instalator nie zignoruje @CoC lecz połączy jego zawartość z  @wgl5 w katalogu z grą.",
	"GS_IS_ALIAS_PAR4" => "Jeśli argument nie został podany to opcja zostaje wyłączona.",

	#Rename command
	"GS_IS_RENAME_PAR1" => "Zmienia nazwę pliku lub folderu znajdującego się w katalogu z modem.",
	"GS_IS_RENAME_PAR2" => "Dodaj przełącznik <code>/match_dir</code> aby wybrać jednocześnie pliki i foldery.",

	#Makedir command
	"GS_IS_MAKEDIR_PAR1" => "Tworzy folder(y).",
	"GS_IS_MAKEDIR_PAR2" => "Utworzy:",

	#Filedate command
	"GS_IS_FILEDATE_PAR1" => "Zmienia datę modyfikacji wybranego pliku znajdującego się w modfolderze. Dozwolonymi formatami są ISO 8601 (RRRR MM DD GG MM SS) albo czas Uniksowy. Muszą być w strefie GMT.",

	#Get command
	"GS_IS_GET_PAR1" => "Ściąga wybrany plik do <span class=\"courier\">fwatch\\tmp\\</span>. Plik zostanie usunięty po wykonaniu obecnego skryptu instalacyjnego.",

	#Ask_get command
	"GS_IS_ASK_GET_PAR1" => "Prosi użytkownika o ręczne ściągnięcie wybranego pliku. Instalacja jest zatrzymana do czasu aż użytkownik ją sam wznowi albo przerwie.",

	#Ask_run command
	"GS_IS_ASK_RUN_PAR1" => "Prosi użytkownika o ręczne uruchomienie wybranego pliku znajdującego się w katalogu <span class=\"courier\">fwatch\\tmp\\</span>. Instalacja jest zatrzymana do czasu aż użytkownik ją sam wznowi albo przerwie.",
	"GS_IS_ASK_RUN_PAR2" => "Używaj tej komendy w przypadku archiwów których nie da się rozpakować.",
	"GS_IS_ASK_RUN_PAR3" => "Aby wybrać plik znajdujący się w katalogu z modem zacznij ścieżkę źródłową od <code>%m1%</code>.",
	"GS_IS_ASK_RUN_PAR4" => "Jeśli argument nie został podany to wybrany zostanie ostatni ściągnięty plik.",

	#Exit command
	"GS_IS_EXIT_PAR1" => "Instalator pominie wszystkie pozostałe komendy w obecnym skrypcie.",

	#Mission files
	"GS_IS_MISSION_PAR1" => "Domyślnie gra obsługuje wyłącznie <code>modfolder\\Campaigns</code> ale z Fwatchem 1.16 możesz przechowywać dowolny rodzaj misji w katalogu z modem.",
	"GS_IS_MISSION_PAR2" => "Kiedy włączasz grę z danym modem to treść jego podfolderów zostanie przeniesiona do odpowiednich folderów w katalogu z grą.",
	"GS_IS_MISSION_PAR3" => "Źródło",
	"GS_IS_MISSION_PAR4" => "Przeznaczenie",
	"GS_IS_MISSION_PAR5" => "Zarówno pliki PBO jak i foldery misji są przenoszone. W przypadku przerywników filmowych i misji dla edytora tylko foldery są przenoszone.",
	"GS_IS_MISSION_PAR6" => "Pliki są przywracane po wyjściu z gry.",
	
	#Example script (WW4)
	"GS_IS_EXAMPLE_PAR1" => "Ten skrypt zainstaluje mod WW4 2.5",
	"GS_IS_EXAMPLE_PAR2" => "Ściągnij archiwum z któregoś z poniższych źródeł a potem wypakuj je do tymczasowego katalogu",
	"GS_IS_EXAMPLE_PAR3" => "Przenieś wszystkie wypakowane pliki i foldery do katalogu z modem (zostanie utworzony jeśli nie istnieje) w katalogu z grą.",
	"GS_IS_EXAMPLE_PAR4" => "Ściągnij i rozpakuj",
	"GS_IS_EXAMPLE_PAR5" => "Przenieś pliki tekstowe (z katalogu z wypakowanymi plikami) do katalogu z modem.",
	"GS_IS_EXAMPLE_PAR6" => "Przenieś addony (z katalogu z wypakowanymi plikami) do modfolder\\addons",
	"GS_IS_EXAMPLE_PAR7" => "Przenieś wszystkie pozostałe pliki i foldery do modfolder\\Bonus",
	"GS_IS_EXAMPLE_PAR8" => "Zamień modfolder\\bin\\resource.cpp (plik który definiuje interfejs), żeby obsługiwać szerokie ekrany",
	"GS_IS_EXAMPLE_PAR9" => "Zamień modfolder\\dta\\anims.pbo (przerywniki filmowe wysp), żeby pojawiła się wiadomość w menu głównym gdy Fwatch jest włączony",

	#Example script (FDF)
	"GS_IS_EXAMPLE_PAR10" => "Ten skrypt zainstaluje mod Finnish Defence Forces 1.4",
	"GS_IS_EXAMPLE_PAR11" => "Ściągnij wersję bazową moda z jednego z pięciu źródeł i zainstaluj automatycznie",
	"GS_IS_EXAMPLE_PAR12" => "Ściągnij aktualizację z jednego z sześciu źródeł i zainstaluj automatycznie",
	"GS_IS_EXAMPLE_PAR13" => "Ściągnij i wypakuj dodatek pustynny",
	"GS_IS_EXAMPLE_PAR14" => "Przenieś wypakowany plik readme do modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR15" => "Przenieś wszystkie pozostałe wypakowane pliki i foldery do katalogu z modem",
	"GS_IS_EXAMPLE_PAR16" => "Ściągnij i wypakuj zimową wyspę Maldevic",
	"GS_IS_EXAMPLE_PAR17" => "Przenieś wypakowany plik readme do modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR18" => "Przenieś wszystkie pozostałe pliki i foldery do katalogu z modem",
	"GS_IS_EXAMPLE_PAR19" => "Ściągnij i wypakuj wyspę Suursaari",
	"GS_IS_EXAMPLE_PAR20" => "Przenieś wypakowany addon do modfolder\\addons",
	"GS_IS_EXAMPLE_PAR21" => "Przenieś wypakowany folder z przerywnikami filmowymi do modfolder\\IslandCutscenes",
	"GS_IS_EXAMPLE_PAR22" => "Przenieś wszystkie pozostałe wypakowane pliki do modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR23" => "Ściągnij i wypakuj zimową wyspę Kolgujev",
	"GS_IS_EXAMPLE_PAR24" => "Przenieś wszystkie wypakowane addony do modfolder\\addons",
	"GS_IS_EXAMPLE_PAR25" => "Przenieś wypakowany plik readme do modfolder\\readme_addons",
	"GS_IS_EXAMPLE_PAR26" => "Przenieś wypakowany folder z przerwynikami filmowymi wyspy do modfolder\\IslandCutscenes",
	"GS_IS_EXAMPLE_PAR27" => "Ściągnij i wypakuj addon MT-LB",
	"GS_IS_EXAMPLE_PAR28" => "Przenieś wszystkie wypakowane addony do modfolder\\addons",
	"GS_IS_EXAMPLE_PAR29" => "Przenieś wypakowany plik readme do modfolder\\readme_addons i zmień jego nazwę na mt-lb22_release_info.txt",
	"GS_IS_EXAMPLE_PAR30" => "Ściągnij i wypakuj Russians Weapons Pack",
	"GS_IS_EXAMPLE_PAR31" => "Przenieś wszystkie rozpakowane addony do modfolder\\addons",
	"GS_IS_EXAMPLE_PAR32" => "Przenieś wypakowany plik readme do modfolder\\readme_addons i zmień jego nazwę na RussianWeaponsPack11_readme.txt",
	"GS_IS_EXAMPLE_PAR33" => "Automatycznie zainstaluj poprawioną wersję addonu rewolwerów Smith & Wesson",
	"GS_IS_EXAMPLE_PAR34" => "Zamień resource.cpp, żeby obsługiwać szerokie ekrany",
	"GS_IS_EXAMPLE_PAR35" => "Zamień modfolder\\dta\\anims.pbo (przerywniki filmowe wysp), żeby pojawiła się wiadomość w menu głównym gdy Fwatch jest włączony.",
	"GS_IS_EXAMPLE_PAR36" => "Utwórz plik konfiguracyjny interfejsu dla Fwatcha - powiększy on menu akcji i czat oraz zmieni ich kolor na niebieski",

	#Example script (WGL)
	"GS_IS_EXAMPLE_PAR37" => "Ten skrypt zainstaluje mod WarGames League 5.12",
	"GS_IS_EXAMPLE_PAR38" => "Instalator automatycznie ściągnie plik z jednego z trzech źródeł, wypakuje go i przeniesie pliki do katalogu z grą",
	"GS_IS_EXAMPLE_PAR39" => "Podobnie z łatką do moda",
	"GS_IS_EXAMPLE_PAR40" => "Jeśli użytkownik posiada wersję gry 1.96 lub starszą",
	"GS_IS_EXAMPLE_PAR41" => "Rozpakuj Res\\Dta\\HWTL\\data.pbo (zawiera tekstury do gry) do modfolder\\dta\\hwtl",
	"GS_IS_EXAMPLE_PAR42" => "Skopiuj wszystkie pliki paa i pac z modfolder\\newdata do modfolder\\dta\\hwtl\\data",
	"GS_IS_EXAMPLE_PAR43" => "Utwórz plik PBO z ostatnio wypakowanego addonu (data.pbo) i usuń źródło",
	"GS_IS_EXAMPLE_PAR44" => "Rozpakuj Res\\Dta\\HWTL\\data3d.pbo (zawiera modele do gry) do modfolder\\dta\\hwtl",
	"GS_IS_EXAMPLE_PAR45" => "Skopiuj wszystkie pliki p3d z modfolder\\newdata do modfolder\\dta\\hwtl\\data3d",
	"GS_IS_EXAMPLE_PAR46" => "Utwórz plik PBO z ostatnio wypakowanego addonu (data3d.pbo) i usuń źródło",
	"GS_IS_EXAMPLE_PAR47" => "Jeśli użytkownik posiada grę nowszą od 1.96",
	"GS_IS_EXAMPLE_PAR48" => "Rozpakuj Dta\\data.pbo (zawiera tekstury do gry) do modfolder\\dta",
	"GS_IS_EXAMPLE_PAR49" => "Skopiuj wszystkie pliki paa i pac z modfolder\\newdata do modfolder\\dta\\data",
	"GS_IS_EXAMPLE_PAR50" => "Utwórz plik PBO z ostatnio wypakowanego addonu (data.pbo) i usuń źródło",
	"GS_IS_EXAMPLE_PAR51" => "Rozpakuj Dta\\HWTL\\data3d.pbo (zawiera modele do gry) do modfolder\\dta",
	"GS_IS_EXAMPLE_PAR52" => "Skopiuj wszystkie pliki p3d z modfolder\\newdata do modfolder\\dta\\data3d",
	"GS_IS_EXAMPLE_PAR53" => "Utwórz plik PBO z ostatnio wypakowanego addonu (data3d.pbo) i usuń źródło",
	"GS_IS_EXAMPLE_PAR54" => "Zamknij sekcję komend zależnych od wersji gry",
	"GS_IS_EXAMPLE_PAR55" => "Zamień resource.cpp, żeby obsługiwać szerokie ekrany",
	"GS_IS_EXAMPLE_PAR56" => "Zamień przerywniki filmowe wysp, żeby pojawiła się wiadomość gdy Fwatch jest włączony.",

	#Testing scripts
	"GS_IS_TEST_PAR1" => "Napisz swój skrypt instalacyjny w <span class=\"courier\">fwatch\\data\\addonInstaller_test.txt</span>",
	"GS_IS_TEST_PAR2" => "Uruchom <span class=\"courier\">addonInstaller.exe</span> z parametrami <code>-testmod=%m1%nazwa moda%m2%</code> i opcjonalnie <code>-testdir=%m1%nazwa folderu%m2%</code>",
	"GS_IS_TEST_PAR3" => "Na przykład: <code>-testmod=@ww4mod25 -testdir=@test</code>. Folder <span class=\"courier\">@test</span> będzie traktowany jak gdyby był to <span class=\"courier\">@ww4mod25</span>.",
	"GS_IS_TEST_PAR4" => "Szczegóły procesu instalacji znajdziesz w <span class=\"courier\">fwatch\\data\\addonInstallerLog.txt</span>.",
	"GS_IS_TEST_PAR5" => "Dodaj parametr <code>-gameversion=%m1%numer%m2%</code> aby testować warunki.",
	"GS_IS_TEST_PAR6" => "W trybie testowym pobrane pliki nie zostaną usunięte dzięki czemu nie będziesz musiał za każdym razem je ściągać.",
	"GS_IS_TEST_PAR7" => "Instalator utworzy plik <span class=\"courier\">fwatch\\tmp\\__downloadtoken</span> który możesz wykorzystać do znalezienia linków przejściowych:",
	"GS_IS_TEST_PAR8" => "Otwórz go w swojej przeglądarce internetowej",
	"GS_IS_TEST_PAR9" => "Znajdź przycisk <i>Ściągnij</i>, kliknij na niego prawym przyciskiem i wybierz <i>Zbadaj</i>",
	"GS_IS_TEST_PAR10" => "Właściwość <i>href</i> zawiera odsyłacz którego szukasz. Wybierz jego małą część która się nie zmienia",
	"GS_IS_TEST_PAR11" => "Wyszukaj wybraną część aby upewnić się, że nie występuje ona nigdzie indziej w pliku",
	"GS_IS_TEST_PAR12" => "Jeśli nie to możesz ją dodać do swojego skryptu instalacyjnego",
	));
}
?>

<div id="page-wrapper">
	<div class="container">
		<?php languageSwitcher(); ?>

<div class="jumbotron">
	<h1 align="center"><?=lang("GS_IS_TITLE")?></h1>
	<p align="center" class="text-muted"><?=lang("GS_IS_DESCRIPTION")?></p>
</div>
	
	
	
	
	
<a name="contents"></a><br>
<div class="panel panel-default">
	<div class="panel-heading"><strong><?=lang("GS_IS_CONTENTS")?></strong></div>
	<div class="panel-body">
	<ul>
		<li><a href="#auto_installation"><?=lang("GS_IS_AUTOMATIC")?></a></li>
		<li><a href="#links"><?=lang("GS_IS_URLFORMAT")?></a></li>
		<li><a href="#manual_installation"><?=lang("GS_IS_COMMANDS")?></a></li>
		<li><a href="#missions"><?=lang("GS_IS_MISSIONS")?></a></li>
		<li><a href="#installation_examples"><?=lang("GS_IS_EXAMPLES")?></a></li>
		<li><a href="#testing"><?=lang("GS_IS_TESTING")?></a></li>
		<li><a href="#changelog"><?=lang("GS_IS_CHANGELOG")?></a></li>
	</ul>
	</div>
</div>
	
	
	
	
	
<a name="auto_installation"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_AUTOMATIC")?></strong></div>
	<div class="panel-body">
		<p><?=lang("GS_IS_AUTO_PAR1")?></p>	
		<pre><code><?=GS_scripting_highlighting("ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar\nftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar")?></code></pre>	
		<br>
		
		<p><?=lang("GS_IS_AUTO_PAR2")?></p>
		<pre><code><?=GS_scripting_highlighting("http://example.com/locked.rar  /password:123")?></code></pre>
		<br>
		
		<h4 class="commandtitle"><?=lang("GS_IS_AUTO_PAR3")?></h4>
		<p><?=lang("GS_IS_AUTO_PAR4")?>
			<ul>
				<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR5")?></li>
				<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR6")?></li>
				<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR7")?></li>
				<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR8")?></li>
			</ul>
		</p>
		<br>
		
		<p><?=lang("GS_IS_AUTO_PAR9")?>
		<ul>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR10")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR11")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR12")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR13")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR14")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR15")?></li>
			<li style="margin-bottom:0.5em;"><?=lang("GS_IS_AUTO_PAR16")?></li>
		</ul>
		</p>
		<br>

		<p><?=lang("GS_IS_AUTO_PAR17")?></p>
	</div>
</div>





<a name="links"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_URLFORMAT")?></strong></div>	
	<div class="panel-body">
		<p><?=lang("GS_IS_URL_PAR1")?></p>
		<pre><code><?=GS_scripting_highlighting("http://ofp-faguss.com/addon/winterofp/[coop]%20nogova%20virus%20-%20they%20hunger.noe_winter.7z")?></code></pre>
		<br>
		<br>
		
		<p><?=lang("GS_IS_URL_PAR2")?></p>
		<pre><code><span class="fake_link">&lt;<?=lang("GS_IS_URL_STARTING_URL")?>&gt;</span>  &lt;<?=lang("GS_IS_URL_INTERMEDIATE_URL")?>&gt;  <span class="download_filename">&lt;<?=lang("GS_IS_URL_FILE_NAME")?>&gt;</span></code></pre>
		
		<p><?=lang("GS_IS_URL_PAR3")?></p>
		<pre><code><?=GS_scripting_highlighting("https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25 /downloads/start/ /downloads/mirror/ ww4mod25rel.rar")?></code></pre>
		
		<p><?=lang("GS_IS_URL_PAR4")?></p>
		<ul>
			<li><?=lang("GS_IS_URL_PAR5")?></li>
			<li><?=lang("GS_IS_URL_PAR6")?></li>
			<li><?=lang("GS_IS_URL_PAR7")?></li>
		</ul>
		
		<p><?=lang("GS_IS_URL_PAR8")?></p>
		<br>
		<br>
		
		<p><?=lang("GS_IS_URL_PAR9")?></p>
		<pre><code><?=GS_scripting_highlighting("{\n\thttp://files.ofpisnotdead.com/files//ofpd/mods/fdfmod14_ww2.rar\n\thttp://fdfmod.dreamhosters.com/ofp/fdfmod14_ww2.rar\n\thttps://www.gamefront.com/games/operation-flashpoint/file/fdf-mod  fdf-mod/download  expires=  fdfmod14_ww2.rar\n}")?></code></pre>
		
		<p><?=lang("GS_IS_URL_PAR10")?></p>
		<br>
		
		<p><?=lang("GS_IS_URL_PAR11")?></p>
	</div>
</div>
	
	
	
	
	
<a name="manual_installation"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_COMMANDS")?></strong></div>
	<div class="panel-body">
	<p><?=lang("GS_IS_MANUAL_PAR1")?></p>
	
	<ul>
	<li><a href="#unpack">Unpack, Extract</a></li>
	<li><a href="#move">Move, Copy</a></li>
	<li><a href="#unpbo">UnPBO, UnpackPBO, ExtractPBO</a></li>
	<li><a href="#makepbo">MakePBO</a></li>
	<li><a href="#edit">Edit</a></li>
	<li><a href="#delete">Delete, Remove</a></li>
	<li><a href="#if_version">If_version, else, endif</a></li>
	<li><a href="#alias">Merge_with, Alias</a></li>
	<li><a href="#rename">Rename</a></li>
	<li><a href="#makedir">Makedir, Newfolder</a></li>
	<li><a href="#filedate">Filedate</a></li>
	<li><a href="#get">Get, Download</a></li>
	<li><a href="#ask_get">Ask_get, Ask_download</a></li>
	<li><a href="#ask_run">Ask_run, Ask_execute</a></li>
	<li><a href="#exit">Exit, Quit</a></li>
	</ul>
	<br>		
		
	<p><?=lang("GS_IS_MANUAL_PAR2")?></p>
	<p><?=lang("GS_IS_MANUAL_PAR3")?></p>
	<p><?=lang("GS_IS_MANUAL_PAR4")?></p>
	<pre><code><span class="scripting_command"><?=strtoupper(lang("GS_IS_COMMAND"))?> <span class="scripting_command_arg1"><?=lang("GS_IS_ARGUMENT")?>1</span> <span class="scripting_command_arg2">"<?=lang("GS_IS_ARGUMENT")?> 2"</span> <span class="scripting_command_arg3">...</span></code></pre>
	<p><?=lang("GS_IS_MANUAL_PAR5")?></p>
	<pre><code><span class="scripting_command"><?=strtoupper(lang("GS_IS_COMMAND"))?> <span class="scripting_command_switch">/<?=lang("GS_IS_SWITCH")?></span> <span class="scripting_command_arg1"><?=lang("GS_IS_ARGUMENT")?></span></code></pre>
	<p><?=lang("GS_IS_MANUAL_PAR6")?></p>
	<p><?=lang("GS_IS_MANUAL_PAR7")?></p>
	<p><?=lang("GS_IS_MANUAL_PAR8")?></p>
	<p><?=lang("GS_IS_MANUAL_PAR9")?></p>
		
		
		
	<a name="unpack"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Unpack, Extract</h3>
	<pre><code><span class="scripting_command">UNPACK</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_URL_OR_FILE")?>&gt;</span>  <span class="scripting_command_switch">/password:&lt;<?=lang("GS_IS_TEXT")?>&gt;</span></code></pre>
	
	<p><?=lang("GS_IS_UNPACK_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("UNPACK  ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe")?></code></pre>
	<br>
	
	<p><?=lang("GS_IS_UNPACK_PAR2")?></p>
	<pre><code><?=GS_scripting_highlighting("UNPACK  first.rar\nUNPACK  _extracted\\second.rar\nUNPACK  _extracted\\_extracted\\third.rar")?></code></pre>
	<br>
	
	<p><?=lang("GS_IS_UNPACK_PAR3")?></p>
	<pre><code><?=GS_scripting_highlighting("UNPACK  example.rar  /password:123")?></code></pre>
	<br>
	
	<p><?=lang("GS_IS_UNPACK_PAR4")?></p>



	<a name="move"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Move, Copy</h3>
	<pre><code><span class="scripting_command">MOVE</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE_OR_URL")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_DESTINATION")?>&gt;</span>  <span class="scripting_command_arg3">&lt;<?=lang("GS_IS_NEW_NAME")?>&gt;</span>  <span class="scripting_command_switch">/no_overwrite</span>  <span class="scripting_command_switch">/match_dir</span>  <span class="scripting_command_switch">/match_dir_only</span></code></pre>
	
	<p><?=lang("GS_IS_MOVE_PAR1")?></p>
	<p><?=lang("GS_IS_MOVE_PAR2")?></p>
	<p><?=lang("GS_IS_MOVE_PAR3")?></p>
	<br>
	<br>

	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  \"FDFmod Readme.html\"")?></code></pre>

	<p>
		<?=lang("GS_IS_MOVE_PAR4")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\fwatch\tmp\_extracted\FDFmod Readme.html</span><br>
		<?=lang("GS_IS_MOVE_PAR5")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;\</span>
	</p>
	<br>
	<br>

	<pre><code><?=GS_scripting_highlighting("MOVE  example.pbo  addons")?></code></pre>
	<p>
		<?=lang("GS_IS_MOVE_PAR4")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\fwatch\tmp\_extracted\example.pbo</span><br>
		<?=lang("GS_IS_MOVE_PAR5")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;\addons\</span>
	</p>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR6")?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  finmod")?></code></pre>
	<p>
		<?=lang("GS_IS_MOVE_PAR4")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\fwatch\tmp\_extracted\finmod</span><br>
		<?=lang("GS_IS_MOVE_PAR5")?>
		<br>
		<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\</span>
	</p>
	<p><?=lang("GS_IS_MOVE_PAR7")?></p>
	<br>
	<br>

	<p><?=lang("GS_IS_WILDCARDS")?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  *.pbo  addons")?></code></pre>
	<p><?=lang("GS_IS_MOVE_PAR8")?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  *  /match_dir\nMOVE  *  /match_dir_only")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR9")?></p>	
	<pre><code><?=GS_scripting_highlighting("MOVE  misc\\readme.txt  docs  readme_old.txt")?></code></pre>
	<p><?=lang("GS_IS_MOVE_PAR10")?></p>	
	<pre><code><?=GS_scripting_highlighting("MOVE  misc\\readme.txt  .  readme_old.txt")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR11")?></p>	
	<pre><code><?=GS_scripting_highlighting("MOVE  *.pbo  addons  /no_overwrite")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR12")?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  {ftp://ftp.armedassault.info/ofpd/gameserver/editorupdate102.pbo}  addons")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR13", ["&lt;mod&gt;"])?></p>	
	<pre><code><?=GS_scripting_highlighting("MOVE  &lt;mod&gt;\\addons\\example.pbo  obsolete")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR14", ["&lt;download&gt;", "&lt;dl&gt;"])?></p>
	<pre><code><?=GS_scripting_highlighting("MOVE  &lt;dl&gt;  addons")?></code></pre>
	<br>
	<br>

	<p><?=lang("GS_IS_MOVE_PAR15", ["&lt;game&gt;"])?></p>	
	<pre><code><?=GS_scripting_highlighting("COPY  &lt;game&gt;\\bin\\Resource.cpp  bin")?></code></pre>



	<a name="unpbo"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">UnPBO, UnpackPBO, ExtractPBO</h3>
	<pre><code><span class="scripting_command">UNPBO</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_DESTINATION")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_UNPBO_PAR1")?></p>
	<p><?=lang("GS_IS_UNPBO_PAR2")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("UNPBO  addons\\ww4_fx.pbo")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_UNPBO_PAR3")?></p>
	<pre><code><?=GS_scripting_highlighting("UNPBO  addons\\ww4_fx.pbo  temp")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_UNPBO_PAR4", ["&lt;game&gt;"])?></p>
	<pre><code><?=GS_scripting_highlighting("UNPBO  &lt;game&gt;\\addons\\kozl.pbo  addons")?></code></pre>



	<a name="makepbo"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">MakePBO</h3>
	<pre><code><span class="scripting_command">MAKEPBO</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FOLDER")?>&gt;</span>  <span class="scripting_command_switch">/keep_source</span>  <span class="scripting_command_switch">/timestamp:&lt;<?=lang("GS_IS_DATE")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_MAKEPBO_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("MAKEPBO  addons\\ww4_fx")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_MAKEPBO_PAR2")?></p>
	<pre><code><?=GS_scripting_highlighting("MAKEPBO  addons\\ww4_fx  /keep_source")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_MAKEPBO_PAR3")?></p>
	<p><?=lang("GS_IS_MAKEPBO_PAR4")?></p>



	<a name="edit"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Edit</h3>
	<pre><code><span class="scripting_command">EDIT</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE_NAME")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_LINE_NUMBER")?>&gt;</span>  <span class="scripting_command_arg3">&lt;<?=lang("GS_IS_TEXT")?>&gt;</span>  <span class="scripting_command_switch">/insert</span>  <span class="scripting_command_switch">/newfile</span>  <span class="scripting_command_switch">/append</span>  <span class="scripting_command_switch">/timestamp:&lt;<?=lang("GS_IS_DATE")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_EDIT_PAR1")?></p>
	<p><?=lang("GS_IS_EDIT_PAR2", ["&gt;"])?></p>
	<p><?=lang("GS_IS_EDIT_PAR3")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("EDIT addons\\FDF_Suursaari\\config.cpp 58 >>@cutscenes[]      = {\"..\\finmod\\addons\\suursaari_anim\\intro\"};@")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EDIT_PAR4")?></p>
	<p><?=lang("GS_IS_EDIT_PAR5")?></p>
	<p><?=lang("GS_IS_EDIT_PAR6")?></p>
	<p><?=lang("GS_IS_EDIT_PAR7")?></p>
	<p><?=lang("GS_IS_EDIT_PAR8", ["&lt;download&gt;", "&lt;dl&gt;"])?></p>



	<a name="delete"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Delete, Remove</h3>
	<pre><code><span class="scripting_command">DELETE</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE_NAME")?>&gt;</span>  <span class="scripting_command_switch">/match_dir</span></code></pre>
	<p><?=lang("GS_IS_DELETE_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("DELETE  Install_win98_ME.bat")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_WILDCARDS")?></p>
	<pre><code><?=GS_scripting_highlighting("DELETE  addons\\*.txt")?></code></pre>
	<p><?=lang("GS_IS_DELETE_PAR2")?></p>
	<pre><code><?=GS_scripting_highlighting("DELETE  temp\\*  /match_dir")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_DELETE_PAR3")?></p>



	<a name="if_version"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">If_version, else, endif</h3>
	<pre><code><span class="scripting_command">IF_VERSION</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_OPERATOR")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_NUMBER")?>&gt;</span>
<span class="scripting_command">ELSE</span>
<span class="scripting_command">ENDIF</span></code></pre>
	<p><?=lang("GS_IS_IFVERSION_PAR1")?></p>
	<p><?=lang("GS_IS_IFVERSION_PAR2")?></p>
	<p><?=lang("GS_IS_IFVERSION_PAR3")?></p>
	<p><?=lang("GS_IS_IFVERSION_PAR4", ["&lt;", "&gt;"])?></p>
	<p><?=lang("GS_IS_IFVERSION_PAR5")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("IF_VERSION  <=  1.96\n\tUNPACK	https://www.mediafire.com/download/86d97zspupnjk9c  ://download  \"WW4 Extended OFP patch v111.zip\"\n\tMOVE	v196_patch\\ww4ext_inf_cfg.pbo.OFP  addons  ww4ext_inf_cfg.pbo\nENDIF")?></code></pre>
	<pre><code><?=GS_scripting_highlighting("IF_VERSION  >=  1.99\n\tCOPY	&lt;game&gt;\\bin\\Config.cpp  bin\nELSE\n\tCOPY	&lt;game&gt;\\Res\\bin\\Config.cpp  bin\nENDIF")?></code></pre>



	<a name="alias"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Merge_with, Alias</h3>
	<pre><code><span class="scripting_command">MERGE_WITH</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_NAME1")?>&gt;</span> <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_NAME2")?>&gt;</span> <span class="scripting_command_arg3">&lt;...&gt;</span></code></pre>
	<p><?=lang("GS_IS_ALIAS_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_ALIAS_PAR2")?></p>
	<pre><code><?=GS_scripting_highlighting("MERGE_WITH  @CoC\nhttps://files.ofpisnotdead.com/files/ofpd/unofaddons2/CoC_UA110_Setup.exe")?></code></pre>
	<p><?=lang("GS_IS_ALIAS_PAR3")?></p>
	<p><?=lang("GS_IS_ALIAS_PAR4")?></p>



	<a name="rename"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Rename</h3>
	<pre><code><span class="scripting_command">RENAME</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_NEW_NAME")?>&gt;</span>  <span class="scripting_command_switch">/match_dir</span></code></pre>
	<p><?=lang("GS_IS_RENAME_PAR1")?></p>
	<br>
	<br>

	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("RENAME  addons\\lo_res_tex.pbo  lo_res_tex.pbx")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_WILDCARDS")?></p>
	<pre><code><?=GS_scripting_highlighting("RENAME  addons\\*.pbo  *.pbx\nRENAME  addons\\*.pbo  ??????????????????_OLD*")?></code></pre>
	<p><?=lang("GS_IS_RENAME_PAR2")?></p>
	<pre><code><?=GS_scripting_highlighting("RENAME  *  *_old  /match_dir")?></code></pre>



	<a name="makedir"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Makedir, Newfolder</h3>
	<pre><code><span class="scripting_command">MAKEDIR</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_PATH")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_MAKEDIR_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("MAKEDIR  addons\nMAKEDIR  dta\\hwtl")?></code></pre>
	<p><?=lang("GS_IS_MAKEDIR_PAR2")?></p>
	<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;</span><br>
	<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;\addons</span><br>
	<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;\dta</span><br>
	<span class="courier" style="margin-left:2em;">&lt;<?=lang("GS_IS_GAME_FOLDER")?>&gt;\&lt;<?=lang("GS_IS_MOD_FOLDER")?>&gt;\dta\hwtl</span><br>



	<a name="filedate"></a><hr class="betweencommands">
	<h3 class="commandtitle">Filedate</h3>
	<pre><code><span class="scripting_command">FILEDATE</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE")?>&gt;</span>  <span class="scripting_command_arg2">&lt;<?=lang("GS_IS_DATE")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_FILEDATE_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("FILEDATE  addons\\example.pbo  2021-02-11T21:36:37")?></code></pre>



	<a name="get"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Get, Download</h3>
	<pre><code><span class="scripting_command">GET</span>  <span class="scripting_command_arg1">&lt;url&gt;</span></code></pre>
	<p><?=lang("GS_IS_GET_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("GET  http://example.com/part1.rar\nGET  http://example.com/part2.rar")?></code></pre>



	<a name="ask_get"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Ask_get, Ask_download</h3>
	<pre><code><span class="scripting_command">ASK_GET</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_FILE_NAME")?>&gt;</span>  <span class="scripting_command_arg2">&lt;url&gt;</span></code></pre>
	<p><?=lang("GS_IS_ASK_GET_PAR1")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("ASK_GET  ww4mod25rel.rar  https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25")?></code></pre>



	<a name="ask_run"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Ask_run, Ask_execute</h3>
	<pre><code><span class="scripting_command">ASK_RUN</span>  <span class="scripting_command_arg1">&lt;<?=lang("GS_IS_URL_OR_FILE")?>&gt;</span></code></pre>
	<p><?=lang("GS_IS_ASK_RUN_PAR1")?></p> 
	<p><?=lang("GS_IS_ASK_RUN_PAR2")?></p>
	<br>
	<br>
	
	<p><?=lang("GS_IS_EXAMPLE")?></p>
	<pre><code><?=GS_scripting_highlighting("ASK_RUN  ftp://ftp.armedassault.info/ofpd/mods/ECP%20v1.085%20(Full%20Installer).exe\nASK_RUN  _extracted\\example.exe")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_ASK_RUN_PAR3", ["&lt;mod&gt;"])?></p>
	<pre><code><?=GS_scripting_highlighting("ASK_RUN  &lt;mod&gt;\\Install_win2k_XP.bat")?></code></pre>
	<br>
	<br>
	
	<p><?=lang("GS_IS_ASK_RUN_PAR4")?></p>



	<a name="exit"></a>
	<hr class="betweencommands">
	<h3 class="commandtitle">Exit, Quit</h3>
	<pre><code><span class="scripting_command">EXIT</span></code></pre>
	<p><?=lang("GS_IS_EXIT_PAR1")?></p>
	</div>
</div>





<a name="missions"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_MISSIONS")?></strong></div>	
	<div class="panel-body">
		<p><?=lang("GS_IS_MISSION_PAR1")?></p>
		<p><?=lang("GS_IS_MISSION_PAR2")?></p>
		<br>
		
		<table class="table table-hover table-bordered">
			<thead class="thead-light">
				<tr>
					<th scope="col"><?=lang("GS_IS_MISSION_PAR3")?></th>
					<th scope="col"><?=lang("GS_IS_MISSION_PAR4")?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>&lt;mod&gt;\Missions</td>
					<td>Missions</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\MPMissions</td>
					<td>MPMissions</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\Templates</td>
					<td>Templates</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\SPTemplates</td>
					<td>SPTemplates</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\IslandCutscenes</td>
					<td>Addons</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\IslandCutscenes\_Res</td>
					<td>Res\Addons</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\MissionsUsers</td>
					<td>Users\&lt;player&gt;\Missions</td>
				</tr>
				<tr>
					<td>&lt;mod&gt;\MPMissionsUsers</td>
					<td>Users\&lt;player&gt;\MPMissions</td>
				</tr>
			</tbody>
		</table>
		<br>
		
		<p><?=lang("GS_IS_MISSION_PAR5")?></p>
		<p><?=lang("GS_IS_MISSION_PAR6")?></p>
	</div>
</div>
	
	
	
	
	
<a name="installation_examples"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_EXAMPLES")?></strong></div>
	<div class="panel-body">
		<p><?=lang("GS_IS_EXAMPLE_PAR1")?></p>

<a name="installation_examples_ww4"></a>
<pre><code><?php
echo GS_scripting_highlighting("; ".lang("GS_IS_EXAMPLE_PAR2")."
UNPACK {
	ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar
	https://www.moddb.com/downloads/start/36064  /downloads/mirror/  ww4mod25rel.rar
	https://ofp.today/download/unofaddons2/ww4mod25rel.7z
}

; ".lang("GS_IS_EXAMPLE_PAR3")."
MOVE    *  /match_dir

; ".lang("GS_IS_EXAMPLE_PAR4")."
UNPACK {
	ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar
	https://ofp.today/download/unofaddons2/ww4mod25patch1.7z
}

; ".lang("GS_IS_EXAMPLE_PAR5")."
MOVE    *.txt

; ".lang("GS_IS_EXAMPLE_PAR6")."
MOVE    *.pbo  addons

; ".lang("GS_IS_EXAMPLE_PAR7")."
MOVE    *  Bonus  /match_dir

; ".lang("GS_IS_EXAMPLE_PAR8")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\WW4mod25\\Resource.cpp  bin

; ".lang("GS_IS_EXAMPLE_PAR9")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\WW4mod25\\Anims.pbo  dta");
?></code></pre>

<hr class="betweencommands">

<p><?=lang("GS_IS_EXAMPLE_PAR10")?></p>

<a name="installation_examples_fdf"></a>
<pre><code><?php
echo GS_scripting_highlighting("; ".lang("GS_IS_EXAMPLE_PAR11")."
{
	http://files.ofpisnotdead.com/files/ofpd/mods/fdfmod13_installer.exe
	http://fdfmod.dreamhosters.com/ofp/fdfmod13_installer.exe
	ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe
	https://www.gamefront.com/games/operation-flashpoint-resistance/file/finnish-defence-forces finnish-defence-forces/download expires= fdfmod13_installer.exe
	http://pulverizer.pp.fi/ewe/mods/fdfmod13_installer.exe
}


; ".lang("GS_IS_EXAMPLE_PAR12")."
{
	http://files.ofpisnotdead.com/files/ofpd/mods/fdfmod14_ww2.rar
	http://fdfmod.dreamhosters.com/ofp/fdfmod14_ww2.rar
	ftp://ftp.armedassault.info/ofpd/mods/fdfmod14_ww2.rar
	https://www.gamefront.com/games/operation-flashpoint/file/fdf-mod fdf-mod/download expires= fdfmod14_ww2.rar
	https://ofp.today/download/mods/fdfmod14_ww2.7z
	http://pulverizer.pp.fi/ewe/mods/fdfmod14_ww2.rar
}


; ".lang("GS_IS_EXAMPLE_PAR13")."
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/mods/FDF_desert_pack.rar
	http://fdfmod.dreamhosters.com/ofp/FDF_desert_pack.rar
	ftp://ftp.armedassault.info/ofpd/mods/FDF_desert_pack.rar
	https://ofp.today/download/mods/FDF_desert_pack.7z
}

; ".lang("GS_IS_EXAMPLE_PAR14")."
MOVE  \"FDF Mod - Al Maldajah - Readme.txt\" readme_addons

; ".lang("GS_IS_EXAMPLE_PAR15")."
MOVE  * /match_dir


; ".lang("GS_IS_EXAMPLE_PAR16")."
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands2/fdf_winter_maldevic.rar
	http://fdfmod.dreamhosters.com/ofp/fdf_winter_maldevic.rar
	ftp://ftp.armedassault.info/ofpd/islands2/fdf_winter_maldevic.rar
	https://ofp.today/file/islands2/fdf_winter_maldevic.7z
}

; ".lang("GS_IS_EXAMPLE_PAR17")."
MOVE  \"FDF Mod - Winter Maldevic - Readme.txt\" readme_addons

; ".lang("GS_IS_EXAMPLE_PAR18")."
MOVE  * /match_dir


; ".lang("GS_IS_EXAMPLE_PAR19")."
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands/Suursaari_release_v10.zip
	http://fdfmod.dreamhosters.com/ofp/Suursaari_release_v10.zip
	ftp://ftp.armedassault.info/ofpd/islands/Suursaari_release_v10.zip
	https://ofp.today/download/islands/Suursaari_release_v10.7z
}

; ".lang("GS_IS_EXAMPLE_PAR20")."
MOVE    FDF_Suursaari.pbo  addons

; ".lang("GS_IS_EXAMPLE_PAR21")."
MOVE    Suursaari_anim  IslandCutscenes

; ".lang("GS_IS_EXAMPLE_PAR22")."
MOVE    *  readme_addons


; ".lang("GS_IS_EXAMPLE_PAR23")."
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands/WinterNogojev11.zip
	https://fdfmod.dreamhosters.com/ofp/WinterNogojev11.zip
	ftp://ftp.armedassault.info/ofpd/islands/WinterNogojev11.zip
	https://www.gamefront.com/games/operation-flashpoint-resistance/file/winternogojev11-zip winternogojev11-zip/download expires= winternogojev11.zip
	https://ds-servers.com/gf/operation-flashpoint-resistance/modifications/islands/winternogojev11-zip.html files/gf/ store.node winternogojev11.zip
	https://www.lonebullet.com/mods/download-winternogojev11-operation-flashpoint-resistance-mod-free-42045.htm /file/ files.lonebullet.com winternogojev11.zip
}

; ".lang("GS_IS_EXAMPLE_PAR24")."
MOVE    *.pbo  addons

; ".lang("GS_IS_EXAMPLE_PAR25")."
MOVE    \"Readme-Winter Nogojev.txt\"  readme_addons

; ".lang("GS_IS_EXAMPLE_PAR26")."
MOVE    KEGnoecainS_anim  IslandCutscenes


; ".lang("GS_IS_EXAMPLE_PAR27")."
UNPACK {
	http://fdfmod.dreamhosters.com/ofp/mt-lb22.zip
	http://ofp-faguss.com/addon/finmod/mt-lb22.7z
	http://faguss.paradoxstudio.uk/addon/finmod/mt-lb22.7z
}

; ".lang("GS_IS_EXAMPLE_PAR28")."
MOVE    *.pbo  addons

; ".lang("GS_IS_EXAMPLE_PAR29")."
MOVE    release_info.txt  readme_addons  mt-lb22_release_info.txt


; ".lang("GS_IS_EXAMPLE_PAR30")."
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/unofaddons/RussianWeaponsPack11.zip
	http://fdfmod.dreamhosters.com/ofp/RussianWeaponsPack11.zip 
	ftp://ftp.armedassault.info/ofpd/unofaddons/RussianWeaponsPack11.zip
	https://ofp.today/download/unofaddons/RussianWeaponsPack11.7z
}

; ".lang("GS_IS_EXAMPLE_PAR31")."
MOVE    *.pbo  addons

; ".lang("GS_IS_EXAMPLE_PAR32")."
MOVE    readme.txt  readme_addons  RussianWeaponsPack11_readme.txt


; ".lang("GS_IS_EXAMPLE_PAR33")."
{
	http://ofp-faguss.com/addon/finmod/SWRevolvers10_fixed.7z
	http://faguss.paradoxstudio.uk/addon/finmod/SWRevolvers10_fixed.7z
	https://docs.google.com/uc?export=download&id=1wAoTEeAuEvveYe2EZnVu_Gic7Nib-7qO SWRevolvers10_fixed.7z
}


; ".lang("GS_IS_EXAMPLE_PAR34")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\FDF\\Resource.cpp  bin

; ".lang("GS_IS_EXAMPLE_PAR35")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\FDF\\Anims.pbo  dta


; ".lang("GS_IS_EXAMPLE_PAR36")."
EDIT    bin\config_fwatch_hud.cfg  0  ACTION_ROWS=43;CHAT_ROWS=12;CHAT_Y=0.56;GROUPDIR_Y=0.5;ACTION_COLORTEXT=[1,1,1,1];ACTION_COLORSEL=[0.133333,0.643137,1,1];CHAT_COLORTEAM=[0.133333,0.643137,1,1];  /newfile");
?></code></pre>

<hr class="betweencommands">

<p><?=lang("GS_IS_EXAMPLE_PAR37")?></p>

<a name="installation_examples_wgl"></a>
<pre><code><?php
echo GS_scripting_highlighting("
; ".lang("GS_IS_EXAMPLE_PAR38")."
{
	ftp://ftp.armedassault.info/ofpd/unofaddons2/WGL5.1_Setup.exe
	https://www.moddb.com/downloads/start/93621  /downloads/mirror/  WGL5.1_Setup.exe
	https://ofp.today/Addons?dir=mods  file=WGL5.1_Setup.exe  WGL5.1_Setup.exe
}

; ".lang("GS_IS_EXAMPLE_PAR39")."
{
	http://pulverizer.pp.fi/ewe/mods/wgl512_2006-11-12.rar
	https://www.moddb.com/downloads/start/93801  /downloads/mirror/  wgl512_2006-11-12.rar
	http://www.mediafire.com/file/4rm6uf16ihe36ce  ://download  wgl512_2006-11-12.rar
}

; ".lang("GS_IS_EXAMPLE_PAR40")."
IF_VERSION  <=  1.96
	; ".lang("GS_IS_EXAMPLE_PAR41")."
	UNPBO  &lt;game&gt;\\Res\\Dta\\HWTL\\data.pbo  dta\\HWTL
	
	; ".lang("GS_IS_EXAMPLE_PAR42")."
	COPY   &lt;mod&gt;\\newdata\\*.pa?           dta\\HWTL\\Data
	
	; ".lang("GS_IS_EXAMPLE_PAR43")."
	MAKEPBO
	
	; ".lang("GS_IS_EXAMPLE_PAR44")."
	UNPBO  &lt;game&gt;\\Res\\Dta\\HWTL\\data3d.pbo  dta\\HTWL
	
	; ".lang("GS_IS_EXAMPLE_PAR45")."
	COPY   &lt;mod&gt;\\newdata\\*.p3d             dta\\HWTL\\data3d
	
	; ".lang("GS_IS_EXAMPLE_PAR46")."
	MAKEPBO
	
; ".lang("GS_IS_EXAMPLE_PAR47")."
ELSE
	; ".lang("GS_IS_EXAMPLE_PAR48")."
	UNPBO  &lt;game&gt;\\DTA\\Data.pbo  dta
	
	; ".lang("GS_IS_EXAMPLE_PAR49")."
	COPY   &lt;mod&gt;\\newdata\\*.pa?  dta\\Data
	
	; ".lang("GS_IS_EXAMPLE_PAR50")."
	MAKEPBO
	
	; ".lang("GS_IS_EXAMPLE_PAR51")."
	UNPBO  &lt;game&gt;\\DTA\\Data3D.pbo  dta
	
	; ".lang("GS_IS_EXAMPLE_PAR52")."
	COPY   &lt;mod&gt;\\newdata\\*.p3d    dta\\Data3D
	
	; ".lang("GS_IS_EXAMPLE_PAR53")."
	MAKEPBO
	
; ".lang("GS_IS_EXAMPLE_PAR54")."
ENDIF

; ".lang("GS_IS_EXAMPLE_PAR55")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\WGL\\Resource.cpp  bin

; ".lang("GS_IS_EXAMPLE_PAR56")."
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\WGL\\Anims.pbo  dta");
?></code></pre>
	</div>
</div>
	
	
	
	
	
<a name="testing"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_TESTING")?></strong></div>
	<div class="panel-body">
	<ul>
		<li><?=lang("GS_IS_TEST_PAR1")?></li>
		<li><?=lang("GS_IS_TEST_PAR2", ["&lt;", "&gt;"])?></li>
	</ul>

	<p><?=lang("GS_IS_TEST_PAR3")?></p>
	<p><?=lang("GS_IS_TEST_PAR4")?></p>
	<p><?=lang("GS_IS_TEST_PAR5", ["&lt;", "&gt;"])?></p>
	<p><?=lang("GS_IS_TEST_PAR6")?></p>
	<p><?=lang("GS_IS_TEST_PAR7")?></p>
	<ul>
		<li><?=lang("GS_IS_TEST_PAR8")?></li>
		<li><?=lang("GS_IS_TEST_PAR9")?></li>
		<li><?=lang("GS_IS_TEST_PAR10")?></li>
		<li><?=lang("GS_IS_TEST_PAR11")?></li>
		<li><?=lang("GS_IS_TEST_PAR12")?></li>
	</ul>
	</div>
</div>





<a name="changelog"></a><br>
<div class="panel panel-default betweencommands">
	<div class="panel-heading"><strong><?=lang("GS_IS_CHANGELOG")?></strong></div>
	<div class="panel-body">
<a name="changelog0.6"></a>
<strong>0.6</strong> (29.04.21)<br>
<ul>
<li><code>Edit</code> -  added <code>/timestamp:</code> switch</li>
<li><code>MakePBO</code> -  added <code>/timestamp:</code> switch</li>
</ul>

<a name="changelog0.59"></a>
<br>
<br>

<strong>0.59</strong> (05.03.21)<br>
<ul>
<li>Auto Install -  If "Missions" contains only a single folder inside then that subfolder will be merged with "&lt;mod&gt;\Missions" only if its name matches the mod name. Otherwise it will be moved as a separate subfolder</li>
</ul>

<a name="changelog0.58"></a>
<br>
<br>

<strong>0.58</strong> (25.02.21)<br>
<ul>
<li>Added <code>EXIT</code> command</li>
<li><code>Move</code> – added switch <code>/match_dir_only</code></li>
<li>Installer removes previously downloaded file when starting download for a new file except when using <code>GET</code> command</li>
<li>Intermediary URL part may contain phrase <code>href="</code> and installer will read the link following that phrase</li>
</ul>

<a name="changelog0.57"></a>
<br>
<br>

<strong>0.57</strong> (11.02.21)<br>
<ul>
<li>Added <code>FILEDATE</code> command</li>
</ul>

<a name="changelog0.56"></a>
<br>
<br>

<strong>0.56</strong> (05.02.21)<br>
<ul>
<li>Auto Install - will try to extract .cab files</li>
<li>Auto Install - will detect if mission is a wizard template and move it to the "Templates" or "SPTemplates"</li>
<li>Auto Install - will detect if "MPMissions" folder contains a single folder inside and move it instead (previously it only did that for "Missions")</li>
<li>Auto Install - will not ignore "Res" folder</li>
<li>Auto Install - if downloaded archive contains a single folder then that folder won't be ignored (previously it could have been treated as a different mod and skipped)</li>
<li>Auto Install - if a folder contains "overview.html" then it will be copied to "Missions"</li>
<li>Auto Install - if a directory contains wanted modfolder then installer will move all files and folders from that dir (except for other modfolders). Folder "addons" will be copied as "IslandCutscenes"</li>
<li>Auto Install - will try open all executables; will ask user to run it if nothing else was copied (instead of asking about the first encountered)</li>
<li>Auto Install - will move directories ending with "anim", "_anim", "_anims" to the "IslandCutscenes" or "IslandCutscenes\_Res" if parent was named "res" or had words "res" and "addons"</li>
<li>Auto Install - will move mission directories containing words "demo" or "template" to the "MissionsUsers" or "MPMissionsUsers"</li>
<li>Auto Install - will move folders "Templates", "SPTemplates", "MissionsUsers", "MPMissionsUsers", "IslandCutscenes" to the modfolder</li>
<li>Auto Install - will scan directories before files (previously it was alphabetic)</li>
<li>Auto Install - will move mission folder to the to the "MissionsUsers" or "MPMissionsUsers" if one of the parent folders contained word "user" or words "mission" and "demo/editor/template"</li>
<li><code>MakePBO</code> - renamed switch <code>/no_delete</code> to <code>/keep_source</code></li>
<li><code>Alias</code> - added alternative name for this command: <code>Merge_With</code></li>
</ul>

<a name="changelog0.55"></a>
<br>
<br>

<strong>0.55</strong> (12.01.21)<br>
<ul>
<li>Removed <code>/mirror</code> switch. Instead there are now url blocks indicated by curly brackets</li>
<li><code>Move</code> – curly brackets are now used (instead of a vertical bar) to separate url arguments from move arguments</li>
</ul>

<a name="changelog0.53"></a>
<br>
<br>

<strong>0.53</strong> (01.03.20)<br>
<ul>
<li><code>Alias</code> – effect now lasts until the end of the script (instead of throughout the entire installation)</li>
<li>Added shorter name <code>UnPBO</code> for the command <code>UnpackPBO</code></li>
</ul>

<a name="changelog0.52"></a>
<br>
<br>

<strong>0.52</strong> (16.02.20)<br>
<ul>
<li>Command arguments can now be escaped with custom delimiters (relevant for the <code>Edit</code> command)</li>
</ul>

<a name="changelog0.51"></a>
<br>
<br>

<strong>0.51</strong> (14.02.20)<br>
<ul>
<li>Added command: <code>Alias</code></li>
<li>Auto installation - reverted change from 0.31: file name irrelevant for auto installation again (use command Alias instead)</li>
<li>Auto installation - now detects if mission is SP or MP and copies it to the correct folder</li>
<li><code>Edit</code> – added <code>/append</code> switch</li>
<li><code>MakePBO</code> – fixed bug where it wouldn't work with files with spaces in their names</li>
</ul>

<a name="changelog0.4"></a>
<br>
<br>

<strong>0.4</strong> (15.07.19)<br>
<ul>
<li><code>Edit</code> – added <code>/newfile</code> switch</li>
<li><code>Edit</code> – switch <code>/insert</code> can now be used to append text at the end</li>
</ul>

<a name="changelog0.31"></a>
<br>
<br>

<strong>0.31</strong> (06.04.19)<br>
<ul>
<li>Auto installation - doesn't ignore modfolders if their name is contained in downloaded filename</li>
</ul>

<a name="changelog0.3"></a>
<br>
<br>

<strong>0.3</strong> (02.04.19)<br>
<ul>
<li>Download links can now be followed with <code>/mirror</code> switch</li>
<li>Download links can now be followed with extra arguments for multi-step downloading</li>
<br>
<li><code>Move</code> – wildcard with <code>/match_dir</code> will move modfolder to the game dir but not recursively</li>
<li><code>Move</code> – added vertical bar to separate download arguments from move arguments</li>
<br>
<li><code>Ask_Get</code> – doesn't make a request if file already exists</li>
<li><code>Ask_Get</code> – asks user to select download directory and saves its location</li>
<li><code>Ask_Get</code> – automatically moves file to the <span class="courier">fwatch\tmp\</span></li>
<br>
<li><code>Ask_Run</code> – executes the file instead of opening folder with it</li>
<li><code>Ask_Run</code> - restores "Aspect_Ratio.hpp" from before executing the file in order to keep user's settings</li>
<br>
<li><code>Get</code> - now considered active again</li>
<li><code>Get</code> - cannot pass custom wget arguments anymore</li>
<br>
<li>added <code>-testdir</code> parameter</li>
</ul>

<a name="changelog0.2"></a>
<br>
<br>

<strong>0.2</strong> (11.03.19)<br>
<ul>
<li>added commands: <code>Ask_Download</code>, <code>Delete</code>, <code>Rename</code>, <code>If_version</code>, <code>else</code>, <code>endif</code>, <code>Makepbo</code>, <code>UnpackPBO</code>, <code>Edit</code></li>
<li>renamed command <code>Execute</code> to <code>Ask_Execute</code></li>
<li>renamed command <code>Mdir</code> to <code>Makedir</code></li>
<br>
<li><code>Move</code> – now overwrites by default, added <code>/no_overwrite</code> switch</li>
<li><code>Move</code> – can access modfolder files with <code>&gt;mod&gt;</code> macro</li>
<li><code>Move</code> – can now rename files</li>
<li><code>Move</code> – wildcards will not match folders unless <code>/match_dir</code> switch was added</li>
<li><code>Move</code> – renamed macro <code>DOWNLOADED_FILENAME</code> to <code>&lt;download&gt;</code> and <code>&lt;dl&gt;</code></li>
<li><code>Move</code> – now source argument can be url</li>
<br>
<li><code>Copy</code> – can access game root directory with <code>&lt;game&gt;</code> macro</li>
<br>
<li><code>Makedir</code> – could be used to create custom folders in the game root directory – fixed</li>
<li><code>Makedir</code> – now creates modfolder if it’s missing</li>
<br>
<li><code>Unpack</code>, <code>Ask_Execute</code> – will work on downloaded file if no argument given</li>
<li><code>Unpack</code>, <code>Ask_Execute</code> – now source argument can be url</li>
<li><code>Unpack</code> – archive within archive was unpacked to the wrong folder – fixed</li>
<li><code>Unpack</code> – added <code>/password:</code> switch</li>
<br>
<li>Auto Installation – added <code>/password:</code> switch</li>
<br>
<li><code>Get</code> – now considered obsolete</li>
<br>
<li>added <code>-testmod</code> parameter</li>
</ul>

<a name="changelog0.1"></a>
<br>
<br>

<strong>0.1</strong> (03.03.17)<br>
First release.<br>
	</div>
</div>
	
	
	
	

<!-- end page-wrapper -->	
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
