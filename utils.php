<<<<<<< HEAD
<?php
session_start();
include_once('connection.php');
$db = new db;
include_once('ms_connection.php');
$ms_db = new ms_db;

// GET CURRENT USER
=======
<?php
session_start();
include_once('connection.php');
$db = new db;
include_once('ms_connection.php');
$ms_db = new ms_db;

// GET CURRENT USER
>>>>>>> 056b6ff91a612d664487faaced7f580809852a02
$_SESSION['Current_User'] = $db->GetUserUsername($_SESSION['username']);