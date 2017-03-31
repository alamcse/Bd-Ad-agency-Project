<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}


?>
<?php

include('header.php');

?>
				<h2>Welcome To Admin Panel</h2>
				<div style="font-weight:bold;color:#3d9ccd;font-size:28px;text-align:center; padding-top:50px">
					Welcome to the dashboard of <br>
					Bd. Ad-Ajency 
				</div>
				
<?php
include('footer.php');

?>