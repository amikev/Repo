<?php //session_start();

include("functions.php");
include("header.php");

?>
	 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Profile</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit your profile</div>
					<div class="panel-body">
						
						<form role="form" action="post.php" method="post" enctype="multipart/form-data">
							<?php
							$sql1 = "SELECT * FROM users WHERE userName='".$_SESSION['userName']."'";							
							$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
							$item = $result1->fetch_assoc() or die(mysqli_error($result1));
							
								echo'<img src="profilepic/'.$item['userName'].'.jpg" width="200px" height="200px" <br /><br />';
		
								echo "<label>Last change: ".gmdate("d/m/Y H:i:s", $item['timestamp'])."</label><br />";
								echo "<label>Username</label>: ".$item['userName']."<br />";								
								echo "<label>Email</label><input class='form-control' name='emailID' value='".$item['emailID']."'>";
								echo "<label>Password (Write new password or leave it blank)</label><input type='password' class='form-control' name='pass'>";
								echo "<label>Photo</label><input id='photo' name='photo' type='file' /><br />";
								echo "<input type='hidden' name='userName' value='".$item["userName"]."'>";
								echo "<input type='hidden' name='ID' value='".$item["ID"]."'>";
								
								echo "<button type='submit' name='profile' class='btn btn-primary'>Save</button>";
								echo "<button type='reset' class='btn btn-default'>Reset</button><br /><br />";
							?>
						</form>
						
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div><!--/.main-->


<?

include("footer.php");

?>