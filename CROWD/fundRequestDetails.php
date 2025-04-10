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
<?php 
    $id=$_GET['RqsID'];
    $query="SELECT * from meddolic_user_fund_request where id='$id'";
    $result=mysqli_query($con,$query);
    $val1=mysqli_fetch_array($result);
    $name=$val1['name'];
    $userId=$val1['user_id'];
    $date_time=$val1['dateTime'];
    $member_id1=$val1['member_id'];
    $requestFund=$val1['requestFund'];
    $paymentRemark=$val1['paymentRemark'];
    $transactionImage=$val1['transactionImage'];
    $paymentHash=$val1['paymentHash']; ?>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Transaction Details</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="fundRequestAcceptBack"  enctype="multipart/form-data">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name -:</label>
                                            <input type="text" class="form-control" required="" id="name" name="name" placeholder=" Name" readonly value="<?=$name?>" >
                                            <input type="hidden" name="member_id" value="<?= $member_id1; ?>">
                                            <input type="hidden" name="login_member_id" value="<?= $member_id;?>">
                                            <input type="hidden" name="ResID" value="<?=$id?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User ID -:</label>
                                            <input type="text" class="form-control" class="form-control" name="user_id" readonly value="<?=$userId?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Request Amount -:</label>
                                            <input class="form-control" id="requestFund" value="<?= $requestFund ?>" name="requestFund" placeholder=" Request Amount" required >
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transaction ID -:</label>
                                            <input class="form-control" id="paymentHash" value="<?= $paymentHash; ?>" name="paymentHash" placeholder=" Transaction Hash" readonly >
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Request Date -:</label>
                                            <input class="form-control" id="date_time" value="<?= $date_time; ?>" name="date_time" placeholder=" Request Date" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transaction Slip. -:</label>
                                            <img src="<?=$transactionImage?>" height="260px" width="360px" />
                                        </div>
                                    </div>
                                </div>
                                <?php if($val1['status']==0){ ?>
                                <button type="submit" name="active" class="btn btn-success action-button float-left" value="Transfer Now" >Transfer Now</button>
                                <a href="fundRequestRejectBack?ResID=<?=$id?>" class="btn btn-danger waves-effect">Reject Request</a> 
                                <?php } ?>
                            </fieldset>
                        </form>
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