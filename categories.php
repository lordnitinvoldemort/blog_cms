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
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");
$namerr="";
if(isset($_POST["submit"])){
if(preg_match('/^[A-Za-z0-9 ]*$/', $_POST['name'])){
	if(strlen($_POST['name'])>49){
		$_SESSION["messagewarn"]="Not more than 100 characters!!!";
	}
	else{
	$name=mysql_real_escape_string($_POST['name']);
	date_default_timezone_set("Asia/Kolkata");
	$currenttime=time();
	$datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
	$admin="Nitin Todi";

	global $selectdb;

	$query="INSERT INTO category (datetime, name, nameauth) VALUES ('$datetime', '$name', '$admin')";
	$result=mysql_query($query);

		if($result){	
			$_SESSION["messagesucc"]="Form Submitted Successfully.";
		}
		else{
			$_SESSION["messageerro"]="Error while submitting the form.";
		}
	}
}
else{
	$_SESSION["messageerro"]="Category Name must be Alpha-Numeric Only.";
}
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
					<li class="nav-item"><a class="btn btn-outline-primary btn-block  active" href="categories.php">Categories</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Manage Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="comment.php">Comments <span class="badge badge-light"><?php echo $bg;?></span></a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Live Blog</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Logout</a></li>

				</ul>
			</div> <!-- End of Navigation -->
			<div class="col-md-10">
				<h2>Categories</h2>
				<h3>Add New Category:</h3>
				<div>
					<form class="form-inline" action="categories.php" method="POST">
						
 						 <div class="form-group mb-2">
    					 <label class="label" for="staticEmail2">Name of the Category:</label>
  						 </div>
  						 <div class="form-group mx-sm-4 mb-2">
    					 <input type="text" class="form-control" name="name" placeholder="Name of the Category...">
  						 </div>
  						 <button type="submit" name="submit" class="btn btn-outline-success mb-2">Add</button>
					</form>	
				</div> <!-- End of Form -->

				<div class="table-responsive">
				<table class="table table-striped table-dark table-hover table-bordered">
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Date Added</th>
						<th>Added By</th>
					</tr>
					
					<?php 
					$selectdb;

					$query1="SELECT * FROM category ORDER BY datetime desc";
					$result1=mysql_query($query1);
					$sn = 0;

					while($datarow=mysql_fetch_array($result1)){
						$sno = ++$sn;
						$name = $datarow["name"];
						$datetime = $datarow["datetime"];
						$nameauth = $datarow["nameauth"];

						echo "<tr>
								<td>$sno</td>
								<td>$name</td>
								<td>$datetime</td>
								<td>$nameauth</td>
							</tr>

						";

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