<?php
session_start();
if (isset($_SESSION["manager"])){
	session_unset();
	header("location:admin_login.php");
	exit();
}
?>