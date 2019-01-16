<?php 
    session_start();
    include_once("connection/connection.php");
    require 'libs_dev/products/products_class.php';
    require 'libs_dev/merchant/merchant_class.php';
    require 'dev_class/register/customer_registration_class.php';
    require 'dev_class/Cart.php';
    require 'dev_class/General.php';
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
    $register = new newCustomerRegistration($db);
    $carting = new Cart();
    $general = new General();
    $merchantDetails = new productMerchant($db);
    $custOrder = new customersOrders($db);
    $listProduct = $productDetails->getAllProductsPublish();
    $bestProduct = $productDetails->getAllBestProductsPublish();
    $lastProduct = $productDetails->getAllLastProductsPublish();
?>
<!doctype html>
<html class="no-js" lang="zxx">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Best Seller || Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Modernizr js -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/Toast/css/Toast.min.css">
    <script type="text/javascript" src="handlers/js/jquery-1.11.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            <header>
                <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span>Telephone Enquiry:</span><a href="callto://+123123321345">(+123) 123 321 345</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        <!-- Begin Setting Area -->
                                        <li>
                                            <div class="ht-setting-trigger"><span>Setting</span></div>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    <li><a href="login-register.html">My Account</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="login-register.html">Sign In</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Setting Area End Here -->
                                        <!-- Begin Currency Area -->
                                        <li>
                                            <span class="currency-selector-wrapper">Currency :</span>
                                            <div class="ht-currency-trigger"><span>USD $</span></div>
                                            <div class="currency ht-currency">
                                                <ul class="ht-setting-list">
                                                    <li><a href="#">EUR €</a></li>
                                                    <li class="active"><a href="#">USD $</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Currency Area End Here -->
                                        <!-- Begin Language Area -->
                                        <li>
                                            <span class="language-selector-wrapper">Language :</span>
                                            <div class="ht-language-trigger"><span>English</span></div>
                                            <div class="language ht-language">
                                                <ul class="ht-setting-list">
                                                    <li class="active"><a href="#"><img src="images/menu/flag-icon/1.jpg" alt="">English</a></li>
                                                    <li><a href="#"><img src="images/menu/flag-icon/2.jpg" alt="">Français</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Language Area End Here -->
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="index.html">
                                        <img src="images/menu/logo/1.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9">
                                <!-- Begin Header Middle Searchbox Area -->
                               <form action="#" class="hm-searchbox">
                                    <select class="nice-select select-search-category"><?php

                                        $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_name asc");
                                        $cate->execute();?><option value="">All</option><?php   
                                        while($see_cate = $cate->fetch()){?>
                                             <option value="<?php echo $see_cate['category_name'] ?>"><?php echo $see_cate['category_name'] ?> </option><?php 
                                        } ?> 
                                    </select>
                                    <input type="text" placeholder="Enter your search key ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                <!-- Header Middle Searchbox Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                        <!-- Begin Header Middle Wishlist Area -->
                                        <li class="hm-wishlist">
                                            <a href="#">
                                                <span class="cart-item-count wishlist-item-count">0</span>
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>
                                        <!-- Header Middle Wishlist Area End Here -->
                                        <!-- Begin Header Mini Cart Area -->
                                        <li class="hm-minicart">
                                            <div class="hm-minicart-trigger"><?php 
                                                if(isset($_SESSION['cart'])){ ?>
                                                    <span class="item-icon"></span>
                                                    <span class="item-text">000
                                                        <span class="cart-item-count"><?php echo $totalGoodsinCart = Cart::getTotalQuantity($_SESSION['cart'])[0] ?></span>
                                                    </span><?php
                                                }else{ ?>
                                                    <span class="item-icon"></span>
                                                    <span class="item-text">#00.00
                                                        <span class="cart-item-count">0</span>
                                                    </span><?php
                                                } ?>
                                            </div>
                                            <span></span><?php
                                            if(isset($_SESSION['cart'])){
                                                $cart = $_SESSION['cart'];
                                                $count = count($cart);
                                                if($count > 0){
                                                    $total = array(); ?>
                                                    <div class="minicart">
                                                        <ul class="minicart-product-list"><?php
                                                            foreach($cart as $item){  
                                                                $product_number = $item['product_number'];
                                                                $ragzProduct = $productDetails->getProductsDet($product_number);
                                                                $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                                                $tripple = $productDetails->getTrippleProductsDet($product_number);
                                                                ?>
                                                                <li>
                                                                    <a href="product-details-right-sidebar.html" class="minicart-product-image">
                                                                        <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" alt="product" width="30" height="20">
                                                                    </a>
                                                                    <div class="minicart-product-details">
                                                                        <h6><a href="product-details-right-sidebar.html"><?php echo $tripple['product_name']; ?></a></h6>
                                                                        <span>&#8358;<?php echo  $price =$ragzProductDetails['product_price'];
                                                                        $cal = $ragzProductDetails['product_price'] * $item['quantity'];
                                                                        array_push($total, $price); ?></span>
                                                                    </div>
                                                                    <a href="handlers/cart/removeFromCart.php?product_number=<?php echo $product_number?>"" class="btn-remove" title="Remove Product">
                                                                        <i class="fa fa-close"></i>
                                                                    </a>
                                                                   
                                                                </li><?php 
                                                            } ?>
                                                            
                                                        </ul>
                                                        <p class="minicart-total">SUBTOTAL: <span>&#8358;<?php echo number_format(array_sum($total));?></span>
                                                        </p>
                                                        <div class="minicart-button">
                                                            <a href="checkout.html" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                                                <span>View Full Cart</span>
                                                            </a>
                                                            <a href="checkout.html" class="li-button li-button-fullwidth li-button-sm">
                                                                <span>Checkout</span>
                                                            </a>
                                                        </div>
                                                    </div><?php 
                                                }

                                            }else{ ?>
                                                <p style="color: red">Empty Shopping Cart</p><?php
                                            } ?>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>