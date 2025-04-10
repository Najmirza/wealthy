<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php');
      include("loginCheck.php");
      include('include/header.php');
      include('include/menu.php'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Notice Setting</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Setting </a></li>
                        <li class="breadcrumb-item active"> Notice Setting</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Notice Setting</h2>
                        <!-- <a class="btn btn-success" data-id="ThisID"  data-toggle="modal" data-target="#addNotice" href="javascript:void(0)" style="float:right;" ><i class="fa fa-plus"></i> Add Notice</a><br> -->
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>                    
                                        <!-- <th>Notice Header</th> -->
                                        <th>Notice Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $count=0;
                                    $todayDate=date('Y-m-d');
                                    $queryNews=mysqli_query($con,"SELECT * FROM meddolic_config_news_list WHERE newsId=1");
                                    $valNews=mysqli_fetch_assoc($queryNews);
                                        $count++; ?>
                                    <tr>
                                        <form action="popUpSettingProcess" method="POST"> 
                                            <td><?= $count; ?></td>
                                            <td><textarea type="text" class="form-control" name="newsContent" required rows=3 cols=80><?= $valNews['news']?></textarea></td>
                                            <td><input type="submit" class="btn btn-success" name="noticeUpdate" value="Update"><?php if($valNews['newStatus']==0){ ?><a href="javascript:void();" class="btn btn-warning" onclick="updateNoticeStatus('1')">Show</a>&nbsp;<?php } else { ?><a href="javascript:void();" class="btn btn-danger" onclick="updateNoticeStatus('0')">Hide</a><?php } ?></td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function deleteNews(newsId){
  if(newsId!=""){
    if(confirm('Are you sure to Delete this Notice?')){
      $.ajax({
        type: "POST",
        url: 'ajaxCalls/deleteNewsAjax',
        data: { newsId:newsId },
        cache: false,
        success: function(data){
          // alert(data);
          if(data){
            alert('Notice Deleted Successfully');
            location.reload();
          }
        }
      });
    }
  }
}
function updateNoticeStatus(newStatus){
    $.ajax({
        type: "POST",
        url: 'ajaxCalls/updateNoticeStatusAjax',
        data: { newStatus:newStatus },
        cache: false,
        success: function(data){
            if(data){
                alert('Updated Successfully');
                location.reload();
            }
        }
    });
}
var d = document.getElementById("Setting");
    d.className += " active";
var d = document.getElementById("noticeSetting");
    d.className += " active";
</script>
</body>
</html> 