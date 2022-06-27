<?php
session_start();
include_once "StoreScript/connect_to_mysql.php";
?>

<?php
//Section 1 (if user attempts to add something to the cart from the page)

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // execute if the cart is empty or not set
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} else {
		// execute if the cart has at least one item in it
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
			foreach($each_item as $key => $value){
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close for loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	header("location: cart.php"); 
    exit();
}
?>

<?php 
// Section 2 (if user wants to remove item from the cart)
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>

<?php
//Section 3 (if user chooses to adjust item quantity)

if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] !=""){
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity);//filter everything but numbers
	
	if($quantity>=100){$quantity=99;}
	if($quantity<1) {$quantity=1;}
	if($quantity=="") {$quantity=1;}
	$i=0;
	foreach ($_SESSION["cart_array"] as $each_item){
		$i++;
		foreach($each_item as $key => $value){
			if($key=="item_id" && $value==$item_to_adjust){
				array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
			}//close the if
		}//close the inner loop
	}//close the foreach
}//close mother if 
?>

<?php
  if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart"){
	  unset($_SESSION["cart_array"]);
  }
	
?>
<?php
//Section (render the cart for the user to view the page)
$cartOutput = "";
$cartTotal = 0;
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['item_id'];
		$sql = mysqli_query($con, "SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysqli_fetch_array($sql)) {
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $cartTotal + $pricetotal;
		setlocale(LC_MONETARY, "en_US");
        $pricetotal = number_format($pricetotal, 2);
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="product.php?id=' . $item_id . '">' . $product_name . '</a><br /><img src="inventory_images/' . $item_id . '.jpg" alt="' . $product_name. '" width="40" height="52" border="1" /></td>';
		$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	setlocale(LC_MONETARY, "en_US");
    $cartTotal = number_format($cartTotal, 2);
	$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";
}
?>

<html>
<head>
<title>Your Cart</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent">
    <div style="margin:24px; text-align:left;">
	
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <th width="18%" bgcolor="#C5DFFA">Product</strong></th>
        <th width="45%" bgcolor="#C5DFFA">Product Description</th>
        <th width="10%" bgcolor="#C5DFFA">Unit Price</th>
        <th width="9%" bgcolor="#C5DFFA">Quantity</th>
        <th width="9%" bgcolor="#C5DFFA">Total</th>
        <th width="9%" bgcolor="#C5DFFA">Remove</th>	
      </tr>
	  <?php echo $cartOutput;?>

     <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
		<?php echo $cartTotal; ?>
    <br />


    <br />
    <br />
    <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
    </div>
   <br />
  </div>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>