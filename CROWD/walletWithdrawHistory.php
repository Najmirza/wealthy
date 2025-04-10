<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php  
    $user_id1="";
    if($_GET){
      if($_GET['user_id']){
        $user_id1=$_GET['user_id'];
        $query="select count(*) from meddolic_user_details where user_id='$user_id1'";
        $result=mysqli_query($con,$query);
        $val=mysqli_fetch_array($result);
        if($val[0]==0) { ?>
          <script>
            alert("Invalid User Id");
            </script>
          <?php
          $user_id1=$_SESSION['admin_user_id'];    
        }
      }
      if($_GET['from_date']){
        $show_date=$_GET['from_date'];
        $cal_date = date("Y-m-d", strtotime($show_date));
      }   
      if($_GET['to_date'] ){
        $show_date1=$_GET['to_date'];
        $cal_date1 = date("Y-m-d", strtotime($show_date1));
      }
      if($_GET['userType']){
        $userType=$_GET['userType'];
      }
    } else{
      $show_date=date("d-m-Y"); 
      $show_date1=date("d-m-Y");
      $cal_date=date("Y-m-d"); 
      $cal_date1=date("Y-m-d");
    }
?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Wallet Withdraw History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Withdraw </li>
                        <li class="breadcrumb-item active"> Wallet Withdraw History</li>
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
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?= $user_id1?>" >
                                        <div class="input-group-append">                      
                                            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-user"></i></button>
                                        </div>
                                    </div>
                                </div>
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
                        <h2>Wallet Withdraw History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserId</th>
                                        <th>Name </th>
                                        <th>Date</th>
                                        <th>Gross Amount</th>
                                        <th>Charge </th>
                                        <th>Net Amount </th>
                                        <th>OrderId</th>
                                        <th>Currency Type</th>
                                        <th>Wallet Address</th>
                                        <th>Withdraw Status</th>
                                        <th>Remark</th>
                                        <th>Action Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $query_in="SELECT member_id from meddolic_user_details where user_id='$user_id1'";
                                $result=mysqli_query($con,$query_in);
                                $val1=mysqli_fetch_array($result);
                                $member_id1=$val1[0];

                                $query="";
                                if($user_id1!="") {
                                $query= $query." AND a.member_id='$member_id1'";  
                                }
                                $count=0;
                                $queryWithdraw=mysqli_query($con,"SELECT a.*,b.name,b.user_id,c.walletAddress,d.currencyName from meddolic_user_wallet_withdrawal_crypto a, meddolic_user_details b, meddolic_user_wallet_address_details c, meddolic_config_currency_list d WHERE CAST(a.date_time AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.paymentId=c.payment_id AND c.currency_id=d.currency_id AND a.member_id=b.member_id AND a.withdrawType=1 ".$query." order by a.date_time desc");
                                while($valWithdraw=mysqli_fetch_array($queryWithdraw)){
                                  $count++; ?>
                                <tr>
                                    <td><?= $count?></td>
                                    <td><?= $valWithdraw['user_id']?></td>
                                    <td><?= $valWithdraw['name']?></td>
                                    <td class="text-left"><?= $valWithdraw['date_time']?></td>
                                    <td class="text-danger font-weight-bold">$  <?= $valWithdraw['amount']?></td>
                                    <td class="text-primary font-weight-bold">$  <?= $valWithdraw['withdrawCharge']?></td>
                                    <td class="text-success font-weight-bold">$  <?= $valWithdraw['netAmount']?></td>
                                    <td><?=$valWithdraw['orderid']?></td>
                                    <td><?=$valWithdraw['currencyName']?></td>
                                    <td><?=$valWithdraw['walletAddress']?></td>
                                    <td><?php if($valWithdraw['released']==0) echo "Processing"; else if($valWithdraw['released']==1) echo "Released"; else if($valWithdraw['released']==2) echo "Rejected"; ?></td>
                                    <td><?= $valWithdraw['remarks'] ?></td>
                                    <td><?= $valWithdraw['payment_date']?></td>
                                    <td><?php if($valWithdraw['released']==0) { ?><a data-id="<?= $valWithdraw['id']?>" data-toggle="modal" data-target="#cryptoRemark" data-whatever="<?= $valWithdraw['id']?>" href="javascript:void(0)" class="btn btn-primary btn-xs" > Add </a><?php } ?></td>
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
<div class="modal fade" id="cryptoRemark" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="cryptoRemarkDash">
             <!-- Content goes in here -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include('include/footer.php'); ?>
<script>
$('#cryptoRemark').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this);
  var id = recipient;
  $.ajax({
    type: "POST",
    url: "ajaxCalls/cryptoRemarkAjax",
    data: { id: id },
    cache: false,
    success: function (data) {
      console.log(data);
      modal.find('.cryptoRemarkDash').html(data);
    },
    error: function(err) {
      console.log(err);
    }
  });  
}) 
var d = document.getElementById("Withdraw");
    d.className += " active";
var d = document.getElementById("walletWithdrawHistory");
    d.className += " active";
</script>
</body>
</html> 