<?php

	include('../config.php');

?>
<?php
	if(isset($_REQUEST['post_id'])){
		$post_id=$_REQUEST['post_id'];
	}

?>
<?php include('header.php');?>
<div class="container">
	<div class="view-post">

		<?php
			$i=0;
			$statement=$db->prepare("select * from tbl_post where post_id=?");
			$statement->execute(array($post_id));
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			$i++;

			?>

		<h2><?php echo $row['post_title'];?></h2> 


		<h4><?php echo $row['post_description']?>;</h4>
		<img src="../includes/images/<?php echo $row['post_image'];?>" height="300px"width="450">
		<h3>Price:</h3>
		<h4><?php echo $row['post_price'];?></h4>
		<h3>Category:</h3>
		<h4>

			<?php
			$statement1=$db->prepare("select * from tbl_category where cat_id=?");
			$statement1->execute(array($row['cat_id']));
			$result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result1 as $row1)
			{
							
				echo $row1['cat_name'];
						
			}
			?>
		</h4>
		<h3>Tags:</h3>
		<h4>
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
						
		?>
		</h4>
		<h3>Posted Date:</h3>
		<h4><?php echo $row['post_date']; ?></h4>
		<?php
		$userid=$row['userid'];
		$statement1=$db->prepare("select * from tbl_registration where userid=? ");
		$statement1->execute(array($userid));
		$result1=$statement1->fetchAll(PDO::FETCH_ASSOC);
		foreach($result1 as $row1)
		{
			$name=$row1['name'];
			$email=$row1['email'];
			$phone=$row1['phone'];
		}
		?>
		<br>
		<?php
		if($userid>0)
		{
		?>
							
			<h3>Posted By:</h3>
			<h4><?php echo $name; ?> </h4>

			<h4><b>Phone No:</b><?php echo $phone; ?></h4>
			<h4><b>Email:</b><?php echo $email; ?> </h4>
		<?php
		}
		else
		{
				echo "Posted By: Admin";
		}
?>
		<hr>
<?php

	}
?>



	</div>
</div>

<?php

include("footer.php");

?>


<style type="text/css">

.container{
	width:1050px;
	
	border:1px solid #ddd;
	color:#000;

	margin-left:150px;
	margin-right:150px;
	background:#fff;
	}
.container img{border:2px solid #ddd;}
.view-post{ margin-left:30px;line-height: 26px;text-align: justify;}

</style> 