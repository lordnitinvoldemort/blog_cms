<?php 
require_once("include/db.php");
require_once("include/session.php");
require_once("include/function.php");

global $selectdb;

$query="SELECT * FROM blogpost ORDER BY datetime desc";
$result=mysql_query($query);

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
		
	</head>
	<body>
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
					$post=substr($post,0,100).".....";
					$datetime=$datarow['datetime'];
					$datetime=substr($datetime,0,12);

				 
					echo "	
							<div class=\"card\" style=\"width: 18rem;\">
  								<img class=\"card-img-top\" src=\"$image\" alt=\"Card image cap\">
  							<div class=\"card-body\">
    							<h5 class=\"card-title\">$title</h5>
    							<p class=\"card-text\"> $post</p>
  							</div>
  								<ul class=\"list-group list-group-flush\">
    								<li class=\"list-group-item\">Date: $datetime</li>
    								<li class=\"list-group-item\">Author: $nameauth</li>
    								<li class=\"list-group-item\">Category:$category</li>
    								<li class=\"list-group-item\">Comments: <span class=\"badge badge-primary\">5</span></li>
								</ul>
  							<div class=\"card-body\">
    							<a href=\"blog.php?title=$title\" class=\"card-link\">Read More</a>
  							</div>
						
						</div>";
					
				}

				 ?>
				 </div>
				</div> <!--End of Post -->
					
				
			</div>
			<div class="col-md-2">
				<form class="form-group">
					<input type="text" class="form-control" id="inlineFormInputName2" placeholder="Search"><button type="button" class="btn btn-warning btn-block">Search</button>
					
				</form>
				<div class="card card-side bg-light mb-3" style="max-width: 18rem;">
  					<div class="card-header">Categories</div>
  					<div class="card-body">
   					 <p class="card-text"></p>
  				</div>
				</div>
				
			</div>
			</div>
			</div>
		</div>
		
	</body>
</html>