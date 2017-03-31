<?php

	ob_start();
	session_start();
	if($_SESSION['name']!='admin'){
		header('location:login.php');
	}
	include('../config.php');

?>
<?php
	if(isset($_POST['form1'])){
		try{
			
			if(empty($_POST['about_description'])){
			
				throw new Exception('Description can not be empty.');
			}
			$statement=$db->prepare("update tbl_about set about_description=? where about_id=1");
			$statement->execute(array($_POST['about_description']));
			
			$success_message='About has been updated successfully.';
		
		}
		catch(Exception $e){
			$error_message=$e->getMessage();
		}
	
	}

?>
<?php
include('header.php');
?>
<h2>Edit About</h2>
<?php 
	
if(isset($error_message)){ echo "<div class='error'>".$error_message. "</div>"; }
if(isset($success_message)){ echo "<div class='success'>".$success_message. "</div>"; }
	
	
?> 

<form action="" method="post">
	<table class="tbl1">

		<tr>
			<td>
				<textarea class="ckeditor" id="edior" name="about_description"cls="30" rows="10"> </textarea>
				<script type="text/javascript">
				if ( typeof CKEDITOR == 'undefined' )
				{
					document.write(
						'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
						'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
						'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
						'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
						'value (line 32).' ) ;
				}
				else
				{
					var editor = CKEDITOR.replace( 'about_description' );
					//editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
				}

				</script>
		

			</td>

		</tr>
		
		<tr>
	
			<td>
			<input type="submit" name="form1" value="Update">
			</td>
		</tr>

	</table>

</form>


<?php 
include('footer.php');
?>