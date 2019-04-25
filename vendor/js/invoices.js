function Show_Invoices()
{
	var date = $('#date_select').find(":selected").val();
	if (date != '')
	{
		var data = {
			type: 'total_reports_invoice',
			date: date,
		};
		$.ajax({
			url: 'ajaxFiles/total_reports.php',
			type: 'POST',
			data: data,
			async: false,
			dataType: 'json',
			error: function(resp){},
			success: function(resp){
				Design_Table(resp);
			}
		});
	}
}

function Show_Refound_Invoices()
{
	var date = $('#date_select').find(":selected").val();
	if (date != '')
	{
		var data = {
			type: 'total_reports_refound',
			date: date,
		};
		$.ajax({
			url: 'ajaxFiles/total_reports.php',
			type: 'POST',
			data: data,
			async: false,
			dataType: 'json',
			error: function(resp){},
			success: function(resp){
				Design_Table(resp);
			}
		});
	}
}

function Design_Table(data)
{
	$('#tbody').empty();
	var tbody = '';
	var sum = 0;
	var date = '';
	for (var i = 0; i < data.length ; i++)
	{
		tbody += '<tr>';
		tbody += '<td>'+data[i].name+'</td>';
		tbody += '<td>'+data[i].result+'</td>';
		tbody += '<td>'+data[i].date_start+'</td>';
		tbody += '</tr>';
		sum += parseInt(data[i].result);
		date = data[i].date_start;
	}
	tbody += '<tr>';
	tbody += '<td>مجموع</td>';
	tbody += '<td>'+sum+'</td>';
	tbody += '<td>'+date+'</td>';
	tbody += '</tr>';
	$('#tbody').append(tbody);
}