<?php
include('../config.php');
if(isset($_POST['form1'])){
	try{
		if(empty($_POST['name'])){
			throw new Exception("Name Can Not Be Empty");
			
		}
		if(empty($_POST['username'])){
			throw new Exception("Username Can Not Be Empty");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password Can Not Be Empty");
			
		}
		if(empty($_POST['email'])){
			throw new Exception("Email Can Not Be Empty");
			
		}

		$statement=$db->prepare("select * from tbl_registration where username=?");
		$statement->execute(array($_POST['username']));

		$total=$statement->rowCount();
		if($total>0){
			throw new Exception('Username is already exist');
			
		}
		$statement=$db->prepare("select * from tbl_registration where email=?");
		$statement->execute(array($_POST['email']));

		$total1=$statement->rowCount();
		if($total1>0){
			throw new Exception('Email is already exist');
			
		}

		$statement=$db->prepare("insert into tbl_registration(name,username,password,email) value(?,?,?,?)");
		$statement->execute(array($_POST['name'],$_POST['username'],$_POST['password'],$_POST['email']));
		$success_message="Registration has been successfully completed";

	}
	catch(Exception $e){
		$error_message=$e->getMessage();
	}
}

?>
<html>
<head>
	<title>registration</title>
	<link type="text/css" rel="stylesheet" href="../style-admin.css">
</head>
<body>
	<h2> Welcome to Registration</h2>
<?php 
	if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
	if(isset($success_message)){ echo "<div class='success'>".$success_message. "</div>"; }

?>

	<form action="" method="post">
		<table>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="name" value=""></td>
			</tr>
			
			<tr>
				<td>Username:</td>
			<td><input type="text" name="username"value=""></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" value=""></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value=""></td>
		</tr>
		<tr>
			<td></td>

			
			<td><input type="submit" name="form1"value="Submit"></td>
		</tr>




		</table>


	</form>


</body>
</html>

