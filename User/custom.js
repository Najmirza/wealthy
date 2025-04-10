$('#loginForm').on('submit', function(e) {
	e.preventDefault();
});
function catchEnter(event){
  if(event.which == 13 || event.keyCode == 13){
    $("#loginSubmit").trigger('click');
    // alert('enter is pressed');
  }
}

// Login Ajax Code
function LoginValidate() {
    var userId = $('#inputUserId').val();
    var password = $('#inputPassword').val();
    $('#loginSubmit').hide();
    $('.loadingMore').show();
    if(userId==""){
        alert("Plz Enter UserName ");
        document.getElementById("inputUserId").value="";
        document.getElementById("inputUserId").focus();
        $('.loadingMore').hide();
        $('#loginSubmit').show();
      return false; 
    }
    if(password==""){
        alert("Plz Enter Password ");
        document.getElementById("inputPassword").value="";
        document.getElementById("inputPassword").focus();
        $('.loadingMore').hide();
        $('#loginSubmit').show();
        return false; 
    }
    // alert(userId+"<br>"+password);
    $.ajax({
        type: "POST",
        url: 'loginProcessAjax',
        data: { userId:userId, password:password },
        cache: false,
        success: function(data) {
            if(data){
                //alert(data);
                $("#success").removeClass();
                $("#success").addClass("text-success mt-4 text-center");
                $("#success").text("Successfully Login..... Redirecting...");
                var currentUrl = window.location.href;
                currentUrl = currentUrl.slice( 0, currentUrl.indexOf('/LoginAuth') );
                var newUrl = currentUrl+data ;
                setTimeout(function(){ location.replace(newUrl); }, 1500);
            } else {
                $("#success").text();
                $("#success").addClass("text-danger");
                alert("Invalid credential .... Please Try Again");
                setTimeout(function(){ location.reload();}, 250);
                 
            }
        }
    });     
};
//Forgot Password Ajax
function forgotPassValidate() {
    var userId = $('#inputUserId').val();
    $('#passSubmit').hide();
    $('.loadingMore').show();
    if(userId==""){
        alert("Plz Enter UserName ");
        document.getElementById("inputUserId").value="";
        document.getElementById("inputUserId").focus();
        $('.loadingMore').hide();
        $('#passSubmit').show();
      return false; 
    }
    //. alert(name+"<br>"+password);
    $.ajax({
        type: "POST",
        url: 'forgotPasswordProcessAjax',
        data: { userId:userId },
        cache: false,
        success: function(data) {
            if(data){
                //alert(data);
                $("#success").removeClass();
                $("#success").addClass("text-success");
                $("#success").text("You Password is Sent to your Registered Email...");
                var url = window.location.href;
                var newurl = url+data;
                setTimeout(function(){ location.replace(newurl); }, 1500);
            } else {
                $("#success").text();
                $("#success").addClass("text-danger");
                alert("Information Not Matched with our Record!!!");
                setTimeout(function(){ location.reload();}, 250);
                 
            }
        }
    });     
};
function forgotTrnPassValidate() {
  var userId = $('#inputUserId').val();
  $('#passSubmit').hide();
  $('.loadingMore').show();
  if(userId==""){
      alert("Plz Enter UserID ");
      document.getElementById("inputUserId").value="";
      document.getElementById("inputUserId").focus();
      $('.loadingMore').hide();
      $('#passSubmit').show();
    return false; 
  }
  //. alert(name+"<br>"+password);
  $.ajax({
      type: "POST",
      url: 'forgotTrnPasswordProcessAjax',
      data: { userId:userId },
      cache: false,
      success: function(data) {
          if(data){
              //alert(data);
              $("#success").removeClass();
              $("#success").addClass("text-success");
              $("#success").text("You Password is Sent to your Registered Email...");
              var url = window.location.href;
              var newurl = url+data;
              setTimeout(function(){ location.replace(newurl); }, 1500);
          } else {
              $("#success").text();
              $("#success").addClass("text-danger");
              alert("Information Not Matched with our Record!!!");
              setTimeout(function(){ location.reload();}, 250);
               
          }
      }
  });     
};

