
<?php 
include('../config.php');

?>

<?php

include("header.php");


?>

<div class="main">
	<div class="gellary">

		<div class="main_container">    <!--maincontent start -->
	<?php
			$i=0;
			$statement=$db->prepare("select * from tbl_post order by post_id desc" );
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			
				$i++;

			?>
		
			<div class="content">
				<div class="g1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> 
			
				</div>
				<div class="g1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> 
			
				</div>
				<div class="g1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> 
			
				</div>
				<div class="g1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> 
			
				</div>
				<div class="g1">
				<a href="details.php?post_id=<?php echo $row['post_id'];?>"><img src="../includes/images/<?php echo $row['post_image'];?>"></a> 
			
				</div>
				
			
			
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

.gellary{
	width:1050px;

	border:1px solid #ddd;
	color:#000;
	text-align:center;
	margin-left:150px;
	margin-right:150px;
	background:#fff;
	}
.main_container{margin-top:20px;}

.content{

width:1050px;
height:150px;
min-height:150px;
margin-top:5px;


text-align:center;


}
.content h2{margin-top:50px;}

.g1{
	width:210px;
	height:150px;
	float:left;
	border:1px solid;
 }

</style> 

