<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->      
          <div class="container-xxl flex-grow-1 container-p-y">       
            
<h4 class="fw-bold py-3 mb-4">Fund Transfer</h4>
<div class="row">
  <div class="col-md-12">  
    <div class="page-body">  
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="card crd0">
          <div class="card-body">
            <form class="theme-form" action="fundTransferProcess" method="post">
              <div class="mb-3">
                <label>UserId </label>
                <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="e.g. xxxxxxxxxx" onblur="sponser_valid(this.value)" required >
                  <input type="hidden" name="loginMemberId" value="<?=$memberId?>">
              </div>
              <div class="mb-3">
                <label>Name</label>
                <div class="mb-3">
                <input type="text" id="sponser_name" class="form-control" placeholder="e.g. John Doe"  disabled="" >
              </div>
              </div>
              <div class="mb-3">
                <label> Purchase Wallet*</label>
                <input type="text" id="current_wallet" name="current_wallet" class="form-control" readonly value="<?=$fundWallet?>" >
              </div>
         
              <div class="mb-3">
              <label>Amount To Transfer *</label>
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="e.g. Transfer Amount" onkeypress="return onlynum(event)"  required >
              </div>
             
            
              <div class="mb-3">
                <label>Transaction Password *</label>
                <input type="password" name="trnPassword" class="form-control" placeholder="e.g. Transaction Password" required="">
              </div>
              <div class="">
              <button type="submit" name="fundTransfer" class="btn btn-primary action-button float-left" value="Submit" >Transfer Now</button>
                                <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="paymentDetails" style="display: none;"></div>
    </div>
  
  </div>
  <div class="container">
    <div class="row">
      <div class="card crd0">
        <div class="card-header">
          <h5>P2P Transfer Report</h5>
        </div>
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
              <thead>
                <tr>
                <th>#</th>
                  <th>SenderId</th>
                  <th>Sender Name</th>
                  <th>ReceiverId</th>
                  <th>Receiver Name</th>
                  <th>Transfer Amount</th>
                  <th>Transfer Date</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $count=0;
                  $queryTransfer=mysqli_query($con,"SELECT a.amount,a.date_time,b.user_id AS senderId,b.name AS senderName,c.user_id AS receiverId,c.name AS receiverName FROM meddolic_user_fund_transfer_history a, meddolic_user_details b, meddolic_user_details c WHERE a.sender_member_id='$memberId' AND a.sender_member_id=b.member_id AND a.receiver_member_id=c.member_id ORDER BY a.date_time DESC");
                  while($valTransfer=mysqli_fetch_assoc($queryTransfer)){
                    $count++; ?>
                <tr>
                  <td><?= $count ?></td>
                  <td><?=$valTransfer['senderId']?></td>
                  <td><?=$valTransfer['senderName']?></td>
                  <td><?=$valTransfer['receiverId']?></td>
                  <td><?=$valTransfer['receiverName']?></td>
                  <td><span class="badge badge-danger">$  <?= $valTransfer['amount']?></span></td>
                  <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valTransfer['date_time']));?></td>
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


      
<script src="assets/js/pages-pricing.js"></script>

            
       

          <?php require_once('Include/Footer.php');?>

          
          

