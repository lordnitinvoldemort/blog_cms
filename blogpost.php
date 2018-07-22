<?php 
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");

global $selectdb;
					
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
$t0 = $c0 = $f0 = $p0 = 0;
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");
if(isset($_POST["submit"])){
if(preg_match('/^[A-Za-z0-9 ]*$/', $_POST['title'])){
	if(strlen($_POST['title'])<=0){
		$_SESSION["messagewarn"]="Title cannot be empty.";
		$t0 = 0;		
	}
	elseif(strlen($_POST['title'])>49){
		$_SESSION["messagewarn"]="Not more than 50 characters!!!";
		$t0 = 0;
	}
	else{
	$title=mysql_real_escape_string($_POST['title']);
	date_default_timezone_set("Asia/Kolkata");
	$currenttime=time();
	$datetime=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
	$admin="Nitin Todi";
	$t0 = 1;
	}

	if(strlen($_POST['category'])<=0){
		$_SESSION["messagewarn"]="Category field cannot be empty.";
		$c0 = 0;
	}
	else{
		$category=$_POST["category"];
		$c0 = 1;
	}

	
	if(strlen($_POST['finalpost'])<=0){
		$_SESSION["messagewarn"]="Post field cannot be empty.";
		$p0 = 0;
	}
	elseif(strlen($_POST['finalpost'])>1999){
		$_SESSION["messagewarn"]="Post field not more than 2000 characters!!!";
		$p0 = 0;
	}
	else{
		$finalpost=$_POST["finalpost"];
		$p0 =1;
	}

	$target_dir = "uploads/";
	$target_file = $target_dir .basename($_FILES["image"]["name"]);
	$imageFileName = strtolower(pathinfo($target_file,PATHINFO_BASENAME));
	$target_file = $target_dir .$currenttime.basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
    	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        
        $uploadOk = 0;
    }
	}

	if (file_exists($target_file)) {
    	$_SESSION["messagewarn"]="Sorry, file already exists.";
    $uploadOk = 0;
	}
	
	if ($uploadOk == 1 && $t0==1 && $c0==1 && $p0 == 1) {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $f0 = 1;
    	} else {
        $f0 = 0;
    	}
	// if everything is ok, try to upload file
	} else {
    $f0 = 0;
	}

	if($t0 == 1 && $c0 == 1 && $f0 == 1 && $p0 == 1){
		global $selectdb;

		$query5="INSERT INTO blogpost (datetime, title, author, image, category, post) VALUES ('$datetime', '$title', '$admin', '$target_file', '$category','$finalpost')";
		$result5=mysql_query($query5);

			if($result5){	
				$_SESSION["messagesucc"]=" Form Submitted Successfully.";
			}
			else{
				$_SESSION["messageerro"]="Database Error Occured";
	}		}
	else{
		$_SESSION["messageerro"]="Error while submitting the form.";
	}		
	
}
else{
	$_SESSION["messagewarn"]="Title Name must be Alpha-Numeric Only.";
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
					<li class="nav-item"><a class="btn btn-outline-primary btn-block active" href="blogpost.php">Add New Post</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="categories.php">Categories</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Manage Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="comment.php">Comments <span class="badge badge-light"><?php echo $bg;?></span></a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Live Blog</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary btn-block" href="www.google.com">Logout</a></li>

				</ul>
			</div> <!-- End of Navigation -->
			<div class="col-md-10">
				<h2>New Blog Post</h2>
				<h3>Add New Blog:</h3>
				<div>
					<form action="blogpost.php" method="POST" enctype="multipart/form-data">
						 <div class="form-row">
    						<div class="form-group col-md-6">
      							<label class="label" for="title">Title</label>
      							<input type="text" class="form-control" id="title" name="title" placeholder="Title">
    						</div>
    						<div class="form-group col-md-6">
      							<label class="label" for="category">Category</label>
      							<select class="custom-select mr-sm-2" name="category" id="inlineFormCustomSelect">
        							<option value="" selected>Choose...</option>
        							<?php 
        								$selectdb;

        								$query2="SELECT name FROM category";
        								$result2=mysql_query($query2);

        								while($datarow=mysql_fetch_array($result2)){
        									$option=$datarow['name'];

        									echo "<option value=\"$option\">$option</option>";
        								}

        							 ?>
      							</select>
    						</div>
  						 </div>
  						 <div class="custom-file">
    							<input type="file" for="file" name="image" class="custom-file-input">
    							<label class="custom-file-label" id="file">Choose a file....</label>
  						 </div>
   						  <div class="form-group">
    							<label class="label" for="exampleFormControlTextarea1">Post Area</label>
    							<textarea class="form-control" id="exampleFormControlTextarea1" name="finalpost" rows="3"></textarea>
    							<small id="passwordHelpBlock" class="form-text text-muted">
  									*Your post must not be greater than 2000 characters.
								</small>
  						 </div>
  						 
  						 <button type="submit" name="submit" class="btn btn-success">Post it.</button>
 						 
					</form>	
				</div> <!-- End of Form -->
			</div> <!-- End of Form Styling -->

			
		</div> <!-- End of Row -->
		</div> <!-- End of Jumbotron -->
		</div> <!-- End of Container -->
		
	</body>
</html>