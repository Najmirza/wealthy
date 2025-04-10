<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php  
    if($_GET){
        if($_GET['from_date']){
            $show_date=$_GET['from_date'];
            $cal_date = date("Y-m-d", strtotime($show_date));
        }   
        if($_GET['to_date']){
            $show_date1=$_GET['to_date'];
            $cal_date1 = date("Y-m-d", strtotime($show_date1));
        }
        if($_GET['actionType']){
            $actionType=$_GET['actionType'];
        }
    } else {
        $show_date=date("d-m-Y"); 
        $show_date1=date("d-m-Y");
        $cal_date=date("Y-m-d"); 
        $cal_date1=date("Y-m-d");
        $actionType=3;
    } ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Online Payment Status</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> User Manager </li>
                        <li class="breadcrumb-item active"> Online Payment Status</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <form>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="from_date" id="from_date" placeholder="e.g. From Date" required value="<?= $show_date; ?>" readonly >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input name="to_date" id="to_date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="e.g. To Date" required="" value="<?= $show_date1; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input class="btn btn-primary" type="submit" value="Search" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Online Payment Status</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserId</th>
                                        <th>Name</th>
                                        <th>Invest Amount</th>
                                        <th>Create Date</th>
                                        <th>OrderId</th>
                                        <th>Address</th>
                                        <th>Pay Currency</th>
                                        <th>Pay Amount</th>
                                        <th>Pay Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryInvest=mysqli_query($con,"SELECT a.packagePrice,a.addDate,a.orderId,a.priceAmount,a.payAmount,a.payCurrency,a.payAddress,a.paymentStatus,b.user_id,b.name FROM meddolic_user_invest_purchase_details a, meddolic_user_details b WHERE CAST(a.addDate AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id order by a.addDate DESC");
                                    while($valInvest=mysqli_fetch_assoc($queryInvest)){
                                        $paymentStatus=$valInvest['paymentStatus'];
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valInvest['user_id']?></td>
                                        <td><?= $valInvest['name']?></td>
                                        <td>$  <?= $valInvest['packagePrice']?></td>
                                        <td><?= date("d-m-Y H:i:s", strtotime($valInvest['addDate']))?></td>
                                        <td><?= $valInvest['orderId']?></td>
                                        <td><?= $valInvest['payAddress']?></td>
                                        <td><?= $valInvest['payCurrency']?></td>
                                        <td><?= $valInvest['payAmount']?> <?= $valInvest['payCurrency']?></td>
                                        <td><?php if($paymentStatus=="finished") echo "<span class='badge badge-success'>FINISHED</span>";else if($paymentStatus=="confirming") echo "<span class='badge badge-primary'>CONFIRMING</span>";else if($paymentStatus=="refunded") echo "<span class='badge badge-danger'>REFUNDED</span>";else if($paymentStatus=="failed") echo "<span class='badge badge-danger'>FAILED</span>";else if($paymentStatus=="partially_paid") echo "<span class='badge badge-warning'>PARTIAL PAID</span>";else if($paymentStatus=="sending") echo "<span class='badge badge-warning'>SENDING</span>";else if($paymentStatus=="confirmed") echo "<span class='badge badge-success'>CONFIRMED</span>";else if($paymentStatus=="waiting") echo "<span class='badge badge-primary'>WAITING</span>";else if($paymentStatus=="expired") echo "<span class='badge badge-danger'>EXPIRED</span>"?></td>
                                        <!-- <td><a href="investmentHistoryDetails?orderId=<?=$valInvest['orderId']?>" class="btn btn-success btn-sm">More</a></td> -->
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
var d = document.getElementById("Members");
    d.className += " active";
var d = document.getElementById("investmentHistory");
    d.className += " active";
</script>
</body>
</html> 