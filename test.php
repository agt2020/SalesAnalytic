<?php

$server = '94.183.105.107';
$database = 'Retail';
$username = 'sa';
$password = 'Pa_12345';
$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $server, $connectionInfo);
if($conn)
{
	$sql = "Sp_RptGroupParaSale '1397/07/01','1397/12/01',501,1";
	//$sql = "SELECT * FROM Goods";
	$params = array(1, "some data");
	$stmt = sqlsrv_query( $conn, $sql, $params);
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
	{
      		echo print_r($row)."<br />";
	}
}
else
{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}


//******************************************//
// $query = "SELECT TABLE_NAME
// FROM INFORMATION_SCHEMA.TABLES
// WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_CATALOG='4AGT'";
//$query = "SELECT * FROM Goods";
// $query = "SELECT * FROM whs_qtydocd";
// $result = mssql_query($query, $connection);
// $i = 0;
// while ($row = mssql_fetch_array($result))
// {
// 	$i++;
// 	echo "<hr>";
// 	print_r($row);
// }
// echo "<br>".$i;
//******************************************//

?>