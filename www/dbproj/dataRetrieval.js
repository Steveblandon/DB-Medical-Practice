/*things to update when integrating new view
	updateForm()
	
modify the getDataTable.php
and add edit, add, and delete php files to handle database manipulation
this script automatically looks for the appropriate php handler as long as they are named appropriately
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
	}
	else if(fid == "servicesForm"){
		$(inputs_assoc["type"]).val(values_assoc["type"]);
		$(inputs_assoc["type"]).attr("disabled",true);
		$(inputs_assoc["cost"]).val(values_assoc["cost"]);
	}
	else if(fid == "appointmentForm"){
		$(inputs_assoc["date"]).val(values_assoc["date"].replace(" ","T"));
		$.get("getPatientOptions.php", function(data, status){
			$(inputs_assoc["patient"]).html(data);
			$(inputs_assoc["patient"]).val(values_assoc["patientID"]);
		});
		$.get("getDoctorOptions.php", function(data, status){
			$(inputs_assoc["doctor"]).html(data);
			$(inputs_assoc["doctor"]).val(values_assoc["employeeID"]);
		});
		if (values_assoc["checkedIn"] == "Y") $(inputs_assoc["checkedIn"]).val("N");
		else $(inputs_assoc["checkedIn"]).val("Y");
	}
	
	//do this for every form:
	$(inputs_assoc["submit"]).val("update");
}

function forwardForm(fid, serializedData, submitType){
	var filename = fid.charAt(0).toUpperCase() + fid.replace("Form","").slice(1);
	var handler = null;
	switch(submitType){
		case "submit":
			handler = "add" + filename + ".php";
			break;
		case "update":
			handler = "edit" + filename + ".php";
			break;
	}
	$.post(handler, serializedData, function(output, status){
		bootbox.alert(output);
	});
}

function resetForm(fid, inputs){
	//generic resets that apply to various forms
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
	
	//resets specific to certain forms
	if (fid == "appointmentForm"){
		$.get("getPatientOptions.php", function(data, status){
			var input = $("select[name='patient']","#"+fid);
			$(input).html(data);
			$(input).val("");
		});
		$.get("getDoctorOptions.php", function(data, status){
			var input = $("select[name='doctor']","#"+fid);
			$(input).html(data);
			$(input).val("");
		});
	}
}

function processForm(form){
	//this function processes a form for any changes before serializing and forwarding
	var inputs = $(form).find("input");
	var submitType = null;
	for(var i=0; i<inputs.length; i++){
		if($(inputs[i]).attr("name") == "submit"){
			submitType = inputs[i];
		}
		//things to do before serializing form
		$(inputs[i]).attr("disabled",false);
	}
	var values = $(form).serialize();
	forwardForm($(form).attr("id"), values, $(submitType).attr("value"));
}

function deleteRecord(fid, dataObj){
	var handler = "delete" + fid.replace("View","") + ".php";
	$.post(handler,dataObj, function(output, status){
		bootbox.alert(output);
	});
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
	$.post("getDataTable.php", {type:$(content).attr("id")}, function(data, status){
		table.innerHTML = data;
	});
	$(form).hide();
	$(table).show();
	var buttons_assoc = getButtons_assoc(content);
	//the following are enveloped in try/catch blocks incase a button is not used
	try{$(buttons_assoc["cancel"]).parent().hide();}catch(err){}
	try{$(buttons_assoc["edit"]).parent().show();}catch(err){}
	try{$(buttons_assoc["checkedIn"]).parent().show();}catch(err){}
	try{$(buttons_assoc["add"]).parent().show();}catch(err){}
	try{$(buttons_assoc["delete"]).parent().show();}catch(err){}
	try{buttons_assoc["edit"].disabled = true;}catch(err){}
	try{buttons_assoc["delete"].disabled = true;}catch(err){}
	try{buttons_assoc["checkedIn"].disabled = true;}catch(err){}
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

function getButtons_assoc(content){
	var buttons = $(content).find("button");
	var buttons_assoc = {};
	for(var i=0; i<buttons.length; i++){
		buttons_assoc[$(buttons[i]).val()] = buttons[i];
	}
	return buttons_assoc;
}



$(document).ready(function(){
	$("a[data-toggle='tab']").on("click",function(){
		var content = $($(this).attr("href"));
		displayView(content);
	});
	
	$(".table").on("dblclick",function(){
		var table = findChild(this.children,"tbody");
		var form = null;
		var selectedColor = "rgb(205,205,205)";
		var blankColor = "rgba(0,0,0,0)";
		var color = null;
		var row = null;
		var colNames = null;
		var rowValues = null;
		var rowDeselected = null;
		var buttons_assoc = getButtons_assoc($(this).parent());
		
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				color = $(table.children[i]).css("background-color");
				if(color.includes("205")){ //:selected
					row = table.children[i];
					$(row).toggleClass("rowSelector");
					rowDeselected = row;
					//the following are enveloped in try/catch blocks incase a button is not used
					try{buttons_assoc["edit"].disabled = true;}catch(err){}
					try{buttons_assoc["delete"].disabled = true;}catch(err){}
					try{buttons_assoc["checkedIn"].disabled = true;}catch(err){}
					break;
				}
			}
		}
		for(var i=0; i < table.children.length; i++){
			if (table.children[i].tagName = "TR"){
				color = $(table.children[i]).css("background-color");
				if(color.includes("245")){//:hovered over
					row = table.children[i];
					if (rowDeselected == row) break;
					$(row).toggleClass("rowSelector");
					colNames = $(findChild(findChild(this.children,"thead").children,"tr")).children();
					rowValues = $(row).children();
					form = findChild($(this).parent().children(),"form");
					updateForm($(form).attr("id"), getFormAssoc(form), getRecordAssoc(colNames,rowValues));
					//the following are enveloped in try/catch blocks incase a button is not used
					try{buttons_assoc["edit"].disabled = false;}catch(err){}
					try{buttons_assoc["delete"].disabled = false;}catch(err){}
					try{buttons_assoc["checkedIn"].disabled = false;}catch(err){}
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
		var buttons_assoc = getButtons_assoc(content);
		//the following are enveloped in try/catch blocks incase a button is not used
		try{$(buttons_assoc["cancel"]).parent().show();}catch(err){}
		try{$(buttons_assoc["edit"]).parent().hide();}catch(err){}
		try{$(buttons_assoc["checkedIn"]).parent().hide();}catch(err){}
		try{$(buttons_assoc["add"]).parent().hide();}catch(err){}
		try{$(buttons_assoc["delete"]).parent().hide();}catch(err){}
		if ($(this).val() == "add"){
			resetForm($(form).attr("id"), $(form).find("input,select"));
		}
	});
	
	$("button[value='cancel']").on("click", function(){
		var content = $(this).parent().parent().parent().parent().parent();
		displayView(content);
	});
	
	$("button[value='checkedIn']").on("click", function(){
		var content = $(this).parent().parent().parent().parent().parent();
		var form = findChild($(content).children(),"form");
		processForm(form);
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
		processForm(this);
		displayView($(this).parent());
	});
});

