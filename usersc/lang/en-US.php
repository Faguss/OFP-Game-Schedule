<?php

$lang = array_merge($lang,array(
    #Misc
	"GS_STR_DOWNLOAD" => "Download",
	"GS_STR_TRANSLATION" => " ",
	"GS_STR_DISABLED" => "Disabled",
	"GS_STR_ENABLED" => "Enabled",
	"GS_STR_ADDED_BY" => "added by",
	"GS_STR_ADDED_BY_ON" => "Added by %m1% on %m2%",
	"GS_STR_MANAGED_BY_SINCE" => "Managed by %m1% since %m2%",
	"GS_STR_ERROR_EXPIRED" => "Page expired. Try again from home page",
	"GS_STR_ERROR_GET_DB_RECORD" => "Couldn't load data",
	"GS_STR_ERROR_FORMDATA" => "Incorrect form data",
	"GS_STR_WEBSITE_TITLE" => "OFP Game Schedule",
	"GS_STR_WEBSITE_DESCRIPTION" => "Organize OFP multiplayer sessions",
	"GS_STR_SHOW_CHANGELOG" => "View changelog",
	"GS_STR_MOD_UPDATES" => "How Do Mod Updates Work?",
	
    #Drop-down menu in the navigation bar
	"GS_STR_MENU_MODUPDATES" => "Mod Updates",
	"GS_STR_MENU_INSTALLSCRIPTS" => "Install Scripts",
	"GS_STR_MENU_QUICKSTART" => "Quick Start",
	"GS_STR_MENU_DEDICATED" => "Dedicated Server",
	"GS_STR_MENU_VIDEOS" => "Videos",
	"GS_STR_MENU_YOUTUBE" => "YouTube",
	"GS_STR_MENU_STEAM" => "Steam",
	"GS_STR_MENU_STEAMFORUM" => "Discuss on Steam",
	"GS_STR_MENU_BI" => "BI Forum",
	"GS_STR_MENU_BIFORUM" => "Discuss on BI Forum",
	"GS_STR_MENU_GOG" => "GOG Forum",
	"GS_STR_MENU_GOGFORUM" => "Discuss on GOG",
	"GS_STR_MENU_FACEBOOK" => "Facebook",
	"GS_STR_MENU_FACEBOOKFORUM" => "Discuss on Facebook",
	"GS_STR_MENU_VK" => "VK",
	"GS_STR_MENU_VKFORUM" => "Discuss on VK",
	"GS_STR_MENU_TRANSLATION" => "Translation",
	"GS_STR_MENU_CONTACT" => "Contact",
	
    #Home page
	"GS_STR_INDEX_WELCOME" => "Welcome to the OFP Game Schedule!",
	"GS_STR_INDEX_DESCRIPTION" => "Multiplayer organizer for Operation Flashpoint / ARMA: Cold War Assault",
	"GS_STR_INDEX_QUICKSTART" => "Get started",
	"GS_STR_INDEX_LEARN_MORE" => "Learn more",
	"GS_STR_INDEX_UPCOMING" => "Upcoming Games",
	"GS_STR_INDEX_PERSISTENT" => "Persistent Servers",
	"GS_STR_INDEX_ALLMODS" => "All Available Modfolders",
	"GS_STR_INDEX_RECENT" => "Recent Activity",
	"GS_STR_INDEX_MYSERVERS" => "My Servers",
	"GS_STR_INDEX_MYMODS" => "My Mods",
	"GS_STR_INDEX_OURSERVERS" => "Shared Servers",
	"GS_STR_INDEX_OURMODS" => "Shared Mods",
	"GS_STR_INDEX_ADDNEW_SERVER" => "Add a New Server",
	"GS_STR_INDEX_ADDNEW_MOD" => "Add a New Mod",
	"GS_STR_INDEX_EDIT" => "Details",
	"GS_STR_INDEX_SCHEDULE" => "Schedule",
	"GS_STR_INDEX_MODS" => "Mods",
	"GS_STR_INDEX_SHARE" => "Partners",
	"GS_STR_INDEX_DELETE" => "Delete",
	"GS_STR_INDEX_UPDATE" => "Update",
	"GS_STR_INDEX_INSTALLATION" => "Installation",
	"GS_STR_INDEX_LIMIT_REACHED" => "Limit reached",
	"GS_STR_INDEX_SHOW" => "Show",
	"GS_STR_INDEX_NO_RECORDS" => "No records",
	
    #Edit server details page
	"GS_STR_SERVER" => "Server",
	"GS_STR_SERVER_PAGE_TITLE" => "%m1% Server Details",
	"GS_STR_SERVER_NAME" => "Name",
	"GS_STR_SERVER_NAME_HINT" => "Full server name",
	"GS_STR_SERVER_NAME_EXAMPLE" => "Adam Smiths' server with WW4 mod and missions",
	"GS_STR_SERVER_ADDRESS" => "Address",
	"GS_STR_SERVER_ADDRESS_HINT" => "Server's IP address. Won't be shown publicly",
	"GS_STR_SERVER_PASSWORD" => "Password",
	"GS_STR_SERVER_PASSWORD_HINT" => "Server's password if required to connnect. Won't be shown publicly",
	"GS_STR_SERVER_ACCESSCODE" => "Password in the Schedule",
	"GS_STR_SERVER_ACCESSCODE_HINT" => "Write a password here to hide this server in the schedule",
	"GS_STR_SERVER_VERSION" => "Version",
	"GS_STR_SERVER_VERSION_HINT" => "Server's game version",
	"GS_STR_SERVER_EQUALMODS" => "Equal Mods Required",
	"GS_STR_SERVER_EQUALMODS_HINT" => "Enable if server requires from players to load identical modfolders",
	"GS_STR_SERVER_CUSTOMFILE" => "Max Custom File Size",
	"GS_STR_SERVER_CUSTOMFILE_HINT" => "Maximal size in bytes for custom files set by the server (max is 102400)",
	"GS_STR_SERVER_LANGUAGES" => "Languages",
	"GS_STR_SERVER_LANGUAGES_HINT" => "List of languages that players can speak on the server",
	"GS_STR_SERVER_LOCATION" => "Location",
	"GS_STR_SERVER_LOCATION_HINT" => "Server's location so that players can predict their connection quality",
	"GS_STR_SERVER_MESSAGE" => "Message",
	"GS_STR_SERVER_MESSAGE_HINT" => "Additional information for the players. Up to 255 characters",
	"GS_STR_SERVER_MESSAGE_EXAMPLE" => "Hello World!",
	"GS_STR_SERVER_WEBSITE" => "Website",
	"GS_STR_SERVER_WEBSITE_HINT" => "URL to a website where players can learn more about the server",
	"GS_STR_SERVER_LOGO" => "Logo",
	"GS_STR_SERVER_LOGO_HINT" => "JPG/PAA image up to \$max_image_size (recommended 128x128). Game needs to be restarted for this image to refresh",
	"GS_STR_SERVER_VOICE_ADDRESS" => "Voice Chat Address",
	"GS_STR_SERVER_VOICE_PROGRAM" => "Voice Program",
	"GS_STR_SERVER_VOICE_HINT" => "Won't be shown publicly",
	"GS_STR_SERVER_SUBMIT" => "Change Details",
	"GS_STR_SERVER_DRAGDROP" => "Drag & drop here server.cfg and flashpoint.cfg / coldwarassault.cfg / armaresistance.cfg to automatically fill some of the form fields",
	"GS_STR_SERVER_SELECT_FILES" => "Select Files",
	"GS_STR_SERVER_PERSISTENT" => "Persistent server?",
	"GS_STR_SERVER_PERSISTENT_HINT" => "Are players gathering for a specific time or randomly?",
	"GS_STR_SERVER_PERSISTENT_OFF" => "No. It's event-based and uses the schedule",
	"GS_STR_SERVER_PERSISTENT_ON" => "Yes. This server doesn't have a schedule",
	"GS_STR_SERVER_PICK_IP" => "Select address from the server list",
	"GS_STR_SERVER_MASTER_LIST" => "Master server list",
	"GS_STR_SERVER_MASTER_5MIN" => "Source: <a href=\"master.ofpisnotdead.com\">master.ofpisnotdead.com</a>. Updated every 5 minutes",

    #Edit server details page feedback
	"GS_STR_SERVER_URL_ERROR" => "Invalid website address",
	"GS_STR_SERVER_VOICE_ERROR" => "Invalid voice server address",
	"GS_STR_SERVER_ADDED" => "Server record added",
	"GS_STR_SERVER_UPDATED" => "Server record updated",
	"GS_STR_SERVER_ADDED_ERROR" => "Failed to add new server record",
	"GS_STR_SERVER_UPDATED_ERROR" => "Failed to update server record",
	"GS_STR_SERVER_NOPERM_ERROR" => "No permission to edit this server record",
	"GS_STR_SERVER_MAX_ERROR" => "Max number of server records reached",
	"GS_STR_SERVER_REMOVED_ERROR" => "Server record was removed",
    
    #Display server info page
	"GS_STR_SERVER_MODS" => "Mods",
	"GS_STR_SERVER_GAMETIME" => "Game Time",
	"GS_STR_SERVER_HOWTO_CONNECT" => "How to join",
	"GS_STR_SERVER_STATUS" => "Status",
	"GS_STR_SERVER_OFFLINE" => "Offline",
	"GS_STR_SERVER_CREATE" => "Creating",
	"GS_STR_SERVER_EDIT" => "Editing",
	"GS_STR_SERVER_WAIT" => "Waiting",
	"GS_STR_SERVER_SETUP" => "Setting up",
	"GS_STR_SERVER_DEBRIEFING" => "Debriefing",
	"GS_STR_SERVER_BRIEFING" => "Briefing",
	"GS_STR_SERVER_PLAY" => "Playing",
	"GS_STR_SERVER_MISSION" => "Mission",
	"GS_STR_SERVER_PLAYERS" => "Players",
	
    #Edit server schedule page
	"GS_STR_SERVER_EVENT_PAGE_TITLE" => "Schedule for the %m1% Server",
	"GS_STR_SERVER_EVENT_DATE" => "Date and Time",
	"GS_STR_SERVER_EVENT_TIMEZONE" => "Time zone",
	"GS_STR_SERVER_EVENT_REPEAT" => "Recurrence",
	"GS_STR_SERVER_EVENT_REPEAT_SINGLE" => "Single session",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY" => "Weekly",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC0" => "Every Sunday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC1" => "Every Monday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC2" => "Every Tuesday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC3" => "Every Wednesday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC4" => "Every Thursday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC5" => "Every Friday",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC6" => "Every Saturday",
	"GS_STR_SERVER_EVENT_REPEAT_DAILY" => "Daily",
	"GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC" => "Every day",
	"GS_STR_SERVER_EVENT_LENGTH" => "Duration",
	"GS_STR_SERVER_EVENT_MINUTES" => "in minutes",
	"GS_STR_SERVER_EVENT_BREAKSTART" => "Vacation first day",
	"GS_STR_SERVER_EVENT_BREAKEND" => "Vacation last day",
	"GS_STR_SERVER_EVENT_SUBMIT" => "Add New Event",
	"GS_STR_SERVER_EVENT_EDIT" => "Edit Selected",
	"GS_STR_SERVER_EVENT_CURRENT" => "Current events",
	"GS_STR_SERVER_EVENT_REMOVE" => "Remove Selected",
	"GS_STR_SERVER_EVENT_NOW" => "Now",
	"GS_STR_SERVER_EVENT_EXPIRED" => "Expired event",
	"GS_STR_SERVER_EVENT_VACATION" => "On pause until",
    
    #Edit server schedule page feedback
	"GS_STR_SERVER_EVENT_UPDATE" => "Event updated",
	"GS_STR_SERVER_EVENT_ADDED" => "Event added",
	"GS_STR_SERVER_EVENT_REMOVED" => "Canceled %m1% event%m2%",
	"GS_STR_SERVER_EVENT_NONE_ERROR" => "No events selected",
	"GS_STR_SERVER_EVENT_UPDATE_ERROR" => "Failed to update the entry",
	"GS_STR_SERVER_EVENT_MULTI_ERROR" => "Select one entry to edit",
	"GS_STR_SERVER_EVENT_ADDED_ERROR" => "Failed to add new event",
	"GS_STR_SERVER_EVENT_MAX_ERROR" => "Schedule is full",
	"GS_STR_SERVER_EVENT_REMOVED_ERROR" => "Failed to remove event",
	
    #Edit server mods page
	"GS_STR_SERVER_MOD_PAGE_TITLE" => "Mods on the %m1% Server",
	"GS_STR_SERVER_MOD_AVAILABLE" => "Available mods",
	"GS_STR_SERVER_MOD_AVAILABLE_HINT" => "Add mods in the same order they are loaded on the server",
	"GS_STR_SERVER_MOD_FULL" => "Server is full",
	"GS_STR_SERVER_MOD_NOTHING" => "Nothing new to add",
	"GS_STR_SERVER_MOD_CURRENT" => "Current mods",
	"GS_STR_SERVER_MOD_ASSIGN" => "Assign",
	"GS_STR_SERVER_MOD_SUBMIT" => "Change",
	"GS_STR_SERVER_MOD_DISCARD" => "Discard",
    
    #Edit server mods feedback
	"GS_STR_SERVER_MOD_REMOVED" => "Removed %m1% mod%m2%",
	"GS_STR_SERVER_MOD_REMOVED_ERROR" => "Failed to remove mods",
	"GS_STR_SERVER_MOD_ADDED" => "Added %m1% mod%m2%",
	"GS_STR_SERVER_MOD_ADDED_ONE" => "Added mod %m1%",
	"GS_STR_SERVER_MOD_ADDED_ERROR" => "Failed to add mods",
	"GS_STR_SERVER_MOD_UPDATED" => "Server mods updated",
	"GS_STR_SERVER_MOD_CLEAR" => "Server mods cleared",
	"GS_STR_SERVER_MOD_NOSEL_ERROR" => "No mods selected",
	"GS_STR_SERVER_MOD_MAX_ERROR" => "Server is full",
	"GS_STR_SERVER_MOD_ALREADY_ERROR" => "These mods were already added",
	
    #Edit mod details page
	"GS_STR_MOD" => "Mod",
	"GS_STR_MOD_PAGE_TITLE" => "%m1% Mod Details",
	"GS_STR_MOD_FOLDER" => "Folder name",
	"GS_STR_MOD_FOLDER_HINT" => "Name of the modfolder in the game directory",
	"GS_STR_MOD_SUBTITLE" => "Subtitle",
	"GS_STR_MOD_SUBTITLE_HINT" => "Second name to distinguish this mod from others",
	"GS_STR_MOD_DESCRIPTION" => "Description",
	"GS_STR_MOD_DESCRIPTION_HINT" => "What is it about and who made it",
	"GS_STR_MOD_DESCRIPTION_EXAMPLE" => "New infantry models and animations by Sanctuary",
	"GS_STR_MOD_ACCESS" => "Password",
	"GS_STR_MOD_ACCESS_HINT" => "Write a password here to hide this mod",
	"GS_STR_MOD_PUBLIC" => "Public",
	"GS_STR_MOD_PRIVATE" => "Private",
	"GS_STR_MOD_FORCENAME" => "Force Original Name",
	"GS_STR_MOD_FORCENAME_HINT" => "Automatically bring back original folder name if player renames it",
	"GS_STR_MOD_VERSION" => "Version",
	"GS_STR_MOD_VERSION_HINT" => "Number of the initial version of the mod",
	"GS_STR_MOD_INSTALLATION" => "Installation",
    "GS_STR_MOD_INSTALLATION_SCRIPT" => "Installation script",
	"GS_STR_MOD_INSTALLATION_HINT" => "%m1%Instructions%m2% for the installator. %m3%Test%m4% your script before submitting",
	"GS_STR_MOD_DOWNLOADSIZE" => "Download Size",
	"GS_STR_MOD_TYPE" => "Mod Type",
	"GS_STR_MOD_TYPE0" => "Replacement",
	"GS_STR_MOD_TYPE0_DESC" => "standalone addon pack that replaces original game files",
	"GS_STR_MOD_TYPE1" => "Addon Pack",
	"GS_STR_MOD_TYPE1_DESC" => "new addons without replacing game files",
	"GS_STR_MOD_TYPE2" => "Supplement",
	"GS_STR_MOD_TYPE2_DESC" => "enhances other modfolder",
	"GS_STR_MOD_TYPE3" => "Mission Pack",
	"GS_STR_MOD_TYPE3_DESC" => "contains only missions",
	"GS_STR_MOD_TYPE4" => "Tools",
	"GS_STR_MOD_TYPE4_DESC" => "Scripts for missionmaking",
	"GS_STR_MOD_ALIAS" => "Alternative Mod Names",
	"GS_STR_MOD_ALIAS_DESC" => "Works just like %m1%Alias%m2% command but for the entire installation",
	"GS_STR_MOD_MPCOMP" => "Multiplayer Compatibility",
	"GS_STR_MOD_MPCOMP_HINT" => "Single-player mods won't show up in the mod selection list for servers",
	"GS_STR_MOD_MPCOMP_YES" => "Yes",
	"GS_STR_MOD_MPCOMP_NO" => "No",
	"GS_STR_MOD_SUBMIT" => "Change Details",
	"GS_STR_MOD_REQ_VERSION" => "Required game version",
	"GS_STR_MOD_WARNING_LINK" => "Link to %m1% has to be converted. Use option \"Convert Download Link\" below",

	#Convert download link modal
    "GS_STR_MOD_CONVERTLINK" => "Convert Download Link",
	"GS_STR_MOD_CONVERTLINK_DESC" => "Convert link (from any of the sites listed below) to a format usable by the installer",
	"GS_STR_MOD_CONVERTLINK_SHAREABLE" => "shareable link",
	"GS_STR_MOD_CONVERTLINK_PAGE" => "download page address",
	"GS_STR_MOD_CONVERTLINK_FILENAME" => "File name",
	"GS_STR_MOD_CONVERTLINK_BIGFILE" => "Requires confirmation",
	"GS_STR_MOD_CONVERTLINK_BIGFILE_DESC" => "(usually for files above 100 MB, %m1%check%m2%)",
	"GS_STR_MOD_CONVERTLINK_INSERT" => "Insert",
    
    #Edit mod details page feedback
	"GS_STR_MOD_ADDED" => "Mod record added",
	"GS_STR_MOD_UPDATED" => "Mod record updated",
	"GS_STR_MOD_NOPERM_ERROR" => "No permission to edit this mod record",
	"GS_STR_MOD_MAX_ERROR" => "Maximum number of mod records reached",
	"GS_STR_MOD_REMOVED_ERROR" => "Mod record was removed",
	"GS_STR_MOD_NAME_ERROR" => "Invalid Windows filename",
	"GS_STR_MOD_ADDED_ERROR" => "Failed to add a new mod record",
	"GS_STR_MOD_UPDATED_ERROR" => "Failed to update the mod record",
    
    #Display mod info page
	"GS_STR_MOD_CURATOR" => "Curated by",
	"GS_STR_MOD_MANAGED_BY_SINCE" => "Managed by %m1% since %m2%",
	"GS_STR_MOD_PREVIEW_INSTSCRIPT" => "Preview %m1%Installation Script%m2%:",
	"GS_STR_MOD_SHOW_INSTSCRIPT" => "%m1%Show%m2% installation details",
	"GS_STR_MOD_HOWTO_INSTALL" => "How to install",
	
    #Add/Edit mod version section
	"GS_STR_MOD_UPDATE_PAGE_TITLE" => "%m1% Mod Installation",
	"GS_STR_MOD_SECTION_VERSION" => "Versions",
	"GS_STR_MOD_SELECT_VER" => "Select Version",
	"GS_STR_MOD_ADD_NEW_VER" => "Add a new version",
	"GS_STR_MOD_NEW_NUM" => "New Number",
	"GS_STR_MOD_NEW_NUM_HINT" => "Version of the mod as a result of this patch",
	"GS_STR_MOD_ADD_NEW_SCRIPT" => "Add a new script",
	"GS_STR_MOD_SAME_AS" => "Same as in version",
	"GS_STR_MOD_AND" => "and",
	"GS_STR_MOD_X_OTHERS" => "%m1% other%m2%",
	"GS_STR_MOD_PATCHNOTES" => "Patch Notes",
	"GS_STR_MOD_PATCHNOTES_HINT" => "What changed in this update?",
	"GS_STR_MOD_PATCHNOTES_EXAMPLE" => "added new unit",
	"GS_STR_MOD_PREVIEW_INST" => "Preview Installation",
	"GS_STR_MOD_SECTION_VERSION_SUBMIT" => "Add New Version",
	"GS_STR_MOD_SECTION_VERSION_EDIT_SUBMIT" => "Edit Version",

    #Add/Edit mod version section feedback
	"GS_STR_MOD_VERSION_ADDED" => "Update added",
	"GS_STR_MOD_SCRIPT_ADDED" => "Script added",
	"GS_STR_MOD_RECENTVER_ERROR" => "Failed to find the most recent version of this mod",
	"GS_STR_MOD_SCRIPT_ADDED_ERROR" => "Failed to add a new script",
	"GS_STR_MOD_VERSION_ADDED_ERROR" => "Failed to add a new update",
	"GS_STR_MOD_VERSION_UPDATED" => "Version modified",
	"GS_STR_MOD_VERSION_DELETED" => "Version removed",
	"GS_STR_MOD_VERSION_UPDATED_ERROR" => "Failed to modify version",
	"GS_STR_MOD_VERSION_DELETED_ERROR" => "Failed to remove version",
	"GS_STR_MOD_VERSION_DELETEBASE_ERROR" => "Cannot delete the first version",
	"GS_STR_MOD_SCRIPT_UPDATED" => "Script changed",
	"GS_STR_MOD_SCRIPT_UPDATED_ERROR" => "Failed to change the script",

    #Jump between mod versions section
	"GS_STR_MOD_SECTION_JUMP" => "Jumps Between Versions",
	"GS_STR_MOD_LINK" => "Select Jump",
	"GS_STR_MOD_ADD_NEW_LINK" => "Add a new jump",
	"GS_STR_MOD_TO" => "to",
	"GS_STR_MOD_NEWEST" => "newest",
	"GS_STR_MOD_LINK_FROM" => "From version",
	"GS_STR_MOD_LINK_FROM_HINT" => "Jump condition",
	"GS_STR_MOD_LINK_TO" => "To version",
	"GS_STR_MOD_LINK_TO_HINT" => "Result of this jump",
	"GS_STR_MOD_LINK_TO_NEWEST" => "Always to the newest one",
	"GS_STR_MOD_LINK_REMOVE" => "Remove Selected Jump",
	"GS_STR_MOD_SECTION_JUMP_SUBMIT" => "Add New Jump",
	"GS_STR_MOD_SECTION_JUMP_EDIT_SUBMIT" => "Edit Jump",

    #Jump between mod versions section feedback
	"GS_STR_MOD_LINK_ADDED" => "Jump added",
	"GS_STR_MOD_LINK_UPDATED" => "Jump updated",
	"GS_STR_MOD_LINK_DELETED" => "Jump removed",
	"GS_STR_MOD_CONDITION_ERROR" => "Condition error",
	"GS_STR_MOD_LINKVER_ERROR" => "Failed to find selected mod version",
	"GS_STR_MOD_LINK_ADDED_ERROR" => "Failed to add a new jump",
	"GS_STR_MOD_LINK_UPDATED_ERROR" => "Failed to update the jump",
	"GS_STR_MOD_LINK_DELETED_ERROR" => "Failed to remove the jump",
	"GS_STR_MOD_LINK_INVALID_ERROR" => "Invalid jump",
	
	#Installation scripts FAQ
	"GS_STR_MOD_FAQ_HOWTOWRITE" => "How do I write a script?",
	"GS_STR_MOD_FAQ_PAR1" => "Paste a link to the file and the installer will install it automatically. The link might need to be converted first.",
	"GS_STR_MOD_FAQ_CONVERT_Q1" => "Why do links have to be converted?",
	"GS_STR_MOD_FAQ_CONVERT_A1" => "Installer needs a direct link. If the file is on Google Drive, Mod DB, Mediafire or other then you need to add extra information so that it can find the proper source.",
	"GS_STR_MOD_FAQ_CONVERT_Q2" => "How do I convert a link?",
	"GS_STR_MOD_FAQ_CONVERT_A2" => "Below there is a \"Convert Download Link\" button. Click on it and then paste URL in the input field.",
	"GS_STR_MOD_FAQ_LINKS_Q" => "I want to know more about links",
	"GS_STR_MOD_FAQ_LINKS_A1" => "One line, one link. Spaces should be replaced with %20. Put links to the same file in curly brackets.",
	"GS_STR_MOD_FAQ_LINKS_A2" => "Read more about link format",
	"GS_STR_MOD_FAQ_AUTO_Q" => "How does automatic installation work exactly?",
	"GS_STR_MOD_FAQ_AUTO_A" => "Installer downloads the file, extracts it and then moves files to the game folder.",
	"GS_STR_MOD_FAQ_AUTO_A2" => "I want to know the exact rules",
	"GS_STR_MOD_FAQ_MANUAL_Q" => "How do I control the installation process?",
	"GS_STR_MOD_FAQ_MANUAL_A" => "By using commands. For example: \"unpack\" and \"move\". One line, one command.",
	"GS_STR_MOD_FAQ_UNPACK_A1" => "Write \"unpack url\" to download and extract file to a temporary location.",
	"GS_STR_MOD_FAQ_UNPACK_A2" => "Read more about \"unpack\"",
	"GS_STR_MOD_FAQ_MOVE_A1" => "Write \"move filename\" to transfer extracted file to the modfolder.",
	"GS_STR_MOD_FAQ_MOVE_A2" => "Read more about \"move\"",
	"GS_STR_MOD_FAQ_MANUAL_Q2" => "What are the other commands?",
	"GS_STR_MOD_FAQ_MANUAL_A2" => "It's possible to extract and create PBO files, edit text, delete and rename files, create folders.",
	"GS_STR_MOD_FAQ_MANUAL_A3" => "I want to know all the commands",
	"GS_STR_MOD_FAQ_MISSION_Q" => "Where to put mission files?",
	"GS_STR_MOD_FAQ_MISSION_A1" => "Store them in the \"Missions\" or \"MPMissions\" in the modfolder.",
	"GS_STR_MOD_FAQ_MISSION_A2" => "Read more about mission folders",
	"GS_STR_MOD_FAQ_DTA_Q" => "How do I replace original textures/models?",
	"GS_STR_MOD_FAQ_DTA_A1" => "Here's a code template:",
	"GS_STR_MOD_FAQ_DTA_A2" => "I want to see a commented example",
	"GS_STR_MOD_FAQ_TEST_Q" => "How do I test an installation script?",

    #Share server/mod page
	"GS_STR_SERVER_SHARESERVER_PAGE_TITLE" => "Share Access to the %m1% Server",
	"GS_STR_SERVER_SHAREMOD_PAGE_TITLE" => "Share Access to the %m1% Mod",
	"GS_STR_SHARE_PERMISSIONS" => "Permissions",
	"GS_STR_SHARE_EDIT" => "Changing details",
	"GS_STR_SHARE_SCHEDULE" => "Changing schedule",
	"GS_STR_SHARE_MODS" => "Changing mods",
	"GS_STR_SHARE_SHARE" => "Changing partners",
	"GS_STR_SHARE_DELETE" => "Deleting",
	"GS_STR_SHARE_INSTALLATION" => "Changing installation",
	"GS_STR_SHARE_UPDATE" => "Updating",
	"GS_STR_SHARE_TRANSFER" => "Transfer Ownership",
	"GS_STR_SHARE_TRANSFER_HINT" => "To transfer ownership uncheck all the other options",
	"GS_STR_SHARE_TRANSFER_CONFIRM_SERVER" => "You will lose access to this server. Are you sure?",
	"GS_STR_SHARE_TRANSFER_CONFIRM_MOD" => "You will lose access to this mod. Are you sure?",
	"GS_STR_SHARE_GRANT" => "Grant",
	"GS_STR_SHARE_CONTRIBUTORS" => "Current Contributors",
	"GS_STR_SHARE_REVOKE" => "Revoke Selected",
    
    #Share server/mod page feedback
	"GS_STR_SHARE_GRANTED" => "Access granted to %m1%",
	"GS_STR_SHARE_UPDATED" => "Permissions updated",
	"GS_STR_SHARE_REMOVED" => "Access revoked for %m1% user%m2%",
	"GS_STR_SHARE_REMOVED_ERROR" => "Failed to revoke access",
	"GS_STR_SHARE_FIND_USERS_ERROR" => "Failed to find users",
	"GS_STR_SHARE_FIND_USER_ERROR" => "Failed to find such user",
	"GS_STR_SHARE_NOSEL_ERROR" => "No users selected",
	"GS_STR_SHARE_ALREADY_ERROR" => "already has access",
	"GS_STR_SHARE_GRANTED_ERROR" => "Failed to grant access",
	"GS_STR_SHARE_UPDATED_ERROR" => "Failed to change permissions",
	"GS_STR_SHARE_LIMIT_ERROR" => "Reached the maximum amount of contributors",
	"GS_STR_SHARE_NOTOWNER_ERROR" => "You are not the server owner",
	
	#Delete page
	"GS_STR_DELETE_PAGE_TITLE" => "Remove %m1% %m2%",
	"GS_STR_DELETE_MOD_USED" => "This mod is being used on %m1% server%m2%",
	"GS_STR_DELETE_MOD_SURE" => "Are you sure?",
	"GS_STR_DELETE_GOBACK" => "Go Back",
	"GS_STR_DELETE_DONE" => "%m1% removed",
	"GS_STR_DELETE_DONE_ERROR" => "Failed to remove the %m1%",
	
	#Activity log
	"GS_STR_LOG_SERVER_ADDED" => "%m1% added a new server %m2%",
	"GS_STR_LOG_SERVER_UPDATED" => "%m1% edited the server %m2%",
	"GS_STR_LOG_SERVER_EVENT_REMOVED" => "%m1% removed event %m2% from the server %m3%",
	"GS_STR_LOG_SERVER_EVENT_UPDATE" => "%m1% updated event %m2% on the server %m3%",
	"GS_STR_LOG_SERVER_EVENT_ADDED" => "%m1% added a new event %m2% to the server %m3%",
	"GS_STR_LOG_SERVER_MOD_REMOVED" => "%m1% removed mod %m2% from the server %m3%",
	"GS_STR_LOG_SERVER_MOD_ADDED" => "%m1% added mod %m2% to the server %m3%",
	"GS_STR_LOG_SERVER_MOD_CHANGED" => "%m1% changed mods on the server %m3%",
	"GS_STR_LOG_SERVER_REVOKE_ACCESS" => "%m1% revoked server %m2% access for %m3%",
	"GS_STR_LOG_MOD_REVOKE_ACCESS" => "%m1% revoked mod %m2% access for %m3%",
	"GS_STR_LOG_SERVER_SHARE_ACCESS" => "%m1% gave server %m2% access to %m3%",
	"GS_STR_LOG_MOD_SHARE_ACCESS" => "%m1% gave mod %m2% access to %m3%",
	"GS_STR_LOG_SERVER_TRANSFER_ADMIN" => "%m1% transfered server %m2% ownership to %m3%",
	"GS_STR_LOG_MOD_TRANSFER_ADMIN" => "%m1% transfered mod %m2% ownership to %m3%",
	"GS_STR_LOG_SERVER_DELETE" => "%m1% removed server %m2%",
	"GS_STR_LOG_MOD_DELETE" => "%m1% removed mod %m2%",
	"GS_STR_LOG_MOD_ADDED" => "%m1% added a new mod %m2%",
	"GS_STR_LOG_MOD_UPDATED" => "%m1% edited mod %m2%",
	"GS_STR_LOG_MOD_SCRIPT_UPDATED" => "%m1% edited installation script %m2%",
	"GS_STR_LOG_MOD_SCRIPT_ADDED" => "%m1% added a new installation script %m2%",
	"GS_STR_LOG_MOD_VERSION_ADDED" => "%m1% updated mod %m2% to version %m3%",
	"GS_STR_LOG_MOD_VERSION_UPDATED" => "%m1% edited mod %m2% version %m3%",
	"GS_STR_LOG_MOD_LINK_ADDED" => "%m1% added a new version jump %m2%",
	"GS_STR_LOG_MOD_LINK_UPDATED" => "%m1% edited version jump %m2%",
	"GS_STR_LOG_MOD_LINK_DELETED" => "%m1% removed version jump %m2%",
	"GS_STR_LOG_INSTALLER_UPDATED" => "Updated %m1%mod installation scripting language%m2% to version %m3%"
));
?>