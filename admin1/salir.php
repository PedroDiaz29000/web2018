<?php
	session_start();
require_once("cls/bd.php");
$bd=new BD();

$_SESSION = array();
session_destroy();
header("location:login.php");
?>