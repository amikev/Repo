<?php //session_start();

include("functions.php");
include("header.php");
echo $isAllowed;
if($isAllowed == 1){
?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Administrators</h1>
			</div>
		</div><!--/.row-->
				
		
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Menu Elements</div>
					<div class="panel-body">
						
						<table class="table table-striped"><thead><tr><th>Avatar</th><th>Status</th><th>Edit Admins</th><th>Name</th><th>Email</th><th>Options</th></tr></thead>
							<?php 
							
							$sql = "SELECT * FROM users";
							$result = $conn->query($sql) or die(mysqli_error($conn));

							if ($result->num_rows > 0) {
    							while($row = $result->fetch_assoc()) {
									echo '<tr><td><img src="profilepic/'.$row['userName'].'.jpg" width="40px" height="40px" /></td>';
        							echo "<td>".labelStatus($row["isActive"])."</td><td>".labelAllowed($row["isAllowed"])."</td><td>".$row["userName"]."</td><td>".$row["emailID"]."</td><td>";
									echo "<div class='option sm'>";
									echo "<a href='users.php?edt&ID=".$row["ID"]."'><svg class='glyph stroked pencil md'><use xlink:href='#stroked-pencil'></use></svg></a>";
									//echo "<a href='#' class='flag'><svg class='glyph stroked flag md'><use xlink:href='#stroked-flag'></use></svg></a>";
									echo "<a href='get.php?delarede&ID=".$row["ID"]."' class='delete'><svg class='glyph stroked trash md'><use xlink:href='#stroked-trash'></use></svg></a>";
									echo "</div></td></tr>";
    							}
							} else {
    							echo "0 results";
							}
							
						
							?>	
						</table>

					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
				
					<?php
					if(isset($_GET["edt"])){
					?>
				
					<div class="panel-heading">Edit Administrators</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post" enctype="multipart/form-data">
							<?php
							$sql1 = 'SELECT * FROM users WHERE ID = '.$_GET["ID"];							
							$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
							$item = $result1->fetch_assoc() or die(mysqli_error($result1));
							
								echo'<img src="profilepic/'.$item['userName'].'.jpg" width="200px" height="200px" /> <br /><br />';
		
								echo "<label>Last change: ".gmdate("d/m/Y H:i:s", $item['timestamp'])."</label><br />";
								echo "<label>Status</label><select name='admin_active' class='form-control'>";
								echo "<option value='1' ".isSelectedA($item['isActive']).">Active</option><option value='0' ".isSelectedI($item['isActive']).">Inactive</option></select>";									
								echo "<label>Allowed to edit Administrators</label><select name='admin_allowed' class='form-control'>";
								echo "<option value='1' ".isSelectedA($item['isAllowed']).">Allowed</option><option value='0' ".isSelectedI($item['isAllowed']).">Forbidden</option></select>";									
								echo "<label>Username</label><input class='form-control' name='userName' value='".$item['userName']."'>";								
								echo "<label>Email</label><input class='form-control' name='emailID' value='".$item['emailID']."'>";
								echo "<label>Password (Write new password or leave it blank)</label><input type='password' class='form-control' name='pass'>";
								echo "<label>Photo</label><input id='photo' name='photo' type='file' /><br />";
								echo "<input type='hidden' name='ID' value='".$_GET["ID"]."'>";
								
								echo "<button type='submit' name='edit_admin' class='btn btn-primary'>Save</button>";
								echo "<button type='reset' class='btn btn-default'>Reset</button><br /><br />";
							?>
							<input class="btn btn-warning" type="button" onclick="location.href='users.php';" value="Exit" />
						</form>						

					</div>
					
					<?php
					}else{
					?>
					
					<div class="panel-heading">Create Administrator</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post" enctype="multipart/form-data">
							<?php
								echo "<label>Active / Inactive</label><select name='users_active' class='form-control'>";
								echo "<option value='1'>Active</option><option value='0'>Inactive</option></select>";
								echo "<label>Allowed to edit Administrators</label><select name='users_allowed' class='form-control'>";
								echo "<option value='1'>Allowed</option><option value='0'>Forbidden</option></select>";									
								echo "<label>Username</label><input class='form-control' name='userName' placeholder='Pesho'>";								
								echo "<label>Email</label><input class='form-control' name='emailID' placeholder='example@example.com'>";
								echo "<label>Password</label><input type='password' class='form-control' name='password'>";
								echo "<label>Photo</label><input id='photo' name='photo' type='file' /><br />";
								
								echo "<button type='submit' name='signup' class='btn btn-primary'>Save</button>";
								echo "<button type='reset' class='btn btn-default'>Reset</button>";
							?>
						</form>						

					</div>
					
					<?php
					}
					?>
					
				</div>
			</div>
		</div><!--/.row-->	
		
		
		

		
	</div><!--/.main-->

<?php
}else{
	echo '<script type="text/javascript">alert("You shall not pass!"); window.location = "welcome.php";</script>';
}
include("footer.php");

?>