/* edit_server.php */

//https://www.codeproject.com/articles/625832/how-to-sort-date-and-or-time-in-javascript
function GS_sort_by_date_asc(item1, item2) {
	var lhs     = item1["starttime"];
	var rhs     = item2["starttime"];
	var results = lhs.year() > rhs.year() ? 1 : lhs.year() < rhs.year() ? -1 : 0
	
	if (results === 0) 
		results = lhs.month() > rhs.month() ? 1 : lhs.month() < rhs.month() ? -1 : 0;

	if (results === 0) 
		results = lhs.date() > rhs.date() ? 1 : lhs.date() < rhs.date() ? -1 : 0;

	if (results === 0) 
		results = lhs.hours() > rhs.hours() ? 1 : lhs.hours() < rhs.hours() ? -1 : 0;

	if (results === 0) 
		results = lhs.minutes() > rhs.minutes() ? 1 : lhs.minutes() < rhs.minutes() ? -1 : 0;

	if (results === 0) 
		results = lhs.seconds() > rhs.seconds() ? 1 : lhs.seconds() < rhs.seconds() ? -1 : 0;

	return results;
}

// Describes date in a readable format for each event associated with a server
function GS_format_event_list(data, list_id, stringtable, event_types) {
	var now    = moment();
	var output = [];
	
	for (var i=0; i<data.length; i++) {
		var type      = data[i]["type"];
		var starttime = data[i]["starttime"];
		var duration  = data[i]["duration"];

		var start      = moment(starttime);
		var end        = moment(starttime).add(duration, "minutes");
		var day        = start.day();
		var hour       = start.hour();
		var minute     = start.minute();
		var breakstart = moment(data[i]["breakstart"]);
		var breakend   = moment(data[i]["breakend"]).set({'hour':23, 'minute':59, 'second':59});

		// If this is a recurring event then adjust date
		if (type!=event_types["GS_EVENT_SINGLE"]  &&  now.isAfter(end)) {
			start = now.clone();	// Set to today
			start.set({'hour':hour, 'minute':minute, 'second':0, 'milisecond':0});
			
			if (type == event_types["GS_EVENT_WEEKLY"])	// Set to this week
				start.day(day);
				
			end = start.clone();
			end.add(duration, "minutes");
			
			// If the event has ended then set it to future
			if (now.isAfter(end)) {
				start.add( (type==event_types["GS_EVENT_WEEKLY"] ? 7 : 1) , "days");
				end = start.clone();
				end.add(duration, "minutes");
			}
		}
		
		// Compensate for vacation
		if (type != event_types["GS_EVENT_SINGLE"]) {
			while(start.isAfter(breakstart) && start.isBefore(breakend)) {
				start.add( (type==event_types["GS_EVENT_WEEKLY"] ? 7 : 1) , "days");
			}
			end = start.clone();
			end.add(duration, "minutes");
		}
			
		var description = "";
		
		// if the event has not ended
		if (!now.isAfter(end)) {
			if (now.isAfter(start))		// if the event has started
				description = stringtable["Now"];
			else
				description = start.calendar(null, {sameElse:'DD.MM.YY'});
		} else
			description = stringtable["Expired"];
		
		output.push({
			"starttime"  : start, 
			"endtime"    : end, 
			"type"       : type, 
			"typename"   : data[i]["typename"], 
			"description": description, 
			"uniqueid"   : data[i]["uniqueid"], 
			"user"       : data[i]["user"], 
			"timezone"   : data[i]["timezone"], 
			"duration"   : duration,
			"breakstart" : breakstart,
			"breakend"   : breakend
		});
	}
		
	output.sort(GS_sort_by_date_asc);
	
	// Remake the select list
	var list = document.getElementById(list_id);
	list.options.length = 0;
	
	for (var i=0; i<output.length; i++)
		list.options[i] = new Option(output[i]["description"], output[i]["uniqueid"]);
	
	return output;
}

// Display info about the chosen event or mod under the select list
function GS_display_info_when_selected(list, data_type, data, description_field) {
	var info       = "";
	var first_time = true;
	
	for (var i=0; i<list.length; i++)
        if (list.options[i].selected) {
			if (first_time)
				first_time = false;
			else
				info += "<br><br>";
			
			if (data_type == "Schedule")
				info += data[i]["starttime"].format("Do MMMM [(]dddd[)] YYYY [<br>] HH:mm") + " - " + data[i]["endtime"].format("HH:mm") + "&nbsp;&nbsp;" + (data[i]["type"]!=0 ? data[i]["typename"] : "") + "<br>" + data[i]["user"];
			
			if (data_type == "Mods")
				info += data[i];
		}
	
	document.getElementById(description_field).innerHTML = info;
}

// Display selected event details in an edit form
function GS_make_event_editable(list, data, form_inputs, edit_button_id, language) {
	for (var i=0; i<list.length; i++)
        if (list.options[i].selected)						// Find first selected option
			for (var j=0; j<data.length; j++)
				if (list.options[i].value == data[j]["uniqueid"]) {		// Find matching data point
					for (var k=0; k<form_inputs.length; k++) {
						var form_input = document.getElementById(form_inputs[k]);	// Fill inputs with data
						var new_value  = "";
						
						switch(k) {
							case 0: new_value=data[j]["starttime"].format("Do MMMM [(]dddd[)] YYYY HH:mm"); break;
							case 1: new_value=data[j]["timezone"]; break;
							case 2: new_value=data[j]["type"]; break;
							case 3: new_value=data[j]["duration"]; break;
							case 4: new_value=data[j]["breakstart"].format("Do MMMM [(]dddd[)] YYYY"); break;
							case 5: new_value=data[j]["breakend"].format("Do MMMM [(]dddd[)] YYYY"); break;
						}

						form_input.value = new_value;
					}
					
					var hidden_input   = document.getElementById(form_inputs[0].replace("_input", "_datetime"));
					hidden_input.value = data[j]["starttime"].toISOString(true);

					var edit_button           = document.getElementById(edit_button_id);
					edit_button.style.display = "inline-block";
					return;
				}
}

