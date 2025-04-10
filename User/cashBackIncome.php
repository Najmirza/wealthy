<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">ROI Income</h4>

    <div class="container">
      <div class="row">
        <div class="card crd0">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>UserId</th>
                    <th>Name</th>
                    <th>Invest Amount</th>
                    <th>Invest Date</th>
                    <th>Roi Get</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  function roiReceived($con, $memberId, $summaryId)
                  {
                    $querySum = mysqli_query($con, "SELECT SUM(roiAmount) FROM meddolic_user_invest_income_details WHERE memberId='$memberId' AND primaryId='$summaryId' AND releaseStatus=1 ");
                    $valSum = mysqli_fetch_array($querySum);
                    $queryLev = mysqli_query($con, "SELECT SUM(levelIncome) FROM meddolic_user_invest_level_income WHERE memberId='$memberId' AND primaryId='$summaryId' AND releaseStatus=1 ");
                    $valLev = mysqli_fetch_array($queryLev);
                    $totalGet = $valLev[0] + $valSum[0];
                    if ($totalGet != '') {
                      echo "<span class='badge badge-success'><i class='fa fa-usd'></i> " . $totalGet . "</span>";
                    } else {
                      echo "<span class='badge badge-danger'><i class='fa fa-usd'></i> 0.00</span>";
                    }
                  }
                  $count = 0;
                  $queryInvest = mysqli_query($con, "SELECT a.summary_id,a.member_id,a.packagePrice,a.date_Time,a.status,b.user_id,b.name FROM meddolic_user_cashback_income_summary a, meddolic_user_details b WHERE a.member_id='$memberId' AND a.member_id=b.member_id ORDER BY a.date_Time DESC");
                  while ($valInvest = mysqli_fetch_assoc($queryInvest)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valInvest['user_id'] ?></td>
                      <td><?= $valInvest['name'] ?></td>
                      <td><span class="badge badge-success">$  <?= $valInvest['packagePrice'] ?></span></td>
                      <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valInvest['date_Time'])); ?></td>
                      <td><?= roiReceived($con, $memberId, $valInvest['summary_id']) ?></td>
                      <td><?php if ($valInvest['status'] == 1) echo "<span class='badge badge-primary'>RUNNING</span>";
                          else if ($valInvest['status'] == 0) echo "<span class='badge badge-success'>COMPLETED</span>";
                          else if ($valInvest['status'] == 2) echo "<span class='badge badge-success'>COMPLETED</span>"; ?></td>
                      <td><a href="cashBackIncomeDetails?summary_id=<?= $valInvest['summary_id'] ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> More </a></td>
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