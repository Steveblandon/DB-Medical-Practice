$(document).ready(function(){
	$("[href='#ViewEmployee']").on("click",function(){
		var element = document.getElementById("ViewEmployee");
		$.get("getDataTable.php", function(data, status){
			element.innerHTML = "<table class='table table-hover'>" + data + "</table>";
		});
	});
});