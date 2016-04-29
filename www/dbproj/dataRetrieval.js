$(document).ready(function(){

	//////////////////////Patient Stuff 
	$("[href='#ViewPatient']").on("click",function(){
		var element = document.getElementById("ViewPatient");
		$.get("getPatientTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});


	$("[href='#ViewPatientAppt']").on("click",function(){
		var element = document.getElementById("ViewPatientAppt");
		$.get("getAppointmentTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

	$("[href='#ViewPatientHealthScreen']").on("click",function(){
		var element = document.getElementById("ViewPatientHealthScreen");
		$.get("getHealthScreenTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

	$("[href='#ViewPatientImm']").on("click",function(){
		var element = document.getElementById("ViewPatientImm");
		$.get("getImmunizationTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

	$("[href='#ViewPatientMedicalTest']").on("click",function(){
		var element = document.getElementById("ViewPatientMedicalTest");
		$.get("getMedicalTestTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

	$("[href='#ViewPatientVisit']").on("click",function(){
		var element = document.getElementById("ViewPatientVisit");
		$.get("getVisitTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});


	///////////////////////////EMPLOYEE STUFF 
	$("[href='#ViewEmployeeSchedule']").on("click",function(){
		var element = document.getElementById("ViewEmployeeSchedule");
		$.get("getScheduleTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

	$("[href='#ViewEmployee']").on("click",function(){
		var element = document.getElementById("ViewEmployee");
		$.get("getDataTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});

		$("[href='#ViewEmployeeAppt']").on("click",function(){
		var element = document.getElementById("ViewEmployeeAppt");
		$.get("getAppointmentTable_Employee.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});





});