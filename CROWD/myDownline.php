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
            $query="select count(*) from meddolic_user_details where user_id='$user_id1'";
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
        if($_GET['to_date'] ){
            $show_date1=$_GET['to_date'];
            $cal_date1 = date("Y-m-d", strtotime($show_date1));
        }
    } else{
        $user_id1=$_SESSION['admin_user_id'];
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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> My Downline</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Team </li>
                        <li class="breadcrumb-item active"> My Downline</li>
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
                        <h2>My Downline</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>MobileNo</th>
                                        <!--<th>Password</th>-->
                                        <th>Sponser Details</th>
                                        <th>Join Date</th>
                                        <th>Activation Date</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query=mysqli_query($con,"SELECT member_id from meddolic_user_details where user_id='$user_id1'");
                                    $val1=mysqli_fetch_array($query);
                                    $member_id1=$val1[0];

                                    $query="";
                                    if($user_id1!="") {
                                        $query= $query." AND b.member_id='$member_id1'";  
                                    }
                                    $count=0;
                                    $queryTeam=mysqli_query($con,"SELECT a.user_id,a.name,a.phone,a.password,a.date_time,a.activation_date,a.topup_flag,c.name AS sponserName,c.user_id AS sponserID FROM meddolic_user_details a, meddolic_user_child_ids b, meddolic_user_details c WHERE CAST(b.date_time AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.member_id=b.child_id AND a.sponser_id=c.member_id ".$query." order by b.date_time DESC");
                                    while($valTeam=mysqli_fetch_assoc($queryTeam)){
                                    $count++;
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $valTeam['name']?></td>
                                        <td><?= $valTeam['user_id']?></td>
                                        <td><?= $valTeam['phone']?></td>
                                        <!--<td><?= $valTeam['password']?></td>-->
                                        <td><?= $valTeam['sponserID']?> [ Name -: <?=$valTeam['sponserName']?> ]</td>
                                        <td><?= date("d-m-Y H:i:d", strtotime($valTeam['date_time']));?></td>
                                        <td><?php if($valTeam['activation_date']!="") { ?><?= date("d-m-Y H:i:d", strtotime($valTeam['activation_date'])); } ?></td>
                                         <td><?php if($valTeam['topup_flag']==1) echo "Active";else echo "In-Active";?></td>
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
var d = document.getElementById("Team");
    d.className += " active";
var d = document.getElementById("myDownline");
    d.className += " active";
</script>
</body>
</html> 