<html>
<head>
        <title>CheapoMail | Registration</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>                
        <script type="text/javascript" src="prototype.js"></script>
		
		
		
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
									 document.getElementById('registrationForm').innerHTML = loginBrowser.responseText;
							 }
					 };
					 
					 loginBrowser.open("GET", "http://localhost/cmail/login.php",true);
					 loginBrowser.send();                
					
			}
			$('loginButton').onclick = function(){
					goToLogin();
			};
		</script>
</head>

<body>


        
        <div id="header">
                Welcome to Cheapo Mail
        </div>
        
        <div id = "navMenu">
                <ul>
                        <li><a href="login.php">Login</a></li>
                </ul>
        </div>

        
        <div id="contents">                
                <div id="instructions">                        
                        <span>Sign Up</span>
                </div>
                
                <form id="registrationForm" name="registrationForm" action="signup.php" method="post" >
                                                
                        <label for="firstName">First Name</label>
                        <input title="Enter First Name" name="firstName" id = "firstName" type = "text" />
                        <label for="lastName">Last Name</label>
                        <input title="Enter Last Name" name="lastName" id = "lastName" type = "text" />
                        <label for="userName">Username</label>
                        <input title="Enter Username" name="userName" id = "userName" type = "text" />
                        <label for="passWord">Password</label>
                        <input title="Enter Password" name="passWord" id = "passWord" type="password" />
                        <label for="verifyPassword">Verify Password</label>
                        <input title="Re-enter the password please" name="confirmPassword" id = "verifyPassword" type = "password" />                        
                        
                        <input title="Click to submit" class="controller" id="submitButton" value="Sign Up" type="submit" />
                        <input title="Click to clear the form" class="controller" id="resetButton" value="Clear" type="reset" />
                
                </form>        
        </div>        
        
        <!--Start PHP Script-->
        <?php
        //variable declarations
                $fname = $_POST["firstName"];
                $lname = $_POST["lastName"];
                $username = $_POST["userName"];
                $password = $_POST["passWord"];
                $confirmPassword = $_POST["confirmPassword"];
                $body = "";
                $subject = "";
                $userId = "";
                $recipientIDs = "";
                $message_id = "";
                $reader_id = "";
                $date = "";
                
                $formValidStatus = "";
        ?>
        
        <?php
        //check if empty
                if(empty($fname) || empty($lname) || empty($username) || empty($password) || empty($confirmPassword))
                {
                        $notEmpty = FALSE;
                        $notEmptyStatus = "<br/><li class='status' id='error'>No feild should be submitted blank.</li>";                                                                
                }
                else
                {
                        $notEmpty = TRUE;
                        $notEmptyStatus = "";
                }
        ?>
        
        <?php
        #Variables
        $nameStatus = "";
        
        //check if names have only letters        
        $fnameContents = trim($fname);
        $lnameContents = trim($lname);
        
        $lengthF  = strlen($fnameContents);
        $lengthL = strlen($lnameContents);
        
        
        /*First Name*/        
        $tallyF = 0;
        for($i=0; $i < $lengthF; $i++)
        {                
                if($fnameContents[$i] >= "A" && $fnameContents[$i] <="z")
                {
                        $tallyF = $tallyF + 1;
                }
        }
        if($tallyF == $lengthF)
        {
                $lettersF = TRUE;
        }
        
        /*Last Name*/
        $tallyL = 0;
        for($j=0; $j < $lengthL; $j++)
        {                
                if($lnameContents[$j] >= "A" && $lnameContents[$j] <="z")
                {
                        $tallyL = $tallyL + 1;
                }
        }
        if($tallyL == $lengthL)
        {
                $lettersL = TRUE;                
        }
        
        /*Valid Names*/
        if($lettersF && $lettersL)
        {
                $validNames = TRUE;
                $validNamesStatus = "";                
        }
        else
        {
                $validNamesStatus= "<br/><li class='status' id='error'>For our purposes, names should only have letters.(No hiphens, symbols or spaces)</li>";
        }
        
        $nameStatus = $validNamesStatus;
        
        ?>
        
        <?php
        $usernameStatus = "";
        
        //Username validation : greater than three characters, not only numbers, and verify if already in database
        
        #Check 1 : greater than two characters
        if(strlen($username) >= 2)
        {
                $userNameLength = TRUE;
                $userNameLengthStatus = "";
        }else
        {
                $userNameLengthStatus = "<br/><li class='status' id='error'>Usernames should have at LEAST 2 characters</li>";
        }
        
        #Check 2 : Not only numbers
        $userNameContents = trim($username);
        $lengthU  = strlen($userNameContents);
        $tallyU_S = 0;
        $tallyU_I = 0;
        
        for($k=0; $k < $lengthU; $k++)
        {                
                if($userNameContents[$k] >= "A" && $userNameContents[$k] <="z")
                {
                        $tallyU_S = $tallyU_S + 1;
                }
                if(is_int($userNameContents[$k]))
                { 
                        $tallyU_I = $tallyU_I + 1;                        
                }                
        }
        
        if($tallyU_S >= 2 && $lengthU != $tallyU_I && $tallyU_I < $tallyU_S)
        {
                $notOnlyNumbers = TRUE;
                $notOnlyNumbersStatus = "";
        }
        else
        {
                $notOnlyNumbersStatus = "<br/><li class='status' id='error'>Usernames should not only contain numbers.</li>";
        }
        
        #Check 3 : If already exists in database
        
        $con = mysqli_connect("localhost","mailInfo2180","administrator","MailingSystem");
        $sql = "SELECT * FROM User Where Username = '$username'";
        
        $usersWithUsername = mysqli_query($con,$sql);
        
        $allUsers = mysqli_fetch_array($usersWithUsername);
        
        if($allUsers == "")
        {
                $newUserName = TRUE;        
                $newUserNameStatus = "";
        }else
        {
                $newUserNameStatus = "<br/><li class = 'status' id='error'>Sorry, that username is already taken.</li>";
        }
        
        $usernameStatus = $userNameLengthStatus.$notOnlyNumbersStatus.$newUserNameStatus;
        
        #Valid Username
        if($userNameLength && $notOnlyNumbers && $newUserName)
        {
                $validUserName = TRUE;
        }
                
        ?>
        
        <?php
        //Password Validation: Check if both passwords entered are the same
                
               
                $passwordStatus = "";
                $lengthPassword = strlen(trim($password));
                
                
                #check for any letter
                if(preg_match('/[A-Za-z]/',$password)){
                        $passLettersCheck = TRUE;
                        $passLettersCheckStatus = "";
                }else{
                        $passLettersCheckStatus = "<br/><li class='status' id='error'>Password should have at least one letter.</li>";
                }
                
                #check for capital letter
                if(preg_match('/[A-Z]/',$password))
                {
                        $passLettersCapitalCheck = TRUE;
                        $passLettersCapitalCheckStatus = "";
                }else
                {
                        $passLettersCapitalCheckStatus = "<br/><li class='status' id='error'>Password should have at least one Capital letter.</li>";
                }
                
                #check for at least one number
                if(preg_match('/[0-9]/', $password))
                {
                        $passNumCheck = TRUE;
                        $passNumStatus = "";
                }
                else
                {
                        $passNumStatus = "<br/><li class='status' id='error'>Password should have at least one number.</li>";
                }                
                
                #Added Validation
                if($lengthPassword >= 8)
                {
                        $passLengthCheck = TRUE;
                        $passLengthCheckStatus = "";                        
                }
                else
                {
                        $passLengthCheck = FALSE;
                        $passLengthCheckStatus = "<br/><li class='status' id='error'>Password should have at least 8 elements.</li>";
                }
                                                        
                #Check if Passwords Match
                $match = strcmp($password, $confirmPassword);                
                
                if($match == 0)
                {
                        $passMatch =TRUE;
                        $passMatchStatus = "";
                }
                else
                {
                        $passMatchStatus = "<br/><li class='status' id='error'>Passwords should match</li>";
                }
                
                
                $passwordStatus = $passNumStatus.$passLettersCheckStatus.$passLettersCapitalCheckStatus.$passLengthCheckStatus.$passMatchStatus;
                
                
                if($passNumCheck && $passLettersCheck && $passLettersCapitalCheck && $passLengthCheck && $passMatch)
                {
                        $validPassword = TRUE;        
                }
        
        ?>        
        
        <?php
        //Validate entire form        
        
        $formValidStatus = $notEmptyStatus.$nameStatus.$usernameStatus.$passwordStatus;
        
        if($notEmpty && $validNames && $validUserName && $validPassword)
        {
                $validFormData = TRUE;
                $formValidStatus = "<p class='status' id='successful'>Form completed and submitted. Validation complete.</p>";  
        }
        else
        {
                echo "<p class='status' id='error'>Error(s):</p>";
                echo $formValidStatus;
        }
        
        ?>
        
        <?php
        //Create Database and Tables
                include 'database.php';        
        ?>
        
        <?php
        //populate database
        if($validFormData)
        {
                include 'addContent.php';
        }
        
        ?>
                        
             
        
        
</body>
</html>