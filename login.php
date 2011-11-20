<?php
///////////////////////////////////////////////
//  change the pin to a value of your choice //
//  Note: it must be an integer to use the   //
//  provided keypad							 //
///////////////////////////////////////////////
$set_pin = 1234;

session_start();

$pin = $_POST['pin'];
$pin = stripslashes($pin);

if ($pin == $set_pin) {
	 $_SESSION['loggedIn'] = "true";
	 header("Location: relay_control.html");
} else {
	 $_SESSION['loggedIn'] = "false";
	 //header("Location: index.html");
	header("ERROR: 1");
}
?>

