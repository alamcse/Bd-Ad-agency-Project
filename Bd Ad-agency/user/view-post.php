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
		$userid=$_REQUEST['id'];
	}

?>
<?php include('header.php');?>
<div class="container">
	<div class="view-post">

		<?php
			$i=0;
			$statement=$db->prepare("select * from tbl_post where userid=? order by post_id desc ");
			$statement->execute(array($userid));
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			$i++;

			?>
		<p id="edit-delete"> <a href="post-edit.php?id=<?php echo $row['post_id'];?>">Edit</a>
			<a href="post-delete.php?id=<?php echo $row['post_id'];?>">Delete</a>
	   </p>

		<h2><?php echo $row['post_title'];?></h2> 


		<h4><?php echo $row['post_description']?>;</h4>
		<img src="../includes/images/<?php echo $row['post_image'];?>" height="150"width="250">
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
.view-post{ margin-left:30px;line-height: 26px;}
.error{color:red;}
.success{color:green;}
input[type="submit"] {
    cursor: pointer;
    -webkit-appearance: button;
    width: 70px;
    height: 26px;
    margin-top: 10px;
    background: #ddd;
}
#edit-delete{float:right;font-size: 20px;}
</style> 