/*things to update to add new view
	updateForm()
	forwardForm()
	deleteRecord()
	
outside of this script you'll need to modify the getDataTable.php
and add edit, add, and delete php files
*/

function updateForm(fid, inputs_assoc, values_assoc){
	//use this function to update specific forms, each form should have an unique identifier
	if(fid == "employeeForm"){
		$(inputs_assoc["employeeID"]).val(values_assoc["employeeID"]);
		$(inputs_assoc["fName"]).val(values_assoc["fName"]);
		$(inputs_assoc["lName"]).val(values_assoc["lName"]);
		$(inputs_assoc["date"]).val(values_assoc["DOB"]);
		if(values_assoc["sex"] != "") $('input[value='+values_assoc["sex"]+']', '#employeeForm').val([values_assoc["sex"]]);
		$(inputs_assoc["position"]).val(values_assoc["position"]);
		$(inputs_assoc["salary"]).val(values_assoc["salary"]);
		$(inputs_assoc["address"]).val(values_assoc["address"]);
		$(inputs_assoc["phoneNo"]).val(values_assoc["phoneNo"]);
		$(inputs_assoc["ssn"]).val(values_assoc["SSN"]);
		$(inputs_assoc["bankAcctNo"]).val(values_assoc["bankAcctNo"]);
		$(inputs_assoc["bankRoutingNo"]).val(values_assoc["bankRoutingNo"]);
		$(inputs_assoc["submit"]).val("update");
	}
	else if(fid == "servicesForm"){
		$(inputs_assoc["type"]).val(values_assoc["type"]);
		$(inputs_assoc["type"]).attr("disabled",true);
		$(inputs_assoc["cost"]).val(values_assoc["cost"]);
		$(inputs_assoc["submit"]).val("update");
	}
}

function forwardForm(fid, serializedData, submitType){
	//use this function to send forms to php files for processing without having to go to another page
	if(fid == "employeeForm" && submitType == "update"){		
		$.post("editEmployee.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
	else if(fid == "employeeForm" && submitType == "submit"){
		$.post("addEmployee.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
	else if(fid == "servicesForm" && submitType == "update"){		
		$.post("editService.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
	else if(fid == "servicesForm" && submitType == "submit"){
		$.post("addService.php", serializedData, function(output, status){
			bootbox.alert(output);
		});
	}
}

function resetForm(inputs){
	for(var i=0; i< inputs.length; i++){
		switch($(inputs[i]).attr("type")){
			case "submit":
				$(inputs[i]).val("submit");
				break;
			case "radio":
				$(inputs[i]).val([""]);
				break;
			default:
				$(inputs[i]).val("");
				$(inputs[i]).attr("disabled",false);
		}
	}
}

function deleteRecord(fid, dataObj){
	//use this to specify what php file to use to delete a record from a table
	if (fid == "ViewEmployee"){
		$.post("deleteEmployee.php",dataObj, function(output, status){
			bootbox.alert(output);
		});
	}
	else if (fid == "ViewService"){
		$.post("deleteService.php",dataObj, function(output, status){
			bootbox.alert(output);
		});
	}
}

function getFormAssoc(form){
	var inputs = $(form).find("input,select");
	var inputs_assoc = {};
	for(var i=0; i<inputs.length; i++){
		inputs_assoc[$(inputs[i]).attr("name")] = inputs[i];
	}
	return inputs_assoc;
}

function getRecordAssoc(names, values){
	var values_assoc = {};
	for(var i=0; i<names.length; i++){
		values_assoc[names[i].innerHTML] = values[i].innerHTML;
	}
	return values_assoc;
}

function displayView(content){
	var table = findChild($(content).children(),"table");
	var form = findChild($(content).children(),"form");
	var buttons = $(content).find("button");
	$.post("getDataTable.php", {type:$(content).attr("id")}, function(data, status){
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



$(document).ready(function(){
	$("a[data-toggle='tab']").on("click",function(){
		var content = $($(this).attr("href"));
		displayView(content);
	});
	
	$(".table").on("dblclick",function(){
		var buttons = $(this).parent().find("button");
		var table = findChild(this.children,"tbody");
		var form = null;
		var selectedColor = "rgb(205,205,205)";
		var blankColor = "rgba(0,0,0,0)";
		var color = null;
		var row = null;
		var colNames = null;
		var rowValues = null;
		var rowDeselected = null;
		var buttons_assoc = {};
		for(var i=0; i<buttons.length; i++){
			buttons_assoc[buttons[i].innerHTML] = buttons[i];
		}
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				color = $(table.children[i]).css("background-color");
				if(color.includes("205")){
					row = table.children[i];
					$(row).toggleClass("rowSelector");
					rowDeselected = row;
					buttons_assoc["edit"].disabled = true;
					buttons_assoc["delete"].disabled = true;
					break;
				}
			}
		}
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				color = $(table.children[i]).css("background-color");
				if(color.includes("245")){
					row = table.children[i];
					if (rowDeselected == row) break;
					$(row).toggleClass("rowSelector");
					colNames = $(findChild(findChild(this.children,"thead").children,"tr")).children();
					rowValues = $(row).children();
					form = findChild($(this).parent().children(),"form");
					updateForm($(form).attr("id"), getFormAssoc(form), getRecordAssoc(colNames,rowValues));
					buttons_assoc["edit"].disabled = false;
					buttons_assoc["delete"].disabled = false;
					break;
				}
			}
		}
	});
	
	$("button[value='edit'],button[value='add']").on("click", function(){
		var content = $(this).parent().parent().parent().parent().parent();
		var table = findChild($(content).children(),"table");
		var form = findChild($(content).children(),"form");
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
		if ($(this).val() == "add"){
			resetForm($(form).find("input,select"));
		}
	});
	
	$("button[value='cancel']").on("click", function(){
		var content = $(this).parent().parent().parent().parent().parent();
		displayView(content);
	});
	
	$("button[value='delete']").on("click", function(){
		var content = $(this).parent().parent().parent().parent().parent();
		var rowValues = $(".rowSelector").children();
		var colNames = findChild(findChild($(rowValues[0]).parent().parent().parent().children(),"thead").children, "tr").children;
		// JSON data format sample '{"test":"hoe","test2":"lacross"}';
		var dataStr = '{';
		for(var i=0; i<colNames.length; i++){
			dataStr += '"' + colNames[i].innerHTML + '":"' + rowValues[i].innerHTML + '"';
			if (i<colNames.length-1) dataStr += ',';
			else dataStr += '}';
		}
		var dataObj = JSON.parse(dataStr);
		deleteRecord($(content).attr("id"), dataObj);
		displayView(content);
	});
	
	$("form").on("submit",function(){
		event.preventDefault();
		var inputs = $(this).find("input");
		var submitType = null;
		for(var i=0; i<inputs.length; i++){
			if($(inputs[i]).attr("name") == "submit"){
				submitType = inputs[i];
			}
			$(inputs[i]).attr("disabled",false);
		}
		var values = $(this).serialize();
		forwardForm($(this).attr("id"), values, $(submitType).attr("value"));
		displayView($(this).parent());
	});
});

