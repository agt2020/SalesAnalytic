// ADDED BY Abolfaz Ghaffari - 2019-01
$(document).ready(function() {
	if ($('#page').val() == 'list')
	{
		Get_Branches_list();
	}
	if ($('#page').val() == 'branch_dashboard' && $('#record').val() != '')
	{
		Branch_Connection($('#record').val());
	}
	//report();
});


function Get_Branches_list()
{
	$('.loader').show();
	var data = {
		type: 'branches_list',
	};
	$.ajax({
		url: 'ajaxFiles/branches.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			$('.loader').hide();
			BranchesList(resp);
		}
	});
}


function Edit_Branch(id)
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

function Remove_Branch(id)
{
	if (id != '')
	{
		var con = confirm('آیا از حذف این شعبه اطمینان دارید ؟');
		if (con)
		{
			$('.loader').show();
			var data = {
				type: 'Remove_Branch',
				id: id,
			};
			$.ajax({
				url: 'ajaxFiles/branches.php',
				type: 'POST',
				data: data,
				async: true,
				dataType: 'json',
				error: function(resp){},
				success: function(resp)
				{
					if (resp == 'Done')
					{
						location.reload();
					}
					else
					{
						alert(resp);
					}
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


function Save_Branch()
{
	if ($('#name').val() == null || $('#name').val() == '')
	{
		alert('نام شعبه نمی تواند خالی باشد !');
	}
	else if($('#address').val() == null || $('#address').val() == '')
	{
		alert('آدرس ip شعبه نمی تواند خالی باشد !');
	}
	else if($('#database').val() == null || $('#database').val() == '')
	{
		alert('نام پایگاه داده نمی تواند خالی باشد !');
	}
	else if($('#username').val() == null || $('#username').val() == '')
	{
		alert('نام کاربری اتصال به پایگاه داده نمی تواند خالی باشد !');
	}
	else if($('#password').val() == null || $('#password').val() == '')
	{
		alert('رمز عبور اتصال به پایگاه داده نمی تواند خالی باشد !');
	}
	else
	{
		$('.loader').show();
		var data = {
			type: 'save_branches',
			name: $('#name').val(),
			is_parent: $("#is_parent option:selected").val(),
			address: $('#address').val(),
			db_name: $('#database').val(),
			username: $('#username').val(),
			password: $('#password').val(),
			parent: $('#parent_id').val(),
		};
		$.ajax({
			url: 'ajaxFiles/branches.php',
			type: 'POST',
			data: data,
			async: true,
			dataType: 'json',
			error: function(resp){},
			success: function(resp){
				$('.loader').hide();
				if(resp == 'OK')
				{
					location.reload();
				}
				else if(resp == 'NOK')
				{
					$('.loader').hide();
					alert('ؤتاباط با شعبه برقرار نشد !');
				}
				else
				{
					$('.loader').hide();
					alert('خطا در ثبت شعبه جدید !');
				}
			}
		});
	}
}	


function BranchesList(data)
{
	var tbody = '';
	var lang = {Active:'فعال',Inactive:'غیر فعال'};
	$('#tbody_list').empty();
	for (var i = 0; i < data.length ; i++)
	{
		tbody += '<tr><td>'+data[i].name+'</td>';
		tbody += '<td>'+Null_Check(data[i].parent_name)+'</td>';
		tbody += '<td>'+Null_Check(data[i].address)+'</td>';
		tbody += '<td class="center">'+lang[data[i].status]+'</td>';
		tbody += '<td style="text-align:center;">';
		tbody += '<button class="btn btn-warning" onclick="Edit_Branch	(\''+data[i].id+'\');"><span class="glyphicon glyphicon-pencil"></span></button>  ';
		if(data[i].is_admin == 1)
			tbody += '<button disabled class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>  ';
		else
			tbody += '<button class="btn btn-danger" onclick="Remove_Branch(\''+data[i].id+'\');"><span class="glyphicon glyphicon-trash"></span></button>  ';
		tbody += '</td></tr>';
	}
	$('#tbody_list').append(tbody);
	var datatable = $('#users_table').DataTable({
		info: false,
        lengthMenu: [ 5, 10, 100],
        pagingType: "full_numbers",
        scroller:  true,
        responsive: true,
        language: {
                "emptyTable":     "داده یافت نشد !",
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

function Parent_List()
{
	var parent = $("#is_parent option:selected").val();
	if (parent == 1)
	{
		$('#parent_name_section').hide();
	}
	else
	{
		$('#parent_name_section').show();
	}
}

function Branch_Connection(id)
{
	$('.loader').show();
	var data = {
		type: 'Branch_Connection',
		branch_id: id,
	};
	$.ajax({
		url: 'ajaxFiles/branches.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			$('.loader').hide();
			if (resp != 'OK')
			{
				alert(resp);
			}
		}
	});
}

function report()
{
	var data = {
		type: 'get_branch_data',
		id: $('#record').val(),
	};
	$.ajax({
		url: 'ajaxFiles/branches.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			$('.loader').hide();
		}
	});
	var datatable = $('#Sp_RptGroupParaSale').DataTable({
	info: false,
        lengthMenu: [ 5, 10],
        pagingType: "full_numbers",
        scroller:  true,
        responsive: true,
        language: {
                "emptyTable":     "داده یافت نشد !",
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

function Sp_RptGroupParaSale()
{
	$('.loader').show();

	var start = $('#datestart').val();
	var end = $('#dateend').val();

	var data = {
		type: 'Sp_RptGroupParaSale',
		id: $('#record').val(),
		start: start,
		end: end,
	};

	$.ajax({
		url: 'ajaxFiles/branches.php',
		type: 'POST',
		data: data,
		async: true,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			Sp_RptGroupParaSale_Load(resp);
			$('.loader').hide();
		}
	});
}


function Sp_RptGroupParaSale_Load(data)
{
	var tbody = '';
	var lang = {Active:'فعال',Inactive:'غیر فعال'};
	$('#Sp_RptGroupParaSale tbody').empty();
	for (var i = 0; i < data.length ; i++)
	{
		tbody += '<tr><td>'+data[i].EAN_Code+'</td>';
		tbody += '<td>'+data[i].GName+'</td>';
		tbody += '<td>'+data[i].ParaName+'</td>';
		tbody += '<td style="text-align:left;">'+data[i].Price+'</td>';
		tbody += '<td style="text-align:center;">'+data[i].DocDate+'</td></tr>';
	}
	$('#Sp_RptGroupParaSale tbody').append(tbody);

	var datatable = $('#Sp_RptGroupParaSale').DataTable({
	info: false,
        lengthMenu: [ 5, 10],
        pagingType: "full_numbers",
        scroller:  true,
        responsive: true,
        language: {
                "emptyTable":     "داده یافت نشد !",
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

    	$('#Sp_RptGroupParaSale_paginate').parent().removeClass('col-sm-6');
    	$('#Sp_RptGroupParaSale_paginate').parent().addClass('col-sm-12');
}