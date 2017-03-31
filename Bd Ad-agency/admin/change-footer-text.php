<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}
include('../config.php');

?> 
<?php

if(isset($_POST['form1'])){

	try{
		if(empty($_POST['footer_text'])){
			throw new Exception("Footer text can not be empty");
			
		}
		$statement=$db->prepare("update tbl_footer set footer_description=? where footer_id=1");
		$statement->execute(array($_POST['footer_text']));
		$success_message="Footer text has been successfully updated.";	

	}
	catch(Exception $e){

		$error_message=$e->getMessage();
	}

}


?>
<?php

$statement=$db->prepare("select * from tbl_footer where footer_id=1");
$statement->execute();
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) 
{
	$description=$row['footer_description'];

}


?>


<?php
include('header.php');
?>
<h2>Change Footer Text</h2>
<?php 
	
if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
if(isset($success_message)){ echo "<div class='success'>".$success_message. "</div>"; }
	
	
?> 

<form action="" method="post">
	<table class="tbl1">
		<tr>
			<td>Footer Text</td>
		</tr>
		<tr>
			<td>
			<input class="long" type="text" name="footer_text" value="<?php echo $description; ?>">
			</td>
		</tr>
		<tr>
	
			<td>
			<input type="submit" name="form1" value="Save">
			</td>
		</tr>

	</table>
</form>


<?php 
include('footer.php');
?>