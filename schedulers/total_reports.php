<?php
include '../utils.php';

$res = $db->GetBranchesList();
$date_start = $_REQUEST['date'];//'1398/01/03';
$date_end = $_REQUEST['date'];//'1398/01/03';

foreach ($res as $key => $value)
{
	$Para = array('1969','B-GAP','Foad','US POLO', 'Heliya', 'AB');
	$branch_id = $value['id'];
	$branch_name = $value['name'];

	foreach ($Para as $key3 => $value3)
	{
		$result[$value3]['id'] = $branch_id;
		$result[$value3]['name'] = $branch_name;
		$result[$value3]['connection_status'] = 'Off';
		$result[$value3]['Para'] = $value3;
		$result[$value3]['Sale_Qty'] = 0;
		$result[$value3]['Sale_Price'] = 0;
		$result[$value3]['Ref_Qty'] = 0;
		$result[$value3]['Ref_Price'] = 0;
	}

	$ms_db->server = $value['address'];
	$ms_db->database = $value['db_name'];
	$ms_db->username = $value['username'];
	$ms_db->password = $value['password'];
	$ms_db->Check_Connection();
	if ($ms_db->message == 'OK')
	{
		$result1 = $ms_db->SP_RptGroupAllPara(2,$date_start , $date_end);
		$result2 = $ms_db->SP_RptGroupAllPara(3,$date_start , $date_end);

		for ($i=0; $i < sizeof($result1) ; $i++)
		{
			if (in_array($result1[$i]['Para'], $Para))
			{
				$result[$result1[$i]['Para']]['connection_status'] = 'On';
				$result[$result1[$i]['Para']]['date_start'] = $date_start;
				$result[$result1[$i]['Para']]['date_end'] = $date_end;
				$result[$result1[$i]['Para']]['Sale_Qty'] = Null_Check($result1[$i]['Qty']);
				$result[$result1[$i]['Para']]['Sale_Price'] = Null_Check($result1[$i]['Price']);
			}
		}

		for ($i=0; $i < sizeof($result2) ; $i++)
		{ 
			if (in_array($result2[$i]['Para'], $Para))
			{
				$result[$result2[$i]['Para']]['Ref_Qty'] = Null_Check($result2[$i]['Qty']);
				$result[$result2[$i]['Para']]['Ref_Price'] = Null_Check($result2[$i]['Price']);
			}
		}

		$i = 0 ;
		$temp = array();
		foreach ($result as $key2 => $value2)
		{
			$temp[$i] = $value2;
			$i++;
		}
		$result = $temp;
	}
}

$db->Insert_Total($result,$date_start,$date_end);

foreach ($result as $key => $value)
{
	print_r($value);
	//echo 'Para : '.$value['Para'].' Sale_Qty: '.$value['Sale_Qty'].' Sale_Price: '.$value['Sale_Price'].' Ref_Qty: '.$value['Ref_Qty'].' Ref_Price: '.$value['Ref_Price'];
	echo "<br>";
}

function Null_Check($variable)
{
	if ($variable == '' || $variable == null)
		return 0;
	return $variable;
}