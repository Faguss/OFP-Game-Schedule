<?php
require_once "header.php";

// Code for modal for converting download links; displayed when installation script input is displayed
$js_modal = "
<div id=\"convertlink_modal\" class=\"schedule_modal\">
	<div class=\"schedule_modal-content\">
		<span id=\"convertlink_modal_close\" class=\"schedule_modal_close\">&times;</span>
	
		<p>".lang("GS_STR_MOD_CONVERTLINK_DESC")."</p>
		<ul>
			<li><b>Google Drive</b> - <span style=\"font-size:x-small;\">https://drive.google.com/file/d/1_53Xmwek8ffHlHElhKb8vNaQEkJ0PWFj/view?usp=sharing</span></li>
			<li><b>ModDB</b> - <span style=\"font-size:x-small;\">https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25</span></li>
			<li><b>Mediafire</b> - <span style=\"font-size:x-small;\">http://www.mediafire.com/file/4rm6uf16ihe36ce/wgl512_2006-11-12.rar/file</span></li>
			<li><b>DSServers</b> - <span style=\"font-size:x-small;\">https://ds-servers.com/gf/operation-flashpoint/modifications/miscellaneous/fdf-mod-v1-4.html</span></li>
			<li><b>OFPEC</b> - <span style=\"font-size:x-small;\">https://www.ofpec.com/addons_depot/index.php?action=details&id=69</span></li>
			<li><b>SendSpace</b> - <span style=\"font-size:x-small;\">https://www.sendspace.com/file/8r9g4z</span></li>
			<li><b>LoneBullet</b> - <span style=\"font-size:x-small;\">https://www.lonebullet.com/mods/download-ecp-1085e-tgs-operation-flashpoint-resistance-mod-free-52029.htm</span></li>
			<li><b>DropBox</b> - <span style=\"font-size:x-small;\">https://www.dropbox.com/s/aswdz81mxhc909b/Bw85%20pack%201.3.rar?dl=0</span></li>
		</ul>
		<br>
		
		<div id=\"convertlink_modal_group_link\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_link\">URL</label>
			<div class=\"col-lg-10\">
				<input class=\"form-control\" id=\"convertlink_modal_link\" type=\"text\" size=\"50\">
			</div>
		</div>
		
		<div id=\"convertlink_modal_group_filename\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_filename\">".lang("GS_STR_MOD_CONVERTLINK_FILENAME")."</label>
			<div class=\"col-lg-10\">
				<input placeholder=\"example.7z\" class=\"form-control\" id=\"convertlink_modal_filename\" type=\"text\" size=\"50\">
			</div>
		</div>
	
		<div id=\"convertlink_modal_group_size\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_size\">".lang("GS_STR_MOD_CONVERTLINK_BIGFILE")."</label>
			<div class=\"col-lg-10\">
				<div>
					<div class=\"checkbox\">
						<label>
							<input type=\"checkbox\" id=\"convertlink_modal_size\">
						</label>
					</div>
				</div>
				<span class=\"help-block\">".lang("GS_STR_MOD_CONVERTLINK_BIGFILE_DESC", ["<a id=\"convertlink_modal_testlink\" target=\"_blank\" href=\"\">", "</a>"])."</span>
			</div>
		</div>
		
		<div id=\"convertlink_modal_group_accept\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\"></label>
			<div class=\"col-lg-10\">
				<button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"convertlink_modal_accept\">".lang("GS_STR_MOD_CONVERTLINK_INSERT")."</button><br>
			</div>
		</div>

	</div>
</div>

<script type=\"text/javascript\">
	document.getElementById('convertlink_field').innerHTML = '<a style=\"cursor:pointer; font-weight:bold; font-size:medium;\">".lang("GS_STR_MOD_CONVERTLINK")."</a>';
	GS_activate_convertlink_modal();
</script>";

$js_verify_installation_script = "
<script>
	var typingTimer;
	var scripttext;
	var link_warning_string = '".lang("GS_STR_MOD_WARNING_LINK")."';
	
	$( document ).ready(function() {
		scripttext = $('#scripttext');
		$('#warning_field').addClass('text-danger');

		scripttext.on('keyup', function () {
			clearTimeout(typingTimer);
			typingTimer = setTimeout(GS_verify_installation_script, 1000);
		});

		scripttext.on('keydown', function () {
			clearTimeout(typingTimer);
		});
	});
</script>
";

$install_hint    = lang("GS_STR_MOD_INSTALLATION_HINT",["<a target=\"_blank\" href=\"install_scripts\">","</a>","<a target=\"_blank\" href=\"install_scripts#testing\">","</a>"]);
$install_example = "ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar";

