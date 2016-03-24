<?php
  session_start();
   if ( isset( $_SESSION['username'] ) ){
  $x =  "<span class='welcome'>Welcome, ".$_SESSION['username']."</span>";
  }else{
    header('Location: accessdenied.php');
  }
  
  require_once("../logindb.php.inc");
  $login = new localDB("connect.ini");
  $teamId = 4;
  $response = $login->nbaSelTeam($teamId);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA</title>
</head>

<body>
<div id="Holder">
<div id="Header"><a href="index.php" title="Home"><img src="../logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>

</div>

<div id="NavBar">
<ul>
  <li><a href="../index.php">Home</a></li>
  <li><a href="../nfl.php">NFL</a></li>
  <li><a href="../nba.php" class="active">NBA</a></li>
  <ul style="float:right;list-style-type:none;">
    <li><a href="#">About</a></li>
    <li><a href="../account.php">My Account</a></li>
    <li><a href="#">Log Out</a></li>
  </ul>
</ul>
</div>


<div id="SubBar">
<ul>
  <li><a href="../nba.php" class="active">Teams</a></li>
  <li><a href="../nbastanding.php">Standings</a></li>
  <li><a href="../players.php">Players</a></li>
</ul>
</div>


<div id="Content">
  <div>
  
    <h2>Philadelphia 76ers<img src="img/PHI.png" alt="Philadelphia 76ers" height="99px" width="111px"/>
    <select id="selectbox" name="" onchange="javascript:location.href = this.value;" style="width:150px;float: right;">
      <option value="#">Select Team...</option>
      <option value="http://localhost/nbateams/BostonCeltics.php">Boston Celtics</option>
      <option value="http://localhost/nbateams/BrooklynNets.php">Brooklyn Nets</option>
      <option value="http://localhost/nbateams/NewYorkKnicks.php">New York Knicks</option>
      <option value="http://localhost/nbateams/Philadelphia76ers.php">Philadelphia 76ers</option>
      <option value="http://localhost/nbateams/TorontoRaptors.php">Toronto Raptors</option>
      
    </select>
    </h2>
 </div>
  <?php echo $response;?>

</div>
</div>
</body>
</html>