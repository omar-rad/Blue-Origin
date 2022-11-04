/* global fetch */

document.addEventListener("DOMContentLoaded",() => {
  
  //check if there is a session
  fetch('//localhost/BlueOrigin/php/checksession.php', {
        method: "POST"
    }).then(function(response){
        
            if (response.status === 406) {
               window.location.href = "//localhost/BlueOrigin/login.html"; 
            }
            return response.text();
    }).then(function(text){
            
            console.log(text);
            
    }).catch (function(error){
    console.error(error);
    });
});