<?php 
session_start();

if (isset($_SESSION["manager"])){
	session_destroy();
}

echo "<script>window.location.href='admin_login.php';</script>";
exit();
?>