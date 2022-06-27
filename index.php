<?php
   include"StoreScript/connect_to_mysql.php";
   $dynamicList= "";
	
	$sql = mysqli_query($con, "select * from products order by date_added limit 6");
	$productCount = mysqli_num_rows($sql); //count the number of record
	if ($productCount >0){
		while($row = mysqli_fetch_array($sql)){
		$id = $row["id"];
		$product_name = $row["product_name"];
		$price = $row["price"];
		$date_added = $row["date_added"];
		$dynamicList .= '<table width"100%" border = "0" cellpadding="6">
		     <tr>
			     <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img src = "inventory_images/'. $id . ' .jpg" alt="'. $product_name . '" width ="75" height="100" border="1"></a></td>
				 <td width = "83%" valign= "top">' . $product_name . '<br/>
				 Php' . $price . ' <br/>
				 <a href="product.php?id=' .$id. '">View product details</a></td>	
           </tr>				 
		</table>';
		
		}
	}else{	
		$dynamiList="We have no products listed in our store yet";
	}
     mysqli_close($con);
?>

<html>
<head>
<title>Store Home Page</title>
<link rel = "stylesheet" href = "Styles/style.css" type = "text/css" media = "screen"/>
</head>
<body>


<div align="center" id="mainWrapper">
 <?php include_once("template_header.php");?>
  <div id="pageContent">
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
	  <tr>
		<td width="32%" valign="top"><h3>What the Hell?</h3>
		  <p>This website is very temporarily being used as an online live showcase area for online selling of guns and ammo products. </p>
		  <p>It is not an actual store and it will change upon the request of business owner <br />
			<br />
			This online store is for educational purposes only. Use of standard scripts is highly expected.</p></td>
		<td width="35%" valign="top"><h3>Latest Designer Fashions</h3>
		      <p><?php echo $dynamicList;?><br/>
			  </p>
		  <p><br />List of products will be listed here...
		  </p></td>
		<td width="33%" valign="top"><h3>Handy Tips</h3>
		  <p>If you operate any store online you should read the documentation provided to you by the online payment gateway you choose for handling the checkout process. You can get much more insight than I can offer on the various details of a gateway, from the gateway providers themselves. They are there to help you with whatever you need since they get a cut of your online business dealings.</p></td>
	  </tr>
	</table>
  </div>
</div>
 <?php include_once("template_footer.php");?>

</body>
</html>