<?php 
	session_start(); 
	$thisUser = $_SESSION['currentUser'];
?>

<html>
<head>
	<title>Cheapo Mail | User </title>
	<link type="text/css" rel="stylesheet" href="style.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js" type="text/javascript"></script>
	
	<script>
	
	//Declare Variables
        var message = document.getElementsByClassName("messageContent");
        var sender = document.getElementsByClassName("senderName");
        var topic = document.getElementsByClassName("subject");
        
        //these will store the subject and sender's name
        var subjectD ="";
        var senderD="";
        
        //Create AJAX Browser for getting VALIDATION MESSAGES
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
                                 document.getElementById("info").innerHTML=xmlhttp.responseText;
                         }
                 };
                 
                 xmlhttp.open("GET","http://localhost/cmail/reply_Val.php?senderDATA=" + a + "&recipientDATA=" + b +"&subjectDATA=" + c + "&messageDATA=" + d,true);
                 xmlhttp.send();
                 
        }                        
        $('submitButton').onclick = function()
        {
                getValidationMessage($('sender').value,$('recipient').value,$('subject').value,$('message').value);
        };
        
        //Create AJAX Browser for getting Messages
        function getMessage(x,y,z)
        {
                 var xmlhttp;
                 if (window.XMLHttpRequest){
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
                                 document.getElementById("messageBody").innerHTML=xmlhttp.responseText;
                         }
                 };
                 
                 xmlhttp.open("GET","http://localhost/cmail/getMessage.php?senderD=" + x + "&subjectD=" + y + "&messageRead=" + z,true);
                 xmlhttp.send();
                 
        }''
        
        /*Will output messages*/        
        
        //function to access feild data
        function getText(element)
        {
                return element.innerHTML;
        }
        
        var messageRead = 0;
        
        /*Assign values to represent sender name and subject description when message is clicked*/
        message[0].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[0]);
                subjectD = getText(topic[0]);
        
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[1].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[1]);
                subjectD = getText(topic[1]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[2].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[2]);
                subjectD = getText(topic[2]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[3].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[3]);
                subjectD = getText(topic[3]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[4].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[4]);
                subjectD = getText(topic[4]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[5].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[5]);
                subjectD = getText(topic[5]);
        
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[6].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[6]);
                subjectD = getText(topic[6]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[7].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[7]);
                subjectD = getText(topic[7]);
                 
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[8].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[8]);
                subjectD = getText(topic[8]);
                
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        message[9].onclick = function()
        {
                //store content of feilds
                senderD = getText(sender[9]);
                subjectD = getText(topic[9]);
        
                messageRead = 1;
                getMessage(senderD,subjectD,messageRead);
        };
        
        /*END OUTPUT MESSAGES*/
        
        
        //Create AJAX Browser for Composing messages
        function goToCompose()
        {
                var composeBrowser;
                if(window.XMLHttpRequest)
                {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                         composeBrowser=new XMLHttpRequest();
                }
                else
                {
                        // code for IE6, IE5
                         composeBrowser=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                composeBrowser.onreadystatechange=function()
                {
                         if (composeBrowser.readyState==4 && composeBrowser.status==200)
                         {
                                 document.body.innerHTML=composeBrowser.responseText;
                         }
                 };
                 
                 composeBrowser.open("GET",window.location.href="http://localhost/cmail/compose.php",true);
                 composeBrowser.send();                
                
        }
        document.getElementById('composeButton').onclick = function()
        {
                goToCompose();
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
                 
                 myBrowser.open("GET",window.location.href="http://localhost/cmail/logout.php",true);
                 myBrowser.send();                
                
        }
        document.getElementById('logoutButton').onclick = function()
        {
                goToLogout();
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
			<li><a href="#" id="logoutButton">Logout</a></li>
		</ul>
	</div>
	
	<div id = "leftMenu">
		<ul>
			<li><a href="#" id="composeButton">Compose</a></li>
		</ul>
	</div>
	
	<div id="contents">		
		<div id="inboxStuff">			
			<span>Welcome to your inbox, <?php echo $_SESSION["currentUser"]; ?></span>
		</div>
		<div id="mainContent">
					
i
	
	
	
	<?php
		include 'database.php';
	?>
	
	<?php
	//Get ID of Current User
		$resultID = mysqli_query($con, "SELECT * FROM User Where Username = '$thisUser'");
		while($row = mysqli_fetch_array($resultID))
		{
			$thisUserID = $row['ID'];
		}
		$userID = $thisUserID;
	?>

	<?php
	/*Display inbox of this user*/
	$con = mysqli_connect("localhost","mailInfo2180","administrator","MailingSystem");
	// Check connection
	if (mysqli_connect_errno())
	{
		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($con,"SELECT * FROM Message WHERE Recipient_ids = '$userID' ORDER BY `ID` DESC LIMIT 10");		
	
	
	
	echo "<table>
		<tbody>
		<tr>
		<th>Subject</th>
		<th>Sender</th>
		</tr>";
	$currentSenderID = "";
	
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr title='Click to read' class='messageContent'>";
		//echo "<td class='subject'>" . $row['Subject'] . "</td>";
		$currentSenderID = $row['User_id'];
		$message_id = $row['ID'];
		
		echo $currentSenderID;
		
		
		
		
		//Get Username of Sender for better readability
		$resultNames = mysqli_query($con, "SELECT * FROM User Where ID = '$currentSenderID'");
		while($rowName = mysqli_fetch_array($resultNames))
		{
			$thisUserName = $rowName['Username'];
		}
		$senderUserName = $thisUserName;
		
		//Test to see if the attributes, message ID
		$readMessage = mysqli_query($con,"SELECT * FROM Message_read WHERE Reader_id = '$currentSenderID' AND Message_id = '$message_id'");	
		$messagesRow = mysqli_fetch_array($readMessage);
		
		$senderUserName = $thisUserName;
	
		if(empty($messagesRow))
		{
			$inDatabase = FALSE;
		}
		else
		{
			$inDatabase = TRUE;
		}
		
		if($inDatabase)
		{
			echo "<td class='subject' style='color:black'>" . $row['Subject'] . "</td>";
			echo "<td class='senderName' style='color:black'>" . $senderUserName. "</td>";
		}
		else
		{
			echo "<td class='subject' style='color:blue'>" . $row['Subject'] . "</td>";
			echo "<td class='senderName' style='color:blue'>" . $senderUserName. "</td>";
		}
		
		echo "</tr>";
	};
	
	echo "<tr>";
	echo "<td></td>";
	echo "<td></td>";
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
	
	
	?>
	<!--Show message-->
	<div id="messageBody">
		<p style="color:black; font-style:italic" class="ajaxOutput">Select a message to view here...</p>
	</div>
	</div><!--End main content-->
	<!-- <div id="replyContent">'Reply' should appear here</div> -->
	</div><!--End content-->
		
	
	<form action="#" name="replyForm" id="replyForm" method="post">	
	
	<label for="sender">From:</label>
	<input title="Enter your username here" type="text" name="sender" id="sender" value=<?php echo $_SESSION['currentUser'] ?> />
	
	<label for="recipient">Reply-To</label>
	<input title="The person you got this mail from" type="text" name="recipient" id="recipient" />
	
	<label for="subject">Subject</label>
	<input title="The subject of your message here." type="text" name="subject" id="subject" />
	
	
	<div id="effectForm"></div>
	
	
	<textarea name="message" id="message" rows="10" cols="24"></textarea>
	
	<input type="button" class="controller" id="submitButton" value="Reply" />
	<input type="reset" class="controller" id="resetButton" value="Clear" />
	
	</form>

<div id="validationResults">
	<!--This will store PHP generated results-->
	<h3>Validation Status</h3>
	<div id="info"></div>
	
</div>
	
		
</body>
</html>