// Show/hide vacation start and end date controls if the event is recurring
function GS_show_vacation_controls(select_name, vacation_controls) {
	var select_control = document.getElementById(select_name);
	var show           = select_control.options[select_control.selectedIndex].value!='0' ? 'block' : 'none';
	
	for(var i=0; i<vacation_controls.length; i++) {
		var vacation_control = document.getElementById(vacation_controls[i]);
		vacation_control.style.display = show;
	}
}

// Show/hide mod tables based on current category selection
function GS_display_mod_types_table(list, data) {
	for (var i=0; i<list.length; i++) {
		var mod_table           = document.getElementById(data[i]);
		mod_table.style.display = list.options[i].selected ? "block" : "none";
	}
}

// Show game exe startup parameter -mod=
function GS_mod_parameter_update(table_id, field_id) {
	var table = document.getElementById(table_id).tBodies[0];
	var field = document.getElementById(field_id);
	
	var text_to_show = "";
	
	if (table.rows.length > 1) {
		text_to_show = "-mod=";
		
		for (var i=1; i<table.rows.length; i++) {
			if (i>1)
				text_to_show += ";"
			
			text_to_show += table.rows[i].children[0].innerHTML;
		}
	}
	
	field.innerHTML = text_to_show;
};

// Move table row from one table to another
function GS_table_row_transfer(source_table_id, destination_table_id, row_id, field_id, mod_limit, mod_limit_msg) {
	var source_table       = document.getElementById(source_table_id).tBodies[0];
	var destination_table  = document.getElementById(destination_table_id).tBodies[0];
	var row                = document.getElementById(row_id);
	var new_row            = row.cloneNode(true);
	var button_class       = destination_table_id=="current_mods" ? "btn-warning"         : "btn-mods";
	var button_description = destination_table_id=="current_mods" ? Mod_Button_Strings[1] : Mod_Button_Strings[0];
	
	new_row.children[4].innerHTML = "";
	
	if (destination_table_id != "current_mods" || destination_table_id == "current_mods" && destination_table.rows.length-1 < mod_limit) {
		if (destination_table_id == "current_mods") {			
			new_row.children[3].innerHTML += "<input type=\"hidden\" name=\"mod_to_assign[]\" value=\""+row_id+"\" />";
			new_row.children[4].innerHTML += "<button onclick=\"GS_table_rows_swap('up','"+row_id+"','"+field_id+"')\" type='button' class=\"btn btn-mods btn-xs\"><span class=\"fa fa-fw fa-arrow-up\"></span></button> ";
			new_row.children[4].innerHTML += "<button onclick=\"GS_table_rows_swap('down','"+row_id+"','"+field_id+"')\" type='button' class=\"btn btn-mods btn-xs\"><span class=\"fa fa-fw fa-arrow-down\"></span></button> "
		} else
			new_row.children[3].removeChild(new_row.children[3].children[1]);
		
		new_row.children[4].innerHTML += "<td><button onclick=\"GS_table_row_transfer('"+destination_table_id+"','"+source_table_id+"','"+row_id+"','"+field_id+"',"+mod_limit+",'"+mod_limit_msg+"')\" type=\"button\" class=\"btn "+button_class+" btn-xs\">"+button_description+"</button></td>";
		
		source_table.removeChild(row);
		destination_table.appendChild(new_row);
		
		GS_mod_parameter_update(destination_table_id=="current_mods" ? destination_table_id : source_table_id, field_id);
	} else
		alert(mod_limit_msg);
}

// Move table row up or down
function GS_table_rows_swap(direction, row_id, field_id) {
    var row   = document.getElementById(row_id);
	var table = row.parentNode;
	
	for (var i=0; i<table.rows.length; i++)
		if (table.rows[i] == row) {
			if (direction=="up" && i>1)
				table.insertBefore(table.rows[i], table.rows[i-1]);
				
			if (direction=="down" && i<table.rows.length-1)
				table.insertBefore(table.rows[i+1], table.rows[i]);
			
			GS_mod_parameter_update(table.parentNode.id, field_id);
			
			break;
		}
}

// Get game server status
function GS_get_server_status(ip_id, ip_group, location_group_id, name_id, password_id, version_id, equalmodreq_id, location_id) {
	var ip_input = document.getElementById(ip_id);
	var ip       = ip_input.value;
	var port     = '2302';
	var parts    = ip_input.value.split(':');
	
	if (parts.length >= 2) {
		ip   = parts[0];
		port = parts[1];
	}
	
	
	// Get server version and equalmodrequired
	var ip_input_backup = ip_input.innerHTML;
	ip_input.innerHTML  = "";
	$(ip_input).addClass('schedule_modal_loader');
	
	$.get("https://ofp-api.ofpisnotdead.com/"+ip+":"+port, function(data) {
		$(ip_input).removeClass('schedule_modal_loader');
		ip_input.innerHTML = ip_input_backup;
		
		$('#'+name_id).val(data.hostname);
		$('#'+version_id).val(data.actver.substring(0,1)+"."+data.actver.substring(1));
		$('#'+equalmodreq_id).val(data.equalModRequired);
		
		if (data.password == "1") {
			if ($('#'+password_id).val() == "")
				$('#'+password_id).val("<type password here>");
		} else
			$('#'+password_id).val("");
	})
	.fail(function() {
		$(ip_input).removeClass('schedule_modal_loader');
		ip_input.innerHTML = ip_input_backup;
	});
	
	
	// Get location
	var location_input        = document.getElementById(location_id);
	var location_input_backup = location_input.innerHTML;
	location_input.innerHTML  = "";
	
	$(location_input).addClass('schedule_modal_loader');

	$.ajax({
		async: true,
		crossDomain: true,
		data: "json",
		url: "https://ipwho.is/"+ip,
		success: function(data) {
			$(location_input).removeClass('schedule_modal_loader');
			location_input.innerHTML = location_input_backup;
			
			if (!jQuery.isEmptyObject(data)) {
				$('#'+location_id).val(data.continent+", "+data.country);
			}
		},
		fail: function() {
			$(location_input).removeClass('schedule_modal_loader');
			location_input.innerHTML = location_input_backup;
		}
	});
}

