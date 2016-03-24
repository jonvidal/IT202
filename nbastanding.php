<?php
  session_start();
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
  }else{
    header('Location: accessdenied.php');
  }
  
  require_once("logindb.php.inc");
  $login = new localDB("connect.ini");
  $response = $login->nbaStandings();
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA Standings</title>
</head>

<body>
<div id="Holder">
<div id="Header"><a href="index.php" title="Home"><img src="logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>
<div style="float:right;"><?php echo $x?></div>
</div>

<div id="NavBar">
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


<div id="SubBar">
<ul>
  <li><a href="nba.php">Teams</a></li>
  <li><a href="nbastanding.php" class="active">Standings</a></li>
  <li><a href="players.php">Players</a></li>

</ul>
</div>


<div id="Content">
  <?php echo $response;?>
  

</div>
</div>
</body>
</html>