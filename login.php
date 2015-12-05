<?php 
	session_start(); 
	$_SESSION['currentUser'] = $_POST['userName'];
?>


<html>
<head>
	<title>Cheapo Mail | User Login</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	
	<script src="prototype.js" type="text/javascript"></script>
	
	<script>
	
	//Create AJAX Browser for Composing messages
        function goToLogin()
        {
                var loginBrowser;
                if(window.XMLHttpRequest)
                {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                         loginBrowser=new XMLHttpRequest();
                }
                else
                {
                        // code for IE6, IE5
                         loginBrowser=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                loginBrowser.onreadystatechange=function()
                {
                         if (loginBrowser.readyState==4 && loginBrowser.status==200)
                         {
                                 document.body.innerHTML=loginBrowser.responseText;
                         }
                 };
                 
                 loginBrowser.open("GET",window.location.href = "http://localhost/cmail/admin.php",true);
                 loginBrowser.send();                
                
        }
        $('registerButton').onclick = function()
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
			<li><a href="#" id="registerButton">Register</a></li>
		</ul>
	</div>

	
	<div id="contents">		
		<div id="instructions">			
			<span>User Login</span>
		</div>
		
		<form action="login.php" name="loginForm" id="loginForm" method="post">
			<label for="userName">Username:</label>
			<input title="Enter your username please" type="text" name="userName" id="userName" />
			
			<label for="password">Password:</label>
			<input title = "Enter your password please" type="password" name="passWord" id="password" />
			
			<input type="submit" class="controller" id="submitButton" value="Login"/>
			<input type="reset" class="controller" id="resetButton" value="Clear"/>
			
		</form>
	</div>
	<!--END HTML PAGE WITH MAIN ELEMENTS-->	
	
	<!--START PHP  --- TRY USING INCLUDES STATEMENT-->
	<?php
		include 'database.php';
	?>
		
	<?php
	//basically just prevent data to be sent to database if it is wrong.
		$userName = $_POST["userName"];
		$password = $_POST["passWord"];
		$currentUserName = $userName;
	?>
	
	<?php
	//test data entered 
	
	if($userName != "" && $password != "")
	{
		$notEmpty = TRUE;
	}
	?>
	
	<?php
	//test if user matches any in database		
	$con = mysqli_connect("localhost","mailInfo2180","administrator","MailingSystem");
	
	// Verify connection to MySql
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
	
	
	//get user check
	$resultUsers = mysqli_query($con, "SELECT * FROM User Where Username = '$userName'");
	
	$names = mysqli_fetch_array($resultUsers);
	
	if($names != "")
	{
		$userCheck = TRUE;	
	}
	
	//get password exists check	
	$resultPasswords = mysqli_query($con, "SELECT Password FROM User Where Username = '$userName'");//this query returns an array		
	
	$userPassword = mysqli_fetch_array($resultPasswords);
	
	if($userPassword != "")
	{
		$passwordExistsCheck = TRUE;
	}
	
	//verify if password corresponds with user
	$resultUserForPassword = mysqli_query($con, "SELECT Username FROM User Where Password = '$password'");
	
	$userPassCheck = mysqli_fetch_array($resultUserForPassword);
	
	if($userPassCheck != "")
	{
		$userPasswordMatch = TRUE;
	}
	
	if($userCheck && $passwordExistsCheck && $userPasswordMatch && $notEmpty)
	{
		echo "<br><p class='status' id='successful'>That entry successful. Everything matches</p>";
		header("Location: homepage.php");			
	}
	else
	{
		echo "<br><p class='status' id='error'>Error: Invalid Username or Password</p>";
	}
	
	?>
	<!--END PHP-->	
</body>
</html>