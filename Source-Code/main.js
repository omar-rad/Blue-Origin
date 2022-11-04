/* global fetch */

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
  
  //check if there is a session
  fetch('//localhost/BlueOrigin/php/checksession.php', {
        method: "POST"
    }).then(function(response){
        
            if (response.status === 200) {
               window.location.href = "//localhost/BlueOrigin/dashboard.html"; 
            }
    
    }).catch (function(error){
    console.error(error);
    });  
   //--------------------------
    
  const loginForm = document.querySelector("#login");
  const createAccountForm = document.querySelector("#createAccount");
  const createEndUserForm = document.querySelector("#createEndUserAccount");
  const createCompanyForm = document.querySelector("#createCompanyAccount");
  const defaultOption = document.querySelector("#default");

  document.querySelector("#default").addEventListener("click", e => {
    e.preventDefault();
   
  });


  document.querySelector("#linkCreateAccount").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.add("form--hidden");
    createAccountForm.classList.remove("form--hidden");
    createEndUserForm.classList.add("form--hidden");
    createCompanyForm.classList.add("form--hidden");
  });

  document.querySelector("#linkLogin").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.remove("form--hidden");
    createAccountForm.classList.add("form--hidden");
    createEndUserForm.classList.add("form--hidden");
    createCompanyForm.classList.add("form--hidden");
  });

  document.querySelector("#LinkLogin").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.remove("form--hidden");
    createAccountForm.classList.add("form--hidden");
    createEndUserForm.classList.add("form--hidden");
    createCompanyForm.classList.add("form--hidden");
  });

  document.querySelector("#linkCreateEndUserAccount").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.add("form--hidden");
    createAccountForm.classList.add("form--hidden");
    createEndUserForm.classList.remove("form--hidden");
    createCompanyForm.classList.add("form--hidden");

  });

  document.querySelector("#linkCreateCompanyAccount").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.add("form--hidden");
    createAccountForm.classList.add("form--hidden");
    createEndUserForm.classList.add("form--hidden");
    createCompanyForm.classList.remove("form--hidden");
  });

  loginForm.addEventListener("submit", e => {
    e.preventDefault();

    //Perform fetch login

    const formData = new FormData(loginForm);
    const searchParams = new URLSearchParams();
    
    for (const pair of formData) {
        searchParams.append(pair[0], pair[1]);
    }
    
    fetch('//localhost/BlueOrigin/php/auth.php', {
        method: "POST",
        body: searchParams       
    }).then(function(response){
        
            if (response.status === 200) {
               window.location.href = "//localhost/BlueOrigin/dashboard.html"; 
            }
    return response.text();
    }).then(function(text){
    
    console.log(text);
    }).catch (function(error){
    console.error(error);
    });
  
    

    setFormMessage(loginForm, "error" ,"Incorrect username/password combination");
    //end of login
  }); 
  
  createAccountForm.addEventListener("submit", e => {
    e.preventDefault();

    
  });
  
  createEndUserForm.addEventListener("submit", e => {
    e.preventDefault();

    //Perform fetch register

    const formData = new FormData(createEndUserForm);
    const searchParams = new URLSearchParams();
    
    for (const pair of formData) {
        searchParams.append(pair[0], pair[1]);
    }
    
    fetch('//localhost/BlueOrigin/php/registerEndUser.php', {
        method: "POST",
        body: searchParams       
    }).then(function(response){
        
        if (response.status === 200) {
            setFormMessage(createEndUserForm, "finished operation" ,"Registeration is successful");
               window.location.href = "//localhost/BlueOrigin/dashboard.html"; 
        }else if (response.status === 406) {
            setFormMessage(createEndUserForm, "error" ,"Please try again");
        }

        return response.text();
    }).then(function(text){
    
    console.log(text);
    }).catch (function(error){
    console.error(error);
    });
    //end of login
  });
  
  createCompanyForm.addEventListener("submit", e => {
    e.preventDefault();

    //Perform fetch login

    const formData = new FormData(createCompanyForm);
    const searchParams = new URLSearchParams();
    
    for (const pair of formData) {
        searchParams.append(pair[0], pair[1]);
    }
    
    fetch('//localhost/BlueOrigin/php/registerCompany.php', {
        method: "POST",
        body: searchParams       
    }).then(function(response){
        
            if (response.status === 200) {
               setFormMessage(createCompanyForm, "success" ,"Registeration is successful");
              window.location.href = "//localhost/BlueOrigin/dashboard.html"; 
            }else if (response.status === 406) {
               setFormMessage(createCompanyForm, "error" ,"Please try again");
            }

    return response.text();
    }).then(function(text){
    
    console.log(text);
    }).catch (function(error){
    console.error(error);
    });
    //end of register
  });

  document.querySelectorAll(".form__input").forEach(inputElement => {
    inputElement.addEventListener("blur", e => {
      if (e.target.id === "signupUsername" && e.target.value.length > 0 && e.target.value.length < 10 ){
        setInputError(inputElement, "Username must be atleast 10 characters");
      }
    });

    inputElement.addEventListener("input", e => {
      clearInputError(inputElement);
    });
  });

});