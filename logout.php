<?php 
	session_start(); 
	session_destroy();
?>

<html>
<head>
	<title>Cheapo Mail | User Login</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	
	<script type="text/javascript" src="prototype.js"></script>
	
	<script>
	
	
			 //Create AJAX Browser for Logout to messages
        function goToLogin()
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
                 
                 myBrowser.open("GET",window.location.href="http://localhost/cmail/login.php",true);
                 myBrowser.send();                
                
        }
        $('loginButton').onclick = function()
        {
                goToLogin();
        };
			
	</script>
</head>

<body>
	
	<!--START HTML PAGE WITH MAIN ELEMENTS-->
	<div id="header">
		Welcome to Cheapo Mail
	</div>
	
	<div id = "navMenu">
		<ul>
			<li><a href="#" id="loginButton">Login</a></li>
		</ul>
	</div>
	
	
	<div id="contents">		
		<div id="instructions">			
			<span>Thank you for visiting.</span>
		</div>
		
	</div>
	
	<form>
		<p>You have successfully logged out.Thank you for your visit. </p>
	</form>
	<!--END HTML PAGE WITH MAIN ELEMENTS-->	
		
</body>
</html>