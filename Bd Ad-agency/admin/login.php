<?php

if(isset($_POST['form_login'])) 
{
	
	try {
	
		
		if(empty($_POST['username'])) {
			throw new Exception('Username can not be empty.');
		}
		
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty.');
		}
	
		include('../config.php');
		$num=0;
		$password=$_POST['password'];
		$password=md5($password);

		$statement=$db->prepare("select * from tbl_login where username=? and password=?");
		$statement->execute(array($_POST['username'],$password));


		$num=$statement->rowCount();
		
		if($num>0) 
		{
			session_start();
			$_SESSION['name'] = "admin";
			header("location: index.php");
		}
		else
		{
			throw new Exception('Invalid Username and/or password');
		}
	
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<html lan="en">
<head>
	<meta charset="UTF-8">
	<title>Login-Sample Blog With PHP</title>
	<link type="text/css" rel="stylesheet" href="../style-admin.css" >
</head>
<body>

<div id="wrapper-login">

	<h1> Admin Login</h1>
	<?php 
	
		if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
	
	
	?>
	<form action="" method="post" >
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="form_login" value="Login"></td>
			</tr>


		</table>


	</form>
</div>

</body>


</html>