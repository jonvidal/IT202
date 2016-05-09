<?php
  session_start();
  if (!isset($_SESSION['username'])){
    header('Location: accessdenied.php');
  }else{
    session_unset();
    session_destroy();
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="../css/layout.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NBA</title>
</head>

<body>
<div  class="container" id="Holder">
<div  class="container" id="Header"><a href="index.php" title="Home"><img src="../logo.jpeg" alt="Fantasy Sports Guide" height="125"></a>
</div>

<div class="container" id="NavBar">
<ul>
  
</ul>
</div>
<script type="text/javascript">
	function countDown(secs, elem){
	var element = document.getElementById(elem);
	element.innerHTML = "To Sign In, Please Wait For <span style='color:red;'>"+secs+"</span> Second(s)";
	if (secs < 1){
	clearTimeout(timer);
	window.location = 'login.php';
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
	}
</script>
<div style="margin:0 auto;text-align:center;" class="container" id="Content">
<h3>You Have Successfully Logged Out!</h3><br/><p id='status' style="font-size:12px;"></p></div>
<script type="text/javascript">countDown(5,"status");</script>
</body>
</html>