<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 
include("loginCheck.php");
if(isset($_POST['tokenGenerate'])){
 	$loginMemberId=$_POST['loginMemberId']; 
 	$generateToken=$_POST['generateToken'];
 	$coinRate=$_POST['coinRate'];
 	$d=date("Y-m-d H:i:s");
 	$entry_date=date("Y-m-d");

 	if($generateToken<=0 || $generateToken==0){ ?>
	  <script>
	    alert("Please Enter Valid Token Amount!!!");
	    window.top.location.href="tokenGenerate";
	  </script>
	  <?php
	  exit;
 	}
 	if($coinRate<=0 || $coinRate==0){ ?>
	  <script>
	    alert("Please Enter Valid Token Rate!!!");
	    window.top.location.href="tokenGenerate";
	  </script>
	  <?php
	  exit;
 	}

	$queryCheck=mysqli_query($con,"SELECT botToken FROM meddolic_user_details WHERE member_id='$loginMemberId'");
	$valCheck=mysqli_fetch_assoc($queryCheck);
	$botToken=$valCheck['botToken'];
	if($botToken<$generateToken) { ?>
	  <script>
	    alert("Insufficient Token to Generate!!!");
	    window.top.location.href="tokenGenerate";
	  </script>
	  <?php
	  exit;
	}
	mysqli_query($con,"UPDATE meddolic_user_details SET botToken=botToken-'$generateToken',restGenToken='$generateToken' WHERE member_id='$loginMemberId'");

	mysqli_query($con,"UPDATE meddolic_config_misc_setting SET coinRate='$coinRate'");

	$queryOld=mysqli_query($con,"SELECT botToken FROM meddolic_user_details WHERE member_id='$loginMemberId'");
	$valOld=mysqli_fetch_assoc($queryOld);
	$restCoin=$valOld['botToken'];

	mysqli_query($con,"INSERT INTO meddolic_config_coin_generate_history (`restCoin`,`coinGenerate`,`coinRate`,`dateTime`) VALUES ('$restCoin','$generateToken','$coinRate','$d')"); ?>
<script>
  alert("Token Generated Successfully!!!");
  window.top.location.href="tokenGenerate";
</script>
<?php } ?>
<?php include("../close-connection.php"); ?>