<?php
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$msg = $_POST["message"];

$to = "al214097@epcc.pt";
$subject = "'".$subject."'";
$txt = "'".$msg."'";
$headers = "From: '".$email."'";

mail($to,$subject,$txt,$headers);
header('Location: ../contact.html');
?> 