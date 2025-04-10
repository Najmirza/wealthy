<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
include("loginCheck.php");
include('include/header.php');
include('include/menu.php'); ?>
<?php
$todayDate = date('Y-m-d');
$d = date('Y-m-d H:i:s');

$queryUser = mysqli_query($con, "SELECT COUNT(1) from meddolic_user_details WHERE user_type=2");
$valUser = mysqli_fetch_array($queryUser);
$totalUser = $valUser[0];

$queryActive = mysqli_query($con, "SELECT COUNT(1) from meddolic_user_details WHERE user_type=2 AND topup_flag=1");
$valActive = mysqli_fetch_array($queryActive);
$activeUser = $valActive[0];

$queryInActive = mysqli_query($con, "SELECT COUNT(1) from meddolic_user_details WHERE user_type=2 AND topup_flag=0");
$valInActive = mysqli_fetch_array($queryInActive);
$inActiveUser = $valInActive[0];

$queryWallet = mysqli_query($con, "SELECT SUM(wallet),SUM(fundWallet) FROM meddolic_user_details WHERE user_type=2");
$valWallet = mysqli_fetch_array($queryWallet);
$incomeWallet = $valWallet[0];
$cashWallet = $valWallet[1];

$queryInvest = mysqli_query($con, "SELECT SUM(investPrice) FROM meddolic_user_activation_details");
$valInvest = mysqli_fetch_array($queryInvest);
$totalInvestment = $valInvest[0];

$queryToday = mysqli_query($con, "SELECT COUNT(1) FROM meddolic_user_activation_details WHERE CAST(date_time AS date)='$todayDate'");
$valToday = mysqli_fetch_array($queryToday);
$todayActive = $valToday[0];

$queryWithdraw = mysqli_query($con, "SELECT SUM(amount) FROM meddolic_user_wallet_withdrawal_crypto WHERE (released=0 OR released=1)");
$valWithdraw = mysqli_fetch_array($queryWithdraw);
$totalWithdraw = $valWithdraw[0];

$queryPendingFundReq = mysqli_query($con, "SELECT SUM(requestFund) FROM meddolic_user_fund_request WHERE status=0");
$valPendingFund = mysqli_fetch_array($queryPendingFundReq);
$pendingFundReq = $valPendingFund[0];

$queryPending = mysqli_query($con, "SELECT SUM(amount) FROM meddolic_user_wallet_withdrawal_crypto WHERE released=0");
$valPending = mysqli_fetch_array($queryPending);
$pendingWithdraw = $valPending[0]; 

$totalInvestment1 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=1");
$valInvest1 = mysqli_fetch_array($totalInvestment1);
$investPrice1 = $valInvest1[0]; 

$totalInvestment2 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=2");
$valInvest2 = mysqli_fetch_array($totalInvestment2);
$investPrice2 = $valInvest2[0]; 

$totalInvestment3 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=3");
$valInvest3 = mysqli_fetch_array($totalInvestment3);
$investPrice3 = $valInvest3[0]; 

$totalInvestment4 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=4");
$valInvest4 = mysqli_fetch_array($totalInvestment4);
$investPrice4 = $valInvest4[0]; 

$totalInvestment5 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=5");
$valInvest5 = mysqli_fetch_array($totalInvestment5);
$investPrice5 = $valInvest5[0]; 

$totalInvestment6 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=6");
$valInvest6 = mysqli_fetch_array($totalInvestment6);
$investPrice6 = $valInvest6[0]; 

$totalInvestment7 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=7");
$valInvest7 = mysqli_fetch_array($totalInvestment7);
$investPrice7 = $valInvest7[0]; 

$totalInvestment8 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=8");
$valInvest8 = mysqli_fetch_array($totalInvestment8);
$investPrice8 = $valInvest8[0]; 

$totalInvestment9 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=9");
$valInvest9 = mysqli_fetch_array($totalInvestment9);
$investPrice9 = $valInvest9[0]; 

