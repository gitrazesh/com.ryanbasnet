<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-2.2.3.min.js" ></script>
	
</head>
<body>
<a href="<?php echo base_url() ?>"home/test></a>
<button id="test">Click Me</button>
	<script>

	$("#test").click(function(){

			// alert("button clicked");
		$.ajax({
			url:"<?php echo base_url()?>home/processEmail",
			dataType:"json",
			type:"post",
			cache: false,
			success: function(response){

				alert("success");
			}


		});


	});


	</script>
</body>
</html>