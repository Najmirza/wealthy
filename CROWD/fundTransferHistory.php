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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Fund Transfer History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Fund Manager </a></li>
                        <li class="breadcrumb-item active"> Fund Transfer History</li>
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
                        <h2>Fund Transfer History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sender Details</th>
                                        <th>Receiver Details</th>
                                        <th>Transfer Amount</th>
                                        <th>Transfer Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 

                                function name($con,$member_id){
                                    $query="SELECT name from meddolic_user_details where member_id='$member_id' ";
                                    $result=mysqli_query($con,$query);
                                    $val1=mysqli_fetch_array($result);
                                    return $val1[0];
                                }
                                function user_id($con,$member_id){
                                    $query="SELECT user_id from meddolic_user_details where member_id='$member_id' ";
                                    $result=mysqli_query($con,$query);
                                    $val1=mysqli_fetch_array($result);
                                    return $val1[0];
                                }

                                $query_in="SELECT member_id from meddolic_user_details where user_id='$user_id1'";
                                $result=mysqli_query($con,$query_in);
                                $val1=mysqli_fetch_array($result);
                                $member_id1=$val1[0];
                                $query="";
                                if($user_id1!=""){
                                   $query= " AND sender_member_id='$member_id1'";
                                }

                                $count=0;
                                $query="SELECT * from meddolic_user_fund_transfer_history where CAST(date_time AS DATE) BETWEEN '$cal_date' AND '$cal_date1' ".$query." order by date_time desc";
                                $result=mysqli_query($con,$query);
                                while($val1=mysqli_fetch_array($result)){
                                    $count++;
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= name($con,$val1['sender_member_id'])?> ( <?= user_id($con,$val1['sender_member_id']) ?> )</td>
                                        <td><?= name($con,$val1['receiver_member_id'])?> ( <?= user_id($con,$val1['receiver_member_id']) ?> )</td>
                                        <td>$  <?= $val1['amount'] ?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= $val1['date_time'] ?></td>
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
var d = document.getElementById("Fund");
    d.className += " active";
var d = document.getElementById("fundTransferHistory");
    d.className += " active";
</script>
</body>
</html> 