<?php 
include("loginCheck.php");
if(isset($_POST['supportTicket'])){
  $memberId=mysqli_real_escape_string($con,$_POST['memberId']);
  $subjectId=mysqli_real_escape_string($con,$_POST['subjectId']);
  $priorityId=mysqli_real_escape_string($con,$_POST['priorityId']);
  $ticketMessage=mysqli_real_escape_string($con,$_POST['ticketMessage']);
  $d=date("Y-m-d H:i:s");
  $todayDate=date("Y-m-d");
    
  $queryOld=mysqli_query($con,"SELECT COUNT(1) FROM meddolic_user_support_ticket WHERE memberId='$memberId' AND (ticketStatus=1 OR ticketStatus=2)");
  $valOld=mysqli_fetch_array($queryOld);
  if($valOld[0]>0){ ?>
    <script>
        alert("Your Previous Request is on Processing!!!");
        window.top.location.href="support";
    </script>
    <?php
    exit;
  }
  $ticketCode="AT".rand(11101,99999).$memberId.date('s').date('h');
  $queryTemp=mysqli_query($con,"INSERT INTO meddolic_user_support_ticket (`memberId`,`ticketCode`,`subjectId`,`priorityId`,`ticketMessage`,`raiseDate`) VALUES ('$memberId','$ticketCode','$subjectId','$priorityId','$ticketMessage','$d')");
  $ticketId=$con->insert_id; ?>
  <script>
    alert('Support Ticket Raised Successfully');
    window.top.location.href="support";
  </script>
<?php } ?>
<?php include("../close-connection.php"); ?>