// Installation scripts faq
$faq = [
["GS_STR_MOD_FAQ_HOWTOWRITE", [
	["GS_STR_MOD_FAQ_PAR1"],
	["GS_STR_MOD_FAQ_CONVERT_Q1", [
		["GS_STR_MOD_FAQ_CONVERT_A1"]
	]],
	["GS_STR_MOD_FAQ_CONVERT_Q2", [
		["GS_STR_MOD_FAQ_CONVERT_A2"]
	]],
	["GS_STR_MOD_FAQ_LINKS_Q", [
		["GS_STR_MOD_FAQ_LINKS_A1"],
		["GS_STR_MOD_FAQ_LINKS_A2", "install_scripts#links"]
	]],
	["GS_STR_MOD_FAQ_AUTO_Q", [
		["GS_STR_MOD_FAQ_AUTO_A"],
		["GS_STR_MOD_FAQ_AUTO_A2", "install_scripts#auto_installation"]
	]],
	["GS_STR_MOD_FAQ_MANUAL_Q", [
		["GS_STR_MOD_FAQ_MANUAL_A"],
		["Unpack", [
			["GS_STR_MOD_FAQ_UNPACK_A1"],
			["GS_STR_MOD_FAQ_UNPACK_A2","install_scripts#unpack"],
		]],
		["Move", [
			["GS_STR_MOD_FAQ_MOVE_A1"],
			["GS_STR_MOD_FAQ_MOVE_A2", "install_scripts#move"],
		]],
		["GS_STR_MOD_FAQ_MANUAL_Q2", [
			["GS_STR_MOD_FAQ_MANUAL_A2"],
			["GS_STR_MOD_FAQ_MANUAL_A3", "install_scripts#manual_installation"]
		]],
		["GS_STR_MOD_FAQ_MISSION_Q", [
			["GS_STR_MOD_FAQ_MISSION_A1"],
			["GS_STR_MOD_FAQ_MISSION_A2", "install_scripts#missions"]
		]],
		["GS_STR_MOD_FAQ_DTA_Q", [
			["GS_STR_MOD_FAQ_DTA_A1"],
			["GS_STR_MOD_FAQ_DTA_A2", "install_scripts#installation_examples_wgl"]
		]],
	]],
	["GS_STR_MOD_FAQ_TEST_Q", "install_scripts#testing"]
]]
];

$dta_code_template = "
IF_VERSION  <=  1.96
	UNPBO <game>\Res\Dta\HWTL\data.pbo  dta\HWTL
	MOVE new_textures\*.pa?  dta\HWTL\Data
	MAKEPBO
	
	UNPBO <game>\Res\Dta\HWTL\data3d.pbo  dta\HWTL
	MOVE new_models\*.p3d  dta\HWTL\data3d
	MAKEPBO
ELSE
	UNPBO <game>\DTA\Data.pbo  dta
	MOVE new_textures\*.pa?  dta\Data
	MAKEPBO
	
	UNPBO <game>\DTA\Data3D.pbo  dta
	MOVE new_models\*.p3d  dta\Data3D
	MAKEPBO
ENDIF";

$install_hint = GS_format_collapse($faq);