const SQM_EXPECT = {
	PROPERTY: 0,
	EQUALITY: 1,
	VALUE: 2,
	SEMICOLON: 3,
	CLASS_NAME: 4,
	CLASS_INHERIT: 5,
	CLASS_COLON: 6,
	CLASS_BRACKET: 7,
	ENUM_BRACKET: 8,
	ENUM_CONTENT: 9,
	EXEC_BRACKET: 10,
	EXEC_CONTENT: 11,
	MACRO_CONTENT: 12
}

const SQM_COMMENT = {
	NONE: 0,
	LINE: 1,
	BLOCK: 2
}

const SQM_OUTPUT = {
	END_OF_SCOPE: 0,
	PROPERTY: 1,
	CLASS: 2
};

const SQM_ACTION = {
	GET_NEXT_ITEM: 0,
	FIND_PROPERT: 1,
	FIND_CLASS: 2,
	FIND_CLASS_END: 3,
	FIND_CLASS_END_CONVERT: 4
}

// Generate SQM ParseState object
function SQM_Init() {
	return {
		// Input
		i                 : 0,
		word_start        : -1,
		comment           : SQM_COMMENT.NONE,
		expect            : SQM_EXPECT.PROPERTY,
		class_level       : 0,
		array_level       : 0,
		array_started     : false,
		parenthesis_level : 0,
		word_started      : false,
		first_char        : true,
		is_array          : false,
		in_quote          : false,
		macro             : false,
		is_inherit        : false,
		purge_comment     : false,
		separator         : ' ',

		// Output
		property            : "",
		property_start      : 0,
		property_end        : 0,
		value               : "",
		value_start         : 0,
		value_end           : 0,
		class_name          : "",
		class_start         : 0,
		class_end           : 0,
		class_length        : 0,
		class_name_full_end : 0,
		inherit             : "",
		scope_end           : 0
	};
}

// is string whitespace
function GS_isspace(input) {
	' \t\n\r\v'.indexOf(input) > -1
}

// is string alphanumeric
function GS_isalnum(input) {
	return input.match(/^[\p{L}\p{N}]*$/u)
}

