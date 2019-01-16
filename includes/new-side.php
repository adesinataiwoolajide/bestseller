<div class="col-lg-3">
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
