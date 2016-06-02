/*
* @Author: Rajesh Basnet
* @Date:   2016-05-28 13:28:59
* @Last Modified by:   Rajesh Basnet
* @Last Modified time: 2016-05-30 00:32:41
*/

//module to animate the navigation header on page scroll
var AnimateNavHeader =(function(){


	var animateNavHeader=function animateHeader() {

    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 180;

        if (distanceY > shrinkOn) {
            $(".navbar-default").addClass("navbar-dark-background");
        } else {
             $(".navbar-default").removeClass("navbar-dark-background");
        }
    });
	}

	return{ animateHeader:animateNavHeader};

}());


//Smooth scrolling
var SmoothScroller =(function(){
	
	var smoothScroll=function smoothScrolling(){
	  // Make sure this.hash has a value before overriding default behavior
	  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
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
	};

	return { smoothScroll:smoothScroll};

})();


// module to create a cirle chart using jquery plugin
var CircleChartCreator =(function(){
		

	//iterates through array of circles to be made in chart 
	var createChart =function createCircleChart(circleArray){

		for (var i = 0;i<circleArray.length; i++){

			createCircle(circleArray[i]);
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
	}

	return { createCircleChart:createChart };
} ());

//module to validate the form

var FomrValidator=(function(){


	// cached dom
	var name=$("#name");
	var email=$("#email");
	var message=$("#message");
	
	var checkValue=function checkValue(event){
	
		var isNameValid=checkName(name);
		var ischeckEmailValid=checkEmail(email);
		var ischeckMessageValid=checkMessage(message);
			
		if( isNameValid && isEmailValid && isMessageValid){

		}

		else{

			alert("validation failed");

			event.preventDefault();
		}



		}


	function checkName(elem){
		var nameRegx = new RegExp("^[a-zA-Z]{3,8}$");


		if(nameRegx.test(elem.val())){

			elem.parent().removeClass("warning-border");
			$(".name-error").html("");
			return true;
		}

		else{

			$(".name-error").html("Please enter valid name");
			elem.parent().addClass("warning-border");
			
		}


	}

	function checkEmail(elem){

		var emailRegex=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(emailRegex.test(elem.val())){

			$(".email-error").html("");
			elem.parent().removeClass("warning-border");
			return true;

		}

		else{
			$(".email-error").html("Please enter valid name");
			elem.parent().addClass("warning-border");
			return false;
		}

	}

	function checkMessage(elem){
		var messageRegx= new RegExp("^[A-Za-z0-9 ]+");
		if(messageRegx.test(elem.val())){

			$(".message-error").html("");
			elem.parent().removeClass("warning-border");
			return true
		}

		else{
			
			$(".message-error").html("Please enter valid message.");
			elem.parent().addClass("warning-border");
			return false;
		}
	}

	return{checkValue:checkValue}
})();

var ProjectItemAnimator=(function(){

	var colorScheme=["#F94A4A","#1AF7DA","#F8F24D","#A677B8","#F79058"];
	$(".outer").hover(function(){
		var colorIndex =Math.floor((Math.random() * colorScheme.length) + 1);
		$(this).find(".overlay").css("background-color",colorScheme[colorIndex]);
		

	},function(){
		$(this).find(".overlay").css("background-color","none");

	});



})();
