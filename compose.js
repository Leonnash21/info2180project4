window.onload = function(){
	//Declare Variables
	var composeAction = document.getElementById("composeButton");
	
	//Create AJAX Browser for Composing messages
	function goToCompose(){
		var composeBrowser;
		if(window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
		 	composeBrowser=new XMLHttpRequest();
		}else{
			// code for IE6, IE5
		 	composeBrowser=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		composeBrowser.onreadystatechange=function(){
		 	if (composeBrowser.readyState==4 && composeBrowser.status==200){
		 		document.body.innerHTML=composeBrowser.responseText;
		 	}
		 };
		 
		 composeBrowser.open("GET","http://localhost/cmail/compose.php",true);
		 composeBrowser.send();		
		
	}
	composeAction.onclick = function(){
		goToCompose();
	};
	
};