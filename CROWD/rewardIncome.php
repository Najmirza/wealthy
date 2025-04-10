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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Reward & Rank Income</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Income </li>
                        <li class="breadcrumb-item active"> Reward & Rank Income</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Reward & Rank Income</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserId</th>
                                        <th>Name</th> 
                                        <th>Reward Income</th>
                                        <th>Achieve Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $queryBonus=mysqli_query($con,"SELECT a.rewardIncome,a.dateTime,c.rewardId AS childName FROM meddolic_user_reward_income a, meddolic_user_details b, meddolic_config_reward_income c WHERE a.memberId=b.member_id AND a.rewardId=c.rewardId ORDER BY a.dateTime DESC");
                                    while($valBonus=mysqli_fetch_assoc($queryBonus)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valBonus['rewardId']?></td>
                                  
                                        <td>$  <?= $valBonus['rewardIncome']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:s", strtotime($valBonus['dateTime']));?></td>
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
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("Income");
    d.className += " active";
var d = document.getElementById("rewardIncome");
    d.className += " active";
</script>
</body>
</html> 