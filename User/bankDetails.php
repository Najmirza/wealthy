<!DOCTYPE html>
<html lang="en">
<?php
require_once("loginCheck.php");
require_once('Include/Head.php');
require_once('Include/Header.php');
require_once('Include/Menu.php'); ?>
<!--start-body-content-->

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12">
            <div class="row">
                <div class="dashboard-title">
                    <div class="icon">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                    <div class="caption">
                        <h2 style="padding-top: 10px;font-size: 26px;">Add Bank Details </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-panel">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form theme-form" action="userProfileAuthProcess" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Account Holder Name *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required value="<?= $acName ?>" name="acName" placeholder="Enter Account Holder Name" required <?php if ($acName != '')  ?>>
                                            <input type="hidden" name="memberId" value="<?= $memberId ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">IFSC Code *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required value="<?= $ifsc ?>" name="ifsc" placeholder="Enter IFSC Code" required <?php if ($ifsc != '')  ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Bank Name *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required value="<?= $bank ?>" name="bank" placeholder="Enter Bank Name" required <?php if ($bank != '') ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Branch *</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required value="<?= $branch ?>" name="branch" placeholder="Enter Branch" required <?php if ($branch != '')  ?>>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">A/C No. *</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" required value="<?= $accountNo ?>" placeholder="Enter A/C No." name="accountNo" onkeypress="return onlynum(event)" required <?php if ($accountNo != '')  ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit" data-bs-original-title="" title="Update" name="bankUpdate">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end-body-content-->
<?php require_once('Include/Footer.php'); ?>
<script>
    function deleteWalletAddress(paymentId) {
        if (paymentId != "") {
            if (confirm('Are you sure to Delete this Wallet Address?')) {
                $.ajax({
                    type: "POST",
                    url: 'ajaxCalls/deleteWalletAddressAjax',
                    data: {
                        paymentId: paymentId
                    },
                    cache: false,
                    success: function(data) {
                        // alert(data);
                        if (data) {
                            alert('Wallet Address Deleted Successfully');
                            location.reload();
                        }
                    }
                });
            }
        }
    }
</script>
</body>

</html>