<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php  
    if($_GET){
        if($_GET['from_date']){
            $show_date=$_GET['from_date'];
            $cal_date = date("Y-m-d", strtotime($show_date));
        }   
        if($_GET['to_date']){
            $show_date1=$_GET['to_date'];
            $cal_date1 = date("Y-m-d", strtotime($show_date1));
        }
        if($_GET['actionType']){
            $actionType=$_GET['actionType'];
        }
    } else {
        $show_date=date("d-m-Y"); 
        $show_date1=date("d-m-Y");
        $cal_date=date("Y-m-d"); 
        $cal_date1=date("Y-m-d");
        $actionType=3;
    } ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Reward Archiever List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Member </li>
                        <li class="breadcrumb-item active">First Reward  Archiever List</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <form>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" name="from_date" id="from_date" placeholder="e.g. From Date" required value="<?= $show_date; ?>" readonly >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input name="to_date" id="to_date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="e.g. To Date" required="" value="<?= $show_date1; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <input class="btn btn-primary" type="submit" value="Search" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Activation History</h2>
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
                                        <th>Reward Archieve Date </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryActive=mysqli_query($con,"SELECT a.dateTime,a.rewardIncome,a.rewardId,b.user_id,b.name,c.rewardName  AS rewardName from meddolic_user_reward_income_summary a, meddolic_user_details b, meddolic_config_reward_income c WHERE CAST(a.dateTime AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id AND a.rewardId=c.rewardId  ".$query." AND a.rewardId=1 AND rewardStatus=1  order by a.dateTime DESC");
                                    while($valActive=mysqli_fetch_array($queryActive)){
                                      $count++;
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $valActive['user_id'] ?></td>
                                        <td><?= $valActive['name'] ?></td>
                                        <td><?= $valActive['rewardName'] ?></td>
                                        <td>$  <?= $valActive['rewardIncome']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:d", strtotime($valActive['dateTime']));?></td>
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
var d = document.getElementById("rewardList");
    d.className += " active";
</script>
</body>
</html> 