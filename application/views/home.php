
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="author" content="Ryan Basnet">
	<title>Ryan</title>
	<meta name="description" content="web developer portfolio">
	
	<!-- Jquery CDN -->
	<script   src="https://code.jquery.com/jquery-2.2.3.min.js" ></script>
	<!-- Bootstrap js -->
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- Jquery circle chart plugin -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.circlechart.js"></script>
	<!-- Web fonts -->
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
	<!-- FontAwesome CDN -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<!-- Bootstrap css -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Master css -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ryan-basnet.css">
	

	<!-- Testing style sheet -->
	<style>
		
		.container{
			height: 100%;
			width: 100%;
			position: relative;
			

		}
	</style>
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-nav">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- Logo -->
				<a class="navbar-brand" href=""><img id="logo" src="<?php base_url()?>assets/images/ryan_basnet_logo.png" alt="Ryan Basnet"></a>
			</div>

			 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      			<ul class="nav navbar-nav navbar-right">
					<li><a href="">About</a></li>
					<li><a href="">Work</a></li>
					<li><a href="">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Full view port size jumbotron -->
	<div class="jumbotron">
		<div class="container">
			<div class="row hero-content">
				
				<div class="col-sm-3"></div>
				<div class="col-sm-6 text-center">
				<h1>I'm Ryan.</h1>
				<h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias at molestiae id totam ipsum nam possimus eos fugit ad ipsam nostrum dicta, cum provident optio.</h4>
				</div>
				<div class="col-sm-3"></div>
			</div> <!-- End hero-content -->
			
			<div class="row hero-footer">
				
				<div class="col-sm-12">    
					<ul id="home-social-links">
            			<li >
              				<a href="" target="_blank" alt="github profile"><i class="fa fa-github fa-lg" aria-hidden="true"></i></a>
            			</li>
			            <li>
			              <a href="" target="_blank"><i class="fa fa-codepen fa-lg" aria-hidden="true"></i></a>
			            </li>
			            <li>
			              <a href="" target="_blank"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
			            </li>
			            <li>
			              <a href="" target="_blank"><i class="fa fa-paper-plane-o fa-lg" aria-hidden="true"></i></a>
			            </li>
          			</ul>
				</div>
				
			</div> <!-- End hero-footer -->
		</div>
	</div> <!-- End of jumbotron -->

	<!-- About section -->
	<div class="container about">
		<div class="page-header">
		<h2>Who Am I</h2></div>
		<div class="img-wrapper">
			<img class="profile-img img-circle" src="<?php echo base_url()?>assets/images/profile_img.jpg" alt="">
		</div>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6 content">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta optio nobis atque harum, quisquam. Corrupti atque modi itaque totam dolorum enim minus quidem mollitia inventore, illo autem dele. 
			</div>
			<div class="col-sm-3"></div>
		</div>
		<div class="page-subheader"><h3>I'm Good At</h3></div>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"></div>
			<div class="col-sm-3"></div>
		</div>
	</div>

















</body>

</html>