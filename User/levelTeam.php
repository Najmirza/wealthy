<?php
require_once ("loginCheck.php");
require_once ('Include/Head.php');
require_once ('Include/Header.php');
require_once ('Include/Menu.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
      <span class="fw-light"></span> Level Team
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
                    <th>Level Number.</th>
                    <th>Total Member</th>
                    <th>Active Member</th>
                    <th>Inactive Member</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($level = 1; $level <= 10; $level++) {
                    $queryMember = mysqli_query($con, "SELECT COUNT(1) AS total_members, SUM(CASE WHEN topup_status =1 THEN 1 ELSE 0 END) AS active_members,SUM(CASE WHEN topup_status = 0 THEN 1 ELSE 0 END) AS inactive_members FROM meddolic_user_child_ids WHERE member_id='$memberId' AND level='$level'");
                    $valMember = mysqli_fetch_assoc($queryMember);

                    ?>
                    <tr>
                      <td><?= $level ?></td>
                      <td>Level <?= $level; ?></td>
                      <td><i class="fa fa-users"></i>
                        <?= isset($valMember['total_members']) ? $valMember['total_members'] : '0'; ?></td>
                      <td><i class="fa fa-user"></i>
                        <?= isset($valMember['active_members']) ? $valMember['active_members'] : '0'; ?></td>
                      <td><i class="fa fa-user"></i>
                        <?= isset($valMember['inactive_members']) ? $valMember['inactive_members'] : '0'; ?></td>
                      <!-- <td><a href="levelTeamDetails?MemberID=<?= $memberId ?>&LevelId=<?= $level ?>" class="btn btn-primary">More</a></td> -->
                    </tr>
                  <?php } ?>
                </tbody>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <?php require_once ('Include/Footer.php'); ?>