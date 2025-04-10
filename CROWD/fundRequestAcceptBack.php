
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
include("loginCheck.php");
$id=$_POST['ResID'];
$member_id1=$_POST['member_id'];
$requestFund=$_POST['requestFund'];
$login_member_id=$_POST['login_member_id'];
$d=date("Y-m-d H:i:s");

mysqli_query($con,"INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id` ,`deb_cr`, `amount`,`date_time`,`trn_id`) VALUES ('$login_member_id',5,1,'$requestFund','$d','$member_id1')");

mysqli_query($con,"INSERT INTO meddolic_user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`, `date_time`,`trn_id`) VALUES ('$member_id1',6,2,'$requestFund','$d','$login_member_id')");

mysqli_query($con,"UPDATE meddolic_user_details set fundWallet=fundWallet+'$requestFund' where member_id='$member_id1'");

mysqli_query($con,"UPDATE meddolic_user_fund_request SET status=1 WHERE id='$id'");

mysqli_query($con,"INSERT INTO meddolic_user_fund_transfer_history (`sender_member_id`,`receiver_member_id`,`amount`,`date_time`) VALUES ('$login_member_id','$member_id1','$requestFund','$d')"); ?>
<script>
	alert("Wallet Amount Transfer Succssfully.");
	window.top.location.href="fundRequest";
</script>

<?php include("../close-connection.php"); ?>