// If user wants to add new mod or edit existing
if (in_array($form->hidden["display_form"], ["Add New","Edit"]))
{
	// Set up form
	$form->size       = 9;
	$form->label_size = 2;
	$form->input_size = 10;
	
	if ($form->hidden["display_form"] == "Edit")
		$form->title=lang("GS_STR_MOD_PAGE_TITLE", ["<strong>$record_title</strong>"]);
	else
		$form->title=lang("GS_STR_INDEX_ADDNEW_MOD");
	
	$mod_type_select = [];
	for($i=0; $i<=GS_MOD_TYPE_NUM; $i++)
		$mod_type_select[] = [lang("GS_STR_MOD_TYPE{$i}")." - ".lang("GS_STR_MOD_TYPE{$i}_DESC"),"{$i}"];
	
	$description_hint =  lang("GS_STR_MOD_DESCRIPTION_HINT"). ". <a target=\"_blank\" href=\"https://www.markdownguide.org/cheat-sheet/\">Markdown</a>";
	
	$form->add_text("name", lang("GS_STR_MOD_FOLDER"), lang("GS_STR_MOD_FOLDER_HINT"), "@ww4mod25");
	
	if ($form->hidden["display_form"] == "Edit")
		$form->add_text("subtitle", lang("GS_STR_MOD_SUBTITLE"), lang("GS_STR_MOD_SUBTITLE_HINT"), "Sanctuary");
	
	$form->add_text("description"  , lang("GS_STR_MOD_DESCRIPTION"), $description_hint, lang("GS_STR_MOD_DESCRIPTION_EXAMPLE"));
	$form->add_text("website"      , lang("GS_STR_SERVER_WEBSITE") , ""               , GS_get_current_url(true, false));
	$form->add_select("type"       , lang("GS_STR_MOD_TYPE")       , ""               , $mod_type_select, "0");
	$form->add_select("req_version", lang("GS_STR_MOD_REQ_VERSION"), ""               , GS_GAME_VERSIONS, "1.96");
	
	if ($form->hidden["display_form"] == "Edit")
		$form->add_text("alias", lang("GS_STR_MOD_ALIAS"), lang("GS_STR_MOD_ALIAS_DESC",["<a target=\"_blank\" href=\"install_scripts#alias\">","</a>"]), "@ww4mod21 @ww4mod");
	
	$form->add_text("access"     , lang("GS_STR_MOD_ACCESS")   , lang("GS_STR_MOD_ACCESS_HINT"));
	$form->add_select("forcename", lang("GS_STR_MOD_FORCENAME"), lang("GS_STR_MOD_FORCENAME_HINT"), [[lang("GS_STR_DISABLED"),"0"], [lang("GS_STR_ENABLED"),"1"]], "0", "radio");
	
	if ($form->hidden["display_form"] == "Add New") {
		$form->add_text("version", lang("GS_STR_MOD_VERSION"), lang("GS_STR_MOD_VERSION_HINT"), "1", "1");	
		$form->add_text("scripttext" , lang("GS_STR_MOD_INSTALLATION_SCRIPT"), $install_hint, $install_example, "", -1);
		$form->add_emptyspan("warning_field");
		$form->add_emptyspan("convertlink_field", "id=\"convertlink_field_group\"");
		$form->add_text("size"      , lang("GS_STR_MOD_DOWNLOADSIZE"), "", "128");
		$form->add_select("sizetype", ""                             , "", GS_SIZE_TYPES, "MB");
	}
	
	$form->add_select("is_mp"  , lang("GS_STR_MOD_MPCOMP") , lang("GS_STR_MOD_MPCOMP_HINT") , [[lang("GS_STR_MOD_MPCOMP_YES"),"1"], [lang("GS_STR_MOD_MPCOMP_NO"),"0"]], "1", "radio");
	$form->add_imagefile("logo", lang("GS_STR_SERVER_LOGO"), lang("GS_STR_SERVER_LOGO_HINT"), GS_LOGO_FOLDER, 10240*2.5);
	
	if ($form->hidden["display_form"] == "Add New") {
		$form->include_file("usersc/js/gs_functions.js");
		$form->add_html($js_modal);
		$form->add_html($js_verify_installation_script);
	}

	$form->change_control(["size","sizetype"], ["Inline"=>3]);

	
	// If user wants to update mod entry
	if (in_array($form->hidden["action"], ["Edit","Add New"])) {
		$data = &$form->save_input();
		$data["name"]    = preg_replace('/\s+/', '', $data["name"]);				// remove whitespace
		$data["access"]  = preg_replace("/[^A-Za-z0-9 ]/", '', $data["access"]);	// remove non-alphanumeric
		$data["website"] = filter_var($data["website"], FILTER_SANITIZE_URL);
		
		// Validate file name
		$custom_errors = [];
		if (!GS_is_valid_windows_filename($data["name"]))
			$custom_errors[] = [lang("GS_STR_MOD_NAME_ERROR"), "name"];
		
		// Validate website
		if (!empty($data["website"])  &&  !filter_var($data["website"], FILTER_VALIDATE_URL))
			$custom_errors[] = [lang("GS_STR_SERVER_URL_ERROR"), "website"];
		
		// Validate user input
		$unique_array = ["gs_mods", ["and",["description","LIKE",$data["description"]],["removed","!=",1]]];
		$exclude      = $form->hidden["action"]=="Edit" ? ["scripttext", "size", "sizetype"] : [];
		
		if ($form->hidden["action"] == "Edit")
			$unique_array[1][] = ["id","!=",$id];
		
		$form->init_validation     (["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], $exclude);
		$form->add_validation_rules(["description"], ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "unique"=>$unique_array]);
		$form->add_validation_rules(["version"]    , [">"=>0]);
		$form->add_validation_rules(["scripttext"] , ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "display"=>lang("GS_STR_MOD_INSTALLATION_SCRIPT")]);
		$form->add_validation_rules(["size"]       , [">"=>0]);
		$form->add_validation_rules(["sizetype"]   , ["in"=>GS_SIZE_TYPES, "display"=>lang("GS_STR_MOD_DOWNLOADSIZE")]);
		$form->add_validation_rules(["alias"]      , ["max"=>GS_MAX_MSG_INPUT_LENGTH, "required"=>false]);
		$form->add_validation_rules(["access"]     , ["max"=>GS_MAX_CODE_INPUT_LENGTH, "required"=>false]);
		$form->add_validation_rules(["website"]    , ["required"=>false]);
		$form->add_validation_rules(["subtitle"]   , ["max"=>10, "required"=>false]);


		// Send data to table
		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA"))) {
			$form->upload_image();
			
			// Set up four arrays for inserting to four db tables
			$mod_fields = [
				"name"        => $data["name"],
				"description" => $data["description"],
				"access"      => $data["access"],
				"forcename"   => $data["forcename"],
				"type"        => $data["type"],
				"is_mp"       => $data["is_mp"],
				"website"     => $data["website"],
				"logo"        => $data["logo"]
			];
			
			if (isset($data["subtitle"]))
				$mod_fields["subtitle"] = $data["subtitle"];
			
			$admin_fields = [
				"modid"       => -1,
				"userid"      => $uid,
				"isowner"     => 1
			];
			
			$script_fields = [
				"size"        => "{$data["size"]} {$data["sizetype"]}",
				"script"      => html_entity_decode($data["scripttext"])
			];
			
			$update_fields = [
				"modid"       => -1,
				"scriptid"    => -1,
				"version"     => $data["version"]
			];			
			
			$mod_fields["modified"]   = date("Y-m-d H:i:s");
			$mod_fields["modifiedby"] = $uid;
			
			if ($form->hidden["action"] == "Add New") {
				$mod_fields["uniqueid"]     = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$mod_fields["createdby"]    = $uid;
				$script_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$script_fields["createdby"] = $uid;
				$update_fields["createdby"] = $uid;
			} else {
				$mod_fields["alias"] = $data["alias"];
			}
					
			$mod_fields["id"] = $id;
			$result           = $db->insert("gs_mods", $mod_fields, true);

			$form->keep_image($result);
			$form->feedback(
				$result, 
				lang($form->hidden["action"]=="Add New" ? "GS_STR_MOD_ADDED"       : "GS_STR_MOD_UPDATED"),
				lang($form->hidden["action"]=="Add New" ? "GS_STR_MOD_ADDED_ERROR" : "GS_STR_MOD_UPDATED_ERROR")
			);
			
			if ($result) {
				if ($form->hidden["action"] == "Add New") {
					$id                           = $db->lastId();
					$form->hidden["uniqueid"]     = $mod_fields["uniqueid"];
					$form->hidden["display_form"] = "Edit";
					$admin_fields["modid"]        = $id;
					$update_fields["modid"]       = $id;

					$db->insert("gs_mods_admins" , $admin_fields);
					$db->insert("gs_mods_scripts", $script_fields);

					if (!$db->error()) {
						$update_fields["scriptid"] = $db->lastId();
						$db->insert("gs_mods_updates", $update_fields);
					} else
						echo $db->errorString();
				}
				
				$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>($form->hidden["action"]=="Add New" ? GS_LOG_MOD_ADDED : GS_LOG_MOD_UPDATED), "added"=>date("Y-m-d H:i:s")]);
				file_put_contents("mods_timestamp.txt", time());
				
				$form->hidden["display_name"] = $data["name"];
				$form->title                  = lang("GS_STR_MOD_PAGE_TITLE", ["<strong>$record_title</strong>"]);
				
				// Update logo hash
				$db->update("gs_mods", $id, ["logohash"=>empty($data["logo"]) ? "" : hash_file('crc32', $form->image_dir.$data["logo"])]);
			}
		}
	} else
		if ($form->hidden["display_form"] == "Edit")
			if (!$form->load_record("gs_mods", $id))
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		
	if ($form->hidden["display_form"] == "Edit") {
		$fields_to_remove = ["warning_field", "convertlink_field", "scripttext", "size", "sizetype", "subtitle"];
		
		// If public duplicates of a mod exist then keep the "subtitle" input field; otherwise hide it
		if ($db->query("SELECT COUNT(name) AS duplicates FROM gs_mods WHERE name=? AND gs_mods.removed=0 AND gs_mods.access='' GROUP BY name",[$form->data["name"]]))
			if ($db->results(true)[0]["duplicates"] > 1)
				$fields_to_remove = array_diff($fields_to_remove, ["subtitle"]);
		
		$form->change_control($fields_to_remove, "remove");
	}
	
	$form->add_button("action", $form->hidden["display_form"], lang($form->hidden["display_form"]=="Edit" ? "GS_STR_SERVER_SUBMIT" : "GS_STR_INDEX_ADDNEW_MOD"), "btn-mods btn-lg");
}	










