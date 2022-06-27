
<?php
if(isset($_POST["frmUsername"]) && isset($_POST["frmPassword"])){
	$manager = preg_replace('#[^A-Za-z0-9]#i','', $_POST["frmUsername"]);
	$password = preg_replace('#[^A-Za-z0-9]#i','', $_POST["frmPassword"]);

	$password = sha1($password);

	include"../StoreScript/connect_to_mysql.php";

	$sql = "INSERT INTO admin (username, password, last_log_date) VALUES ('$manager', '$password', NOW())";

	if (mysqli_query($con, $sql)) {
		header("location:admin_list.php");
	        exit();
	} else {
		echo 'Something went wrong. Probable reason is due to duplicate usernames. Try again. <a href="admin_registration.php">Click here</a>';
			 exit();
	}
}

?>

<html>
<head>
	<title>Admin Registration </title>
	<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
	<div align="center" id="mainWrapper">
		<?php include_once("../template_header.php");?>
		<div id="pageContent"><br />
			<div align="left" style="margin-left:24px;">
				<h2>Please register as an admin to Manage the Store</h2>
				<form id="form1" name="form1" method="post" action="admin_registration.php">
					User Name:<br />
					<input name="frmUsername" type="text" id="username" size="40" />
					<br /><br />
					Password:<br />
					<input name="frmPassword" type="password" id="password" size="40" />
					<br />
					<br />
					<br />

					<input type="submit" name="button" id="button" value="Register" />

				</form>

				<a href="admin_login.php"   >Admin Login</a><br><br>

				<p>&nbsp; </p>
			</div>
			<br />
			<br />
			<br />
		</div>
		<?php include_once("../template_footer.php");?>
	</div>
</body>
</html>