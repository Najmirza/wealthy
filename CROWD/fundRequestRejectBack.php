
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
 include("loginCheck.php");
 
$id=$_GET['ResID'];
$d=date("Y-m-d H:i:s");

mysqli_query($con,"UPDATE meddolic_user_fund_request SET status=2 WHERE id='$id'");

?>
<script>
	alert("Request Rejected Succssfully.");
	window.top.location.href="fundRequest";
</script>

<?php include("../close-connection.php"); ?>