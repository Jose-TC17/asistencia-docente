// llamando a los elementos html
const password = document.getElementById("password");

let showPassword = ()=>{
    if(password.type === "password"){
        password.type = "text";
    }
    else{
        password.type = "password";
    }
}