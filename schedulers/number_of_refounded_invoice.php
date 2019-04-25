<?php
header("Refresh:1800");
include_once('../connection.php');
$db = new db;
include_once('../ms_connection.php');
$ms_db = new ms_db;
ini_set('max_execution_time', 300);
// GET PARENT BRANCHES
$branches = $db->GetBranchesList(0);
$data = array();

if (sizeof($branches))
{
	$DATE = Fa_Today();
    foreach ($branches as $key => $value)
    {
    	$ms_db->server = $value['address'];
    	$ms_db->database = $value['db_name'];
    	$ms_db->username = $value['username'];
    	$ms_db->password = $value['password'];
    	$ms_db->Check_Connection();
		if($ms_db->message == 'OK')
		{
			$result = $ms_db->Sp_RptBuy(3,$DATE,$DATE);
        	$data[$value['id']]['id'] = $value['id'];
        	$data[$value['id']]['name'] = $value['name'];
        	$data[$value['id']]['result'] = $result;
        	$data[$value['id']]['date'] = $DATE;
		}
    }
}
foreach ($data as $key => $value)
{
	$query = 'SELECT branch_id FROM number_of_refounded_invoice WHERE branch_id="'.$value['id'].'" AND date_start="'.$value['date'].'"';
	error_log($query);
	$result = $db->conn->query($query);
	$row = $result->fetch_assoc();
	if ($row['branch_id'] != '')
	{
		$query = 'UPDATE number_of_refounded_invoice SET result = "'.$value['result'].'" WHERE branch_id="'.$value['id'].'" AND date_start="'.$value['date'].'"';
		$db->conn->query($query);
	}
	else
	{
		$query = 'INSERT INTO number_of_refounded_invoice(branch_id, result, date_start, date_end) VALUES ("'.$value['id'].'","'.$value['result'].'","'.$value['date'].'","'.$value['date'].'")';
		$db->conn->query($query);
	}
}
error_log('==================== NUMBER OF REFOUNDED INVOICE ('.gmdate('Y-m-d').')');