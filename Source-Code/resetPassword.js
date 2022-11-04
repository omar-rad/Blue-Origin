
function setFormMessage(formElement, type, message){
  const messageElement = formElement.querySelector(".form__message");

  messageElement.textContent = message;
  messageElement.classList.remove("form__message--success", "form__message--error");
  messageElement.classList.add('form__message--${type}');

}

function setInputError(inputElement, message){
  inputElement.classList.add("form__message--error");
  inputElement.parentElement.querySelector(".form__input-error-message").textContent = message;

}

function clearInputError(inputElement){
  inputElement.classList.remove("form__message--error");
  inputElement.parentElement.querySelector(".form__input-error-message").textContent = ""; 

}

document.addEventListener("DOMContentLoaded",() => {
  const resetForm = document.querySelector("#reset");

  resetForm.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(reset);
    const searchParams = new URLSearchParams();
    
    for (const pair of formData) {
        searchParams.append(pair[0], pair[1]);
    }
    
    fetch('//localhost/BlueOrigin/php/resetPassword.php', {
        method: "POST",
        body: searchParams       
    }).then(function(response){
        
        if (response.status === 200) {
            setFormMessage(resetForm, "finished operation" ,"Password changed");
           
               //window.location.href = "//localhost/BlueOrigin/login.html"; 
        }else if (response.status === 406) {
            setFormMessage(resetForm, "error" ,"Error");
        }

        return response.text();
    }).then(function(text){
    
    console.log(text);
    }).catch (function(error){
    console.error(error);
    });
    

  });

  document.querySelectorAll(".form__input").forEach(inputElement => {
    inputElement.addEventListener("blur", e => {
      if (e.target.id === "emailAddress" && e.target.value.length > 0){
        let emailChecker = e.includes("@");
                if (emailChecker){
          setInputError(inputElement, "Email address must include @ character");
        }
      }

    });

    inputElement.addEventListener("input", e => {
      clearInputError(inputElement);
    })
  });

});
