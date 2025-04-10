<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$queryConfig = mysqli_query($con, "SELECT minimumWithdraw,maximum_withdraw FROM meddolic_config_misc_setting");
$valConfig = mysqli_fetch_assoc($queryConfig);
$minimumPayout = $valConfig['minimumWithdraw'];
$maximum_withdraw = $valConfig['maximum_withdraw'];
unset($_SESSION['withdrawTokenSet']);
$randToken = rand(1111, 9999) . time() . date('s');
$newToken = md5($randToken);
$_SESSION['withdrawTokenSet'] = $newToken; ?>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Wallets /</span> Withdrawl
    </h4>

    <div class="row">
      <div class="col-md-12">

        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="card crd0">
                <div class="card-body">
                  <form class="theme-form" action="walletWithdrawProcess" method="post">
                    <div class="mb-3">
                      <label>UserId </label>
                      <input type="text" name="userId" id="userId" class="form-control" value="<?= $userId ?>" readonly>
                      <input type="hidden" name="memberId" value="<?= $memberId ?>" readonly>
                      <input type="hidden" name="goodFile" value="<?= $newToken ?>" readonly>
                    </div>
                    <div class="mb-3">
                      <label>Name </label>
                      <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" readonly value="<?= $userName ?>">
                    </div>
                    <div class="mb-3">
                      <label>Income Wallet </label>
                      <input type="text" id="incomeWallet" name="incomeWallet" class="form-control" readonly value="<?= $incomeWallet ?>">
                      <input type="hidden" name="minimumPayout" readonly value="<?= $minimumPayout ?>">
                      <!-- <input type="hidden" name="maximum_withdraw" readonly value="<?= $maximum_withdraw ?>"> -->
                    </div>
                    <div class="mb-3">
                      <label>Select wallet </label>
                      <select class="form-control" name="paymentId" required id="paymentId">
                        <option value="">Select Withdrawl In</option>
                        <?php $queryWallet = mysqli_query($con, "SELECT  a.payment_id,a.walletAddress,b.currencyName FROM meddolic_user_wallet_address_details a, meddolic_config_currency_list b WHERE a.member_id='$memberId'  AND a.currency_id=b.currency_id AND a.status=1 ORDER BY a.addDate DESC");
                        while ($valWallet = mysqli_fetch_assoc($queryWallet)) { ?>
                          <option value="<?= $valWallet['payment_id'] ?>"> <?= $valWallet['currencyName'] ?> [ <?= $valWallet['walletAddress'] ?> ] </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label>Withdraw Amount </label>
                      <input type="number" name="investmentAmount" id="investmentAmount" class="form-control" required placeholder="Enter Withdraw Amount">
                    </div>
                    <div class="mb-3">
                      <label>Transaction Password *</label>
                      <input type="password" name="trnPassword" class="form-control" placeholder="e.g. Transaction Password" required="">
                    </div>
                    <div class="">
                      <button class="btn btn-primary" data-bs-original-title="" title="Withdraw" name="walletWithdraw" value="Withdraw">Withdraw</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="card crd0">
              <div class="card-header">
                <h5>Withdraw Report</h5>
              </div>
              <div class="card-body">
                <div class="dt-ext table-responsive">
                  <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
                    <thead>
                    <tr>
                  <th>#</th>
                  <th>UserId</th>
                  <th>Name </th>
                  <th>Withdraw Amount</th>
                  <th>Charge</th>
                  <th>Net Amount</th>
                  <th>OrderId</th>
                  <th>Currency</th>
                  <th>Wallet Address</th>
                  <th>Date</th>
                  <th>Withdraw Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                $queryWithdraw = mysqli_query($con, "SELECT DISTINCT a.*,b.user_id,b.name,c.walletAddress,d.currencyName FROM meddolic_user_wallet_withdrawal_crypto a, meddolic_user_details b, meddolic_user_wallet_address_details c, meddolic_config_currency_list d WHERE a.member_id='$memberId' AND b.member_id = c.member_id AND a.member_id=b.member_id  AND c.currency_id=d.currency_id AND  a.paymentId=c.payment_id AND c.status=1 ORDER BY a.date_time DESC");
                while ($valWithdraw = mysqli_fetch_assoc($queryWithdraw)) {
                  $count++; ?>
                  <tr>
                    <td><?= $count ?></td>
                    <td><?= $valWithdraw['user_id'] ?></td>
                    <td><?= $valWithdraw['name'] ?></td>
                    <td><span class='badge badge-danger'><i class="fa fa-dollar"></i> <?= $valWithdraw['amount'] ?></span></td>
                    <td><span class='badge badge-danger'><i class="fa fa-dollar"></i> <?= $valWithdraw['withdrawCharge'] ?></span></td>
                    <td><span class='badge badge-success'><i class="fa fa-dollar"></i> <?= $valWithdraw['netAmount'] ?></span></td>
                    <td><?= $valWithdraw['orderid'] ?></td>
                    <td><?= $valWithdraw['currencyName'] ?></td>
                    <td><?= $valWithdraw['walletAddress'] ?></td>
                    <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valWithdraw['date_time'])) ?></td>
                    <td><?php if ($valWithdraw['released'] == 0) echo "<span class='badge badge-primary'>PENDING</span>";
                        else if ($valWithdraw['released'] == 1) echo "<span class='badge badge-success'>RELEASED</span>";
                        else if ($valWithdraw['released'] == 2) echo "<span class='badge badge-danger'>PROCESSING</span>";
                        else if ($valWithdraw['released'] == 3) echo "<span class='badge badge-danger'>REJECTED</span>";
                        else if ($valWithdraw['released'] == 4) echo "<span class='badge badge-warning'>NOT RELEASED</span>"; ?></td>
                  </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php require_once('Include/Footer.php'); ?>