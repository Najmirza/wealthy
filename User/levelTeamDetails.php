<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <?php $levelId = $_GET['LevelId']; ?>
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light"></span> Level <?= $levelId ?> Team Details
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
                    <th>User Name</th>
                    <th>Email Id</th>
                    <th>Joining Date</th>
                    <th>Activation Date</th>
                    <th>Active/Inactive Status</th>
                    <th>Active Amount</th>
                    <!-- <th>Total Invest</th> -->
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
                  $queryTeam = mysqli_query($con, "SELECT a.member_id,a.user_id,a.name,a.email_id,a.phone,a.date_time,a.activation_date,a.topup_flag FROM meddolic_user_details a, meddolic_user_child_ids b WHERE b.member_id='$memberId' AND b.level='$levelId' AND a.member_id=b.child_id order by b.date_time DESC");
                  while ($valTeam = mysqli_fetch_assoc($queryTeam)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valTeam['user_id'] ?></td>
                      <td><?= $valTeam['name'] ?></td>
                      <td><?= $valTeam['email_id'] ?></td>
                      <td><i class="fa fa-clock-o"></i><?= date("d-m-Y H:i:s", strtotime($valTeam['date_time'])); ?></td>
                      <td><?php if ($valTeam['activation_date'] != "") { ?><?= date("d-m-Y H:i:s", strtotime($valTeam['activation_date']));
                                                                      } ?></td>
                      <td><?php if ($valTeam['topup_flag'] == 1) echo "<span class='badge badge-success'>Active</span>";
                          else echo "<span class='badge badge-danger'>In-Active</span>"; ?></td>
                      <td><span class="badge badge-success"><i class="fa-solid fa-dollar"></i> <?= activeAmount($con, $valTeam['member_id']) ?></span></td>

                    </tr>
                  <?php  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <?php require_once('Include/Footer.php'); ?>