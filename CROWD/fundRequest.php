<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Fund Request Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Fund Manager </a></li>
                        <li class="breadcrumb-item active"> Fund Request Details</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Fund Request Details</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>UserId</th>
                                        <th>Requested Amount</th>
                                      
                                       
                                        <th>Payment Mode</th>
                                        <th>TransactionId</th>
                                        <th>Transaction Copy</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $queryFund=mysqli_query($con,"SELECT a.*,b.paymentName from meddolic_user_fund_request a, meddolic_config_payment_details b WHERE a.payment_id=b.payment_id ORDER BY a.date_time DESC");
                                    $count=0;
                                    while($valFund=mysqli_fetch_array($queryFund)){
                                    $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valFund['user_id']?></td>
                                     
                                        <td>$  <?= $valFund['requestFund'] ?></td>
                                      
                                        <td><?= $valFund['paymentName']?></td>
                                        <td><?= $valFund['paymentHash']?></td>
                                        <td><img src="<?=$valFund['transactionImage']?>" height="150px" width="150px" ></td>
                                        <td><?php if($valFund['status']==1) echo "Approved";
                                        else if($valFund['status']==2) echo "Rejected";
                                        else if($valFund['status']==0) echo "Pending";?></td>
                                        <td><a href="fundRequestDetails?RqsID=<?=$valFund['id']?>" class="btn btn-success"> More </a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("Fund");
    d.className += " active";
var d = document.getElementById("fundRequest");
    d.className += " active";
</script>
</body>
</html> 