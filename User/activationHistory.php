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
      <span class="text-muted fw-light"> Purchase History </span>
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
                    <th>Active Amount</th>
                    <th>Purchase Date</th>
                    <th>Purchase By</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = 0;
                  $queryActive = mysqli_query($con, "SELECT a.investPrice ,a.date_time,b.user_id,b.name,c.user_id AS activerId,c.name AS activerName from meddolic_user_activation_details a, meddolic_user_details b, meddolic_user_details c WHERE (a.activate_by='$memberId' OR a.member_id='$memberId') AND a.member_id=b.member_id AND a.activate_by=c.member_id  ORDER BY a.date_time DESC");
                  while ($valActive = mysqli_fetch_assoc($queryActive)) {
                    $count++; ?>
                    <tr>
                      <td><?= $count ?></td>
                      <td><?= $valActive['user_id'] ?></td>
                      <td><?= $valActive['name'] ?></td>
                      <td><span class='badge badge-success'><i class="fa-solid fa fa-dollar"></i> <?= $valActive['investPrice'] ?> </span></td>
                      <td><i class="fa-regular fa-clock"></i> <?= date("d-m-Y H:i:s", strtotime($valActive['date_time'])); ?> </td>
                      <td><?= $valActive['activerName'] . " (User ID:" . $valActive['activerId'] . ")"; ?></td>
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
<script>
  var d = document.getElementById("User");
  d.className += " active";
  var d = document.getElementById("activationHistory");
  d.className += " active";
</script>