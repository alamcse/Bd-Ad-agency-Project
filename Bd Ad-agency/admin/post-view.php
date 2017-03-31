<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}
    include('../config.php');

?>
<?php
include('header.php');
?>
<h2>View All Posts</h2>

	<table class="tbl2" width="100%">
		<tr>
			<th width="3%">Serial</th>
			<th width="70%">Title</th>
			<th width="27%">Action</th>

		</tr>
		<?php
			$i=0;
			$statement=$db->prepare("select * from tbl_post order by post_id desc ");
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			$i++;
			?>
				<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['post_title']?></td>
			<td>

				<a href="view.php?id=<?php echo $row['post_id']; ?>">View</a>

				&nbsp;|&nbsp; 
				<a href="post-edit.php?id=<?php echo $row['post_id']; ?>">Edit</a>
				&nbsp;|&nbsp; 
				<a onclick="return confirmdelete();" href="post-delete.php?id=<?php echo $row['post_id']; ?>"> Delete</a>
			</td>
		<?php 
	} 

		?>

	<?php include('footer.php')?>