$totalInvestment10 = mysqli_query($con,"SELECT SUM(investPrice) FROM meddolic_user_activation_details WHERE packageId=10");
$valInvest10 = mysqli_fetch_array($totalInvestment10);
$investPrice10 = $valInvest10[0]; 

$totalincomeToFund = mysqli_query($con,"SELECT SUM(transferAmount) FROM meddolic_user_income_wallet_transfer ");
$valIncomeToFund = mysqli_fetch_array($totalincomeToFund);
$incomeToFund = $valIncomeToFund[0];



 ?>
<style>
    .input-group .input-group-addon {
        border: none;
        background-color: #02609d;
        padding-left: 0;
        font-weight: bold;
        color: #ffffff;
    }

    .animated-red {
        /*background-color: #b70b0b !important;*/
        -webkit-animation-name: newlife-blink-red !important;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 2s;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-iteration-count: infinite;
        /* Safari 4.0 - 8.0 */
        animation-name: newlife-blink-red !important;
        animation-duration: 2s !important;
        animation-iteration-count: infinite;
    }

    @-webkit-keyframes newlife-blink-red {
        0% {
            background-color: #920000;
        }

        25% {
            background-color: #d10202;
        }

        50% {
            background-color: #ff0000;
        }

        75% {
            background-color: #d10202;
        }

        100% {
            background-color: #920000;
        }

    }

    /* Standard syntax */
    @keyframes newlife-blink-red {
        0% {
            background-color: #920000;
        }

        25% {
            background-color: #d10202;
        }

        50% {
            background-color: #ff0000;
        }

        75% {
            background-color: #d10202;
        }

        100% {
            background-color: #920000;
        }
    }



    .animated-green {
        /*background-color: #037a14 !important;*/
        -webkit-animation-name: newlife-blink-green !important;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 2s;
        /* Safari 4.0 - 8.0 */
        -webkit-animation-iteration-count: infinite;
        /* Safari 4.0 - 8.0 */
        animation-name: newlife-blink-green !important;
        animation-duration: 2s !important;
        animation-iteration-count: infinite;
    }

    @-webkit-keyframes newlife-blink-green {
        0% {
            background-color: #037a14;
        }

        25% {
            background-color: #05b51e;
        }

        50% {
            background-color: #03fc26;
        }

        75% {
            background-color: #05b51e;
        }

        100% {
            background-color: #037a14;
        }

    }

    /* Standard syntax */
    @keyframes newlife-blink-green {
        0% {
            background-color: #037a14;
        }

        25% {
            background-color: #05b51e;
        }

        50% {
            background-color: #03fc26;
        }

        75% {
            background-color: #05b51e;
        }

        100% {
            background-color: #037a14;
        }
    }

    .blinking {
        animation: blinkingText 1.2s infinite;
    }

    @keyframes blinkingText {
        0% {
            color: #ff0500;
        }

        49% {
            color: #ff0500;
        }

        60% {
            color: transparent;
        }

        99% {
            color: transparent;
        }

        100% {
            color: #ff0500;
        }
    }
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group" align="center" style="font-size: 16px;font-weight: 600;background-color: #fff;color: #000;">
                    <label>Referral URL</label>
                    <input id="referralCone" type="hidden" class="form-control" style="cursor: no-drop; width: 100%" readonly value="https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $user_id ?>">
                    <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;" href="javascript:void(0)" onclick="referralLinkCopy()" class="btn btn-sm btn-success waves-effect">
                        <i class="fa fa-copy"></i>
                        <span>Copy</span>
                    </a>
                    <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;" target="_blank" href="https://api.whatsapp.com/send?phone=&amp;text=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $user_id ?>" class="btn btn-sm btn-danger waves-effect">
                        <i class="fa fa-whatsapp"></i>
                        <span>Whatsapp</span>
                    </a>

                    <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $user_id ?>&amp;quote=text" class="btn btn-sm btn-primary waves-effect">
                        <i class="fa fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;" target="_blank" href="https://telegram.me/share/url?url=https://wealthycrowd.online/authUserRegister?affiliateCode=<?= $user_id ?>&text=text" class="btn btn-sm btn-success waves-effect">
                        <i class="fa fa-telegram"></i>
                        <span>Telegram</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <a href="viewMember">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-primary"><i class="fa fa-users"></i> </div>
                            <div class="content">
                                <div class="text">Total Associate</div>
                                <h5 class="number"><?= isset($totalUser) ? $totalUser : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="viewActiveMember">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-users"></i> </div>
                            <div class="content">
                                <div class="text">Active Associate</div>
                                <h5 class="number"><?= isset($activeUser) ? $activeUser : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="viewInActiveMember">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-danger"><i class="fa fa-users"></i></div>
                            <div class="content">
                                <div class="text">In-Active Associate</div>
                                <h5 class="number"> <?= isset($inActiveUser) ? $inActiveUser : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="activationHistory">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-primary"><i class="fa fa-users"></i></div>
                            <div class="content">
                                <div class="text">Today Activation</div>
                                <h5 class="number"> <?= isset($todayActive) ? $todayActive : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="walletOutstanding">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-primary"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Income Wallet</div>
                                <h5 class="number">$  <?= isset($incomeWallet) ? $incomeWallet : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="walletOutstanding">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-primary"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Fund Wallet</div>
                                <h5 class="number">$  <?= isset($cashWallet) ? $cashWallet : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="activationHistory">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-primary"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Total Investment</div>
                                <h5 class="number">$  <?= isset($totalInvestment) ? $totalInvestment : '0'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="walletWithdrawHistory">
                    <div class="card top_counter currency_state">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Withdraw</div>
                                <h5 class="number">$  <?= isset($totalWithdraw) ? $totalWithdraw : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="fundRequest">
                    <div class="card top_counter currency_state animated-red">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Pending Fund Request</div>
                                <h5 class="number">$  <?= isset($pendingFundReq ) ? $pendingFundReq  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <a href="walletWithdrawInr">
                    <div class="card top_counter currency_state animated-red">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Pending Withdraw</div>
                                <h5 class="number">$  <?= isset($pendingWithdraw) ? $pendingWithdraw : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="income2fundHistory">
                    <div class="card top_counter currency_state animated-red">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Income 2 Fund History </div>
                                <h5 class="number">$  <?= isset($incomeToFund ) ? $incomeToFund  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 1</div>
                                <h5 class="number">$  <?= isset($investPrice1 ) ? $investPrice1  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 2</div>
                                <h5 class="number">$  <?= isset($investPrice2 ) ? $investPrice2  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 3</div>
                                <h5 class="number">$  <?= isset($investPrice3 ) ? $investPrice3  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 4</div>
                                <h5 class="number">$  <?= isset($investPrice4 ) ? $investPrice4  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 5 </div>
                                <h5 class="number">$  <?= isset($investPrice5 ) ? $investPrice5  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 6 </div>
                                <h5 class="number">$  <?= isset($investPrice6 ) ? $investPrice6  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 7 </div>
                                <h5 class="number">$  <?= isset($investPrice7 ) ? $investPrice7  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 8 </div>
                                <h5 class="number">$  <?= isset($investPrice8 ) ? $investPrice8  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div><div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 9 </div>
                                <h5 class="number">$  <?= isset($investPrice9 ) ? $investPrice9  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="card top_counter currency_state ">
                        <div class="body">
                            <div class="icon text-success"><i class="fa fa-money"></i></div>
                            <div class="content">
                                <div class="text">Total Investment 10 </div>
                                <h5 class="number">$  <?= isset($investPrice10 ) ? $investPrice10  : '0.00'; ?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
    function referralLinkCopy() {
        var link = $("#referralCone").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        alert('Referral Link Copied Successfully');
    }
    var d = document.getElementById("dashboard");
    d.className += " active";
</script>
</body>

</html>