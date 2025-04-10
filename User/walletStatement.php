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
  <span class="text-muted fw-light">Financial Report /</span> Wallet Statement
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
                    <th>User Id</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Income Type</th>
                    <th>Transaction Type</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $count=0;
                  $queryStatement=mysqli_query($con,"SELECT b.name,b.user_id,a.date_time,a.amount,a.deb_cr,c.statement_type,c.wallet_remark FROM meddolic_user_wallet_statement a, meddolic_user_details b, meddolic_config_wallet_statement_type c WHERE a.member_id=b.member_id AND a.wallet_statement_id=c.wallet_statement_id AND a.member_id='$memberId' ORDER BY a.date_time DESC");
                  while($valStatement=mysqli_fetch_assoc($queryStatement)){
                      $count++; ?>
                <tr>
                  <td><?= $count?></td>
                  <td><?= $valStatement['user_id']?></td>
                  <td><?php if($valStatement['deb_cr']==2) echo "<span class='badge badge-success'>$ $valStatement[amount] </span>"; else echo "<span class='badge badge-danger'>$ $valStatement[amount] </span>";?> </td>
                  <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valStatement['date_time']));?></td>
                  <td><?= $valStatement['statement_type']?></td>
                  <td><?php if($valStatement['deb_cr']==2) echo "<span class='badge badge-success'>Credit</span>"; else echo "<span class='badge badge-danger'>Debit</span>"; ?></td>
                  <td><?= $valStatement['wallet_remark'] ?>
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
