<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Fund  /</span> Fund Received History
</h4>

<div class="container-fluid">
    <div class="row">
      <div class="card crd0">
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
              <thead>
              <tr>
                  <th>#</th>
                  <th>ReceiverId</th>
                  <th>Receiver Name</th>
                  <th>SenderId</th>
                  <th>Sender Name</th>
                  <th>Received Amount</th>
                  <th>Charge</th>
                  <th>Net Amount</th>
                  <th>Received Date</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $count=0;
                $queryTransfer=mysqli_query($con,"SELECT a.amount,a.charge,a.netAmount,a.date_time,b.user_id AS senderId,b.name AS senderName,c.user_id AS receiverId,c.name AS receiverName FROM meddolic_user_fund_transfer_history a, meddolic_user_details b, meddolic_user_details c WHERE a.receiver_member_id='$memberId' AND a.sender_member_id=b.member_id AND a.receiver_member_id=c.member_id ORDER BY a.date_time DESC");
                while($valTransfer=mysqli_fetch_assoc($queryTransfer)){
                  $count++; ?>
                <tr>
                  <td><?= $count ?></td>
                  <td><?=$valTransfer['receiverId']?></td>
                  <td><?=$valTransfer['receiverName']?></td>
                  <td><?=$valTransfer['senderId']?></td>
                  <td><?=$valTransfer['senderName']?></td>
                  <td><span class="badge badge-success"><i class="fa fa-dollar"></i> <?= $valTransfer['amount']?></span></td>
                  <td><span class="badge badge-success"><i class="fa fa-dollar"></i> <?= $valTransfer['charge']?></span></td>
                  <td><span class="badge badge-success"><i class="fa fa-dollar"></i> <?= $valTransfer['netAmount']?></span></td>
                  <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valTransfer['date_time']))?></td>
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
          
<?php require_once('Include/Footer.php');?>
