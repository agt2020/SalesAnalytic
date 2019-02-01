<?php

if ($_POST['tenant'] == '')
{
	$_POST['tenant'] = 'defualt';
}

if (!empty($_POST['username']) && !empty($_POST['password']))
{
	include 'connection.php';
	$db = new db();

	if (empty($db->message))
	{
		$result = $db->login($_POST['username'],$_POST['password']);
		if ($result)
		{
			session_start();
			$_SESSION["username"] = $_POST['username'];
			// CONFIG
			$_SESSION['config'] = $db->config();
			if (sizeof($_SESSION['config']['sale_server']) == 0)
			{
			    header("Location: settings_config.php");
			}
			else
			{
				header("Location: dashboard.php");
			}
		}
		else
		{
			header("Location: index.php");
			die();
		}
	}
	else
	{
		header("Location: index.php");
		die();
	}
}
else
{
	header("Location: index.php");
	die();
}
?>