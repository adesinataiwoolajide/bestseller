<?php 

	if($_POST){
		echo $quantity = $_POST['quantity'];
		echo $size = $_POST['product_size'];
		echo $price = $_POST['product_price'];

	}else{
		echo "No";
	}
?>