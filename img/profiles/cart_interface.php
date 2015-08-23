<?php
session_start(); 
include_once 'config.php';
include 'cart.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="functions.js"></script>
<script language="javascript" type="text/javascript" src="jquery.js"></script>
</head>
<body>
<div id="cart_interface">
<table cellpadding="4">
<?php 
foreach ($_SESSION['products'] as $key=>$value) {
$q="SELECT * FROM products WHERE id='$key'";
$product=$db->fetch_assoc($db->query($q));
?>           
<tr>
<td><?php echo $product['name']?></td>
<td>
количество: <input type="text" size="2" id="product_count_<?php echo $key;?>" value="<?php echo $_SESSION['products'][$key]['count']?>" /> 
<span onclick="update_product_count(<?php echo $key?>, $('#product_count_<?php echo $key;?>').val())">обновить</span>
</td>
<td>
стоимость: 
<?php echo ($_SESSION['products'][$key]['count']*$_SESSION['products'][$key]['cost'])?>
</td>
<td>
<span onclick="remove_from_cart(<?php echo $key?>)">удалить</span>
</td>
</tr>
<?php   
}
?>
</table>
<div>Товаров в корзине <?php echo $_SESSION['products_incart']?> на сумму <?php echo $_SESSION['cart_cost']?></div>
</div>
<a href="index.php">вернуться к покупкам</a>
</body>
</html>