// Parse OFP configuration file
function SQM_Parse(input, state, action_type, to_find) {
	var initial_level = state.class_level;
	
	for (; state.i<input.length; state.i++) {
		var c = input[state.i];
		//console.log(state.i+"/"+input.length+" " + c + " expect:"+Object.keys(SQM_EXPECT)[state.expect] + " arraylevel:"+state.array_level);

		// Parse preprocessor comment
		switch (state.comment) {
			case SQM_COMMENT.NONE  : {
				if (c == '/' && !state.in_quote) {
					var c2 = input[state.i+1];
					
					if (c2 == '/')
						state.comment = SQM_COMMENT.LINE;
					else 
						if (c2 == '*')
							state.comment = SQM_COMMENT.BLOCK;
				}
				
				if (state.comment == SQM_COMMENT.NONE)
					break;
				else {
					if (state.word_started)
						state.purge_comment = true;
					
					continue;
				}
			}
			
			case SQM_COMMENT.LINE  : {
				if (c=='\r' || c=='\n')
					state.comment = SQM_COMMENT.NONE;

				continue;
			}
			
			case SQM_COMMENT.BLOCK : {
				if (state.i>0 && input[state.i-1]=='*' && c=='/')
					state.comment = SQM_COMMENT.NONE;

				continue;
			}
		}

		// Parse preprocessor directives
		if (!state.first_char && (c=='\r' || c=='\n')) {
			state.first_char = true;
			
			if (state.macro && input[state.i-1] != '\\')
				state.macro = false;
		}
		
		if (!GS_isspace(input[state.i])  &&  state.first_char) {
			state.first_char = false;
			
			if (c == '#')
				state.macro = true;
		}
		
		if (state.macro)
			continue;


		// Parse classes
		switch (state.expect) {
			case SQM_EXPECT.SEMICOLON : {
				if (c == ';') {
					state.expect = SQM_EXPECT.PROPERTY;
					continue;
				} else 
					if (!GS_isspace(c))
						state.expect = SQM_EXPECT.PROPERTY;
			}
			
			case SQM_EXPECT.PROPERTY : {
				if (c == '}') {
					state.scope_end = state.i;
					state.expect    = SQM_EXPECT.SEMICOLON;
					state.class_level--;
						
					// If wanted to move to the end of the current scope
					if ((action_type == SQM_ACTION.FIND_CLASS_END || action_type==SQM_ACTION.FIND_CLASS_END_CONVERT) && state.class_level+1==initial_level) {

						// Include separator in the class length
						for (var z=state.i; z<=input.length; z++) {
							if (z == input.length || input[z]==';' || input[z]=='\n') {
								state.i = z;
								break;
							}
						}
						
						state.i++;
						state.class_end    = state.i;
						state.class_length = state.i - state.class_start;
						return SQM_OUTPUT.END_OF_SCOPE;
					}
									
					// End parsing when leaving starting scope
					if (state.class_level < initial_level  ||  action_type == SQM_ACTION.GET_NEXT_ITEM) {
						state.i++;
						return SQM_OUTPUT.END_OF_SCOPE;
						
					}

					continue;
				}
				
				if (GS_isalnum(c) || c=='_' || c=='[' || c==']') {
					if (!state.word_started) {
						state.word_start   = state.i;
						state.word_started = true;
					}
				} else
					if (state.word_started) {
						if (input.substring(state.word_start,state.word_start+5) == "class") {
							state.expect = SQM_EXPECT.CLASS_NAME;
							
							if (action_type != SQM_ACTION.FIND_CLASS_END && action_type != SQM_ACTION.FIND_CLASS_END_CONVERT)
								state.class_start = state.word_start;
						} else 
							if (input.substring(state.word_start,state.word_start+4) == "enum") {
								state.expect    = SQM_EXPECT.ENUM_BRACKET;
								state.separator = '{';
							} else 
								if (input.substring(state.word_start,state.word_start+6) == "__EXEC") {
									state.expect    = SQM_EXPECT.EXEC_BRACKET;
									state.separator = '(';
								} else {
									state.expect          = SQM_EXPECT.EQUALITY;
									state.separator       = '=';
									state.property_start  = state.word_start;
									state.property_end    = state.i;
									state.property        = input.substring(state.property_start, state.property_end);
									state.is_array        = input[state.i-2]=='[' && input[state.i-1]==']';
									state.array_started   = !state.is_array;
									//console.log("property: "+state.property + " isarray:"+state.is_array);
								}

						state.word_started = false;
					}
				
				if (state.separator == ' ') {
					break;
				}
			}
			
			case SQM_EXPECT.EQUALITY     : 
			case SQM_EXPECT.ENUM_BRACKET : 
			case SQM_EXPECT.EXEC_BRACKET : {
				if (c == state.separator) {
					state.expect++;
					state.separator = ' ';
				} else 
					if (state.expect==SQM_EXPECT.EQUALITY && c=='(') {
						state.expect            = SQM_EXPECT.MACRO_CONTENT;
						state.separator         = ' ';
						state.parenthesis_level = 1;
					} else 
						if (state.expect == SQM_EXPECT.ENUM_BRACKET) { // ignore what's between "enum" keyword and bracket
							if (c != '{')
								break;
						} else
							if (!GS_isspace(c)) {	//ignore syntax error
								//console.log("syntax error: " + c);
								state.i--;
								state.separator = ' ';
								state.expect    = SQM_EXPECT.SEMICOLON;
							}
				
				break;
			}
			
			case SQM_EXPECT.VALUE : {
				if (c == '"')
					state.in_quote = !state.in_quote;

				if (!state.in_quote && (c=='{' || c=='[')) {
					state.array_level++;
					state.array_started = true;
					
					if (SQM_ACTION.FIND_CLASS_END_CONVERT)
						input[state.i] = '{';
				}

				if (!state.in_quote && (c=='}' || c==']')) {
					state.array_level--;
					
					if (SQM_ACTION.FIND_CLASS_END_CONVERT)
						input[state.i] = '}';

					// Remove trailing commas
					/*for (int z=state.i-1; z>0 && (GS_isspace(text[z]) || text[z]==',' || text[z]=='}' || text[z]==']'); z--)
						if (text[z]==',')
							text[z] = ' ';*/
				}

				// Convert semi-colons to commas
				/*if (!state.in_quote && c==';' && state.is_array && state.array_level>0)
					text[state.i] = ',';*/

				if (!state.word_started) {
					if (!GS_isspace(c)) {
						state.word_start   = state.i;
						state.word_started = true;
					}
				} else {
					if (!state.in_quote && state.array_started && state.array_level==0 && (c==';' || c=='\r' || c=='\n')) {
						state.value_start = state.word_start;
						state.value_end   = state.i;
						state.value       = input.substring(state.value_start, state.value_end);
						
						// Include separator in the length
						for (var z=state.i; z<=input.length; z++) {
							if (z == input.length) {
								state.value_end = z;
								break;
							}
							
							if (input[z]==';' || input[z]=='\n') {
								state.value_end = z + 1;
								break;
							}
						}
						
						//console.log("value: "+state.value+" action:");
						state.word_started = false;
						state.expect       = SQM_EXPECT.PROPERTY;
						
						if (
							action_type == SQM_ACTION.GET_NEXT_ITEM || 
							(
								action_type           == SQM_ACTION.FIND_PROPERTY && 
								state.class_level     == initial_level && 
								state.property.length == to_find.length &&
								state.property        == to_find
							)
						) {
							state.i++;
							return SQM_OUTPUT.PROPERTY;
						}
					}
				}
				
				break;
			}
			
			case SQM_EXPECT.CLASS_NAME    :
			case SQM_EXPECT.CLASS_INHERIT : {
				if (GS_isalnum(c) || c=='_') {
					if (!state.word_started) {
						state.word_start   = state.i;
						state.word_started = true;
					}
				} else
					if (state.word_started) {
						if (state.expect == SQM_EXPECT.CLASS_NAME) {
							state.class_name_start = state.word_start;
							state.class_name_end   = state.i;
							state.class_name       = input.substring(state.class_name_start, state.class_name_end);
							state.inherit          = "";
						} else {
							state.inherit = input.substring(state.word_start, state.i);
						}
						
						state.is_inherit          = state.expect == SQM_EXPECT.CLASS_INHERIT;
						state.word_started        = false;
						state.expect              = state.expect==SQM_EXPECT.CLASS_NAME ? SQM_EXPECT.CLASS_COLON : SQM_EXPECT.CLASS_BRACKET;
						state.class_name_full_end = state.i;
					}
				
				if (state.expect!=SQM_EXPECT.CLASS_COLON && state.expect!=SQM_EXPECT.CLASS_BRACKET)
					break;
			}
			
			case SQM_EXPECT.CLASS_COLON   :
			case SQM_EXPECT.CLASS_BRACKET : {
				if (state.expect==SQM_EXPECT.CLASS_COLON && c==':')
					state.expect = SQM_EXPECT.CLASS_INHERIT;
				else 
					if (c == '{') {
						state.class_level++;
						state.expect = SQM_EXPECT.PROPERTY;
						
						// Return starting position of this class
						if (
							action_type == SQM_ACTION.GET_NEXT_ITEM || 
							(
								action_type             == SQM_ACTION.FIND_CLASS && 
								state.class_level-1     == initial_level && 
								state.class_name.length == to_find.length && 
								state.class_name        == to_find
							)
						) {
							state.i++;
							return SQM_OUTPUT.CLASS;
						}
					} else
						if (!GS_isspace(c)) {	//ignore syntax error
							state.i--;
							state.expect = SQM_EXPECT.SEMICOLON;
						}
				
				break;
			}
			
			case SQM_EXPECT.ENUM_CONTENT : 
			case SQM_EXPECT.EXEC_CONTENT : {
				if ((state.expect==SQM_EXPECT.EXEC_CONTENT && c==')') || (state.expect==SQM_EXPECT.ENUM_CONTENT && c=='}'))
					state.expect = SQM_EXPECT.SEMICOLON;

				break;
			}
			
			case SQM_EXPECT.MACRO_CONTENT : {
				if (c == '"')
					state.in_quote = !state.in_quote;
					
				if (!state.in_quote) {
					if (c == '(')
						state.parenthesis_level++;
						
					if (c == ')')
						state.parenthesis_level--;
						
					if (state.parenthesis_level == 0)
						state.expect = SQM_EXPECT.SEMICOLON;
				}
					
				break;
			}
		}
	}
	
	state.scope_end = input.length;
	return SQM_OUTPUT.END_OF_SCOPE;
}