// If user wants to update the mod
if ($form->hidden["display_form"] == "Update") 
{
	$form->size       = 12;
	$form->label_size = 2;
	$form->input_size = 10;
	$form->title      = lang("GS_STR_MOD_UPDATE_PAGE_TITLE", ["<strong>$record_title</strong>"]);
	
	$form->add_text("documentation_link", "");
	$form->change_control(-1, ["Type"=>"Static", "Text"=>"<a target=\"_blank\" href=\"mod_updates\">".lang("GS_STR_MOD_UPDATES")."</a>"]);
	
	// Display buttons for navigating between sub-sections
	$html = "";
	forEach(GS_FORM_ACTIONS_MODUPDATE as $section=>$section_name) {		
		$class = "btn btn-mods " . ($form->hidden["display_subform"]==$section ? "active" : "");
		$html .= '<a class="'.$class.'" href="edit_mod.php?uniqueid='.$form->hidden["uniqueid"].'&display_form='.$form->hidden["display_form"].'&display_subform='.$section.'">'.lang($section_name).'</a> &nbsp; ';
		
		//$form->add_button("display_subform", $section, lang($section_name), $class, "", ($form->hidden["display_subform"]==$section ? "disabled=\"disabled\"" : ""));
		//$form->add_html(" &nbsp; &nbsp; ");
		//$form->change_control([-1,-2], ["Inline"=>-3]);
	}
	
	$form->add_text("subsections", "");
	$form->change_control(-1, ["Type"=>"Static", "Text"=>$html]);
	$form->add_space(1);
	
	// Display controls for the current section	
	if ($form->hidden["display_subform"] == "Link") {
		$form->add_select("Link"   , lang("GS_STR_MOD_LINK")     , "", []);
		$form->add_select("DeleteLink", "", "", [lang("GS_STR_MOD_LINK_REMOVE")], "", "checkbox");
		$form->add_text("fromver"  , lang("GS_STR_MOD_LINK_FROM"), lang("GS_STR_MOD_LINK_FROM_HINT"), "version < 1.2");
		$form->add_select("version", lang("GS_STR_MOD_LINK_TO")  , lang("GS_STR_MOD_LINK_TO_HINT")  , []);
		$form->change_control(["DeleteLink"], ["Group"=>"ID=\"DeleteLinkGroup\""]);
	} else {
		$form->add_select("version"  , lang("GS_STR_MOD_SELECT_VER"), "", []);
		$form->add_text("version_new", lang("GS_STR_MOD_NEW_NUM")   , lang("GS_STR_MOD_NEW_NUM_HINT"), "");
		$form->change_control("version_new", ["Group"=>"id=\"version_new_group\""]);
		$form->add_text(
			"changelog", 
			lang("GS_STR_MOD_PATCHNOTES"), 
			lang("GS_STR_MOD_PATCHNOTES_HINT")." <a target=\"_blank\" href=\"https://www.markdownguide.org/cheat-sheet/\">Markdown</a>", 
			lang("GS_STR_MOD_PATCHNOTES_EXAMPLE"), 
			"", 
			-1
		);
	}
		
	// Script editing controls
	$form->add_space(1);
	$form->add_select("script", lang("GS_STR_MOD_INSTALLATION_SCRIPT"), "", []);
	$form->add_text("scripttext", "", $install_hint, $install_example, "", -1);
	$form->add_emptyspan("warning_field");
	$form->add_emptyspan("convertlink_field", "id=\"convertlink_field_group\"");
	$form->add_text("size", lang("GS_STR_MOD_DOWNLOADSIZE"), "", "128");
	$form->add_select("sizetype", "", "", GS_SIZE_TYPES, "MB");
	$form->change_control(["size", "sizetype"], ["Inline"=>3]);
	$form->add_html($js_modal);
	$form->add_html($js_verify_installation_script);
		
	// Preview button
	$form->add_space(1);
	$html = "
		<button type=\"button\" class=\"btn btn-mods\" onclick=\"GS_preview_installation('{$form->hidden["display_subform"]}')\">".lang("GS_STR_MOD_PREVIEW_INST")."</button> 
		&nbsp; &nbsp " . 
		lang("GS_STR_MOD_LINK_FROM") . ": <select id='preview_installation_from_version'></select>
		&nbsp; &nbsp " . 
		lang("GS_STR_MOD_DOWNLOADSIZE") . ": <strong id='preview_installation_size'></strong>
	";
	$form->add_text("previewinstallation", "");
	$form->change_control(-1, ["Type"=>"Static", "Text"=>$html, "Inline"=>9]);
		
	// Submit button
	$form->add_button("action", $form->hidden["display_subform"], lang(GS_FORM_ACTIONS_MODUPDATE[$form->hidden["display_subform"]]."_SUBMIT"), "btn-mods btn-lg", "SubmitButton", "style=\"float:right;\"");
	$form->change_control(-1, ["CloseInline"=>true, "Inline"=>3]);

	// If user wants to update database
	if (array_search($form->hidden["action"], array_keys(GS_FORM_ACTIONS_MODUPDATE)) !== FALSE && !is_array(Input::get("DeleteLink"))) {
		$data              = &$form->save_input();
		$undefined_indexes = ["fromver", "script", "version_new", "version", "scripttext", "Link", "changelog"];
		
		foreach ($undefined_indexes as $index)
			if (!isset($data[$index]))
				$data[$index] = "";
			
		$is_ok         = false;
		$updateid      = NULL;
		$custom_errors = [];
	
		// Get the highest version number for this mod
		$highest = $db->cell("gs_mods_updates.MAX(version)",["modid","=",$id]);
		if (isset($highest))
			$highest = floatval(sprintf("%01.3f", $highest));
		else {
			$form->alert(lang("GS_STR_MOD_RECENTVER_ERROR"));
			$is_ok = false;
		}
		
		// Get the lowest version number for this mod
		$lowest = $db->cell("gs_mods_updates.MIN(version)",["modid","=",$id]);
		if (isset($lowest))
			$lowest = floatval(sprintf("%01.3f", $lowest));
		else {
			$form->alert(lang("GS_STR_MOD_RECENTVER_ERROR"));
			$is_ok = false;
		}
		
		// Validate jump rule
		$result = GS_parse_jump_rule($data["fromver"], 0, $data["version"]=="-1" ? $highest : $data["version"]);
		if (is_string($result))
			$custom_errors[] = [lang("GS_STR_MOD_CONDITION_ERROR").": $result", "fromver"];
		else
			$is_ok = true;
		
		// Version number - three digits after dot and no trailing zeros
		if (is_numeric($data["version_new"])) {
			$data["version_new"] = floatval(sprintf("%01.3f", $data["version_new"]));
			$data["version_new"] = strval($data["version_new"]);
		}
		
		// Find update id by version number
		if ($form->hidden["display_subform"] == "Link") {
			$updateid = $db->cell("gs_mods_updates.id",["and",["modid","=",$id],["version","LIKE",$data["version"]=="-1" ? $highest : $data["version"]]]);

			if (!isset($updateid)) {
				$form->alert(lang("GS_STR_MOD_LINKVER_ERROR"));
				$is_ok = false;
			}
		}
		
		// If download size is zero
		if (empty($data["size"])) {
			$data["size"]     = 1;
			$data["sizetype"] = "KB";
		}

		// Set up validation	
		// If the user is copying script from the other record - ignore script text in validation
		$exclude = ["documentation_link", "subsections", "DeleteLink", "previewinstallation"];
		if ($data["script"]!=-1 && $data["version"]==-1)
			$exclude = array_merge($exclude, ["scripttext", "size", "sizetype"]);
		
		$form->init_validation(["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], $exclude);
		
		$form->add_validation_rules(["scripttext"], ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "display"=>lang("GS_STR_MOD_INSTALLATION_SCRIPT")]);
		$form->add_validation_rules(["changelog"] , ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "required"=>$form->hidden["display_subform"]!="Link" && $data["version"]!=$lowest]);
		$form->add_validation_rules(["size"]      , [">="=>0, "required"=>false]);
		$form->add_validation_rules(["sizetype"]  , ["in"=>GS_SIZE_TYPES, "display"=>lang("GS_STR_MOD_DOWNLOADSIZE")]);

		if ($form->hidden["display_subform"] == "Link") {
			$form->add_validation_rules(["fromver"]   , ["max"=>GS_MAX_MSG_INPUT_LENGTH]);
			$form->add_validation_rules(["scripttext"], ["required"=>false]);
		} else
			// If adding a new version then verify its number
			if ($data["version"] == -1)
				$form->add_validation_rules(["version_new"], [">"=>$highest, "unique"=>["gs_mods_updates",["and", ["modid","=",$id], ["version","LIKE",$data["version_new"]]]]]);

		if ($form->validate($custom_errors,lang("GS_STR_ERROR_FORMDATA"))  &&  $is_ok) {
			// Set up three arrays for inserting data to three different db tables
			$update_fields = [
				"modid"      => $id,
				"scriptid"   => $data["script"],
				"version"    => $data["version"]==-1 ? $data["version_new"] : $data["version"],
				"changelog"  => $data["changelog"],
				"modified"   => date("Y-m-d H:i:s"),
				"modifiedby" => $uid
			];

			$script_fields = [
				"size"       => "{$data["size"]} {$data["sizetype"]}",
				"script"     => html_entity_decode($data["scripttext"]),
				"modified"   => date("Y-m-d H:i:s"),
				"modifiedby" => $uid
			];

			$link_fields = [
				"updateid"     => $updateid,
				"scriptid"     => $data["script"],
				"fromver"      => html_entity_decode($data["fromver"]),
				"alwaysnewest" => $data["version"] == "-1",
				"modified"     => date("Y-m-d H:i:s"),
				"modifiedby"   => $uid
			];

			// Add a new installation script
			if ($data["script"] == -1) {
				$script_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$script_fields["createdby"] = $uid;
				$data["script"]             = $script_fields["uniqueid"];
				
				$result = $form->feedback(
					$db->insert("gs_mods_scripts", $script_fields),
					lang("GS_STR_MOD_SCRIPT_ADDED"),
					lang("GS_STR_MOD_SCRIPT_ADDED_ERROR")
				);

				if ($result) {
					$update_fields["scriptid"] = $db->lastId();
					$link_fields["scriptid"]   = $db->lastId();
					$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_SCRIPT_ADDED, "added"=>date("Y-m-d H:i:s")]);
					file_put_contents("mods_timestamp.txt", time());
				} else
					$form->alert(lang("GS_STR_MOD_SCRIPT_ADDED_ERROR"));
			} else {
				// Update script
				if ($db->get("gs_mods_scripts",["uniqueid","=",$data["script"]])) {
					$script_row                = $db->results(true)[0];
					$update_fields["scriptid"] = $script_row["id"];
					$link_fields["scriptid"]   = $script_row["id"];
					
					// if script content is empty that means form controls were disabled. In that case ignore this section
					if (!empty($data["scripttext"])  &&  ($script_row["script"] != $script_fields["script"] || $script_row["size"] != $script_fields["size"])) {
						$result = $form->feedback(
							$db->update("gs_mods_scripts", $script_row["id"], $script_fields),
							lang("GS_STR_MOD_SCRIPT_UPDATED"),
							lang("GS_STR_MOD_SCRIPT_UPDATED_ERROR")
						);

						if ($result) {
							$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$script_row["id"], "type"=>GS_LOG_MOD_SCRIPT_UPDATED, "added"=>date("Y-m-d H:i:s")]);
							file_put_contents("mods_timestamp.txt", time());
						}
					}
				} else
					$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
			}
			
			if (isset($update_fields["scriptid"])  &&  $update_fields["scriptid"]!=-1) {
				if ($form->hidden["display_subform"] != "Link") {
					// Add a new mod version
					if ($data["version"] == -1) {
						$update_fields["createdby"] = $uid;
						
						$result = $form->feedback(
							$db->insert("gs_mods_updates", $update_fields),
							lang("GS_STR_MOD_VERSION_ADDED"),
							lang("GS_STR_MOD_VERSION_ADDED_ERROR")
						);
						
						if ($result) {
							$data["version"] = $data["version_new"];
							$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_VERSION_ADDED, "added"=>date("Y-m-d H:i:s")]);
							file_put_contents("mods_timestamp.txt", time());
						}
					} else {
						// Edit existing mod version
						if ($db->get("gs_mods_updates",["and",["version","LIKE",$data["version"]],["modid","=",$id]])) {
							$update_row = $db->results(true)[0];
							
							if (($update_row["scriptid"] != $update_fields["scriptid"]) || ($update_row["changelog"] != $update_fields["changelog"])) {							
								$result = $form->feedback(
									$db->update("gs_mods_updates", $update_row["id"], $update_fields),
									lang("GS_STR_MOD_VERSION_UPDATED"),
									lang("GS_STR_MOD_VERSION_UPDATED_ERROR")
								);
								
								if ($result) {
									$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$update_row["id"], "type"=>GS_LOG_MOD_VERSION_UPDATED, "added"=>date("Y-m-d H:i:s")]);
									file_put_contents("mods_timestamp.txt", time());
								}
							}
						} else
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));							
					}
				} else {					
					// Add new version jump
					if ($data["Link"] == -1) {
						$link_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
						$link_fields["createdby"] = $uid;
						$data["Link"]             = $link_fields["uniqueid"];
						
						$result = $form->feedback(
							$db->insert("gs_mods_links", $link_fields),
							lang("GS_STR_MOD_LINK_ADDED"),
							lang("GS_STR_MOD_LINK_ADDED_ERROR")
						);
						
						if ($result) {
							$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_LINK_ADDED, "added"=>date("Y-m-d H:i:s")]);
							file_put_contents("mods_timestamp.txt", time());
						}
					} else {
						// Edit existing version jump						
						if ($db->get("gs_mods_links",["uniqueid","LIKE",$data["Link"]])) {
							$link_row = $db->results(true)[0];
							
							if (($link_row["updateid"] != $link_fields["updateid"]) || ($link_row["scriptid"] != $link_fields["scriptid"]) || ($link_row["fromver"] != $link_fields["fromver"]) || ($link_row["alwaysnewest"] != $link_fields["alwaysnewest"])) {
								$result = $form->feedback(
									$db->update("gs_mods_links", $link_row["id"], $link_fields),
									lang("GS_STR_MOD_LINK_UPDATED"),
									lang("GS_STR_MOD_LINK_UPDATED_ERROR")
								);
								
								if ($result) {
									$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$link_row["id"], "type"=>GS_LOG_MOD_LINK_UPDATED, "added"=>date("Y-m-d H:i:s")]);
									file_put_contents("mods_timestamp.txt", time());
								}
							}
						} else
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));		
					}
				}
			}
		}
	}
	
	// If user wants to delete a jump
	if (array_search($form->hidden["action"], array_keys(GS_FORM_ACTIONS_MODUPDATE)) !== FALSE && is_array(Input::get("DeleteLink"))) {
		$data = &$form->save_input();
		if ($data["Link"] != "-1") {
			$recordID = $db->cell("gs_mods_links.id",["uniqueid","LIKE",$data["Link"]]);
			
			if (isset($recordID)) {
				$result = $form->feedback(
					$db->update("gs_mods_links", $recordID, ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]),
					lang("GS_STR_MOD_LINK_DELETED"),
					lang("GS_STR_MOD_LINK_DELETED_ERROR")
				);
				
				if ($result) {
					$form->data = [];
					$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$recordID, "type"=>GS_LOG_MOD_LINK_DELETED, "added"=>date("Y-m-d H:i:s")]);
					file_put_contents("mods_timestamp.txt", time());
				}
			} else
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));				
		} else 
			$form->alert(lang("GS_STR_MOD_LINK_INVALID_ERROR"));
	}
	
	
	
	// Get all updates for this mod
	$sql = "
		SELECT 
			gs_mods_updates.*, 
			gs_mods_scripts.script, 
			gs_mods_scripts.size,
			gs_mods_scripts.uniqueid
			
		FROM 
			gs_mods_updates, 
			gs_mods_scripts 
			
		WHERE 
			gs_mods_updates.modid    = ? AND
			gs_mods_updates.scriptid = gs_mods_scripts.id
			
		ORDER BY
			gs_mods_updates.version
	";

	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$updates        = $db->query($sql,[$id])->results(true);
	$highest        = 0;
	$fromver        = 0;
	$to_version     = [];
	$rules          = [];
	$script_list    = [];
	$js_update_list = ["name"=>"Update_List"    , "data"=>[]];
	$js_script_list = ["name"=>"Script_Contents", "data"=>[]];
	$changelog      = "";
       
	foreach ($updates as $update) {
		$size = explode(' ', trim($update["size"]));

		// Make a list of all mod versions for linking
		$to_version[] = $update["version"];
		$rules[]      = isset($update["Link"]) ? $update["Link"] : "";

		$js_update_list["data"][] = [
			"version"    => $update["version"],
			"uniqueid"   => $update["uniqueid"],
			"changelog"  => $update["changelog"],
			"created"    => $update["created"]
		];

		// Make a list of existing scripts
		if (isset($script_list[$update["uniqueid"]]))
			$script_list[$update["uniqueid"]][] = "$fromver ".lang("GS_STR_MOD_TO")." {$update["version"]}";
		else {
			$script_list[$update["uniqueid"]]   = ["$fromver ".lang("GS_STR_MOD_TO")." {$update["version"]}"];
			
			$js_script_list["data"][] = [
				"uniqueid"   => $update["uniqueid"],
				"script"     => html_entity_decode($update["script"]),
				"sizenumber" => $size[0],
				"sizetype"   => $size[1]
			];
		}

		if ($update["version"] > $highest)
			$highest = $update["version"];

		$fromver   = $update["version"];
		$changelog = html_entity_decode($update["changelog"], ENT_QUOTES);
	}

	$to_version = array_reverse($to_version);   
	$to_version = array_merge([[lang($form->hidden["display_subform"]=="Link" ? "GS_STR_MOD_LINK_TO_NEWEST" : "GS_STR_MOD_ADD_NEW_VER"), "-1"]], $to_version);
	
	$form->add_js_var($js_update_list);
	
	
	// Get all version jumps for this mod
	$sql = "
		SELECT 
			gs_mods_links.*, 
			gs_mods_updates.version, 
			gs_mods_scripts.size, 
			gs_mods_scripts.script, 
			gs_mods_scripts.uniqueid as scriptUniqueID 
			
		FROM  
			gs_mods_links, 
			gs_mods_updates, 
			gs_mods_scripts 
			
		WHERE 
			gs_mods_updates.modid  = ?                  AND 
			gs_mods_links.updateid = gs_mods_updates.id AND 
			gs_mods_links.scriptid = gs_mods_scripts.id AND
			gs_mods_links.removed  = 0
			
		ORDER BY 
			gs_mods_updates.version
	";

	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
	
	$links        = $db->query($sql,[$id])->results(true);
	$links_select = [[lang("GS_STR_MOD_ADD_NEW_LINK"), "-1", "SELECTED"]];
	$js_link_list = ["name"=>"Links_List", "data"=>[]];

	foreach ($links as $link) {
		$condition        = str_replace(["&lt;","&gt;"], ["<",">"], $link["fromver"]);
		$link_description = "$condition " . lang("GS_STR_MOD_TO") . " " . ($link["alwaysnewest"] ? lang("GS_STR_MOD_NEWEST") : $link["version"]);
		$links_select[]   = [$link_description, $link["uniqueid"]];
		$size             = explode(' ', trim($link["size"]));

		$js_link_list["data"][] = [
			"uniqueid"       => $link["uniqueid"],
			"fromver"        => $link["fromver"],
			"version"        => $link["alwaysnewest"] ? "-1" : $link["version"],
			"scriptUniqueID" => $link["scriptUniqueID"]
		];
		
		$already_on_the_list = false;
		
		foreach($js_script_list["data"] as $index=>$subarray)
			if ($subarray["uniqueid"] == $link["scriptUniqueID"]) {
				$already_on_the_list = true;
				break;
			}
		
		if (!$already_on_the_list)
				$js_script_list["data"][] = [
					"uniqueid"   => $link["scriptUniqueID"],
					"script"     => html_entity_decode($link["script"]),
					"sizenumber" => $size[0],
					"sizetype"   => $size[1]
				];
			
		if (isset($script_list[$link["scriptUniqueID"]]))
			$script_list[$link["scriptUniqueID"]][] = "$condition ".lang("GS_STR_MOD_TO")." {$link["version"]}";
		else
			$script_list[$link["scriptUniqueID"]]   = ["$condition ".lang("GS_STR_MOD_TO")." {$link["version"]}"];
	}
	
	$form->add_js_var($js_link_list);


		

	// Make a new list of scripts that doesn't have duplicated id numbers
	$scripts_select = array_merge([[lang("GS_STR_MOD_ADD_NEW_SCRIPT"), "-1"]], GS_script_list_to_script_select($script_list,"",$form->hidden["display_subform"]));

	// Pick a javascript function depending on the form section
	$js_script_select  = "GS_installation_script_select('version', 'script', ['scripttext','size','sizetype'], {$js_script_list["name"]});";	
	$js_version_select = "";
	$js_jump_select    = "";
	
	if ($form->hidden["display_subform"] != "Link")
		$js_version_select = "GS_version_select('version', 'script', 'changelog', 'changelogtextinput', 'version_new_group', ['SubmitButton','".lang("GS_STR_MOD_SECTION_VERSION_SUBMIT")."','".lang("GS_STR_MOD_SECTION_VERSION_EDIT_SUBMIT")."'], {$js_update_list["name"]});";
	else
		$js_jump_select = "GS_jump_select('Link', ['SubmitButton','DeleteLinkGroup','".lang("GS_STR_MOD_SECTION_JUMP_SUBMIT")."','".lang("GS_STR_MOD_SECTION_JUMP_EDIT_SUBMIT")."'], ['fromver','version','script'], {$js_link_list["name"]});";

	// If adding a new version then suggest version number higher than the current one
	if ($form->hidden["display_subform"] != "Link") {
		if (isset($data["version_new"])  &&  $data["version_new"]<=$highest)	// if number in the input field is obsolete then remove it
			unset($data["version_new"]);

		$suggested = 0;

		if (fmod($highest,1) == 0)
			$suggested = 0.1;
		else {
			$temp      = $highest;
			$suggested = 1;
			
			while(fmod($temp,1) > 0) {
				$temp      *= 10;
				$suggested /= 10;
			}
		}
		
		$form->change_control("version_new" , ["Default"=>floatval(sprintf("%01.3f", $highest+$suggested))]);
	}

	// Default selection: "add a new version" and "add a new script"
	$form->change_control("version", ["Default"=>($form->hidden["display_subform"]=="Link" ? $to_version[1] : $to_version[0]), "Options"=>$to_version, "Property"=>"onChange=\"{$js_version_select} {$js_script_select}\""]);
	$form->change_control("script" , ["Default"=>$scripts_select[count($scripts_select)-1][1]]);
	
	// Default selection: "add a new jump"
	if ($form->hidden["display_subform"] == "Link") {
		$form->change_control("Link"  , ["Options"=>$links_select, "Property"=>"onChange=\"{$js_jump_select} {$js_script_select}\""]);	
		$form->change_control("script", ["Default"=>""]);	
		$scripts_select[0][] = "selected";
	}

	$form->change_control("script"    , ["Options"=>$scripts_select, "Property"=>"onChange=\"{$js_script_select}\""]);
	$form->change_control("scripttext", ["Group"=>"ID=\"scripttextinput\""]);
	$form->change_control("size"      , ["Group"=>"ID=\"sizetextinput\""]);
	$form->change_control("changelog" , ["Group"=>"ID=\"changelogtextinput\""]);
	
	// Include javascript
	$form->include_file("usersc/js/gs_functions.js");
	$form->include_file("usersc/js/moment.js");
	$form->include_file("usersc/js/marked.min.js");
	$form->add_html("
		<script type=\"text/javascript\">
			var {$js_script_list["name"]} = ".json_encode($js_script_list["data"]).";
			{$js_version_select} {$js_script_select} {$js_jump_select}
			
			var modfolder_name = ".json_encode($record_title).";
			
			var Update_List_Count        = Update_List.length;
			var Update_List_Backup       = null;
			var Update_List_Backup_Index = null;
			
			var Script_Contents_Count        = Script_Contents.length;
			var Script_Contents_Backup       = null;
			var Script_Contents_Backup_Index = null;
			
			var Links_List_Count        = Links_List.length;
			var Links_List_Backup       = null;
			var Links_List_Backup_Index = null;
			
			var container   = document.getElementById('page-wrapper').children[0];
			var div_preview = document.createElement('div');
			div_preview.id  = 'preview_installation';
			div_preview.classList.add('col-lg-12');
			container.appendChild(div_preview);
			
			var preview_from_ver = document.getElementById('preview_installation_from_version');
			var option           = document.createElement('option');
			option.value         = '0';
			option.text          = '0';
			preview_from_ver.appendChild(option);

			for (var i=0; i<Update_List.length; i++) {
				var option = document.createElement('option');
				option.value = Update_List[i].version;
				option.text = Update_List[i].version;
				preview_from_ver.appendChild(option);
			}
		</script>
	");
}














// If user wants to grant/revoke access for others
if ($form->hidden["display_form"] == "Share") 
	GS_record_sharing($record_title, $record_type, $record_table, $record_column, $form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner);











// If user wants to delete mod
if ($form->hidden["display_form"] == "Delete") {
	
	// Show warning about breaking links
	if ($form->hidden["action"] == "") {
		$sql = "
			SELECT 
				gs_serv.id 
			FROM 
				gs_serv_mods LEFT JOIN gs_serv 
					ON gs_serv_mods.serverid = gs_serv.id 
					AND gs_serv_mods.modid = ?
					AND gs_serv_mods.removed = 0
			WHERE 
				gs_serv.removed = 0
		";
				
		$db->query($sql,[$id]);
		$count  = count($db->results(true));
		
		if ($count > 0)
			$form->add_html(GS_lang("GS_STR_DELETE_MOD_USED", [$count]) . ". " . lang("GS_STR_DELETE_MOD_SURE") . "<br><br><br>");
	}
	
	GS_record_delete($record_title, $record_type, $record_table, $form, $id, $uid);
}

require_once "footer.php";
?>