
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

<body data-spy="scroll" data-target=".navbar">


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
      			<ul class="nav navbar-nav nav-right">
					<li><a href="#about">About</a></li>
					<li><a href="#work">Work</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Full view port size jumbotron -->
	<div class="jumbotron">
		<div class="container">
			
			<!-- Jumbotron content section -->
			<div class="row hero-content">
				<div class="col-sm-3"></div>
					<div class="col-sm-6 
								text-center">
						<h1>I'm Ryan.</h1>
						<h4>A web developer based on SYDNEY.
							I love building simple and elegant website that meets your personal purpose or business solution.</h4>
					</div>
				<div class="col-sm-3"></div>
			</div> <!-- End jumbotron content section-->
			
			<!-- Jumbotron footer section -->
			<div class="row hero-footer">
				<div class="col-sm-12">    
					<ul class="home-social-links">
            			<li >
              				<a href="" 
              					target="_blank" 
              					alt="github profile">
              					<i class="fa fa-github fa-lg" 
              						aria-hidden="true">
              					</i>
              				</a>
            			</li>
			            <li>
			              <a href="" 
			              	target="_blank">
			              	<i class="fa fa-codepen fa-lg" 
			              		aria-hidden="true">
			              	</i>
			              </a>
			            </li>
			            <li>
			              <a href="" 
			              	target="_blank">
			              	<i class="fa fa-twitter fa-lg" 
			              		aria-hidden="true">
			              	</i>
			              </a>
			            </li>
			            <li>
			              <a href="" 
			              	target="_blank">
			              	<i class="fa fa-paper-plane-o fa-lg" 
			              		aria-hidden="true">
			              	</i>
			              </a>
			            </li>
          			</ul>
				</div>
			</div> <!-- End hero-footer -->
		</div>
	</div> <!-- End of jumbotron -->

	<!-- About section -->
	<div class="container about-section" id="about">
		<article> <!-- Introduction area -->
			<div class="page-header">
				<h2 style="">Who Am I</h2>
			</div>
			<div class="profile-image-wrapper">
				<img class="profile-image img-thumbnail img-circle" 
					src="<?php echo base_url()?>assets/images/profile_img.jpg" 
					alt="Ryan Basnet">
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="content">Hi,I am freelance web developer from Sydney, Australia.
										I have a passion for web development and  love to build simple,clean and functional website. 
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</article>
		<article> <!-- Skills area -->
			<div class="page-subheader"><h3>I'm Good At</h3></div>
			<div class="row">
				<!-- <div class="col-sm-3"></div> -->
				<div class="col-sm-12">
					<div class="skill-chart-wrapper">
						<ul class="skill-chart-list">
						<?php foreach ($skill_list as $skill): ?>
							<li> <!-- circle chart -->
								<div class="panel panel-default skill-chart-panel">
									<div class="panel-body">
										<div class="<?php echo str_replace(" ","-",$skill['skill_name'])?>" data-percent="<?php echo $skill['skill_level'] ?>"></div>
									</div>
									<div class="panel-footer">
										<button class="btn btn-default" type="button"><?php echo $skill['skill_name'] ?></button></div>
								</div>
							</li>
								
							<?php endforeach ?>	
						</ul>
					</div> <!-- End skill-chart-wrapper -->
				</div>
			</div> <!-- End row -->
		</article>
		<article>
			<div class="page-subheader"><h3>How Can I Help</h3></div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6 content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quod dolorem, laborum hic et? Error, placeat pariatur</div>
				<div class="col-sm-3"></div>
			</div>
		</article>
	</div> <!-- End about section -->
	
	<!-- Work section -->
	<div class="container work-section" id="work">	
		<div class="page-header"><h2>Work</h2></div>
		<div class="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
		 <div class="row">
	        <div class="col-md-2"></div>
	              
	        <div class="col-md-8 well image-container ">  
	             <!-- image container-->     
	            

	                <div id="grid" data-columns>
	                    <?php foreach ($project_list as $project) :?> 
	                    <div class="outer"><img class="gallery-item thumbnail slide" id="1" 
	                    src="<?php echo base_url()?>assets/gallery/<?php echo $project["project_image_name"]?>" alt="">


	                    <div class="overlay"></div>
	                    <div class="project-link"><button type="button" class="btn btn-default project">View Project</button></div></div>

	                    <?php endforeach?>
	                </div>
	                      
	        </div>


            <!-- End of image-container -->
        </div>
        

        <div class="col-md-2"></div>
   </div>
	

	<!-- Contact section -->
	<div class="container contact-section" id="contact">	
			<div class="page-header">
				<h2>Contact</h2>
			</div>
			<div class="content">I would love to hear from you.
								  Drop me a line or give me a ring and lets get to know each other.
			</div>
			
			<div class="row">
				<div class="col-md-2"><!--Left Pane--></div>
				<div class="col-md-8">
					<div class="contact-form-container">
						<div class="row">

							<div class="col-sm-8 contact-form"> <!-- Contact-form -->
								<form role="form" 
									  id="contact-form"
									  onsubmit="FomrValidator.checkValue(event)">
							  			
							  			<!-- Name input field area -->
							  			<div class="form-group">
							    			<label for="email">Name:</label>
							    			<div class="input-group">
								     			<span class = "input-group-addon glyphicon glyphicon-user"></span>
								    			<input type="text" 
								    				 	class="form-control"
							    				 	id="name"
							    				 	required>
							    			</div>
							    			<span class="name-error error "></span>
							  			</div> <!-- End name input field area -->
							  			
							  			<!-- Email input  field area -->
							  			<div class="form-group">
							    			<label for="pwd">Email:</label>
							    			<div class="input-group">
							     				<span class = "input-group-addon">@</span>
							    				<input type="email"
							    						class="form-control"
							    						id="email"
							    						required>
							    			</div>
							    			<span class="email-error error "></span>
							  			</div> <!-- End email input field area -->
							  			
							  			<!-- Message textarea -->
							  			<div class="form-group">
							    			<label for="pwd">Message:</label>
											<div class="input-group">
							     				<span class = "input-group-addon glyphicon glyphicon-comment"></span>
							    				<textarea class="form-control" id="message" rows="10" required></textarea>
							    			</div>
							   				<span class="error message-error"></span>
							  			</div> <!-- End message textarea -->

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

									<dt>FINDE ME ON</dt>
									<dd>
										<ul class="contact-info-social-links">
											<li>
												<a href="" 
													target="_blank"
													alt="github profile">
														<button class="btn btn-default">
															<i class="fa fa-github fa-2x" 
																aria-hidden="true">
															</i>
														</button>
												</a>
											</li>
											<li>
												<a href=""
													target="_blank"
													alt="github profile">
														<button class="btn btn-default">
															<i class="fa fa-codepen fa-2x"
																aria-hidden="true">
															</i>
														</button>
												</a>
											</li>
											<li>
												<a href=""
													target="_blank"
													alt="github profile">
														<button class="btn btn-default">
															<i class="fa fa-linkedin fa-2x"
																aria-hidden="true">
															</i>
														</button>
												</a>
											</li>
										</ul>
									</dd>
								</dl>
							</div> <!-- End contact-details -->
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
				<div class="footer"><small>&copy 2016 ryan</small></div>
			</div>
		</div>
	</footer>

