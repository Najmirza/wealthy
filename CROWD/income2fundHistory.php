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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Income To Fund History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Member </li>
                        <li class="breadcrumb-item active"> Income To Fund History</li>
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
                        <h2>Income To Fund History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>          
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Amount Transfer</th>
                                        <th>Charge</th>
                                        <th>Net Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $count=0;
                                    $queryActive=mysqli_query($con,"SELECT a.transferAmount,a.transferCharge,a.depositAmount,a.transferDate,b.user_id,b.name FROM meddolic_user_income_wallet_transfer a, meddolic_user_details b WHERE CAST(a.transferDate AS DATE) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id   ".$query." order by a.transferDate DESC");
                                    while($valActive=mysqli_fetch_array($queryActive)){
                                      $count++;
                                ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $valActive['user_id'] ?></td>
                                        <td><?= $valActive['name'] ?></td>
                                        <td>$  <?= $valActive['transferAmount']?></td>
                                        <td>$  <?= $valActive['transferCharge']?></td>
                                        <td>$  <?= $valActive['depositAmount']?></td>
                                        <td><i class="fa fa-clock-o"></i> <?= date("d-m-Y H:i:d", strtotime($valActive['transferDate']));?></td>
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
var d = document.getElementById("activationHistory");
    d.className += " active";
</script>
</body>
</html> 