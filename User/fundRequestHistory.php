<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Fund /</span> Fund Request History
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
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Requested Amount</th>
                    <th>Request Date</th>
                    <th>Payment Date</th>
                    <th>Payment Mode</th>
                    <th>Transaction ID</th>
                    <th>Transaction Slip</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 0;
                  $queryRequest = mysqli_query($con, "SELECT a.*,b.paymentName from meddolic_user_fund_request a, meddolic_config_payment_details b where a.member_id='$member_id' AND a.payment_id=b.payment_id order by date_time desc");
                  while ($valRequest = mysqli_fetch_array($queryRequest)) {
                    $count++;
                  ?>
                    <tr>
                      <td><?= $count; ?></td>
                      <td><?= $valRequest['user_id']; ?></td>
                      <td><?= $valRequest['name']; ?></td>
                      <td>$  <?= $valRequest['requestFund'] ?></td>
                      <td><i class="fa fa-clock-o"></i> <?= $valRequest['date_time']; ?></td>
                      <td><i class="fa fa-clock-o"></i> <?= $valRequest['paymentDate']; ?></td>
                      <td><?= $valRequest['paymentName']; ?></td>
                      <td><?= $valRequest['paymentHash']; ?></td>
                      <td><img src="<?= $valRequest['transactionImage'] ?>" height="150px" width="150px"></td>
                      <td><?php if ($valRequest['status'] == 1) echo "Approved";
                          else if ($valRequest['status'] == 2) echo "Rejected";
                          else if ($valRequest['status'] == 0) echo "Pending"; ?></td>
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



  <?php require_once('Include/Footer.php'); ?>