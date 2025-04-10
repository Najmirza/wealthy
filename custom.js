$('#loginForm').on('submit', function(e) {
	e.preventDefault();
});
function catchEnter(event){
  // alert(e);
  if(event.which == 13 || event.keyCode == 13){
    $("#loginSubmit").trigger('click');
    // alert('enter is pressed');
  }
}
// Enable tool Tip
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
$('#from_date').datepicker({
  format: 'dd-mm-yyyy'
})
$('#to_date').datepicker({
  format: 'dd-mm-yyyy'
}) 

// Login Ajax Code
function LoginValidate() {
    var userId = $('#exampleInputEmail1').val();
    var password = $('#exampleInputPassword1').val();
    if(userId==""){
      alert("Plz Enter UserName ");
      document.getElementById("exampleInputEmail1").value="";
      document.getElementById("exampleInputEmail1").focus();
      return false; 
    }
    if(password==""){
      alert("Plz Enter Password ");
      document.getElementById("exampleInputPassword1").value="";
      document.getElementById("exampleInputPassword1").focus();
      return false; 
    }
    //. alert(name+"<br>"+password);
    $.ajax({
        type: "POST",
        url: 'login_process',
        data: { userId:userId, password:password },
        cache: false,
        success: function(data) {
             if(data){
             //alert(data);
             $("#success").removeClass();
             $("#success").addClass("text-warning");
             $("#success").text("Successfully Login...... Redirecting To Dashboard...");
             var url = window.location.href;
             url = url.slice( 0, url.indexOf('/Login') );
             var newurl = url+data ;
             setTimeout(function(){ location.replace(newurl); }, 1500);
             }
             else {
             $("#success").text();
             $("#success").addClass("text-danger");
             alert("Invalid Credential /Blocked Account");
             setTimeout(function(){ window.location = 'Login';}, 250);
                 
              }
         }
    });     
}; 

// Show Password Login Page Code
function ShowPassword() {
    var x = document.getElementById("exampleInputPassword1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
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

//Only Number Type
function onlynum(evt)
{
  evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

//Both Number And Charecter Type
function onlycharnum(evt)
{
  evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 65 && charCode <= 90) || (charCode >= 48 && charCode <= 57) || (charCode >= 97 && charCode <= 122)) {
        return true;
    }
    else
    {
        return false;
    }
  return true;
}

// Validate PhoneNo

function phone_valid(phone_number)
{
     if(phone_number.length!=0 && (phone_number.length!=10 || phone_number.slice(0, 1)=="0"))
    {
        alert("Invalid Phone Number!!!\nKindly enter 10 digit phone nubmer without starting with 0");
        document.getElementById("phone").value="";
    }
}
function removeModal(){
  // alert(window.location.href);
  // var currentUrl=window.location.href;
  setTimeout(function(){ location.reload(); }, 500);
  // location.reload();
}
//Check User Id Valid
function sponser_valid(sponser_id){
  document.getElementById("sponser_name").value="";
  if(!sponser_id==""){
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
            alert("Invalid / Suspended Sponser ID");
            document.getElementById("sponser_id").value="";
        }
      }
    }
    xmlhttp.open("GET","../get_sponser_name?sponser_id="+sponser_id,true);
    xmlhttp.send();
  }
}
//Check User Id Active/Inactive
function userActiveValid(sponser_id){
  document.getElementById("sponser_name").value="";
  if(!sponser_id==""){
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
            alert("Invalid / Suspended User ID");
            document.getElementById("sponser_id").value="";
        }
      }
    }
    xmlhttp.open("GET","../getUserNameInactive?sponser_id="+sponser_id,true);
    xmlhttp.send();
  }
}
// Edit Pin Price 
$('#MiscPrice').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) // Button that triggered the modal
var recipient = button.data('whatever') // Extract info from data-* attributes
var modal = $(this);
var id = recipient;
// alert("helo");
        $.ajax({
            type: "POST",
            url: base_url+'admin/RateSetting/miscAjaxFetch',
            data: { id: id },
            cache: false,
            success: function (data) {
                console.log(data);
                modal.find('.misc_dash').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });  
})

// Submit Pin Price Edit
function submitChargePrice(){
  var tdsCharge = $('#tdsCharge').val();
  var adminCharge = $('#adminCharge').val();
  if(adminCharge!="" && tdsCharge!=""){
    // alert("hello");
    $.ajax({
        type: "POST",
        url: base_url+'admin/RateSetting/editChargePrice',
        data: { tdsCharge:tdsCharge, adminCharge:adminCharge },
        cache: false,
        success: function(data){
             // alert(data);
           if(data==1){
            $('#alert_msg_misc').css('display','block');
            $('#success_msg_misc').text('All Price Changed Successfully.');
            $('#tdsCharge').val("");
            $('#adminCharge').val("");
            setTimeout( function (){ 
            $('#alert_msg_misc').css('display','none'); }, 4000 ); 
           }
           else{
            $('#alert_msg_misc').css('display','block');
            $('#success_msg_misc').text('All Price Not Changed...Try Again');
            setTimeout( function (){ 
            $('#alert_msg_misc').css('display','none'); }, 4000 );
           }
        }
    }); 
}
else{
    $('#alert_msg_misc').css('display','block');
    $('#success_msg_misc').text('Please fill All Field.');
    setTimeout( function (){ 
      $('#alert_msg_misc').css('display','none'); }, 4000 );
  }
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