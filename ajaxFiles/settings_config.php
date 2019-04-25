<<<<<<< HEAD
<?php
include '../utils.php';
$result = '';
if (isset($_POST['type']) && $_POST['type'] == 'test_connection')
{
	$ms_db->server = $_POST['address'];
	$ms_db->database = $_POST['database'];
	$ms_db->username = $_POST['username'];
	$ms_db->password = $_POST['password'];
	$ms_db->Check_Connection();
	$result = $ms_db->message;
}
ob_clean();
echo json_encode($result);
=======
<?php
include '../utils.php';
$result = '';
if (isset($_POST['type']) && $_POST['type'] == 'test_connection')
{
	$ms_db->server = $_POST['address'];
	$ms_db->database = $_POST['database'];
	$ms_db->username = $_POST['username'];
	$ms_db->password = $_POST['password'];
	$ms_db->Check_Connection();
	$result = $ms_db->message;
}
ob_clean();
echo json_encode($result);
>>>>>>> 056b6ff91a612d664487faaced7f580809852a02
exit();