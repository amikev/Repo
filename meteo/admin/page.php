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
				<h1 class="page-header">Pages</h1>
			</div>
		</div><!--/.row-->
				
		
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">All pages</div>
					<div class="panel-body">
						
						<table class="table table-striped"><thead><tr><th>Status</th><th>Link</th><th>Name</th><th>Options</th></tr></thead>
							<?php 
							
							$sql = "SELECT * FROM pagecontent";
							$result = $conn->query($sql) or die(mysqli_error($conn));

							if ($result->num_rows > 0) {
    							while($row = $result->fetch_assoc()) {
        							echo "<tr><td>".labelStatus($row["isActive"])."</td><td>".$row["pageLink"]."</td><td>".$row["pageLabel"]."</td><td>";
									echo "<div class='option sm'>";
									echo "<a href='page.php?edt&ID=".$row["ID"]."'><svg class='glyph stroked pencil md'><use xlink:href='#stroked-pencil'></use></svg></a>";
									//echo "<a href='#' class='flag'><svg class='glyph stroked flag md'><use xlink:href='#stroked-flag'></use></svg></a>";
									echo "<a href='get.php?delpage&ID=".$row["ID"]."' class='delete'><svg class='glyph stroked trash md'><use xlink:href='#stroked-trash'></use></svg></a>";
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
				
					<div class="panel-heading">Edit Page</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post">
							<?php
							$sql1 = 'SELECT * FROM pagecontent WHERE ID = '.$_GET["ID"];							
							$result1 = $conn->query($sql1) or die(mysqli_error($sql1));
							$item = $result1->fetch_assoc() or die(mysqli_error($result1));
							
								echo "<label>Last change: ".gmdate("d/m/Y H:i:s", $item['timestamp'])."</label><br />";
								echo "<label>Status</label><select name='page_active' class='form-control'>";
								echo "<option value='1' ".isSelectedA($item['isActive']).">Active</option><option value='0' ".isSelectedI($item['isActive']).">Inactive</option></select>";									
								echo "<label>Link</label><input class='form-control' name='page_link' value='".$item['pageLink']."'>";								
								echo "<label>Name</label><input class='form-control' name='page_label' value='".$item['pageLabel']."'>";
								echo "<label>Text</label><textarea class='form-control' name='page_text' rows='3'>".$item['pageText']."</textarea>";
								echo "<input type='hidden' name='ID' value='".$_GET["ID"]."'>";
								
								echo "<button type='submit' name='submit_edit_page' class='btn btn-primary'>Save</button>";
								echo "<button type='reset' class='btn btn-default'>Reset</button><br /><br />";
							?>
							<input class="btn btn-warning" type="button" onclick="location.href='page.php';" value="Exit" />
						</form>						

					</div>
					
					<?php
					}else{
					?>
					
					<div class="panel-heading">Add new Page</div>
					<div class="panel-body">

						<form role="form" action="post.php" method="post">
							<?php
								echo "<label>Active / Inactive</label><select name='page_active' class='form-control'>";
								echo "<option value='1'>Active</option><option value='0'>Inactive</option></select>";									
								echo "<label>Link</label><input class='form-control' name='page_link' placeholder='Ex. index.php'>";								
								echo "<label>Name</label><input class='form-control' name='page_label' placeholder='Ex. Home'>";
								echo "<label>Text</label><textarea class='form-control' name='page_text' rows='3'>Ex. Page Info</textarea>";
								
								echo "<button type='submit' name='submit_page_add' class='btn btn-primary'>Save</button>";
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