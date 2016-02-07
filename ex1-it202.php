/*
* Exercise 1
* Jonathan Vidal
*/

#!/usr/bin/php
<?php
echo "Exercise #1".PHP_EOL;
$myarr = array("1"=>"one", "2"=>"two", "3"=>"three");
var_dump($myarr);

function displayMsg(){
  echo "ARRAY EMPTY".PHP_EOL;
}

function insertElem($key, $newvalue = NULL, array $newarr = NULL ) {
  if ($newarr === NULL){
    displayMsg();
  }
  else {
    $newarr[$key] = $newvalue;
    echo "inserted: ".$key." => ".$newarr[$key].PHP_EOL;
    echo "elements in the array: ".PHP_EOL;
    foreach ($newarr as $x => $xvalue) {
      echo "   key= ".$x." value= ".$xvalue.PHP_EOL;
    }
    return $newarr;
  }
}

function deleteElem($key, array $newarr = NULL){
  if ($newarr === NULL){
    displayMsg();
    return NULL;
  }
  else {
    if (array_key_exists($key, $newarr)){
      echo "removed: ".$key." => ".$newarr[$key].PHP_EOL;
      unset($newarr[$key]);
      echo "elements in the array: ".PHP_EOL;
      foreach ($newarr as $x => $xvalue) {
        echo "   key= ".$x." value= ".$xvalue.PHP_EOL;
      }
      return $newarr;
    }
  }
}
$arr = insertElem("5","five");
$arr = insertElem("4", "four", $myarr);
$arr = deleteElem("3", $arr);
print_r($arr);
echo "value: ";
for ($i = 0; $i < count($arr); $i++) {
  echo $arr[$i]." ";
}
echo PHP_EOL;

?>
