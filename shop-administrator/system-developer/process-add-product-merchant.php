<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require("../../dev/registration/class_registration.php");
	require '../../libs_dev/products/products_class.php';
	require '../../libs_dev/merchant/merchant_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$merchantDetails = new productMerchant($db);
		$productDetails = new ragzNationProducts($db);
		$adminDetails = new staffRegistration($db);
		$dir = "../../assets/images/merchant/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);
	    $ext = $file_ext['extension'];
	    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");
	    
	    if(!(in_array($ext,$extensions))){
	    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
	        $all_purpose->redirect("add-merchant.php");	
     	}
		if($file_size > 1097152){
          	$_SESSION['error'] = 'File size must be not greater than 1 MB';
          	$all_purpose->redirect("add-merchant.php");	
    	}else{
			if(isset($_POST['adding-merchant'])){
				$email = $_SESSION['user_name'];
				$merchant_name = $all_purpose->sanitizeInput($_POST['merchant_name']);
				$merchant_email = $all_purpose->sanitizeInput($_POST['merchant_email']);
				$full_name = $all_purpose->sanitizeInput($_POST['full_name']);
				$users = $merchant_email;

				if($merchantDetails->checkMerchantEmail($merchant_email)){
					$_SESSION['error'] = "$merchant_email Is In Use By Another Merchant , Please Kindly Use Another Email ";
					$all_purpose->redirect("add-merchant.php");
				}elseif($merchantDetails->checkMerchantName($merchant_name)){
					$_SESSION['error'] = "$merchant_name Is In Use By Another Merchant, , Please Kindly Use Another";
					$all_purpose->redirect("add-merchant.php");
				}elseif($adminDetails->checkingUserExistence($users)){
					$_SESSION['error'] = "$users Is In Use By Another Admin, Please Kindly Use Another E-Mail";
					$all_purpose->redirect("add-merchant.php");

				}else{
					$number_type = "Merchant";
					$month = date("m");
					$number_year = date("Y");
					$year_number = $number_year;
					$category = $number_type;
					$day = date("d");

					$getting = $db->prepare("SELECT * FROM generated_numbers WHERE year_number=:number_year AND number_type=:number_type AND month=:month ORDER BY last_id DESC LIMIT 0,1");
					$arrget= array(':number_year'=>$number_year, ':number_type'=>$number_type, ':month'=>$month);
					$getting->execute($arrget);
					if($getting->rowCount()==0){
						$new_number = 0;
						$adding = $new_number+1;
					}else{
						$see_last = $getting->fetch();
						$conf = $see_last['last_number'];
						$adding = $conf+1;
					}
					$code_name = $number_year.$month.$day;
					if(strlen($adding)>2){
						$dot="";
					}else{
						$dot ="00";
					}
					$eemail = $merchant_email;
					$access = 2;
					$password = sha1($merchant_email);
					$merchant_number ="GMC".$code_name.$dot.$adding;
					$last_number = $dot.$adding;
					$move= move_uploaded_file($file_tmp, $dir.$file_name);
					$merchant_logo = $file_name;
					if(!empty($merchantDetails->addMerchantDetails($merchant_number, $merchant_name, $merchant_logo, $merchant_email)) AND ($productDetails->insertingTheGenLastNumber($number_type, $year_number, $month, $last_number)) AND ($adminDetails->userRegistration($full_name, $eemail, $password, $access))){
						$action= "Added $merchant_name with the Merchant number $merchant_number To The Merchant List";
						$his= $all_purpose->operationHistory($action, $email);
						$_SESSION['success']= strtoupper("You Have Added $merchant_name with the Merchant number $merchant_number To The Merchant List Successfully");
						$all_purpose->redirect("add-merchant.php");
					}else{
						$_SESSION['error'] = strtoupper("Unable To Add $merchant_name to The Merchant List at The Moment, Please Try Again Later");
						$all_purpose->redirect("add-merchant.php");
					}
				}
			}else{
				$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add The Merchant Details");
				$all_purpose->redirect("add-merchant.php");
			}
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("add-merchant.php");
	}