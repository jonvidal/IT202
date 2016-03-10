<?php

require_once("logindb.php.inc");


$request = $_POST['username'];

switch($request)
{
    case "Login":
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = new localDB("connect.ini");
	$response = $login->validateUser($username,$password);
	if ($response['success']===true)
	{
		
		$response = "Login Successful!<p>";
	}
	else
	{
		$response = "Login Failed: ".$response['message']."<p>";
	}
	break;
    case "Sign Up":
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $emailAd = $_POST['emailAd'];
      $userName = $_POST['userName'];
      $userPW = $_POST['userPW'];
      $register = new localDB("connect.ini");
      $response = $register->addNewUser($userName, $userPW, $firstName, $lastName, $emailAd);
      if ($response['success']===true)
	{
		$response = "Registration Successful!<p>";
	}
	else
	{
		$response = "Registration Failed:".$response['message']."<p>";
	}
	break;
}

echo $response;
?>


