<?php
session_start();
include_once("../../connection/connection.php");
require '../../libs_dev/products/products_class.php';
require_once '../../dev/general/all_purpose_class.php';
$returnUrl = $_SERVER['HTTP_REFERER'];
$all_purpose = new all_purpose($db);
$product = new ragzNationProducts($db);
$product_number = $_GET['product_number'];
$productDetails = $product->getProductsDetails($product_number);
$ragzProduct = $product->getProductsDet($product_number);

	if(isset($_GET['product_number'])){
		$_SESSION['product_number']  = $product_number;
		$_SESSION['price'] = $_GET['product_price'];
		// $_SESSION['quantity'] = $_GET['quantity'];
		// $_SESSION['size'] = $_GET['product_size'];
		//echo $price = $_POST['product_price'];

		//$sizes = explode(",", $_SESSION['size']);
		$itemArray = array(
		$productDetails["product_number"] => array(
			'product_number' => $_SESSION['product_number'],
			'name'=> $ragzProduct["product_name"], 
			'price'=> $_SESSION['price'],
			'quantity' => $_SESSION['quantity'],
			'sizes' => $_SESSION['size'],
			)
		);

		if(!empty($_SESSION['cart'])){
			
			if(in_array($product_number, array_keys($_SESSION['cart']))){		
				foreach(($_SESSION['cart']) as $k => $v){
					
					if($_SESSION['cart'][$k]['product_number'] == $productDetails['product_number']){
						if($_SESSION['cart'][$k]['sizes'] == $sizes){
							$_SESSION['cart'][$k]['quantity'] += 1 ;
						}else{
							$_SESSION['cart'][$k]['quantity'] += 0;
						}
					}
				}
			}else{
				$_SESSION["cart"] += $itemArray;	
			}
		}else{
			$_SESSION["cart"] = $itemArray;
		}
		//$_SESSION['success'] = strtoupper(ucwords($ragzProduct["product_name"])." added to your shopping bag");
		//$all_purpose->redirect($returnUrl);
	}else{
		$_SESSION['error'] = "Please Click On Your Preferred Product";
		$all_purpose->redirect($returnUrl);
	}


?>