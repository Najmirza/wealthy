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
    }else
    $user_id1=$_SESSION['admin_user_id'];
?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> My Direct</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Team </li>
                        <li class="breadcrumb-item active"> My Direct</li>
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
                        <h2>My Direct</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        
                                        <th>Joinig Date</th>
                                        <th>Active Status</th>
                                        <th>Activation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query="SELECT member_id from meddolic_user_details where user_id='$user_id1'";
                                    $result=mysqli_query($con,$query);
                                    $val1=mysqli_fetch_array($result);
                                    $member_id1=$val1[0];
                                    
                                    $queryDirect=mysqli_query($con,"SELECT member_id,user_id,name,phone,password,date_time,topup_flag,activation_date FROM meddolic_user_details where sponser_id='$member_id1' order by date_time");
                                    $count=0;
                                    while($valDirect=mysqli_fetch_assoc($queryDirect)){
                                        $count++; ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $valDirect['user_id']?></td>
                                        <td><?= $valDirect['name']?></td>
                                        <td><?= $valDirect['phone']?></td>
                                       
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:d", strtotime($valDirect['date_time']));?></td>
                                        <td><?php if($valDirect['topup_flag']==1) echo "Active"; else echo "In-Active"; ?></td>
                                        <td><?= $valDirect['activation_date']?></td>
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
var d = document.getElementById("myDirect");
    d.className += " active";
</script>
</body>
</html> 