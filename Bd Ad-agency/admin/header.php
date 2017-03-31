
<html lan="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard-Sample Blog With PHP</title>
	<link type="text/css" rel="stylesheet" href="../includes/css/style-admin.css" >
	<script type="text/javascript">
		function confirmdelete(){
			return confirm("Do You Want To Delete This Data?");
		}
	</script>
	<!-- Fancybox jQuery -->
	<script type="text/javascript" src="../fancybox/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="../fancybox/main.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" />
	<!-- //Fancybox jQuery -->
	
	<!-- CKEditor Start -->
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<!-- // CKEditor End -->
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<h1> Admin Panel Dashboard </h1>
		</div>
		<div id="container">
			<div id="sidebar">

				<h2>Page Option</h2>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="change-footer-text.php">Change Footer Text</a></li>
					<li><a href="about.php">Update About</a></li>
					<li><a href="contact.php">Update Contact</a></li>
					

					<li><a href="logout.php">Logout</a></li>
				</ul>
				<h2>Blog Option</h2>
				<ul>
					<li><a href="post-add.php">Add Post</a></li>
					<li><a href="post-view.php">View Post</a></li>
					<li><a href="manage-category.php">Manage Calegory</a></li>
					<li><a href="manage-tag.php">Manage Tag</a></li>
				</ul>

			</div>
			<div id="content">


