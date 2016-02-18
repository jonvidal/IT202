#!/usr/bin/php
<?php
$db = new mysqli("localhost", "root", "Pinoy1992", "it202");
/*
    in here we can access the DB if it worked
*/
if ($db->connect_errno>0){
  echo __FILE__.__LINE__." ERROR ".$db->connect_error.PHP_EOL;
  exit(-1);
}
echo "We are connected to the Database".PHP_EOL;
$query ="select * from Student;";
$results = $db->query($query);
print_r($results);

while($row = $results->fetch_assoc()){
  print_r($row);
}
$db->close();


?>