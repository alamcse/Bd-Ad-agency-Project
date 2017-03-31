<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}
    include('../config.php');

?>
<?php
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
?>
<?php
include('header.php');
?>
<h2>View Post</h2>

		<?php
			$i=0;
			$statement=$db->prepare("select * from tbl_post where post_id=? ");
			$statement->execute(array($id));
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
				?>
			
			

				
						<b>Title</b>
					
						<?php echo $row['post_title'];?>
						<br>
					
						<b>Description</b>
					
						<?php echo $row['post_description'];?>
					
						<b>Features Images</b>
						<br>
					
						<img src="../includes/images/<?php echo $row['post_image'];?>" width="300">
						<br>
					
						<b>Price:</b>
					
						<?php echo $row['post_price'];?>
						<br>
					
						<b>Categories:</b>
					
						
						<?php
						$statement1=$db->prepare("select * from tbl_category where cat_id=?");
						$statement1->execute(array($row['cat_id']));
						$result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
						foreach ($result1 as $row1) {
							
							echo $row1['cat_name'];
						
						}
						?>
						<br>
					
						<b>Tags:</b>
					
						
						<?php
							$arr=explode(",",$row['tag_id']);
							$count_arr=count(explode(",",$row['tag_id']));
							$k=0;
							for($j=0;$j<$count_arr;$j++)
							{
							$statement1=$db->prepare("select * from tbl_tag where tag_id=?");
							$statement1->execute(array($arr[$j]));
							$result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result1 as $row1)
							{
								$arr1[$k] = $row1['tag_name'];
							}
							$k++;
							}

							$tag_names=implode(",",$arr1);
							echo $tag_names;
							$userid=$row['userid'];
							$statement=$db->prepare("select * from tbl_registration where userid=? ");
							$statement->execute(array($userid));
							$result=$statement->fetchAll(PDO::FETCH_ASSOC);
							foreach($result as $row)
							{
								$name=$row['name'];
								$email=$row['email'];
								$phone=$row['phone'];
							}
						?>
						<br>
						<?php
							if($userid>0)
							{
							?>
							
							<b>Posted By:</b><?php echo $name; ?> <br>

							<b>Phone No:</b><?php echo $phone; ?><br>
							<b>Email:</b><?php echo $email; ?><br>
							<?php
							}
							else
							{
								echo "Posted By: Admin";
							}

						?>
						
				
				
				

			
		
			
			
			<?php
		}
			?>
		
		
		
	

<?php 
include('footer.php');
?>