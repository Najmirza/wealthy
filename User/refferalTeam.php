<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light"></span> Refferal Team
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
                    <th>UserId</th>
                    <th>Name</th>
                    <th>EmailId</th>
                    <th>Phone</th>
                    <th>Register Date</th>
                    <th>Active Status</th>
                    <th>Active Date</th>
                    <th>Total Purchase</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  function totalPurchase($con, $memberId)
                  {
                    $queryPurchase = mysqli_query($con, "SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE member_id='$memberId'");
                    $valPurchase = mysqli_fetch_array($queryPurchase);
                    if ($valPurchase[0] != "") {
                      return $valPurchase[0];
                    } else {
                      echo "0.00";
                    }
                  }
                  // function totalInvest($con,$memberId){
                  //   $queryInvest=mysqli_query($con,"SELECT SUM(investAmount) FROM meddolic_user_invest_income_summary WHERE memberId='$memberId'");
                  //   $valInvest=mysqli_fetch_array($queryInvest);
                  //   if($valInvest[0]!=""){
                  //     return $valInvest[0];
                  //   }else{
                  //     echo "0.00";
                  //   }
                  // }
                  $count = 0;
                  $queryDirect = mysqli_query($con, "SELECT member_id,user_id,name,email_id,phone,date_time,topup_flag,activation_date FROM meddolic_user_details WHERE sponser_id='$memberId' ORDER BY date_time ASC");
                  while ($valDirect = mysqli_fetch_assoc($queryDirect)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valDirect['user_id'] ?></td>
                      <td><?= $valDirect['name'] ?></td>
                      <td><?= $valDirect['email_id'] ?></td>
                      <td><?= $valDirect['phone'] ?></td>
                      <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valDirect['date_time'])); ?></td>
                      <td><?php if ($valDirect['topup_flag'] == 1) echo "<span class='badge badge-success'>Active</span>";
                          else echo "<span class='badge badge-danger'>In-Active</span>"; ?></td>
                      <td><?= $valDirect['activation_date'] ?></td>
                      <td><span class="badge badge-success">$  <?= totalPurchase($con, $valDirect['member_id']) ?></span></td>

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