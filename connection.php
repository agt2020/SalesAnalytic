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


	function Messages($id,$status)
	{
		session_start();
		$messages = array();
		$query = 'SELECT * FROM messages
			  WHERE deleted = "0" AND read_status = "0" AND destination_user_id = "'.$_SESSION['Current_User']['id'].'"
			  ORDER BY date_entered DESC';
		if ($id != '')
		{
			$query = 'SELECT * FROM messages
				  WHERE id = "'.$id.'" ';
		}
		if ($status == 'all')
		{
			$query = 'SELECT * FROM messages
			  WHERE deleted = "0" AND destination_user_id = "'.$_SESSION['Current_User']['id'].'"
			  ORDER BY date_entered DESC';
		}
		$result = $this->conn->query($query);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($messages, $row);
			}
			return $messages;
		}
		else
		{
			return array();
		}
	}


	function Get_Message($id)
	{
		session_start();
		$messages = array();
		$query = 'SELECT * FROM messages
			  WHERE id = "'.$id.'" ';
		$result = $this->conn->query($query);
		if ($result->num_rows)
		{
			$row = $result->fetch_assoc();
			return $row;
		}
		else
		{
			return array();
		}
	}


	function Read_Message($id)
	{
		if ($id != '')
		{
			$query = 'UPDATE messages
					  SET read_status = "1"
				  	  WHERE id = "'.$id.'" ';
			$this->conn->query($query);
			return true;
		}
		return false;
	}


	function Save_Message($user_id,$severity,$title,$message)
	{
		session_start();
		$user = $this->GetUser($_SESSION['Current_User']['id']);
		$id = IDC();
		$date_entered = gmdate('Y-m-d H:i:s');
		$query = 'INSERT INTO
			  messages(id, date_entered, deleted, title, message, severity, created_user_id, destination_user_id, destination_user_name, read_status)
			  VALUES ("'.$id.'","'.$date_entered.'","0","'.$title.'","'.$message.'","'.$severity.'","'.$_SESSION['Current_User']['id'].'","'.$user_id.'","'.$user['first_name'].' '.$user['last_name'].'","0")';
		$this->conn->query($query);
	}


	function Get_NUMBEROF_INVOICE($sum = 0,$date)
	{
		$DATE = Fa_Today();
		if ($date != '') 
		{
			$DATE = $date;
		}
		$invoices = array();
		$query = 'SELECT b.name, ni.result, ni.date_start
				  FROM number_of_invoice ni
				  JOIN branches b
				  WHERE b.id = ni.branch_id AND ni.date_start="'.$DATE.'"';
		if ($sum == 1)
		{
			$query = 'SELECT sum(result) as sum FROM number_of_invoice WHERE date_start="'.$DATE.'"';
			$result = $this->conn->query($query);
			$row = $result->fetch_assoc();
			return (int)$row['sum'];
		}
		$result = $this->conn->query($query);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($invoices, $row);
			}
			return $invoices;
		}
	}


	function Get_NUMBEROF_REFOUNDED_INVOICE($sum = 0,$date)
	{
		$DATE = Fa_Today();
		if ($date != '') 
		{
			$DATE = $date;
		}
		$invoices = array();
		$query = 'SELECT b.name, ni.result, ni.date_start
				  FROM number_of_refounded_invoice ni
				  JOIN branches b
				  WHERE b.id = ni.branch_id AND ni.date_start="'.$DATE.'"';
		if ($sum == 1)
		{
			$query = 'SELECT sum(result) as sum FROM number_of_refounded_invoice WHERE date_start="'.$DATE.'"';
			$result = $this->conn->query($query);
			$row = $result->fetch_assoc();
			return (int)$row['sum'];
		}
		$result = $this->conn->query($query);
		if ($result->num_rows)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($invoices, $row);
			}
			return $invoices;
		}
	}


	function Insert_Total($data,$date_start,$date_end)
	{
		$delete_query = 'DELETE FROM total_reports WHERE date_start="'.$date_start.'" AND date_end= "'.$date_end.'"';
		$this->conn->query($delete_query);
		foreach ($data as $key => $value)
		{
			if ($value['connection_status'] == 'On')
			{
				$insert_query = 'INSERT INTO total_reports(brabch_id, branch_name, dep, sale_qty, sale_price, ref_qty, ref_price, total_qty, total_price, date_start, date_end) VALUES ("'.$value['id'].'","'.$value['name'].'","'.$value['Para'].'","'.$value['Sale_Qty'].'","'.$value['Sale_Price'].'","'.$value['Ref_Qty'].'","'.$value['Ref_Price'].'","'.($value['Sale_Qty']-$value['Ref_Qty']).'","'.($value['Sale_Price']-$value['Ref_Price']).'","'.$date_start.'","'.$date_end.'")';
				$this->conn->query($insert_query);
			}
		}
	}
}