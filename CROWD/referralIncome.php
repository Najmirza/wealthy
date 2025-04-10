<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php  
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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Referral Income</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Income </li>
                        <li class="breadcrumb-item active"> Referral Income</li>
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
                                    <div class="input-group date">
                                        <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?= $user_id1?>" >
                                        <div class="input-group-append">                                            
                                            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-user"></i></button>
                                        </div>
                                    </div>
                                </div>
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
                        <h2>Referral Income</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UserId</th>
                                        <th>Name</th>
                                        <th>Income Date</th>
                                        <th>Income Amount</th>
                                        <th>Investment Amount</th>
                                        <th>Referral Percent</th>
                                        <th>Child Name</th>
                                        <th>Child ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query="SELECT member_id from meddolic_user_details where user_id='$user_id1'";
                                    $result=mysqli_query($con,$query);
                                    $val1=mysqli_fetch_array($result);
                                    $member_id1=$val1[0];

                                    $query="";
                                    if($user_id1!=""){
                                       $query= $query. " AND a.member_id='$member_id1'";
                                    }                                    
                                    $count=0;
                                    $queryReferral=mysqli_query($con,"SELECT b.name,b.user_id,a.referralIncome,a.referralPercent,a.packagePrice,a.dateTime,c.user_id AS childId,c.name AS childName FROM meddolic_user_sponsor_income a, meddolic_user_details b, meddolic_user_details c WHERE a.memberId=b.member_id AND a.childId=c.member_id AND CAST(a.dateTime AS date) BETWEEN '$cal_date' AND '$cal_date1' ".$query." ORDER BY a.dateTime desc");
                                    while($valReferral=mysqli_fetch_assoc($queryReferral)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valReferral['user_id']?></td>
                                        <td><?= $valReferral['name']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $valReferral['dateTime']?></td>
                                        <td>$  <?= $valReferral['referralIncome']?></td>
                                        <td>$  <?= $valReferral['packagePrice']?></td>
                                        <td><?= $valReferral['referralPercent']?> <i class="fa fa-percent"></i></td>
                                        <td><?= $valReferral['childName']?></td>
                                        <td><?= $valReferral['childId']?></td>
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
var d = document.getElementById("referralIncome");
    d.className += " active";
</script>
</body>
</html> 