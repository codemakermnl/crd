
<?php
if(isset($_GET["id"])){
	$id = $_GET["id"];

	include "../StoreScript/connect_to_mysql.php";

	$sql = "DELETE FROM admin where id = '$id'";

	if (mysqli_query($con, $sql)) {
		header("location:admin_list.php");
	        exit();
	} else {
		echo 'Deletion Error. Go back to list. <a href="admin_list.php">Click here</a>';
			 exit();
	}
}

?>
