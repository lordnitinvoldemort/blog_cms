<?php 

function messageerro(){
	if(isset($_SESSION['messageerro'])){
		$output="<div class=\"alert alert-danger alert-dismissible fade show\"> ";
		$output.=htmlentities($_SESSION['messageerro']);
		$output.="</div>";
		$_SESSION['messageerro']=null;
		return $output;
	}
}

function messagesucc(){
	if(isset($_SESSION["messagesucc"])){
		$output="<div class=\"alert alert-success alert-dismissible fade show\">";
		$output.=htmlentities($_SESSION["messagesucc"]);
		$output.="</div>";
		$_SESSION["messagesucc"]=null;
		return $output;
	}
}

function messagewarn(){

	if(isset($_SESSION["messagewarn"])){
		$output="<div class=\"alert alert-warning alert-dismissible fade show\"> ";
		$output.=htmlentities($_SESSION["messagewarn"]);
		$output.="</div>";
		$_SESSION["messagewarn"]=null;
		return $output;
	}
}

 ?>