// Remove quotation marks
function GS_trimq(input) {
	if (input[0] == '"' && input[input.length-1] == '"')
		return input.slice(1,-1);
	else
		return input;
}

// Handle file input
function GS_read_server_config(input, array) {		
	for (var i=0; i<input.files.length; i++) {
		(function(file) {
			var is_game_config = false;
			
			switch(file.name.toLowerCase()) {
				case "coldwarassault.cfg" : is_game_config=true; $('#version').val("1.99"); break;
				case "flashpoint.cfg"     : is_game_config=true; $('#version').val("1.96"); break;
				case "armaresistance.cfg" : is_game_config=true; $('#version').val("2.01"); break;
			}
			
			var reader    = new FileReader();
			reader.onload = function(e) {
				var text  = e.target.result; 
				var state = SQM_Init();
				
				while (state.i < text.length) {
					switch (SQM_Parse(text, state, SQM_ACTION.GET_NEXT_ITEM, "")) {
						case SQM_OUTPUT.PROPERTY :
							for (var i=0; i<array.length; i++) {
								if (state.property.toLowerCase() == array[i][0].toLowerCase()) {
									state.value = GS_trimq(state.value.trim());
										
									if (state.value[0]=='{'  &&  state.value[state.value.length-1]=='}') {
										var trim       = state.value.slice(1,-1);
										var message    = "";
										var word_start = -1;
										
										for (var j=0; j<state.value.length; j++) {
											if (state.value[j] == '"') {
												if (word_start < 0) {
													word_start = j + 1;
												} else {
													message   += state.value.substring(word_start,j) + " ";
													word_start = -1;
												}
											}
										}
										
										state.value = message;
									}
									
									$('#'+array[i][1]).val(state.value);
									array[i].push(true);
								}
							}
							break;
					}
				}
				
				// Set default value for properties that were not found
				for (var i=0; i<array.length; i++) {
					if (array[i].length == 2) {
						if ((array[i][0]=='MaxCustomFileSize' && !is_game_config)  ||  (array[i][0]!='MaxCustomFileSize' && is_game_config))
							continue;
						
						if (array[i][0] == "equalModRequired")
							$('#'+array[i][1]).val("0");
						else
							$('#'+array[i][1]).val("");
					}
				}
			}
			
			reader.readAsText(file, "UTF-8");
		})(input.files[i]);
	}
}

// When drag & dropping files
function GS_drop_handler(event, field) {
	event.preventDefault();
	GS_read_server_config(event.dataTransfer, [['hostname','name'], ['password','password'], ['equalModRequired','equalmodreq'], ['MaxCustomFileSize','maxcustomfilesize'], ['motd[]','message']]);
	field.style.backgroundColor = "transparent";
}

// ondragover disable
function GS_drag_over_handler(event, field, enable) {
	event.preventDefault();
	field.style.backgroundColor = enable ? "coral" : "transparent";
}






/* edit_mod.php */

// https://stackoverflow.com/questions/5796718/html-entity-decode#9609450
var GS_decode_entities = (function() {
	// this prevents any overhead from creating the object each time
	var element = document.createElement('div');

	function GS_decode_html_entities(str) {
		if (str && typeof str === 'string') {
			// strip script/html tags
			str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
			str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
			element.innerHTML = str;
			str = element.textContent;
			element.textContent = '';
		}

		return str;
	}

	return GS_decode_html_entities;
})();

// When user selects mod version from the list then display its properties
function GS_version_select(version_select_id, script_select_id, changelog_field_id, changelog_group_id, new_version_id, submit_button_array, data) {
	var version_select   = document.getElementById(version_select_id);
	var selected_version = version_select.options[version_select.selectedIndex].value;
	var changelog_group  = document.getElementById(changelog_group_id);
	var new_version      = document.getElementById(new_version_id);
	var submit_button    = document.getElementById(submit_button_array[0]);
	
	// If selected "add a new version"
	if (selected_version == -1) {
		new_version.style.display     = "block";
		changelog_group.style.display = "block";
		submit_button.innerHTML       = submit_button_array[1];
	} else {
		new_version.style.display     = "none";
		submit_button.innerHTML       = submit_button_array[2];

		// Find currently selected version in the data array
		for (var i=0; i<data.length; i++) {
			if (selected_version == data[i]["version"]) {
				var script_select   = document.getElementById(script_select_id);
				script_select.value = data[i]["uniqueid"];
				
				// Show patch notes if not first version
				if (i != 0) {
					changelog_group.style.display = "block";
					var changelog_field           = document.getElementById(changelog_field_id);
					changelog_field.value         = GS_decode_entities(data[i]["changelog"]);
					changelog_field.style.height  = "auto";
					var buffer                    = changelog_field.style.height != changelog_field.scrollHeight ? 10 : 0;
					changelog_field.style.height  = changelog_field.scrollHeight + buffer + "px";
				} else
					changelog_group.style.display = "none";
			}
		}
	}
}

