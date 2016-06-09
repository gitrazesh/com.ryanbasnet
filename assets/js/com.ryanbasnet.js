/*
* @Author: Rajesh Basnet
* @Date:   2016-05-28 13:28:59
* @Last Modified by:   Rajesh Basnet
* @Last Modified time: 2016-06-09 16:09:38
*/


/*
Smooth Scrolling

*/
var SmoothScroller =(function(){
	
	var smoothScroll=function smoothScrolling(){
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

	return { smoothScroll:smoothScroll};

})();

/*
*
* Creates circle chart using jquery plugin -
*
*/
var CircleChartCreator =(function(){

	var createChart =function createCircleChart(skill_list){

		
		var chartVisible=false;
		$(window).scroll({skill_list:skill_list},isChartVisible);		
	}



	//checks skill-section  visibvility and crates chart
	function isChartVisible(event){
		skill_list=event.data.skill_list;
		 chartVisible=$('.skill-chart-list').visible();

			if(chartVisible==true){
			
				skill_list.forEach(function(skill){
		
					var className=skill.skill_name.replace(/ /g,"-"); // thi ensure the css class naming convenction if skill name has space like HTML & CSS ==>HTML-&-CSS
					var fillColor=skill.skill_color_code;
					//alert(fillColor);
					circle={
						className:className,
						fillColor:fillColor
					};
					createCircle(circle);
				});
				//remove event handler when chart is visible;
				$(window).off("scroll",isChartVisible); 
			}
		}

	

	//create a individual circle using circle chart plugin
	function createCircle(circleObject){
		
		var circleProperties={
		animate : true,
		diameter : 100,
		guage: 4,
		coverBg: '#fff',
		bgColor: '#efefef',
		fillColor: circleObject.fillColor,
		percentSize: '15px',
		percentWeight: 'normal'
		
		};

		$("."+circleObject.className).percentcircle(circleProperties);
	} //End createCircle

	return { createCircleChart:createChart };
} ());

/*
*
* AJAX form submission
*
*/
var FomrValidator=(function(){

	var checkValue=function checkValue(){

		//cached dom
		var contact_form=$("#contact-form");
		$(".input-group").removeClass("warning-border");
		$(".contact-form p").html("");

		$.ajax({

			url:baseURL+"home/processEmail",
			dataType:"json",
			data:contact_form.serialize(),
			type:"post",
			cache: false,
			success: function(response){

				if(response.error===true){
					
					var errors=response.errors;
					$.each(errors, function(k, v){
						
						var mydom=$(".form-group-"+k);
						mydom.find(".input-group").addClass("warning-border");
						mydom.find("p").html(v);
					});//End each function
				}else{
					
					var alertBox='<div class="alert alert-success text-center fade in">'+
					'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
					'<strong>'+response.message+'</strong></div>';
					$("#contact-form").find("input[type=text],input[type=email], textarea").val("");
					$(".contact-form").before(alertBox);
				}
		}
		}); //End ajax all
		
		return false;
		

	} //End checkValue fn

	return{checkValue:checkValue}
})();

/*
*
* Project item animation on hover
*
*/
var ProjectItemAnimator=(function(){

	var colorScheme=["#F94A4A","#1AF7DA","#F8F24D","#A677B8","#F79058"];
	
	$(".outer").hover(function(){
		
		var colorIndex =Math.floor((Math.random() * colorScheme.length) + 1);
		$(this).find(".overlay").css("background-color",colorScheme[colorIndex]);
		
	},
	function(){
		$(this).find(".overlay").css("background-color","none");

	});
})();


/*
*
*Css preloader,slide animation,navigation bar animation
*
*/

var PageAnimation=(function(){

		// cached DOM
			var win = $(window);
			var allMods = $(".slide-anim");

		var cssPreLoader=function(){

			setTimeout(function(){
        		$('body').addClass('loaded');
       			 $('h1').css('color','#222222');
    		}, 100);
		};


		var slideAnimation=function(){


			

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


		var animateNavBar=function animateNavBar() {
	    
		    window.addEventListener('scroll', function(e){
		        
		        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
		            shrinkOn = 180;
		        if (distanceY > shrinkOn) {
		            
		            $(".navbar-custom").addClass("navbar-dark-background");
		        } else {
		             
		             $(".navbar-custom").removeClass("navbar-dark-background");
		        }
		    });
		} //End animateHeader


		var animateScrollDownArrow=function(){

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

		return{

			cssPreLoader:cssPreLoader,
			animateNavBar:animateNavBar,
			slideAnimation:slideAnimation,
			animateScrollDownArrow:animateScrollDownArrow
		

	};

	})();