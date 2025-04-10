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
      <span class="text-muted fw-light">Fund Manager /</span> Income Wallet to Purchase Wallet
    </h4>
    <div class="row">
      <div class="col-md-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="card crd0">
                <div class="card-body">
                  <form class="theme-form" action="mainToFundProcess" method="post">
                    <div class="mb-3">
                      <label>User ID -:</label>
                      <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="e.g. xxxxxxxxxx" readonly value="<?= $userId ?>">
                      <input type="hidden" name="loginMemberId" value="<?= $memberId ?>">
                    </div>
                    <div class="mb-3">
                      <label>Name -: </label>
                      <input type="text" id="sponser_name" class="form-control" placeholder="e.g. John Doe" readonly value="<?= $userName ?>">
                    </div>
                    <div class="mb-3">
                      <label>Income Wallet -:</label>
                      <input type="text" id="current_wallet" name="incomeWallet" class="form-control" readonly="" value="<?= $incomeWallet ?>">
                    </div>
                    <div class="mb-3">
                      <label>Purchase Wallet -:</label>
                      <input type="text" id="current_wallet" name="fundWallet" class="form-control" readonly value="<?= $fundWallet ?>">
                    </div>
                    <div class="mb-3">
                      <label>Amount To Transfer -:</label>
                      <input type="number" id="amount" name="amount" class="form-control" placeholder="e.g. Transfer Amount" onkeypress="return onlynum(event)" required="">
                    </div>
                    <div class="mb-3">
                      <label>Transaction Password *</label>
                      <input type="password" name="trnPassword" class="form-control" placeholder="e.g. Transaction Password" required="">
                    </div>
                    <div class="">
                      <button class="btn btn-primary" data-bs-original-title="" title="Transfer" name="fundTransfer" value="Transfer">Transfer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card crd0">
              <div class="card-header">
                <h5>Main Wallet To Purchase Wallet History</h5>
              </div>
              <div class="card-body">
                <div class="dt-ext table-responsive">
                  <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>Transfer Amount</th>
                        <th>Transfer Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 0;
                      $queryTransfer = mysqli_query($con, "SELECT a.transferAmount,a.transferDate,a.incomeWallet,a.fundWallet,b.user_id,b.name FROM meddolic_user_income_wallet_transfer a, meddolic_user_details b WHERE a.memberId='$memberId' AND a.memberId=b.member_id ORDER BY a.transferDate DESC");
                      while ($valTransfer = mysqli_fetch_assoc($queryTransfer)) {
                        $count++; ?>
                        <tr>
                          <td><?= $count ?></td>
                          <td><?= $valTransfer['user_id'] ?></td>
                          <td><?= $valTransfer['name'] ?></td>
                          <td><span class="badge badge-danger"><i class="fa fa-dollar"></i> <?= $valTransfer['transferAmount'] ?> </span></td>
                          <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valTransfer['transferDate'])) ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table> 
                </div>
              </div>
            </div>
          </div>
        </div>

        <script src="assets/js/pages-pricing.js"></script>




        <?php require_once('Include/Footer.php'); ?>