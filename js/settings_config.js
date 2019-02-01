// Abolfazl Ghaffari - 2018-12-20
function test_connection()
{
	$('.loader').show();
	var data = {
		type: 'test_connection',
		address: $('#address').val(),
		database: $('#database').val(),
		username: $('#username').val(),
		password: $('#password').val(),
	};
	$.ajax({
		url: 'ajaxFiles/settings_config.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			$('.loader').hide();
			alert(resp);
		}
	});		
}