  
function validateForm() {
    var mailformat = document.getElementById('CustomerEmail').value;
    var p = document.getElementById("CustomerPassword").value;
//---------
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mailformat))
{
 document.getElementById("mail").innerHTML = "";
 
}
else{
 document.getElementById("mail").innerHTML = "Mail incorrect";
 return false;
}

if(mailformat.length>85){
 document.getElementById("mail").innerHTML = "Mail is too long";
 return false;
}else{
    
document.getElementById("mail").innerHTML = "";

}

//----------------------------------------------
if(p == ""){
 document.getElementById("pass").innerHTML = "Password is empty";

 return false;

}
else if(p.length>55){
 document.getElementById("pass").innerHTML = "Password is too long";

 return false;

}
 else
{
document.getElementById("pass").innerHTML = "";
return true;


}



 

}
  function forgetValidate() {
            var mail = document.getElementById('recoverEmail').value;
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
{
 document.getElementById("recover").innerHTML = "";

}

else{
     

 document.getElementById("recover").innerHTML = "Mail incorrect";
 return false;
}
}


