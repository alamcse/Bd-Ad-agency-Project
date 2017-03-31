<?php include('../config.php');?>
<div class="footer"> <!--footer start -->
			<div class="tomottoWrap">
			</div>
			<div class="lookWrap">
				<div id="look">
					<div class="section">
						<h3>Support</h3>
						<a href="#">FAQs</a>
						<a href="#">Contact Us</a>
						<a href="#">Privacy Policy</a>
						<a href="#">Shipping Information</a>
						<a href="#">Return Policy</a>
						<a href="#">Item Exchange</a>
						<a href="#">Cash Back Rewards</a>
					</div>
					<div class="section">
						<h3>Give and Take</h3>
						<a href="#">Gift Certificates</a>
						<a href="#">Wishlist</a>
						<a href="#">Gift Ideas</a>
						<a href="#">Refer a Friend</a>
						<a href="#">Reviews</a>
						<a href="#">Scholarship</a>
						<a href="#">Sponsor</a>
					</div>
					<div class="section">
						<h3>Follow Us</h3>
						<a href="#">Facebook</a>
						<a href="#">Twitter</a>        
						<a href="#">Pinterest</a>
						<a href="#">Blog</a>
						<a href="#">Ravelry</a>
						<a href="#">Sponsor</a>
						<a href="#">RSS</a>
						</div>
						<div class="section">
					<h3>About Us</h3>
						<a href="#">About</a>
						<a href="#">Testimonials</a>      
						<a href="#">The Team</a>        
					</div>      
				</div>
			</div>
			<div class="legality">
				<?php  
					$statement=$db->prepare("select * from tbl_footer where footer_id=1");
					$statement->execute();
					$result=$statement->fetchAll(PDO::FETCH_ASSOC);
					foreach($result as $row)
					{
						echo $row['footer_description'];
					}



				?>
			</div>
		</div> <!--footer end  -->

</div> <!--main div end  -->	

	<!--javascript for slider  -->
	<script type="text/javascript" src="../includes/js/jquery-1.7.1.min.js"></script>   
		<script type="text/javascript" src="../includes/js/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider();
		});
	</script>
	
	
		
	<!--javascript for dropdown menu -->
	<script type="text/javascript">
		$(document).ready (function(){
			$(".menu ul li").hover(function(){				
			$(this).find("ul").stop().slideToggle(400);
		});			
			
		});
	</script>





		



</body>

</html>