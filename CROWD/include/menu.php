<?php
$queryAccess=mysqli_query($con,"SELECT member_id,name,user_id,fundWallet FROM meddolic_user_details where user_id='$_SESSION[admin_user_id]'");
if($valAccess=mysqli_fetch_array($queryAccess)){
   $name=$valAccess['name'];
   $user_id=$valAccess['user_id'];
   $member_id=$valAccess['member_id'];
   $fundWallet=$valAccess['fundWallet']; } ?>
<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="dropdown">
                <span>Hi, <?=$user_id?></span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?=$name?></strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="adminProfile"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="changePassword"><i class="icon-envelope-open"></i>Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="logoutCode"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
            <hr>
        </div>
        <!-- Nav tabs -->
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">                            
                        <li id="dashboard">
                            <a href="dashboard" ><i class="icon-home"></i> <span>Dashboard</span></a>
                        </li>
                        <li id="Members">
                            <a href="#Members" class="has-arrow"><i class="icon-user-follow"></i> <span>User Management</span></a>
                            <ul>
                                <li id="viewMember"><a href="viewMember">View Member</a></li>
                                <li id="searchMember"><a href="searchMember">Search Member</a></li>
                                <li id="activationHistory"><a href="activationHistory">Activation History</a></li>
                                <li id="rewardList"><a href="rewardListFirst">Reward Archiever List 1</a></li>
                                <li id="rewardList"><a href="rewardListSecond">Reward Archiever List 2</a></li>
                                <li id="rewardList"><a href="rewardListThird">Reward Archiever List 3</a></li>
                                <li id="rewardRelease"><a href="rewardRelease">Reward Release </a></li>

                            </ul>
                        </li>
                        <li id="Fund">
                            <a href="#Fund" class="has-arrow"><i class="icon-wallet"></i> <span>Fund Manager</span></a>
                            <ul>                                    
                                <li id="fundRequest"><a href="fundRequest"><span>Fund Request</span></a></li>
                                <li id="fundTransfer"><a href="fundTransfer"><span>Fund Transfer</span></a></li>
                                <li id="fundTransferHistory"><a href="fundTransferHistory"><span>Fund Transfer History</span></a></li>
                                <li id="paymentDetailsUpdate"><a href="paymentDetailsUpdate"><span>Payment Details Update</span></a></li>
                            </ul>
                        </li>
                        <li id="Withdraw">
                            <a href="#Withdraw" class="has-arrow"><i class="icon-folder"></i> <span>Withdraw</span></a>
                            <ul>                                    
                                <li id="walletWithdrawInr"><a href="walletWithdrawInr">Wallet Withdraw Status</a></li>
                            </ul>
                        </li>
                        <li id="Team">
                            <a href="#Team" class="has-arrow"><i class="icon-users"></i> <span>Team</span></a>
                            <ul>                                    
                                <li id="myDirect"><a href="myDirect">My Direct</a></li>
                                <li id="myDownline"><a href="myDownline">My Downline</a></li>
                            </ul>
                        </li>
                        <li id="Support">
                            <a href="#Support" class="has-arrow"><i class="icon-bubbles"></i> <span>Support</span></a>
                            <ul>
                                <li id="newSupportTicket"><a href="newSupportTicket"> New Tickets</a></li>
                                <li id="supportTicket"><a href="supportTicket"> Support Tickets</a></li>
                            </ul>
                        </li>
                        <li id="Income">
                            <a href="#Income" class="has-arrow"><i class="icon-diamond"></i> <span>Income</span></a>
                            <ul>
                                
                                <li id="referralIncome"><a href="referralIncome">Referral Income</a></li>
                                <li id="levelIncome"><a href="levelIncome">Level Income</a></li>
                                <!--<li id="roiIncome"><a href="roiIncome">Roi Income</a></li>-->
                                <!--<li id="rewardIncome"><a href="rewardIncome">Rank & Reward Income</a></li>-->
                            </ul>
                        </li>
                        <li id="Wallet">
                            <a href="#Wallet" class="has-arrow"><i class="icon-puzzle"></i> <span>Wallet</span></a>
                            <ul>                                    
                                <li id="walletStatement"><a href="walletStatement">Wallet Statement</a></li>
                                <li id="walletOutstanding"><a href="walletOutstanding">Wallet Outstanding</a></li>
                            </ul>
                        </li>
                        <li id="Setting">
                            <a href="#Setting" class="has-arrow"><i class="icon-settings"></i> <span>Setting</span></a>
                            <ul>
                                <!-- <li id="packageManager"><a href="packageManager">Cashback Setting</a></li> -->
                                <li id="businessPlanSetting"><a href="businessPlanSetting">Business Plan Update</a></li>
                                <!-- <li id="noticeSetting"><a href="noticeSetting">Notice Setting</a></li> -->
                                <li id="popUpSetting"><a href="popUpSetting">Pop-Up Setting</a></li>
                                <!-- <li id="roiStop"><a href="roiStop">Stop ROI</a></li> -->
                       
                            </ul>
                        </li>
                        <li id="changePassword">
                            <a href="changePassword" ><i class="icon-key"></i> <span>Change Password</span></a>
                        </li>
                        <li>
                            <a href="logoutCode" ><i class="icon-power"></i> <span>Sign Out</span></a>
                        </li>
                    </ul>
                </nav>
            </div>              
        </div>          
    </div>
</div>