<?php

$result = '';

if (isset($_POST['type']) && $_POST['type'] == 'test_connection')
{
	$server = $_POST['address'];
	$database = $_POST['database'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	ini_set('mssql.charset', 'UTF-8');
	$connection = mssql_connect($server, $username, $password);
	if(mssql_select_db($database, $connection))
	{
		$result = 'OK';
	}
	else
		$result =  'MSSQL error: ' . mssql_get_last_message();
}


ob_clean();
echo json_encode($result);
exit();