<?php

include('config.php');
?>
<?php include('header.php'); ?>
	<div class="slider_cat_scrollpost_content"> <!--slider_cat_scrollpost_content start  -->
		<div class="slider_cat">		<!--slider_cat start  -->		
					
		
			<div class="cat"> 
				<h2>Categories</h2>

						<ul>
							<?php
							$i=0;
							$statement=$db->prepare("select * from tbl_category order by cat_name asc ");
							$statement->execute();
							$result=$statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
							?>
					
							<li><a href="public/view_categories_post.php?cat_id=<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></a></li>
							<?php
							}
							?>
							
						</ul>
					
			</div>   <!--cat end -->
			
			<div class="slider"> <!--nevo slider start  -->

				<div class="slider-wrapper theme-light">
					<div class="nivoSlider" id="slider">
						<img src="includes/images/s1.jpg" alt="" title="This site is developed by us"/>
						<img src="includes/images/s2.jpg" alt=""/>
						<img src="includes/images/s3.jpg" alt="" title="#htmlcaption"/>
						<img src="includes/images/s4.jpg" alt=""/>
					</div>
					<div class="nivo-html-caption" id="htmlcaption">
						<p>BD.Ad-Ajency<a href="http://localhost/pp/">link</a></p>
					</div>
				</div> 
			</div>  <!--nivo slider end -->
		</div>		<!--cat_slider end -->
		
		
		<div class="scrollPost" id="hmp">  <!--update scrolling slider start -->
			<article class="featured-product container-fluid">
				<div class="container row-fluid">
					<h2>Latest <span>Adds</span></h2>
					<div class="productslider carousel slide" id="prod196">
						<div class="carousel-inner">
							
							
							<div class="item active">
								<ul>
									<?php
								$i=0;
								$statement=$db->prepare("select * from tbl_post order by post_id desc");
								$statement->execute();
								$result=$statement->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $row)
								{
									$i++;
									if($i<6)
									{
			
									
									?>
									<li class="product col-sm-2">
									<a href="public/details.php?post_id=<?php echo $row['post_id'];?>" alt="<?php echo $row['post_title'];?>">
									<img src="includes/images/<?php echo $row['post_image'];?>" alt="" width="160" height="120" pagespeed_url_hash="942310239">
									<span><?php echo $row['post_title'];?></span>
									</a>
									<span class="text"><?php echo $row['post_price'];?></span>
									</li>
										<?php
									}
								}
									?>
									
								</ul>

							</div>
						
							<div class="item">
								<ul class="slides product-slider1">
									
									<li class="product col-sm-2">
									<a href="" alt="<?php echo $row['post_title'];?>">
									<img src="includes/images/<?php echo $row['post_image'];?>" alt="" width="160" height="120" pagespeed_url_hash="17040167">
									<span><?php echo $row['post_title'];?></span>
									</a>
									<span class="text">Tk. 1,200</span>

									</li>
								
							
							</ul>

							</div>
							
							
						</div>
						
					
						<a data-slide="prev" href="#prod196" class="left carousel-control"><span class="prev_btn"></span></a>
						<a data-slide="next" href="#prod196" class="right carousel-control"><span class="next_btn"></span></a>

					</div>
				</div>
			</article> 


		</div>  <!--update scrolling slider end -->
		

										
		<div class="main_container">    <!--maincontent start -->
			<?php

			$i=0;
			$statement=$db->prepare("select * from tbl_post order by post_id desc ");
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
			$i++;


		?>
		
			<div class="content">
				<div class="div1">
				<a href="public/details.php?post_id=<?php echo $row['post_id'];?>"><img src="includes/images/<?php echo $row['post_image'];?>"></a> <br>
				<a href="public/details.php?post_id=<?php echo $row['post_id'];?>"><?php echo$row['post_title'];?></a>
				</div>
				<div class="div2">
				<h2>Price:<?php echo $row['post_price'];?></h2>
				</div>
				<div class="div3">
					<a href="public/details.php?post_id=<?php echo $row['post_id'];?>"><button type="submit">Details</button></a>
				</div>
				<hr>
			
			</div>
			<?php

		}

		?>
			
	</div>
      <!--maincontent end -->
	</div>      <!--slider_cat_scrollpost_content end  -->
		
	
	<?php include('footer.php'); ?>