<?php
include"../StoreScript/connect_to_mysql.php";

?>



<html>
<head>
  <title>Admin List</title>
  <link rel="stylesheet" href="" type="text/css" media="screen" />
</head>

<body>
  <div align="center" id="mainWrapper">
    <?php //include_once("../template_header.php");?>


<style>
  table,
table td {
  border: 1px solid #cccccc;
}

td {
  height: 80px;
  width: 160px;
  text-align: center;
  vertical-align: middle;
}
</style>

<div id="pageContent"><br />
  <div align="right" style="margin-right:32px;"><a href="admin_registration.php">+ Add New Admin</a></div>
  <div align="left" style="margin-left:24px;">
    <h2>Admin list</h2>
    <?php //echo $product_list; ?>
  </div>
  <hr />
  <a name="inventoryForm" id="inventoryForm"></a>
  <h3>
    &darr; Admin List &darr;
  </h3>

  <table id="time_logs" class="table table-hover dt-responsive" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php 
              $sql = mysqli_query($con, "SELECT * FROM admin;");
              $admin_count = mysqli_num_rows($sql); // count the output amount
                if ($admin_count > 0) {
                while($row = mysqli_fetch_array($sql)){ ?>
                  <tr>
                  <?php
                   $username = $row["username"];
                   $password = $row["password"];
                   $id = $row["id"];
                    ?>

                   <td><?= $username ?></td>
                   <td><?= $password ?></td>
                   <td><a href="<?php echo 'admin_delete.php?id=' . $id ?>" >Delete</a></td>
                  
                   </tr>
                   <?php }
              } 
            ?>
        </tbody>
      </table>

<br>
      <a href="admin_login.php"   >Admin Login</a><br><br>

<br>
<?php include_once("../template_footer.php");?>
</div>
</body>
</html>