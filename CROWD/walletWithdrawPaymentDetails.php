<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php
if(isset($_POST["remark"]) && $_POST["remark"]!="") {
$d=date("Y-m-d");
$todayD=date('Y-m-d H:i:s');
$userCount = count($_POST["hid"]);
for($i=0;$i<$userCount;$i++){
    $query=mysqli_query($con,"UPDATE meddolic_user_wallet_withdrawal SET remarks='".$_POST["remark"]."', released='".$_POST["status"]."',release_date='$todayD' WHERE id='".$_POST["hid"][$i]."'");
} if($query){ ?>
    <script>
        alert("Payment Remark Updated Successfully");
        window.top.location.href='walletWithdrawHistory';

    </script>
    <?php } } ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Payment Remark</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Withdraw </li>
                        <li class="breadcrumb-item active"> Payment Remark</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Payment Remark</h2>
                    </div>
                    <div class="body">
                        <form action="walletWithdrawPaymentDetails" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">Payment Status</label>
                                            <select name="status" class="form-control" required="">
                                                <option value=""> -Select Paymet Status- </option>
                                                <option value="2"> Released </option>
                                                <option value="3"> Not-Released </option>
                                                <option value="4"> Processing </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Remarks *</label>
                                            <input type="text" name="remark" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="header">
                                    <h2>User Details</h2>
                                </div>
                                <div class="row">
                                <?php
                                    $rowCount = count($_POST["payout_id"]);
                                    for($i=0;$i<$rowCount;$i++) {
                                    $result = mysqli_query($con,"SELECT * FROM meddolic_user_wallet_withdrawal WHERE id='" . $_POST["payout_id"][$i] . "'");
                                    $row[$i]= mysqli_fetch_assoc($result);
                                    $result_in = mysqli_query($con,"SELECT * FROM meddolic_user_details WHERE member_id='" . $row[$i]['member_id'] . "'");
                                    $row_in[$i]= mysqli_fetch_array($result_in); 
                                ?> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">User Id ( Name ) *</label>
                                            <input type="hidden" name="hid[]" value="<?= $row[$i]['id'];?>">
                                            <p class="form-control"><?= $row_in[$i]['user_id']; ?>( <?= $row_in[$i]['name']; ?> )</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Amount To Pay *</label>
                                            <input type="text" class="form-control" value="<?= $row[$i]['netAmount']; ?>" readonly name="payAmount" >
                                            <input type="hidden" name="user_id" value="<?= $row_in[$i]['user_id']?>">
                                            <input type="hidden" name="phone" value="<?= $row_in[$i]['phone']?>">
                                            <input type="hidden" name="member_id" value="<?= $row_in[$i]['member_id']?>">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <button type="submit" name="add_remark" class="btn btn-primary action-button float-left" value="Update Now" >Update Now</button>
                                <a href="walletWithdrawHistory"  class="btn btn-danger">Back</a>
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
var d = document.getElementById("Withdraw");
    d.className += " active";
var d = document.getElementById("walletWithdrawHistory");
    d.className += " active";
</script>
</body>
</html> 