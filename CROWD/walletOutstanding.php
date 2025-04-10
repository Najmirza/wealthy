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
    }
?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Wallet Outstanding</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Wallet </li>
                        <li class="breadcrumb-item active"> Wallet Outstanding</li>
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
                        <h2>Wallet Outstanding</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                    <th>#</th>
                        <th>Name</th>
                        <th>User ID</th>
                        <th>Join Date</th>
                        <th>Main Wallet</th>
                        <th>Fund Wallet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                        $query="";
                        if($user_id1!=""){
                            $query= $query." and user_id='$user_id1'";  
                        }
                        $count=0;
                        $query="SELECT member_id,name,user_id,wallet,date_time,fundWallet from meddolic_user_details WHERE (wallet>0 OR fundWallet>0) ".$query." ORDER BY wallet DESC";
                        $result=mysqli_query($con,$query);
                        while($val1=mysqli_fetch_array($result)){
                            $count++; ?>
                      <tr>
                        <td><?= $count ?></td>
                        <td><?= $val1['name'] ?></td>
                        <td><?= $val1['user_id'] ?></td>
                        <td><?= $val1['date_time'] ?></td>
                        <td>$  <?= $val1['wallet']?></td>
                        <td>$  <?= $val1['fundWallet']?></td>
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
var d = document.getElementById("Wallet");
    d.className += " active";
var d = document.getElementById("walletOutstanding");
    d.className += " active";
</script>
</body>
</html> 