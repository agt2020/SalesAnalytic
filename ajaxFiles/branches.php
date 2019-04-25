<<<<<<< HEAD
<?php

include '../utils.php';
$result = array();

if (isset($_POST['type']) && $_POST['type'] == 'branches_list')
{
	$result = $db->GetBranchesList();
}

if (isset($_POST['type']) && $_POST['type'] == 'save_branches')
{
	$ms_db->server = $_POST['address'];
	$ms_db->database = $_POST['db_name'];
	$ms_db->username = $_POST['username'];
	$ms_db->password = $_POST['password'];
	$ms_db->Check_Connection();
	if($ms_db->message == 'OK')
	{
		$id = IDC();
		$sql = "INSERT INTO branches(id, name, date_entered, date_modified,is_parent, parent, address, db_name, username, password, status, modified_user, deleted) VALUES ('".$id."','".$_POST['name']."','".gmdate('Y-m-d H:i:s')."','".gmdate('Y-m-d H:i:s')."','".$_POST['is_parent']."','".$_POST['parent']."','".$_POST['address']."','".$_POST['db_name']."','".$_POST['username']."','".$_POST['password']."','Active','".$_SESSION['Current_User']['id']."','0')";
		$db->run_query($sql);
		$result = 'OK';
	}
	else
	{
		$result = "NOK";
	}
}

if (isset($_POST['type']) && $_POST['type'] == 'Remove_Branch')
{
	$sql = 'SELECT id FROM branches WHERE parent="'.$_POST['id'].'"';
	$result = $db->run_query($sql);
	$row = $result->fetch_assoc();
	if ($row['id'] == '')
	{
		$sql = "UPDATE branches
				SET deleted='1'
				WHERE id='".$_POST['id']."'";
		$db->run_query($sql);
		$result = 'Done';
	}
	else
	{
		$result = 'خطا : امکان حذف وجود ندارد, این شعبه دارای زیر شعبه می باشد !';
	}
}

if (isset($_POST['type']) && $_POST['type'] == 'Branch_Connection')
{
	$branch = $db->GetBranch($_POST['branch_id']);
    	$ms_db->server = $branch['address'];
    	$ms_db->database = $branch['db_name'];
    	$ms_db->username = $branch['username'];
    	$ms_db->password = $branch['password'];
    	$ms_db->Check_Connection();
	if($ms_db->message == 'OK')
	{
		$result = 'OK';
	}
	else
	{
		$result = "ارتباط با شعبه ".$branch['name']." برقرار نشد !";
	}
}

if (isset($_POST['type']) && $_POST['type'] == 'get_branch_data')
{
	$ms_db->get_branch_data();
}

if (isset($_POST['type']) && $_POST['type'] == 'Sp_RptGroupParaSale')
{
	$branch = $db->GetBranch($_POST['id']);
    	$ms_db->server = $branch['address'];
    	$ms_db->database = $branch['db_name'];
    	$ms_db->username = $branch['username'];
    	$ms_db->password = $branch['password'];
    	$ms_db->Check_Connection();
	if($ms_db->message == 'OK')
	{
		$result = $ms_db->Sp_RptGroupParaSale($_POST['start'],$_POST['end']);
	}
	else
	{
		$result = "ارتباط با شعبه ".$branch['name']." برقرار نشد !";
	}
}


ob_clean();
echo json_encode($result);
=======
<?php

include '../utils.php';
$result = array();

if (isset($_POST['type']) && $_POST['type'] == 'branches_list')
{
	$result = $db->GetBranchesList();
}

if (isset($_POST['type']) && $_POST['type'] == 'save_branches')
{
	$id = IDC();
	$sql = "INSERT INTO branches(id, name, date_entered, date_modified,is_parent, parent, address, db_name, username, password, status, modified_user, deleted) VALUES ('".$id."','".$_POST['name']."','".gmdate('Y-m-d H:i:s')."','".gmdate('Y-m-d H:i:s')."','".$_POST['is_parent']."','".$_POST['parent']."','".$_POST['address']."','".$_POST['db_name']."','".$_POST['username']."','".md5($_POST['password'])."','Active','".$_SESSION['Current_User']['id']."','0')";
	$db->run_query($sql);
	$result = $id;
}

if (isset($_POST['type']) && $_POST['type'] == 'Remove_Branch')
{
	$sql = 'SELECT id FROM branches WHERE parent="'.$_POST['id'].'"';
	$result = $db->run_query($sql);
	$row = $result->fetch_assoc();
	if ($row['id'] == '')
	{
		$sql = "UPDATE branches
				SET deleted='1'
				WHERE id='".$_POST['id']."'";
		$db->run_query($sql);
		$result = 'Done';
	}
	else
	{
		$result = 'خطا : امکان حذف وجود ندارد, این شعبه دارای زیر شعبه می باشد !';
	}
}

if (isset($_POST['type']) && $_POST['type'] == 'Branch_Connection')
{
	$branch = $db->GetBranch($_POST['branch_id']);
    	$ms_db->server = $branch['address'];
    	$ms_db->database = $branch['db_name'];
    	$ms_db->username = $branch['username'];
    	$ms_db->password = $branch['password'];
    	$ms_db->Check_Connection();
	if($ms_db->message == 'OK')
	{
		$result = 'OK';
	}
	else
	{
		$result = "ارتباط با شعبه ".$branch['name']." برقرار نشد !";
	}
}

if (isset($_POST['type']) && $_POST['type'] == 'get_branch_data')
{
	$ms_db->get_branch_data();
}

if (isset($_POST['type']) && $_POST['type'] == 'Sp_RptGroupParaSale')
{
	$branch = $db->GetBranch($_POST['id']);
    	$ms_db->server = $branch['address'];
    	$ms_db->database = $branch['db_name'];
    	$ms_db->username = $branch['username'];
    	$ms_db->password = $branch['password'];
    	$ms_db->Check_Connection();
	if($ms_db->message == 'OK')
	{
		$result = $ms_db->Sp_RptGroupParaSale($_POST['start'],$_POST['end']);
	}
	else
	{
		$result = "ارتباط با شعبه ".$branch['name']." برقرار نشد !";
	}
}


ob_clean();
echo json_encode($result);
>>>>>>> 056b6ff91a612d664487faaced7f580809852a02
exit();