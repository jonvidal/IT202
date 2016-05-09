<?php
  session_start();
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<p class='welcome'>Welcome, <a class='removealine' href='account.php' title=''>".$_SESSION['username']."</a></p>";
  }else{
    header('Location: accessdenied.php');
  }
  
  require_once("logindb.php.inc");
  $login = new localDB("connect.ini");
  $response = $login->allnbaplayers();
  
  include ("permissions.php");
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA Standings</title>
</head>

<body>
<div class="container" id="Holder">
<div class="container" id="Header"><a href="index.php" title="Home"><img src="logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>
<div style="float:right;"><?php echo $x?></div>
</div>

<div class="container" id="NavBar">
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


<div class="container"  id="SubBar">
<ul>
  <li><a href="nba.php">Teams</a></li>
  <li><a href="nbastanding.php">Standings</a></li>
  <li><a href="players.php" class="active">Players</a></li>
  <?php echo $permissions;?>
</ul>
</div>


<div class="container" id="Content">
  <div style="overflow:scroll; overflow-x:hidden;border:1px solid black; width:100%; height:600px;">
  <p class='lead'>Search a player...</p>
  <div align='center'> <input type="text" class="form-control" id="search" placeholder="Type to search..." style="width:80%;"></div>
  <br/>
  <?php echo $response;?>
  </div>
</div>
</div>
<script>
var $rows = $('#myTable tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
</script>
</body>
</html>
