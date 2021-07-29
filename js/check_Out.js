function validate()
{

var first = document.getElementById("firstName").value;
var last = document.getElementById("lastName").value;
var city = document.getElementById("city").value;
var phone = document.getElementById("phoneNumber").value;
var mailformat = document.getElementById('checkout_email').value;
var adress = document.getElementById("adress").value;
var apartment = document.getElementById("apartment").value;
//  var code = document.getElementById("code").value;

//---------------------------------------------------------------------
   //FristName
   if (first == "") {
        
    document.getElementById("Fname").innerHTML = "First name is empty";


    document.getElementById("firstName").style.borderColor = "red";
   
    return false;
   
  }

  else if(first.length<2)
{
  document.getElementById("Fname").innerHTML = "Frist name is to small";
    document.getElementById("firstName").style.borderColor = "red";
    return false;
} 
else if(first.length>90)
{
  document.getElementById("Fname").innerHTML = "Frist name is to long";
    document.getElementById("firstName").style.borderColor = "red";
    return false;
}

else if (!first.match(/^[a-zA-Zء-ي ]+$/)) 
    {
      document.getElementById("Fname").innerHTML = "Frist name must be letters only";
      document.getElementById("firstName").style.borderColor = "red";
        return false;
    }
    else
    {
        document.getElementById("Fname").innerHTML = "";
        document.getElementById("firstName").style.borderColor = "green";



    }

// --------------------------------------------------
    // LastName

    if (last == "") {
      document.getElementById("Lname").innerHTML = "Last name is empty";

        document.getElementById("lastName").style.borderColor = "red";
        return false;
    
      }
    
      else if(last.length<2)
    {
      document.getElementById("Lname").innerHTML = "LAst name is too small";
        document.getElementById("lastName").style.borderColor = "red";
       
        return false;
    }    
    else if(last.length>30)
    {
      document.getElementById("Lname").innerHTML = "Last name is too long";
        document.getElementById("lastName").style.borderColor = "red";
       
        return false;
    }  
   
   else if (!last.match(/^[a-zA-Zء-ي ]+$/)) 
        {
          document.getElementById("Lname").innerHTML = "Last name must be in letters Only";
            document.getElementById("lastName").style.borderColor = "red";
            return false;
        }
    else
        {
            document.getElementById("Lname").innerHTML = "";
            document.getElementById("lastName").style.borderColor = "green";



        }
        
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mailformat))
{
 document.getElementById("mail").innerHTML = "";
 document.getElementById("checkout_email").style.borderColor = "Green";


}

else{
     

 document.getElementById("mail").innerHTML = "Mail incorrect";
 document.getElementById("checkout_email").style.borderColor = "red";

 return false;
}

//--------------------------------------------------------------------
//-------------------------------------------------
if(adress== ""){
  document.getElementById("Adress").innerHTML = "Address is empty";
    document.getElementById("adress").style.borderColor = "red";
   
    return (false)

}


else if(adress.length<4)
{
  document.getElementById("Adress").innerHTML = "Address is  too small";
  document.getElementById("adress").style.borderColor = "red";
  return (false)   
}
else if(adress.length>500)
{
  document.getElementById("Adress").innerHTML = "Address is  too long";
  document.getElementById("adress").style.borderColor = "red";
  return (false)   
}
else if (adress.includes("'")||adress.includes('"')) 
{
  document.getElementById("Adress").innerHTML = "Address can't contain ' or '' ";
  document.getElementById("adress").style.borderColor = "red";
  return false;
}
else
{
    document.getElementById("Adress").innerHTML = "";
    document.getElementById("adress").style.borderColor = "green";



}
//-------------------------------------------------------------------
if(apartment  == ""){
  document.getElementById("Apartment").innerHTML = "Apartment is empty";
    document.getElementById("apartment").style.borderColor = "red";
   
    return (false)

}


else if(apartment.length<1)
{
  document.getElementById("Apartment").innerHTML = "Apartment is to Small";
  document.getElementById("apartment").style.borderColor = "red";
  return (false)   
}
else if(apartment.length>50)
{
  document.getElementById("Apartment").innerHTML = "Apartment is too large";
  document.getElementById("apartment").style.borderColor = "red";
  return (false)   
}
else if (!apartment.match(/^[A-Za-z0-9ء-ي٠-٩ -()]+$/)) 
{
  document.getElementById("Apartment").innerHTML = "Apartment letters and number are only allowed";
  document.getElementById("apartment").style.borderColor = "red";
  return false;
}

else
{
    document.getElementById("Apartment").innerHTML = "";
    document.getElementById("apartment").style.borderColor = "green";



}
//---------------------------------------------


   if(city.length<2)
{
  document.getElementById("City").innerHTML = "City is so Small";
    document.getElementById("city").style.borderColor = "red";
    return false;
}

  else if(city.length>30)
{
  document.getElementById("City").innerHTML = "City is too large";
    document.getElementById("city").style.borderColor = "red";
    return false;
}



else if (!city.match(/^[a-zA-Zء-ي ]+$/)) 
    {
        document.getElementById("City").innerHTML = "City is only alphabets are allowed";

        document.getElementById("city").style.borderColor = "red";
        return false;
    }else
    {
        document.getElementById("City").innerHTML = "";
        document.getElementById("city").style.borderColor = "green";

    
    
    }


//--------------------------------------------------

if (phone == "") {
        
  document.getElementById("Phone").innerHTML = "Phone is empty";
  document.getElementById("phoneNumber").style.borderColor = "red";
    return false;
    
}else if(phone.length < 11){

  document.getElementById("Phone").innerHTML = "Phone is to small";
  document.getElementById("phoneNumber").style.borderColor = "red";
    return false;
    
}else if (!phone.match('^[0-9]+$')) {
      document.getElementById("Phone").innerHTML = "Phone are only numbers allowed";
      document.getElementById("phoneNumber").style.borderColor = "red";
        return false;
        
}else if(phone.substring(0, 3) != '011' && phone.substring(0, 3) != '010' && phone.substring(0, 3) != '015' && phone.substring(0, 3) != '012'){
       document.getElementById("Phone").innerHTML = "Phone Number Must start with 011 or 010 or 012 or 015";
      document.getElementById("phoneNumber").style.borderColor = "red";
        return false;
        
}else{
        document.getElementById("Phone").innerHTML = "";
        document.getElementById("phoneNumber").style.borderColor = "Green";
         return true;

}
//--------------------------------------------------------------
/*
if (code == "") {
        

  }

else if(code.length<5)
{
  alert("Code too short");
  document.getElementById("checkout_reduction_code").style.borderColor = "red";

return (false)   
}
else if (!code.match(/^[A-Za-z0-9]+$/)) 
{
  alert('Code Only alphabets and numbers are allowed');
  document.getElementById("checkout_reduction_code").style.borderColor = "red";
  return false;
}
*/
//-----------------------------------------------


//---------------------------------


}