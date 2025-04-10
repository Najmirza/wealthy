<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4"> Direct Sponsors Income</h4>
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
                  <th>Magical Income</th>
                  <th>Date</th>
                  <!-- <th>Package Price</th> -->
                  <!-- <th>Direct Percent</th> -->
                  <!-- <th>Income From</th> -->
                </tr>
              </thead>
              <tbody>
              <?php 
               $count=0;
               $queryReferral=mysqli_query($con,"SELECT a.boardIncome,a.dateTime,b.user_id,b.name FROM meddolic_user_boosting_board_income a, meddolic_user_details b WHERE a.memberId=b.member_id AND a.memberId='$memberId' ORDER BY a.dateTime DESC");
               while($valReferral=mysqli_fetch_assoc($queryReferral)){
                   $count++; ?>
                <tr>
                  <td><?= $count?></td>
                  <td><?= $valReferral['user_id']?></td>
                  <td><?= $valReferral['name']?></td>
                  <td><span class="badge badge-success"><i class="fa-solid fa-dollar"></i> <?= $valReferral['boardIncome']?></span></td>
                  <td><i class="fa-regular fa-clock"></i> <?= date("d-m-Y H:i:s", strtotime($valReferral['dateTime']))?></td>
                  <!-- <td><span class="badge badge-success"><i class="fa-solid fa-usd"></i> <?= $valReferral['packagePrice']?></span></td> -->
                  <!-- <td><?= $valReferral['referralPercent']?> <i class="fa fa-percent"></i></td> -->
                  <!-- <td><?= $valReferral['childID'] . ' - ' . $valReferral['childName']?></td> -->
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
  <?php require_once('Include/Footer.php');?>
