<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">ROI Income Details
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
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Income Day</th>
                    <th>Release Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 0;
                  $queryDeal = mysqli_query($con, "SELECT a.incomeAmount,a.date_time,b.user_id,b.name FROM meddolic_user_cashback_income_details a, meddolic_user_details b WHERE a.summary_id='$_GET[summary_id]' AND a.member_id=b.member_id ORDER BY a.date_time ASC");
                  while ($valDeal = mysqli_fetch_assoc($queryDeal)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valDeal['user_id'] ?></td>
                      <td><?= $valDeal['name'] ?></td>
                      <td><span class="badge badge-success">$  <?= $valDeal['incomeAmount'] ?></span></td>
                      <td><?= $count ?> Day</td>
                      <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valDeal['date_time'])); ?></td>
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