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
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>  
    <li><a href="edit-merchant-details.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-pencil"></i> Edit <?php echo $merchant_name ?> Merchant</a></li>                      
    <li><a href="add-merchant.php"><i class="fa fa-plus"></i> Add Product Merchant</a></li>    
    <li><a href="merchant-product.php"><i class="fa fa-list"></i> View Merchants Products</a></li>
    <li class="active">Merchant Update Form</li>   
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
        <div class="col-md-12"> 
            <form action="update-merchant-details.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Merchant</strong> Update Form</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to update <?php echo $merchant_name ?> Details</p></h3>
	                </div>
	                <?php
			        if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
			            <div class="alert alert-info" align="center">
			                <button class="close" data-dismiss="alert">
			                    <i class="ace-icon fa fa-times"></i>
			                </button>
			             <?php include("../includes/feed-back.php"); ?>
			            </div><?php 
			        }  ?> 
	                <div class="panel-body form-group-separated"> 
                         <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">MERCHANT LOGO</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
                                     <input type="file" class="form-control file" name="image" placeholder="" />
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">MERCHANT NAME</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
                                    <input type="text" class="form-control" name="merchant_name" placeholder="Enter The Merchant Name " required minlength="5" value="<?php echo $merchant_name ?>" />
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">MERCHANT FULL NAME</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $admin['full_name'] ?>" placeholder="Enter The Merchant Full Name" required minlength="5" />
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">MERCHANT E-MAIL</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
                                    <input type="email" class="form-control" name="merchant_email" placeholder="Enter The Merchant E-Mail " required minlength="5" value="<?php echo $details['merchant_email'] ?>" readonly />
                                </div>                                            
                                <span class="help-block" style="color: green;">This is field is Readonly.</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">MERCHANT NUMBER</label>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
                                    <input type="text" class="form-control" placeholder="Please Enter The Manufacturer Name" required minlength="2" value="<?php echo $merchant_number ?>" readonly  />
                                </div>                                            
                                <span class="help-block" style="color: green;">This is field is Readonly.</span>
                            </div>
                        </div>
	                	<input type="hidden" name="merchant_number" value="<?php echo $merchant_number ?>">
                        <input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $admin['user_id'] ?>">
                        <input type="hidden" name="prev_name" value="<?php echo $merchant_name ?>">
                        <div class="panel-footer">                                 
                            <button class="btn btn-success pull-right" name="update_merchant">Update <?php echo $merchant_name ?> Merchant Details</button>
                        </div>
	                </div>
	            </div>
            </form>
        </div>
        
    </div>             
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