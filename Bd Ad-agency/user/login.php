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
		//$password=$_POST['password'];
		//$password=md5($password);

		$statement=$db->prepare("select * from tbl_registration where username=? and password=?");
		$statement->execute(array($_POST['username'],$_POST['password']));


		$num=$statement->rowCount();
		
		if($num>0) 
		{
			session_start();
			$_SESSION['name'] = "registration";
			$username=$_POST['username'];

			header("location:profile.php? id=$username");

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


<?php

include("header1.php");


?>
	<div class="container">
		<div class="login">
<?php 
	
		if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
?>



		<form action="" method="post">

			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text"name="username"value=""></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password"name="password"value=""></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="submit" type="submit"name="form_login"value="Login"></td>
				</tr>

			</table>
		</form>

		Have not any Accout? <a href="signup.php">Please Click Here to Sign Up.</a>
	</div>

	</div>

<?php

include("footer.php");

?>


<style type="text/css">

.container{
	width:1050px;
	height:600px;
	border:1px solid #ddd;
	color:#000;
	text-align:center;
	margin-left:150px;
	margin-right:150px;
	background:#1D1C0F;
	}
.login{
	width: 400px;
	height: 200px;
	margin-left: 380px;
	margin-top: 100px;
	background:#CADDD9;
}
.login form{margin-left: 8px;}
.login input {width: 300px; height:30px; margin-top: 8px}
#submit{    
	background: #39715D;
    width: 90px;
    margin-left: 210px;
}
.error{color:red;}
.success{color:green;}
</style> 