// When user selects a script from the list then display its contents
function GS_installation_script_select(version_select_id, script_select_id, form_inputs, data) {
	var version_select   = document.getElementById(version_select_id);
	var selected_version = version_select.options[version_select.selectedIndex].value;
	var script_select    = document.getElementById(script_select_id);

	// Search for the selected script id in the data array and then fill form inputs with data
	if (!script_select.options[0].selected) {
		var selected_script_id = script_select.options[script_select.selectedIndex].value;
		
		for (var i=0; i<data.length; i++) {
			if (selected_script_id == data[i]["uniqueid"]) {
				var data_keys = Object.keys(data[0]);
				
				for (var j=0; j<form_inputs.length; j++) {
					var input   = document.getElementById(form_inputs[j]);
					input.value = GS_decode_entities(data[i][data_keys[j+1]]);
					
					if (j == 0) {
						input.style.height = 'auto';
						var extra_height   = 0;
						
						if (input.style.height != input.scrollHeight)
							extra_height = 20;
						
						input.style.height = input.scrollHeight+extra_height+'px';
					}
					
					// If user wants to "add a new version" then block inputs
					input.disabled = selected_version == -1;
				}
				
			}
		}
	} else {
		// If user wants to add a new script then clear inputs
		var text_field          = document.getElementById(form_inputs[0]);
		text_field.value        = "";
		text_field.style.height = 'auto';
		
		document.getElementById(form_inputs[1]).value = "1";
		document.getElementById(form_inputs[2]).value = "KB";
		
		for (var i=0; i<form_inputs.length; i++)
			document.getElementById(form_inputs[i]).disabled = 0;
	}
}

// When user selects a version jump from the list then display its properties
function GS_jump_select(link_list_id, submit_button_array, form_inputs, data) {
	var link_list     = document.getElementById(link_list_id);
	var submit_button = document.getElementById(submit_button_array[0]);
	var delete_button = document.getElementById(submit_button_array[1]);
	var current_link  = link_list.options[link_list.selectedIndex].value;
	var data_keys     = Object.keys(data[0]);
	
	if (link_list.options[0].selected) {
		submit_button.innerHTML     = submit_button_array[2];
		delete_button.style.display = "none";
	} else {
		submit_button.innerHTML     = submit_button_array[3];
		delete_button.style.display = "inline-block";

		for (var i=0; i<data.length; i++)
			if (current_link == data[i]["uniqueid"])
				for (var j=0; j<form_inputs.length; j++) {
					var input   = document.getElementById(form_inputs[j]);
					input.value = GS_decode_entities(data[i][data_keys[j+1]]);
				}
	}	
}

// https://stackoverflow.com/questions/4009756/how-to-count-string-occurrence-in-string
function GS_count_occurrences(string, subString, allowOverlapping) {
    string    += "";
    subString += "";
	
    if (subString.length <= 0) 
		return (string.length + 1);

    var n    = 0,
        pos  = 0,
        step = allowOverlapping ? 1 : subString.length;

    while (true) {
        pos = string.indexOf(subString, pos);
		
        if (pos >= 0) {
            ++n;
            pos += step;
        } else 
			break;
    }

    return n;
}

