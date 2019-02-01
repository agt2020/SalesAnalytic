// ADDED BY Abolfaz Ghaffari - 2019-01

$(document).ready(function() {
	if ($('#page').val() == 'list')
	{
		Get_Users_list();
	}	
});

// CHECK USERNAME
$('#username').change(function(){
	if ($('#username').val() != '')
	{
		var data = {
			type: 'check_username',
			username: $('#username').val(),
		};
		$.ajax({
			url: 'ajaxFiles/users.php',
			type: 'POST',
			data: data,
			async: true,
			dataType: 'json',
			error: function(resp){},
			success: function(resp){
				if(resp == 'NOK')
				{
					alert('نام کاربری '+$('#username').val()+' قبلا ثبت شده است !');
					$('#username').val('');
				}
			}
		});
	}
});



function Get_Users_list()
{
	$('.loader').show();
	var data = {
		type: 'users_list',
	};
	$.ajax({
		url: 'ajaxFiles/users.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			$('.loader').hide();
			UsersList(resp);
		}
	});
}


function Edit_User(id)
{
	if (id != '')
	{
		window.location.href = '?record='+id;
	}
}


function Access_User(id)
{
	if (id != '')
	{
		window.location.href = '?access='+id;
	}
}

function Remove_User(id)
{
	if (id != '')
	{
		var con = confirm('آیا از حذف این کاربر اطمینان دارید ؟');
		if (con)
		{
			$('.loader').show();
			var data = {
				type: 'remove_user',
				id: id,
			};
			$.ajax({
				url: 'ajaxFiles/users.php',
				type: 'POST',
				data: data,
				async: true,
				dataType: 'json',
				error: function(resp){},
				success: function(resp){
					location.reload();
				}
			});
		}
	}
}


function Null_Check(variable)
{
	if (variable == null)
		return '';
	return variable;
}


function Save_User()
{
	$('.loader').show();
	if ($('#password').val() != $('#repassword').val())
	{
		alert('رمز های عبور یکسان نیست !');
	}
	else
	{
		if($('#username').val() == '' || $('#password').val() == '')
		{
			alert('نام کاربری و رمز عبور نمی تواند خالی باشد !');
		}
		else
		{
			var data = {
				type: 'save_user',
				username: $('#username').val(),
				role: $("#role option:selected").val(),
				first_name: $('#first_name').val(),
				last_name: $('#last_name').val(),
				phone: $('#phone').val(),
				email: $('#email').val(),
				password: $('#password').val(),
			};
			$.ajax({
				url: 'ajaxFiles/users.php',
				type: 'POST',
				data: data,
				async: true,
				dataType: 'json',
				error: function(resp){},
				success: function(resp){
					$('.loader').hide();
					if(resp != '')
					{
						location.reload();
					}
					else
					{
						alert('خطا در ثبت کاربر جدید !');
					}
				}
			});
		}
	}
}


function UsersList(data)
{
	var tbody = '';
	var role = {0:'کاربر',1:'مدیر'};
	$('#tbody_list').empty();
	for (var i = 0; i < data.length ; i++)
	{
		tbody += '<tr><td>'+data[i].username+'</td>';
		tbody += '<td>'+data[i].first_name+' '+data[i].last_name+'</td>';
		tbody += '<td>'+Null_Check(data[i].email)+'</td>';
		tbody += '<td class="center">'+role[data[i].is_admin]+'</td>';
		tbody += '<td style="text-align:center;">';
		if(data[i].is_admin == 1)
			tbody += '<button disabled class="btn btn-info">سطح دسترسی</button> ';
		else
			tbody += '<button class="btn btn-info" onclick="Access_User(\''+data[i].id+'\');">سطح دسترسی</button> ';
		
		tbody += '<button class="btn btn-warning" onclick="Edit_User(\''+data[i].id+'\');"><span class="glyphicon glyphicon-pencil"></span></button>  ';
		if(data[i].is_admin == 1)
			tbody += '<button disabled class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>  ';
		else
			tbody += '<button class="btn btn-danger" onclick="Remove_User(\''+data[i].id+'\');"><span class="glyphicon glyphicon-trash"></span></button>  ';
		tbody += '</td></tr>';
	}
	$('#tbody_list').append(tbody);
	var datatable = $('#users_table').DataTable({
		info: false,
        lengthMenu: [ 5, 10],
        pagingType: "full_numbers",
        scroller:  true,
        responsive: true,
        language: {
                "emptyTable":     "فاکتوری یافت نشد !",
                "loadingRecords": "در حال خواند اطلاعات",
                "processing":     "در حال پردازش",
                "search":         "جستجو ",
                "zeroRecords":    "موردی یافت نشد !",
                "lengthMenu":     "نمایش _MENU_ سطر در هر صفحه",
                "paginate": {
                    "first":      "اولین",
                    "last":       "آخرین",
                    "next":       "بعدی",
                    "previous":   "قبلی"
                },
            }
    });
}