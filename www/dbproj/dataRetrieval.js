
function displayView(content){
	var table = findChild($(content).children(),"table");
	var form = findChild($(content).children(),"form");
	var buttons = $(content).find("button");
	//the following needs to be abstracted to work with various tables
	//for now its just working with the employee tab
	$.get("getDataTable.php", function(data, status){
		table.innerHTML = data;
	});
	$(form).hide();
	$(table).show();
	var buttons_assoc = {};
	for(var i=0; i<buttons.length; i++){
		buttons_assoc[buttons[i].innerHTML] = buttons[i];
	}
	$(buttons_assoc["cancel"]).parent().hide();
	$(buttons_assoc["edit"]).parent().show();
	$(buttons_assoc["add"]).parent().show();
	$(buttons_assoc["delete"]).parent().show();
	buttons_assoc["edit"].disabled = true;
	buttons_assoc["delete"].disabled = true;
}

function findChild(array, searchTag){
	var object = null;
	searchTag = searchTag.toUpperCase();
	for(var i=0; i < array.length; i++){
		if(array[i].tagName == searchTag){
			object = array[i];
			break;
		}
	}
	return object;
}

function updateForm(fid, inputs_assoc, values_assoc){
	//this function and forwardForm are the only javascript specific to certain hardcoded values
	if(fid == "employeeForm"){
		$(inputs_assoc["employeeID"]).val(values_assoc["employeeID"]);
		$(inputs_assoc["fName"]).val(values_assoc["fName"]);
		$(inputs_assoc["lName"]).val(values_assoc["lName"]);
		$(inputs_assoc["date"]).val(values_assoc["DOB"]);
		$('input[value='+values_assoc["sex"]+']', '#employeeForm').val([values_assoc["sex"]]);
		$(inputs_assoc["position"]).val(values_assoc["position"]);
		$(inputs_assoc["salary"]).val(values_assoc["salary"]);
		$(inputs_assoc["address"]).val(values_assoc["address"]);
		$(inputs_assoc["phoneNo"]).val(values_assoc["phoneNo"]);
		$(inputs_assoc["ssn"]).val(values_assoc["SSN"]);
		$(inputs_assoc["bankAcctNo"]).val(values_assoc["bankAcctNo"]);
		$(inputs_assoc["bankRoutingNo"]).val(values_assoc["bankRoutingNo"]);
		$(inputs_assoc["submit"]).val("update");
	}
}

function forwardForm(fid, serializedData, submitType){
	//this function and updateForm are the only javascript specific to certain hardcoded values
	if(fid == "employeeForm" && submitType == "update"){		
		//TO-DO: when done with form, reset submit input's value to "submit", 
		//also the other inputs' values might need to be reset
		$.post("editEmployee.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
	if(fid == "employeeForm" && submitType == "submit"){
		$.post("addEmployee.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
}

$(document).ready(function(){
	//display table
	$("a[data-toggle='tab']").on("click",function(){
		var content = $($(this).attr("href"));
		displayView(content);
	});
	
	//make row selectable
	$(".table").on("dblclick",function(){
		var buttons = $(this).parent().find("button");
		var table = findChild(this.children,"tbody");
		var selectedColor = "rgb(205,205,205)";
		var blankColor = "rgba(0,0,0,0)";
		var rowDeselected = null;
		var buttons_assoc = {};
		for(var i=0; i<buttons.length; i++){
			buttons_assoc[buttons[i].innerHTML] = buttons[i];
		}
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				var color = $(table.children[i]).css("background-color");
				if(color.includes("205")){
					var row = table.children[i];
					$(row).toggleClass("rowSelector");
					rowDeselected = row;
					buttons_assoc["edit"].disabled = true;
					break;
				}
			}
		}
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				var color = $(table.children[i]).css("background-color");
				if(color.includes("245")){
					var row = table.children[i];
					if (rowDeselected == row) break;
					$(row).toggleClass("rowSelector");
					var colNames = $(findChild(findChild(this.children,"thead").children,"tr")).children();
					var rowValues = $(row).children();
					var values_assoc = {};
					for(var i=0; i<colNames.length; i++){
						values_assoc[colNames[i].innerHTML] = rowValues[i].innerHTML;
					}
					var form = findChild($(this).parent().children(),"form");
					var inputs = $(form).find("input,select");
					var inputs_assoc = {};
					for(var i=0; i<inputs.length; i++){
						inputs_assoc[$(inputs[i]).attr("name")] = inputs[i];
					}
					updateForm($(form).attr("id"), inputs_assoc, values_assoc);
					buttons_assoc["edit"].disabled = false;
					break;
				}
			}
		}
	});
	
	//show edit form, for now its just working with the employee view
	$("button[value='edit'],button[value='add']").on("click", function(){
		var content = document.getElementById("ViewEmployee");
		var table = findChild(content.children,"table");
		var form = findChild(content.children,"form");
		$(table).hide();
		$(form).show();	
		var buttons = $(content).find("button");
		var buttons_assoc = {};
		for(var i=0; i<buttons.length; i++){
			buttons_assoc[buttons[i].innerHTML] = buttons[i];
		}
		$(buttons_assoc["cancel"]).parent().show();
		$(buttons_assoc["edit"]).parent().hide();
		$(buttons_assoc["add"]).parent().hide();
		$(buttons_assoc["delete"]).parent().hide();
	});
	
	$("button[value='cancel']").on("click", function(){
		var content = document.getElementById("ViewEmployee");
		displayView(content);
	});
	
	$("form").on("submit",function(){
		event.preventDefault();
		var inputs = $(this).find("input");
		var submitType = null;
		for(var i=0; i<inputs.length; i++){
			if($(inputs[i]).attr("name") == "submit"){
				submitType = inputs[i];
				break;
			}
		}
		var values = $(this).serialize();
		forwardForm($(this).attr("id"), values, $(submitType).attr("value"));
		displayView($(this).parent());
	});
});

