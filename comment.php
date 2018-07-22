<?php 
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");

$selectdb;
					
	$query1="SELECT * FROM comment ORDER BY datetime desc";
	$result1=mysql_query($query1);
	$bg = 0;

	while($datarow=mysql_fetch_array($result1)){
		$discom = $datarow["disapp"];
		
		if($discom == 1){
			$bg = ++$bg;
		}
	}
 ?>
<?php
if(isset($_POST['approv'])){
	$appcom=$_GET['comm'];
	$selectdb;
	
	$app = 1;
	$disapp= 0;
	
	$query2="UPDATE comment SET app='$app', disapp='$disapp' WHERE comment='$appcom'";
	$result2=mysql_query($query2);
	header('Location: comment.php');
}
?>
<?php
if(isset($_POST['delete'])){
	$appcom=$_GET['comm'];
	$selectdb;
	
	$query3="DELETE FROM comment WHERE comment = '$appcom'";
	$result3=mysql_query($query3);
	header('Location:comment.php');
}
?>
<?php
if(isset($_POST['disapprov'])){
	$appcom=$_GET['comm'];
	$selectdb;
	
	$app = 0;
	$disapp= 1;
	
	$query2="UPDATE comment SET app='$app', disapp='$disapp' WHERE comment='$appcom'";
	$result2=mysql_query($query2);
	header('Location: comment.php');
}
?>
<html>
	<head>
		<title>
			CMS Home
		</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<link rel="stylesheet" href="css/admin.css">
		<style>
		form{
		margin:0px 0px;
		}
		</style>
	</head>
	<body>
		<?php echo messageerro(); ?>
		<?php echo messagesucc(); ?>
		<?php echo messagewarn(); ?>

		<div class="container">
			<div class="jumbotron">
			<div class="row">
			<div class="col-md-2">
				<h2><span class="glyphicons glyphicons-film"></span>Admin</h2>
				<ul class="nav flex-column nav-pills">
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="admin.php">Dashboard</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="blogpost.php">Add New Post</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="categories.php">Categories</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Manage Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block  active" href="comment.php">Comments <span class="badge badge-light"><?php echo $bg;?></span></a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Live Blog</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Logout</a></li>

				</ul>
			</div> <!-- End of Navigation -->
			<div class="col-md-10">
				<h2>Manage Comments</h2>
				<h3>Dis-approved Comments:</h3>
				
				<div class="table-responsive">
				<table class="table table-striped table-dark table-hover table-bordered">
					<tr>
						<th>#</th>
						<th>Comment</th>
						<th>Blog</th>		
						<th>Date Added</th>
						<th>Added By</th>
						<th>Approve</th>
						<th>Delete</th>
						
					</tr>
					
					<?php 
					$selectdb;
					
					$query1="SELECT * FROM comment ORDER BY datetime desc";
					$result1=mysql_query($query1);
					$sn = 0;

					while($datarow=mysql_fetch_array($result1)){
						$comcom = $datarow["comment"];
						$title=$datarow['title'];
						$datetime = $datarow["datetime"];
						$nameauth = $datarow["name"];
						$discom = $datarow["disapp"];
						
						if($discom == 1){
							$sno = ++$sn;
						echo "<tr>
								<td>$sno</td>
								<td>$comcom</td>
								<td>$title</td>
								<td>$datetime</td>
								<td>$nameauth</td>
								<td><form action=\"comment.php?comm=$comcom\" method=\"POST\"><button type=\"submit\" name=\"approv\" class=\"btn btn-primary btn-sm\">Approve</button></form></td>
								<td><form action=\"comment.php?comm=$comcom\" method=\"POST\"><button type=\"submit\" name=\"delete\" class=\"btn btn-danger btn-sm\">Delete</button></form></td>
							</tr>

						";
						}
					}	


					 ?>

				</table>
			</div> <!-- End of Table -->
			
			<h3>Approved Comments:</h3>
				
				<div class="table-responsive">
				<table class="table table-striped table-dark table-hover table-bordered">
					<tr>
						<th>#</th>
						<th>Comment</th>
						<th>Date Added</th>
						<th>Added By</th>
						<th>Approved By</th>
						<th>Disapprove</th>
						
					</tr>
					
					<?php 
					$selectdb;
					
					$query1="SELECT * FROM comment ORDER BY datetime desc";
					$result1=mysql_query($query1);
					$sn = 0;

					while($datarow=mysql_fetch_array($result1)){
						$comcom = $datarow["comment"];
						$datetime = $datarow["datetime"];
						$nameauth = $datarow["name"];
						$apcom = $datarow["app"];
						
						if($apcom == 1){
							$sno = ++$sn;
						echo "<tr>
								<td>$sno</td>
								<td>$comcom</td>
								<td>$datetime</td>
								<td>$nameauth</td>
								<td>Nitin</td>
								<td><form action=\"comment.php?comm=$comcom\" method=\"POST\"><button type=\"submit\" name=\"disapprov\" class=\"btn btn-warning btn-sm\">Disapprove</button></form></td>
							</tr>

						";
						}
					}	


					 ?>

				</table>
			</div> <!-- End of Table -->

			</div> <!-- End of Form Styling -->

			
		</div> <!-- End of Row -->
		</div> <!-- End of Jumbotron -->
		</div> <!-- End of Container -->
		
	</body>
</html>