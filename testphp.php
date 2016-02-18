#!/usr/bin/php
<?php
echo "begin script ".$argv[0].PHP_EOL;

class myStudent{
  private $name;
  private $address;
  private $gpa;
  private $year;
  public $major;
  public function __construct($name){
    $this->name = $name;
  }
  public function printName(){
   echo "name: ".$this->name.PHP_EOL;
  }
  public function setGPA($gpa){
    $this->gpa = $gpa;
    echo "gpa ".$this->gpa.PHP_EOL;
  }
}


$myStudent = new myStudent("Steve");
$myStudent->major = "Computer Science";
$myStudent->setGPA(2.3);
$myStudent->printName();

/*
$var = "some value";
$number = 412342134;
$realNumber = 12341234.1241241;
$arr = array();
$arr[] = 5;
$arr[] = "words";
$arr[] = 5345.2342;
$arr[] = array("food", "water", "shelter", "heart");
print_r($arr);

var_dump($arr);
echo "end script ".$argv[0].PHP_EOL;

*/
?>