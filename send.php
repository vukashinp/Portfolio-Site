<?php
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword ="";
	$dbname = "send";
// Create Connection
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
	//Check Connection

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if (empty($name)) {
		echo "First name cant be blank.";
		die();
	}
	if (empty($email)) {
		echo "Mail cant be blank";
		die();
	}
	if (empty($message)) {
		echo "Message cant be blank.";
		die();
	}
	$sql = "INSERT INTO youtube (First name, Email, Phone, Message)
	VALUES('$name', '$email', '$phone', '$message')";
	if ($conn->query($sql) === TRUE) {
		echo "Thank you.";
	}
	$conn->close();
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$from = 'Demo Contact Form'; 
		$to = 'vpcodes@gmail.com'; 
		$subject = 'Message from Contact Demo ';
		
		$body = "From: $name\n E-Mail: $email\n Message:\n $message";
 
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}
 
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		$result="<div class="alert alert-success">Thank You! I will be in touch</div>";
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
	}
}
	}
?>