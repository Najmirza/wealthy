<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"> Magical Blast Entry</h4>
         
<div class="container-fluid">
    <div class="row">
      <div class="card crd0">
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-5 w-p50" id="export-button">
              <thead>
                <tr>
                  <th>Sl. No</th>
                  <th>Status</th>
                  <th>Entry Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
$count = 0;
$queryReferral = mysqli_query($con, "SELECT memberId,entryDate,boardStatus FROM meddolic_user_board_entry_details WHERE memberId='$memberId'    ORDER BY entryDate ASC");
while ($valReferral = mysqli_fetch_assoc($queryReferral)) {
    $count++;
    $poolStatus = $valReferral['boardStatus'];
    $statusText = ($poolStatus == 0) ? "Paid" : "Pending";
    ?>
    <tr>
        <td><?= $count ?></td>
        <td><?= $statusText ?></td>
        <td><?= date("d-m-Y H:i:s", strtotime($valReferral['entryDate']))?></td>
    </tr>
    <?php
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>  
  </div>
  </div>
  <?php require_once('Include/Footer.php');?>
