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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Fund Transfer</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Fund Manager </a></li>
                        <li class="breadcrumb-item active"> Fund Transfer</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Fund Transfer</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="fundTransferBack" >
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>User ID *</label>
                                            <input type="text" name="sponser_id" id="sponser_id" class="form-control" placeholder="e.g. john12345" onblur="sponser_valid(this.value)" required autofocus>
                                            <input type="hidden" name="login_member_id" value="<?=$member_id?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Name *</label>
                                            <input type="text" name="sponser_name" id="sponser_name" class="form-control" placeholder="e.g. John Doe" disabled >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Amount To Transfer *</label>
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="e.g. Transfer Amount" onkeypress="return onlynum(event)"  required >
                                        </div>
                                   </div>
                                   <!--<div class="col-md-12">-->
                                   <!--     <div class="form-group">-->
                                   <!--         <label>Transaction Password *</label>-->
                                   <!--         <input type="password" name="trnPassword" class="form-control" required placeholder="Enter Transaction Password">-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                </div>
                                <button type="submit" name="fundTransfer" class="btn btn-primary action-button float-left" value="Transfer Now" > Transfer Now</button>
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
var d = document.getElementById("Fund");
    d.className += " active";
var d = document.getElementById("fundTransfer");
    d.className += " active";
</script>
</body>
</html> 