$(document).ready(function(){
   $("#email").keyup(function(){
      var mail = $("#email").val().trim();
      if(mail != ''){
         $.ajax({
            url: '../other/signUpAjax.php',
            type: 'post',
            data: {mail:mail},
            success: function(response){
                if(response > 0){
                    document.getElementById("email").value="";
                    document.getElementById("mail").innerHTML = "mail is already taken";
                }

             }
          });
      }

    });

 });
