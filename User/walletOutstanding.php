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
      <span class="text-muted fw-light">Financial Report /</span> Wallet Outstanding
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
                    <th>Name</th>
                    <th>User Id</th>
                    <th>Income Wallet</th>
                    <th>Fund Wallet</th>
                    <!-- <th>Magic Wallet</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 0;
                  $queryWallet = mysqli_query($con, "SELECT name,user_id,wallet,fundWallet FROM meddolic_user_details WHERE member_id='$memberId'");
                  while ($valWallet = mysqli_fetch_assoc($queryWallet)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valWallet['name'] ?></td>
                      <td><?= $valWallet['user_id'] ?></td>
                      <td>$ <?= $valWallet['wallet'] ?></td>
                      <td>$ <?= $valWallet['fundWallet'] ?></td>
                      <!-- <td>$ <?= $valWallet['rollUpWallet'] ?></td> -->
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