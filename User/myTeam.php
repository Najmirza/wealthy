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
      <span class="text-muted fw-light"></span> My Team
    </h4>

    <div class="page-body">

      <!-- Container-fluid starts-->
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
                      <th>User Name</th>
                      <th>Joining Date</th>
                      <th>Activation Date</th>
                      <th>Active/Inactive Status</th>
                      <th>Active Amount</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // function totalInvest($con,$memberId){
                    //   $queryInvest=mysqli_query($con,"SELECT SUM(investAmount) FROM meddolic_user_invest_income_summary WHERE memberId='$memberId'");
                    //   $valInvest=mysqli_fetch_array($queryInvest);
                    //   if($valInvest[0]!=""){
                    //     return $valInvest[0];
                    //   }else{
                    //     echo "0.00";
                    //   }
                    // }
                    function activeAmount($con, $memberId)
                    {
                      $queryInvest = mysqli_query($con, "SELECT investPrice FROM meddolic_user_activation_details WHERE member_id='$memberId' AND purchaseType=1");
                      $valInvest = mysqli_fetch_array($queryInvest);
                      if ($valInvest[0] != "") {
                        return $valInvest[0];
                      } else {
                        echo "0.00";
                      }
                    }
                    $count = 0;
                    $queryTeam = mysqli_query($con, "SELECT b.member_id,b.name,b.user_id,b.topup_flag,b.activation_date,b.account_status,b.sponser_id,b.date_time FROM meddolic_user_child_ids a, meddolic_user_details b WHERE a.member_id='$memberId' AND a.child_id=b.member_id order by b.date_time DESC");
                    while ($valTeam = mysqli_fetch_assoc($queryTeam)) {
                      $count++; ?>
                      <tr>
                        <td><?= $count ?></td>
                        <td><?= $valTeam['user_id'] ?></td>
                        <td><?= $valTeam['name'] ?></td>
                        <td><i class="fa-regular fa-clock"></i> <?= date("d-m-Y H:i:s", strtotime($valTeam['date_time'])); ?></td>
                        <td><?= $valTeam['activation_date'] ?></td>
                        <td><?php if ($valTeam['topup_flag'] == 1) echo "<span class='badge badge-success'>Active</span>";
                            else echo "<span class='badge badge-danger'>In-Active</span>"; ?></td>
                        <td><i class="fa-solid fa-dollar"></i> <?= activeAmount($con, $valTeam['member_id']) ?></td>

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
  </div>



  <?php require_once('Include/Footer.php'); ?>