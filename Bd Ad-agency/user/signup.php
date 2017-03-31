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
		
		if(empty($_POST['division'])){
			throw new Exception("Division Can Not Be Empty");
			
		}
		if(empty($_POST['city'])){
			throw new Exception("City Can Not Be Empty");
			
		}
		if(empty($_POST['phone'])){
			throw new Exception("Phone Number Can Not Be Empty");
			
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

		$statement=$db->prepare("insert into tbl_registration
			(name,username,password,email,division,city,phone) value(?,?,?,?,?,?,?)");
		$statement->execute(array($_POST['name'],$_POST['username'],$_POST['password'],
		$_POST['email'],$_POST['division'],$_POST['city'],$_POST['phone']));
		$success_message="Registration has been successfully completed";

	}
	catch(Exception $e){
		$error_message=$e->getMessage();
	}
}

?>

<?php

include("header1.php");


?>

	<div class="container">
		<h2>Registration Here</h2>
		<div class="signup">
<?php 
	if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
	if(isset($success_message)){ echo "<div class='success'>".$success_message. "</div>";}

?>
		<form action="" method="post">
			<table>
				<tr>
				</tr>
				<tr>
					<td>Name:</td>
					<td><input type="text"name="name"value=""></td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text"name="username"value=""></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password"name="password"value=""></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="text"name="email"value=""></td>
				</tr>
				<tr>
	
				<td>Division:</td>
		 
					<td> 
						<select name="division">
						<option value="">------------------------</option>
						<option value="Dhaka"> Dhaka</option>
						<option value="Khulna"> Khulna</option>
						<option value="Rajshahi"> Rajshahi</option>
						<option value="Chittagong"> Chitagong</option>
						<option value="Barisal"> Barisal</option>
						<option value="Sylet"> Sylet</option>
			
						</select>
					</td>
				</tr>
				<tr>
					<td>City:</td>
					<td> 
						<select name="city">
						<option value="">------------------------</option>
						<option value="Dhaka"> Dhaka</option>
						<option value="Jessore"> Jessore</option>
						<option value="Naogaon"> Naogaon</option>
						<option value="Khulna">Rajshahi</option>
						<option value="Khulna">Khulna</option>
						
					
						</select>
					</td>
				</tr>
				<tr>
					<td>Phone No:</td>
					<td><input type="text"name="phone"value=""></td>
				</tr>
				<tr>
					<td></td>
					<td><input id="submit" type="submit"name="form1"value="Sign Up"></td>
				</tr>

			</table>
		</form>
		<h5>Have Any Account?<a href="login.php">Login</a></h5>
	</div>

	</div>

<?php

include("footer.php");

?>


<style type="text/css">

.container{
	width:1050px;
	height:500px;
	border:1px solid #ddd;
	color:#fff;
	text-align:center;
	margin-left:150px;
	margin-right:150px;
	background:#1D1C0F;
	}
.container h2{margin-bottom:-20px;}
.signup{
	width: 400px;
	height: 350px;
	margin-left: 310px;
	margin-top: 60px;
	background:#CADDD9;
}
.signup form{margin-left: 8px; margin-top:5px}
.signup input {width: 300px; height:30px; margin-top: 8px}
.signup h5{color:000;}
#submit{    
	background: #39715D;
    width: 90px;
    margin-left: 210px;}

.error{color:red;}
.success{color:green;}
</style> 


