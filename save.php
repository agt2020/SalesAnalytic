<?php
session_start();
include('utils.php');

if (sizeof($_POST) == 0 || empty($_POST['return_page']))
{
	session_destroy();
	header("Location: index.php");
	die();
}

switch ($_POST['return_page'])
{
	case 'settings_config':
		Sale_Server();
		break;
	case 'edit_user':
		Edit_User();
		break;
	case 'access_user':
		Access_User();
		break;
	case 'edit_branch':
		Edit_Branch();
		break;
	
	default:
		session_destroy();
		header("Location: index.php");
		break;
}
header("Location: ".$_POST['return_page'].".php");


function Sale_Server()
{
	$conn = new db(); 
	$del = "DELETE FROM config WHERE category='sale_server'";
	$conn->run_query($del);

	$ins = "INSERT INTO config(category, name, value) VALUES ('sale_server','address','".$_POST['address']."')";
	$ins .= ",('sale_server','database','".$_POST['database']."')";
	$ins .= ",('sale_server','username','".$_POST['username']."')";
	$ins .= ",('sale_server','password','".$_POST['password']."')";
	$conn->run_query($ins);
}

function Edit_User()
{
	$conn = new db(); 
	$del = "UPDATE users
			SET date_modified='".gmdate('Y-m-d H:i:s')."',modified_user='".$_SESSION['Current_User']['id']."',status='".$_POST['status']."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',email='".$_POST['email']."',phone='".$_POST['phone']."'
			WHERE id='".$_POST['id']."'";
	$conn->run_query($del);
	$_POST['return_page'] = 'users';
}

function Access_User()
{
	$access = array(
		'analytics' => 0,
		'sales_table' => 0,
		'branches' => 0,
		'orders' => 0);
	if ($_POST['analytics'])
		$access['analytics'] = 1;
	if ($_POST['sales_table'])
		$access['sales_table'] = 1;
	if ($_POST['branches'])
		$access['branches'] = 1;
	if ($_POST['orders'])
		$access['orders'] = 1;
	$access = base64_encode(json_encode($access));
	$conn = new db(); 
	$up = "UPDATE users
			SET date_modified='".gmdate('Y-m-d H:i:s')."',modified_user='".$_SESSION['Current_User']['id']."',access='".$access."'
			WHERE id='".$_POST['id']."'";
	$conn->run_query($up);
	$_POST['return_page'] = 'users';
}


function Edit_Branch()
{
	$conn = new db();
	$password = '';
	if ($_POST['password'] != '')
	{
		$password = ",password='".$_POST['password']."'";
	}
	$up = "UPDATE branches
			SET date_modified='".gmdate('Y-m-d H:i:s')."',modified_user='".$_SESSION['Current_User']['id']."',status='".$_POST['status']."',name='".$_POST['name']."',address='".$_POST['address']."',db_name='".$_POST['database']."',username='".$_POST['username']."'".$password."
			WHERE id='".$_POST['id']."'";
	$conn->run_query($up);
	$_POST['return_page'] = 'branches';
}
?>