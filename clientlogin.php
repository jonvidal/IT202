#!/usr/bin/php
<?php

require_once("clientDB.php.inc");

$command = $argv[1];

switch($command){
  case 'register':
    $name = $argv[2];
    $password = $argv[3];
    $db = new clientDB();
    $db->addNewClient($name, $password);
    break;
    
  case 'login':
    $name = $argv[2];
    $password = $argv[3];
    $db = new clientDB();
    if ($db->addNewClient("DJ", "123")==0){
      echo "Invalid".PHP_EOL;
    }
    else echo "Login Success".PHP_EOL;
    break;
  default:
	echo "usage:\n".$argv[0]." [register|login] <username> <password>".PHP_EOL;
	break;
}
//$db = new clientDB();
//$db->addNewClient("DJ", "123");

//if ($db->addNewClient("DJ", "123")==0){
  //echo "Invalid".PHP_EOL;
//}
//else echo "Login Success".PHP_EOL;
?>