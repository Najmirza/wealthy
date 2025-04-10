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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Password Manager</h2>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Login Password Update</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="changePasswordBack" onsubmit="return confirm('Are you sure?')">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Login Password *</label>
                                            <input type="password" class="form-control" required name="password" placeholder="*******" >
                                            <input type="hidden" name="login_member_id" value="<?=$member_id?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> New Login Password *</label>
                                            <input type="password" class="form-control" name="password1" placeholder="*********" required >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Login Password *</label>
                                            <input type="password" class="form-control" name="password2" placeholder=" *********" required >
                                        </div>
                                   </div>
                                </div>
                                <button type="submit" name="loginPassword" class="btn btn-primary action-button float-left" value="Submit" >Update Now</button>
                                <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Transaction Password Update</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="changePasswordBack" onsubmit="return confirm('Are you sure?')">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Transaction Password *</label>
                                            <input type="password" class="form-control" required name="password" placeholder="*******" >
                                            <input type="hidden" name="login_member_id" value="<?=$member_id?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> New Transaction Password *</label>
                                            <input type="password" class="form-control" name="password1" placeholder="*********" required >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirm Transaction Password *</label>
                                            <input type="password" class="form-control" name="password2" placeholder=" *********" required >
                                        </div>
                                   </div>
                                </div>
                                <button type="submit" name="trnPassword" class="btn btn-primary action-button float-left" value="Submit" >Update Now</button>
                                <button type="button" name="previous" class="btn btn-danger action-button-previous float-left ml-3" value="Reset" onclick="location.reload()">Reset</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
var d = document.getElementById("changePassword");
    d.className += " active";
</script>
</body>
</html> 