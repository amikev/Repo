<?php //session_start();

include("functions.php");
include("header.php");
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
				<h1 class="page-header">Menu</h1>
			</div>
		</div><!--/.row-->
				
		
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Menu Elements</div>
					<div class="panel-body">
						
						<table class="table table-striped"><thead><tr><th>Status</th><th>Link</th><th>Number</th><th>Name</th><th>Options</th></tr></thead>
							<?php 
							
							$sql = "SELECT * FROM headermenu ORDER BY menuNumber ASC";
							$result = $conn->query($sql) or die(mysqli_error($conn));

							if ($result->num_rows > 0) {
    							while($row = $result->fetch_assoc()) {
        							echo "<tr><td>".labelStatus($row["isActive"])."</td><td>".$row["menuLink"]."</td><td>".$row["menuNumber"]."</td><td>".$row["menuText"]."</td><td>";
									echo "<div class='option sm'>";
									echo "<a href='menu.php?edt&ID=".$row["ID"]."'><svg class='glyph stroked pencil md'><use xlink:href='#stroked-pencil'></use></svg></a>";
									//echo "<a href='#' class='flag'><svg class='glyph stroked flag md'><use xlink:href='#stroked-flag'></use></svg></a>";
									echo "<a href='get.php?del&ID=".$row["ID"]."' class='delete'><svg class='glyph stroked trash md'><use xlink:href='#stroked-trash'></use></svg></a>";
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
				
					<div class="panel-heading">Edit Menu Item</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post">
							<?php
							$sql1 = 'SELECT * FROM headermenu WHERE ID = '.$_GET["ID"];							
							$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
							$item = $result1->fetch_assoc() or die(mysqli_error($result1));
							
								echo "<label>Last change: ".gmdate("d/m/Y H:i:s", $item['timestamp'])."</label><br />";
								echo "<label>Status</label><select name='menu_active' class='form-control'>";
								echo "<option value='1' ".isSelectedA($item['isActive']).">Active</option><option value='0' ".isSelectedI($item['isActive']).">Inactive</option></select>";									
								echo "<label>Link</label><input class='form-control' name='menu_link' value='".$item['menuLink']."'>";								
								echo "<label>Name</label><input class='form-control' name='menu_name' value='".$item['menuText']."'>";
								echo "<label>Number</label><input class='form-control' name='menu_number' value='".$item['menuNumber']."'>";
								echo "<input type='hidden' name='ID' value='".$_GET["ID"]."'>";
								
								echo "<button type='submit' name='submit_edit' class='btn btn-primary'>Save</button>";
								echo "<button type='reset' class='btn btn-default'>Reset</button><br /><br />";
							?>
							<input class="btn btn-warning" type="button" onclick="location.href='menu.php';" value="Exit" />
						</form>						

					</div>
					
					<?php
					}else{
					?>
					
					<div class="panel-heading">Create New Menu Item</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post">
							<?php
								echo "<label>Active / Inactive</label><select name='menu_active' class='form-control'>";
								echo "<option value='1'>Active</option><option value='0'>Inactive</option></select>";									
								echo "<label>Link</label><input class='form-control' name='menu_link' placeholder='Ex. view.php?view&link='>";								
								echo "<label>Name</label><input class='form-control' name='menu_name' placeholder='Ex. Home'>";
								echo "<label>Number</label><input class='form-control' name='menu_number' placeholder='Ex. 1'>";
								
								echo "<button type='submit' name='submit' class='btn btn-primary'>Save</button>";
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

<?

include("footer.php");

?>