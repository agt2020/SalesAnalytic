<?php

$server = '37.156.20.13';
$database = 'Retail';
$username = 'sa';
$password = 'Pa_12345';
$connection = mssql_connect($server, $username, $password);
if(mssql_select_db($database, $connection))
	echo 'OK';
else
	echo 'NOK';

// $query = "SELECT TABLE_NAME
// FROM INFORMATION_SCHEMA.TABLES
// WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_CATALOG='4AGT'";
//$query = "SELECT * FROM Goods";
$query = "SELECT * FROM whs_qtydocd";
$result = mssql_query($query, $connection);
$i = 0;
while ($row = mssql_fetch_array($result))
{
	$i++;
	echo "<hr>";
	print_r($row);
}
echo "<br>".$i;
//******************************************//
?>
Admin

Admin@8106627