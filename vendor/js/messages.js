

function send()
{
	var user = $('#send_to').val();
	var title = $('#title').val();
	var message = $('#message').val();
	var severity = $('#severity').val();
	if (user == '')
	{
		alert('انتخاب کاربر اجباریست !!!');
	}
	else if (title == '')
	{
		alert('عنوان پیام نمی تواند خالی باشد !!!');
	}
	else if (message == '')
	{
		alert('متن پیام نمی تواند خالی باشد !!!');
	}
	else
	{
		var data = {
			type: 'save',
			user: user,
			title: title,
			message: message,
			severity: severity,
		};
		$.ajax({
			url: 'ajaxFiles/messages.php',
			type: 'POST',
			data: data,
			async: true,
			dataType: 'json',
			error: function(resp){},
			success: function(resp){
				if (resp == 'OK')
				{
					alert('پیام ارسال گردید .');
				}
			}
		});
	}
}

function clean()
{
	$('#title').val('');
	$('#message').val('');
}