// Handle modal that is used to convert URL when writing an installation script
function GS_activate_convertlink_modal() {
	// Get form elements
	var convertlink_modal          = document.getElementById('convertlink_modal');
	var convertlink_modal_close    = document.getElementById('convertlink_modal_close');
	var convertlink_modal_accept   = document.getElementById('convertlink_modal_accept');
	var convertlink_modal_size     = document.getElementById('convertlink_modal_size');
	var convertlink_modal_link     = document.getElementById('convertlink_modal_link');
	var convertlink_modal_filename = document.getElementById('convertlink_modal_filename');
	var convertlink_modal_testlink = document.getElementById('convertlink_modal_testlink');

	// Make link open the modal
	var custom_button     = document.getElementById('convertlink_field');
	custom_button.onclick = function() {
		convertlink_modal.style.display = 'block';
	}

	// Hide controls	
	convertlink_modal_accept.style.display         = 'none';
	convertlink_modal_group_filename.style.display = 'none';
	convertlink_modal_group_size.style.display     = 'none';

	// Verify input and show button
	convertlink_modal_link.oninput = function() {
		convertlink_modal_accept.style.display         = convertlink_modal_filename.value.length > 0 ? 'block' : 'none';
		convertlink_modal_group_filename.style.display = 'none';
		convertlink_modal_group_size.style.display     = 'none';

		if (convertlink_modal_link.value.indexOf('drive.google.com') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';
			convertlink_modal_group_size.style.display     = 'block';
			
			var id_pos1 = convertlink_modal_link.value.indexOf('id=');
			var id_pos2 = convertlink_modal_link.value.indexOf('/d/');
			var testurl = 'https://docs.google.com/uc?export=download&id=';
			
			if (id_pos1>=0 || id_pos2>=0) {				
				if (id_pos1 >= 0)
					testurl += convertlink_modal_link.value.substring(id_pos1+3);
				
				if (id_pos2 >= 0)
					testurl += convertlink_modal_link.value.substring(id_pos2+3, convertlink_modal_link.value.indexOf('/',id_pos2+4));
				
				convertlink_modal_testlink.href = testurl;
			}
		}

		if (convertlink_modal_link.value.indexOf('moddb.com/mods/') >= 0 || convertlink_modal_link.value.indexOf('moddb.com/downloads/start') >= 0 || convertlink_modal_link.value.indexOf('gamefront.com/games/') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';
		}

		if (convertlink_modal_link.value.indexOf('mediafire.com/file/') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';

			var pos = convertlink_modal_link.value.indexOf('mediafire.com/file/');
			var sub = convertlink_modal_link.value.substring(pos+19);
			pos     = sub.indexOf('/');
		}

		if (convertlink_modal_link.value.search('ds-servers.com') >= 0) {
			var id_pos = convertlink_modal_link.value.search('/gf/');
			
			if (id_pos >= 0)
				convertlink_modal_group_filename.style.display = 'block';
		}
		
		if (convertlink_modal_link.value.search('armaholic.com/page.php\\?id=') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';
		}
		
		if (convertlink_modal_link.value.search('ofpec.com') >= 0) {
			var id_pos = convertlink_modal_link.value.search('id=');
			
			if (id_pos >= 0)
				convertlink_modal_group_filename.style.display = 'block';
		}
		
		if (convertlink_modal_link.value.search('sendspace.com') >= 0) {
			var id_pos = convertlink_modal_link.value.search('/file/');
			
			if (id_pos >= 0)
				convertlink_modal_group_filename.style.display = 'block';
		}

		if (convertlink_modal_link.value.indexOf('lonebullet.com') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';
		}
		
		if (convertlink_modal_link.value.indexOf('dropbox.com/s/') >= 0 && convertlink_modal_link.value.indexOf('?dl=0') >= 0) {
			convertlink_modal_group_filename.style.display = 'block';
		}
		
		if (convertlink_modal_group_filename.style.display == 'block') {
			$(convertlink_modal_filename).addClass('schedule_modal_loader');
			$.post('js_request.php', {"filenamefromurl":convertlink_modal_link.value}, function(responseText) {
					$(convertlink_modal_filename).removeClass('schedule_modal_loader');
					convertlink_modal_filename.value       = responseText;
					convertlink_modal_accept.style.display = responseText.length > 0 ? 'block' : 'none';
				}
			);
		}
	}

	convertlink_modal_filename.oninput = function() {
		convertlink_modal_accept.style.display = convertlink_modal_filename.value.length > 0 ? 'block' : 'none';
	}

	// Parse input, paste string and close dialog
	convertlink_modal_accept.onclick = function() {
		var final_url = '';

		if (convertlink_modal_link.value.indexOf('drive.google.com') >= 0) {
			var id_pos1 = convertlink_modal_link.value.indexOf('id=');
			var id_pos2 = convertlink_modal_link.value.indexOf('/d/');
			
			if (id_pos1>=0 || id_pos2>=0) {
				final_url += 'https://docs.google.com/uc?export=download&id=';
				
				if (id_pos1 >= 0)
					final_url += convertlink_modal_link.value.substring(id_pos1+3);
				
				if (id_pos2 >= 0)
					final_url += convertlink_modal_link.value.substring(id_pos2+3, convertlink_modal_link.value.indexOf('/',id_pos2+4));
				
				final_url += ' ';
				
				if (convertlink_modal_size.checked)
					final_url += 'confirm= ';
			}
		}

		if (convertlink_modal_link.value.indexOf('moddb.com/mods/') >= 0) {			
			final_url = convertlink_modal_link.value + ' /downloads/start/ /downloads/mirror/ ';
		}
		
		if (convertlink_modal_link.value.indexOf('moddb.com/downloads/start') >= 0) {
			var query_pos = convertlink_modal_link.value.indexOf('?');
			
			if (query_pos == -1)
				query_pos = convertlink_modal_link.value.length;
			
			final_url = convertlink_modal_link.value.substring(0, query_pos) + ' /downloads/mirror/ ';
		}
		
		if (convertlink_modal_link.value.indexOf('mediafire.com/file/') >= 0) {
			var pos = convertlink_modal_link.value.indexOf('mediafire.com/file/');
			var sub = convertlink_modal_link.value.substring(pos+19);
			
			if (GS_count_occurrences(sub, '/', false) > 0) {
				pos       = convertlink_modal_link.value.lastIndexOf('/');
				final_url = convertlink_modal_link.value.substring(0,pos);
			} else {
				final_url = convertlink_modal_link.value;
			}
			
			final_url += ' ://download ';
		}
		
		if (convertlink_modal_link.value.indexOf('gamefront.com/games/') >= 0) {
			var last_slash = convertlink_modal_link.value.lastIndexOf('/');
			final_url      = convertlink_modal_link.value + ' ' + convertlink_modal_link.value.substring(last_slash+1) + '/download expires= ';
		}
		
		if (convertlink_modal_link.value.search('ds-servers.com') >= 0) {
			final_url = convertlink_modal_link.value + (convertlink_modal_link.value.search('files/gf/')>=0 ? ' store.node ' : ' files/gf/ store.node ');
		}
		
		if (convertlink_modal_link.value.search('armaholic.com/page.php\\?id=') >= 0) {
			final_url = convertlink_modal_link.value + ' download_file= ';
		}

		if (convertlink_modal_link.value.search('ofpec.com') >= 0) {
			final_url = convertlink_modal_link.value + (convertlink_modal_link.value.search('download.php')>=0 ? ' ' : ' download.php ');				
		}

		if (convertlink_modal_link.value.search('sendspace.com') >= 0) {
			final_url = convertlink_modal_link.value + ' sendspace.com/dl ';
		}

		if (convertlink_modal_link.value.search('lonebullet.com') >= 0) {
			final_url = convertlink_modal_link.value + ' /file/ files.lonebullet.com ';
		}
		
		if (convertlink_modal_link.value.indexOf('dropbox.com/s/') >= 0 && convertlink_modal_link.value.indexOf('?dl=0') >= 0) {
			final_url = convertlink_modal_link.value.replace('?dl=0', '?dl=1') + ' ';
		}
		
		if (final_url.length > 0 && convertlink_modal_filename.value.length > 0) {
			var scripttext    = document.getElementById('scripttext');
			var final_name    = convertlink_modal_filename.value.trim();
			
			if (final_name.indexOf(' ') >= 0)
				final_name = '"' + final_name + '"'
			
			scripttext.value += (scripttext.value!='' ? '\n' : '') + final_url + final_name;
			convertlink_modal.style.display = 'none';
		}
	}

	// Close dialog
	convertlink_modal_close.onclick = function() {
		convertlink_modal.style.display = 'none';
	}
	
	window.onclick = function(event) {
		if (event.target == convertlink_modal) {
			convertlink_modal.style.display = 'none';
		}
	}	
}




