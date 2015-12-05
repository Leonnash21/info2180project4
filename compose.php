<?php 
	session_start(); 
	$thisUser = $_SESSION['currentUser'];
?>

<html>
<head>
	<title>Cheapo Mail | Compose</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>

	<script type="text/javascript" src="prototype.js"></script>
	
	<script>
	
	        //Create AJAX Browser for getting VALIDATION MESSAGES /
        function getValidationMessage(a,b,c,d)
        {
                 var xmlhttp;
                 if (window.XMLHttpRequest)
                 {
                         // code for IE7+, Firefox, Chrome, Opera, Safari
                         xmlhttp=new XMLHttpRequest();
                 }
                 else
                 {
                         // code for IE6, IE5
                         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                 }
                 
                 xmlhttp.onreadystatechange=function()
                 {
                         if (xmlhttp.readyState==4 && xmlhttp.status==200)
                         {
                                 document.getElementById("errorMessages").innerHTML=xmlhttp.responseText;
                         }
                 };
                 
                 xmlhttp.open("GET","http://localhost/cmail/composeValidation.php?senderDATA=" + a + "&recipientDATA=" + b +"&subjectDATA=" + c + "&messageDATA=" + d,true);
                 xmlhttp.send();
                 
        }                        
        $('submitButton').onclick = function()
        {
                getValidationMessage($('sender').value,$('recipient').value,$('subject').value,$('message').value);
        };        
        
        //Create AJAX Browser for INBOX
        function goToInbox()
        {
                var myBrowser;
                if(window.XMLHttpRequest)
                {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                         myBrowser=new XMLHttpRequest();
                }
                else
                {
                        // code for IE6, IE5
                         myBrowser=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                myBrowser.onreadystatechange=function()
                {
                         if (myBrowser.readyState==4 && myBrowser.status==200)
                         {
                                 document.body.innerHTML=myBrowser.responseText;
                         }
                 };
                 
                 myBrowser.open("GET",window.location.href = "http://localhost/cmail/homepage.php",true);
                 //myBrowser.open("GET","http://localhost/cmail/homepage.php",true);
                 myBrowser.send();                
        };
        
        $('inboxButton').onclick = function()
        {
                goToInbox();
        };
        
        //Create AJAX Browser for Logout to messages
        function goToLogout()
        {
                var myBrowser;
                if(window.XMLHttpRequest)
                {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                         myBrowser=new XMLHttpRequest();
                }
                else
                {
                        // code for IE6, IE5
                         myBrowser=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                myBrowser.onreadystatechange=function()
                {
                         if (myBrowser.readyState==4 && myBrowser.status==200)
                         {
                                 document.body.innerHTML=myBrowser.responseText;
                         }
                 };
                 
                 myBrowser.open("GET",window.location.href = "http://localhost/cmail/logout.php",true);
                 myBrowser.send();                
                
        };
        $('logoutButton').onclick = function()
        {
                goToLogout();
        };
        
	
	</script>
</head>

<body>	
	
	<div id="header">
		Welcome to Cheapo Mail
	</div>

	<div id = "navMenu">
		<ul>
			<li id="logoutButton"><a href="#">Logout</a></li>
		</ul>
	</div>
	
	<div id = "leftMenu">
		<ul>
			<li id="inboxButton"><a href="#">Inbox</a></li>
		</ul>
	</div>
	
	<div id="contents">		
		<div id="instructions">			
			<span>Compose Message</span>
		</div>
			
		<form action="#" name="loginForm" id="loginForm" method="post">
			<label for="sender">From:</label>
			<input title="Enter your username here" type="text" name="sender" id="sender" value=<?php echo $_SESSION['currentUser'] ?> />
			
			<label for="recipient">To:</label>
			<input id="recipient" title="Enter recipients username separated by commas" type="text" name="recipient" placeholder="person1,person2" value="" />
			
			<label for="subject">Subject:</label>
			<input id="subject" title="Place the subject of your message here" type="text" name="subject"/>
			
			<label for="message" id="tagM">Message</label>			
			<textarea id="message" name="message" rows="10" cols="24"></textarea>
			
			<input type="button" id="submitButton" class="controller" value="Submit" />
			<input type="reset" class="controller" id="resetButton" value="Clear" />
			
		</form>
		
		<div id="errorMessages">
			
		</div>
		
	</div>
	
</body>
</html>