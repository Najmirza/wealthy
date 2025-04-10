<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Reward Release </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> User Management </li>
                        <li class="breadcrumb-item active"> Reward  Release </li>
                    </ul>
                </div>            
            </div>
        </div>
       
        <div>
        <div>
    <button class="btn btn-primary" onclick="location.href='releaseRewardIncome';">Release</button>
</div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Release Reward History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Reward Name </th>
                                        <th>Reward Amount</th>
                                        <th>Reward Release Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryActive=mysqli_query($con,"SELECT a.releaseDate,a.rewardIncome,a.rewardId,b.user_id,b.name,c.rewardName  AS rewardName from meddolic_user_reward_income_details a, meddolic_user_details b, meddolic_config_reward_income c WHERE  a.memberId=b.member_id AND a.rewardId=c.rewardId ORDER BY a.releaseDate DESC");
                                    while($valActive=mysqli_fetch_array($queryActive)){
                                      $count++;
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $valActive['user_id'] ?></td>
                                        <td><?= $valActive['name'] ?></td>
                                        <td><?= $valActive['rewardName'] ?></td>
                                        <td>$  <?= $valActive['rewardIncome']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:d", strtotime($valActive['releaseDate']));?></td>
                                    </tr>
                                    <?php
                                    
                                    } ?>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("Members");
    d.className += " active";
var d = document.getElementById("rewardListThird");
    d.className += " active";
</script>
</body>
</html> 