
<?php 
include('../config.php');

?>

<?php

include("header.php");
?>



	<div class="about">
	
		<p>
			<?php
			$statement=$db->prepare("select * from tbl_about where about_id=1");
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
				echo $row['about_description'];
			}

			?>
		</p>




		<div class="main_container">    <!--maincontent start -->
	
		

			
	</div>
      <!--maincontent end -->
	</div>

<?php

include("footer.php");

?>
</div>

<style type="text/css">

.about{
	width:1050px;

	border:1px solid #ddd;
	color:#000;
	text-align:center;
	margin-left:150px;
	margin-right:150px;
	background:#fff;
	}
.about p{ margin:5px auto;margin-right: 30px;margin-left: 30px}
.main_container{margin-top:20px;}

</style> 

