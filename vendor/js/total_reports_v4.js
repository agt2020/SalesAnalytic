// ADDED BY Abolfaz Ghaffari - 2019-02
$(document).ready(function() {
	var date = new persianDate().format();
	date = date.split(' ');
	date = date[0].replace('-','/');
	date = date.replace('-','/');
	// if (date != '')
	// {
	// 	$('#dateend').val(date);
	// }
});

function Total_Report()
{
	if ($('#datestart').val() == '' || $('#dateend').val() == '')
	{
		alert('تاریخ شروع و پایان نمی تواند خالی باشد !');
	}
	else
	{
		var result = [];
		var branches = [];
		var data = [];

		$('#tbody_list').empty();
		$('#Grand_Sale_Qty_Hidden').val(0);
		$('#Grand_Sale_Price_Hidden').val(0);

		$('#Sale_Qty_Hidden').val(0);
		$('#Sale_Price_Hidden').val(0);
		$('#Ref_Qty_Hidden').val(0);
		$('#Ref_Price_Hidden').val(0);

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
						startDate: $('#datestart').val(),
						end: $('#dateend').val(),
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
	}
}


function Tbody_Design(branch,data)
{
	var Sale_Qty = 0;
	var Sale_Price = 0;
	var Ref_Qty = 0;
	var Ref_Price = 0;
	var Total_Qty = 0;
	var Totla_Price = 0;
	var tbody = '';
	var trClass = '';
	for (var i = 0; i < data.length; i++)
	{
		if (data[i].Para == '1969')
			trClass = 'success';
		if (data[i].Para == 'B-GAP')
			trClass = 'warning';
		if (data[i].Para == 'Foad')
			trClass = 'info';
		if (data[i].Para == 'US POLO')
			trClass = 'danger';
		if (i == 0)
		{
			var rowspan = 2+parseInt(data.length);
			tbody += '<tr><td rowspan="'+rowspan+'">'+branch.name+'</td></tr>';
			tbody += '<tr class="'+trClass+'">';
		}
		else
		{
			tbody += '<tr class="'+trClass+'">';
		}
		tbody += '<td>'+data[i].Para+'</td>';
		tbody += '<td>'+Null_Check(data[i].Sale_Qty)+'</td>';
		Sale_Qty += Null_Check(data[i].Sale_Qty);
		tbody += '<td>'+addCommas(Null_Check(data[i].Sale_Price))+'</td>';
		Sale_Price += Null_Check(data[i].Sale_Price);
		tbody += '<td>'+Null_Check(data[i].Ref_Qty)+'</td>';
		Ref_Qty += Null_Check(data[i].Ref_Qty);
		tbody += '<td>'+addCommas(Null_Check(data[i].Ref_Price))+'</td>';
		Ref_Price += Null_Check(data[i].Ref_Price);
		tbody += '<td>'+(Null_Check(data[i].Sale_Qty)-Null_Check(data[i].Ref_Qty))+'</td>';
		tbody += '<td>'+addCommas(Null_Check(data[i].Sale_Price)-Null_Check(data[i].Ref_Price))+'</td>';
		tbody += '</tr>';
	}
	// Total
	if (data.length > 0)
	{
		tbody += '<tr>';
		tbody += '<td>مجموع</td>';
		tbody += '<td>'+Null_Check(Sale_Qty)+'</td>';
		$('#Sale_Qty_Hidden').val(parseInt($('#Sale_Qty_Hidden').val())+parseInt(Null_Check(Sale_Qty)));
		$('#Sale_Qty_Lable').text($('#Sale_Qty_Hidden').val());
		tbody += '<td>'+addCommas(Null_Check(Sale_Price))+'</td>';
		$('#Sale_Price_Hidden').val(parseInt($('#Sale_Price_Hidden').val())+parseInt(Null_Check(Sale_Price)));
		$('#Sale_Price_Lable').text(addCommas($('#Sale_Price_Hidden').val()));
		tbody += '<td>'+Null_Check(Ref_Qty)+'</td>';
		$('#Ref_Qty_Hidden').val(parseInt($('#Ref_Qty_Hidden').val())+parseInt(Null_Check(Ref_Qty)));
		$('#Ref_Qty_Lable').text($('#Ref_Qty_Hidden').val());
		tbody += '<td>'+addCommas(Null_Check(Ref_Price))+'</td>';
		$('#Ref_Price_Hidden').val(parseInt($('#Ref_Price_Hidden').val())+parseInt(Null_Check(Ref_Price)));
		$('#Ref_Price_Lable').text(addCommas($('#Ref_Price_Hidden').val()));
		tbody += '<td>'+(Sale_Qty-Ref_Qty)+'</td>';
		tbody += '<td>'+addCommas(Sale_Price-Ref_Price)+'</td>';
		tbody += '</tr>';

		// GRNAD
		$('#Grand_Sale_Qty_Hidden').val(parseInt($('#Sale_Qty_Hidden').val())-parseInt($('#Ref_Qty_Hidden').val()));
		$('#Grand_Sale_Qty_Lable').text($('#Grand_Sale_Qty_Hidden').val());

		$('#Grand_Sale_Price_Hidden').val(parseInt($('#Sale_Price_Hidden').val())-parseInt($('#Ref_Price_Hidden').val()));
		$('#Grand_Sale_Price_Lable').text(addCommas($('#Grand_Sale_Price_Hidden').val()));

	}

	$('#tbody_list').append(tbody);
}

function Null_Check(variable)
{
	if (variable == null)
		return 0;
	return variable;
}

function addCommas(nStr)
{
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
