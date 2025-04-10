<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<?php 
    $queryAdmin=mysqli_query($con,"SELECT member_id,name,user_id,email_id,phone FROM meddolic_user_details where user_id='$user_id'");
    $valAdmin=mysqli_fetch_assoc($queryAdmin);
    $adminId=$valAdmin['member_id'];
    $name=$valAdmin['name'];
    $user_id=$valAdmin['user_id'];
        $email_id=$valAdmin['email_id'];
    $phone=$valAdmin['phone']; ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Admin Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Admin Profile</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-6">
                <div class="card">
                    <div class="body">
                        <h6>Basic Information</h6>
                        <form method="POST" action="updateAdminDetails" onsubmit="return confirm('Are you sure?')" >
                        <div class="row clearfix">
                     
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Login Id * :</label>
                                    <input class="form-control" value="<?= $user_id?>" required name="user_id" >
                              
                                    <input type="hidden" name="adminId" value="<?= $adminId?>">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">                                                
                                    <label class="control-label">Name * :</label>
                                    <input type="text" class="form-control" value="<?= $name?>" required name="name">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">    
                                <div class="form-group">
                                    <label class="control-label">Phone * :</label>
                                    <input type="number" class="form-control" value="<?= $phone?>" required name="phone" onkeypress="return onlynum(event)" maxlength="10" onblur="phone_valid(this.value)" id="phone" >
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email ID * :</label>
                                    <input class="form-control" value="<?= $email_id?>" name="email_id" placeholder="Enter EmailID" >
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="adminUpdate">Update</button> &nbsp;&nbsp;
                        <button class="btn btn-danger" onclick="location.reload()">Cancel</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
</body>
</html> 