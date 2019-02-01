<?php

include '../utils.php';
$result = array();

if (isset($_POST['type']) && $_POST['type'] == 'users_list')
{
	$result = $db->GetUsersList();
}

if (isset($_POST['type']) && $_POST['type'] == 'save_user')
{
	$id = IDC();
	$sql = "INSERT INTO users(id, username, password, first_name, last_name, email, phone, is_admin, access, date_entered, date_modified, modified_user, status, deleted, avatar) VALUES ('".$id."','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['role']."','1','".gmdate('Y-m-d H:i:s')."','".gmdate('Y-m-d H:i:s')."','".$_SESSION['Current_User']['id']."','1','0','')";
	$db->run_query($sql);
	$result = $id;
}

if (isset($_POST['type']) && $_POST['type'] == 'remove_user')
{
	$sql = "UPDATE users
			SET deleted='1'
			WHERE id='".$_POST['id']."'";
	$db->run_query($sql);
	$result = 'Done';
}

if (isset($_POST['type']) && $_POST['type'] == 'check_username')
{
	$sql = "SELECT id
			FROM users
			WHERE deleted='0' AND username='".$_POST['username']."'";
	$res = $db->run_query($sql);
	$row = $res->fetch_assoc();
	if ($row['id'] != '')
		$result = 'NOK';
}


ob_clean();
echo json_encode($result);
exit();