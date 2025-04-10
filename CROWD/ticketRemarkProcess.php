<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("loginCheck.php"); 

if(isset($_POST['ticketUpdate'])){
    $ticketId=$_POST['ticketId'];
    $loginMemberId=$_POST['loginMemberId'];
    $subjectId=$_POST['subjectId'];
    $priorityId=$_POST['priorityId'];
    $ticketStatus=$_POST['ticketStatus'];
    $adminMessage=$_POST['adminMessage'];
    $d=date('Y-m-d H:i:s'); 
    $id=$_POST['id'];

    $queryTicket=mysqli_query($con,"UPDATE meddolic_user_support_ticket SET subjectId='$subjectId',priorityId='$priorityId',actionDate='$d',adminMessage='$adminMessage',ticketStatus='$ticketStatus',actionBy='$loginMemberId' WHERE ticketId='$ticketId'");
    if($queryTicket) { ?>
    <script>
        alert("Action Taken Successfully!!!");
        window.top.location.href='newSupportTicket';
    </script>
    <?php } } ?>
<?php include("../close-connection.php"); ?>