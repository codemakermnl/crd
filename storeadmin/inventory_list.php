<?php
include"../StoreScript/connect_to_mysql.php";

if (isset($_POST['product_name'])){ 
  $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
  $price = mysqli_real_escape_string($con, $_POST['price']);
  $category = mysqli_real_escape_string($con, $_POST['category']);
  $subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
  $details = mysqli_real_escape_string($con, $_POST['details']); 

  $sql = mysqli_query($con, "insert into products (product_name, price, details, category, subcategory, date_added)
    values ('$product_name', '$price', '$details', '$category', '$subcategory', now())");

  $pid = mysqli_insert_id($con);
  $newname = "$pid.jpg";
  move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
  header("location: inventory_list.php");
  exit();
}
?>



<html>
<head>
  <title>Inventory List</title>
  <link rel="stylesheet" href="" type="text/css" media="screen" />
</head>

<body>
  <div align="center" id="mainWrapper">
    <?php //include_once("../template_header.php");?>

    <div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
     <tr>
      <td width="32%"><a href="ITE101OnlineStore/index.php"><img src="../Styles/logo2.jpg" alt="Logo" width="252" height="36" border="0" /></a></td>
      <td width="48%" align="right"><a href="MyOnlineStorecart.php">Your Cart</a></td>
      <td width="20%" align="right"><a href="admin_logout.php">Logout</a></td>
    </tr>
    <tr>
      <td colspan="2"><a href="../index.php">Home</a> &nbsp; &middot; &nbsp; <a href="#">Products</a> &nbsp; &middot; &nbsp; <a href="#">Help</a> &nbsp; &middot; &nbsp; <a href="#">Contact</a></td>
    </tr>
  </table>
</div>

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
  <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a></div>
  <div align="left" style="margin-left:24px;">
    <h2>Inventory list</h2>
    <?php //echo $product_list; ?>
  </div>
  <hr />
  <a name="inventoryForm" id="inventoryForm"></a>
  <h3>
    &darr; Add New Inventory Item Form &darr;
  </h3>

  <table id="time_logs" class="table table-hover dt-responsive" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Product Details</th>
            <th>Product Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Nike</td>
            <td>1000</td>
            <td>Shoes</td>
            <td>Men's shoes</td>
            <td>Nike men shoes</td>
            <th><img src="" /></th>
            <th><a href="/">Delete</a></th>
          </tr>
        </tbody>
      </table>

<!--   <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Product Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Price</td>
        <td><label>
          Php
          <input name="price" type="text" id="price" size="12" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Category</td>
        <td><label>
          <select name="category" id="category">
            <option value="Clothing">Electrical</option>
            <option value="Clothing">Machine parts</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value=""></option>
          <option value="Hats">Sample1</option>
          <option value="Pants">Sample2</option>
          <option value="Shirts">Sample3</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Add This Item Now" />
        </label></td>
      </tr>
    </table>
  </form>
  <br />
  <br />
</div> -->
<?php include_once("../template_footer.php");?>
</div>
</body>
</html>