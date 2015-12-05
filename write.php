<?php 
	session_start(); 
	$thisUser = $_SESSION['currentUser'];
?>

	<div id="contents">		
		<div id="instructions">			
			<span>Compose Message</span>
		</div>
			
		<form action="compose.php" name="loginForm" id="loginForm" method="post">
			<label for="sender">From:</label>
			<input title="Enter your username here" type="text" name="sender" id="sender" value=<?php echo $_SESSION['currentUser'] ?> />
			<label for="recipient">To:</label>
			<input title="Enter recipients username separated by commas" type="text" name="recipient" id="recipient" />
			<label for="subject">Subject:</label>
			<input title="Place the subject of your message here." type="text" name="subject" id="subject" />
			<label for="message" id="tagM">Message</label>			
			<textarea name="message" id="message" rows="10" cols="24"></textarea>
			
			<input type="submit" class="controller" id="submitButton" value="Send" />
			<input type="reset" class="controller" id="resetButton" value="Clear" />
			
		</form>
	</div>
	
	<!--Start PHP Validation-->
	<?php
		include 'database.php';
	?>
	
	<?php
	// Declare Variables
		$sender = $_POST["sender"];
		$recipient = $_POST["recipient"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$statusMessage = "";
		$body = $message;
		$userId = "";
		$recipientIDs = "";	
	?>
	
	<?php
	//this returns the list of recipients separated by commas in array 'recipients'
		$mailingList = $recipient;
		$recipients = (explode(",", $mailingList));
	?>
	
	<?php
	//Verify if empty
	
	if($sender != "" && $recipient != "" && $subject != "" && $message != ""){
		$notEmpty = TRUE;
		$statusEmpty = "";
	}else{
		$statusEmpty = "<br/><li class='status' id='error'>All feilds are required.</li>";
	}
	?>
	
	<?php
	$differentCheck = 0;
	
	//Ensure that they are different
	for($a = 0; $a < count($recipients); $a++){
		if($sender != $recipients[$a]){
			$differentCheck += 1;
		}		
	}
	if($differentCheck == count($recipients)){
		$diffUser = TRUE;
	}else{
		$diffUser = FALSE;
		$mailingListStatus = "<br/><li class='status' id='error'>The sender and the reciever(s) should be different.</li>";
	}
	
	?>
	
	
	<?php
	//test if user matches any in database		
	$con = mysqli_connect("localhost","mailInfo2180","administrator","MailingSystem");
	
	// Verify connection to MySql
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
	
	//get user check - sender
	$resultSender = mysqli_query($con, "SELECT * FROM User Where Username = '$sender'");
	$senderArray = mysqli_fetch_array($resultSender);
	
	if($senderArray != 0){
		$senderCheck = TRUE;
		$statusSender = "";
	}else{
		$statusSender = "<br/><li class='status' id='error'>That sender is not a registered Cmail user.</li>";
	}
	
	if($thisUser != $sender){
		$sameUserCheck = FALSE;
		$sameUserStatus = "<br/><li class='status' id='error'>Sender should be your username.</li>";
	}else{
		$sameUserCheck = TRUE;
		$sameUserStatus = "";
	}
	
	//get user check - recipient
	$check = 0;
	$notValidUsers = "";
	$checkUsers = "";
	
	for($b=0; $b < count($recipients); $b++){
		$resultUsers = mysqli_query($con, "SELECT * FROM User Where Username = '$recipients[$b]'");
		$names = mysqli_fetch_array($resultUsers);
		if($names != 0){
			$check += 1;
		}else{
			$notValidUsers = $notValidUsers.$recipients[$b]." ";
		}		
	}
	if($check == count($recipients)){
		$recipientCheck = TRUE;
		$statusRecipient = "";
	}else{
		$recipientCheck = FALSE;
		$statusRecipient = "<br/><li class='status' id='error'>That recipient is not a registered CMail user.</li>";
		$checkUsers = "<br/><li class='status' id='error'>Verify the following: ".$notValidUsers."</li>";
	}
	
	?>
	
	<?php
	$statusMessage = $statusEmpty.$mailingListStatus.$statusSender.$sameUserStatus.$statusRecipient.$checkUsers;
	
	if($senderCheck && $sameUserCheck && $recipientCheck && $diffUser && $notEmpty){
		$statusMessage = "<br><p class='status' id='successful'>Validation Complete. Message Sent!</p>";
		$messageValid = TRUE;
		echo $statusMessage;
	}else{
		echo "<br/><p class='status' id='error'>Error(s):</p>";		
		echo $statusMessage;
	}
	?>
	<!--End PHP Validation-->
	
	<!--PHP add Message to appropriate User-->
	<?php
	//Declare Message Variables
	$senderID = "";
	$recipientID = "";
	$allRecipients = "";
	
	//Connect to Database
	$con = mysqli_connect("localhost", "mailInfo2180","administrator","MailingSystem");
	
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
	
	?>
	
	<?php
	//Get ID of Current User(should be done using php sessions) and recipient ID(s)
		$resultID = mysqli_query($con, "SELECT * FROM User Where Username = '$sender'");
		while($row = mysqli_fetch_array($resultID)){
			$senderID = $row['ID'];
		}
		$userId = $senderID;
	?>
	
	<?php
	
	//Get ID of recipients	
	for($c = 0; $c<count($recipients); $c++){
		$resultID1 = mysqli_query($con, "SELECT * FROM User Where Username = '$recipients[$c]'");
		while($row = mysqli_fetch_array($resultID1)){
			$recipientID = $row['ID'];
		}
		$recipientIDs = $recipientID;
		//For Messages
		$sql = "INSERT INTO Message(ID, Body, Subject, User_id, Recipient_ids)
		VALUES
		(
			'id',
			'$body',
			'$subject',
			'$userId',
			'$recipientIDs'
		)";
		
		if($messageValid){
			if (!mysqli_query($con,$sql)){
				die('Error: ' . mysqli_error($con));
			}
		}		
	}	
	?>		

	
</body>
</html>