/*
* @Author: Ryan Basnet
* @Date:   2016-11-14 16:17:24
* @Last Modified by:   Ryan Basnet
* @Last Modified time: 2016-11-29 20:26:37
*/



var Delete = (function(e){

		var showConfirm;
		var DeleteItem;




		showConfirm = function(element){

			
    		var url = $(element).data('href');
    		$('#confirmation-modal').data('url',url);
    		
    
    		$('#confirmation-modal').modal('show');

		};

		deleteItem = function(e){


        var url =$('#confirmation-modal').data('url');
        window.location.href = url;
        $('#confirmation-modal').modal('hide');
		};

		return {	
					confirm : showConfirm,

					delete:deleteItem

				};


})();




 $(".dismiss").click(function() {
    $("#feedback").addClass("dismissed");
  });