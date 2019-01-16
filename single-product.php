<?php  
    require_once("includes/header.php");
    require_once 'includes/nav.php';

    $product_number = $_GET['product_number'];
    $ragzProduct = $productDetails->getProductsDet($product_number);
    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
    $type_id = $ragzProduct['type_id'];
    $typeDe = $productsCate->getTypeDetailsId($type_id);
    $category_id = $typeDe['category_id'];
    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $cateDetails['category_name'];
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
    $manufacturer_name = $manuDetails['manufacturer_name']; 
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
    $arr = array(':manufacturer_id'=>$manufacturer_id);
    $gettingManu->execute($arr); 
    $totalItems =  count($productDetails->getAllProductsCategoryList($category_id));
    $itemsPerPage = 30;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $seeProdcut = $productDetails->getCategoryProductsDeta($category_id, $start, $itemsPerPage);
?>
?>
            
 <div class="li-static-banner pt-20 pt-sm-30">
    <div class="container">
        <div class="row"><div class="col-lg-3">
            <!--Category Menu Start-->
            <div class="category-menu category-menu-2">
                <div class="category-heading">
                    <h2 class="categories-toggle"><span>categories</span></h2>
                </div>
                <div id="cate-toggle" class="category-menu-list">
                    <ul>
                        <?php 
                        $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_name asc LIMIT 0,20 ");
                        $cate->execute();
                        while($see_cate = $cate->fetch()){?>
                            <li>
                                <a href="see-product-by-category.php?category_name=<?php echo $see_cate['category_name'] ?> "><?php echo $see_cate['category_name'] ?> 
                                </a> 
                            </li><?php
                        } ?> 
                        
                        <li class="rx-parent">
                            <a class="rx-default">More Categories</a>
                            <a class="rx-show">Less Categories</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Category Menu End-->
        </div>

        <div class="col-lg-9 order-1 order-lg-2">
            <div class="product-area pt-55 pb-25 pt-xs-50">
                <div class="container">
                    
                    <div class="content-wraper">
                        <div class="container">
                            <div class="row single-product-area">
                                <div class="col-lg-5 col-md-6">
                                   <!-- Product Details Left -->
                                    <div class="product-details-left sp-tab-style-left-page">
                                        <div class="product-details-images slider-navigation-1">
                                            <div class="lg-image">
                                                <a class="popup-img venobox vbox-item" href="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" data-gall="myGallery">
                                                    <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" alt="product image">
                                                </a>
                                            </div>
                                            <div class="lg-image">
                                                <a class="popup-img venobox vbox-item" href="<?php echo "images/product/small-image/".$ragzProductDetails['product_thumbnail']?> ?>" data-gall="myGallery">
                                                    <img src="<?php echo "images/product/small-image/".$ragzProductDetails['product_thumbnail']?> ?>" alt="product image">
                                                </a>
                                            </div>
                                            
                                        </div>
                                        <div class="tab-style-left">
                                            <div class="sm-image"><img src="<?php echo "images/product/small-image/".$ragzProductDetails['product_thumbnail']?>" alt="product image thumb"></div>
                                            <div class="sm-image"><img src="<?php echo "images/product/large-image/".$ragzProduct['product_image']  ?>" alt="product image thumb"></div>
                                           
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6">
                                    <div class="product-details-view-content pt-60">
                                        <div class="product-info">
                                            <h2><?php echo $ragzProduct['product_name']; ?></h2>
                                            <span class="product-details-ref">Reference: <?php echo $product_number ?></span>
                                            <div class="rating-box pt-20">
                                                <ul class="rating rating-with-review-item">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li><?php 
                                                    while($see_manu = $gettingManu->fetch()){ ?>
                                                        <li class="review-item">
                                                            <?php echo $see_manu['manufacturer_name']; ?>  
                                                        </li><?php
                                                    } ?></b>
                                                </ul>
                                            </div>
                                            <div class="price-box pt-20">
                                                <span class="old-price" style="color: red"><?php 
                                                    $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                    $num2= (20/100)*$ragzProductDetails['product_price'];
                                                    $adding = $num2 + $ragzProductDetails['product_price'];
                                                    number_format($ragzProductDetails['product_price']); ?> 
                                                     &#8358;<?php echo number_format($adding) ?>   
                                                </span>
                                                <span class="new-price" style="color: green">&#8358;<?php echo number_format($num) ?>
                                                    
                                                </span>
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    <span><?php echo $ragzProductDetails['product_description'] ?>
                                                    </span>
                                                </p>
                                            </div>
                                            
                                            <div class="product-variants">
                                                <div class="produt-variants-size">
                                                    <?php $sizeArray = explode(",", $ragzProductDetails['product_size']);?>
                                                    <?php 
                                                    if(count($sizeArray)){ 
                                                        if($sizeArray !== ""){ ?>
                                                            <label>Sizes</label>
                                                            <select class="nice-select" name="product_size">
                                                                <option value="" selected></option>
                                                                <?php foreach($sizeArray as $size){?>
                                                                    <option value="<?php echo trim($size); ?>"><?php echo $size; ?></option>
                                                                <?php }?>
                                                            </select><?php
                                                        }else{ ?>
                                                            <p>Size: NULL </p>
                                                            <input type="hidden" name="product_size" value="<?php echo "NULL" ?>"><?php
                                                        } 
                                                    } ?>

                                                </div>
                                            </div>
                                            <div class="single-add-to-cart">
                                                
                                                <div class="quantity">
                                                    <label>Quantity</label><?php
                                                    $early = 1;
                                                    $current = $ragzProductDetails['quantity'];
                                                    print '<select class ="form-control" required name ="quantity">';
                                                    foreach(range($early, $current) as $i){
                                                        print'<option value=" '.$i.'"'.($i === $current ? 'selected="selected"' : '').'>'.$i.'</option>';
                                                    }
                                                    print '</select>';?>
                                                </div>
                                                <form action="#" class="cart-quantity" method="post">
                                                    <input type="hidden" name="product_price" value="<?php echo $num ?>">
                                                    <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
                                                    <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">
                                                    <button class="add-to-cart" id="submit" name="submit">Add to cart</button>
                                                    <a class="wishlist-btn" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>"><i class="fa fa-heart-o"></i>Add to wishlist
                                                    </a>
                                                </form>
                                            </div>
                                        </div>                
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="product-area li-laptop-product pt-30 pb-50">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Other Products in <?php echo $category_name ?> Categories:</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    <?php  
                                    foreach($seeProdcut as $featureProduct){ 
                                        $product_number = $featureProduct['product_number'];?>
                                        <div class="col-lg-12"> <?php
                                            
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
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>

