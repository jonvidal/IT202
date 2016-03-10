<?php
  session_start();
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
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
<form id="form-layout">
<input id="search" type="text" placeholder="Search..." >
<input id="button" type="button" value="Search">
</form>
</div>
<div id="NavBar">
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="#NFL">NFL</a></li>
  <li><a href="#NBA">NBA</a></li>
  <ul style="float:right;list-style-type:none;">
    <li><a href="#">About</a></li>
    <li><a href="account.php" class="active">My Account</a></li>
    <li><a href="#">Log Out</a></li>
  </ul>
</ul>
</div>
<div id="Content">

 <?php echo $x;?>
  
</div>
</div>
</body>
</html>