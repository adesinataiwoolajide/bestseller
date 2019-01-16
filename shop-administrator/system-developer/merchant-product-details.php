<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/merchant/merchant_class.php';
    require '../../libs_dev/products/products_class.php';
    $merchantDetails = new productMerchant($db);
    $productsCate = new ragzNationProductsCategory($db);
	$productDetails = new ragzNationProducts($db);
    $product_number = $_GET['product_number'];
    $merchant_number = $_GET['merchant_number'];
    $ragzProduct = $productDetails->getProductsDet($product_number);
    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
    $product_name = $ragzProduct['product_name'];
    $category_id = $ragzProduct['category_id'];
    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $cateDetails['category_name'];
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
    $manufacturer_name = $manuDetails['manufacturer_name'];
    $type_id = $ragzProductDetails['type_id'];
    $typeDetails = $productsCate->getTypeDetailsId($type_id);
    $type_name = $typeDetails['type_name'];

    $details = $merchantDetails->gettingMerchantDelatils($merchant_number);
    $merchant_name = $details['merchant_name'];
    $merchant_email = $details['merchant_email'];
    $users = $merchant_email;
    $admin = $register->gettingUserDetails($users);
    $seeProdcut = $productDetails->getMerchantProductsDet($merchant_number);
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li><a href="product-details.php?product_number=<?php echo $product_number?>"><?php echo $product_name ?> Details</p></a></li>  
                  
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
    <li><a href="merchant-products-list.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-list"></i>All <?php echo $merchant_name ?> Products</p></a></li>
    <li><a href="merchant-details.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-list"></i><?php echo $merchant_name ?> Details</p></a></li> 
    <li class="active">Product Details</li>   
</ul>
<!-- END BREADCRUMB -->                       
<?php
if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
    <div class="alert alert-info" align="center">
        <button class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
     <?php include("../includes/feed-back.php"); ?>
    </div><?php 
}  ?> 
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
                    
    <div class="row">
        <div class="col-md-3">
            
            <div class="panel panel-default">
                <div class="panel-body profile" style="background: url('<?php echo "../../assets/products-images/large-image/".$ragzProduct['product_image'] ?>') center center no-repeat;">
                    <div class="profile-image">
                        <img src="<?php echo "../../assets/images/products-images/large-image/".$ragzProduct['product_image'] ?>" alt="<?php echo $product_number; ?>" style="width: 100px; height: 100px;"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name" style="color: black">
                        	<?php echo $product_name; ?>
                        </div>
                        <div class="profile-data-title" style="color: black;">
                        	<?php echo $product_number; ?>	
                        </div>
                    </div>                                 
                </div>                                
                <div class="panel-body">                                    
                    <div class="row" align="center">
                        Product Image
                    </div>
                </div>
                <div class="panel-body list-group border-bottom" align="center">
                	<a href="Product_details.php?product_number=<?php echo $product_number?>" class="list-group-item active"><span class="fa fa-image"></span> Product Thumbnail Image
                	</a>
                	<img src="<?php echo "../../assets/images/products-images/thumbnail/".$ragzProductDetails['product_thumbnail'] ?>" alt="<?php echo $product_number; ?>" align="center" style="width: 200px; height: 200px;"/>
                	
                </div>
                
            </div>                            
            
        </div>
        
        <div class="row">
        	<div class="col-md-9"> 
	            <div class="panel panel-default">
	                <table id="customers2" class="table datatable">
	                                                        
	                    <div class="panel-body">
	                    	<table class="table table-responsive">
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Name</td>
	                    				<td><?php echo $product_name; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Number</td>
	                    				<td><?php echo $product_number ?></td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Price</td>
	                    				<td><?php echo $ragzProductDetails['product_price']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Quantity</td>
	                    				<td><?php 
	                    					$quantity = $ragzProductDetails['quantity']; 
	                    					if($quantity <= 20){ ?>
	                    						<p style="color: red"><?php echo $quantity; ?></p><?php
	                    					}else{ ?>
	                    						<p style="color: green"> <?php echo $quantity; ?></p><?php
	                    					} ?>	
	                    				</td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Size</td>
	                    				<td><?php echo $ragzProductDetails['product_size'] ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Manufacturer</td>
	                    				<td><?php echo $manufacturer_name ?></td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Type</td>
	                    				<td><?php echo $type_name ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Category</td>
	                    				<td><?php echo $category_name ?></td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Description</td>
	                    				<td><?php echo $ragzProductDetails['product_description']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Publish Status</td>
	                    				<td><?php 
	                    					$publish= $ragzProductDetails['publish'];
	                    					if($publish == 0){  ?>
		                                        <p style="color: red"><?php  echo $product_number. " Not Published" ?> <i class="fa fa-ban" style="color: red"></i> </p><?php
		                                    }else{ ?>
		                                        <p style="color: green"><?php  echo $product_number. " Published" ?> <i class="fa fa-check-square-o"></i> </p><?php
		                                    } ?>
	                    				</td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Time Addes</td>
	                    				<td><?php echo $ragzProductDetails['created']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    	</table>                       
	                       
	                    </div>
	                </table>                                    
	            </div>
	        </div>
        </div>
        <div class="row">
        	<div class="col-md-12" > 
	            <div class="panel panel-default">
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-products-list.php?merchant_number=<?php echo $merchant_number ?>';">
	                        <div align="center">
	                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">All Products <?php echo $productDetails->countMerchantProductsDet($merchant_number); ?></p>
	                        </div>      
	                    </div>                            
	                </div>
					<div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/orders.jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Orders</p>
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-published-products.php?merchant_number=<?php echo $merchant_number?>';">
	                        <div align="center">
	                            <img src="../../icons/publish.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center" style="color: green"> 
	                            	Published Product <?php echo $productDetails->countMerchantProductPublish($merchant_number) ?>
	                            		
	                            </p>
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number?>';">
	                        <div align="center">
	                            <img src="../../icons/unpublish.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center" style="color: red">
	                            	Un Published Products  <?php echo $productDetails->countMerchantProductUnPublish($merchant_number)?>
	                            		
	                            </p>
	                        </div>      
	                    </div>                            
	                </div>  
	                              
	            </div>
	        </div>
        </div>

	</div>
<?php
    include("../log-out-modal.php");
	include("../table-footer.php");
?>

