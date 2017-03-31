<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='registration'){
		header('location:login.php');
	}
    include('../config.php');
 ?>

 <?php
 if(isset($_REQUEST['id'])){
 	$username=$_REQUEST['id'];

 }

 ?>


<?php
			$statement=$db->prepare("select * from tbl_registration where username=?");
			$statement->execute(array($username));
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
				
				$userid=$row['userid'];
				$name=$row['name'];
				$username=$row['username'];
				$email=$row['email'];
				$city=$row['city'];
				$division=$row['division'];
				$phone=$row['phone'];
		   }

?>




<?php

include("header.php");


?>

	<div class="profile">
		<h1>User's Information</h1>
		<a id="addpost" href="addpost.php?id=<?php echo $userid;?>"><button type="submit">ADD POST </button></a>
		<a id="viewpost"href="view-post.php?id=<?php echo $userid;?>"><button type="submit">View POST </button></a>
		<hr>
		<div class="information">
			Name:&nbsp;<?php echo $name; ?><br>
			Username:&nbsp;<?php echo $username;?><br>
			City:&nbsp;<?php echo $city; ?><br>
			Division:&nbsp;<?php echo $division;?><br>
			Contact No:&nbsp;<?php echo $phone;?><br>
			Email:&nbsp;<?php echo $email; ?><br>
		</div>
	</div>

<?php

include("footer.php");

?>


<style type="text/css">

.profile{
	width:1050px;
	height:500px;
	border:1px solid #ddd;
	color:#000;
	margin-left:150px;
	margin-right:150px;
	background:#508E6B;
	}
.profile hr{height:1px; background: #DDE;}
h1{text-align:center;}
.profile a{}
.information {
    line-height: 36px;
    font-size: 20px;
    margin-left: 400px;
}
#addpost button {
	float:right;
	border: 0;
	padding: 0;
	cursor: pointer;
	height: 40px;
	width: 120px;
	color: #fff;
	background:#123456;
	margin-right:20px;
	margin-top:-50px;
	border-radius: 0 3px 3px 0;
}
#viewpost button {
	float:right;
	border: 0;
	padding: 0;
	cursor: pointer;
	height: 40px;
	width: 120px;
	color: #fff;
	background:#123456;
	margin-right:145px;
	margin-top:-50px;
	border-radius: 0 3px 3px 0;
}

</style> 

