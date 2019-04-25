// ADDED BY Abolfaz Ghaffari - 2019-02
$(document).ready(function() {
	
});

function Total_Report()
{
	var StartDate = $('#datestart').val();
	var EndDate = $('#dateend').val();
	var result = [];
	var branches = [];
	var data = [];
	$('#tbody_list').empty();

	$('.loader').show();
	var data = {
		type: 'branches_list',
	};
	$.ajax({
		url: 'ajaxFiles/branches.php',
		type: 'POST',
		data: data,
		async: false,
		dataType: 'json',
		error: function(resp){},
		success: function(resp){
			result = resp;
		}
	});
	$('.loader').hide();
	var j = 0;
	if (result != null)
	{
		for (var i = 0; i < result.length; i++)
		{
			if (result[i].is_parent == 0)
			{
				var data = {
					type: 'report',
					strat: StartDate,
					end: EndDate,
					id: result[i].id,
					address: result[i].address,
					db_name: result[i].db_name,
					username: result[i].username,
					password: result[i].password,
					report: 1
				};
				$('.loader').show();
				$.ajax({
					url: 'ajaxFiles/total_reports.php',
					type: 'POST',
					data: data,
					async: false,
					dataType: 'json',
					error: function(resp){},
					success: function(resp)
					{
						Tbody_Design(result[i],resp);	
					}
				});
				$('.loader').hide();
				branches[j] = result[i];
				j++;
			}
		}
	}
	//console.log(branches);
}


function Tbody_Design(branch,data)
{
	var Sale_Qty = 0;
	var Sale_Price = 0;
	var Ref_Qty = 0;
	var Ref_Price = 0;
	var tbody = '';
	for (var i = 0; i < data.length; i++)
	{
		if (i == 0)
		{
			tbody += '<tr><td rowspan="5">'+branch.name+'</td>';
		}
		else
		{
			tbody += '<tr>';
		}
		tbody += '<td>'+data[i].Para+'</td>';
		tbody += '<td>'+Null_Check(data[i].Sale_Qty)+'</td>';
		Sale_Qty += Null_Check(data[i].Sale_Qty);
		tbody += '<td>'+Null_Check(data[i].Sale_Price)+'</td>';
		Sale_Price += Null_Check(data[i].Sale_Price);
		tbody += '<td>'+Null_Check(data[i].Ref_Qty)+'</td>';
		Ref_Qty += Null_Check(data[i].Ref_Qty);
		tbody += '<td>'+Null_Check(data[i].Ref_Price)+'</td>';
		Ref_Price += Null_Check(data[i].Ref_Price);
		tbody += '</tr>';
	}
	// Total
	tbody += '<tr>';
	tbody += '<td>مجموع</td>';
	tbody += '<td>'+Null_Check(Sale_Qty)+'</td>';
	tbody += '<td>'+Null_Check(Sale_Price)+'</td>';
	tbody += '<td>'+Null_Check(Ref_Qty)+'</td>';
	tbody += '<td>'+Null_Check(Ref_Price)+'</td>';
	tbody += '</tr>';

	$('#tbody_list').append(tbody);
}

function Null_Check(variable)
{
	if (variable == null)
		return '';
	return variable;
}