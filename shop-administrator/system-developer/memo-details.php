<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    include("../..//libs_dev/school_memo/memo_class.php");
    $sch_memo = new schoolMemo($db);
    $subject = $_GET['memo_subject'];
    $memo_id = $_GET['memo_identification'];
    $category = $_GET['category'];
    $details =$sch_memo->gettingMemiID($memo_id);
?>
<ul class="breadcrumb">
   <ul class="breadcrumb">
        <li><a href="./">Home</a></li>
        <li><a href="memo-details.php?memo_subject=<?php echo $subject?>&&category=<?php echo $cate?>&&memo_identification=<?php echo $memo_id ?>">Preview School Memo</a></li>      
        <li><a href="edit-school-memo.php?memo_subject=<?php echo $subject?>&&category=<?php echo $category?>&&memo_identification=<?php echo $memo_id ?>">Edit School Memo</a></li>                          
        <li><a href="view-all-memo.php ">View All Memo</a></li> 
        <li><a href="add-memo.php">Add Memo</a></li> 
        <li class="active">Preview Memo Details</li>   
    </ul> 
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="color: green;">Preview  <?php echo $subject ?> Memo Details</h3>
                    <?php include("../table-modal.php"); ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="panel panel-default">
                                <table id="customers2" class="table datatable">
                                                                        
                                    <div class="panel-body">
                                        <table class="table table-responsive">
                                            
                                            <tbody>
                                                <tr>
                                                    <td>Memo Subject</td>
                                                    <td><?php echo $details['subject']; ?></td>
                                                </tr>
                                            </tbody>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>Memo Content</td>
                                                    <td><?php echo $details['memo_content'] ?></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>Memo Reciever(s)</td>
                                                    <td><?php echo $details['memo_reciever']; ?></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>Memo Category</td>
                                                    <td><?php echo $details['memo_category']; ?></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>Time Sent</td>
                                                    <td><?php
                                                        echo $details['time_written']; ?>
                                                       
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                            
                                        </table>                       
                                        <div class="panel-footer col-md-12">                                 
                                            <a href="edit-school-memo.php?memo_subject=<?php echo $subject?>&&category=<?php echo $category?>&&memo_identification=<?php echo $memo_id ?>" class="btn btn-success pull-right">EDIT MEMO DETAILS</a>
                                        </div>
                                    </div>
                                </table>                                    
                            </div>
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
