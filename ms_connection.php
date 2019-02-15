<?php
/**
* FOR DB PROCCESS
*/
class ms_db
{
	var $conn;
	var $message;
	var $server;
	var $database;
	var $username;
	var $password;


	function __construct()
	{
	}

	public function Check_Connection()
	{
		if ($this->server != '' && $this->database != '' && $this->username != '' && $this->password != '')
		{
			$connectionInfo = array( "Database"=>$this->database, "UID"=>$this->username, "PWD"=>$this->password, "CharacterSet" => "UTF-8");
			$this->conn = sqlsrv_connect($this->server,$connectionInfo);
			if($this->conn)
			{
				$this->message = "OK";
			}
			else
			{
				$this->message = "NOK";
			}
		}
		else
		{
			$this->message = 'NOK';
		}
	}

	
	public function run_query($sql)
	{
		return $this->conn->query($sql); 
	}


	public function get_branch_data($input)
	{
		$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");
		$conn = sqlsrv_connect($server,$connectionInfo);
		if($conn)
		{
			return "OK";
		}
		else
		{
			return "NOK";
		}
	}


	public function Sp_RptGroupParaSale($start,$end)
	{
		$sql = "Sp_RptGroupParaSale '".$start."','".$end."',501,1";
		$params = array(1, "some data");
		$stmt = sqlsrv_query( $this->conn, $sql, $params);
		$res = array();
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
		{
	      		array_push($res, $row);
		}
		return $res;
	}


	public function SP_RptGroupAllPara($type,$start,$end)
	{
		$sql = "SP_RptGroupAllPara '".$start."','".$end."','".$type."',501,1";
		$params = array(1, "some data");
		$stmt = sqlsrv_query( $this->conn, $sql, $params);
		$res = array();
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
		{
	      		array_push($res, $row);
		}
		return $res;
	}
}