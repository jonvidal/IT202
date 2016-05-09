<?php
  session_start();
  if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
  }else{
    header('Location: accessdenied.php');
  }
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Sport Guide</title>
</head>

<body>
<div class="container" id="Holder">
<div class="container" id="Header"><a href="index.php" title="Home"><img src="logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>
<div style="float:right;"><?php echo $x?></div>
</div>
<div class="container" id="NavBar" style='width:980px !important;'>
<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="nfl.php">NFL</a></li>
  <li><a href="nba.php">NBA</a></li>
  <ul style="float:right;list-style-type:none;">
    <li><a href="#">About</a></li>
    <li><a href="account.php">My Account</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</ul>
</div>
<div class="container" id="Content"> </div>
</div>
</body>
</html>