// Show Password Login Page Code
function eyePass() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
// Email Send Timer Code
function startTimer(){
    var counter = 101;
    setInterval(function() {
        counter--;
        if (counter >= 0) {
            span = document.getElementById("count");
            span.innerHTML = counter +' S' ;
        }
        if(counter === 0){
            //alert('sorry, out of time');
            document.getElementById("emailBtn").disabled = false;
            // document.getElementById("count").style.display = "none";
            document.getElementById("count").style.visibility = "hidden";
            clearInterval(counter);
        }
    }, 1000);
}
// Email Send Withdraw Verify OTP Code
function CryptoSendEmailOTP(userId){
    var investmentAmount = document.getElementById("investmentAmount").value;
    var walletAddress = document.getElementById('paymentId');
    var paymentId = walletAddress.options[walletAddress.selectedIndex].value;
    if(paymentId!='' && investmentAmount!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "CryptoSendEmailOTPAjax",
            data: {userId: userId, investmentAmount: investmentAmount },
            success: function(res) {
                //alert(res);
                alert('OTP send to your Register Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Fund Transfer Verify OTP Code
function walletTransferEmailOTP(userId){
    var transferAmount = document.getElementById('transferAmount').value;
    var receiverUserId = document.getElementById('sponser_id').value;
    if(userId!='' && transferAmount!='' && receiverUserId!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "walletTransferEmailOTPAjax",
            data: {userId: userId, transferAmount: transferAmount, receiverUserId : receiverUserId },
            success: function(res) {
                //alert(res);
                alert('OTP send to your Register Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Income Wallet to Fund Wallet Transfer Verify OTP Code
function incomeWalletEmailOTP(userId){
    var transferAmount = document.getElementById('transferAmount').value;
    if(userId!='' && transferAmount!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "incomeWalletEmailOTPAjax",
            data: {userId: userId, transferAmount: transferAmount},
            success: function(res) {
                //alert(res);
                alert('OTP send to your Register Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Profile Verify OTP Code
function profileVerifyOTP(userId,oldEmail){
    var userName = document.getElementById('userName').value;
    var phoneNo = document.getElementById('phoneNo').value;
    var emailId = document.getElementById('emailId').value;
    if(userId!='' && userName!='' && phoneNo!='' && emailId!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "profileVerifyOTPAjax",
            data: {userId: userId, oldEmail : oldEmail },
            success: function(res) {
                //alert(res);
                alert('Verification OTP send to Email -: '+ oldEmail);
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Wallet Address Verify OTP Code
function addressVerifyOTP(userId,emailId){
    var walletAddress = document.getElementById('walletAddress').value;
    if(userId!='' && walletAddress!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "addressAddEmailOTPAjax",
            data: {userId: userId, walletAddress: walletAddress},
            success: function(res) {
                //alert(res);
                alert('OTP send to your Register Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Withdraw Verify OTP Code
function activeUserEmailOTP(userId){
    var activerId = document.getElementById("sponser_id").value;
    var walletId = document.getElementById('walletType');
    var walletType = walletId.options[walletId.selectedIndex].value;
    if(walletType!='' && activerId!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "activeUserEmailOTPAjax",
            data: {userId: userId },
            success: function(res) {
                //alert(res);
                alert('OTP send to your Register Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
// Email Send Profile Verify OTP Code
function changePassVerifyOTP(userId,oldEmail){
    var currentPass = document.getElementById('currentPass').value;
    var loginPassword = document.getElementById('loginPassword').value;
    var confirmLoginPassword = document.getElementById('confirmLoginPassword').value;
    if(userId!='' && currentPass!='' && loginPassword!='' && confirmLoginPassword!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "changePassVerifyOTPAjax",
            data: {userId: userId, oldEmail : oldEmail },
            success: function(res) {
                //alert(res);
                alert('Verification OTP send to Email -: '+ oldEmail);
            } });
    }else{
        alert('Please fill all fields');
    }
}
//Auto Close ALert Box.
window.setTimeout(function() {
   alertFade();
}, 4000);
function alertFade(){
   $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}
function onlynum(evt){
  evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function onlycharnum(evt){
   evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 48 && charCode <= 57) || (charCode >= 97 && charCode <= 122))  {
        return true;
    }
    return false;
}
function dont(evt){
    return false;
}
// Validate PhoneNo
function phone_valid(phone_number){
  if(phone_number.length!=0 && phone_number.slice(0, 1)=="0"){
    alert("Invalid Phone Number!!!\nKindly enter phone nubmer without starting with 0");
    document.getElementById("phone").value="";
  }
}
function sponser_valid(sponser_id){
    document.getElementById("sponser_name").value="";
    if(!sponser_id==""){
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
                var v=xmlhttp.responseText;
                if(v.trim()!=""){
                    document.getElementById("sponser_name").value=v.trim();
                }
                else{
                    alert("Invalid Sponser ID");
                    document.getElementById("sponser_id").value="";
                }
               
            }
          }
        xmlhttp.open("GET","../getSponserNameAjax?sponserId="+sponser_id,true);
        xmlhttp.send();
      }
    }
function removeModal(){
  // alert(window.location.href);
  // var currentUrl=window.location.href;
  setTimeout(function(){ location.reload(); }, 500);
  // location.reload();
}
function matchPassword(pwd,conf_pwd,err_mssg,buttonCode){
  if($('#'+conf_pwd).val()!=""){
    // alert($('#'+conf_pwd).val());
    if($('#'+pwd).val()!=$('#'+conf_pwd).val()){
      $('#'+err_mssg).html("Password and Confirm password is not equal!!");
      $('#'+buttonCode).attr('disabled','disabled');
    }
    else{
      $('#'+err_mssg).html("");   
      $('#'+buttonCode).removeAttr('disabled');
    }
  } else {
    $('#'+err_mssg).html("");
    $('#'+buttonCode).removeAttr('disabled'); 
  }
}
//Check User Id Inactive
function userActiveValid(userId){
  document.getElementById("sponser_name").value="";
  if(!userId==""){
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
      if(xmlhttp.readyState==4 && xmlhttp.status==200){
        var v=xmlhttp.responseText;
        if(v.trim()!=""){
            document.getElementById("sponser_name").value=v.trim();
        }
        else{
            alert("Invalid UserId");
            document.getElementById("sponser_id").value="";
        }
      }
    }
    xmlhttp.open("GET","../getSponserNameAjax?sponserId="+userId,true);
    xmlhttp.send();
  }
}