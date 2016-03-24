<?php
  session_start();
  if (!isset($_SESSION['username'])){
    header('Location: accessdenied.php');
  }else{
    session_unset();
    session_destroy();
    }

?>
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
<div style="margin:0 auto;text-align:center;">
<h3>You Have Successfully Logged Out!</h3><br/><p id='status' style="font-size:12px;"></p></div>
<script type="text/javascript">countDown(5,"status");</script>