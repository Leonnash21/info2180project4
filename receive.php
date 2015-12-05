<?php
//setupDatabase
	include 'database.php';
//connect to database
	$con = mysqli_connect("localhost", "mailInfo2180","administrator","MailingSystem");
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
//get values of variables in javascript
	$senderName = $_GET['senderD'];
	$subjectMessage = $_GET['subjectD']; 
	$checkRead = $_GET['messageRead'];


//get userid of the sender
	$resultID = mysqli_query($con, "SELECT * FROM User Where Username = '$senderName'");
	while($row = mysqli_fetch_array($resultID)){
		$senderID = $row['ID'];
	}
	$userId = $senderID;
	
//getMessageDetails to add to table Message_read
	#getMessageID
	$messageDetails = mysqli_query($con,"SELECT * FROM Message WHERE User_id = '$userId' AND Subject = '$subjectMessage'");
	while($detailsRow = mysqli_fetch_array($messageDetails)){
		$messageID = $detailsRow['ID'];
	}
	$message_id = $messageID; //message ID
	$reader_id = $userId;//reader ID
	$date =  date("Y-m-d");
	
//add Message Details to Message_read Table
	//For Messages_read
	$sql3 = "INSERT INTO Message_read(Message_id, Reader_id, Date) 
	VALUES
	(
		'$message_id',
		'$reader_id',
		'$date'
	)";
	
	#check to ensure that the message is only added to the list if it wasnt there before
	$readMessage = mysqli_query($con,"SELECT * FROM Message_read WHERE Reader_id = '$reader_id' AND Message_id = '$message_id'");
	$messagesRow = mysqli_fetch_array($readMessage);
	
	if(empty($messagesRow)){
		$justRead = TRUE;
	}else{
		$justRead = FALSE;
	}
	
	#add Record to Message_read if just read for first time
	if($justRead){
		if (!mysqli_query($con,$sql3)){
			die('Error: ' . mysqli_error($con));
		}		
	}
	
//search for message with sender's name and subject
	$messageContent = mysqli_query($con,"SELECT * FROM Message WHERE User_id = '$userId' AND Subject = '$subjectMessage'");
	while($dataRow = mysqli_fetch_array($messageContent)){
		$messageStuff = $dataRow['Body'];
	}
	$messageBody = $messageStuff;
	
	$name = strtoupper($senderName);
	
	$header = "<span style=color:black>".$name." | ".$subjectMessage."</span>";
	echo "<p class='ajaxOutput' id='messageData'>".$header."<br/><br/>".$messageBody."</p>";
?>