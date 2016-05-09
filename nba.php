<?php
  session_start();
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
  }else{
    header('Location: accessdenied.php');
  }
  
  require_once("logindb.php.inc");
  $login = new localDB("connect.ini");
  $response = $login->nbaTeams();
  
  include("permissions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA</title>
</head>

<body>
<div  class="container" id="Holder">
<div   class="container" id="Header"><a href="index.php" title="Home"><img src="logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>
<div style="float:right;"><?php echo $x?></div>
</div>

<div  class="container" id="NavBar">
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="nfl.php">NFL</a></li>
  <li><a href="nba.php" class="active">NBA</a></li>
  <ul style="float:right;list-style-type:none;">
    <li><a href="#">About</a></li>
    <li><a href="account.php">My Account</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</ul>
</div>


<div  class="container" id="SubBar">
<nav>
<ul>
  <li><a href="nba.php" class="active">Teams</a></li>
  <li><a href="nbastanding.php">Standings</a></li>
  <li><a href="players.php">Players</a></li>
   <?php echo $permissions;?>
</ul>
</nav>
</div>


<div  class="container" id="Content">
<h3 style="margin:0px;"><strong>Headlines</strong></h3>
<div style="width:10%;float:right;padding-right:10px;"><img style="float:right;" src="nbateams/img/nbalogo.png" alt="NBA Logo" width="70px" height="150px"/></div>
  <div  class="container" style="width:90%; border:1px solid black;height:150px;padding-
      right:50px;font-size:10px;margin:0px;padding-left:5px;">
      <?php 
      $xml=("http://www.rotoworld.com/rss/feed.aspx?sport=nba&ftype=news&count=12&format=rss");

      $xmlDoc = new DOMDocument();
      $xmlDoc->load($xml);

      //get elements from "<channel>"
      $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
      $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
      $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
      $channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

      //get and output "<item>" elements
      $x=$xmlDoc->getElementsByTagName('item');
      for ($i=0; $i<=2; $i++) {
	$item_title=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
	$item_link=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
	$item_desc=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
	echo ("<p><a href='" . $item_link. "'>" . $item_title . "</a>");
	echo ("<br>");
	echo ($item_desc . "</p>");
	}
?>
      
      </div>
  <div><h3 style="margin-top:3px;margin-bottom:5px;"> NBA Team</h3></div>
  <div><?php echo $response;?></div>
  
</div>
</div>
</body>
</html>