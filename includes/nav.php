    <div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <!-- Begin Header Bottom Menu Area -->
                   <div class="hb-menu">
                       <nav>
                           <ul>
                                <li class="active"><a href="./">Home</a></li>
                                <li class="megamenu-holder"><a href="">Categories</a>
                                  <ul class="megamenu hb-megamenu">
                                       <li>
                                           <ul><?php
                                                $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_id desc LIMIT 0,10 ");
                                                $cate->execute();
                                                while($see_cate = $cate->fetch()){?><li>
                                                    <a href="see-product-by-category.php?category_name=<?php echo $see_cate['category_name'] ?> "><?php echo $see_cate['category_name'] ?> 
                                                    </a> </li><?php
                                                } ?> 
                                           </ul>
                                       </li>
                                      
                                   </ul>
                                </li>

                                <li class="megamenu-holder"><a href="">Product Variants</a>
                                   <ul class="megamenu hb-megamenu">
                                       <li>
                                            <ul><?php
                                                $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_name desc  LIMIT 0,10");
                                                $cate->execute();
                                                while($see_cate = $cate->fetch()){?><li>
                                                    <li><a href=""><?php echo $see_cate['type_name'] ?> 
                                                    </a> </li><?php
                                                } ?>
                                           </ul>
                                       </li>
                                       
                                   </ul>
                               </li>

                               <li class="megamenu-holder"><a href="">Product Brands</a>
                                   <ul class="megamenu hb-megamenu">
                                       <li>
                                            <ul><?php
                                                $cate = $db->prepare("SELECT * FROM manufacturer ORDER BY manufacturer_name ASC LIMIT 0,10");
                                                $cate->execute();
                                                while($see_cate = $cate->fetch()){?><li>
                                                    <a href="brand-products.php?brand_name=<?php echo $see_cate['manufacturer_name'] ?>"><?php 
                                                        echo $see_cate['manufacturer_name'] ?> 
                                                    </a></li><?php
                                                } ?>
                                           </ul>
                                       </li>
                                       
                                   </ul>
                               </li>
                               <li><a href="">About Us</a></li>
                               <li><a href="">Contact</a></li>
                               <li><a href="">Smartwatch</a></li>
                               <li><a href="">Accessories</a></li>
                           </ul>
                       </nav>
                   </div>
                   <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="mobile-menu">
            <nav>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li class="megamenu-holder"><a href="">Categories</a>
                       <ul class="megamenu hb-megamenu">
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_id desc LIMIT 0,5 ");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="see-product-by-category.php?category_name=<?php echo $see_cate['category_name'] ?> "><?php echo $see_cate['category_name'] ?> 
                                        </a> </li><?php
                                    } ?> 
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_name asc LIMIT 0,5 ");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="see-product-by-category.php?category_name=<?php echo $see_cate['category_name'] ?> "><?php echo $see_cate['category_name'] ?> 
                                        </a> </li><?php
                                    } ?> 
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_name desc LIMIT 0,5 ");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="see-product-by-category.php?category_name=<?php echo $see_cate['category_name'] ?> "><?php echo $see_cate['category_name'] ?> 
                                        </a> </li><?php
                                    } ?> 
                               </ul>
                           </li>
                       </ul>
                    </li>

                    <li class="megamenu-holder"><a href="">Product Variants</a>
                       <ul class="megamenu hb-megamenu">
                           <li>
                                <ul><?php
                                    $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_name asc  LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <li><a href=""><?php echo $see_cate['type_name'] ?> 
                                        </a> </li><?php
                                    } ?>
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_id desc  LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <li><a href=""><?php echo $see_cate['type_name'] ?> 
                                        </a> </li><?php
                                    } ?>
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_id desc  LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <li><a href=""><?php echo $see_cate['type_name'] ?> 
                                        </a> </li><?php
                                    } ?>
                               </ul>
                           </li>
                       </ul>
                   </li>

                   <li class="megamenu-holder"><a href="">Product Brands</a>
                       <ul class="megamenu hb-megamenu">
                           <li>
                                <ul><?php
                                    $cate = $db->prepare("SELECT * FROM manufacturer ORDER BY manufacturer_name ASC LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="brand-products.php?brand_name=<?php echo $see_cate['manufacturer_name'] ?>"><?php 
                                            echo $see_cate['manufacturer_name'] ?> 
                                        </a></li><?php
                                    } ?>
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate=$db->prepare("SELECT * FROM manufacturer ORDER BY manufacturer_id DESC LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="brand-products.php?brand_name=<?php echo $see_cate['manufacturer_name'] ?>"><?php 
                                            echo $see_cate['manufacturer_name'] ?> 
                                        </a></li><?php
                                    } ?>
                               </ul>
                           </li>
                           <li>
                               <ul><?php
                                    $cate = $db->prepare("SELECT * FROM manufacturer ORDER BY manufacturer_name desc LIMIT 0,5");
                                    $cate->execute();
                                    while($see_cate = $cate->fetch()){?><li>
                                        <a href="brand-products.php?brand_name=<?php echo $see_cate['manufacturer_name'] ?>"><?php 
                                            echo $see_cate['manufacturer_name'] ?> 
                                        </a></li><?php
                                    } ?>
                               </ul>
                           </li>
                       </ul>
                   </li>
                   <li><a href="about-us.html">About Us</a></li>
                   <li><a href="contact.html">Contact</a></li>
                   <li><a href="">Smartwatch</a></li>
                   <li><a href="">Accessories</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>