/*
* @Author: Rajesh Basnet
* @Date:   2016-05-28 13:28:59
* @Last Modified by:   Rajesh Basnet
* @Last Modified time: 2016-06-10 15:32:12
*/


/*
*
* Validator module [ validateForm ]
*
*/
var Validator=(function(e){


	var validateForm =function (e){
		
		e.preventDefault();
		
		var contact_form=$("#contact-form");
		$(".contact-form").find(".error").html("");

		$.ajax({

			url:"/processEmail",
			
			data:contact_form.serialize(),
			dataType:"json",
			type:"post",
			cache: false,
			success: function(response,status,xhr){
				
				var statusCode = xhr.status;
				
				if(statusCode==200){
					
					$("#contact-form").find("input[type=text],input[type=email], textarea").val("");
					
					$("#feedback").removeClass("alert-danger");
					
					$("#feedback").addClass("alert-success");
       				
       				$("#feedback").find("p").html('Thank you, your message has been sent!');
       				
       				$("#feedback").removeClass("hidden");
       			 	
       			 	$("#feedback").fadeTo(2000, 500).slideUp(1500, function(){
           			
           			$("#feedback").alert('close');});

				  
				}		
							
		},
		
		error: function(xhr, textStatus, errorThrown){
		 	
		 	var response =xhr.responseJSON;

       		var statusCode = xhr.status;
       		
       		if(statusCode ==422){
       			
       			$("#feedback").removeClass("alert-danger");
       			$("#feedback").addClass("alert-danger");

       			$("#feedback").find("p").html('Please check errors and submit again.');
       			$("#feedback").removeClass("hidden");

       			$.each(response,function(k,v){
       				
       				var mydom=$(".form-group-"+k);
						mydom.find(".input-group").addClass("has-error");
						mydom.find("p").html(v);
				});

       		}else{

       			$("#feedback").addClass("alert-danger");
       			$("#feedback").find("p").html('Sorry Something went wrong, try again');
       		}
    	}
	}); //End ajax all
		
		return false;
		
	} //End checkValue fn

	return{validateForm:validateForm}
})();
//End of Validator module




/*
*
* Project module [ overlay, showProjectModal]
*
*/
var Project=(function(){

	var colorScheme=["#F94A4A","#1AF7DA","#F8F24D","#A677B8","#F79058"];
	
	
	var overlay=function(elem){

	
		var colorScheme=["#F94A4A","#1AF7DA","#F8F24D","#A677B8","#F79058"];
		var colorIndex =Math.floor((Math.random() * colorScheme.length) + 1);
		$(elem).find(".overlay").css("background-color",colorScheme[colorIndex]);
	
		
	}
	

	var showProjectModal = function(elem){


		
		var projectId = $(elem).data('id');
		console.log(projectId);

$.getJSON( "/project/"+projectId, function( data ) {
  						
 				var clientName = data.client_name;
 				var projectName = data.project_name;
 				var projectDescription = data.project_description;
 				var imageUrl = data.project_image_url+"/project_thumbnail.jpg";
 				var siteUrl = data.project_url;

 				$("#project-modal").find("h3").html(clientName);
 				$("#project-modal").find("#project-image").attr("src",imageUrl);
 				$("#project-modal").find(".project-name").html(projectName);
 				$("#project-modal").find(".project-description").html(projectDescription);

  					
		}).done(function(){

			$("#project-modal").modal('show');

		}).fail(function(){

				alert("Sorry something wen wrong.");
		});
 
// });


		// $("#project-modal").modal('show');

		
	}

	return {showProjectModal:showProjectModal,
		overlay:overlay};

})();
//End of project module


/*
*
* Animation module [CssPreloader, slideAnimation, animateNavbar]
*
*/

var Animation=(function(){

	$(document).ready(function(){


	

	// cached DOM
	var win = $(window);
	var allMods = $(".slide-anim");

	var init ={};
	

	/**
	 * [smoothScroll smooth scrolling anchor]
	 * @return {[void]} [add time for scrolling page content]
	 */
	init.smoothScroll=function(){
	  // Make sure this.hash has a value before overriding default behavior
	 	$(".navbar a,.scroll-down-arrow a, footer a[href='#myPage']").on('click', function(event) {
	  		if (this.hash !== "") {
	    		// Prevent default anchor click behavior
	   			 event.preventDefault();

	    		// Store hash
	    		var hash = this.hash;

			    // Using jQuery's animate() method to add smooth page scroll
			    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
			    $('html, body').animate({
			      scrollTop: $(hash).offset().top
			    }, 900, function(){

			      // Add hash (#) to URL when done scrolling (default click behavior)
			      window.location.hash = hash;
			      });
	    	} // End if
  		});
	 }; //End smoothScrolling


	 /**
	  * [animateNavBar animate navbar]
	  * @return {[void]} [add dark bgc to navbar on page scroll down]
	  */
	 init.animateNavBar=function () {
	    
		    window.addEventListener('scroll', function(e){
		        
		        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
		            shrinkOn = 180;
		        if (distanceY > shrinkOn) {
		            
		            $(".navbar-custom").addClass("navbar-dark-background");
		        } else {
		             
		             $(".navbar-custom").removeClass("navbar-dark-background");
		        }
		    });
		} //End animateNavBar



		/**
		 * [animateScrollDownArrow animate scroll down arrow in landing page]
		 * @return {[type]} [description]
		 */
		init.animateScrollDownArrow=function(){

			win.scroll(function(){
				var sctop=win.scrollTop();
		
		if(sctop>200){

			$(".scroll-down-arrow").hide();
		}
		else{

			$(".scroll-down-arrow").show();
		}

    });
		}


		

		init.cssPreLoader=function(){


			setTimeout(function(){
				
        		$("body").addClass('loaded');
       			 $('h1').css('color','#222222');
       			 // alert('iam ready inside');
    		}, 300);

		};

		init.slideAnimation=function(){

			// Already visible modules
			allMods.each(function(i, element) {

		  		var element = $(element);
		  		if (element.visible(true)) {
		    	
		    	element.addClass("already-visible"); 
		  		} 
			});

			win.scroll(function(event) {

		  		allMods.each(function(i, element) {
		    		var element = $(element);
		    		if (element.visible(true)) {
		      		
		      		element.addClass("slide-in"); 
		    		} 
		  		});
		 	});
		};


		


			init.smoothScroll();
			init.animateNavBar();
			init.animateScrollDownArrow();
			init.cssPreLoader();

			init.slideAnimation();

		});

	})();