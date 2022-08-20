function validateform(){
  "use strict"
  var email=document.myform.email.value;
  var phone=document.myform.phone.value;
  var country_code=document.myform.country_code.value;

  if (email == "" && phone == "" && country_code == ""){
    alert("Please write email or phone with country code, any one of these field.");
    return false;
  }else{
    return true;
  }
  
}  
