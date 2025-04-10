function catchEnter(event){
  if(event.which == 13 || event.keyCode == 13){
    $("#loginSubmit").trigger('click');
    // alert('enter is pressed');
  }
}
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
function CryptoSendEmailOTP(currentTime){
    var username = document.getElementById("username").value;
    var pass = document.getElementById("pass").value;
    if(username!='' && pass!=''){
        document.getElementById("count").style.visibility = "visible";
        // document.getElementById("count").style.display = "block";
        document.getElementById("emailBtn").disabled = true;
        startTimer(); 
        jQuery.ajax({
            type: "POST",
            url: "loginSendEmailOTPAjax",
            data: {currentTime: currentTime },
            success: function(res) {
                //alert(res);
                alert('OTP send to your Email Id.');
            } });
    }else{
        alert('Please fill all fields');
    }
}
function removeModal(){
  // alert(window.location.href);
  // var currentUrl=window.location.href;
  setTimeout(function(){ location.reload(); }, 500);
  // location.reload();
}