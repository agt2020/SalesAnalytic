<?php
session_start();
include_once('connection.php');
$db = new db;
include_once('ms_connection.php');
$ms_db = new ms_db;

// GET CURRENT USER
$_SESSION['Current_User'] = $db->GetUserUsername($_SESSION['username']);