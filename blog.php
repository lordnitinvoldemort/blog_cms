<?php 
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");

global $selectdb;

$title=$_GET['title'];
$query="SELECT * FROM blogpost WHERE title='$title' ORDER BY datetime desc";
$result=mysql_query($query);


if(isset($_POST['submit'])){
	date_default_timezone_set("Asia/Kolkata");
	$time=time();
	$datetimec=strftime("%B-%d-%Y %H:%M:%S",$time);
	$title=$title;
	$name=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$comment=mysql_real_escape_string($_POST['comment']);
	$disapp=1;
	$app=0;
	
	global $selectdb;

	$query2="INSERT INTO comment (name, title, email, datetime, comment, app, disapp ) VALUES ('$name','$title','$email','$datetimec','$comment','$app','$disapp')";
	$result2=mysql_query($query2);
	
	if($result2){
		$_SESSION['messagesucc']="Comment added successfully";
	}
	else{
		$_SESSION['messageerro']="Error while submitting comment";
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
		<link rel="stylesheet" href="css/index.css">

		<style>
			.card{
				margin-left: 5px;
			}
			.btn{
				margin-top: 10px;
			}
			h3{
				color:#000000;
				font-size: 1.5rem;
				font-family:"Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-weight:200;
			}
			label{
				color:#ffffff;
			}
			.comment{
				margin-top: 2px;
				margin-bottom: 4px;
				background-color:#1E2127;
			}
			.comtext{
				color:#fff;
				margin: 0px 4px;
			}
			h4{
				color:#fff;
			}
		</style>
		
	</head>
	<body>
		<?php 
			echo messagesucc();
			echo messageerro();

		 ?>
		<div class="container">
			<div class="jumbotron">
			<div class="row">
			<div class="col-md-10">
				<div class="navi">
					<ul class="nav">
  						<li class="nav-item">
    						<a class="nav-link active" href="#">Home</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" href="#">Blog</a>
 						</li>
 						<li class="nav-item">
    						<a class="nav-link" href="#">Services</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" href="#">About Us</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" href="#">Contact Us</a>
  						</li>
  						<li class="nav-item">
    						<a class="nav-link" href="#">GTFO</a>
  						</li>

					</ul>
				</div> <!--End of Navigation -->
				
				

				<div class="post">
				<div class="row">

					<?php 
					
					while($datarow=mysql_fetch_array($result)){
						$title=$datarow['title'];
						$nameauth=$datarow['author'];
						$image=$datarow['image'];
						$category=$datarow['category'];
						$post=$datarow['post'];
						$datetime=$datarow['datetime'];
						$datetime=substr($datetime,0,12);

						echo "

					<div class=\"card mb-3\">
  						<img class=\"card-img-top\" src=\"$image\" alt=\"Card image cap\">
  						<div class=\"card-body\">

  							<div class=\"row\">
    							<div class=\"col-md-6\"><h3 class=\"card-title\">$title </h3></div>
    							<div class=\"col-md-6 text-right\"><h5>By : $nameauth</h5></div>
							</div>
    						<p class=\"card-text\">$post</p>
    						<div class=\"row\">
    							<div class=\"col-md-6\"><p class=\"card-text\"><small class=\"text-muted\"><h4>Category : $category</h4></small></p></div>
    							<div class=\"col-md-6 text-right\">$datetime</div>
  							</div>
							
  						</div>
					</div>";}
					 ?>
				 </div>
				</div> <!--End of Post -->

				<div>
					<h4>Comments:</h4>

				<?php 
					
					$query3="SELECT * FROM comment WHERE title='$title'";
					$result3=mysql_query($query3);
					
					while($datacom=mysql_fetch_array($result3)){
						$titlecom = $datacom['title'];
						$datecom = $datacom['datetime'];
						$namecom = $datacom['name'];
						$comcom = $datacom['comment'];
						$appcom = $datacom['app'];
						$discom = $datacom['disapp'];
					
					if($title == $titlecom){
						if($appcom == 1){
				echo "
				<div class=\"comment\">
					<div class=\"row\">
						<div class=\"col-md-1\">
							<img class=\"commimag\" src=\"images/pro_pic.jpg\" width=\"75\" height=\"75\" alt=\"\">
						</div>
						<div class=\"col-md-11\">
							<p class=\"comtext\"><strong>$namecom</strong></p>
							<p class=\"comtext\">$datecom</p>
							<p class=\"comtext\">$comcom</p>
							
						</div>
					</div>

				</div><!--End of Comments Display -->";
				}
				}
				}

				?>

				</div>

					
				<div>
					<form action="" method="POST">
  						<div class="form-group">
    					<label for="name">Name</label>
    					<input type="text" class="form-control" id="name" name="name" placeholder="name">
  						</div>
  						<div class="form-group">
    					<label for="email">Email address</label>
    					<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
  						</div>
  						<div class="form-group">
    					<label for="comment">Comment</label>
    					<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
    					<button type="submit" name="submit" class="btn btn-block btn-outline-info">Comment</button>
  						</div>
  					</form>
				</div><!--End of Add Comments -->
			</div>
			<div class="col-md-2">
				<form class="form-group">
					<input type="text" class="form-control" id="inlineFormInputName2" placeholder="Search"><button type="button" class="btn btn-warning btn-block">Search</button>
					
					</form>
				<h2>Hello Content Hello Content </h2>
			</div>
			</div>
			</div>
		</div>
		
	</body>
</html>