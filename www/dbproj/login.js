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
	$("form").on("submit",function(){
		event.preventDefault();
		var content = $(this).parent();
		var msg = findChild($(content).children(),"p");
		$.post("login.php", $(this).serialize(), function(output,status){
			if (output.includes("Location:")){
				msg.innerHTML = "";
				window.location.replace(output.replace("Location:",""));
			}
			else msg.innerHTML = output;
		});
	});
});