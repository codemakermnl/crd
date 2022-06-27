<?php
session_start();
if (isset($_SESSION["manager"])){
	header("location:inventory_list.php");
	exit();
}
?>

<?php
     if(isset($_POST["frmUsername"]) && isset($_POST["frmPassword"])){
		 $manager = preg_replace('#[^A-Za-z0-9]#i','', $_POST["frmUsername"]);
		 $password = preg_replace('#[^A-Za-z0-9]#i','', $_POST["frmPassword"]);

		 $password = sha1($password);
		 
		 include"../StoreScript/connect_to_mysql.php";
		 $sql_str = "select id from admin where username= '$manager' and password= '$password'
		 limit 1";
		 $sql = mysqli_query($con, $sql_str);
		 
		 
		 $existCount = mysqli_num_rows($sql);
		 if ($existCount==1){
			 while($row = mysqli_fetch_array($sql)){
				 $id=$row["id"];			 
			}
			
			$_SESSION["id"]=$id;
			$_SESSION["manager"]=$manager;
			$_SESSION["password"]=$password;
			header("location:inventory_list.php");
	        exit();
		 }else{
			 echo 'That information is incorrect, try again <a href="admin_login.php">Click here</a>';
			 exit();
		 }	 
	 }
	 
?>

<html>
<head>
<title>Admin Log In </title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("../template_header.php");?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Please Log In To Manage the Store</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php">
        User Name:<br />
          <input name="frmUsername" type="text" id="username" size="40" />
        <br /><br />
        Password:<br />
       <input name="frmPassword" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
       
         <input type="submit" name="button" id="button" value="Log In" />
       
      </form>

      <a href="admin_registration.php"   >Register</a><br><br>
      <a href="admin_list.php"   >See admin list</a><br>
	 
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