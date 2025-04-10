<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php

include'loginCheck.php'; 
$date=date("Y-m-d H:i:s");
// Dashboard Image Update
if(isset($_POST['imageUpdate'])){
if(!empty($_FILES['dashboardImage']['name'])){
	$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
	$temp = explode(".", $_FILES["dashboardImage"]["name"]);
	$extension = end($temp);
	if ((($_FILES["dashboardImage"]["type"] == "image/gif")
	|| ($_FILES["dashboardImage"]["type"] == "image/jpeg")
	|| ($_FILES["dashboardImage"]["type"] == "image/jpg")
	|| ($_FILES["dashboardImage"]["type"] == "image/png")
	|| ($_FILES["dashboardImage"]["type"] == "application/png"))
	&& ($_FILES["dashboardImage"]["size"] < 5000000)
	&& in_array($extension, $allowedExts))	  {
	  if ($_FILES["dashboardImage"]["error"] > 0){
	   // echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	    } else {
		    $newFileName = uniqid('NoticeImage-', true) 
		    . '.' . strtolower(pathinfo($_FILES['dashboardImage']['name'], PATHINFO_EXTENSION));
		      move_uploaded_file($_FILES["dashboardImage"]["tmp_name"],
		      "../assets/SupportFile/" . $newFileName);
		      // echo "Stored in: " . "upload/logo/" . $_FILES["file"]["name"];
		      $dashboardImage = "assets/SupportFile/" . $newFileName;
		      $file = $_FILES["dashboardImage"]["name"];
		      $query1="UPDATE meddolic_config_misc_setting SET dashboardImage='$dashboardImage',imageStatus=1";
		      $result1=mysqli_query($con,$query1);
		      if($result1){ ?>
		      	<script>
					alert('Image Updated!!!!');
		   			 window.location = 'popUpSetting';
				</script>
				<?php
				} else{ ?>
				<script>
					alert('Image Not-Updated????');
		   			 window.location = 'popUpSetting';
				</script>
				<?php
				exit;	
		      }
	    }
	  }else { ?>
		<script>
			alert('Please Select Correct Format????');
		   	window.location = 'popUpSetting';
		</script>
		<?php
		exit;	
	  }
	}
}


if(isset($_POST['noticeUpdate'])){
	$newsContent=$_POST['newsContent'];	
	$queryNews=mysqli_query($con,"UPDATE meddolic_config_news_list SET news='$newsContent',newStatus=1");
	if($queryNews){ ?>
		<script>
			alert('Dashboard Notice Updated!!!!');
   			 window.location = 'noticeSetting';
		</script>
		<?php
	} else{ ?>
		<script>
			alert('Dashboard Notice Not-Updated????');
   			 window.location = 'noticeSetting';
		</script>
		<?php
		exit;	
	}
} ?>

