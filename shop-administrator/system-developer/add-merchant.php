<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>                    
    <li><a href="add-merchant.php"><i class="fa fa-plus"></i> Add Product Merchant</a></li>    
    <li><a href="merchant-product.php"><i class="fa fa-list"></i> View Merchants Products</a></li>
    <li class="active">Merchant Form</li>   
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
            <form action="process-add-product-merchant.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Add A </strong> New Products Merchant</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to add a new product merchant</p></h3>
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
	                	<
	                	<div class="form-group col-md-12">
	                		
	                        <div class="col-md-4 col-xs-4">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-image"></span></span>
	                                <input type="file" class="form-control file" name="image" placeholder="" required />
	                            </div>                                           
	                                                                   
	                            <span class="help-block" style="color: red;">Merchant Logo.</span>
	                        </div>
	                        
	                        <div class="col-md-4 col-xs-4">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
	                                <input type="text" class="form-control" name="merchant_name" placeholder="Enter The Merchant Name " required minlength="5" />
	                            </div>                                           
	                                                                   
	                            <span class="help-block" style="color: red;">Merchant Name.</span>
	                        </div>
	                        
	                        <div class="col-md-4 col-xs-4">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
	                                <input type="email" class="form-control" name="merchant_email" placeholder="Enter The Merchant E-Mail " required minlength="5" />
	                            </div>                                           
	                                                                   
	                            <span class="help-block" style="color: red;">Merchant E-Mail.</span>
	                        </div>
	                        
	                    </div>
	                
	                	<div class="col-md-8 col-xs-8" style="margin-top: 10px;">                                            
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-users"></span></span>
                                <input type="text" class="form-control" name="full_name" placeholder="Enter The Merchant Full Name" required minlength="5" />
                            </div>                                           
                                                                   
                            <span class="help-block" style="color: red;">Merchant FUll Name.</span>
                        </div>
                        <div class="col-md-4 col-xs-8" style="margin-top: 10px;">                                         
                            <button class="btn btn-success pull-right" name="adding-merchant">ADD A NEW PRODUCT MERCHANT</button>
                        </div>
	                	                            
	                    
	                </div>
	            </div>
            </form>
        </div>
        <div class="col-md-12"> 
        	<div class="panel panel-default"><?php

                $detail = $db->prepare("SELECT * FROM merchant ORDER BY merchant_name ASC"); 
                $detail->execute(); 
                if($detail->rowCount()==0){ ?>
                    <h3 align="center"><p style="color: red;" align="center">The Merchant List is Empty. </p></h3><?php
                }else{ ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">Merchant List </h3>
                        <?php include("../table-modal.php"); ?>
                    </div>
                    <div class="panel-body">
                        <table id="customers2" class="table datatable">
                            
                            <thead align="center">
                                <tr>
                          
                                    <th>S/N</th>
                                    <th>Merchant Name</th>
                                    <th>Merchant Logo</th> 
                                    <th>Merchant Number</th>
                                    <th>Merchant E-Mail</th>
                                    <th>Actions</th> 
                                </tr>
                            </thead>
                            <tfoot align="center">
                                <tr>
                          			<th>S/N</th>
                                    <th>Merchant Name</th>
                                    <th>Merchant Logo</th> 
                                    <th>Merchant Number</th>
                                    <th>Merchant E-Mail</th>
                                    <th>Actions</th> 
                                </tr>
                            </tfoot>

                            <tbody><?php
                                $y =1;
                                while($row = $detail->fetch()){ ?>
                                    <tr>
                                        
                                        <td><?php echo $y; ?></td>
                                        <td><?php echo $row['merchant_name']; ?></td>
                                        <td><img src="<?php echo '../../assets/images/merchant/'.$row['merchant_logo']; ?>"  style="width: 70px; height: 50px;"></td>
                                        <td><?php echo $merchant_number=$row['merchant_number']; ?></td>
                                        <td><?php echo $row['merchant_email']; ?></td>
                                        <td> 
                                        	<a href="merchant-details.php?merchant_number=<?php echo $merchant_number?>" class="btn btn-success"><i class="fa fa-cogs"></i></a>
                                            <a href="edit-merchant-details.php?merchant_number=<?php echo $merchant_number?>" class="btn btn-warning" onclick="return(confirmToEdit());"><i class="fa fa-pencil"></i></a>
                                            <a href="delete-merchant-details.php?merchant_number=<?php echo $merchant_number?>" class="btn btn-danger" onclick="return(confirmToDelete());"><i class="fa fa-trash-o"></i></a></td>
                                    </tr><?php
                                    $y++;
                                } ?> 
                            </tbody>
                        </table>
                    </div><?php
                        
                } ?>    
                
            </div>
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