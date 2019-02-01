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
    $server = $branch['address'];
    $database = $branch['db_name'];
    $username = $branch['username'];
    $password = $branch['password'];
    ini_set('mssql.charset', 'UTF-8');
    $connection = mssql_connect($server, $username, $password);
    if(!mssql_select_db($database, $connection))
    {
        $result = "ارتباط با شعبه ".$branch['name']." برقرار نشد !";
    }
    else
    {
    	$result = 'OK';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'get_branch_data')
{
	
}


ob_clean();
echo json_encode($result);
exit();