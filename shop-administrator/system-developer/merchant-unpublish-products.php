<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    require '../../libs_dev/merchant/merchant_class.php';
    $merchantDetails = new productMerchant($db);
    $productDetails = new ragzNationProducts($db);
    $merchant_number = $_GET['merchant_number'];
    $details = $merchantDetails->gettingMerchantDelatils($merchant_number);
    $merchant_name = $details['merchant_name'];
    $merchant_email = $details['merchant_email'];
    $users = $merchant_email;
    $admin = $register->gettingUserDetails($users);
    //$seeProdcut = $productDetails->getProductsUnPublishedProducts($merchant_number);

    $totalItems =  count($productDetails->getProductsUnPublishedProducts($merchant_number));
    $itemsPerPage = 20;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $seeProdcut = $productDetails->getMerchantUnPubProductsDet($merchant_number, $start, $itemsPerPage)
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-ban"></i> Un-Publish Product</p></a></li>          
    <li><a href="merchant-published-products.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-cloud"></i> Published Product</p></a></li>    
    <li><a href="merchant-products-list.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-list"></i>All <?php echo $merchant_name ?> Products</p></a></li>              
    <li><a href="merchant-details.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-list"></i><?php echo $merchant_name ?> Details</p></a></li> 

      
    
    <li class="active"><?php echo $merchant_name ?>Un Published Product List</li>   
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

<div class="page-content-wrap"><?php 
    if($productDetails->checkMerchantUnPublishProductsDet($merchant_number)){ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p style="color: red" align="center"><?php echo $merchant_name ?>Un Published Products is Empty</p>                          
                    </div>
                </div>
                
            </div>
        </div><?php
    }else{ ?>
        <div class="row">
            <div class="col-md-12">
                
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p style="color: green" align="center"><?php echo $merchant_name ?> List of Un Published Products</p>
                                                  
                    </div>
                </div>
                
            </div>
        </div>
                
        <div class="row"><?php 
            foreach($seeProdcut as $listProduct){ 
                $product_number = $listProduct['product_number'];
                $deta = $productDetails->getTrippleProductsDet($product_number);
                $ragzProduct = $productDetails->getProductsDet($product_number); ?>
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body profile">
                            <div class="profile-image">
                                <img src="<?php echo '../../assets/images/products-images/large-image/'.$ragzProduct['product_image'] ?>" alt="<?php echo $deta['product_name']; ?>" style="width: 100px; height: 100px;"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $deta['product_name']; ?></div>
                                
                                <div class="profile-data-title" style="color: pink">
                                    <del style="color: red">
                                    &#8358;<?php echo number_format($listProduct['product_price']) ?> 
                                    </del><?php
                                    $bonus = (15/100)*$listProduct['product_price']; ?>
                                    <strong>&#8358;<?php echo number_format($bonus+$listProduct['product_price']) ?></strong> 
                                </div>
                            </div>
                            <div class="profile-controls">
                                <a href="merchant-product-details.php?product_number=<?php echo $product_number?>&&merchant_number=<?php echo $merchant_number ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="merchant-product-details.php?product_number=<?php echo $product_number?>&&merchant_number=<?php echo $merchant_number ?>" class="profile-control-right"><span class="fa fa-info"></span></a>
                            </div>

                        </div>                                
                        <div class="panel-body" align="center">                                    
                            <div class="contact-info">
                                <p ><strong>
                                    <?php $publish= $listProduct['publish'];

                                    if($publish == 0){  ?>
                                        <p style="color: red"><?php  echo $product_number. " Not Published" ?> <i class="fa fa-ban" style="color: red"></i> </p><?php
                                    }else{ ?>
                                        <p style="color: green"><?php  echo $product_number. " Published" ?> <i class="fa fa-check-square-o"></i> </p><?php
                                    } ?></strong>
                                </p>
                                                                
                            </div>
                        </div>                                
                    </div>
                    <!-- END CONTACT ITEM -->
                </div><?php 
            } ?>
            <div class="row">
                <div class="col-md-12"><?php 
                    if($totalItems > 1){
                        if($page != $totalPages){ ?>
                            <div align="left">
                                <a href="merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number ?>&&page=<?php echo $page + 1;?>" class="btn btn-primary">NEXT PAGE
                                </a>
                            </div><?php
                        } 
                        if($page != 1){ ?>
                            <div align="right" style="margin-top: -30px">
                                <a href="merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number ?>&&page=<?php echo $page - 1;?>" class="btn btn-success">PREVIOUS PAGE
                                
                                </a>
                            </div><?php 
                        }
                    }    ?>                      
                </div>
            </div>
        </div><?php
    } ?>
          
                 
</div>        
  <script>
    function confirmToDelete(){
        return confirm("Click Okay to Delete Merchant Details and Cancel to Stop");
    }
</script>

<script>
    function confirmToEdit(){
        return confirm("Click okay to Edit Merchant and Cancel to Stop");
    }
</script>    
<script>
    function confirmToPrint(){
        return confirm("Click okay to Print Merchant Details and Cancel to Stop");
    }
</script>       
<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
	//include("../footer.php");
?>