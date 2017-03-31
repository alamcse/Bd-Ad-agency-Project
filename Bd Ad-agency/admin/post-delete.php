<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}
include('../config.php');

?>
<?php
if(!isset($_REQUEST['id'])){
	header('location:post-view.php');
}
else{
	$id=$_REQUEST['id'];
}

?>
<?php
$statement=$db->prepare("select * from tbl_post where post_id=?");
$statement->execute(array($id));
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) 
{
	$real_path="../includes/images/".$row['post_image'];
	unlink($real_path);

}



$statement=$db->prepare("delete from tbl_post where post_id=?");
$statement->execute(array($id));
header('location:post-view.php');



?>
