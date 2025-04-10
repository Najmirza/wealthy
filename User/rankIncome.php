<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>




      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4"> Rank Income</h4>
<div class="container-fluid">
  <div class="row">
         
 
    <div class="row">
      <div class="card crd0">
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="export-button">
              <thead>
                <tr>
                <th>#</th>
                    <th>UserId</th>
                    <th>Reward Income</th>
                    <th>Release Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                 $count = 0;
                 $queryBoard = mysqli_query($con, "SELECT a.memberId, a.rewardIncome, a.releaseDate, a.rewardId, b.user_id, b.name, c.rewardName FROM meddolic_user_reward_income_details a, meddolic_user_details b, meddolic_config_reward_income c WHERE a.memberId=b.member_id AND a.memberId='$memberId' AND a.rewardId=c.rewardId ORDER BY a.releaseDate DESC");
                 
                 if ($queryBoard) {
                     while ($valBoard = mysqli_fetch_assoc($queryBoard)) {
                         $count++; ?>
                         <tr>
                             <td><?= $count ?></td>
                             <td><?= $valBoard['user_id'] ?></td>
                             <td><i class="fa-solid fa fa-dollar"> </i> <?= $valBoard['rewardIncome'] ?></td>
                             <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valBoard['releaseDate'])); ?></td>
                         </tr>
                 <?php 
                     }
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
