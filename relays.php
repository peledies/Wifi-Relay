<?php
//////////////////////////////////////////
// change host to the IP of your device //
//////////////////////////////////////////
$host="10.10.10.10";

///////////////////////////////////
// Do NOT modify from here down  //
///////////////////////////////////
$port = 4998;

// Check to assure that both required valus have been sent
if(isset($_POST['relay']) && isset($_POST['state']))
{
$relay = $_POST['relay'];
$state = $_POST['state'];
if(isset($_POST['pulseDuration']))
{
	$pulseDuration = $_POST['pulseDuration'];
}

	if($state == 'on')
	{
		$message ="setstate,1:".$relay.",1\r";
		controlRelay($host,$port, $relay, $state, $message);
	}
	elseif($state == 'off')
	{
		$message ="setstate,1:".$relay.",0\r";
		controlRelay($host,$port, $relay, $state, $message);
	}
	elseif($state == 'pulse')
	{
		$message ="setstate,1:".$relay.",1\r";
		controlRelay($host,$port, $relay, $state, $message);
		sleep($pulseDuration);
		$message ="setstate,1:".$relay.",0\r";
		controlRelay($host,$port, $relay, $state, $message);
	}
}

function controlRelay($host, $port, $relay, $state, $message)
{

	// open a client connection
	$fp = fsockopen ($host, $port, $errno, $errstr, 10);
	
	// Set the stream fsockopen timeout
	stream_set_timeout($fp, 2);
	
	if (!$fp)
	{
		$result = "Error: could not open socket connection";
	}
	else
	{
		// write the user string to the socket
		fputs ($fp, $message);

		// get the result
		$result = fgets ($fp, 1024);

		// close the connection
		fputs ($fp, "END");
		fclose ($fp);

		echo $result;
	}
}
?>