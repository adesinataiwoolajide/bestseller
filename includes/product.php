<div class="col-lg-9 order-1 order-lg-2">
    <div class="product-area pt-55 pb-25 pt-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                           <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                           <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                           <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li>
                        </ul>               
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <?php 
                            foreach($listProduct as $featureProduct){ ?>
                                <div class="col-lg-12"> 
                                <!-- single-product-wrap start --><?php
                                    $product_number = $featureProduct['product_number'];
                                    $ragzProduct = $productDetails->getProductsDet($product_number);
                                    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                    $type_id = $ragzProduct['type_id'];
                                    $typeDe = $productsCate->getTypeDetailsId($type_id);
                                    $category_id = $typeDe['category_id'];
                                    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                    $category_name = $cateDetails['category_name'];
                                    $manufacturer_id = $ragzProduct['manufacturer_id'];
                                    $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
                                    $arr = array(':manufacturer_id'=>$manufacturer_id);
                                    $gettingManu->execute($arr); ?>
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="single-product.php?product_number=<?php echo $product_number ?>">
                                                <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">
                                                        </a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.php?product_number=<?php echo $product_number ?>"><?php echo $ragzProduct['product_name']; ?></a></h4>
                                                <div class="price-box">
                                                    
                                                    <span class="old-price" style="color: red"><?php 
                                                        $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                        $num2= (20/100)*$ragzProductDetails['product_price'];
                                                        $adding = $num2 + $ragzProductDetails['product_price'];
                                                        number_format($ragzProductDetails['product_price']); ?> 
                                                         &#8358;<?php echo number_format($adding) ?>   
                                                    </span>
                                                    <span class="new-price" style="color: green">&#8358;<?php echo number_format($num) ?></span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <form action="handlers/cart/addToCart.php" method="get">
                                                    <input type="hidden" name="sizes" value="<?php echo $ragzProductDetails['product_size']; ?>">
                                                    <input type="hidden" name="product_price" value="<?php echo $ragzProductDetails['product_price'] ?>">
                                                    <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
                                                    <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><button type="submit" class="btn btn-danger" value="Add To Cart" data-toggle="<?php echo $ragzProduct['product_name']; ?>" data-original-title="Add to cart"> ADD TO CART</button></li>
                                                        <li><a class="links-details" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>"><i class="fa fa-heart-o"></i></a></li>
                                                        <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="product-quick-view.php?product_number=<?php echo $product_number?>"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div><?php 

                            } ?>
                        </div>
                    </div>
                </div>
                <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <?php 
                            foreach($bestProduct as $featureProduct){ ?>
                                <div class="col-lg-12"> 
                                <!-- single-product-wrap start --><?php
                                    $product_number = $featureProduct['product_number'];
                                    $ragzProduct = $productDetails->getProductsDet($product_number);
                                    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                    $type_id = $ragzProduct['type_id'];
                                    $typeDe = $productsCate->getTypeDetailsId($type_id);
                                    $category_id = $typeDe['category_id'];
                                    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                    $category_name = $cateDetails['category_name'];
                                    $manufacturer_id = $ragzProduct['manufacturer_id'];
                                    $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
                                    $arr = array(':manufacturer_id'=>$manufacturer_id);
                                    $gettingManu->execute($arr); ?>
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="single-product.php?product_number=<?php echo $product_number ?>">
                                                <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">
                                                        </a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.php?product_number=<?php echo $product_number ?>"><?php echo $ragzProduct['product_name']; ?></a></h4>
                                                <div class="price-box">
                                                    
                                                    <span class="old-price" style="color: red"><?php 
                                                        $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                        $num2= (20/100)*$ragzProductDetails['product_price'];
                                                        $adding = $num2 + $ragzProductDetails['product_price'];
                                                        number_format($ragzProductDetails['product_price']); ?> 
                                                         &#8358;<?php echo number_format($adding) ?>   
                                                    </span>
                                                    <span class="new-price" style="color: green">&#8358;<?php echo number_format($num) ?></span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                    <li><a class="links-details" href="single-product.php?product_number=<?php echo $product_number ?>"><i class="fa fa-heart-o"></i></a></li>
                                                    <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div><?php 

                            } ?>
                        </div>
                    </div>
                </div>
                <div id="li-featured-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            <?php 
                            foreach($lastProduct as $featureProduct){ ?>
                                <div class="col-lg-12"> 
                                <!-- single-product-wrap start --><?php
                                    $product_number = $featureProduct['product_number'];
                                    $ragzProduct = $productDetails->getProductsDet($product_number);
                                    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                    $type_id = $ragzProduct['type_id'];
                                    $typeDe = $productsCate->getTypeDetailsId($type_id);
                                    $category_id = $typeDe['category_id'];
                                    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                    $category_name = $cateDetails['category_name'];
                                    $manufacturer_id = $ragzProduct['manufacturer_id'];
                                    $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
                                    $arr = array(':manufacturer_id'=>$manufacturer_id);
                                    $gettingManu->execute($arr); ?>
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="single-product.php?product_number=<?php echo $product_number ?>">
                                                <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">
                                                        </a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.php?product_number=<?php echo $product_number ?>"><?php echo $ragzProduct['product_name']; ?></a></h4>
                                                <div class="price-box">
                                                    
                                                    <span class="old-price" style="color: red"><?php 
                                                        $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                        $num2= (20/100)*$ragzProductDetails['product_price'];
                                                        $adding = $num2 + $ragzProductDetails['product_price'];
                                                        number_format($ragzProductDetails['product_price']); ?> 
                                                         &#8358;<?php echo number_format($adding) ?>   
                                                    </span>
                                                    <span class="new-price" style="color: green">&#8358;<?php echo number_format($num) ?></span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                    <li><a class="links-details" href="single-product.php?product_number=<?php echo $product_number ?>"><i class="fa fa-heart-o"></i></a></li>
                                                    <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div><?php 

                            } ?>
                        </div>
                    </div>
                </div>
                <div class="li-static-banner li-static-banner-4 text-center pt-20">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Single Banner Area -->
                            <div class="col-lg-6">
                                <div class="single-banner pb-sm-30 pb-xs-30">
                                    <a href="#">
                                        <img src="images/banner/2_3.jpg" alt="Li's Static Banner">
                                    </a>
                                </div>
                            </div>
                            <!-- Single Banner Area End Here -->
                            <!-- Begin Single Banner Area -->
                            <div class="col-lg-6">
                                <div class="single-banner">
                                    <a href="#">
                                        <img src="images/banner/2_4.jpg" alt="Li's Static Banner">
                                    </a>
                                </div>
                            </div>
                            <!-- Single Banner Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>