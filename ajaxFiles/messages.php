<?php
include '../utils.php';
$result = 'NOK';
if (isset($_POST['type']) && $_POST['type'] == 'save')
{
	$db->Save_Message($_POST['user'],$_POST['severity'],$_POST['title'],$_POST['message']);
	$result = 'OK';
}
ob_clean();
echo json_encode($result);
exit();