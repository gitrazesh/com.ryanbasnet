
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
		<article>
			<div class="page-header">
				<h2 style="">Who Am I</h2>
			</div>
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
		</article>
		<div class="page-subheader"><h3>I'm Good At</h3></div>
		<div class="row">
			<!-- <div class="col-sm-3"></div> -->
			<div class="col-sm-12">
				<div class="skill-chart">
					<ul class="skill-list">
						<li> <!-- HTML -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="html" data-percent="70"></div>
								</div>
								<div class="panel-footer">
									<button class="btn btn-primary" type="button">HTML & CSS</button></div>
							</div>
						</li>
						<li> <!-- js -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="html" data-percent="60"></div>
								</div>
								<div class="panel-footer">
									<button class="btn btn-warning" type="button">Javascript</button></div>
							</div>
						</li>
						<li> <!-- php -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="php" data-percent="65"></div>
								</div>
								<div class="panel-footer">
									<button class="btn btn-danger" type="button">PHP</button></div>
							</div>
						</li>
						<li> <!-- java -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="java" data-percent="65"></div>
								</div>
								<div class="panel-footer">
									<button class="btn btn-success" type="button">Java</button></div>
							</div>
						</li>
						<li> <!-- c-sharp -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="c-sharp" data-percent="60"></div>
								</div>
								<div class="panel-footer">
									<button class="btn btn-danger" type="button">C#</button></div>
							</div>
						</li>
			
					</ul>
			</div>

			</div>
			<!-- <div class="col-sm-3"></div> -->
		</div>
		<div class="page-subheader"><h3>How Can I Help</h3></div>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6 content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quod dolorem, laborum hic et? Error, placeat pariatur</div>
			<div class="col-sm-3"></div>

		</div>
		<br>
		<br>
		<br>
		<br>
	</div>

	<!-- Work section -->
	<div class="container">	
		<div class="page-header"><h2>Work</h2></div>



	</div>


	<!-- Contact section -->
	<div class="container" id="contact-section">	
		<div class="page-header"><h2>Contact</h2></div>
		<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
		<div class="row">
			<div class="col-md-2"><!--Left Pane--></div>
			<div class="col-md-8">
				<div class="contact-form-container">
					<div class="row">
						
						<div class="col-sm-8 contact-form"> <!-- Contact-form -->


							<form role="form" id="contact-form">
							  <div class="form-group">
							    <label for="email">Name:</label>
							    <div class="input-group">
							     <span class = "input-group-addon glyphicon glyphicon-user"></span>
							    <input type="email" class="form-control" id="email">
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Email:</label>
							    <div class="input-group">
							     <span class = "input-group-addon">@</span>
							    <input type="email" class="form-control" id="email">
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Message:</label>

							    <textarea class="form-control"  rows="10"></textarea>
							  </div>

							  <div class="form-group">
							  <button type="submit" class="btn btn-success">Submit</button>
							  </div>
							</form>

						</div> <!-- End contact-form -->
						<div class="col-sm-4 visible-sm visible-md visible-lg  contact-details">
							<dl class="contact-info">
								<dt>EMAIL</dt>
								<dd>rajesh2045@gmail.com</dd>
								<dt>TELEPHONE</dt>
								<dd>+61433371679</dd>
								<dt>ADRESS</dt>
								<dd>
								<adress>13 St Georges Pde<br>
								Hurstville<br>
								NSW 2220<br>Australia</adress></dd>

								<dt>ELSEWHERE</dt>
								<dd>
									
									<ul class="contact-info-social-links">
									<li><a href="" target="_blank" alt="github profile"><button class="btn btn-default"><i class="fa fa-github fa-2x" aria-hidden="true"></i></i></button></a></li>
									<li><a href="" target="_blank" alt="github profile"><button class="btn btn-default"><i class="fa fa-codepen fa-2x" aria-hidden="true"></i></i></button></a></li>
									<li><a href="" target="_blank" alt="github profile"><button class="btn btn-default"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></i></button></a></li></ul>


								</dd>
							</dl>

						</div>
						</div>
					
				</div>
			</div>
			<div class="col-md-2"><!--Right Pane--></div>

		</div>



	</div>

	<!-- Footer -->

	<footer>
		<div class="container">
			<div class="row">
				<div class="cr-banner"><small>&copy 2016 ryan</small></div>
			</div>
		</div>
	</footer>














<script>	



$(document).ready(function(){


function init() {

    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 180,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            $(".navbar-default").addClass("navbar-overlay");
        } else {
             $(".navbar-default").removeClass("navbar-overlay");
        }
    });
}
window.onload = init();








$('.html').percentcircle({

animate : true,
diameter : 100,
guage: 2,
coverBg: '#fff',
bgColor: '#efefef',
fillColor: '#5c93c8',
percentSize: '15px',
percentWeight: 'normal'
});

$('.php').percentcircle({

animate : true,
diameter : 100,
guage: 2,
coverBg: '#fff',
bgColor: '#efefef',
fillColor: '#C70039',
percentSize: '15px',
percentWeight: 'normal'
});
$('.java').percentcircle({

animate : true,
diameter : 100,
guage: 4,
coverBg: '#fff',
bgColor: '#efefef',
fillColor: 'green',
percentSize: '15px',
percentWeight: 'normal'
});
$('.c-sharp').percentcircle({

animate : true,
diameter : 100,
guage: 2,
coverBg: '#fff',
bgColor: '#efefef',
fillColor: 'red',
percentSize: '15px',
percentWeight: 'normal'
});



});




</script>


</body>

</html>