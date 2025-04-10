<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php  
include("loginCheck.php");
if(isset($_POST['pdfUpdate'])){
    if(!empty($_FILES['pdfPath']['name'])){
        $allowedExts = array("pdf", "PDF");
        $temp = explode(".", $_FILES["pdfPath"]["name"]);
        $extension = end($temp);
        if ((($_FILES["pdfPath"]["type"] == "application/pdf")
        || ($_FILES["pdfPath"]["type"] == "application/PDF"))
        && ($_FILES["pdfPath"]["size"] < 50000000)
        && in_array($extension, $allowedExts)) {
            if ($_FILES["pdfPath"]["error"] > 0) { ?>
                <script>
                    alert('Please Select Only PDF format');
                    window.top.location.href='pdfUpdate';
                </script>
                <?php exit;
            } else {
                $newFileName = uniqid('BusinessPlan-', true) 
                . '.' . strtolower(pathinfo($_FILES['pdfPath']['name'], PATHINFO_EXTENSION));
                  move_uploaded_file($_FILES["pdfPath"]["tmp_name"],
                  "../assets/SupportFile/" . $newFileName);
                $path = "assets/SupportFile/" . $newFileName;

                mysqli_query($con,"UPDATE meddolic_config_misc_setting SET `pdfPath`='$path'"); 
            }
        }else{ ?>
            <script>
                alert('Please Select Only PDF format');
                window.top.location.href='businessPlanSetting';
            </script>
            <?php exit;
        }
    }
echo "<script>alert('PDF Updated Successfully!!!');window.top.location.href='businessPlanSetting';</script>";
 } ?>
<?php include("../close-connection.php"); ?>