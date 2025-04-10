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
      <span class="text-muted fw-light">Fund Manager /</span> Add Funds
    </h4>
    <div class="row">
      <div class="col-md-12">

        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <div class="card crd0">
                  <div class="card-body">
                    <form class="theme-form" method="post" action="fundRequestBack" enctype="multipart/form-data" onsubmit="return confirm('Are You Sure to Submit?')">
                      <div class="mb-3">
                        <label>UserId </label>
                        <input type="text" name="user_id" class="form-control" placeholder="e.g. john12345" readonly value="<?= $userId ?>">
                        <input type="hidden" name="loginMemberId" value="<?= $memberId ?>">
                      </div>
                      <div class="mb-3">
                        <label>Name</label>
                        <div class="mb-3">
                          <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" readonly value="<?= $userName ?>">

                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Fund Need ( In $  ) *</label>
                        <input type="number" name="requestFund" class="form-control" placeholder="e.g. Fund Need" required onkeypress="return onlynum(event)">
                      </div>
                      <div class="mb-3">
                        <label>Payment Mode *</label>
                        <select class="form-control" name="payment_id" required onchange="showAddressQR(this.value)">
                          <option value="" style="background: #00000052;"> Select One </option>
                          <?php $queryMode = mysqli_query($con, "SELECT * FROM meddolic_config_payment_details WHERE status=1 ORDER BY payment_id ASC");
                          while ($valMode = mysqli_fetch_assoc($queryMode)) { ?>
                            <option value="<?= $valMode['payment_id'] ?>"> <?= $valMode['paymentName'] ?> </option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label>Payment Slip *</label>
                        <input type='file' name="transactionImage" required class="form-control" accept=".jpg, .png, .gif, .jpeg, .PNG, .GIF, .JPG, .JPEG" />
                      </div>
                      <div class="mb-3">
                        <label>Transaction ID *</label>
                        <textarea type="text" class="form-control" required placeholder="Transaction Hash" name="paymentHash"></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Transaction Password *</label>
                        <input type="password" name="trnPassword" class="form-control" placeholder="e.g. Transaction Password" required="">
                      </div>
                      <div class="">
                        <button type="submit" name="fundRequest" class="btn btn-primary action-button float-left" value="Request Fund">Request Fund</button>
                        <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6" id="paymentDetails" style="display: none;"></div>
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
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Requested Amount</th>
                        <th>Request Date</th>

                        <th>Payment Mode</th>
                        <th>Transaction ID</th>
                        <th>Transaction Slip</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $queryFund = mysqli_query($con, "SELECT a.*,b.paymentName from meddolic_user_fund_request a, meddolic_config_payment_details b WHERE a.member_id='$memberId' AND a.payment_id=b.payment_id ORDER BY a.date_time DESC");
                      $count = 0;
                      while ($valFund = mysqli_fetch_array($queryFund)) {
                        $count++; ?>
                        <tr>
                          <td><?= $count; ?></td>
                          <td><?= $valFund['user_id']; ?></td>
                          <td><?= $valFund['name']; ?></td>
                          <td>$  <?= $valFund['requestFund'] ?></td>
                          <td><i class="fa fa-clock-o"></i> <?= $valFund['date_time']; ?></td>
                          <td><?= $valFund['paymentName'] ?></td>
                          <td><?= $valFund['paymentHash'] ?></td>
                          <td><img src="<?= $valFund['transactionImage'] ?>" height="150px" width="150px"></td>
                          <td><?php if ($valFund['status'] == 1) echo "Approved";
                              else if ($valFund['status'] == 2) echo "Rejected";
                              else if ($valFund['status'] == 0) echo "Pending"; ?></td>
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
        <script>
          function copyTronLink() {
            var copyText = document.getElementById("tronLink");
            copyText.select();
            document.execCommand("Copy");
            alert("Payment Details Copied Successfully!!!");
          }

          function showAddressQR(paymentId) {
            var showDiv = document.getElementById("paymentDetails");
            if (paymentId != "") {
              $.ajax({
                type: "POST",
                url: 'ajaxCalls/fetchPaymentDetails',
                data: {
                  paymentId: paymentId
                },
                cache: false,
                success: function(data) {
                  showDiv.style.display = "block";
                  if (data) {
                    $('#paymentDetails').html(data);
                  }
                }
              });
            } else {
              showDiv.style.display = "none";
            }
          }
        </script>