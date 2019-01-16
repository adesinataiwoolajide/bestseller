<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
?>
<ul class="breadcrumb">
   <ul class="breadcrumb">
        <li><a href="./">Home</a></li>                    
        <li><a href="view-all-memo.php ">View All Memo</a></li> 
        <li><a href="add-memo.php">Add Memo</a></li> 
        <li class="active">View All Memo</li>   
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
                    <h3 class="panel-title" style="color: green;">List of School Memo</h3>
                    <?php include("../table-modal.php"); ?>
                </div>
                <div class="panel-body"><?php
                    $book = $db->prepare("SELECT * FROM school_memo ORDER BY memo_id DESC"); 
                    $book->execute(); 
                    if($book->rowCount()==0){ ?>
                        <p style="color: red;" align="center"><h3 align="center">The School Memo List is Empty, Please Click on Add Memo to Add Memo to The Memo List. </h3></p><?php
                    }else{ ?>
                        <table id="customers2" class="table datatable">
                            
                            <thead align="center">
                                <tr>
                                    <th>S/N</th>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Sender</th>
                                    <th>Reciever(s)</th>
                                    <th>Category</th>
                                    <th>Time Written</th>
                                    <th>Operation</th> 
                                </tr>
                            </thead>
                            <tfoot align="center">
                                <tr>
                                    <th>S/N</th>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Sender</th>
                                    <th>Reciever(s)</th>
                                    <th>Category</th>
                                    <th>Time Written</th>
                                    <th>Operation</th> 
                                </tr>
                            </tfoot>

                            <tbody><?php
                                $y =1;
                                while($row = $book->fetch()){ 
                                    $memo_id = $row['memo_id']; ?>
                                    <tr>
                                        <td><?php echo $y; ?></td>
                                        <td><?php echo strtoupper($subject = $row['subject']); ?></td>
                                        <td><?php  $cont = $row['memo_content']; echo substr($cont, 0,30). "...." ; ?></td>
                                        <td><?php echo $row['memo_sender'] ?></td>
                                        <td><?php  $rev= $row['memo_reciever']; echo substr($rev, 0,30). "...." ?></td>
                                        <td><?php echo $cate = $row['memo_category'] ?></td>
                                        <td><?php echo $row['time_written']; ?></td>
                                        <td>
                                            <a href="memo-details.php?memo_subject=<?php echo $subject?>&&category=<?php echo $cate?>&&memo_identification=<?php echo $memo_id ?>" class="btn btn-primary" onclick=""><i class="glyphicon glyphicon-user"></i>View Memo Details
                                            </a><br>
                                            <a href="edit-school-memo.php?memo_subject=<?php echo $subject?>&&category=<?php echo $cate?>&&memo_identification=<?php echo $memo_id ?>" class="btn btn-success" onclick="return(confirmToEdit());"><i class="glyphicon glyphicon-pencil"></i>Edit
                                            </a>
                                            <a href="delete-school-memo.php?memo_subject=<?php echo $subject?>&&category=<?php echo $cate?>&&memo_identification=<?php echo $memo_id ?>" class="btn btn-danger" onclick="return(confirmToDelete());"><i class="glyphicon glyphicon-trash"></i>Delete
                                            </a>
                                        </td>
                                    </tr><?php
                                    $y++;
                                } ?> 
                            </tbody>
                        </table><?php
                    
                    } ?>    
                </div>
            </div>
        </div>
    </div>        
</div>  
<script>
    function confirmToDelete(){
        return confirm("Click Okay to Delete Memo Details and Cancel to Stop");
    }
</script>

<script>
    function confirmToEdit(){
        return confirm("Click okay to Edit Memo and Cancel to Stop");
    }
</script>      

<?php
    include("../log-out-modal.php");
	include("../table-footer.php");
?>
