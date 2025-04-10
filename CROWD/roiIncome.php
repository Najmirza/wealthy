<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
    <?php 
    date_default_timezone_set("Asia/Kolkata"); 
    $user_id1="";
    if($_GET){
      if($_GET['user_id']){
        $user_id1=$_GET['user_id'];
        $query="SELECT count(*) from meddolic_user_details where user_id='$user_id1'";
        $result=mysqli_query($con,$query);
        $val=mysqli_fetch_array($result);
        if($val[0]==0) { ?>
          <script>
            alert("Invalid User Id");
            </script>
          <?php
          $user_id1=$_SESSION['admin_user_id'];    
        }
      }
      if($_GET['from_date']){
          $show_date=$_GET['from_date'];
          $cal_date = date("Y-m-d", strtotime($show_date));
      }   
      if($_GET['to_date']){
        $show_date1=$_GET['to_date'];
        $cal_date1 = date("Y-m-d", strtotime($show_date1));
      }   
    } else{
      $show_date=date("d-m-Y"); 
      $show_date1=date("d-m-Y");
      $cal_date=date("Y-m-d"); 
      $cal_date1=date("Y-m-d");
    }
?>  
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Reward & Rank Income</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Income </li>
                        <li class="breadcrumb-item active">Roi Income</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Roi Income</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Daily Percent</th>
                                        <th>Release Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    function releaseAmount($con,$summary_id){
                                        $query=mysqli_query($con,"SELECT sum(incomeAmount) from meddolic_user_cashback_income_details WHERE summary_id='$summary_id' AND status=1");
                                        $val1=mysqli_fetch_array($query);
                                        $total=$val1[0];
                                        if($total!=""){
                                          echo $total;
                                        }else{
                                          echo "0.00";
                                        }
                                    }

                                    $query="SELECT member_id FROM meddolic_user_details where user_id='$user_id1'";
                                    $result=mysqli_query($con,$query);
                                    $val1=mysqli_fetch_array($result);
                                    $member_id1=$val1[0];

                                    $query="";
                                    if($user_id1!=""){
                                       $query= $query." AND a.member_id='$member_id1'";  
                                    }
                                    $count=0;
                                    $queryCashback=mysqli_query($con,"SELECT  a.summary_id,a.member_id,a.incomeAmount,a.packagePrice,a.date_time,a.status,b.user_id,b.name FROM meddolic_user_cashback_income_summary a, meddolic_user_details b WHERE a.member_id='$member_id' AND a.member_id=b.member_id ORDER BY a.date_time DESC");
                                    while($valCashback=mysqli_fetch_assoc($queryCashback)){
                                        $count++;
                                ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td><?=$valCashback['user_id']?></td>
                                        <td><?=$valCashback['name']?></td>
                                        <td><?=$valCashback['incomeAmount']?> <i class="fa fa-percent"></i> </td>
                                        <td>$  <?=releaseAmount($con,$valCashback['summary_id'])?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:d", strtotime($valCashback['date_time']));?></td>
                                        <td><?php if($valCashback['status']==1) echo "<button class='btn btn-success btn-sm'><b>Running</b></button>"; else if($valCashback['status']==0) echo "<button class='btn btn-danger btn-sm'><b>Complete</b></button>"; else if ($valCashback['status']==2) echo "<button class='btn btn-warning btn-sm'><b>Expired</b></button>"; ?></td>
                                        <td><a href="cashBackIncomeDetails?summaryID=<?=$valCashback['summary_id'];?>" class="btn btn-primary btn-sm"> More </a></td>
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