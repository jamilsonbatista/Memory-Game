function onSelectChange(){
	var selected = $("#level option:selected");		
	var output = "";
	if(selected.val() != 0){
		output = "You Selected " + selected.val();
	}
	$("#output").html(output);
}