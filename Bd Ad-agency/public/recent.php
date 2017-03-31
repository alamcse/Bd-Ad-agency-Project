
<?php 
include('../config.php');
?>
<?php

include("header.php");


?>


	<div class="category">
		<h3>View All Recent Posts</h3>

		<div class="main_container">    <!--maincontent start -->
			<?php

			$i=0;
			$statement=$db->prepare("select * from tbl_post order by post_id asc");
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{

				
			}
			
			$recent=$row['post_id']-4;
			?>
			<?php

			
			$statement=$db->prepare("select * from tbl_post where post_id>=$recent order by post_id desc");
			$statement->execute(); 
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			


		?>
		
			<div class="content">
				<div class="div1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> <br>
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><?php echo$row['post_title'];?></a>
				</div>
				<div class="div2">
				<h2>Price:<?php echo $row['post_price'];?></h2>
				</div>
				<div class="div3">
					<a href="details.php?post_id=<?php echo $row['post_id'];?>"><button type="submit">Details</button></a>
				</div>
				<hr>
			
			</div>
			<?php

		}

		?>
			
	</div>
      <!--maincontent end -->
	</div>

<?php

include("footer.php");

?>
</div>

<style type="text/css">

.category{
	width:1050px;

	border:1px solid #ddd;
	color:#000;
	text-align:center;
	margin-left:150px;
	margin-right:150px;
	background:#fff;
	}
.main_container{margin-top:20px;}

</style> 

