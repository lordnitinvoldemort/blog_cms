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
		<div class="container">
			<div class="jumbotron">
			<div class="row">
			<div class="col-md-2">
				<h2><span class="glyphicons glyphicons-film"></span>Admin</h2>
				<ul class="nav flex-column nav-pills">
					<li class="nav-item"><a class="btn btn-outline-primary btn-block active" href="admin.php">Dashboard</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="blogpost.php">Add New Post</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="categories.php">Categories</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Manage Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="comment.php">Comments <span class="badge badge-light"><?php echo $bg;?></span></a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Live Blog</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Logout</a></li>

				</ul>
			</div>
			<div class="col-md-10">
				<h2>Hello Content Hello Content </h2>
			</div>
			</div>
			</div>
		</div>
		
	</body>
</html>