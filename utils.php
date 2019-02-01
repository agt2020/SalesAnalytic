<?php
session_start();
include_once('connection.php');
$db = new db;

// GET CURRENT USER
$_SESSION['Current_User'] = $db->GetUserUsername($_SESSION['username']);