<?php
include '../utils.php';
$result = '';
if (isset($_POST['type']) && $_POST['type'] == 'report')
{
	$Para = array('1969','B-GAP','Foad','US POLO');
	$ms_db->server = $_POST['address'];
	$ms_db->database = $_POST['db_name'];
	$ms_db->username = $_POST['username'];
	$ms_db->password = $_POST['password'];
	$ms_db->Check_Connection();
	if ($ms_db->message == 'OK')
	{
		$result1 = $ms_db->SP_RptGroupAllPara(2,$_POST['start'],$_POST['end']);
		$result2 = $ms_db->SP_RptGroupAllPara(3,$_POST['start'],$_POST['end']);

		for ($i=0; $i < sizeof($result1) ; $i++)
		{ 
			if (in_array($result1[$i]['Para'], $Para))
			{
				$result[$result1[$i]['Para']]['Para'] = $result1[$i]['Para'];
				$result[$result1[$i]['Para']]['Sale_Qty'] = $result1[$i]['Qty'];
				$result[$result1[$i]['Para']]['Sale_Price'] = $result1[$i]['Price'];
			}
		}

		for ($i=0; $i < sizeof($result2) ; $i++)
		{ 
			if (in_array($result2[$i]['Para'], $Para))
			{
				$result[$result2[$i]['Para']]['Para'] = $result2[$i]['Para'];
				$result[$result2[$i]['Para']]['Ref_Qty'] = $result2[$i]['Qty'];
				$result[$result2[$i]['Para']]['Ref_Price'] = $result2[$i]['Price'];
			}
		}

		$i = 0 ;
		$temp = array();
		foreach ($result as $key => $value)
		{
			$temp[$i] = $value;
			$i++;
		}
		$result = $temp;
	}
}
ob_clean();
echo json_encode($result);
exit();