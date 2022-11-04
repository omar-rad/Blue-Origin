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
  const signupForm = document.querySelector("#signup");

  signupForm.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(signupForm);
    const searchParams = new URLSearchParams();
    
    for (const pair of formData) {
        searchParams.append(pair[0], pair[1]);
    }
    
    fetch('//localhost/BlueOrigin/php/forgotpassword.php', {
        method: "POST",
        body: searchParams       
    }).then(function(response){
        
        if (response.status === 200) {
            setFormMessage(signupForm, "finished operation" ,"Password change link is sent to you email");
               //window.location.href = "//localhost/BlueOrigin/login.html"; 
        }else if (response.status === 406) {
            setFormMessage(signupForm, "error" ,"Email Address / Phone number not found!");
        }

        return response.text();
    }).then(function(text){
    
    console.log(text);
    }).catch (function(error){
    console.error(error);
    });
    

  });

 

});