<script  src="<?php echo base_url()?>assets/js/salvattore.js"></script>
<script  src="<?php echo base_url()?>assets/js/jquery.visible.js"></script>
<script  src="<?php echo base_url()?>assets/js/com.ryanbasne.js"></script>

<script>

$(document).ready(function(){	

//Darken navigation header on scrolling
 AnimateNavHeader.animateHeader();

//smooth scroller
SmoothScroller.smoothScroll();

//Getting data for the circle chart animation 
var skill_list =<?php echo json_encode($skill_list); ?>;
var arrayForCircleChart=[];
for (var i=0;i<skill_list.length; i++){
	
	var className=skill_list[i].skill_name.replace(/ /g,"-"); // thi ensure the css class naming convenction if skill name has space like HTML & CSS ==>HTML-&-CSS
	var fillColor=skill_list[i].skill_color_code;
	//alert(fillColor);
	circle={
		className:className,
		fillColor:fillColor
	};
	arrayForCircleChart.push(circle);
}

//animating circle when circle chart area is visible
var chartVisible=false;
$(window).scroll(function(){

	chartVisible=$('.skill-chart-list').visible();
	if(chartVisible==true){
		CircleChartCreator.createCircleChart(arrayForCircleChart);
		$(window).off("scroll");
	}
});


}); //End document ready function

</script>

</body>
</html>