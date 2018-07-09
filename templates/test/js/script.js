
	$('#form').submit(function()
		{
		  var error="false";
		  if(!$('#form input[name="I"]').val())
		  {
		  	error="true";
		  	$('#form input[name="I"]').css("border","2px solid red");
		  }
		  else
		  {
		  	$('#form input[name="I"]').css("border","1px solid #ee803e");
		  }

		  if(!$('#form input[name="F"]').val())
		  {
		  	error="true";
		  	$('#form input[name="F"]').css("border","2px solid red");
		  }
		  else
		  {
		  	$('#form input[name="F"]').css("border","1px solid #ee803e");
		  }

		  if(!$('#form input[name="TEL"]').val())
		  {
		  	error="true";
		  	$('#form input[name="TEL"]').css("border","2px solid red");
		  }
		  else
		  {
		  	$('#form input[name="TEL"]').css("border","1px solid #ee803e");
		  }

		  var formData = new FormData($('#form')[0]);
		  if(error=="false")
		  {
		  	$.ajax({
		  		type: "POST", 
		  		processData: false,
		  		contentType: false,
		  		url: "/",
		  		data:  formData 
		  	})
		  	.done(function( data ) {
		  		console.log(data);
		  		$('#form').text("Отправлено");

		  	});
		  }
		  return false;
	});