/* common.php */

// Disable form input
function GS_block_control(control, condition) {
	control.disabled = condition;

	if (condition) {
		control.classList.add('active');
		
		if (control.type == "checkbox")
			control.checked = false;
	} else
		control.classList.remove('active');
}

// Block "Transfer ownership" checkbox if other checkboxes are selected and unblock it if other checkboxes are empty
function GS_limit_permissions_choice(checkboxes_name) {
	var checkboxes     = document.getElementsByName(checkboxes_name);
	var block_other    = false;
	var block_transfer = false;
	var index_transfer = -1;
	
	for (var i=0; i<checkboxes.length; i++)
		if (checkboxes[i].value == "isowner") {
			index_transfer = i;
			block_other    = checkboxes[i].checked;
		}
		
	for (var i=0; i<checkboxes.length; i++)
		if (i!=index_transfer  &&  checkboxes[i].checked)
			block_transfer = true;
	
	for (var i=0; i<checkboxes.length; i++)
			GS_block_control(checkboxes[i], i==index_transfer ? block_transfer : block_other);
}

// Check/uncheck privilege checkboxes when user selected username from the list
function GS_show_user_permissions(user_list_id, user_name_input_id, checkboxes_name, data) {
	var user_select_list = document.getElementById(user_list_id);
	var user_name_input  = document.getElementById(user_name_input_id);
	var checkboxes       = document.getElementsByName(checkboxes_name);
	var current_username = user_select_list.options[user_select_list.selectedIndex].text;
	
	for (var i=0; i<data.length; i++)
		if (current_username == data[i]["username"]) {
			user_name_input.value = current_username;
			
			for (var j=0; j<data[i]["permissions"].length; j++)
				checkboxes[j].checked = data[i]["permissions"][j];
		}
		
	GS_limit_permissions_choice(checkboxes_name);
}

// Display confirmation box when user wants to transfer ownership of an entry
function GS_confirm_transfer_ownership(checkboxes_name, message) {
	var checkboxes  = document.getElementsByName(checkboxes_name);
	var is_transfer = false;
	
	for (var i=0; i<checkboxes.length; i++)
		if (checkboxes[i].value == "isowner")
			is_transfer = checkboxes[i].checked;	
	
	if (is_transfer)
		return confirm(message);
	else
		return true;
}




/* index.php */

// Localize event dates when displaying server info
function GS_convert_server_events(event_data, stringtable, event_types) {
	var now      = moment();
	var all_tags = document.getElementsByClassName("servergametime");

	for (var i=0; i<all_tags.length; i++) {
		var new_text = "";

		for (var j=0; j<event_data[i].length; j++) {
			var starttime = event_data[i][j]["starttime"];
			var duration  = event_data[i][j]["duration"];
			var type      = event_data[i][j]["type"];
			var started   = event_data[i][j]["started"];
			
			var start  = moment(starttime);
			var start2 = moment(starttime);
			var end    = moment(starttime).add(duration, "minutes");
			var day    = start.day();
			var hour   = start.hour();
			var minute = start.minute();

			// If this is a recurring event then adjust date
			if (type!=event_types["GS_EVENT_SINGLE"]  &&  now.isAfter(end)) {
				start = now.clone();	// Set to today
				start.set({'hour':hour, 'minute':minute, 'second':0, 'milisecond':0});
				
				if (type == event_types["GS_EVENT_WEEKLY"])	// Set to this week
					start.day(day);
					
				end = start.clone();
				end.add(duration, "minutes");
				
				// If the event has ended then set it to future
				if (now.isAfter(end)) {
					start.add( (type==event_types["GS_EVENT_WEEKLY"] ? 7 : 1) , "days");
					end = start.clone();
					end.add(duration, "minutes");
				}
			}			
			
			var description = "";
			
			switch(type) {
				case event_types["GS_EVENT_SINGLE"] : 
					description += start.format("Do MMMM [(]dddd[)]"); 
					break;
				
				case event_types["GS_EVENT_WEEKLY"] : 
					if (!started)
						description += start2.format("Do MMMM[. ] ");
					description += stringtable[start.format("d")]; 
					break;
					
				case event_types["GS_EVENT_DAILY"] : 
					if (!started)
						description += start2.format("MMMM Do YYYY, ");
					description += stringtable["Daily"]; 
					break;
			}
			
			description += start.format(" HH:mm - ") + end.format("HH:mm");
		
			new_text += (new_text!="" ? "<br>" : "") + description;
		}
		
		all_tags[i].innerHTML = new_text;
	}
}




/* show.php */

// Localize date when displaying server/mod
function GS_convert_addedon_date(classname, dates) {
	var all_tags = document.getElementsByClassName(classname);
	
	for (var i=0; i<all_tags.length; i++)
		all_tags[i].innerHTML = moment(dates[i]).format("Do MMMM YYYY");
}

// Reload website with different query string argument for mod version
function GS_mod_version_selection(select_id, index) {
	GS_input_vers[index] = select_id.options[select_id.selectedIndex].value;
	
	var mods = "mod=";
	var vers = "&ver=";
	
	for (var i=0; i<GS_input_vers.length; i++) {
		mods += (i>0 ? "," : "") + GS_input_mods[i];
		vers += (i>0 ? "," : "") + GS_input_vers[i];
	}

	window.location.replace(GS_input_url + (GS_input_url.slice(-1)=="?" ? "" : "&") + mods + vers);
}