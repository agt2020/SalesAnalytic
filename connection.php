<?php
/**
* FOR DB PROCCESS
*/
include 'functions/Global_Funcs.php';
class db
{
	var $conn;
	var $message;
	function __construct()
	{
		include 'config.php';
		// Create connection
		$conn = new mysqli($sales_config['db_host'], $sales_config['db_username'], $sales_config['db_password'], $sales_config['db_name']);
		$conn->set_charset("utf8");
		// Check connection
		if ($conn->connect_error)
		{
		    $this->message = "Connection failed: " . $conn->connect_error;
		}
		else
		{
			$this->conn = $conn;
		}
	}

	public function login($username,$password)
	{
		$sql = "SELECT *
				FROM users
				WHERE deleted='0' AND status='1' AND username='".$username."' AND password='".md5($password)."'";
		$result = $this->conn->query($sql);
		$row = $result->fetch_assoc();
		if (!empty($row['id']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	
	public function run_query($sql)
	{
		return $this->conn->query($sql); 
	}


	public function config()
	{
		$sql = "SELECT *
				FROM config";
		$result = $this->conn->query($sql);
		if ($result->num_rows)
		{
			$config = array();
			while ($row = $result->fetch_assoc())
			{
				$config[$row['category']][$row['name']] = $row['value'];
			}
			return $config;
		}
		else
		{
			return array();
		}
	}

	
	public function GetUsersList()
	{
		$users = array();
		$sql = "SELECT *
				FROM users
				WHERE deleted='0'";
		$result = $this->conn->query($sql);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($users, $row);
			}
			return $users;
		}
		else
		{
			return array();
		}
	}


	public function GetUser($id)
	{
		if (empty($id))
			return array();
		$sql = "SELECT *
				FROM users
				WHERE id='".trim($id)."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			
			return $row;
		}
		else
		{
			return array();
		}
	}


	public function GetUserUsername($username)
	{
		if (empty($username))
			return array();
		$sql = "SELECT *
				FROM users
				WHERE username='".trim($username)."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			
			return $row;
		}
		else
		{
			return array();
		}
	}


	public function GetBranchesList($condition)
	{
		$branches = array();
		$sql = "SELECT *
				FROM branches
				WHERE deleted='0'";
		if (isset($condition) && $condition == 1)
		{
			$sql .= ' AND is_parent="1"'; 
		}
		elseif (isset($condition) && $condition == 0)
		{
			$sql .= ' AND is_parent="0"'; 
		}
		$result = $this->conn->query($sql);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				if ($row['parent'] != '')
				{
					$parent = $this->GetBranch($row['parent']);
					$row['parent_name'] = $parent['name'];
				}
				array_push($branches, $row);
			}
			return $branches;
		}
		else
		{
			return array();
		}
	}

	public function GetBranch($id)
	{
		if (empty($id))
			return array();
		$sql = "SELECT *
				FROM branches
				WHERE id='".trim($id)."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			
			return $row;
		}
		else
		{
			return array();
		}
	}

	public function GetBranchesChilds($parent_id)
	{
		$branches = array();
		$sql = "SELECT *
				FROM branches
				WHERE deleted='0' AND parent='".$parent_id."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($branches, $row);
			}
			return $branches;
		}
		else
		{
			return array();
		}
	}
}