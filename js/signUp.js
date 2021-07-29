function validateForm() {
    var p = document.getElementById("password").value;
    var mailformat = document.getElementById('email').value;
    var first = document.getElementById("firstName").value;
    var last = document.getElementById("lastName").value;
        // -------------------------------------------------

     //FristName
     if (first == "") {
        
        document.getElementById("Fname").innerHTML = "First name is empty";

       
        return false;
       
      }
    
      else if(first.length<2)
    {
        document.getElementById("Fname").innerHTML = "Frist name is too small";

        return false;
    }
        else if(first.length>40)
    {
        document.getElementById("Fname").innerHTML = "Frist name is too long";

        return false;
    }
  
   else if (!first.match(/^[a-zA-Zء-ي ]+$/)) 
        {
            document.getElementById("Fname").innerHTML = "Frist name must be letters only";

            return false;
        }
    else
        {
            document.getElementById("Fname").innerHTML = "";


        }

    // --------------------------------------------------
        // LastName

        if (last == "") {
            document.getElementById("Lname").innerHTML = "Last name is empty";
        
            return false;
        
          }
        
          else if(last.length<2)
        {
            document.getElementById("Lname").innerHTML = "Last name is small";
           
            return false;
        }
             else if(last.length>45)
        {
            document.getElementById("Lname").innerHTML = "Last name is small";
           
            return false;
        }
        
        
      
       else if (!last.match(/^[a-zA-Zء-ي ]+$/)) 
            {
                document.getElementById("Lname").innerHTML = "Last name must be in letters only";
                return false;
            }
            else
            {
                document.getElementById("Lname").innerHTML = "";
    
    
            }
   
   
    // -------------------------------------------------
   
       // -------------------------------------------------

       if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mailformat))
       {
        document.getElementById("mail").innerHTML = "";

       }
      
       else{
            
     
        document.getElementById("mail").innerHTML = "Mail incorrect";
        return false;
       }
         
        if (mailformat.length>100)
       {
        document.getElementById("mail").innerHTML = "mail is too long";
          return false;

       }
      
       else{
            
     
        document.getElementById("mail").innerHTML = "";
    
       }
       
       
       //----------------------------------------------
       if(p.length<5){
        document.getElementById("pass").innerHTML = "Password is too short";
       
        return false;

        }


    else if(p.length>55)
    {
          document.getElementById("pass").innerHTML = "Password is too long";
 
         return false;   
    }
  
    else
    {
      document.getElementById("pass").innerHTML = "";
      return true;


    }




}
