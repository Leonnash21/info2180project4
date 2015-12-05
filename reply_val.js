window.onload = function(){
	
	//Create AJAX Browser for getting VALIDATION MESSAGES
	function getValidationMessage(a,b,c,d){
		 var xmlhttp;
		 if (window.XMLHttpRequest){
		 	// code for IE7+, Firefox, Chrome, Opera, Safari
		 	xmlhttp=new XMLHttpRequest();
		 }else{
		 	// code for IE6, IE5
		 	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		 }
		 
		 xmlhttp.onreadystatechange=function(){
		 	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		 		document.getElementById("errorMessages").innerHTML=xmlhttp.responseText;
		 	}
		 };
		 
		 xmlhttp.open("GET","http://localhost/cmail/compose_val.php?senderDATA=" + a + "&recipientDATA=" + b +"&subjectDATA=" + c + "&messageDATA=" + d,true);
		 xmlhttp.send();
		 
	}			
	$('submitButton').onclick = function(){
		getValidationMessage($('sender').value,$('recipient').value,$('subject').value,$('message').value);
	};

};