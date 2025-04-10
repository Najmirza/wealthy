<?php 
  require_once("loginCheck.php");
    require_once('Include/Head.php');
    require_once('Include/Header.php');
    require_once('Include/Menu.php');?>




      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<h4 class="fw-bold py-3 mb-4"> Upgrade Income</h4>
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
                  <th>Level</th>
                  <th>Level Income</th>
                  <th>Date</th>
                  <th>Package Price</th>
                  <th>Level Percent</th>
                  <th>Income From</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               $count=0;
               $queryLevel=mysqli_query($con,"SELECT a.dateTime,a.levelIncome,a.level,a.packagePrice,a.levelPercent,b.user_id,c.user_id AS childID FROM meddolic_user_level_income a, meddolic_user_details b, meddolic_user_details c WHERE a.memberId=b.member_id AND a.childId=c.member_id AND a.memberId='$memberId' ORDER BY a.dateTime DESC");
               while($valLevel=mysqli_fetch_assoc($queryLevel)){
                   $count++; ?>
                <tr>
                  <td><?= $count?></td>
                  <td><?= $valLevel['user_id']?></td>
                  <td>Level <?= $valLevel['level']?></td>
                  <td><span class="badge badge-success"><i class="fa-solid fa-usd"></i> <?= $valLevel['levelIncome']?></span></td>
                  <td><i class="fa-regular fa-clock"></i> <?= date("d-m-Y H:i:s", strtotime($valLevel['dateTime']))?></td>
                  <td><span class="badge badge-success"><i class="fa-solid fa-usd"></i> <?= $valLevel['packagePrice']?></span></td>
                  <td><?= $valLevel['levelPercent']?> <i class="fa fa-percent"></i></td>
                  <td><?= $valLevel['childID']?></td>
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
