<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
?>

<div id="page-wrapper">
	<div class="container">
	
	
	<div class="jumbotron">
		<h1 align="center">How to Write Installation Instructions</h1>
		<p align="center" class="text-muted">These scripts will determine how your mod is going to be installed</p>
		<p align="center" style="font-size: 1em;">
			<a href="#auto_installation">Automatic</a> &nbsp;
			<a href="#links">URL Format</a> &nbsp;
			<a href="#manual_installation">Commands</a> &nbsp;
			<a href="#missions">Missions</a> &nbsp;
			<a href="#installation_examples">Examples</a> &nbsp;
			<a href="#testing">Testing</a> &nbsp;
			<a href="#changelog">Changelog</a>
		</p>
	</div>
	
	
	
	<a name="auto_installation"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Automatic Installation</strong></div>
		<div class="panel-body">
			<p>Simply paste a direct link to the file and the installator will figure out what to do on its own. Write download for each file in a new line.</p>
			
<pre><code><?php
echo GS_scripting_highlighting("ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar
ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar");?></code></pre>
			
<br>		
			<p>Add <code>/password:</code> switch if an archive is locked</p>
			<pre><code><?php
echo GS_scripting_highlighting("http://example.com/locked.rar  /password:123");?></code></pre>
			
			<br>
			<h4 class="commandtitle">How does it work?</h4>

			<p>Installer checks the extension of the downloaded file:
			<ul>
				<li>If it's <code>.rar</code>, <code>.zip</code>, <code>.7z</code>, <code>.ace</code>, <code>.exe</code> or <code>.cab</code> then it will extract it and inspect its contents.</li>
				<li>If an <code>.exe</code> couldn't be unpacked and nothing else was copied up until that point then it will ask the user to run it.</li>
				<li>If it's a <code>.pbo</code> then it will detect its type and move it to the <code>addons</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> directory in the modfolder.</li>
				<li>Other types of files are ignored.</li>
			</ul></p>

			<p>When installer encounters a directory it will check its name and contents:</p>
			<ul>
				<li>If the name matches the name of the mod being installed then it will be moved to the game directory. All other files and folders (except for other mods) from this location will be moved to the modfolder. If directory <code>addons</code> is present then it will be merged with <code>IslandCutscenes</code> in the modfolder.</li>
				<li>Other modfolders will be ignored (exceptions: 1. <code>Res</code> folder 2. if downloaded archive contains a single folder then that one won't be skipped).</li>
				<br>
				<li>If the name matches <code>addons</code>, <code>bin</code>, <code>campaigns</code>, <code>dta</code>, <code>worlds</code>, <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code>, <code>SPTemplates</code>, <code>MissionsUsers</code>, <code>MPMissionsUsers</code> or <code>IslandCutscenes</code> then it will be moved to the modfolder (contents will be merged). If <code>MPMissions</code> contains only a single folder inside then that folder will be moved instead. If <code>Missions</code> contains only a single folder that matches mod name then its contents will be merged with the mod missions. If it doesn't match then it will be moved as a separate folder.</li>
				<li>If it contains <code>overview.html</code> then it will be moved to the <code>Missions</code> folder.</li>
				<br>
				<li>If the name ends with "anim", "_anim" or "_anims" then it will be moved to the <code>IslandCutscenes</code>. If any parent folder was named "res" or had words "res" and "addons" then it will be moved to the <code>IslandCutscenes\_Res</code> instead.</li>
				<li>If it's a mission then it will detect its type and move it to the <code>Missions</code>, <code>MPMissions</code>, <code>Templates</code> or <code>SPTemplates</code> directory in the modfolder. If folder name contains words "demo" or "template" or if any parent folder name contained words "user" or "mission" and "demo/editor/template" then it will be moved to the <code>MissionsUsers</code> or <code>MPMissionsUsers</code> instead.</li>
				<br>
				<li>In any other case it will go through the contents of a directory and apply the same rules for each folder (first) and file there.</p>
			</ul></p>

			<p>Existing files will be overwritten. Destination directories that don't exist will be created.</p>

		</div>
	</div><!-- /panel -->


	<a name="links"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>URL Format</strong></div>	
		<div class="panel-body">
			<p>1. Links should start with the protocol. Spaces should be replaced with <code>%20</code>. They have to directly point to the file.</p>
			<pre><code><?php
echo GS_scripting_highlighting("http://ofp-faguss.com/addon/winterofp/[coop]%20nogova%20virus%20-%20they%20hunger.noe_winter.7z");?></code></pre>
			
			<br>
			<br>
			<p>2. If a website requires you to go through intermediate pages in order to receive a direct link then write address to each one.</p>
<pre><code><span class="fake_link">&lt;starting url&gt;</span>  &lt;optionally intermediate links&gt;  <span class="download_filename">&lt;file name&gt;</span></code></pre>
			<p>You don't actually have to type in full intermediary URL but only the unique part that is easily searcheable in the page source code.
			Last item is the name of the file that's going to be downloaded. If it contains spaces then put it in quotation marks.</p>
		
<pre><code><?php
echo GS_scripting_highlighting("https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25 /downloads/start/ /downloads/mirror/ ww4mod25rel.rar");?></code></pre>
<p>In the above example installer will:</p>
<ul>
<li>Download page https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25</li>
<li>Find URL containing phrase <span class="courier">/downloads/start/</span> and download web page behind that link</li>
<li>Find URL containing phrase <span class="courier">/downloads/mirror/</span> and download its contents as ww4mod25rel.rar</li>
</ul>
<p>On the mod update page, next to the script input box you'll find a tool automatically convert URL to the correct format (for a few selected sites).
More information on how to find intermediate links on your own you'll find <a href="#testing">below</a>.</p>


<br>
<br>
<p>3. If you have <b>backup links</b> then place all of them between a pair of curly brackets. Example:</p>
<pre><code><?php
echo GS_scripting_highlighting("{
	http://files.ofpisnotdead.com/files//ofpd/mods/fdfmod14_ww2.rar
	http://fdfmod.dreamhosters.com/ofp/fdfmod14_ww2.rar
	https://www.gamefront.com/games/operation-flashpoint/file/fdf-mod  fdf-mod/download  expires=  fdfmod14_ww2.rar
}");?></code></pre>
<p>If the first one fails then installer will try the second one and so on.</p>
<br>
<p>4. To save disk space downloaded file is deleted when the next download starts. To keep it use <a href="#get">GET</a> command.</p>


		</div>
	</div><!-- /panel -->	
	
	
	
	<a name="manual_installation"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Manual Installation</strong></div>
		<div class="panel-body">
		<p>There are commands to make installer do exactly what you want:</p>
		
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
		
		<p>Some commands have aliases. For example <code>remove</code> and <code>delete</code> are the same.</p>
		<p>Write each command in a separate line.</p>
		<p>Commands usually require arguments. Separate them by spaces. If an argument contains space then put it in quotation marks.</p>
		<p>I recommend to capitalize command names for readability.</p>
		<p>Invalid command names will be ignored.</p>
		<p>Leading and trailing spaces will be ignored.</p>
		<p>Script can consist both of auto installation and commands.</p>
		
<a name="unpack"></a><hr class="betweencommands">
<h3 class="commandtitle">Unpack, Extract</h3>
<pre><code>UNPACK  &lt;url or file&gt;  /password:&lt;text&gt;</code></pre>
<p>Extracts archive from the <span class="courier">fwatch\tmp</span> directory to the <span class="courier">_extracted</span> subfolder (its previous contents are wiped). If passed URL then it downloads a file to the <span class="courier">fwatch\tmp</span> and extracts it.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("UNPACK  ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe");?></code></pre>
<br>
<p>How to handle nested archives:</p>
<pre><code><?php echo GS_scripting_highlighting("UNPACK  first.rar
UNPACK  _extracted\\second.rar
UNPACK  _extracted\\_extracted\\third.rar");?></code></pre>
<br>
<p>Add <code>/password:</code> switch if an archive is locked</p>
<pre><code><?php echo GS_scripting_highlighting("UNPACK  example.rar  /password:123");?></code></pre>
<br>
<p>Use this command without any arguments to extract the last downloaded file.</p>




<a name="move"></a><hr class="betweencommands">
<h3 class="commandtitle">Move, Copy</h3>
<pre><code>MOVE  &lt;file or url&gt;  &lt;destination&gt;  &lt;new name&gt;  /no_overwrite  /match_dir  /match_dir_only</code></pre>
<p>Moves or copies selected file or folder from the <span class="courier">fwatch\tmp\_extracted</span> directory to the modfolder.</p>
<p>Overwrites files.</p>
<p>Automatically creates sub-directories in the destination path.</p>
<br><br>

<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("MOVE  \"FDFmod Readme.html\"");?></code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\FDFmod Readme.html</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\</span>
</p>

<br><br>

<pre><code><?php echo GS_scripting_highlighting("MOVE  example.pbo  addons");?></code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\example.pbo</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\addons\</span>
</p>

<br><br>

<p><strong>Exception:</strong> if the directory you want to move has the same name as the modfolder you’re installing then the
destination path is changed to the game folder.</p>

<pre><code><?php echo GS_scripting_highlighting("MOVE  finmod");?></code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\finmod</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\</span>
</p>
<p>You can cancel this behaviour by specifying destination argument.</p>

<br><br>

<p>Wildcards (see <a href="https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows" target="_blank">MSDN</a> and <a href="https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards" target="_blank">StackExchange</a>) can be used to match multiple files.</p>
<pre><code><?php echo GS_scripting_highlighting("MOVE  *.pbo  addons");?></code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch. To match exclusively folders use <code>/match_dir_only</code> instead.</p>
<pre><code><?php echo GS_scripting_highlighting("MOVE  *  /match_dir
MOVE  *  /match_dir_only");?></code></pre>

<br><br>

<p>To rename the file that's being moved write new name after the destination path.</p>	
<pre><code><?php echo GS_scripting_highlighting("MOVE  misc\\readme.txt  docs  readme_old.txt");?></code></pre>
<p>Use dot if you don’t want to change location.</p>	
<pre><code><?php echo GS_scripting_highlighting("MOVE  misc\\readme.txt  .  readme_old.txt");?></code></pre>

<br><br>

<p>Add <code>/no_overwrite</code> switch to disable overwriting files.</p>	
<pre><code><?php echo GS_scripting_highlighting("MOVE  *.pbo  addons  /no_overwrite");?></code></pre>

<br><br>

<p>To download a file write link(s) between curly brackets.</p>
<pre><code><?php echo GS_scripting_highlighting("MOVE  {ftp://ftp.armedassault.info/ofpd/gameserver/editorupdate102.pbo}  addons");?></code></pre>

<br><br>

<p>To access files in the modfolder start the first argument with <code>&lt;mod&gt;</code>.</p>	
<pre><code><?php echo GS_scripting_highlighting("MOVE  &lt;mod&gt;\\addons\\example.pbo  obsolete");?></code></pre>

<br><br>

<p>To access the last downloaded file use <code>&lt;download&gt;</code> or <code>&lt;dl&gt;</code> as the first argument.</p>	
<pre><code><?php echo GS_scripting_highlighting("MOVE  &lt;dl&gt;  addons");?></code></pre>

<br><br>

<p>Command <code>Copy</code> can take files from any location if the path starts with <code>&lt;game&gt;</code>.</p>	
<pre><code><?php echo GS_scripting_highlighting("COPY  &lt;game&gt;\\bin\\Resource.cpp  bin");?></code></pre>




<a name="unpbo"></a><hr class="betweencommands">
<h3 class="commandtitle">UnPBO, UnpackPBO, ExtractPBO</h3>
<pre><code>UNPBO  &lt;file&gt;  &lt;destination&gt;</code></pre>
<p>Extracts PBO file from the modfolder.</p>
<p>Overwrites existing files.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("UNPBO  addons\\ww4_fx.pbo");?></code></pre>
<br><br>
<p>Optionally you can specify where to extract files. Sub-directories in the destination path are automatically created.</p>
<pre><code><?php echo GS_scripting_highlighting("UNPBO  addons\\ww4_fx.pbo  temp");?></code></pre>
<br><br>
<p>To access files from any location start the path with <code>&lt;game&gt;</code>. If destination wasn’t specified then the addon will be unpacked to the modfolder.</p>
<pre><code><?php echo GS_scripting_highlighting("UNPBO  &lt;game&gt;\\addons\\kozl.pbo  addons");?></code></pre>




<a name="makepbo"></a><hr class="betweencommands">
<h3 class="commandtitle">MakePBO</h3>
<pre><code>MAKEPBO  &lt;folder&gt;  /keep_source  /timestamp:</code></pre>
<p>Creates PBO file (no compression) out of a directory in the modfolder and then removes the source. PBO file modification date will be set to the day the specific mod version was added.</p>

<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("MAKEPBO  addons\\ww4_fx");?></code></pre>

<br><br>
<p>Add switch <code>/keep_source</code> to keep the original folder.</p>
<pre><code><?php echo GS_scripting_highlighting("MAKEPBO  addons\\ww4_fx  /keep_source");?></code></pre>

<br><br>
<p>Use this command without writing file name to pack the last addon extracted with <code>UnPBO</code>.</p>
<p>Add switch <code>/timestamp:</code> for a custom file modification date (see <a href="#filedate">FILEDATE</a> command for details).</p>




<a name="edit"></a><hr class="betweencommands">
<h3 class="commandtitle">Edit</h3>
<pre><code>EDIT  &lt;file name&gt;  &lt;line number&gt;  &lt;text&gt;  /insert  /newfile  /append  /timestamp:</code></pre>
<p>Replaces text line in the selected file from the modfolder.</p>
<p>If new text already contains quotation marks then use a custom separator to avoid conflict. Start argument with <code>&gt;&gt;</code> and a chosen character. End it with the same character.</p>
<p>File modification date will be set to the day the specific mod version was added.</p>

<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("EDIT addons\\FDF_Suursaari\\config.cpp 58 >>@cutscenes[]      = {\"..\\finmod\\addons\\suursaari_anim\\intro\"};@");?></code></pre>

<br><br>
<p>Add switch <code>/insert</code> to add a new line instead of replacing. If the selected line number is zero or exceeds the number of lines in a file then the text will be added at the end.</p>
<p>Add switch <code>/append</code> to append to the line instead of replacing.</p>
<p>Add switch <code>/newfile</code> to create a new file. Existing file will be trashed.</p>
<p>Add switch <code>/timestamp:</code> for a custom file modification date (see <a href="#filedate">FILEDATE</a> command for details).</p>
<p>To access the last downloaded file use <code>&lt;download&gt;</code> or <code>&lt;dl&gt;</code> as the first argument.</p>





<a name="delete"></a><hr class="betweencommands">
<h3 class="commandtitle">Delete, Remove</h3>
<pre><code>DELETE  &lt;file&gt;  /match_dir</code></pre>
<p>Deletes file or folder from the modfolder.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("DELETE  Install_win98_ME.bat");?></code></pre>
<br><br>
<p>Wildcards (see <a href="https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows" target="_blank">MSDN</a> and <a href="https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards" target="_blank">StackExchange</a>) can be used to match multiple files.</p>
<pre><code><?php echo GS_scripting_highlighting("DELETE  addons\\*.txt");?></code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch.</p>
<pre><code><?php echo GS_scripting_highlighting("DELETE  temp\\*  /match_dir");?></code></pre>
<br><br>
<p>Use this command without any arguments to remove the last downloaded file.</p>




<a name="if_version"></a><hr class="betweencommands">
<h3 class="commandtitle">If_version, else, endif</h3>
<pre><code>IF_VERSION  &lt;operator&gt;  &lt;number&gt;
ELSE
ENDIF</code></pre>
<p>Executes selected commands only if your game version matches given number.</p>
<p>If it does then following instructions are executed until the end of the script or until <code>endif</code> command is encountered. Content between <code>else</code> and <code>endif</code> will be ignored.</p>
<p>If condition wasn’t correct then following commands are skipped until the end of script or until <code>else</code> or <code>endif</code> commands.</p>
<p>Allowed comparison operators are: <code>=</code>, <code>==</code>, <code>&lt;</code>, <code>&lt;=</code>, <code>&gt;</code>, <code>&gt;=</code>, <code>&lt;&gt;</code>, <code>!=</code>. If there’s no operator then equality is assumed.</p>
<p>Conditions can be nested.</p>

<br><br>
<p>Examples:</p>
<pre><code><?php echo GS_scripting_highlighting("IF_VERSION  <=  1.96
	UNPACK	https://www.mediafire.com/download/86d97zspupnjk9c  ://download  \"WW4 Extended OFP patch v111.zip\"
	MOVE	v196_patch\\ww4ext_inf_cfg.pbo.OFP  addons  ww4ext_inf_cfg.pbo
ENDIF");?></code></pre>
<pre><code><?php echo GS_scripting_highlighting("IF_VERSION  >=  1.99
	COPY	&lt;game&gt;\\bin\\Config.cpp  bin
ELSE
	COPY	&lt;game&gt;\\Res\\bin\\Config.cpp  bin
ENDIF");?></code></pre>




<a name="alias"></a><hr class="betweencommands">
<h3 class="commandtitle">Merge_with, Alias</h3>
<pre><code>MERGE_WITH  &lt;name1&gt; &lt;name2&gt; &lt;...&gt;</code></pre>
<p>Enables for the auto installation, <code>Move</code> and <code>Copy</code> to merge specified folder with the modfolder being installed. Effect lasts until end of the current script (to make it work for all versions use option from the mod details page).</p>
<br><br>
<p>For example: mod @wgl5 is being installed. Archive "CoC_UA110_Setup.exe" was downloaded which contains folders: @CoC and @wgl5. By default auto installation will copy @wgl5 and ignore @CoC but if you'll write:</p>
<pre><code><?php echo GS_scripting_highlighting("MERGE_WITH  @CoC
https://files.ofpisnotdead.com/files/ofpd/unofaddons2/CoC_UA110_Setup.exe");?></code></pre>
<p>then the installer won't skip @CoC but move its contents to the @wgl5 in the game directory.</p>
<p>Use this command without any arguments to clear all the names.</p>




<a name="rename"></a><hr class="betweencommands">
<h3 class="commandtitle">Rename</h3>
<pre><code>RENAME  &lt;file&gt;  &lt;new name&gt;  /match_dir</code></pre>
<p>Renames file or folder from the modfolder.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("RENAME  addons\\lo_res_tex.pbo  lo_res_tex.pbx");?></code></pre>
<br><br>
<p>Wildcards (see <a href="https://docs.microsoft.com/en-us/archive/blogs/jeremykuhne/wildcards-in-windows" target="_blank">MSDN</a> and <a href="https://superuser.com/questions/475874/how-does-the-windows-rename-command-interpret-wildcards" target="_blank">StackExchange</a>) can be used to match multiple files.</p>
<pre><code><?php echo GS_scripting_highlighting("RENAME  addons\\*.pbo  *.pbx
RENAME  addons\\*.pbo  ??????????????????_OLD*");?></code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch.</p>
<pre><code><?php echo GS_scripting_highlighting("RENAME  *  *_old  /match_dir");?></code></pre>




<a name="makedir"></a><hr class="betweencommands">
<h3 class="commandtitle">Makedir, Newfolder</h3>
<pre><code>MAKEDIR  &lt;path&gt;</code></pre>
<p>Creates folder(s).</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("MAKEDIR  addons
MAKEDIR  dta\\hwtl");?></code></pre>
<p>This will create:</p>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\addons</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\dta</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\dta\hwtl</span><br>




<a name="filedate"></a><hr class="betweencommands">
<h3 class="commandtitle">Filedate</h3>
<pre><code>FILEDATE  &lt;file&gt;  &lt;date&gt;</code></pre>
<p>Changes modification date of a seleted file in the modfolder. Acceptable formats are ISO 8601 (YYYY MM DD HH MM SS) or Unix timestamp. It must be in GMT timezone.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("FILEDATE  addons\\example.pbo  2021-02-11T21:36:37");?></code></pre>




<a name="get"></a><hr class="betweencommands">
<h3 class="commandtitle">Get, Download</h3>
<pre><code>GET  &lt;url&gt;</code></pre>
<p>Downloads a file to the <span class="courier">fwatch\tmp\</span> directory. It will be removed at the end of the current installation script.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("GET  http://example.com/part1.rar
GET  http://example.com/part2.rar");?></code></pre>




<a name="ask_get"></a><hr class="betweencommands">
<h3 class="commandtitle">Ask_get, Ask_download</h3>
<pre><code>ASK_GET  &lt;file name&gt;  &lt;url&gt;</code></pre>
<p>Requests the user to manually download given file. Installation is paused until user decides to continue or abort.</p>
<br><br>
<p>Example:</p>
<pre><code><?php echo GS_scripting_highlighting("ASK_GET  ww4mod25rel.rar  https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25");?></code></pre>




<a name="ask_run"></a><hr class="betweencommands">
<h3 class="commandtitle">Ask_run, Ask_execute</h3>
<pre><code>ASK_RUN  &lt;url or file&gt;</code></pre>
<p>Requests the user to manually launch selected file from the <span class="courier">fwatch\tmp\</span> directory. Installation is paused until user decides to continue or abort.</p> 
<p>Use this command for executables that cannot be extracted.</p>
<br><br>
<p>Examples:</p>
<pre><code><?php echo GS_scripting_highlighting("ASK_RUN  ftp://ftp.armedassault.info/ofpd/mods/ECP%20v1.085%20(Full%20Installer).exe
ASK_RUN  _extracted\\example.exe");?></code></pre>
<br><br>
If the file is in the modfolder then start the path with <code>&lt;mod&gt;</code>.
<pre><code><?php echo GS_scripting_highlighting("ASK_RUN  &lt;mod&gt;\\Install_win2k_XP.bat");?></code></pre>
<br><br>
<p>Use this command without any arguments to run the last downloaded file.</p>




<a name="exit"></a><hr class="betweencommands">
<h3 class="commandtitle">Exit, Quit</h3>
<pre><code>EXIT</code></pre>
<p>Causes the installer to skip all other commands in the current script.</p>


		</div>
	</div><!-- /panel -->



	<a name="missions"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Mission Files</strong></div>	
		<div class="panel-body">
			<p>Original game only makes use of the <code>modfolder\Campaigns</code> but with Fwatch 1.16 you can now conveniently store any kind of mission in the modfolder.</p>
			<p>When you launch the game with a mod it will move content from the mod sub-folders to the folders in the game directory.</p>
			<br>
			<table class="table table-hover table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">Source</th>
						<th scope="col">Destination</th>
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
			<p>By default PBO files and folders will be moved. In case of cutscenes and user missions only folders will be moved.</p>
			<p>Changes are reverted when you quit the game.</p>
		</div>
	</div><!-- /panel -->	
	
	

	<a name="installation_examples"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Example Installation Scripts</strong></div>
		<div class="panel-body">
			<p>This is a script for installing WW4 2.5 mod</p>

<pre><code><?php
echo GS_scripting_highlighting("; Download archive from one of these three sources and then extract it to a temporary location
UNPACK {
	ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar
	https://www.moddb.com/downloads/start/36064  /downloads/mirror/  ww4mod25rel.rar
	https://ofp.today/download/unofaddons2/ww4mod25rel.7z
}

; Move all the unpacked content (including folders) to the modfolder in the game directory (will be created if it doesn't exist)
MOVE    *  /match_dir

; Download and extract
UNPACK {
	ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar
	https://ofp.today/download/unofaddons2/ww4mod25patch1.7z
}

; Move text files (from the directory with extracted files) to the modfolder root
MOVE    *.txt

; Move addons (from the directory with extracted files) to the modfolder\\addons
MOVE    *.pbo  addons

; Move all remaining extracted files and folders to the modfolder\\Bonus
MOVE    *  Bonus  /match_dir

; Replace modfolder\\bin\\resource.cpp (file that defines user interface) for widescreen compatibility
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\WW4mod25\\Resource.cpp  bin

; Replace modfolder\\dta\\anims.pbo (island cutscenes) so that a message will show up in the main menu when Fwatch is enabled
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\WW4mod25\\Anims.pbo  dta");
?></code></pre>

<hr class="betweencommands">

<p>This is a script for installing Finnish Defence Forces 1.4 mod</p>

<pre><code><?php
echo GS_scripting_highlighting('; Download base version of the mod from one of these five sources and then run automatic installation
{
	http://files.ofpisnotdead.com/files/ofpd/mods/fdfmod13_installer.exe
	http://fdfmod.dreamhosters.com/ofp/fdfmod13_installer.exe
	ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe
	https://www.gamefront.com/games/operation-flashpoint-resistance/file/finnish-defence-forces finnish-defence-forces/download expires= fdfmod13_installer.exe
	http://pulverizer.pp.fi/ewe/mods/fdfmod13_installer.exe
}


; Download update from one of these six sources and then run automatic installation
{
	http://files.ofpisnotdead.com/files/ofpd/mods/fdfmod14_ww2.rar
	http://fdfmod.dreamhosters.com/ofp/fdfmod14_ww2.rar
	ftp://ftp.armedassault.info/ofpd/mods/fdfmod14_ww2.rar
	https://www.gamefront.com/games/operation-flashpoint/file/fdf-mod fdf-mod/download expires= fdfmod14_ww2.rar
	https://ofp.today/download/mods/fdfmod14_ww2.7z
	http://pulverizer.pp.fi/ewe/mods/fdfmod14_ww2.rar
}


; Download and extract desert pack
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/mods/FDF_desert_pack.rar
	http://fdfmod.dreamhosters.com/ofp/FDF_desert_pack.rar
	ftp://ftp.armedassault.info/ofpd/mods/FDF_desert_pack.rar
	https://ofp.today/download/mods/FDF_desert_pack.7z
}

; Move extracted readme file to the modfolder\\readme_addons
MOVE  "FDF Mod - Al Maldajah - Readme.txt" readme_addons

; Move all remaining extracted files and folders to the modfolder
MOVE  * /match_dir


; Download and extract Winter Maldevic island
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands2/fdf_winter_maldevic.rar
	http://fdfmod.dreamhosters.com/ofp/fdf_winter_maldevic.rar
	ftp://ftp.armedassault.info/ofpd/islands2/fdf_winter_maldevic.rar
	https://ofp.today/file/islands2/fdf_winter_maldevic.7z
}

; Move extracted readme file to the modfolder\\readme_addons
MOVE  "FDF Mod - Winter Maldevic - Readme.txt" readme_addons

; Move all remaining extracted files and folders to the modfolder
MOVE  * /match_dir


; Download and extract Suursaari island
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands/Suursaari_release_v10.zip
	http://fdfmod.dreamhosters.com/ofp/Suursaari_release_v10.zip
	ftp://ftp.armedassault.info/ofpd/islands/Suursaari_release_v10.zip
	https://ofp.today/download/islands/Suursaari_release_v10.7z
}

; Move extracted addon the modfolder\\addons
MOVE    FDF_Suursaari.pbo  addons

; Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes
MOVE    Suursaari_anim  IslandCutscenes

; Move all remaining extracted files to the modfolder\\readme_addons
MOVE    *  readme_addons


; Download and extract Winter Kolgujev island
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/islands/WinterNogojev11.zip
	https://fdfmod.dreamhosters.com/ofp/WinterNogojev11.zip
	ftp://ftp.armedassault.info/ofpd/islands/WinterNogojev11.zip
	https://www.gamefront.com/games/operation-flashpoint-resistance/file/winternogojev11-zip winternogojev11-zip/download expires= winternogojev11.zip
	https://ds-servers.com/gf/operation-flashpoint-resistance/modifications/islands/winternogojev11-zip.html files/gf/ store.node winternogojev11.zip
	https://www.lonebullet.com/mods/download-winternogojev11-operation-flashpoint-resistance-mod-free-42045.htm /file/ files.lonebullet.com winternogojev11.zip
}

; Move all extracted addons the modfolder\\addons
MOVE    *.pbo  addons

; Move extracted readme file to the modfolder\\readme_addons
MOVE    "Readme-Winter Nogojev.txt"  readme_addons

; Move extracted folder with island cutscenes to the modfolder\\IslandCutscenes
MOVE    KEGnoecainS_anim  IslandCutscenes


; Download and extract MT-LB addon
UNPACK {
	http://fdfmod.dreamhosters.com/ofp/mt-lb22.zip
	http://ofp-faguss.com/addon/finmod/mt-lb22.7z
	http://faguss.paradoxstudio.uk/addon/finmod/mt-lb22.7z
}

; Move all extracted addons the modfolder\\addons
MOVE    *.pbo  addons

; Move extracted readme file to the modfolder\\readme_addons and rename it to mt-lb22_release_info.txt
MOVE    release_info.txt  readme_addons  mt-lb22_release_info.txt


; Download and extract Russians Weapons Pack
UNPACK {
	http://files.ofpisnotdead.com/files/ofpd/unofaddons/RussianWeaponsPack11.zip
	http://fdfmod.dreamhosters.com/ofp/RussianWeaponsPack11.zip 
	ftp://ftp.armedassault.info/ofpd/unofaddons/RussianWeaponsPack11.zip
	https://ofp.today/download/unofaddons/RussianWeaponsPack11.7z
}

; Move all extracted addons the modfolder\\addons
MOVE    *.pbo  addons

; Move extracted readme file to the modfolder\\readme_addons and rename it to RussianWeaponsPack11_readme.txt
MOVE    readme.txt  readme_addons  RussianWeaponsPack11_readme.txt


; Automatically install fixed version of Smith & Wesson Revolvers Addon
{
	http://ofp-faguss.com/addon/finmod/SWRevolvers10_fixed.7z
	http://faguss.paradoxstudio.uk/addon/finmod/SWRevolvers10_fixed.7z
	https://docs.google.com/uc?export=download&id=1wAoTEeAuEvveYe2EZnVu_Gic7Nib-7qO SWRevolvers10_fixed.7z
}


; Replace resource.cpp for widescreen compatibility
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\FDF\\Resource.cpp  bin

; Replace island cutscenes so that a message will show up when Fwatch is enabled
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\FDF\\Anims.pbo  dta


; Create a UI config for Fwatch - it will enlarge action menu and chat and make them blue
EDIT    bin\config_fwatch_hud.cfg  0  ACTION_ROWS=43;CHAT_ROWS=12;CHAT_Y=0.56;GROUPDIR_Y=0.5;ACTION_COLORTEXT=[1,1,1,1];ACTION_COLORSEL=[0.133333,0.643137,1,1];CHAT_COLORTEAM=[0.133333,0.643137,1,1];  /newfile');
?></code></pre>

<hr class="betweencommands">

<p>This is a script for installing WarGames League 5.12 mod</p>

<pre><code><?php
echo GS_scripting_highlighting("
; Installer will automatically download file from one of these three sources, extract it and then move files to the game directory
{
	ftp://ftp.armedassault.info/ofpd/unofaddons2/WGL5.1_Setup.exe
	https://www.moddb.com/downloads/start/93621  /downloads/mirror/  WGL5.1_Setup.exe
	https://ofp.today/Addons?dir=mods  file=WGL5.1_Setup.exe  WGL5.1_Setup.exe
}

; Same with mod patch
{
	http://pulverizer.pp.fi/ewe/mods/wgl512_2006-11-12.rar
	https://www.moddb.com/downloads/start/93801  /downloads/mirror/  wgl512_2006-11-12.rar
	http://www.mediafire.com/file/4rm6uf16ihe36ce  ://download  wgl512_2006-11-12.rar
}

; If user has 1.96 version of the game or older
IF_VERSION  <=  1.96
	; Extract Res\\Dta\\HWTL\\data.pbo (contains game textures) to the modfolder\\dta\\hwtl
	UNPBO  &lt;game&gt;\\Res\\Dta\\HWTL\\data.pbo  dta\\HWTL
	
	; Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data
	COPY   &lt;mod&gt;\\newdata\\*.pa?           dta\\HWTL\\Data
	
	; Generate pbo file out of the recently extracted addon (data.pbo) and remove the source
	MAKEPBO
	
	; Extract Res\\Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta\\hwtl
	UNPBO  &lt;game&gt;\\Res\\Dta\\HWTL\\data3d.pbo  dta\\HTWL
	
	; Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\hwtl\\data3d
	COPY   &lt;mod&gt;\\newdata\\*.p3d             dta\\HWTL\\data3d
	
	; Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source
	MAKEPBO
	
; For game versions newer than 1.96
ELSE
	; Extract Dta\\data.pbo (contains game textures) to the modfolder\\dta
	UNPBO  &lt;game&gt;\\DTA\\Data.pbo  dta
	
	; Copy all paa and pac files from the modfolder\\newdata to the modfolder\\dta\\data
	COPY   &lt;mod&gt;\\newdata\\*.pa?  dta\\Data
	
	; Generate pbo file out of the recently extracted addon (data.pbo) and remove the source
	MAKEPBO
	
	; Extract Dta\\HWTL\\data3d.pbo (contains game models) to the modfolder\\dta
	UNPBO  &lt;game&gt;\\DTA\\Data3D.pbo  dta
	
	; Copy all p3d files from the modfolder\\newdata to the modfolder\\dta\\data3d
	COPY   &lt;mod&gt;\\newdata\\*.p3d    dta\\Data3D
	
	; Generate pbo file out of the recently extracted addon (data3d.pbo) and remove the source
	MAKEPBO
	
; Close section of commands that depend on the game version
ENDIF

; Replace resource.cpp for widescreen compatibility
UNPACK {
	http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio207.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/ofp_aspect_ratio207.7z
}
MOVE    Files\\WGL\\Resource.cpp  bin

; Replace island cutscenes so that a message will show up when Fwatch is enabled
UNPACK {
	http://ofp-faguss.com/fwatch/download/anims_fwatch.7z 
	http://faguss.paradoxstudio.uk/fwatch/download/anims_fwatch.7z
}
MOVE    Files\\WGL\\Anims.pbo  dta");
?></code></pre>

		</div>
	</div><!-- /panel -->
	

	<a name="testing"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>How To Test Scripts</strong></div>
		<div class="panel-body">
<ul>
<li>Write your installation script in the <span class="courier">fwatch\data\addonInstaller_test.txt</span></li>
<li>Run <span class="courier">addonInstaller.exe</span> with parameters <code>-testmod=&lt;mod name&gt;</code> and optionally <code>-testdir=&lt;folder name&gt;</code></span></li>
</ul>

<p>Example: <code>-testmod=@ww4mod25 -testdir=@test</code>. Folder <span class="courier">@test</span> will be treated as if it's <span class="courier">@ww4mod25</span>.</p>
<p>See <span class="courier">fwatch\data\addonInstallerLog.txt</span> for feedback on the installation process.</p>
<p>Add parameter <code>-gameversion=&lt;number&gt;</code> for testing conditions.</p>
<br>
<p>In testing mode downloaded files won't be removed so you won't have to redownload them every time you run the installator.</p>
<br>
<p>Installer will generate <span class="courier">fwatch\tmp\__downloadtoken</span> file which you can use to find intermediate download links:</p>
<ul>
<li>Open it in your web browser</li>
<li>Find <i>Download</i> button, right-click on it and select <i>Inspect</i></li>
<li>Property <i>href</i> contains the link you're looking for. Pick a small part of it that is constant</li>
<li>Do a search to make sure that the selected part does not occur anywhere else in the file</li>
<li>If it doesn't then you can add it to your installation script</li>
</ul>


		</div>
	</div><!-- /panel -->		

	<a name="changelog"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Version History</strong></div>
		<div class="panel-body">
<a name="changelog0.6"></a>
<br>
<br>

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
	</div><!-- /panel -->	
	
	
	
	


	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
