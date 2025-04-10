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
                    <h2><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Search Member</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"> Member </li>
                        <li class="breadcrumb-item active"> Search Member</li>
                    </ul>
                </div>            
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group date">
                                        <input type="text" id="searchValue" class="form-control" placeholder="Search Value" name="user_id" onkeypress="return catchEnter(event)">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="input-group mb-3">                                        
                                        <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" onclick="mySearch()" id="SubmitSearch" > Search </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="showResult"></div>
    </div>
</div>
<?php include('include/footer.php'); ?>
<script>
function catchEnter(event){
  // alert(e);
  if(event.which == 13 || event.keyCode == 13){
    $("#SubmitSearch").trigger('click');
    // alert('enter is pressed');
  }
}
function mySearch() {
var search_value = $('#searchValue').val();
    // alert(search_value);
    $.ajax({
      url:"ajaxCalls/searchAllAjax",        
      data: { search_value: search_value },
      success:function(result){    
              
        $("#showResult").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */     
    }
  });
};
function memberDashboard(userId,password,memberId){
   var url='../User/setSessionAdvice?userId='+userId+'&mID='+password+'&codeGenerate='+memberId;
   window.open(url,'_blank');
};
function blockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
               alert(data);
             if(data){
              alert('User Block Successfully');
              mySearch();
             }
          }
      });
    }
  }
}
function unBlockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Un-Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
            // alert(data);
            if(data){
              alert('User Un-Block Successfully');
              mySearch();
            }
          }
      });
    }
  }
}
var d = document.getElementById("Members");
    d.className += " active";
var d = document.getElementById("searchMember");
    d.className += " active";
</script>
</body>
</html> 