<?php
  if ( isset( $_POST['signup'] ) ){
    function validateFormData( $formData ){
      $formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
      return $formData;
    }
    $formName = validateFormData( $_POST['firstName'] );
    $formLast = validateFormData( $_POST['lastName'] );
    $formEmail = validateFormData( $_POST['emailAd'] );
    $formUser = validateFormData( $_POST['username'] );
    $formPass = validateFormData( $_POST['password'] );
    if ($formUser == "" || $formPass == "" || $formEmail == "" || $formLast == "" || $formName == ""){
      $displayMessage = "<p class='login-error'>You Must Enter Username/Password</p>";
    }else { 
    require_once("logindb.php.inc");
    $register = new localDB("connect.ini");
    $response = $register->addNewUser( $formUser, $formPass, $formName, $formLast, $formEmail );
      if ($response['success']===true){
		header("Location: index.html");
	}
	else{
		$displayMessage = "Registration Failed:".$response['message']."<p>";
	}
    }
    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Sport Guide</title>
<link rel="stylesheet" href="css/style.css"/>

</head>

<body>
<div class="container">
<div class="main">
<img class="logo-resize" src="logo.jpeg">
<form id="form_id" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<table>
<tr><td>
<label>First Name :</label><br/>
<input type="text" name="firstName" id="firstName"/>
</td></tr>
<tr><td>
<label>Last Name :</label><br/>
<input type="text" name="lastName" id="lastName"/>
</td></tr>
<tr><td>
<label>Email :</label><br/>
<input type="text" name="emailAd" id="emailAd"/>
</td></tr>
<tr><td>
<label>Username :</label><br/>
<input type="text" name="username" id="username"/>
</td></tr>
<tr><td>
<label>Password :</label><br/>
<input type="password" name="password" id="password"/>
</td></tr>
<tr><td>
<button type="submit" id="submit" value="Sign Up" name="signup"/>Sign Up</button>
</td>
</tr>
</table>
</form>
<?php echo $displayMessage; ?>
<span>
<p class="note">Already Have An Account? <a class="aline" href="login.php">Login!</a></p></span></div></div>

</script>
</body>
</html>
