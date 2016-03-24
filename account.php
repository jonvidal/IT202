<?php
  session_start();
  if (isset( $_POST['addteam'] ) && isset( $_SESSION['username'] ) ){
   require_once('logindb.php.inc');
   $login = new localDB("connect.ini");
   $result = $login->addplayer( $_POST['addteam'], $_SESSION['username'] );
  }
  
  if(isset($_POST['removeplayer']) && isset($_SESSION['username'])){
    require_once('logindb.php.inc');
    $login=new localDB("connect.ini");
    $result = $login->removeplayer( $_POST['removeplayer'], $_SESSION['username']);
  }
  
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
  require_once('logindb.php.inc');
  $login = new localDB("connect.ini");
  $response = $login->myteam( $_SESSION['username'] );
  }else{
    header('Location: accessdenied.php');
  }
  
 
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Sport Guide</title>
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
  <li><a href="nba.php">NBA</a></li>
  <ul style="float:right;list-style-type:none;">
    <li><a href="#">About</a></li>
    <li><a href="account.php" class="active">My Account</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</ul>
</div>


<div id="Content">
  <div style="float:right;font-size:12px;padding-right:50px;padding-top:50px;color:red;font-weight:bolder;"><?php echo $result; ?></div>
  <p class='in-p'>myTeam</p>
  <div class="in-content"><?php echo $response;?></div>
</div>
</body>
</html>