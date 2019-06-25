function getAPIKey(){
	var confirm = window.confirm("Generate new API Key? This will revoke any previously generated API Keys!")
	if(!confirm) return;
	return $.post("./Apikeygenerator.php", {}, data=>{
		$('#api_key').val(data.message)
	},'json') 
}