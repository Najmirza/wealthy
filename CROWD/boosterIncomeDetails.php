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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Staking Income Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Income </li>
                        <li class="breadcrumb-item active"> Staking Income Details</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Staking Income Details</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Released Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryDeal=mysqli_query($con,"SELECT a.*,b.user_id,b.name FROM meddolic_user_booster_income_details a, meddolic_user_details b WHERE a.summary_id='$_GET[summaryID]' AND a.member_id=b.member_id ORDER BY a.date_time desc");
                                    while($valDeal=mysqli_fetch_assoc($queryDeal)){
                                      $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valDeal['user_id']?></td>
                                        <td><?= $valDeal['name']?></td>
                                        <td>$  <?= $valDeal['boosterAmount']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $valDeal['date_time']?></td>
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
var d = document.getElementById("boosterIncome");
    d.className += " active";
</script>
</body>
</html> 