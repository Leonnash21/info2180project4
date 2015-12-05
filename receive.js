window.onload = function(){
	//Declare Variables
	var message = document.getElementsByClassName("messageContent");
	var sender = document.getElementsByClassName("senderName");
	var topic = document.getElementsByClassName("subject");
	var composeAction = document.getElementById("composeButton");
	
	//these will store the subject and sender's name
	var subjectD ="";
	var senderD="";
	

	//Create AJAX Browser for getting Messages
	function getMessage(x,y){
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
		 		document.getElementById("messageBody").innerHTML=xmlhttp.responseText;
		 	}
		 };
		 
		 xmlhttp.open("GET","http://localhost/cmail/receive.php?senderD=" + x + "&subjectD=" + y,true);
		 xmlhttp.send();
		 
	}	
			
	
	//function to access feild data
	function getText(element){
		return element.innerHTML;
	}
	
	/*Assign values to represent sender name and subject description when message is clicked*/
	message[0].onclick = function(){
		//store content of feilds
		senderD = getText(sender[0]);
		subjectD = getText(topic[0]);
		
		//apply effect to show that they were read - not relevant yet
		message[0].style.fontWeight = "normal";
		message[0].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[1].onclick = function(){
		//store content of feilds
		senderD = getText(sender[1]);
		subjectD = getText(topic[1]);
		
		//apply effect to show that they were read - not relevant yet
		message[1].style.fontWeight = "normal";
		message[1].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[2].onclick = function(){
		//store content of feilds
		senderD = getText(sender[2]);
		subjectD = getText(topic[2]);
		
		//apply effect to show that they were read - not relevant yet
		message[2].style.fontWeight = "normal";
		message[2].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[3].onclick = function(){
		//store content of feilds
		senderD = getText(sender[3]);
		subjectD = getText(topic[3]);
		
		//apply effect to show that they were read - not relevant yet
		message[3].style.fontWeight = "normal";
		message[3].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[4].onclick = function(){
		//store content of feilds
		senderD = getText(sender[4]);
		subjectD = getText(topic[4]);
		
		//apply effect to show that they were read - not relevant yet
		message[4].style.fontWeight = "normal";
		message[4].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[5].onclick = function(){
		//store content of feilds
		senderD = getText(sender[5]);
		subjectD = getText(topic[5]);
		
		//apply effect to show that they were read - not relevant yet
		message[5].style.fontWeight = "normal";
		message[5].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[6].onclick = function(){
		//store content of feilds
		senderD = getText(sender[6]);
		subjectD = getText(topic[6]);
		
		//apply effect to show that they were read - not relevant yet
		message[6].style.fontWeight = "normal";
		message[6].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[7].onclick = function(){
		//store content of feilds
		senderD = getText(sender[7]);
		subjectD = getText(topic[7]);
		
		//apply effect to show that they were read - not relevant yet
		message[7].style.fontWeight = "normal";
		message[7].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[8].onclick = function(){
		//store content of feilds
		senderD = getText(sender[8]);
		subjectD = getText(topic[8]);
		
		//apply effect to show that they were read - not relevant yet
		message[8].style.fontWeight = "normal";
		message[8].style.color = "green";
		getMessage(senderD,subjectD);
	};
	
	message[9].onclick = function(){
		//store content of feilds
		senderD = getText(sender[9]);
		subjectD = getText(topic[9]);
		
		//apply effect to show that they were read - not relevant yet
		message[9].style.fontWeight = "normal";
		message[9].style.color = "green";
		getMessage(senderD,subjectD);
	};


};