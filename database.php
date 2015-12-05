<?php
	
	$con = mysqli_connect("localhost", "mailInfo2180","administrator");
	
	// Verify connection to MySql	
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	// Create MailingSystem database
	$sql="CREATE DATABASE IF NOT EXISTS MailingSystem";
	mysqli_query($con,$sql);
?>

<!--Create Tables-->
<?php
	
	$con = mysqli_connect("localhost","mailInfo2180","administrator","MailingSystem");
	
	// Verify connection to MySql
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySql: " . mysqli_connect_error();
	}
	
	// Create tables
	/*---------------Table: User-------------*/
	$sql1 = "CREATE TABLE IF NOT EXISTS User
	(
		ID INT NOT NULL AUTO_INCREMENT,
		Firstname CHAR(20),
		Lastname CHAR(20),
		Password CHAR(15),
		Username CHAR(15),
		PRIMARY key(ID) 
	)";
	
	/*---------------Table: Message-------------*/
	$sql2 = "CREATE TABLE IF NOT EXISTS Message
	(
		ID INT NOT NULL AUTO_INCREMENT,
		Body CHAR(255),
		Subject CHAR(20),
		User_id CHAR(15),
		Recipient_ids CHAR(30),
		PRIMARY key(ID) 
	)";
	
	
	/*---------------Table: Message_read-------------*/
	$sql3 = "CREATE TABLE IF NOT EXISTS Message_read
	(
		ID INT NOT NULL AUTO_INCREMENT,
		Message_id CHAR(15),
		Reader_id CHAR(30),
		Date CHAR(10),
		PRIMARY key(ID)
	)";
	
	//Add tables
	/*---------Add: User--------*/
	mysqli_query($con,$sql1);
  	
	/*---------Add: Message--------*/
	mysqli_query($con,$sql2);
  	
	/*---------Add: Message_read--------*/
	mysqli_query($con,$sql3);
	
?>