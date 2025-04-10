<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php"); 

if(isset($_POST['add_remark'])){
$d=date('Y-m-d H:i:s'); 
$id=$_POST['id'];

$member_id=$_POST['member_id'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$remarks=$_POST['remarks'];

if($status==2){
    $result1=mysqli_query($con,"UPDATE meddolic_user_wallet_withdrawal SET remarks='$remarks',release_date='$d',released='$status' WHERE id='$id'");
} else {
    $result1=mysqli_query($con,"UPDATE meddolic_user_wallet_withdrawal SET remarks='$remarks',released='$status' WHERE id='$id'");
}

if($result1) { ?>
 <script>
    alert("Remarks Add successfully!!!");
    window.top.location.href='walletWithdrawHistory?user_id=<?= $user_id;?>&from_date=<?= $from_date;?>&to_date=<?= $to_date; ?>';
 </script>
 <?php }

} 



if(isset($_POST['edit_remark'])){
$d=date('Y-m-d H:i:s'); 
$id=$_POST['id'];
$member_id=$_POST['member_id'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$remarks=$_POST['remarks'];

if($status==2){
    $result1=mysqli_query($con,"UPDATE meddolic_user_wallet_withdrawal SET remarks='$remarks',release_date='$d',released='$status' where id='$id'");
} else {

     $result1=mysqli_query($con,"UPDATE meddolic_user_wallet_withdrawal SET remarks='$remarks',released='$status' where id='$id'");
}
if($result1) { ?>
 <script>
    alert("Remarks Edit successfully!!!");
    window.top.location.href='walletWithdrawHistory?user_id=<?= $user_id;?>&from_date=<?= $from_date;?>&to_date=<?= $to_date; ?>';
 </script>
 <?php }   
    } 
?>
<?php include("../close-connection.php"); ?>